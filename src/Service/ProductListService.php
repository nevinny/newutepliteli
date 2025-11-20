<?php

namespace App\Service;

use App\DTO\ProductListDTO;
use App\Enum\Statuses;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;

class ProductListService
{
    public function __construct(
        private CategoryRepository       $categoryRepository,
        private ProductRepository        $productRepository,
        private ProductVariantAggregator $variantAggregator
    )
    {
    }

    public function getProductsForCategory(int $categoryId): ProductListDTO
    {
        $category = $this->categoryRepository->findOneBy(['id' => $categoryId]);
//        dd($category);
        $products = $this->productRepository->findBy([
            'parent' => $category->getId(),
            'status' => Statuses::Active
        ]);

        $productsWithVariants = $this->variantAggregator->enrichProductsWithVariants($products);

        return new ProductListDTO((object)$category, $productsWithVariants);
    }
}
