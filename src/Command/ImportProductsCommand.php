<?php

namespace App\Command;

use App\Entity\Brand;
use App\Entity\Main;
use App\Entity\PriceType;
use App\Entity\Product;
use App\Entity\ProductParams;
use App\Entity\ProductVariant;
use App\Entity\SectionType;
use App\Enum\Availability;
use App\Enum\Statuses;
use App\Service\SectionPathGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsCommand(
    name: 'app:import:products-json',
    description: '1. Import and update products from JSON file'
)]
class ImportProductsCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private Filesystem $filesystem;
    private string $file = './var/cache/products/products.json';
    private Brand $brand;

    public function __construct(
        EntityManagerInterface                $entityManager,
        Filesystem                            $filesystem,
        private SluggerInterface              $slugger,
        private readonly SectionPathGenerator $pathGenerator,
    )
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->filesystem = $filesystem;
        $this->brand = $this->entityManager->getRepository(Brand::class)->find(3);

    }

    protected function configure(): void
    {
        $this
            ->addOption('file', null, InputOption::VALUE_REQUIRED, 'Path to JSON file')
            ->addOption('update-prices', null, InputOption::VALUE_NONE, 'Update prices')
            ->addOption('update-images', null, InputOption::VALUE_NONE, 'Update images');
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ini_set('memory_limit', '256M');
        $io = new SymfonyStyle($input, $output);
        $filePath = $input->getOption('file') ?? $this->file;
        $updatePrices = $input->getOption('update-prices');
        $updateImages = $input->getOption('update-images');
        if (!$filePath || !$this->filesystem->exists($filePath)) {
            $io->error('JSON file not found');
            return Command::FAILURE;
        }

        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        if (!$data || !isset($data['success']) || !$data['success']) {
            $io->error('Invalid JSON structure or parse not successful');
            return Command::FAILURE;
        }

        $io->info(sprintf(
            'Starting import from %s. Parse date: %s, Categories: %d',
            $filePath,
            $data['parse_date'],
            $data['total_categories']
        ));

        $defaultPriceType = $this->entityManager->getRepository(PriceType::class)->findOneBy(['externalId' => '3d6e603c-73c6-11f0-9dc4-b03af61ad78a']);


        $localProducts = $this->entityManager->getRepository(Product::class)->findAllProducts();
//        dd($localProducts);
        $localProductsCache = [];
        foreach ($localProducts as $lp) {
            if (!in_array($lp->getStatus(), [Statuses::Active, Statuses::Disabled, Statuses::New])) {
                continue;
            }
            $title = $lp->getTitle();
            $title = strtolower($title);
            $title = trim($title);
            $title = md5($title);
            if (!array_key_exists($title, $localProductsCache)) {
                $localProductsCache[$title] = [];
            }
            $localProductsCache[$title][] = $lp;
        }
//        dd(count($localProductsCache));

        $processedProducts = 0;
        $processedVariants = 0;

        foreach ($data['categories'] as $categorySlug => $categoryData) {
//            dd($categoryData);
            if (!$categoryData['parse_success']) {
                $io->note(sprintf('Skipping category %s - parse not successful', $categorySlug));
                continue;
            }

            $io->section(sprintf('Processing category: %s (%d products)', $categorySlug, count($categoryData['products'])));

            $groupedProducts = [];
            foreach ($categoryData['products'] as $productData) {
                try {
                    $parts = explode(',', $productData['name']);
//                    dump($parts);
                    $oPattern = '/(\d{3,4})\s*[XХ*]\s*(\d{3,4})\s*[XХ*]\s*(\d{1,4})/u';
                    $pattern = '/(\d+)[\s]*[хxХX×*][\s]*(\d+)[\s]*[хxХX×*][\s]*(\d+)[\s]*(?:мм|см|м|cm|mm)?/ui';
                    if (preg_match($pattern, $productData['name'], $m)) {
                        [$full, $len, $wid, $hei] = $m;
                        $productData['params']['length'] = (int)$len;
                        $productData['params']['width'] = (int)$wid;
                        $productData['params']['height'] = (int)$hei;
                        $productData['params']['units'] = null;

                    } else if (preg_match('/(\d+)[\s]*[хxХX×*][\s]*(\d+)[\s]*(?:мм|см|м|cm|mm)?/ui', $productData['name'], $m)) {
                        [$full, $len, $wid] = $m;
                        $productData['params']['length'] = (int)$len;
                        $productData['params']['width'] = (int)$wid;
                        $d = sprintf("%sх%s", $len, $wid);
                        $productData['params']['units'] = trim(str_replace($d, '', $full));
                    }
                    $productData['params']['package'] = null;
                    if (strpos($productData['name'], "поддон")) {
                        $productData['params']['package'] = 'pallete';
                    }
                    // Количество плит
                    if (preg_match('/\(?\s*(\d+[,.]?\d*)\s*(ПЛИТ|ПЛИТЫ|УПАК|УПАКОВК|КГ)\s*\)?/ui', $productData['name'], $m)) {
//                        dd($m);
                        $productData['params']['count'] = (float)str_replace(',', '.', $m[1]);
                        $productData['params']['packageType'] = $m[2];
                    }
                    $productData['titleParsed'] = $parts;

                    $productData['title'] = $this->splitStringByCommaOrBracket($productData['name']);
                    $md5Title = strtolower($productData['title']);
                    $md5Title = trim($md5Title);
//                    $output->writeln($md5Title);
                    $md5Title = md5($md5Title);
                    if (!array_key_exists($md5Title, $groupedProducts)) {
                        $groupedProducts[$md5Title] = [];
                    }

//                    if($productData['sku'] == '224507')
//                    {
//                        dd($productData);
//                    }
                    $groupedProducts[$md5Title][] = $productData;
//                    if(!array_key_exists($md5Title, $localProductsCache)) {
//                        $this->processProduct($productData, $categoryData, $defaultPriceType, $updatePrices, $updateImages, $io);
//                        $localProductsCache[$md5Title][] = $productData;
//                    }


                } catch (\Exception $e) {
                    $io->error(sprintf('Error processing product %s: %s', $productData['sku'] ?? 'unknown', $e->getMessage()));
                }
            }
//            dd($groupedProducts);
            foreach ($groupedProducts as $id => $groupedProduct) {
                if (!array_key_exists($id, $localProductsCache)) {
                    $product = $this->processProduct($groupedProduct, $categoryData, $defaultPriceType, $updatePrices, $updateImages, $io);
                    $processedProducts++;
                    $processedVariants++;
                    $localProductsCache[$id] = $product;
//                    if ($processedProducts % 50 === 0) {
                    $this->entityManager->flush();
                    $this->syncForProduct($product);
                    $io->note('Flushed changes and cleared entity manager');
//                    }
                }
            }
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
        $io->success(sprintf('Import completed. Processed %d products and %d variants', $processedProducts, $processedVariants));

        return Command::SUCCESS;
    }

    private function splitStringByCommaOrBracket($str): string
    {
        // Находим позиции запятой и открывающей скобки
        $commaPos = strpos($str, ',');
        $bracketPos = strpos($str, '(');

        // Определяем, какой разделитель находится ближе к началу строки
        if ($commaPos === false && $bracketPos === false) {
            // Если ни запятой, ни скобки нет - возвращаем всю строку
            return $str;
        } elseif ($commaPos === false) {
            // Если есть только скобка
            $splitPos = $bracketPos;
        } elseif ($bracketPos === false) {
            // Если есть только запятая
            $splitPos = $commaPos;
        } else {
            // Если есть оба - берем тот, который ближе к началу
            $splitPos = min($commaPos, $bracketPos);
        }

        // Разбиваем строку и возвращаем первую часть
        $firstPart = substr($str, 0, $splitPos);
        $firstPart = trim($firstPart);
        return $firstPart;
    }

    private function processProduct(
        array        $productVariants,
        array        $categoryData,
        ?PriceType   $priceType,
        bool         $updatePrices,
        bool         $updateImages,
        SymfonyStyle $io
    ): Product
    {
//        dd($productVariants);
//        return;
        $productData = $productVariants[0];
        $sku = trim(str_replace("TN", "", $productData['sku'])) ?? null;
        $io->writeln(sprintf('Processing product [%s] %s', $sku ?? 'unknown', $productData['title']));
//        dump($productVariants);
        $externalId = $this->generateExternalId($productData);
//        dd($productVariants,$externalId);
        if (!$sku || !$externalId) {
            throw new \Exception('Missing SKU or external ID');
        }

//        $product = $this->entityManager->getRepository(Product::class)
//            ->findOneBy(['externalId' => $externalId]);

        $parent = $categoryData['internal_category_id'];

        if (!$parent) {
            $parent = $this->mapSkuToCategory((array)$sku) ?? $parent;
        }

        if (!$parent) {
            $parent = $this->mapExtCatToIntCat($productData['category_id']) ?? $parent;
        }
        if (!$parent) {
            $parent = -1; // new products
        }
//        dd($parent);
//        if (!$product) {
        $product = new Product();
        $product->setExternalId($externalId);
        $product->setStatus(Statuses::New);
        $product->setBrand($this->brand);
        $product->setSlug((string)strtolower($this->slugger->slug($productData['title'])));
        $product->setParent($parent);
        $io->note(sprintf('Creating new product: %s', $productData['name']));
//        } else {
//            $io->note(sprintf('Updating existing product: %s', $productData['name']));
//        }

        // Update product basic info
        $product->setTitle($productData['title']);
        $product->setDescription($productData['description'] ?? null);
        $product->setAnons($productData['description'] ?? null);

        // Handle image
        if ($updateImages && !empty($productData['image'])) {
//            $this->handleProductImage($product, $productData['image']);
        }

        foreach ($productVariants as $productVariant) {
            // Get or create variant
            $io->note(sprintf('Creating new variant: %s', $productVariant['name']));
//            $cSku = trim(str_replace("TN", "", $productVariant['sku'])) ?? null;
//            $cSku = $productVariant['product_code'] ?? null;
            $cSku = $productVariant['sku'] ?? null;
            $variant = $this->getOrCreateVariant($product, $cSku, $this->generateExternalId($productVariant));
            $variant->setSku($cSku);
            $price = (float)$productVariant['price'];
            $variant->setPrice($price);
            $variant->setOriginUrl($productVariant['url'] ?? null);
            $variant->setOriginImage($productVariant['image'] ?? null);
            $availabilityValue = $productVariant['availability'] ?? null;
            $availability = $availabilityValue ? Availability::fromApiValue($availabilityValue) : null;
            $variant->setAvailability($availability);
            $this->getOrCreateParams($variant, $productVariant);
        }

        // Update variant data


        // Update parameters
//        $this->updateProductParams($variant, $productData, $categoryData);
//        dd($product);
        if (!$product->getId()) {
            $this->entityManager->persist($product);
        }


//        if (!$variant->getId()) {
//            $this->entityManager->persist($variant);
//        }
        return $product;
    }

    private function getOrCreateVariant($product, $sku, $externalId)
    {
        $variant = new ProductVariant();
        $variant->setProduct($product);
        $variant->setExternalId($externalId);
        $variant->setSku($sku);
        $variant->setStatus(Statuses::Active);

        $product->getVariants()->add($variant);

        return $variant;
    }

    private function getOrCreateParams(ProductVariant $variant, mixed $productVariant): ProductVariant
    {
        if (array_key_exists('params', $productVariant)) {
            $units = array_key_exists('units', $productVariant['params']) ? $productVariant['params']['units'] ?? 'мм' : null;
            if (array_key_exists('length', $productVariant['params'])) {
                $length = $productVariant['params']['length'];
                $param = new ProductParams();
                $param
                    ->setTitle('Длина')
                    ->setExternalId('e1f77903-8566-11ea-ab6b-001e671f818d')
                    ->setVal(sprintf('%s %s', $length, $units))
                    ->setStatus(Statuses::Active);
                $variant->addParam($param);
            }
            if (array_key_exists('width', $productVariant['params'])) {
                $width = $productVariant['params']['width'];
                $param = new ProductParams();
                $param
                    ->setTitle('Ширина')
                    ->setExternalId('b9d23e37-8566-11ea-ab6b-001e671f818d')
                    ->setVal(sprintf('%s %s', $width, $units))
                    ->setStatus(Statuses::Active);
                $variant->addParam($param);
            }
            if (array_key_exists('height', $productVariant['params'])) {
                $height = $productVariant['params']['height'];
                $param = new ProductParams();
                $param
                    ->setTitle('Толщина')
                    ->setExternalId('284e5b42-8566-11ea-ab6b-001e671f818d')
                    ->setVal(sprintf('%s %s', $height, $units))
                    ->setStatus(Statuses::Active);
                $variant->addParam($param);
            }
            if (array_key_exists('count', $productVariant['params'])) {
                $count = $productVariant['params']['count'];
                $param = new ProductParams();
                $param
                    ->setTitle('Количество в упаковке')
                    ->setExternalId('1f68a117-8857-11ea-b94f-001e671f818d')
                    ->setVal($count . ' ' . $productVariant['params']['packageType'])
                    ->setStatus(Statuses::Active);
                $variant->addParam($param);
            }
            if (array_key_exists('package', $productVariant['params']) && $productVariant['params']['package']) {

//                $package = $productVariant['params']['package'];
                $param = new ProductParams();
                $param
                    ->setTitle('Упаковка')
                    ->setExternalId('package')
                    ->setVal('Поддон')
                    ->setStatus(Statuses::Active);
                $variant->addParam($param);
            }
        }
        return $variant;
    }

    private function generateExternalId(array $productData): string
    {
        $sku = str_replace("TN", "", $productData['sku']) ?? '';
        $name = $productData['name'] ?? '';

        return 'GEN-' . md5($sku . '-' . $name);
    }

    private function parseProductLine($line)
    {
        $result = [
            'title' => null,
            'length' => null,
            'width' => null,
            'height' => null,
            'count' => null,
            'area' => null,
            'note' => null,
        ];

        $line = trim(preg_replace('/\s+/', ' ', mb_strtoupper($line)));

        // Размеры
        if (preg_match('/(\d{3,4})\s*[XХ*]\s*(\d{3,4})\s*[XХ*]\s*(\d{1,4})/u', $line, $m)) {
            [$full, $len, $wid, $hei] = $m;
            $result['length'] = (int)$len;
            $result['width'] = (int)$wid;
            $result['height'] = (int)$hei;
            $line = str_replace($full, '', $line);
        }

        // Количество плит
        if (preg_match('/\(?\s*(\d+[,.]?\d*)\s*(ПЛИТ|ПЛИТЫ|УПАК|УПАКОВК)\s*\)?/u', $line, $m)) {
            $result['count'] = (float)str_replace(',', '.', $m[1]);
            $line = str_replace($m[0], '', $line);
        }

        // Площадь
        if (preg_match('/(\d+[,.]?\d*)\s*(КВ\.?\s*М|М²)/u', $line, $m)) {
            $result['area'] = (float)str_replace(',', '.', $m[1]);
            $line = str_replace($m[0], '', $line);
        }

        // Примечания
        $notes = [];
        if (preg_match_all('/ПОДДОН|ЭЛЕМЕНТ\s+[A-ZА-Я]|L\b|2Х\d+/u', $line, $matches)) {
            $notes = array_unique($matches[0]);
            foreach ($matches[0] as $m) {
                $line = str_replace($m, '', $line);
            }
        }
        $result['note'] = $notes ? implode(', ', $notes) : null;

        // Очистка от служебного мусора
        $line = preg_replace('/ММ\b/u', '', $line);
        $line = preg_replace('/\([^)]*\)/u', '', $line); // всё в скобках
        $line = preg_replace('/[,;]+/u', ' ', $line);
        $line = preg_replace('/\s{2,}/u', ' ', $line);
        $line = trim($line, " ,.)Ы");

        // Убираем служебные слова
        $line = preg_replace('/\b(УТЕПЛИТЕЛЬ|ЗВУКОИЗОЛЯЦИЯ)\b/u', '', $line);
        $line = preg_replace('/\s{2,}/u', ' ', $line);

        $result['title'] = trim($line);

        return $result;
    }

    private function extractQuantityAndArea($text)
    {
        $result = [
            'count' => '',
            'count_text' => '',
            'area' => '',
            'area_value' => ''
        ];

        // Поиск количества плит
        $quantityPattern = '/(\d+)\s+(плит[аы]?|упаковок?)/u';
        if (preg_match($quantityPattern, $text, $qMatches)) {
            $result['count'] = $qMatches[1];
            $result['count_text'] = $qMatches[2];
        }

        // Поиск площади
        $areaPattern = '/(\d+[.,]\d+)\s*(?:кв\.\s*м|м²|м\s*²)/u';
        if (preg_match($areaPattern, $text, $aMatches)) {
            $result['area'] = $aMatches[1];
            $result['area_value'] = str_replace(',', '.', $aMatches[1]) . ' кв.м';
        }

        return $result;
    }

    private function detectProductType($name)
    {
        $name = strtoupper($name);

        if (strpos($name, 'XPS') !== false ||
            strpos($name, 'CARBON') !== false ||
            strpos($name, 'ТЕХНОПЛЕКС') !== false ||
            strpos($name, 'ISOBOX') !== false) {
            return 'XPS';
        }

        if (strpos($name, 'ТЕХНОАКУСТИК') !== false ||
            strpos($name, 'ТЕХНОФЛОР') !== false ||
            strpos($name, 'Шумозащита') !== false ||
            strpos($name, 'Звукоизоляция') !== false) {
            return 'Звукоизоляция';
        }

        if (strpos($name, 'ТЕХНОЭЛАСТ') !== false) {
            return 'Гидроизоляция';
        }

        return 'Утеплитель';
    }

    private function parseDimensions($dimensions)
    {
        if (empty($dimensions)) {
            return ['length' => '', 'width' => '', 'height' => ''];
        }

        // Паттерн для размеров
        $pattern = '/(\d+)[хxХX×\s]*(\d+)[хxХX×\s]*(\d+)/u';

        if (preg_match($pattern, $dimensions, $matches)) {
            return [
                'length' => $matches[1],
                'width' => $matches[2],
                'height' => $matches[3]
            ];
        }

        return ['length' => '', 'width' => '', 'height' => ''];
    }


    public function syncForProduct(Product $product): void
    {
//        dd($product);
        $sectionType = $this->entityManager->getRepository(SectionType::class)
            ->findOneBy(['code' => 'product']);
        if (!$sectionType) {
            throw new \RuntimeException('SectionType "product" not found');
        }

        $main = $this->entityManager->getRepository(Main::class)->findOneBy([
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
            $categoryType = $this->entityManager->getRepository(SectionType::class)
                ->findOneBy(['code' => 'category']);
            $parentMain = $this->entityManager->getRepository(Main::class)->findOneBy([
                'entityId' => $product->getParent(),
                'entityType' => $categoryType,
            ]);
//            dd($product, $sectionType,$parentMain);
            $main->setParent($parentMain);
        }

        $fullPath = $this->pathGenerator->generateFullPath($main);
        $existing = $this->entityManager->getRepository(Main::class)->findOneBy(['fullPath' => $fullPath]);
        $main->setFullPath($fullPath);


        if ($existing && $existing->getId() !== $main->getId()) {
//            $this->logger->warning('Duplicate fullPath skipped', [
//                'path' => $fullPath,
//                'existingId' => $existing->getId(),
//            ]);
//            dd($fullPath, $existing);
            return; // или кидай исключение, если критично
        }
        $this->entityManager->persist($main);
        $this->entityManager->flush();
    }

    /**
     * Маппит SKU в internal_category_id с добавлением лидирующих нулей
     */
    public function mapSkuToCategory(array $skuList)
    {
        $mappedResults = [];
        $notMappedSkus = [];

        $mappingData = $this->getMappingData();
//        dd($mappingData);
        // Создаем lookup таблицу для быстрого поиска
        $mappingLookup = [];
        foreach ($mappingData as $line) {
            if (count($line) >= 2) {
                $sku = $this->normalizeSku($line[0]);
                $categoryId = $line[1];
                $mappingLookup[$sku] = $categoryId;
            }
        }
//        dd($skuList,$mappingLookup);
        foreach ($skuList as $sku) {
            $normalizedSku = $this->normalizeSku($sku);

            if (isset($mappingLookup[$normalizedSku])) {
                return $mappingLookup[$normalizedSku];
            }
        }

        return null;
    }

    /**
     * Нормализует SKU - добавляет лидирующие нули до 6 знаков
     */
    private function normalizeSku($sku)
    {
        // Убираем пробелы и нечисловые символы
        $cleanSku = preg_replace('/[^\d]/', '', $sku);

        // Добавляем лидирующие нули до 6 знаков
        if (strlen($cleanSku) < 6) {
            $cleanSku = str_pad($cleanSku, 6, '0', STR_PAD_LEFT);
        }

        return $cleanSku;
    }

    private function mapExtCatToIntCat(int $catId)
    {
        $mappingData = [
            '67' => '9',
            '14' => '23',
            '5' => '10',
            '56' => '11',
            '68' => '20',
            '8' => '14',
            '64' => '11',
            '6' => '',
        ];

        return isset($mappingData[$catId]) ? $mappingData[$catId] : null;
    }

    private function getMappingData(): array
    {
        // Ваши данные для маппинга
        $mappingData = [
            ['362078', '48'],
            ['1787', '23'],
            ['6275', '23'],
            ['6186', '23'],
            ['1929', '23'],
            ['1790', '23'],
            ['462320', '23'],
            ['459782', '23'],
            ['459786', '23'],
            ['459259', '23'],
            ['1822', '23'],
            ['38', '23'],
            ['2390', '23'],
            ['40', '23'],
            ['3258', '23'],
            ['42', '23'],
            ['472153', '23'],
            ['529632', '23'],
            ['405037', '23'],
            ['402759', '23'],
            ['402757', '23'],
            ['379921', '23'],
            ['401110', '23'],
            ['53399', '23'],
            ['691611', '23'],
            ['22450', '23'],
            ['101', '23'],
            ['10244', '23'],
            ['691729', '23'],
            ['1799', '23'],
            ['100', '23'],
            ['3096', '23'],
            ['72', '23'],
            ['83', '23'],
            ['74', '23'],
            ['87', '23'],
            ['76', '23'],
            ['82', '23'],
            ['78', '23'],
            ['2687', '23'],
            ['393547', '33'],
            ['393554', '33'],
            ['224507', '33'],
            ['393540', '34'],
            ['352606', '34'],
            ['63888', '40'],
            ['359442', '40'],
            ['359456', '40'],
            ['425670', '40'],
            ['460064', '41'],
            ['228698', '42'],
            ['629627', '43'],
            ['37968', '43'],
            ['37969', '43'],
            ['343447', '43'],
            ['37967', '43'],
            ['46456', '44'],
            ['697205', '44'],
            ['357365', '45'],
            ['218244', '45'],
            ['818066', '45'],
            ['542194', '45'],
            ['818140', '45'],
            ['818071', '45'],
            ['818132', '45'],
            ['681797', '45'],
            ['72335', '45'],
            ['681801', '45'],
            ['678534', '45'],
            ['677686', '45'],
            ['678533', '45'],
            ['677684', '45'],
            ['681833', '45'],
            ['681837', '45'],
            ['72632', '29'],
            ['526640', '30'],
            ['526641', '30'],
            ['678009', '19'],
            ['672205', '19'],
            ['27518', '19'],
            ['42594', '19'],
            ['528381', '19'],
            ['528379', '19'],
            ['528382', '19'],
            ['528377', '19'],
            ['528369', '19'],
            ['528373', '19'],
            ['577002', '31'],
            ['577004', '31'],
            ['577003', '31'],
            ['604099', '31'],
            ['646940', '47'],
            ['624350', '21'],
            ['41896', '20'],
            ['47047', '20'],
            ['692247', '20'],
            ['692245', '20'],
            ['684039', '32'],
            ['684037', '32'],
            ['696675', '32'],
            ['77597', '36'],
            ['697149', '36'],
            ['73234', '36'],
            ['64392', '36'],
            ['46451', '36'],
            ['697223', '36'],
            ['697212', '36'],
            ['68898', '37'],
            ['68899', '37'],
            ['68907', '37'],
            ['68912', '37'],
            ['68916', '37'],
            ['68917', '37'],
            ['581605', '38'],
            ['581604', '38'],
            ['581606', '38'],
            ['581603', '38'],
            ['034591', '42'],
            ['025264', '20'],
            ['012658', '20'],
            ['012657', '20'],
            ['014364', '20'],
            ['039559', '11'],
        ];
        return $mappingData;
    }
}
