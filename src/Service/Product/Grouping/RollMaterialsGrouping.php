<?php

namespace App\Service\Product\Grouping;

use App\Interface\ParameterGroupingStrategyInterface;
use App\Service\Product\ParameterKeyMapper;

class RollMaterialsGrouping implements ParameterGroupingStrategyInterface
{
    public function __construct(private ParameterKeyMapper $mapper) {}

    public static function getPriority(): int { return 100; }

    public function supports(array $params): bool
    {
        $mapped = $this->mapper->mapArrayKeys($params);
        return isset($mapped['baseMaterial'], $mapped['coatingMaterial']);
    }

    public function group(array $params): array
    {

        $mapped = $this->mapper->mapArrayKeys($params);

        return [
            'type' => 'roll',
            'displayType' => 'Рулонные материалы',
            'price' => 0,
            'oldPrice' => 0,
            'discount' => 0,
            'baseMaterial' => [
                'value' => $mapped['baseMaterial'],
                'label' => $this->mapper->getHumanReadableName('baseMaterial'),
            ],
            'coatingMaterial' => [
                'value' => $mapped['coatingMaterial'],
                'label' => $this->mapper->getHumanReadableName('coatingMaterial'),
            ],
            'area' => [
                'value' => $mapped['area'],
                'label' => $this->mapper->getHumanReadableName('area'),
            ] ?? []
        ];
    }

    public function sort(array $variants): array
    {
        usort($variants, function($a, $b) {
            // Сортировка по площади (по убыванию)
            $areaA = (float) preg_replace('/[^\d.]/', '', $a['area'] ?? '0');
            $areaB = (float) preg_replace('/[^\d.]/', '', $b['area'] ?? '0');

            return $areaB <=> $areaA;
        });

        return $variants;
    }
}
