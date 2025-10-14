<?php

namespace App\Service\Product\Grouping;

use App\Interface\ParameterGroupingStrategyInterface;
use App\Service\Product\ParameterKeyMapper;

class PlateMaterialsGrouping implements ParameterGroupingStrategyInterface
{
    public function __construct(private ParameterKeyMapper $mapper) {}

    public static function getPriority(): int
    {
        return 100; // Высший приоритет
    }

    public function supports(array $params): bool
    {
        $mapped = $this->mapper->mapArrayKeys($params);
        return isset($mapped['thickness'], $mapped['width'], $mapped['length']);
    }

    public function group(array $params): array
    {
        $mapped = $this->mapper->mapArrayKeys($params);

        return [
            'type' => 'plate',
            'displayType' => 'Плитные материалы',
            'price' => 0,
            'oldPrice' => 0,
            'discount' => 0,
            'thickness' => [
                'value' => $mapped['thickness'],
                'label' => $this->mapper->getHumanReadableName('thickness'),
            ],
            'size' => [
                'value' => $mapped['width'] . ' × ' . $mapped['length'],
                'label' => 'Размер',
            ],
            'packageQty' => [
                'value' => $mapped['packageQty'] ?? null,
                'label' => $this->mapper->getHumanReadableName('packageQty'),
            ],
            'packageType' => [
                'value' => $mapped['packageType'] ?? null,
                'label' => $this->mapper->getHumanReadableName('packageType'),
            ],
            'raw' => $mapped, // Все параметры
        ];
    }
    public function sort(array $variants): array
    {
        usort($variants, function($a, $b) {
            // Сортировка по толщине (по возрастанию)
            $thicknessA = (float) preg_replace('/[^\d.]/', '', $a['thickness']);
            $thicknessB = (float) preg_replace('/[^\d.]/', '', $b['thickness']);

            return $thicknessA <=> $thicknessB;
        });

        return $variants;
    }
}
