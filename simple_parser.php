<?php

class ProductParser
{
    private $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';
    private $timeout = 30;
    private $verifySSL = true;
    private $cache = [];

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
    }

    public function parseAllCategories()
    {
        $categories = [
//            'kamennaya-vata' => [
//                'url' => 'https://shop.tn.ru/teploizoljacija/kamennaja-vata',
//                'internal_id' => 20
//            ],
//            'xps' => [
//                'url' => 'https://shop.tn.ru/teploizoljacija/xps',
//                'internal_id' => 21
//            ],
//            'mineralnaya-izoljacija' => [
//                'url' => 'https://shop.tn.ru/teploizoljacija/mineralnaya-izoljacija',
//                'internal_id' => 22
//            ],
            'zvukoizoljacija' => [
                'url' => 'https://shop.tn.ru/zvukoizoljacija',
                'internal_id' => 11
            ],
//            'tehnicheskaja-izoljacija' => [
//                'url' => 'https://shop.tn.ru/ognezaschita-i-tehnicheskaja-izoljacija/tehnicheskaja-izoljacija',
//                'internal_id' => 14
//            ],
//            'rulonnye-krovelnye-materialy' => [
//                'url' => 'https://shop.tn.ru/krovlja/rulonnye-krovelnye-materialy',
//                'internal_id' => 23
//            ],
//            'pir' => [
//                'url' => 'https://shop.tn.ru/teploizoljacija/pir',
//                'internal_id' => 621
//            ],
//            'komplektujuschie' => [
//                'url' => 'https://shop.tn.ru/krovlja/komplektujuschie',
//                'internal_id' => 632
//            ],
//            'gibkaja-cherepica' => [
//                'url' => 'https://shop.tn.ru/krovlja/gibkaja-cherepica',
//                'internal_id' => 634
//            ],
//            'peni-klei-germetiki' => [
//                'url' => 'https://shop.tn.ru/peni-klei-germetiki',
//                'internal_id' => 19
//            ],
//            'materialy-dlya-shtukaturnogo-fasada' => [
//                'url' => 'https://shop.tn.ru/fasad/materialy-dlya-shtukaturnogo-fasada',
//                'internal_id' => 620
//            ],
//            'fasadnaja-plitka-hauberk' => [
//                'url' => 'https://shop.tn.ru/fasad/fasadnaja-plitka-hauberk',
//                'internal_id' => 626
//            ],
        ];

        $allResults = [
            'success' => true,
            'parse_date' => date('Y-m-d H:i:s'),
            'total_categories' => count($categories),
            'categories' => []
        ];

        foreach ($categories as $categoryKey => $categoryInfo) {
            echo "Парсинг категории: {$categoryKey}\n";

            $result = $this->parseAllProducts($categoryInfo['url']);

            // Формируем структуру категории
            $categoryData = [
                'internal_category_id' => $categoryInfo['internal_id'],
                'url' => $categoryInfo['url'],
                'parse_success' => $result['success'],
            ];

            if ($result['success']) {
                // Если успешно - добавляем данные о продуктах
                $categoryData['total_products'] = $result['total_products'] ?? 0;
                $categoryData['expected_total'] = $result['expected_total'] ?? 0;
                $categoryData['total_pages'] = $result['total_pages'] ?? 0;
                $categoryData['products'] = $result['products'] ?? [];

                // Выводим информацию о категории
                echo "Найдено товаров: " . ($result['total_products'] ?? 0) . "\n";
                echo "Обработано страниц: " . ($result['total_pages'] ?? 0) . "\n";
            } else {
                // Если ошибка - добавляем информацию об ошибке
                $categoryData['error'] = $result['error'] ?? 'Неизвестная ошибка';
                echo "Ошибка: " . $categoryData['error'] . "\n";
            }

            $allResults['categories'][$categoryKey] = $categoryData;

            // Задержка между категориями
            sleep(2);
        }

        // Сохраняем полный результат
        file_put_contents(
            'var/cache/products/products.json',
            json_encode($allResults, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        // Также сохраняем отдельно по категориям (только успешные)
        $this->saveProductsByCategory($allResults);

        return $allResults;
    }


    private function saveProductsByCategory($allResults)
    {
        foreach ($allResults['categories'] as $categoryKey => $categoryData) {
            if ($categoryData['parse_success'] && !empty($categoryData['products'])) {
                $categoryFile = "products_{$categoryKey}.json";
                file_put_contents(
                    'var/cache/products/' . $categoryFile,
                    json_encode($categoryData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                );
                echo "Сохранена категория: {$categoryFile}\n";
            }
        }
    }


    public function parseAllProducts($baseUrl)
    {
        try {
            $allProducts = [];
            $page = 1;
            $hasMorePages = true;
            $totalProductsCount = 0;

            while ($hasMorePages) {
                $url = $page === 1 ? $baseUrl : $baseUrl . '?p=' . $page;

                echo "Парсинг страницы: {$url}\n";

                $result = $this->parseProducts($url);

                if (!$result['success']) {
                    throw new Exception("Ошибка при парсинге страницы {$page}: " . $result['error']);
                }

                // Сохраняем общее количество товаров из первой страницы
                if ($page === 1 && isset($result['total_count'])) {
                    $totalProductsCount = $result['total_count'];
                }


                $allProducts = array_merge($allProducts, $result['products']);
                $cnt = count($allProducts);
                echo "Обработано товаров: {$cnt}/{$totalProductsCount}\n";
                $hasMorePages = $this->hasNextPage($result['products'], $page, $totalProductsCount);
                $page++;

                sleep(1);
            }

            return [
                'success' => true,
                'total_products' => count($allProducts),
                'expected_total' => $totalProductsCount,
                'total_pages' => $page - 1,
                'products' => $allProducts
            ];

        } catch (Exception $e) {
            $this->logError($e->getMessage(), $baseUrl);
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'url' => $baseUrl
            ];
        }
    }

    // Также обновим метод hasNextPage для большей надежности
    private function hasNextPage($currentProducts, $currentPage, $totalCount)
    {
        // Если нет товаров на текущей странице - это конец
        if (empty($currentProducts)) {
            return false;
        }

        // Если на текущей странице меньше 30 товаров - это последняя страница
        if (count($currentProducts) < 30) {
            return false;
        }

        // Если общее количество известно и мы уже собрали все товары
        if ($totalCount > 0 && ($currentPage * 30) >= $totalCount) {
            return false;
        }

        // Если на текущей странице есть товары и их 30 - вероятно есть следующая страница
        return count($currentProducts) === 30;
    }

    public function parseProducts($url)
    {
        try {
            if (!extension_loaded('curl')) {
                throw new Exception("Расширение cURL не установлено");
            }
            if (!extension_loaded('dom')) {
                throw new Exception("Расширение DOM не установлено");
            }

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new Exception("Некорректный URL: {$url}");
            }

            $html = $this->fetchUrl($url);
            if (!$html) {
                throw new Exception("Не удалось загрузить страницу");
            }

            $products = $this->extractProducts($html);
//            print_r($products);
            $allProductsCount = $this->allProductsCount($html);

            return [
                'success' => true,
                'url' => $url,
                'count' => count($products),
                'total_count' => $allProductsCount,
                'products' => $products
            ];

        } catch (Exception $e) {
            $this->logError($e->getMessage(), $url);
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'url' => $url
            ];
        }
    }

    private function fetchUrl($url)
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
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'Cache-Control: no-cache',
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

    private function extractProducts($html)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, "UTF-8", "auto"));
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // Ищем все элементы с классом products-grid__item
        $productNodes = $xpath->query("//li[contains(@class, 'products-grid__item')]");

        $products = [];

        foreach ($productNodes as $node) {
            $productData = $this->extractProductData($xpath, $node);
            if ($productData && !empty($productData['name'])) {
                $products[] = $productData;
            }
        }

        return $products;
    }

    private function extractProductData($xpath, $productNode)
    {
        $data = [
            'name' => $this->getProductName($xpath, $productNode),
//            'description' => $this->getItempropValue($xpath, 'description', $productNode),
            'sku' => $this->getProductSku($xpath, $productNode),
//            'ekn' => $this->getProductCode($xpath, $productNode),
            'image' => $this->getProductImage($xpath, $productNode),
            'url' => $this->getProductUrl($xpath, $productNode),
            'product_code' => $this->getProductCode($xpath, $productNode),
            'availability_text' => $this->getAvailabilityText($xpath, $productNode),
        ];

        // Извлекаем данные о цене
        $priceData = $this->extractPriceData($xpath, $productNode);
        $data = array_merge($data, $priceData);

        // Очищаем и валидируем данные
        $data = $this->cleanAndValidate($data);

        return array_filter($data, function ($value) {
            return $value !== null && $value !== '';
        });
    }

    private function getProductName($xpath, $productNode)
    {
        // Пробуем несколько способов получить название
        $name = $this->getNodeValue($xpath, ".//a[contains(@class, 'products-grid__name')]", $productNode);
        if (!$name) {
            $name = $this->getItempropValue($xpath, 'name', $productNode);
        }
        if (!$name) {
            $name = $this->getNodeAttribute($xpath, ".//img[contains(@class, 'products-grid__img')]", 'alt', $productNode);
        }
        return $name;
    }

    private function getProductSku($xpath, $productNode)
    {
        // Пробуем несколько способов получить SKU
        $sku = $this->getItempropValue($xpath, 'sku', $productNode);
        if (!$sku && $productNode->hasAttribute('data-sku')) {
            $sku = $productNode->getAttribute('data-sku');
        }
        return $sku;
    }

    private function getProductEkn($xpath, $productNode)
    {
        // Пробуем несколько способов получить SKU
        $sku = $this->getItempropValue($xpath, 'sku', $productNode);
        if (!$sku && $productNode->hasAttribute('data-sku')) {
            $sku = $productNode->getAttribute('data-sku');
        }
        return $sku;
    }

    private function getProductImage($xpath, $productNode)
    {
        // Основной способ - извлекаем из data-srcset (lazy loading)
        $image = $this->getNodeAttribute($xpath, ".//img[contains(@class, 'products-grid__img')]", 'data-srcset', $productNode);

        // Если нет в data-srcset, пробуем обычный src
        if (!$image) {
            $image = $this->getNodeAttribute($xpath, ".//img[contains(@class, 'products-grid__img')]", 'src', $productNode);
        }

        // Если нет, пробуем itemprop image
        if (!$image) {
            $image = $this->getItempropAttribute($xpath, 'image', 'src', $productNode);
        }

        // Обрабатываем data-srcset - берем первый URL
        if ($image && strpos($image, ' ') !== false) {
            $parts = explode(' ', $image);
            foreach ($parts as $part) {
                if (filter_var($part, FILTER_VALIDATE_URL)) {
                    $image = $part;
                    break;
                }
            }
        }

        return $image;
    }

    private function getProductUrl($xpath, $productNode)
    {
        $url = $this->getNodeAttribute($xpath, ".//a[contains(@class, 'products-grid__link')]", 'href', $productNode);
        if (!$url) {
            $url = $this->getItempropAttribute($xpath, 'url', 'href', $productNode);
        }
        return $url;
    }

    private function getProductCode($xpath, $productNode)
    {
//        $code = $this->getNodeValue($xpath, ".//p[contains(@class, 'products-grid__code')]", $productNode);
        $codeElement = $xpath->query('.//p[contains(@class, "products-grid__code")]', $productNode)->item(1);
        return trim($codeElement->textContent);
//        print_r('=='.trim($codeElement->textContent).'==');
//        die();
//        return $this->getNodeValue($xpath, ".//p[contains(@class, 'products-grid__code')]", $productNode);
    }

    private function getAvailabilityText($xpath, $productNode)
    {
        return $this->getNodeValue($xpath, ".//p[contains(@class, 'products-grid__informer')]", $productNode);
    }

    private function extractPriceData($xpath, $productNode)
    {
        $priceData = [
            'price' => null,
            'priceCurrency' => null,
            'price_per_square_meter' => null,
            'availability' => null
        ];

        // Извлекаем основную цену
        $priceData['price'] = $this->getItempropValue($xpath, 'price', $productNode);
        $priceData['priceCurrency'] = $this->getItempropValue($xpath, 'priceCurrency', $productNode);

        // Если не нашли через микроразметку, ищем вручную
        if (!$priceData['price']) {
            $priceNode = $xpath->query(".//span[contains(@class, 'price') and not(ancestor::span[contains(@class, 'products-grid__square')])]", $productNode);
            if ($priceNode->length > 0) {
                $priceText = $priceNode->item(0)->nodeValue;
                $priceData['price'] = $this->extractPriceFromText($priceText);
            }
        }

        // Извлекаем цену за м²
        $squarePriceNode = $xpath->query(".//span[contains(@class, 'products-grid__square')]//span[contains(@class, 'price')]", $productNode);
        if ($squarePriceNode->length > 0) {
            $squarePriceText = $squarePriceNode->item(0)->nodeValue;
            $priceData['price_per_square_meter'] = $this->extractPriceFromText($squarePriceText);
        }

        // Извлекаем доступность
        $availability = $this->getItempropAttribute($xpath, 'availability', 'href', $productNode);
        if ($availability) {
            if (strpos($availability, 'InStock') !== false) {
                $priceData['availability'] = 'InStock';
            } elseif (strpos($availability, 'OutOfStock') !== false) {
                $priceData['availability'] = 'OutOfStock';
            }
        }

        return array_filter($priceData);
    }

    private function extractPriceFromText($text)
    {
//        if (preg_match('/[\d\s]+(?:\.[\d]{2})?/', $text, $matches)) {
//            return trim(str_replace(' ', '', $matches[0]));
//        }
        return trim(str_replace([' ', '.'], ['', ''], $text));
    }

    private function getItempropValue($xpath, $itemprop, $contextNode = null)
    {
        $nodes = $xpath->query(".//*[@itemprop='{$itemprop}']", $contextNode);
        if ($nodes->length > 0) {
            $node = $nodes->item(0);
            if ($node->hasAttribute('content')) {
                return trim($node->getAttribute('content'));
            }
            return trim($node->nodeValue);
        }
        return null;
    }

    private function getItempropAttribute($xpath, $itemprop, $attribute, $contextNode = null)
    {
        $nodes = $xpath->query(".//*[@itemprop='{$itemprop}']", $contextNode);
        if ($nodes->length > 0 && $nodes->item(0)->hasAttribute($attribute)) {
            return trim($nodes->item(0)->getAttribute($attribute));
        }
        return null;
    }

    private function getNodeValue($xpath, $query, $contextNode = null)
    {
        $nodes = $xpath->query($query, $contextNode);
        if ($nodes && $nodes->length > 0) {
            return trim($nodes->item(0)->nodeValue);
        }
        return null;
    }

    private function getNodeAttribute($xpath, $query, $attribute, $contextNode = null)
    {
        $nodes = $xpath->query($query, $contextNode);
        if ($nodes && $nodes->length > 0 && $nodes->item(0)->hasAttribute($attribute)) {
            return trim($nodes->item(0)->getAttribute($attribute));
        }
        return null;
    }

    private function cleanAndValidate($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = trim($value);
                $value = preg_replace('/\s+/', ' ', $value);
                $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

                // Убираем лишние символы из цен
                if (in_array($key, ['price', 'price_per_square_meter']) && $value) {
                    $value = preg_replace('/[^\d.]/', '', $value);
                }

                $data[$key] = $value;
            }
        }

        // Нормализуем URL изображения
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $this->normalizeImageUrl($data['image']);
        }

        return $data;
    }

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

    private function logError($message, $url = '')
    {
        $logMessage = date('[Y-m-d H:i:s]') . " Error: {$message}";
        if ($url) {
            $logMessage .= " | URL: {$url}";
        }
        $logMessage .= PHP_EOL;

        error_log($logMessage, 3, 'parser_errors.log');
    }

    public function clearCache()
    {
        $this->cache = [];
    }

    private function allProductsCount($html)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, "UTF-8", "auto"));
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // Более точный поиск по структуре блока
        $textNode = $xpath->query("//div[@data-role='category-bottom-text']//p[contains(@class, 'category-seo-bottom-text__text')]");

        if ($textNode->length === 0) {
            return 0;
        }

        $text = trim($textNode->item(0)->textContent);

        // Ищем число перед словом "товар"
        if (preg_match('/(\d+)\s+товар/', $text, $matches)) {
            return (int)$matches[1];
        }

        return 0;
    }
}

