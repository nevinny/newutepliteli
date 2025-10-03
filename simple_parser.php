<?php

class ProductParser
{
    private $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36';

    public function parseProducts($url)
    {
        try {
            // Получаем HTML страницы
            $html = $this->fetchUrl($url);
            if (!$html) {
                throw new Exception("Не удалось загрузить страницу");
            }

            // Создаем DOM документ
            $dom = new DOMDocument();
            @$dom->loadHTML($html);

            // Создаем XPath
            $xpath = new DOMXPath($dom);

            // Регистрируем пространство имен schema.org
            $xpath->registerNamespace('schema', 'http://schema.org/');

            // Ищем все элементы с микроразметкой Product
            $products = $xpath->query("//*[@itemtype='http://schema.org/Product']");

            $result = [];

            foreach ($products as $product) {
                $productData = $this->extractProductData($xpath, $product);
                if ($productData) {
                    $result[] = $productData;
                }
            }

            return $result;

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function fetchUrl($url)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => $this->userAgent,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }

        return $response;
    }

    private function extractProductData($xpath, $productNode)
    {
        $data = [
            'name' => $this->getNodeValue($xpath, ".//*[@itemprop='name']", $productNode),
            'description' => $this->getNodeValue($xpath, ".//*[@itemprop='description']", $productNode),
            'price' => $this->getNodeValue($xpath, ".//*[@itemprop='price']", $productNode),
            'priceCurrency' => $this->getNodeValue($xpath, ".//*[@itemprop='priceCurrency']", $productNode),
            'image' => $this->getNodeAttribute($xpath, ".//*[@itemprop='image']", 'src', $productNode),
            'availability' => $this->getNodeValue($xpath, ".//*[@itemprop='availability']", $productNode),
            'sku' => $this->getNodeValue($xpath, ".//*[@itemprop='sku']", $productNode),
            'url' => $this->getNodeAttribute($xpath, ".//*[@itemprop='url']", 'href', $productNode)
        ];

        // Если не нашли через itemprop, пробуем альтернативные способы
        if (empty($data['name'])) {
            $data['name'] = $this->getNodeValue($xpath, ".//h1|.//h2|.//h3", $productNode);
        }

        if (empty($data['price'])) {
            $data['price'] = $this->extractPrice($xpath, $productNode);
        }

        if (empty($data['image'])) {
            $data['image'] = $this->getNodeAttribute($xpath, ".//img", 'src', $productNode);
        }

        // Очищаем данные
        foreach ($data as $key => $value) {
            $data[$key] = $this->cleanData($value);
        }

        return array_filter($data); // Убираем пустые значения
    }

    private function getNodeValue($xpath, $query, $contextNode = null)
    {
        $nodes = $xpath->query($query, $contextNode);
        if ($nodes->length > 0) {
            return $nodes->item(0)->nodeValue;
        }
        return null;
    }

    private function getNodeAttribute($xpath, $query, $attribute, $contextNode = null)
    {
        $nodes = $xpath->query($query, $contextNode);
        if ($nodes->length > 0 && $nodes->item(0)->hasAttribute($attribute)) {
            return $nodes->item(0)->getAttribute($attribute);
        }
        return null;
    }

    private function extractPrice($xpath, $productNode)
    {
        // Пробуем разные селекторы для цены
        $priceSelectors = [
            ".//*[contains(@class, 'price')]",
            ".//*[contains(@class, 'cost')]",
            ".//*[contains(@class, 'sum')]",
            ".//*[contains(text(), '₽') or contains(text(), 'руб')]"
        ];

        foreach ($priceSelectors as $selector) {
            $price = $this->getNodeValue($xpath, $selector, $productNode);
            if ($price && preg_match('/[\d\s,\.]+/', $price)) {
                return $price;
            }
        }

        return null;
    }

    private function cleanData($data)
    {
        if (!$data) return null;

        $data = trim($data);
        $data = preg_replace('/\s+/', ' ', $data); // Убираем лишние пробелы
        $data = html_entity_decode($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return $data;
    }
}

// Пример использования
$parser = new ProductParser();

// URL для парсинга
$url = "https://shop.tn.ru/gidroizoljacija?lazy=1&p=2";

// Парсим товары
$products = $parser->parseProducts($url);

// Выводим результат
echo "<pre>";
print_r($products);
echo "</pre>";

// Сохраняем в JSON файл
file_put_contents('products.json', json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Данные сохранены в products.json\n";
