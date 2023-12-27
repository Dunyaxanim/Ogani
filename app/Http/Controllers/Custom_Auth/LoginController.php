<?php

namespace App\Http\Controllers\Custom_Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function login(){
        return view('custom_auth.login');
    }
    public function loginPost(Request $request){
        $request->validate([
            "email"=>"required|email|exists:users,email",
            "password"=>"required",
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if(Auth::attempt($credentials, $remember)){
            return redirect()->intended(route('home'));
        }
        return redirect()->back()->with('error', 'Login details not valid.');
    }
}
