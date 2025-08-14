<?php

namespace App\Service\Import;

use App\Entity\Category;
use App\Entity\Main;
use App\Entity\Product;
use App\Entity\ImportLog;
use App\Entity\ProductParams;
use App\Entity\ProductVariant;
use App\Entity\SectionType;
use App\Enum\Statuses;
use App\Repository\ProductParamsRepository;
use App\Service\SectionPathGenerator;
use Doctrine\ORM\EntityManagerInterface;
use SimpleXMLElement;
use Symfony\Component\String\Slugger\SluggerInterface;
use XMLReader;

class ProductImportService
{
    public function __construct(
        private EntityManagerInterface $em,
        private SluggerInterface $slugger,
        private readonly SectionPathGenerator $pathGenerator,
//        private ProductParamsRepository $productParamsRepo,
    ) {}

    public function importFromFile(string $filePath): int
    {
        $reader = new XMLReader();

        if (!$reader->open($filePath)) {
            throw new \RuntimeException("Cannot open XML file at $filePath");
        }

        $categoryGroups = [];
        while ($reader->read())
        {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'Группа') {
                $xml = new SimpleXMLElement($reader->readOuterXML());
                // Обработать категорию (рекурсивно, если вложенные группы)
                if($xml->Ид == 'e67947dd-8565-11ea-ab6b-001e671f818d')
                    continue;
                $categoryGroups[] =$xml;
            }
        }
//        dd($categoryGroups);
        $reader->close();

        $existingCategories = $this->em->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->select('c')
            ->indexBy('c', 'c.externalId')
            ->getQuery()
            ->getResult();

//        dd($existingCategories);
        $existingProducts = $this->em->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select('p')
            ->indexBy('p', 'p.externalId')
            ->getQuery()
            ->getResult();

        $existingProductVariants = $this->em->getRepository(ProductVariant::class)
            ->createQueryBuilder('pv')
            ->select('pv')
            ->indexBy('pv', 'pv.externalId')
            ->getQuery()
            ->getResult();

        $existingParams = $this->em->getRepository(ProductParams::class)->findAll();
        $paramsCache = $this->buildParamsCache($existingParams);

