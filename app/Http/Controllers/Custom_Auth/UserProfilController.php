<?php

namespace App\Http\Controllers\Custom_Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateProfilRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Services\fileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class UserProfilController extends Controller
{
    public function __construct(protected FileUploadService $uploadService)
    {
    }
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('custom_auth.profil', ['user' => $user]);
        } else {
            redirect()->back();
        }
    }
    public function update(UserUpdateProfilRequest $request, User $user)
    {
        if (isset($request["img"])) {
            $request->validate(['img' => "image"]);
            $img = $this->uploadService->replaceFile($request['img'], $user->img, 'user');
            $request['img'] = $img;
        }
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $user->name = $request['name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            if (isset($img)) {
                $user->img = $img;
            }
            $user->updated_at = Carbon::now();
            $user->save();
            DB::commit();
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function removePhoto(User $user)
    {
        try {
            DB::beginTransaction();
            $this->uploadService->removeFile($user->img);
            $user->img = null;
            $user->save();
            DB::commit();
            return redirect()->action('App\Http\Controllers\Custom_Auth\UserProfilController@index')->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('custom_auth.emails.change-password', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject("Reset Password");
            });
            return redirect()->to(route('profil'))->with("message", "tesdiq maili gonderdik");
        }else{
            Redirect::back();
        }
    }
    public function changePassword($token)
    {
        return view('custom_auth.password.password-change', ['token' => [$token]]);
    }
}
