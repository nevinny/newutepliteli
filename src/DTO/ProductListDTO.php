<?php

namespace App\DTO;

class ProductListDTO
{
    public function __construct(
        public readonly object $category,
        public readonly array  $productsWithVariants
    )
    {
    }

    public function getCategory(): object
    {
        return $this->category;
    }

    public function getProductsWithVariants(): array
    {
        return $this->productsWithVariants;
    }

    public function getProductCount(): int
    {
        return count($this->productsWithVariants);
    }

    public function hasProducts(): bool
    {
        return $this->getProductCount() > 0;
    }
}
