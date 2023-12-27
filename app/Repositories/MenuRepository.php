<?php

namespace App\Repositories;

use App\Contracts\MenuInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MenuRequest;
use App\Repositories\AbstractRepository\AbstractRepository;
use App\Models\Menu;
use Illuminate\Support\Facades\Redirect;
class MenuRepository implements MenuInterface
{
    public $model = Menu::class;
    
    public function get()
    {
        try {
            $model = $this->model::get();
            return $model;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function store(MenuRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            // dd($request);
            $this->model::create($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function update(MenuRequest $request, Menu $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $model->update($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Menu $model)
    {
        try {
            DB::beginTransaction();
            $model->delete();
            DB::commit();
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
}
