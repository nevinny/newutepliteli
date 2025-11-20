<?php

namespace App\Interface;

interface ProductRepositoryInterface
{
    public function findActiveByParent(int $parentId): array;

    public function findActiveById(int $id): ?array;
}
