<?php

namespace App\Repositories;

use App\Contracts\GeneralInterface;
use App\Http\Requests\GeneralRequest;
use App\Repositories\AbstractRepository\AbstractRepository;
use App\Models\General;
use Illuminate\Support\Facades\Redirect;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\DB;
class GeneralRepository extends AbstractRepository implements GeneralInterface
{
    public $model = General::class;
    public function __construct(protected FileUploadService $uploadService)
    {
        
    }
    public function get()
    {
        try {
            DB::beginTransaction();
            $model = $this->model::get();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function store(GeneralRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['logo_img'], 'general');
            $request['logo_img'] = $img;
            $this->model::create($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function update(GeneralRequest $request, General $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if (isset($request["logo_img"])) {
                $img = $this->uploadService->replaceFile($request['logo_img'], $model->logo_img, 'general');
                $request['logo_img'] = $img;
            }
            if ($request["open_time"] == null) {
                $openTime = General::where('email', $request["email"])->get("open_time")->toArray();
                $request['open_time'] = $openTime[0]["open_time"];
            }
            $model->update($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(General $model)
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
