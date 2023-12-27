<?php

namespace App\Repositories;

use App\Contracts\MapInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MapRequest;
use App\Repositories\AbstractRepository\AbstractRepository;
use App\Models\Map;
use Illuminate\Support\Facades\Redirect;
class MapRepository implements MapInterface
{
    public $model = Map::class;
    
    public function get()
    {
        try {
            $model = $this->model::get();
            return $model;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function store(MapRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $this->model::create($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function update(MapRequest $request, Map $model)
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
    public function destroy(Map $model)
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
