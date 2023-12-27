<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','message'];
    public function getTimeAgoAttribute()
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        return $createdAt->diffForHumans();
    }
}
