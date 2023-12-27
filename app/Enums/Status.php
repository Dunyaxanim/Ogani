<?php

namespace App\Enums;

enum Status:string{
    case true="1";
    case false="0";

    public static function toArray(): array
    {
         return array_column(array_values(self::cases()),'value');
    }
}
?>