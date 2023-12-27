<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['country', 'address'];
}
