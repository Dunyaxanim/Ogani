<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCotroller extends Controller
{
    public function createToken(){
        $user = User::find(1);
        $token = $user->createToken('TokenName')->accessToken;
        dd($token);
    }
}
