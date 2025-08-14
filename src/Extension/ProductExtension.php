<?php

namespace App\Extension;

use App\Entity\Product;
use App\Entity\ProductVariant;
use App\Service\Product\ParameterGrouper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ProductExtension extends AbstractExtension
{
    public function __construct(private ParameterGrouper $parameterGrouper) {}

    public function getFilters(): array
    {
        return [
            new TwigFilter('product_grouped_parameters', [$this, 'getGroupedParameters']),
        ];
    }

    public function getGroupedParameters(Product $product): array
    {
        $result = [];

        foreach ($product->getVariants() as $variant) {
            $params = $this->extractRawParameters($variant);
            $grouped = $this->parameterGrouper->group($params);
            $grouped['price'] = $variant->getPrice();
//            dd($grouped);
            $grouped['variantId'] = $variant->getId();
            $result[] = $grouped;
        }
//        dd($result);
        return $result;
    }

    private function extractRawParameters($variant): array
    {
        $result = [];
        foreach ($variant->getParams() as $param) {
            if ($externalId = $param->getExternalId()) {
                $result[$externalId] = $param->getVal();
            }
        }
        return $result;
    }
}
