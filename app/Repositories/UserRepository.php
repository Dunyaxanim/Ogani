<?php

namespace App\Repositories;;

use App\Contracts\UserInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\AbstractRepository\AbstractRepository;;
use App\Services\UserService;
use App\Models\User;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AbstractRepository implements UserInterface
{
    public $model = User::class;
    public function __construct(protected FileUploadService $uploadService)
    {

    }

    public function get()
    {
        try {
            $model = $this->getAll();
            return $model;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function store(UserRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $request['password'] = Hash::make($request['password']);
            $this->model::create($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function update(UserUpdateRequest $request, User $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $model->update($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(User $model)
    {
        try {
            DB::beginTransaction();
            $model->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
}
