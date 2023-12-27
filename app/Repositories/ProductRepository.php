<?php

namespace App\Repositories;

use App\Contracts\ProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ProductRepository implements ProductInterface
{
    public $model = Product::class;
    public function __construct(protected FileUploadService $uploadService)
    {

    }
    public function store(ProductRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if ($request["discount_price"] != null && $request["discount_price"]==0) {
                $total = $request["price"] - (($request["price"] * $request["discount_price"]) / 100);
                if ($total <= 0) {
                    return Redirect::back();
                }
            }
            $img = $this->uploadService->uploadFile($request['img'], 'product');
            $request['img'] = $img;
            $this->model::create($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function get()
    {
        $model = $this->model::get();
        return $model;
    }
    public function getWith($with)
    {
        $model = $this->model::with($with)->get();
        return $model;
    }
    public function update(ProductRequest $request, Product $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if (isset($request["img"])) {
                $img = $this->uploadService->replaceFile($request['img'], $model->img, 'product');
                $request['img'] = $img;
            }
            if ($request["discount_price"] != null && $request["discount_price"] == 0) {
                $total = $request["price"] - (($request["price"] * $request["discount_price"]) / 100);
                if ($total <= 0) {
                    return Redirect::back();
                }
            }
            $model->update($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Product $model)
    {
        try {
            DB::beginTransaction();
            $this->uploadService->removeFile($model->img);
            $model->delete();
            DB::commit();
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
        
    }
}
