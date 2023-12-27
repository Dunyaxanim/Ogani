<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Blog extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    protected $translatedAttributes = ['title', 'description', 'slug'];
    protected $fillable = ['img'];

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('M d, Y');
    }
    protected static function boot()
    {
        parent::boot();
        self::saving(function ($question) {
            foreach ($question->translations as $data) {
                if (!$data->slug) {
                    $data->slug = Str::slug($data->title);
                }
            }
        });
    }
    
}
