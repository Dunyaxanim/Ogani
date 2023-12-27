<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Hero extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $translatedAttributes = ['title', 'description','content'];
    protected $fillable=['img','minor_img'];
}
