<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Str;
class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $translatedAttributes = ['title', 'slug'];
    protected $fillable = ['status','img'];
    protected static function boot()
    {
        parent::boot();

        self::saving(function ($question) {
            foreach ($question->translations as $locale) {
                if (!$locale->slug) {
                    $locale->slug = Str::slug($locale->title);
                } else {
                    $locale->slug = Str::slug($locale->slug);
                }
            }
        });
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
