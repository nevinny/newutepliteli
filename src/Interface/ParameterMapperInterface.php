<?php

namespace App\Interface;

use App\Entity\ProductVariant;

interface ParameterMapperInterface
{
    public function getSizeData(ProductVariant $variant): ?array;
}
