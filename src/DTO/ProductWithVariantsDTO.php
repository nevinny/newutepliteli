<?php

namespace App\DTO;

class ProductWithVariantsDTO
{
    public function __construct(
        public readonly array $product,
        public readonly array $variants = []
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            product: $data['product'],
            variants: $data['variants'] ?? []
        );
    }

    public function hasVariants(): bool
    {
        return !empty($this->variants);
    }

    public function getVariantOptions(): array
    {
        return array_map(function ($variantData) {
            $variant = $variantData['variant'];
            $params = $variantData['params'];

            return [
                'id' => $variant->getId(),
                'name' => $this->buildVariantName($params),
                'color' => $this->extractColor($params),
                'price' => $variant->getPrice(),
                'url' => $variant->getUrl(),
            ];
        }, $this->variants);
    }

    // Магические методы для доступа к данным продукта
    public function __get(string $name)
    {
        if ($name === 'product') {
            return $this->product;
        }
        if ($name === 'variants') {
            return $this->variants;
        }
        if ($name === 'hasVariants') {
            return $this->hasVariants();
        }

        return null;
    }

    public function __isset(string $name): bool
    {
        return in_array($name, ['product', 'variants', 'hasVariants']);
    }

    public function jsonSerialize(): array
    {
        return [
            'product' => $this->product,
            'variants' => $this->variants,
            'hasVariants' => $this->hasVariants()
        ];
    }

    private function buildVariantName(array $params): string
    {
        // Логика построения названия варианта из параметров
        return implode(', ', array_map(
            fn($param) => $param->getVal(),
            $params
        ));
    }

    private function extractColor(array $params): ?string
    {
        foreach ($params as $param) {
            if ($param->getExternalId() === 'ral' || $param->getTitle() === 'Цвет') {
                return $this->convertToColor($param->getVal());
            }
        }
        return null;
    }
}
