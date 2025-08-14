<?php

namespace App\Interface;

interface CartStorageInterface
{
    public function getItems(): array;

    public function addItem(int $variantId, int $quantity): void;

    public function removeItem(int $variantId): void;

    public function clear(): void;

    public function hasItem(int $variantId): bool;
}
