<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Menu extends Model implements TranslatableContract
{
    use Translatable, HasFactory;
    public $timestamps = false;
    public array $translatedAttributes = ['title'];
    protected $fillable = ['url', 'parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
