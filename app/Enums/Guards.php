<?php

namespace App\Enums;

enum Guards: string
{
    case user = '0';
    case admin = '1';
    case superadmin = '2';

    public static function toArray(): array
    {
        return array_column(array_values(self::cases()), 'value');
    }
    
}
