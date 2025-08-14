<?php

namespace App\Service\Product\Grouping;

use App\Interface\ParameterGroupingStrategyInterface;
use App\Service\Product\ParameterKeyMapper;

class DefaultGrouping implements ParameterGroupingStrategyInterface
{
    public function __construct(private ParameterKeyMapper $mapper) {}

    public static function getPriority(): int
    {
        return -100; // Высший приоритет
    }

    public function supports(array $params): bool
    {
        return true;
    }

    public function group(array $params): array
    {
        $mapped = $this->mapper->mapArrayKeys($params);
        $result = [
            'type' => 'list',
            'price' => 0,
            'oldPrice' => 0,
            'discount' => 0,
            'displayType' => 'Общие параметры',
            'params' => [],
            'raw' => $mapped,
        ];

        foreach ($mapped as $key => $value) {
            $label = $this->mapper->getHumanReadableName($key) ?? $key;
            $result['params'][] = [
                'key' => $key,
                'label' => $label,
                'value' => $value,
            ];
        }

        return $result;
    }
}
