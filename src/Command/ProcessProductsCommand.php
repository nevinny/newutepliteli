<?php
// src/Command/ProcessProductsCommand.php

namespace App\Command;

use App\Entity\Product;
use App\Entity\ProductParams;
use App\Entity\ProductVariant;
use App\Enum\Statuses;
use App\Service\ImageDownloadService;
use App\Service\WebPageCacheService;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:process-products',
    description: '2. Обрабатывает необработанные записи товаров, получает данные по ссылкам и обновляет записи'
)]
class ProcessProductsCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private HttpClientInterface $httpClient;
    private LoggerInterface $logger;
    private WebPageCacheService $cacheService;
    private bool $useCache;

    public function __construct(
        EntityManagerInterface       $entityManager,
        HttpClientInterface          $httpClient,
        LoggerInterface              $logger,
        WebPageCacheService          $cacheService,
        private ImageDownloadService $imageDownloader
    )
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        $this->cacheService = $cacheService;
        $this->useCache = true;
    }

    protected function configure(): void
    {
        $this
            ->addOption('limit', 'l', InputOption::VALUE_OPTIONAL, 'Лимит обработки записей', 100)
            ->addOption('batch-size', 'b', InputOption::VALUE_OPTIONAL, 'Размер батча для флаша', 25)
            ->addOption('id', 'i', InputOption::VALUE_OPTIONAL, 'Запись с указанным id', '')
            ->addOption('no-cache', null, InputOption::VALUE_NONE, 'Отключить кеширование')
            ->addOption('no-images', null, InputOption::VALUE_NONE, 'Не загружать изображения')
            ->addOption('clear-cache', null, InputOption::VALUE_OPTIONAL, 'Очистить кеш для домена (или весь)', '')
            ->addOption('cache-stats', null, InputOption::VALUE_NONE, 'Показать статистику кеша')
            ->addOption('cache-ttl', null, InputOption::VALUE_OPTIONAL, 'TTL кеша в секундах', (60 * 60 * 4)) // ttl = 4 hour
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Обработка опций управления кешем
        if ($input->getOption('clear-cache') !== '') {
            $domain = $input->getOption('clear-cache') ?: null;
            $this->cacheService->clearCache($domain);
            $io->success($domain ? "Кеш для домена {$domain} очищен" : "Весь кеш очищен");
            return Command::SUCCESS;
        }

        if ($input->getOption('cache-stats')) {
            $stats = $this->cacheService->getCacheStats();
            $io->title('Статистика кеша');
            $io->text(sprintf('Всего файлов: %d', $stats['total_files']));
            $io->text(sprintf('Общий размер: %.2f MB', $stats['total_size_mb']));

            if ($stats['domains']) {
                $io->section('По доменам:');
                foreach ($stats['domains'] as $domain => $domainStats) {
                    $io->text(sprintf('  %s: %d файлов (%.2f MB)', $domain, $domainStats['files'], $domainStats['size_mb']));
                }
            }
            return Command::SUCCESS;
        }

        $this->useCache = !$input->getOption('no-cache');
        $downloadImages = !$input->getOption('no-images');
        $limit = (int)$input->getOption('limit');
        $batchSize = (int)$input->getOption('batch-size');
        $cacheTtl = (int)$input->getOption('cache-ttl');

        $io->title('Обработка необработанных товаров');
        $io->note(sprintf(
            'Лимит: %d, Размер батча: %d, Кеширование: %s, TTL: %d сек',
            $limit, $batchSize, $this->useCache ? 'вкл' : 'выкл', $cacheTtl
        ));
        $id = (int)$input->getOption('id');
        if ($id > 0) {
            $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $id]);
            $products = [$product];
        } else {
            $products = $this->getUnprocessedProducts($limit);
        }

        if (empty($products)) {
            $io->success('Нет необработанных товаров для обработки.');
            return Command::SUCCESS;
        }

        $io->text(sprintf('Найдено %d необработанных товаров.', count($products)));

        $processed = 0;
        $errors = 0;
        $cached = 0;

        foreach ($products as $i => $product) {
            $io->section(sprintf('Обработка товара %d/%d: %s', $i + 1, count($products), $product->getTitle()));

            try {
                $result = $this->processProduct($product, $io, $cacheTtl, $downloadImages);
                $processed++;

                if ($result['from_cache']) {
                    $cached++;
                }

                // Флашим каждые batchSize записей
                if (($i + 1) % $batchSize === 0) {
                    $this->entityManager->flush();
//                    $this->entityManager->clear();
                    $io->note('Выполнен flush и clear EntityManager');
                }
            } catch (\Exception $e) {
                $errors++;
                $this->logger->error('Ошибка обработки товара', [
                    'product_id' => $product->getId(),
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                $io->error(sprintf('Ошибка обработки товара %d: %s', $product->getId(), $e->getMessage()));
            }
        }

        // Флашим оставшиеся изменения
        $this->entityManager->flush();

        $io->success(sprintf(
            'Обработка завершена. Успешно: %d, Из кеша: %d, Ошибок: %d',
            $processed, $cached, $errors
        ));

        return Command::SUCCESS;
    }

    private function getUnprocessedProducts(int $limit): array
    {
        return $this->entityManager->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->leftJoin('p.variants', 'v')
            ->where('p.description IS NULL OR p.description = :empty')
            ->orWhere('p.specs IS NULL OR p.specs = :empty')
            ->orWhere('p.anons IS NULL OR p.anons = :empty')
            ->andWhere('v.originUrl IS NOT NULL')
            ->setParameter('empty', '')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    private function processProduct(Product $product, SymfonyStyle $io, int $cacheTtl, bool $downloadImages): array
    {
        $variants = $product->getVariants();

        if ($variants->isEmpty()) {
            throw new \Exception('У товара нет вариантов с originUrl');
        }

        // Используем первый вариант с валидной ссылкой
        $variantWithUrl = null;
        foreach ($variants as $variant) {
            if ($variant->getOriginUrl()) {
                $variantWithUrl = $variant;
                break;
            }
        }

        if (!$variantWithUrl) {
            throw new \Exception('Нет вариантов с валидной originUrl');
        }

        $url = $variantWithUrl->getOriginUrl();
        $result = ['from_cache' => false];

        $io->text("Получаем данные с: {$url}");

        // Получаем HTML страницы (из кеша или по сети)
        $htmlContent = $this->fetchPageContent($url, $cacheTtl, $result, $io);

        if (!$htmlContent) {
            throw new \Exception('Не удалось получить содержимое страницы');
        }

        // Парсим данные
        $productData = $this->parseProductData($htmlContent, $url, $io);
//        dd($productData, $product);

        $this->checkVariantParams($product, $productData);
        // Загружаем изображение если нужно
        if ($downloadImages) {
            if (!$product->getPreview() && $variantWithUrl->getOriginImage()) {
                $imagePath = $this->downloadProductImage($variantWithUrl->getOriginImage(), $io);
                if ($imagePath) {
                    $productData['preview'] = $imagePath;
                    $result['preview_downloaded'] = true;
                }
            }
            if (!$product->getImage() && !empty($productData['originImage'])) {
                $imagePath = $this->downloadProductImage($productData['originImage'], $io);
                if ($imagePath) {
                    $productData['image'] = $imagePath;
                    $result['image_downloaded'] = true;
                }
            }
        }


        // Обновляем товар
        $this->updateProductWithData($product, $productData, $io);
        // Только если сущность не управляемая (например, после deserialize)
        if (!$this->entityManager->contains($product)) {
            $this->entityManager->persist($product);
        }
        $io->text('✓ Товар успешно обновлен');

        return $result;
    }

    private function downloadProductImage(string $imageUrl, SymfonyStyle $io): ?string
    {
        $io->text("Загружаем изображение: {$imageUrl}");

        $imagePath = $this->imageDownloader->downloadAndSaveImage($imageUrl, 'product');

        if ($imagePath) {
            $io->text("✓ Изображение сохранено: {$imagePath}");
            return $imagePath;
        } else {
            $io->warning('Не удалось загрузить изображение');
            return null;
        }
    }

    private function fetchPageContent(string $url, int $cacheTtl, array &$result, SymfonyStyle $io): ?string
    {
        // Пытаемся получить из кеша
        if ($this->useCache) {
            $cachedContent = $this->cacheService->getCachedContent($url, $cacheTtl);
            if ($cachedContent !== null) {
                $io->text('✓ Загружено из кеша');
                $result['from_cache'] = true;
                return $cachedContent;
            }
        }

        // Загружаем по сети
        try {
            $io->text('Загружаем по сети...');
            $response = $this->httpClient->request('GET', $url, [
                'timeout' => 30,
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception(sprintf('HTTP статус: %d', $response->getStatusCode()));
            }

            $content = $response->getContent();

            // Сохраняем в кеш
            if ($this->useCache) {
                $this->cacheService->saveToCache($url, $content);
                $io->text('✓ Сохранено в кеш');
            }

            $result['from_cache'] = false;
            return $content;

        } catch (\Exception $e) {
            $this->logger->error('Ошибка получения страницы', [
                'url' => $url,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    private function parseProductData(string $html, string $url, SymfonyStyle $io): array
    {
        // ... существующая реализация парсинга ...
        $data = [
            'description' => null,
            'anons' => null,
            'specs' => null,
            'sizes' => null,
            'rating' => null,
            'originImage' => null,
            'review_count' => 0
        ];

        try {
            $dom = new \DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            $xpath = new \DOMXPath($dom);

            $data = $this->parseShopTNData($xpath, $data, $io);

        } catch (\Exception $e) {
            $this->logger->warning('Ошибка парсинга HTML', [
                'url' => $url,
                'error' => $e->getMessage()
            ]);
            $io->warning('Ошибка парсинга HTML: ' . $e->getMessage());
        }

        return $data;
    }

    private function parseShopTNData(\DOMXPath $xpath, array $data, SymfonyStyle $io): array
    {


        // Парсинг единиц
        $measureUnits = $xpath->query('//li[contains(@class, "measure-units__item") and contains(@class, "_active")]');
        if ($measureUnits->length > 0) {
            $measureUnit = '';
            foreach ($measureUnits as $node) {
                $text = trim($node->textContent);
                if ($text) {
                    $measureUnit .= $text . "\n";
                }
            }
            $data['measureUnits'] = trim($measureUnit) ?: null;
        }

        // Парсинг описания
        $descriptionNodes = $xpath->query('//div[contains(@class, "tab-description__text") and contains(@class, "js-desc-ddd")]');
        if ($descriptionNodes->length > 0) {
            $description = '';
            foreach ($descriptionNodes as $node) {
                $text = trim($node->textContent);
                if ($text) {
                    $description .= $text . "\n";
                }
            }
            $data['description'] = trim($description) ?: null;
        }
//        dd($data['description'], $description);

        // Парсинг характеристик
        $specsNodes = $xpath->query('//div[contains(@id, "characteristicsTab")]//div[@class="table"]//ul[@class="table__list"]');

        if ($specsNodes->length > 0) {
            $specs = '';
            foreach ($specsNodes as $index => $listNode) {
                // Пропускаем первый элемент (заголовок)
//                if ($index === 0) continue;

                $items = $xpath->query('.//li[@class="table__item"]', $listNode);
                if ($items->length >= 2) {
                    $key = trim($items->item(0)->textContent);
                    $value = trim($items->item(1)->textContent);

                    $specs .= $key . "\n";
                    $specs .= $value . "\n";
                    $specs .= "\n";
                    $specs .= "\n";
                }
            }
            $data['specs'] = trim($specs) ?: null;
        }

        // Парсинг изображения
        $imageNodes = $xpath->query('//img[@id="mainGalleryImage-0"]');
        if ($imageNodes->length > 0) {
            foreach ($imageNodes as $imgNode) {
                $src = $imgNode->getAttribute('src');
                $dataZoom = $imgNode->getAttribute('data-zoom-src');
                $dataOrigin = $imgNode->getAttribute('data-origin-src');
            }
            $data['originImage'] =
                !empty($src) ? $src :
                    (!empty($dataOrigin) ? $dataOrigin :
                        (!empty($dataZoom) ? $dataZoom : ''));
        }


        if ($data['description']) {
            $io->text('✓ Найдено описание');
        }
        if ($data['specs']) {
            $io->text('✓ Найдены характеристики');
        }
        if ($data['rating']) {
            $io->text(sprintf('✓ Рейтинг: %.1f', $data['rating']));
        }

        return $data;
    }

    private function updateProductWithData(Product $product, array $data, SymfonyStyle $io): void
    {
        if (!$product->getDescription() && $data['description']) {
            $product->setDescription($data['description']);
            $io->text('✓ Обновлено описание');
        }

        if (!$product->getAnons() && $data['anons']) {
            $product->setAnons($data['anons']);
            $io->text('✓ Обновлен анонс');
        } elseif (!$product->getAnons() && $data['description']) {
            $anons = mb_substr($data['description'], 0, 200);
            $product->setAnons($anons . '...');
            $io->text('✓ Создан анонс из описания');
        }

        if (!$product->getSpecs() && $data['specs']) {
            $product->setSpecs($data['specs']);
            $io->text('✓ Обновлены характеристики');
        }

        if (!$product->getPreview() && $data['preview']) {
            $product->setPreview($data['preview']);
            $io->text('✓ Обновлено превью изображения');
        }

        if (!$product->getImage() && $data['image']) {
            $product->setImage($data['image']);
            $io->text('✓ Обновлено изображение');
        }

        $product->setUpdatedAt(new \DateTime());
    }

    private function checkVariantParams(Product $product, array $productData)
    {
        if (array_key_exists('measureUnits', $productData)) {
            $measureUnits = $this->mapMeasureUnits($productData['measureUnits']);
            foreach ($product->getVariants() as $variant) {
                if ($variant->getParams()->count() == 0) {
                    $param = new ProductParams();
                    $param
                        ->setTitle('Единица')
                        ->setExternalId('units')
                        ->setVal($measureUnits)
                        ->setStatus(Statuses::Active);
                    $variant->addParam($param);
                }
            }
            $product->setUpdatedAt(new \DateTime());
        }
    }

    private function mapMeasureUnits(mixed $measureUnits)
    {
        $mapper = fn($unit) => match ($unit) {
            'коробку' => 'коробка',
            'пачку' => 'пачка',
            'упаковку' => 'упаковка',
            'банку' => 'банка',
            'штуку' => 'штука',
            default => $unit
        };

        return is_array($measureUnits)
            ? array_map($mapper, $measureUnits)
            : $mapper($measureUnits);
    }
}
