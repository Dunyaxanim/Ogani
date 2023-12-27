<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\UserInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\fileUploadService;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
class UserController extends Controller
{
    public function __construct(protected UserInterface $interface)
    {

    }
    public function index()
    {
        try {
            $data = $this->interface->get();
            return view('admin.pages.User.index', ['model' => $data]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function create()
    {
        return view('admin.pages.User.form');
    }
    public function store(UserRequest $request)
    {
        try {
            $this->interface->store($request);
            return redirect()->action('App\Http\Controllers\Auth\UserController@index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(User $data)
    {
        return view('admin.pages.User.form', ['model' => $data]);
    }
    public function update(UserUpdateRequest $request, User $model)
    {
        try {
            $this->interface->update($request, $model);
            return redirect()->action('App\Http\Controllers\Auth\UserController@index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    
}
