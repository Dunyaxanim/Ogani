<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $translatedAttributes=['address','title','company_name'];
    protected $fillable=['email','phone','logo_img','open_time','shipping_price'];

   
}