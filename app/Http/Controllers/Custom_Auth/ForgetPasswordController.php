<?php

namespace App\Http\Controllers\Custom_Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function index()
    {
        return view('custom_auth.password.index');
    }
    public function forgotPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);


        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('custom_auth.emails.forgot-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });
        return redirect()->to(route('forgot-password'))->with("success", "meil gonderdik");
    }

    public function resetPassword($token)
    {
        return view('custom_auth.password.reset-password', ['token' => [$token]]);
    }
    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        $updatePassword = DB::table('password_resets')
            ->where([
                "token" => $request->token,
            ])->first();
         
        if (!$updatePassword) {

            return redirect()->to(route('reset-password'))->with("error", "Invalid");
        }
        $user = User::where('email', $updatePassword->email);
        $user->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('token', $request->token)->delete();
        return view('custom_auth.login');
    }
}
