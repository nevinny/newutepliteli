<?php

namespace App\Service\Import;
ini_set('max_execution_time', 60);

use App\Entity\Category;
use App\Entity\Main;
use App\Entity\PriceType;
use App\Entity\Product;
use App\Entity\ImportLog;
use App\Entity\ProductParams;
use App\Entity\ProductPrice;
use App\Entity\ProductVariant;
use App\Entity\SectionType;
use App\Entity\Warehouse;
use App\Enum\Statuses;
use App\Repository\ProductParamsRepository;
use App\Repository\ProductVariantRepository;
use App\Service\SectionPathGenerator;
use Doctrine\ORM\EntityManagerInterface;
use SimpleXMLElement;
use Symfony\Component\String\Slugger\SluggerInterface;
use XMLReader;

class ProductImportService
{
    private string $defaultPriceTypeId;
    public function __construct(
        private EntityManagerInterface $em,
        private SluggerInterface $slugger,
        private readonly SectionPathGenerator $pathGenerator,
//        private ProductParamsRepository $productParamsRepo,
    )
    {
        $this->defaultPriceTypeId = 'base_price'; // или ваш ID из CommerceML
    }

    public function importFromFile(string $filePath): int
    {
        $variantRepository = $this->em->getRepository(ProductVariant::class);
        $productRepository = $this->em->getRepository(Product::class);
        $categoryRepository = $this->em->getRepository(Category::class);
        $paramRepository = $this->em->getRepository(ProductParams::class);
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

        $existingCategories = $categoryRepository
            ->createQueryBuilder('c')
            ->select('c')
            ->indexBy('c', 'c.externalId')
            ->getQuery()
            ->getResult();

//        dd($existingCategories);
        $existingProducts = $productRepository
            ->createQueryBuilder('p')
            ->select('p')
            ->indexBy('p', 'p.externalId')
            ->getQuery()
            ->getResult();

        $existingProductVariants = $variantRepository
            ->createQueryBuilder('pv')
            ->select('pv')
            ->indexBy('pv', 'pv.externalId')
            ->getQuery()
            ->getResult();

        $existingParams = $paramRepository
            ->findAll();
        $paramsCache = $this->buildParamsCache($existingParams);

        $seenExternalIds = [];
        $imported = 0;
        $skippedDeleted = 0;
        $reader->open($filePath);
        while ($reader->read()) {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'Товар') {
                $skip = false;
                $status = $reader->getAttribute('Статус');
                if ($status === 'Удален') {
                    $skip = true;
//                    dd($reader->getAttribute('Статус'));
                    // Пропускаем весь элемент предложения
                    $reader->next(); // переходим к следующему элементу
                    $skippedDeleted++;
                    continue;
                }
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
                if (strlen($description) > 20) {
                    $product->setDescription($description);
                }
                if ($skip) {
                    $product->setStatus(Statuses::Disabled);
                } else {
                    $product->setStatus(Statuses::Active);
                }

                $seenExternalIds[] = $baseId;

                // создать ProductVariant
                if (array_key_exists($variantId, $existingProductVariants)) {
                    $variant = $existingProductVariants[$variantId];
                } else {
                    $variant = new ProductVariant();
                    $variant->setStatus(Statuses::Active);
                }
//                $variant = $existingProductVariants[$variantId] ?? new ProductVariant();
                $variant->setExternalId($variantId);
                $variant->setProduct($product);

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
                if ($skip === false) {
                    $this->em->persist($product);
                    $this->em->flush();
                    $this->syncForProduct($product);
                }

//                dd($product);


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

        // почистить пустые варианты
        $removedVariants = $variantRepository->removeVariantsWithoutParams();
//        dd($removedVariants);

        // лог импорта
        $log = new ImportLog();
        $log->setType('Product');
        $log->setFilePath($filePath);
        $log->setDoneCount($imported);
        $this->em->persist($log);

        $this->em->flush();

        return $imported;
    }

    public function importOffers(string $filePath): int
    {
        $reader = new XMLReader();

        if (!$reader->open($filePath)) {
            throw new \RuntimeException("Cannot open XML file at $filePath");
        }

        // Кэшируем существующие данные
        $warehouses = $this->em->getRepository(Warehouse::class)
            ->createQueryBuilder('w')
            ->indexBy('w', 'w.externalId')
            ->getQuery()
            ->getResult();


        $seenExternalIds = [];
        $doubled = [
            '69d33473-1d9f-11e6-b645-001e671f818c',
            '43d12bcf-1dab-11e6-b645-001e671f818c', // Бензобак Горленко А.А., Бензобак Будило П.П.
            '7a14856e-b3de-11e3-aaf9-001e671f818c'
        ];
        $priceTypes = $this->em->getRepository(PriceType::class)
            ->createQueryBuilder('pt')
            ->indexBy('pt', 'pt.externalId')
            ->getQuery()
            ->getResult();
        while ($reader->read()) {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'Склады') {
                $xml = new SimpleXMLElement($reader->readOuterXML());
                // Обработать категорию (рекурсивно, если вложенные группы)
                if (isset($xml->Склад)) {
                    foreach ($xml->Склад as $stockXml) {
                        $warehouseExternalId = (string)$stockXml->Ид;
                        $warehouseName = (string)$stockXml->Наименование;
//                        dd($warehouses, $stockXml, $warehouseExternalId, $warehouseName);
                        // Создаем склад если не существует
                        if (!isset($warehouses[$warehouseExternalId])) {
                            $warehouse = new Warehouse();
                            $warehouse->setExternalId($warehouseExternalId);
                            $warehouse->setTitle($warehouseName);
                            $warehouse->setParent(384);

                            if (in_array($warehouseExternalId, $doubled, true)) {
                                $warehouseName .= ' (1)';
                            }
                            $warehouse->setSlug((string)$this->slugger->slug($warehouseName));
                            $this->em->persist($warehouse);
                            $warehouses[$warehouseExternalId] = $warehouse;
                            $seenExternalIds[] = $warehouseExternalId;
                        }

                    }
                }
                $this->em->flush();
            }
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'ТипыЦен') {
                $xml = new SimpleXMLElement($reader->readOuterXML());
//                dd($xml);
                // типы цен справочник
                if (isset($xml->ТипЦены)) {
//                    dd($xml);
                    foreach ($xml->ТипЦены as $priceXml) {
                        $priceTypeExternalId = (string)$priceXml->Ид;
                        $priceTypeName = (string)$priceXml->Наименование;
                        $currency = (string)$priceXml->Валюта;
                        if (!isset($priceTypes[$priceTypeExternalId])) {
                            $priceType = new PriceType();
                            $priceType->setExternalId($priceTypeExternalId);
                            $priceType->setTitle($priceTypeName);
                            $priceType->setCurrency($currency);
                            $this->em->persist($priceType);
                            $priceTypes[$priceTypeExternalId] = $priceType;
                        }
                    }
                    $this->em->flush();
                }
            }
        }

