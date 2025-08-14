<?php

namespace App\Service\Product;

use App\Interface\ParameterGroupingStrategyInterface;

class ParameterGrouper
{
    /** @var ParameterGroupingStrategyInterface[] */
    private array $strategies;

    public function __construct(iterable $strategies)
    {
        $this->strategies = $strategies instanceof \Traversable
            ? iterator_to_array($strategies)
            : (array)$strategies;
        $this->strategies = $this->sortStrategies($this->strategies);
    }

    private function sortStrategies(iterable $strategies): array
    {
        $strategiesArray = $strategies instanceof \Traversable ?
            iterator_to_array($strategies) :
            (array)$strategies;

        usort($strategiesArray, function ($a, $b) {
            return $b::getPriority() <=> $a::getPriority();
        });


        return $strategiesArray;
    }

    public function group(array $params): array
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($params)) {
                return $strategy->group($params);
            }
        }

        throw new \RuntimeException('No suitable grouping strategy found');
    }


}

