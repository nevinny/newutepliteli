<?php

class ProductParser
{
    private $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';
    private $timeout = 30;
    private $verifySSL = true;
    private $cache = [];
    private $baseUrl = 'https://shop.tn.ru';
    private $searchApiUrl = 'https://autocomplete.diginetica.net/autocomplete';
    private $searchApiKey = '95YYA88UC5';

    public function __construct(array $config = [])
    {
        if (isset($config['userAgent'])) {
            $this->userAgent = $config['userAgent'];
        }
        if (isset($config['timeout'])) {
            $this->timeout = $config['timeout'];
        }
        if (isset($config['verifySSL'])) {
            $this->verifySSL = $config['verifySSL'];
        }
        if (isset($config['baseUrl'])) {
            $this->baseUrl = $config['baseUrl'];
        }
        if (isset($config['searchApiKey'])) {
            $this->searchApiKey = $config['searchApiKey'];
        }
    }

    /**
     * Парсинг товаров по списку SKU через API поиска
     * Возвращает данные в формате, идентичном эталонному парсеру категорий
     */
    public function parseProductsBySku(array $skuList)
    {
        $allResults = [
            'success' => true,
            'parse_date' => date('Y-m-d H:i:s'),
            'total_categories' => 0, // Будем считать после обработки
            'categories' => []
        ];

        $notFoundSkus = [];

        foreach ($skuList as $index => $sku) {
            echo "Поиск товара по SKU: {$sku} (" . ($index + 1) . "/" . count($skuList) . ")\n";

            $productData = $this->searchProductBySkuApi($sku);

            if ($productData['success'] && !empty($productData['products'])) {
                // Распределяем товары по категориям
                $this->distributeProductsByCategory($allResults, $productData['products']);
                echo "✓ Найден товар: {$productData['products'][0]['name']}\n";
            } else {
                $notFoundSkus[] = $sku;
                echo "✗ Товар не найден\n";
                if (isset($productData['error'])) {
                    echo "  Ошибка: {$productData['error']}\n";
                }
            }

            sleep(1);
        }

        // Обновляем счетчик категорий
        $allResults['total_categories'] = count($allResults['categories']);

        // Сохраняем лог не найденных SKU
        $this->saveNotFoundSkus($notFoundSkus);

        // Сохраняем результат
        $this->saveSkuSearchResults($allResults);

        return $allResults;
    }

    /**
     * Распределяет товары по категориям
     */
    private function distributeProductsByCategory(&$allResults, $products)
    {
        foreach ($products as $product) {
            $categoryId = $product['category_id'] ?? 'unknown_category';
            $categoryUrl = $product['category_url'] ?? 'unknown_url';
            $categoryName = $product['category_name'] ?? 'Неизвестная категория';

            if (!isset($allResults['categories'][$categoryId])) {
                $allResults['categories'][$categoryId] = [
                    'internal_category_id' => null, // Будет заполнено при маппинге
                    'url' => $categoryUrl ?? $this->baseUrl . '/search',
                    'parse_success' => true,
                    'total_products' => 0,
                    'expected_total' => 0,
                    'total_pages' => 1,
                    'category_name' => $categoryName, // Добавляем название категории
                    'products' => []
                ];
            }

            $allResults['categories'][$categoryId]['products'][] = $product;
            $allResults['categories'][$categoryId]['total_products']++;
        }

        // Обновляем expected_total для каждой категории
        foreach ($allResults['categories'] as &$category) {
            $category['expected_total'] = $category['total_products'];
        }
    }

    /**
     * Сохраняет лог не найденных SKU
     */
    private function saveNotFoundSkus($notFoundSkus)
    {
        if (!empty($notFoundSkus)) {
            $log = [
                'parse_date' => date('Y-m-d H:i:s'),
                'total_not_found' => count($notFoundSkus),
                'not_found_skus' => $notFoundSkus
            ];

            $filename = 'var/cache/products/not_found_skus_' . date('Y-m-d_H-i-s') . '.json';

            // Создаем директорию если не существует
            $dir = dirname($filename);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            file_put_contents(
                $filename,
                json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            );

            echo "\n⚠️ Не найдено SKU: " . count($notFoundSkus) . "\n";
            echo "Лог сохранен в: {$filename}\n";
            echo "Не найденные SKU: " . implode(', ', $notFoundSkus) . "\n";
        }
    }

