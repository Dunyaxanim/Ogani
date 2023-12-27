<?php

namespace App\Repositories;

use App\Contracts\OrderInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class OrderRepository implements OrderInterface
{
    protected $model = Order::class;
    public function __construct(protected fileUploadService $uploadService)
    {
        
    }

    public function store(OrderRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'Order');
            $request['img'] = $img;
            $this->model::create($request);
            Cache::rememberForever('categories', function () {
                return $this->model::all();
            });
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function get()
    {
        $model = Order::get();
        return $model;
    }
    public function update(OrderRequest $request, Order $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if (isset($request["img"])) {
                $img = $this->uploadService->replaceFile($request['img'], $model->img, 'Order');
                $request['img'] = $img;
            }
            $model->update($request);
            Cache::rememberForever('categories', function () {
                return $this->model::all();
            });
            DB::commit();
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function destroy(Order $model)
    {
        try {
            $model->delete();
            Cache::rememberForever('categories', function () {
                return $this->model::all();
            });
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
