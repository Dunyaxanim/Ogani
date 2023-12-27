<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Map extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $translatedAttributes = ['country', 'address'];
    
    protected $fillable = ['phone','link'];
}