    /**
     * Поиск товара по SKU на сайте
     */
    private function searchProductBySku($sku)
    {
        try {
            // Формируем URL для поиска
            $searchUrl = $this->baseUrl . '/catalogsearch/result/?q=' . urlencode($sku);

            echo "Поисковый URL: {$searchUrl}\n";

            $html = $this->fetchUrl($searchUrl);
            if (!$html) {
                throw new Exception("Не удалось загрузить страницу поиска");
            }

            // Проверяем, есть ли результаты поиска
            if ($this->isNoSearchResults($html)) {
                return [
                    'success' => true,
                    'products' => [],
                    'message' => 'Товар не найден'
                ];
            }

            // Парсим результаты поиска
            $products = $this->extractProducts($html);

            // Фильтруем по точному совпадению SKU
            $filteredProducts = $this->filterProductsByExactSku($products, $sku);

            if (empty($filteredProducts)) {
                // Если точного совпадения нет, проверяем есть ли вообще товары
                if (!empty($products)) {
                    return [
                        'success' => true,
                        'products' => $products,
                        'message' => 'Точное совпадение не найдено, но есть похожие товары'
                    ];
                }

                return [
                    'success' => true,
                    'products' => [],
                    'message' => 'Товары не найдены'
                ];
            }

            return [
                'success' => true,
                'products' => $filteredProducts,
                'total_found' => count($filteredProducts)
            ];

        } catch (Exception $e) {
            $this->logError($e->getMessage(), "SKU: {$sku}");
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'sku' => $sku
            ];
        }
    }


    /**
     * Поиск товара по SKU через API
     */
    private function searchProductBySkuApi($sku)
    {
        try {
            // Формируем URL для API запроса
            $params = [
                'st' => $sku,
                'apiKey' => $this->searchApiKey,
                'strategy' => 'advanced_xname,zero_queries',
                'productsSize' => 100,
                'regionId' => 77,
                'forIs' => 'true',
                'showUnavailable' => 'false',
                'withContent' => 'true',
                'withSku' => 'false'
            ];

            $apiUrl = $this->searchApiUrl . '?' . http_build_query($params);

            echo "API URL: " . $apiUrl . "\n";

            $response = $this->fetchApi($apiUrl);

            if (!$response) {
                throw new Exception("Пустой ответ от API");
            }

            $data = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Ошибка декодирования JSON: " . json_last_error_msg());
            }

            // Обрабатываем результаты
            $products = $this->processApiProducts($data, $sku);

            return [
                'success' => true,
                'products' => $products,
                'total_found' => count($products)
            ];

        } catch (Exception $e) {
            $this->logError($e->getMessage(), "SKU: {$sku}");
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'sku' => $sku
            ];
        }
    }

    /**
     * Обрабатывает продукты из API ответа
     */
    private function processApiProducts($apiData, $searchSku)
    {
        $products = [];

        if (empty($apiData['products']) || !is_array($apiData['products'])) {
            return $products;
        }

        foreach ($apiData['products'] as $apiProduct) {
            // Фильтруем по точному совпадению ID/SKU
            if ($this->isExactSkuMatch($apiProduct, $searchSku)) {
                $product = $this->convertApiProductToStandardFormat($apiProduct);
                if ($product) {
                    $products[] = $product;
                }
            }
        }

        return $products;
    }

    /**
     * Проверяет точное совпадение SKU
     */
    private function isExactSkuMatch($apiProduct, $searchSku)
    {
        // Сравниваем ID продукта с искомым SKU
        $productId = $apiProduct['id'] ?? '';

        // Приводим к одному формату для сравнения
        $cleanProductId = preg_replace('/[^a-zA-Z0-9]/', '', $productId);
        $cleanSearchSku = preg_replace('/[^a-zA-Z0-9]/', '', $searchSku);

        return strcasecmp($cleanProductId, $cleanSearchSku) === 0;
    }

    /**
     * Конвертирует продукт из API формата в эталонный формат
     */
    private function convertApiProductToStandardFormat($apiProduct)
    {
        try {
            $categoryInfo = $this->extractCategoryFromApi($apiProduct);
            // Формируем продукт в точном соответствии с эталонным форматом
            $product = [
                'name' => $apiProduct['name'] ?? '',
                'sku' => $apiProduct['id'] ?? '',
                'image' => $this->normalizeImageUrl($apiProduct['image_url'] ?? ''),
                'url' => $this->normalizeProductUrl($apiProduct['link_url'] ?? ''),
                'product_code' => $apiProduct['attributes']['productid'][0] ?? $apiProduct['id'] ?? '',
                'availability_text' => $apiProduct['available'] ? 'В наличии' : 'Под заказ',
                'price' => $this->extractPriceFromApiProduct($apiProduct),
                'priceCurrency' => 'RUB', // Всегда RUB для этого сайта
                'price_per_square_meter' => $this->extractPricePerSquareMeter($apiProduct),
                'availability' => $apiProduct['available'] ? 'InStock' : 'OutOfStock',
                'category_id' => $categoryInfo['id'], // Добавляем ID категории
                'category_url' => $categoryInfo['url'], // Добавляем url категории
                'category_name' => $categoryInfo['name'] // Добавляем название категории
            ];

            return $this->cleanAndValidateProduct($product);

        } catch (Exception $e) {
            $this->logError("Ошибка конвертации продукта: " . $e->getMessage(), $apiProduct['id'] ?? 'unknown');
            return null;
        }
    }

    /**
     * Извлекает категорию из API продукта
     */
    private function extractCategoryFromApi($apiProduct)
    {
        // Пытаемся получить основную категорию
        if (!empty($apiProduct['categories']) && is_array($apiProduct['categories'])) {
            foreach ($apiProduct['categories'] as $category) {
                // Предпочитаем категории с direct: true или первую попавшуюся
                if (isset($category['id']) && isset($category['name']) && isset($category['link_url'])) {
                    return [
                        'id' => $category['id'],
                        'url' => $category['link_url'],
                        'name' => $category['name']
                    ];
                }
                if (isset($category['id']) && isset($category['name'])) {
                    return [
                        'id' => $category['id'],
                        'url' => $category['link_url'] ?? '',
                        'name' => $category['name']
                    ];
                }
            }

            // Если не нашли подходящую, берем первую
            $firstCategory = $apiProduct['categories'][0];
            if (isset($firstCategory['id']) && isset($firstCategory['name'])) {
                return [
                    'id' => $firstCategory['id'],
                    'url' => $firstCategory['link_url'] ?? '',
                    'name' => $firstCategory['name']
                ];
            }
        }

        // Если категорий нет, создаем общую
        return [
            'id' => 'general',
            'url' => '/search',
            'name' => 'Общая категория'
        ];
    }

    /**
     * Извлекает основную цену из API продукта
     */
    private function extractPriceFromApiProduct($apiProduct)
    {
        // Основная цена
        if (isset($apiProduct['price'])) {
            return $this->normalizePriceForOutput($apiProduct['price']);
        }

        // Или цена из атрибутов
        if (isset($apiProduct['attributes']['pricespecial'][0])) {
            return $this->normalizePriceForOutput($apiProduct['attributes']['pricespecial'][0]);
        }

        return null;
    }

    private function extractPricePerSquareMeter($apiProduct)
    {
        // В API Diginetica обычно нет цены за м², но можно попробовать вычислить
        // или оставить null, как в некоторых товарах эталонного парсера
        return null;
    }

    /**
     * Нормализует цену для вывода (в формате эталонного парсера)
     */
    private function normalizePriceForOutput($price)
    {
        if (is_numeric($price)) {
            // Эталонный парсер сохраняет цены как строки без копеек
            return (string)intval($price);
        }

        // Убираем все нечисловые символы
        $cleanPrice = preg_replace('/[^\d.]/', '', $price);

        if ($cleanPrice) {
            // Преобразуем к целому числу как в эталонном парсере
            return (string)intval(floatval($cleanPrice));
        }

        return null;
    }

    /**
     * Извлекает все типы цен из API продукта
     */
    private function extractAllPrices($apiProduct)
    {
        $prices = [];

        if (isset($apiProduct['price'])) {
            $prices['regular'] = $this->normalizePrice($apiProduct['price']);
        }

        if (!empty($apiProduct['attributes'])) {
            $priceAttributes = [
                'priceemployee' => 'employee',
                'pricesilver' => 'silver',
                'price500k' => '500k',
                'priceplatinum' => 'platinum',
                'pricespecial' => 'special',
                'price250k' => '250k',
                'pricegold' => 'gold'
            ];

            foreach ($priceAttributes as $attr => $type) {
                if (!empty($apiProduct['attributes'][$attr][0])) {
                    $prices[$type] = $this->normalizePrice($apiProduct['attributes'][$attr][0]);
                }
            }
        }

        return $prices;
    }

    /**
     * Извлекает категории из API продукта
     */
    private function extractCategoriesFromApi($apiProduct)
    {
        $categories = [];

        if (!empty($apiProduct['categories']) && is_array($apiProduct['categories'])) {
            foreach ($apiProduct['categories'] as $category) {
                $categories[] = [
                    'id' => $category['id'] ?? '',
                    'name' => $category['name'] ?? '',
                    'url' => $category['link_url'] ?? '',
                    'image' => $category['image_url'] ?? ''
                ];
            }
        }

        return $categories;
    }

    /**
     * Нормализует URL продукта
     */
    private function normalizeProductUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        if (strpos($url, 'http') === 0) {
            return $url;
        }

        // Если URL относительный, добавляем базовый URL
        if (strpos($url, '/') === 0) {
            return $this->baseUrl . $url;
        }

        return $this->baseUrl . '/' . $url;
    }

    /**
     * Нормализует цену
     */
    private function normalizePrice($price)
    {
        if (is_numeric($price)) {
            return (float)$price;
        }

        // Убираем все нечисловые символы кроме точки
        $cleanPrice = preg_replace('/[^\d.]/', '', $price);

        return $cleanPrice ? (float)$cleanPrice : null;
    }

    /**
     * Очищает и валидирует продукт
     */
    private function cleanAndValidateProduct($product)
    {
        foreach ($product as $key => $value) {
            if (is_string($value)) {
                $value = trim($value);
                $value = preg_replace('/\s+/', ' ', $value);
                $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $product[$key] = $value;
            }

            // Убираем пустые значения, кроме некоторых полей
            if ($value === null || $value === '') {
                if (!in_array($key, ['price_per_square_meter', 'description'])) {
                    unset($product[$key]);
                }
            }
        }

        return $product;
    }

    /**
     * Запрос к API
     */
    private function fetchApi($url)
    {
        $cacheKey = md5($url);
        if (isset($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_USERAGENT => $this->userAgent,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_SSL_VERIFYPEER => $this->verifySSL,
            CURLOPT_SSL_VERIFYHOST => $this->verifySSL ? 2 : 0,
            CURLOPT_ENCODING => '',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json, text/plain, */*',
                'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'Cache-Control: no-cache',
                'Referer: ' . $this->baseUrl,
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            throw new Exception("cURL Error: {$error}");
        }

        if ($httpCode !== 200) {
            throw new Exception("HTTP Error: {$httpCode}");
        }

        $this->cache[$cacheKey] = $response;
        return $response;
    }

    /**
     * Сохраняет результаты поиска по SKU
     */
    private function saveSkuSearchResults($results)
    {
        $filename = 'var/cache/products/products_search.json';

        file_put_contents(
            $filename,
            json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        echo "Результаты поиска по SKU сохранены в: {$filename}\n";

        // Также сохраняем краткий отчет
        $this->saveSkuSearchReport($results);
    }

    /**
     * Сохраняет краткий отчет по поиску SKU
     */
    private function saveSkuSearchReport($results)
    {
        $skuCategory = $results['categories']['sku_search'];
        $report = [
            'parse_date' => $results['parse_date'],
            'total_sku_searched' => $skuCategory['total_products'],
            'products_found' => $skuCategory['total_products'],
            'found_products_list' => array_map(function ($product) {
                return [
                    'name' => $product['name'],
                    'sku' => $product['sku'],
                    'product_code' => $product['product_code'],
                    'price' => $product['price'],
                    'availability' => $product['availability_text']
                ];
            }, $skuCategory['products'])
        ];

        $filename = 'var/cache/products/sku_search_report_' . date('Y-m-d_H-i-s') . '.json';

        file_put_contents(
            $filename,
            json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        echo "Отчет по поиску SKU сохранен в: {$filename}\n";
    }

    // Существующие методы остаются без изменений...
    private function normalizeImageUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        // Пропускаем data:image URLs
        if (strpos($url, 'data:image') === 0) {
            return null;
        }

        // Добавляем протокол если нужно
        if (strpos($url, '//') === 0) {
            return 'https:' . $url;
        }

        return $url;
    }

    private function cleanAndValidate($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = trim($value);
                $value = preg_replace('/\s+/', ' ', $value);
                $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $data[$key] = $value;
            }
        }

        return $data;
    }

    private function logError($message, $context = '')
    {
        $logMessage = date('[Y-m-d H:i:s]') . " Error: {$message}";
        if ($context) {
            $logMessage .= " | Context: {$context}";
        }
        $logMessage .= PHP_EOL;

        error_log($logMessage, 3, 'parser_errors.log');
    }
}

