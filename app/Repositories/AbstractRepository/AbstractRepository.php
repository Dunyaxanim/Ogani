<?php

namespace App\Repositories\AbstractRepository;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;

abstract class AbstractRepository
{
    public $model;
    public function __construct()
    {
        if (!$this->model) {
            throw new \Error("model class not defined");
        }
    }
    public function getAll()
    {
        try {
            $model = $this->model::get();
            return $model;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function create($request)
    {
        try {
            DB::beginTransaction();
            $this->model::create($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function edit($request, $model)
    {
        try {
            DB::beginTransaction();
            $model->update($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function delete($model)
    {
        try {
            DB::beginTransaction();
            $model->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