        // Пометить как удаленные все, кто не встретился
        foreach ($warehouses as $externalId => $warehouse) {
            if (!in_array($externalId, $seenExternalIds, true)) {
                $warehouse->setStatus(Statuses::Deleted);
            }
        }
//        dd($categoryGroups);
        $reader->close();
//        dd($warehouses);


        $variants = $this->em->getRepository(ProductVariant::class)
            ->createQueryBuilder('pv')
            ->indexBy('pv', 'pv.externalId')
            ->getQuery()
            ->getResult();

//        $existingStocks = $this->em->getRepository(Stock::class)->findAll();
//        $existingPrices = $this->em->getRepository(Price::class)->findAll();

        $imported = 0;
        $reader->open($filePath);
        $skippedDeleted = 0;
        while ($reader->read()) {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'Предложение') {

                // Проверяем статус ДО создания SimpleXMLElement
                $status = $reader->getAttribute('Статус');
                if ($status === 'Удален') {
                    // Пропускаем весь элемент предложения
                    $reader->next(); // переходим к следующему элементу
                    $skippedDeleted++;
                    continue;
                }

                $xml = new SimpleXMLElement($reader->readOuterXML());
                $externalId = (string)$xml->Ид;

                if (!str_contains($externalId, '#')) {
                    $baseId = $externalId;
                    $variantExternalId = $externalId;
                    $needVariant = true;
                } else {
                    $externalIDS = explode('#', $externalId);
                    $baseId = $externalIDS[0];
                    $variantExternalId = $externalIDS[1];
                    $needVariant = true;
                }

                // Пропускаем если вариант не найден
                if (!isset($variants[$variantExternalId])) {
                    continue;
                }

                $variant = $variants[$variantExternalId];

                // Обрабатываем склады и остатки
                if (isset($xml->Склад)) {
                    foreach ($xml->Склад as $stockXml) {
                        $warehouseExternalId = (string)$stockXml['ИдСклада'];
//                        $warehouseName = (string) $stockXml['Наименование'];
                        $quantity = (int)$stockXml['КоличествоНаСкладе'];

                        if (array_key_exists($warehouseExternalId, $warehouses)) {
                            $warehouse = $warehouses[$warehouseExternalId];
                        }
//                        dd($variant, $quantity, $stockXml, $warehouseExternalId, $warehouse);

                        // Обновляем или создаем остаток
//                        $stock = $this->em->getRepository(Stock::class)->findOneBy([
//                            'variant' => $variant,
//                            'warehouse' => $warehouse
//                        ]);
//
//                        if (!$stock) {
//                            $stock = new Stock();
//                            $stock->setVariant($variant);
//                            $stock->setWarehouse($warehouse);
//                        }
//
//                        $stock->setQuantity($quantity);
//                        $this->em->persist($stock);
                    }
                }


//                dd('qwe');

                // Обрабатываем цены
                if (isset($xml->Цены)) {
                    foreach ($xml->Цены->Цена as $priceXml) {
                        $priceTypeExternalId = (string)$priceXml->ИдТипаЦены;
                        $priceValue = (string)$priceXml->ЦенаЗаЕдиницу;
//                        if($priceValue > 0)
//                        {
//                            dd($xml->Цены, $variant);
//                        }
                        $currency = (string)$priceXml->Валюта;
//
//                         Создаем тип цены если не существует
//                        if (!isset($priceTypes[$priceTypeExternalId])) {
//                            $priceType = new PriceType();
//                            $priceType->setExternalId($priceTypeExternalId);
//                            $priceType->setTitle('Тип цены ' . $priceTypeExternalId);
//                            $this->em->persist($priceType);
//                            $priceTypes[$priceTypeExternalId] = $priceType;
//                        }
//
                        $priceType = $priceTypes[$priceTypeExternalId];

//                        dd($priceType, $priceValue, $currency,$variant);
//
//                         Обновляем или создаем цену
                        $price = new ProductPrice();
                        $price->setVariant($variant);
                        $price->setType($priceType);
                        $price->setPrice($priceValue);
                        $price->setCurrency($currency);
                        $price->setCoefficient((float)$priceXml->Коэффициент ?? 0);
                        $this->em->getRepository(ProductPrice::class)->upsert($price);
                    }
                }

                $imported++;

                // Периодически флашим для экономии памяти
//                if ($imported % 100 === 0) {
                $this->em->flush();
//                    $output->writeln("<info>Обработано: {$imported}</info>");
//                }
            }
        }
        dd($skippedDeleted, $imported);
        $this->em->flush();
        $reader->close();

        return $imported;
    }

    private function importPrice(SimpleXMLElement $xml, ProductVariant $variant): void
    {
        if (!isset($xml->Цены)) {
            return;
        }

        foreach ($xml->Цены->Цена as $priceXml) {
            $priceTypeId = (string)$priceXml->ИдТипаЦены;

            // Берем только нужный тип цены
            if ($priceTypeId !== $this->defaultPriceTypeId) {
                continue;
            }

            $priceValue = (string)$priceXml->ЦенаЗаЕдиницу;

            if (!is_numeric($priceValue)) {
//                $output->writeln("<error>Некорректная цена для варианта {$variant->getExternalId()}: {$priceValue}</error>");
                continue;
            }

            $variant->setPrice($priceValue);
            $this->em->persist($variant);

//            $output->writeln("<info>Установлена цена для {$variant->getExternalId()}: {$priceValue}</info>");
            break; // Прерываем после нахождения нужной цены
        }
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
