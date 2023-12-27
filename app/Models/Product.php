<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Category;
use App\Models\Measurement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Favory;
use App\Models\Raiting;
class Product extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $translatedAttributes=['title','description','slug'];
    protected $fillable=['stock','discount_price','price','category_id','img','status','weight','total', 'measurement_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }
    protected static function boot()
    {
        
        parent::boot();
        self::saving(function ($question) {
            foreach ($question->translations as $locale) {
                if (!$locale->slug) {
                    $locale->slug = Str::slug($locale->title);
                }else{
                    $locale->slug = Str::slug($locale->slug);
                }
            }
            if ($question->discount_price !=null || $question->discount_price ==0) {
                $question->total = $question->price - (($question->price * $question->discount_price) / 100);
            }else{
                $question->total = $question->price;
            }
        });
    }

    public function favory(){
        if(Auth::check()){
            $user = Auth::user()->id;
            $favories =  $this->hasMany(Favory::class);
            return $user;
        }
    }
    public function wishlist()
    {
        if(Auth::check()){
            $id = Auth::user()->id;
            $favories =  $this->hasMany(Favory::class)->where('user_id',$id);
            return $favories;
        }
    }
    public function favorites()
    {
        return $this->hasMany(Favory::class);
    }
    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }
     public function raitings()
    {
        return $this->hasMany(Raiting::class);
    }
}