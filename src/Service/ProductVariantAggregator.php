<?php

namespace App\Service;

use App\DTO\ProductWithVariantsDTO;
use App\Entity\ProductVariant;
use App\Enum\Statuses;
use App\Repository\ProductParamsRepository;
use App\Repository\ProductVariantRepository;
use App\Service\Product\ParameterKeyMapper;

class ProductVariantAggregator
{
    public function __construct(
        private ProductVariantRepository $variantRepository,
        private ProductParamsRepository $paramsRepository,
        private ParameterKeyMapper      $parameterKeyMapper,
    )
    {
    }

    public function enrichProductsWithVariants(array $products): array
    {
        $productIds = array_column($products, 'p_id');
        $variants = $this->variantRepository->findBy([
            'product' => $productIds,
            'status' => Statuses::Active,
        ]);

        return array_map(function ($product) use ($variants) {
            return $this->enrichProduct($product, $variants);
        }, $products);
    }


    private function loadParamsForVariants(array $variants): array
    {
        $variantIds = array_map(fn($v) => $v->getId(), $variants);
        $params = $this->paramsRepository->findBy([
            'variant' => $variantIds,
            'status' => Statuses::Active,
        ]);

        return array_map(function ($variant) use ($params) {
            return [
                'variant' => $variant,
                'params' => array_filter($params,
                    fn($p) => $p->getVariant()->getId() === $variant->getId()
                )
            ];
        }, $variants);
    }

    private function enrichProduct(array $product, array $variants): array
    {
        $productVariants = array_filter($variants,
            fn($variant) => $variant->getProduct()->getId() === $product['p_id']
        );

        $variantsWithParams = $this->loadParamsForVariants($productVariants);
        $variantOptions = $this->buildVariantOptions($variantsWithParams);

        return [
            'product' => $product,
            'variants' => $variantOptions,
            'hasVariants' => !empty($variantOptions)
        ];
    }

    private function buildVariantOptions(array $variantsWithParams): array
    {
        return array_map(function ($variantData) {
            $variant = $variantData['variant'];
            $params = $variantData['params'];

            return [
                'id' => $variant->getId(),
                'name' => $this->buildVariantName($params),
                'color' => $this->extractByParamKey($params, 'ral', 'convertToColor'),
                'price' => $variant->getPrice(),
                'thickness' => $this->extractByParamKey($params, 'thickness'),
                'diameter' => $this->extractByParamKey($params, 'diameter'),
//                'url' => $variant->getUrl(),
            ];
        }, $variantsWithParams);
    }

    private function buildVariantName(array $params): string
    {
        return implode(', ', array_map(
            fn($param) => $param->getVal(),
            $params
        ));
    }

    private function extractByParamKey(array $params, $key, $callback = null): ?string
    {
        $possibleVariants = [
            $this->parameterKeyMapper->getExternalIdByKey($key)
        ];
        foreach ($params as $param) {
            if (in_array($param->getExternalId(), $possibleVariants)) {
                if (null !== $callback) {
                    return $this->$callback($param->getVal());
                }
                return $param->getVal();
            }
        }
        return null;
    }

    private function convertToColor(string $colorValue): string
    {
        // Простая конвертация RAL в цвет (упрощенная)
        $colorMap = [
            '8017' => '#2F1B0C',
            '3005' => '#6D3427',
            '9005' => '#0A0A0A',
            '6020' => '#354733',
            '7024' => '#474A50',
            '3009' => '#6C332B',
            '9003' => '#ECECE7',
        ];

        return $colorMap[$colorValue] ?? '#CCCCCC';
    }
}
