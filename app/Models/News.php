<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    protected $translatedAttributes = ['title', 'description'];
    protected $fillable=['img'];

      public function getCreatedAtAttribute($date)
      {
          return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('M d, Y');
      }
}
