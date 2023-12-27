<?php

namespace App\Enums;

enum OrderStatus : int
{
    case PROCESS = 1;
    case PAYED = 2;

    public static function toArray(): array
    {
         return array_column(array_values(self::cases()),'value');
    }
}