// Тестирование с вашим HTML
try {
    $parser = new ProductParser([
        'timeout' => 30,
        'verifySSL' => false
    ]);

    // Если нужно протестировать на вашем HTML
//    $html = 'ВАШ_HTML_КОД_ЗДЕСЬ'; // Вставьте ваш HTML код

    // Создаем временный файл для тестирования
//    file_put_contents('test_products.html', $html);
//    $result = $parser->parseProducts('file://' . __DIR__ . '/test_products.html');

    // Или тестируем на реальном URL
//    $url = "https://shop.tn.ru/teploizoljacija/kamennaja-vata";
//    $result = $parser->parseAllProducts($url);
    $result = $parser->parseAllCategories();

    if ($result['success']) {
        echo "Парсинг завершен!\n";
        echo "Обработано категорий: " . $result['total_categories'] . "\n";

        // Статистика по успешным категориям
        $successfulCategories = array_filter($result['categories'], function ($cat) {
            return $cat['parse_success'];
        });

        echo "Успешно спарсено категорий: " . count($successfulCategories) . "\n";

        $totalProducts = 0;
        foreach ($successfulCategories as $category) {
            $totalProducts += $category['total_products'] ?? 0;
        }
        echo "Всего товаров: " . $totalProducts . "\n";
    } else {
        echo "Ошибка при парсинге: " . $result['error'] . "\n";
    }


} catch (Exception $e) {
    echo "Критическая ошибка: " . $e->getMessage() . "\n";
}
