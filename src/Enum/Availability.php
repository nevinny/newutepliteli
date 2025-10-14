<?php

namespace App\Enum;

enum Availability: string
{
    case InStock = 'in stock';
    case PreOrder = 'preorder';
    case Transit = 'transit';
    case PreSale = 'presale';
    case LimitedAvailability = 'limited';
    case OutOfStock = 'out of stock';
    case Discontinued = 'discontinued';

    public function schemaUrl(): string
    {
        return match ($this) {
            self::InStock => 'https://schema.org/InStock',
            self::PreOrder => 'https://schema.org/PreOrder',
            self::Transit => 'https://schema.org/BackOrder',
            self::PreSale => 'https://schema.org/PreSale',
            self::LimitedAvailability => 'https://schema.org/LimitedAvailability',
            self::OutOfStock => 'https://schema.org/OutOfStock',
            self::Discontinued => 'https://schema.org/Discontinued',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function choices(): array
    {
        return array_combine(
            array_map(fn(self $case) => $case->value, self::cases()),
            self::cases()
        );
    }

    public static function fromApiValue(?string $apiValue): ?self
    {
        if ($apiValue === null) {
            return null;
        }

        $mapping = [
            'OutOfStock' => self::OutOfStock,
            'InStock' => self::InStock,
            'PreOrder' => self::PreOrder,
            'Transit' => self::Transit,
            'PreSale' => self::PreSale,
            'LimitedAvailability' => self::LimitedAvailability,
            'Discontinued' => self::Discontinued,
        ];

        return $mapping[$apiValue] ?? self::PreOrder;
    }
}
