<?php

namespace App\Service;

use App\Entity\Main;
use App\Entity\Product;
use App\Entity\SectionType;
use App\Service\SectionPathGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class MainRepairService
{
    public function __construct(
        private EntityManagerInterface $em,
        private SectionPathGenerator   $pathGenerator,
        private LoggerInterface        $logger,
    )
    {
    }

    public function findProductsWithoutMain(): array
    {
        $qb = $this->em->createQueryBuilder();

        $sectionType = $this->em->getRepository(SectionType::class)
            ->findOneBy(['code' => 'product']);

        return $this->em->createQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->leftJoin(
                'App\Entity\Main',
                'm',
                'WITH',
                'm.entityId = p.id AND m.entityType = (SELECT st FROM App\Entity\SectionType st WHERE st.code = \'product\')'
            )
            ->where('m.id IS NULL')
            ->getQuery()
            ->getResult();

//        return $qb->select('p')
//            ->from(Product::class, 'p')
//            ->leftJoin(
//                Main::class,
//                'm',
//                'WITH',
//                'm.entityId = p.id AND m.entityType = :entityType'
//            )
//            ->where('m.id IS NULL')
//            ->andWhere('p.status != :deletedStatus')
//            ->setParameter('entityType', $sectionType)
//            ->setParameter('deletedStatus', 0) // или ваш статус для удаленных
//            ->getQuery()
//            ->getResult();
    }

    public function repairAllMissingMains(): int
    {
        $products = $this->findProductsWithoutMain();
        $repaired = 0;

        $this->logger->info(sprintf('Starting repair for %d products', count($products)));

        foreach ($products as $index => $product) {
            try {
                if (!$this->em->isOpen()) {
                    $this->logger->warning('EntityManager closed, recreating...');
                    $this->em = $this->em->create(
                        $this->em->getConnection(),
                        $this->em->getConfiguration()
                    );
                }

                $success = $this->repairSingleProduct($product);

                if ($success) {
                    $repaired++;
                    $this->logger->info(sprintf('Repaired Main for product %d/%d: %s',
                        $index + 1, count($products), $product->getTitle()));
                }

                // Периодически флашим и очищаем
                if (($index + 1) % 10 === 0) {
                    $this->em->flush();
                    $this->em->clear();

                    // Перезагружаем SectionType после clear
                    $this->reinitializeDependencies();
                }

            } catch (\Exception $e) {
                $this->logger->error('Failed to repair Main for product', [
                    'productId' => $product->getId(),
                    'externalId' => $product->getExternalId(),
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                // В случае ошибки пробуем переоткрыть EntityManager
                if (!$this->em->isOpen()) {
                    $this->em = $this->em->create(
                        $this->em->getConnection(),
                        $this->em->getConfiguration()
                    );
                }
            }
        }

        // Финальный flush
        if ($this->em->isOpen()) {
            $this->em->flush();
        }

        return $repaired;
    }

    private function repairSingleProduct(Product $product): bool
    {
        $sectionType = $this->em->getRepository(SectionType::class)
            ->findOneBy(['code' => 'product']);

        if (!$sectionType) {
            throw new \RuntimeException('SectionType "product" not found');
        }

        // Проверяем, не создалась ли запись Main параллельно
        $existingMain = $this->em->getRepository(Main::class)->findOneBy([
            'entityId' => $product->getId(),
            'entityType' => $sectionType,
        ]);

        if ($existingMain) {
            $this->logger->info('Main record already exists for product', [
                'productId' => $product->getId(),
            ]);
            return true;
        }

        $main = new Main();
        $main->setEntityType($sectionType);
        $main->setEntityId($product->getId());
        $main->setTitle($product->getTitle());
        $main->setSlug($product->getSlug());
        $main->setStatus($product->getStatus());
        $main->setIsNode(false);
        $main->setCreatedAt($product->getCreatedAt());
        $main->setUpdatedAt($product->getUpdatedAt());

        // Устанавливаем родителя если есть
        if ($product->getParent()) {
            $parentMain = $this->findParentMain($product->getParent());
            $main->setParent($parentMain);
        }

        // Генерируем full_path
        $this->setFullPath($main);

        $this->em->persist($main);
        return true;
    }

    private function findParentMain(int $parentId): ?Main
    {
        $categoryType = $this->em->getRepository(SectionType::class)
            ->findOneBy(['code' => 'category']);

        return $this->em->getRepository(Main::class)->findOneBy([
            'entityId' => $parentId,
            'entityType' => $categoryType,
        ]);
    }

    private function setFullPath(Main $main): void
    {
        try {
            $fullPath = $this->pathGenerator->generateFullPath($main);

            if (empty($fullPath)) {
                throw new \RuntimeException('Generated full_path is empty');
            }

            // Проверяем на дубликаты
            $existing = $this->em->getRepository(Main::class)
                ->findOneBy(['fullPath' => $fullPath]);

            if ($existing && $existing->getId() !== $main->getId()) {
                $this->logger->warning('Duplicate fullPath, generating alternative', [
                    'path' => $fullPath,
                    'existingId' => $existing->getId(),
                ]);

                // Генерируем альтернативный путь
                $fullPath = $this->generateAlternativePath($main, $fullPath);
            }

            $main->setFullPath($fullPath);

        } catch (\Exception $e) {
            $this->logger->error('Failed to generate full path', [
                'mainTitle' => $main->getTitle(),
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    private function generateAlternativePath(Main $main, string $basePath): string
    {
        $counter = 1;
        $newPath = $basePath . '-' . $counter;

        while ($this->em->getRepository(Main::class)->findOneBy(['fullPath' => $newPath])) {
            $counter++;
            $newPath = $basePath . '-' . $counter;

            if ($counter > 100) {
                throw new \RuntimeException('Cannot generate unique path after 100 attempts');
            }
        }

        return $newPath;
    }

    private function reinitializeDependencies(): void
    {
        // После clear() нужно переинициализировать зависимости
        // Это можно сделать через setter injection или пересоздание
    }
}
