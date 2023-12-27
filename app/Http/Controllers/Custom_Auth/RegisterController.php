<?php

namespace App\Http\Controllers\Custom_Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(){
        return view('custom_auth.register');
    }
    public function registerPost(Request $userRequest){
        $userRequest = $userRequest->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'type' => ['nullable'],
        ]);
        
        User::create($userRequest);

        return redirect()->action('App\Http\Controllers\Custom_Auth\LoginController@login');
    }



}