        $seenExternalIds = [];
        $imported = 0;
        $reader->open($filePath);
        while ($reader->read()) {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'Товар') {
                $xml = new SimpleXMLElement($reader->readOuterXML());
                $externalId = (string) $xml->Ид;

                if(!str_contains($externalId, '#'))
                {
                    $baseId = $externalId;
                    $variantId = $externalId;
                    $needVariant = true;
                } else {
                    $externalIDS = explode('#', $externalId);
                    $baseId = $externalIDS[0];
                    $variantId = $externalIDS[1];
                    $needVariant = true;
                }

                $name = (string) $xml->Наименование;
                $description = (string) ($xml->Описание ?? '');
                $categoryId = (string) $xml->Группы->Ид;

                $product = $existingProducts[$baseId] ?? new Product();

                if(array_key_exists($categoryId, $existingCategories)) {
                    $product->setParent($existingCategories[$categoryId]->getId());
                }
                $fullTitle = null;
                foreach ($xml->ЗначенияРеквизитов->ЗначениеРеквизита ?? [] as $requisite) {
                    if ((string) $requisite->Наименование === 'Полное наименование') {
                        $fullTitle = trim((string)$requisite->Значение);
                        break;
                    }
                }
                $fullTitle ??= $name;

                $product->setExternalId($baseId);
                $product->setTitle($fullTitle);
                $product->setSlug((string) $this->slugger->slug($fullTitle));
                $product->setDescription($description);
                $product->setStatus(Statuses::Active);
                $seenExternalIds[] = $baseId;

                // создать ProductVariant
                $variant = $existingProductVariants[$variantId] ?? new ProductVariant();
                $variant->setExternalId($variantId);
                $variant->setProduct($product);
                $variant->setStatus(Statuses::Active);
                $this->em->persist($variant);
                // Характеристики
                foreach ($xml->ХарактеристикиТовара->ХарактеристикаТовара ?? [] as $paramXml) {
                    $paramExternalId = (string)$paramXml->Ид;

                    // найти существующий параметр
                    $param = $paramsCache[$variantId][$paramExternalId] ?? null;
                    if (!$param) {
                        $param = new ProductParams();
                        $param->setVariant($variant);
                        $param->setExternalId($paramExternalId);
                        $this->em->persist($param);
                        $paramsCache[$variantId][$paramExternalId] = $param;
                    }

                    $param->setTitle((string)$paramXml->Наименование);
                    $param->setVal((string)$paramXml->Значение);
                    // Добавляем только если еще не добавлен
                    if (!$variant->getParams()->contains($param)) {
                        $variant->addParam($param);
                    }
                }
                $product->addVariant($variant);
                $this->em->persist($product);
                $this->em->flush();
//                dd($product);
                $this->syncForProduct($product);

                if(!array_key_exists($baseId, $existingProducts)) {
                    $existingProducts[$baseId] = $product;
                }
                $imported++;
            }
        }

        $reader->close();

        // Пометить как удаленные все, кто не встретился
        foreach ($existingProducts as $externalId => $product) {
            if (!in_array($externalId, $seenExternalIds, true)) {
                $product->setStatus(Statuses::Deleted);
            }
        }

        // лог импорта
        $log = new ImportLog();
        $log->setType('Product');
        $log->setFilePath($filePath);
        $log->setDoneCount($imported);
        $this->em->persist($log);

        $this->em->flush();

        return $imported;
    }

    public function syncForProduct(Product $product): void
    {
//        dd($product);
        $sectionType = $this->em->getRepository(SectionType::class)
            ->findOneBy(['code' => 'product']);
        if (!$sectionType) {
            throw new \RuntimeException('SectionType "product" not found');
        }

        $main = $this->em->getRepository(Main::class)->findOneBy([
            'entityId' => $product->getId(),
            'entityType' => $sectionType,
        ]) ?? new Main();


        $main->setEntityType($sectionType);
        $main->setEntityId($product->getId());
        $main->setTitle($product->getTitle());
        $main->setSlug($product->getSlug());
        $main->setStatus($product->getStatus());
        $main->setIsNode(false);
        $main->setCreatedAt($product->getCreatedAt());
        $main->setUpdatedAt($product->getUpdatedAt());

        if ($product->getParent()) {
            $categoryType = $this->em->getRepository(SectionType::class)
                ->findOneBy(['code' => 'category']);
            $parentMain = $this->em->getRepository(Main::class)->findOneBy([
                'entityId' => $product->getParent(),
                'entityType' => $categoryType,
            ]);
//            dd($product, $sectionType,$parentMain);
            $main->setParent($parentMain);
        }

        $fullPath = $this->pathGenerator->generateFullPath($main);
        $existing = $this->em->getRepository(Main::class)->findOneBy(['fullPath' => $fullPath]);
        $main->setFullPath($fullPath);

//        dd($main, $fullPath, $existing);
//        dump($product, $fullPath,$main, $existing);
        if($fullPath == '/catalog/teploizolyaciya/Uteplitel-Rokvul-Rockwool-RUF-BATTS-N-E')
        {
            dd($existing, $main);
        }

        if ($existing && $existing->getId() !== $main->getId()) {
//            $this->logger->warning('Duplicate fullPath skipped', [
//                'path' => $fullPath,
//                'existingId' => $existing->getId(),
//            ]);
//            dd($fullPath, $existing);
            return; // или кидай исключение, если критично
        }
        $this->em->persist($main);
        $this->em->flush();



    }

    private function buildParamsCache(array $existingParams): array
    {
        $cache = [];

        foreach ($existingParams as $param) {
            $variantExternalId = $param->getVariant()->getExternalId();
            $paramExternalId = $param->getExternalId();

            if ($paramExternalId !== null) {
                $cache[$variantExternalId][$paramExternalId] = $param;
            }
        }

        return $cache;
    }
}
