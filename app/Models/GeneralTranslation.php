<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralTranslation extends Model
{
    use HasFactory;
    protected $fillable=['address','title','company_name'];
}
