<?php

namespace App\Service\Cart;

use App\Interface\CartStorageInterface;
use App\Repository\ProductVariantRepository;

class CartService
{
    private CartStorageInterface $storage;

    public function __construct(
        private CartStorageResolver $resolver,
        private ProductVariantRepository $variantRepo
    ) {}

    public function getStorage(): CartStorageInterface
    {
        return $this->resolver->resolve();
    }

    public function addVariant(int $variantId, int $quantity = 1): void
    {
        if (!$this->variantRepo->find($variantId)) {
            throw new \InvalidArgumentException('Invalid variant ID');
        }

        $this->storage->addItem($variantId, $quantity);
    }

    public function getItems(): array
    {
        return $this->getStorage()->getItems();
    }

    public function removeVariant(int $variantId): void
    {
        $this->getStorage()->removeItem($variantId);
    }

    public function clearCart(): void
    {
        $this->getStorage()->clear();
    }

    public function add(int $variantId, int $quantity = 1): void
    {
        $this->getStorage()->addItem($variantId, $quantity);
    }
}
