<?php

namespace App\Interface;

interface VariantRepositoryInterface
{
    public function findByProductIds(array $productIds): array;

    public function findActiveByProductId(int $productId): array;
}
