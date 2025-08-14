<?php

namespace App\Interface;

interface ParameterGroupingStrategyInterface
{
    public function supports(array $params): bool;
    public function group(array $params): array;
    public static function getPriority(): int;
}
