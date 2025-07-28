<?php

namespace App\Enum;

enum Statuses: string
{
    case Active = 'active';
    case Disabled = 'disabled';
    case Deleted = 'deleted';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function choices(): array
    {
        return array_combine(
            array_map(fn(self $case) => $case->name, self::cases()),
            self::cases()
        );
    }
}


