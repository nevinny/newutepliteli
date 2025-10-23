<?php

namespace App\Service;

use App\Entity\Main;
use App\Entity\Product;
use App\Entity\SectionType;
use App\Service\SectionPathGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class MainSyncService
{
    public function __construct(
        private EntityManagerInterface $em,
        private SectionPathGenerator   $pathGenerator,
        private LoggerInterface        $logger,
    )
    {
    }

    public function syncProduct(Product $product): void
    {
        $sectionType = $this->em->getRepository(SectionType::class)
            ->findOneBy(['code' => 'product']);

        if (!$sectionType) {
            throw new \RuntimeException('SectionType "product" not found');
        }

        $main = $this->findOrCreateMain($product, $sectionType);
        $this->updateMainFromProduct($main, $product, $sectionType);

        $this->em->persist($main);
        $this->em->flush();
    }

    private function findOrCreateMain(Product $product, SectionType $sectionType): Main
    {
        return $this->em->getRepository(Main::class)->findOneBy([
            'entityId' => $product->getId(),
            'entityType' => $sectionType,
        ]) ?? new Main();
    }

    private function updateMainFromProduct(Main $main, Product $product, SectionType $sectionType): void
    {
        $main->setEntityType($sectionType);
        $main->setEntityId($product->getId());
        $main->setTitle($product->getTitle());
        $main->setSlug($product->getSlug());
        $main->setStatus($product->getStatus());
        $main->setIsNode(false);
        $main->setCreatedAt($product->getCreatedAt());
        $main->setUpdatedAt($product->getUpdatedAt());

        // Set parent if exists
        if ($product->getParent()) {
            $parentMain = $this->findParentMain($product->getParent());
            $main->setParent($parentMain);
        }

        // Generate and validate path
        $this->setFullPath($main);
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
        $fullPath = $this->pathGenerator->generateFullPath($main);

        // Check for duplicates
        $existing = $this->em->getRepository(Main::class)
            ->findOneBy(['fullPath' => $fullPath]);

        if ($existing && $existing->getId() !== $main->getId()) {
            $this->logger->warning('Duplicate fullPath skipped', [
                'path' => $fullPath,
                'existingId' => $existing->getId(),
            ]);
            return;
        }

        $main->setFullPath($fullPath);
    }
}
