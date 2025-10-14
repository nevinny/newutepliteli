<?php

namespace App\Extension;

use App\Entity\Product;
use App\Entity\ProductVariant;
use App\Enum\Statuses;
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
            if ($variant->getStatus() == Statuses::Active) {
                $params = $this->extractRawParameters($variant);
                $grouped = $this->parameterGrouper->group($params);
//                dd($grouped);
                $grouped['price'] = $variant->getPrice();
                $grouped['variantId'] = $variant->getId();
                $result[] = $grouped;
            }
        }
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
