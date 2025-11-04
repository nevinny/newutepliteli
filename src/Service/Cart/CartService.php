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
    )
    {
    }

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

    public function getTotal(): float
    {
        $items = $this->getItems();
//        dd($items);
        $variants = $this->variantRepo->findBy(['id' => array_keys($items)]);
        $total = 0;
        $log = [];
        foreach ($variants as $variant) {
            $total += $variant->getPrice() * max(1, $items[$variant->getId()]);
            $log[] = [
                'id' => $variant->getId(),
//                'name' => $variant->getName(),
                'price' => $variant->getPrice(),
                'quantity' => max(1, $items[$variant->getId()]),
                'itogo' => $variant->getPrice() * max(1, $items[$variant->getId()]),

            ];
//            dump($variant->getPrice() * max(1,$items[$variant->getId()]));
        }
//        dd($log);
        return max(0, $total);
    }

    public function getCount(): int
    {
        return count($this->getItems());
    }

    public function getPositionCount(): int
    {
        $count = 0;
        foreach ($this->getItems() as $cnt) {
            $count += $cnt;
        }
        return $count;
    }

    public function update(int $variantId, mixed $quantity): void
    {
        $cart = $this->getItems();
        if (array_key_exists($variantId, $cart)) {
            $this->getStorage()->updateItem($variantId, $quantity);
        }
    }
}
