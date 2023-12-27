<?php

namespace App\Repositories;

use App\Contracts\MeasurementInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MeasurementRequest;
use App\Repositories\AbstractRepository\AbstractRepository;
use App\Models\Measurement;
use Illuminate\Support\Facades\Redirect;
class MeasurementRepository implements MeasurementInterface
{
    public $model = Measurement::class;
    
    public function get()
    {
        try {
            $model = $this->model::get();
            return $model;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function store(MeasurementRequest $request)
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
    public function update(MeasurementRequest $request, Measurement $model)
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
    public function destroy(Measurement $model)
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
