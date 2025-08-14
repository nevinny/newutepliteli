<?php

namespace App\Service\Product\Grouping;

use App\Interface\ParameterGroupingStrategyInterface;
use App\Service\Product\ParameterKeyMapper;

class PaintGrouping implements ParameterGroupingStrategyInterface
{
    public function __construct(private ParameterKeyMapper $mapper) {}

    public static function getPriority(): int {
        return 100;
    }

    public function supports(array $params): bool
    {
        $mapped = $this->mapper->mapArrayKeys($params);
        return isset($mapped['volume']);
    }

    public function group(array $params): array
    {
        $mapped = $this->mapper->mapArrayKeys($params);
        return [
            'type' => 'paint',
            'displayType' => 'Лакокрасочные материалы',
            'price' => 0,
            'oldPrice' => 0,
            'discount' => 0,
            'volume' => [
                'value' => $mapped['volume'],
                'label' => $this->mapper->getHumanReadableName('volume'),
            ],
            'color' => [
                'value' => $mapped['color'],
                'label' => $this->mapper->getHumanReadableName('color'),
            ] ?? []
        ];
    }

    public function sort(array $variants): array
    {
        usort($variants, function($a, $b) {
            // Сортировка по объему (по возрастанию)
            $volumeA = (float) preg_replace('/[^\d.]/', '', $a['volume']);
            $volumeB = (float) preg_replace('/[^\d.]/', '', $b['volume']);

            return $volumeA <=> $volumeB;
        });

        return $variants;
    }
}
