<?php

namespace App\Repositories;

use App\Contracts\ProductImgInterface;
use App\Models\ProductImg;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductImgRequest;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Redirect;
class ProductImgRepository implements ProductImgInterface
{
    public $model = ProductImg::class;
    public function __construct(protected FileUploadService $uploadService)
    {

    }
    public function get(Product $product)
    {
        try {
            DB::beginTransaction();
            $model = $this->model::where('product_id',$product->id)->get();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function store(ProductImgRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'ProductImg');
            $request['img'] = $img;
            $this->model::create($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function destroy(ProductImg $model)
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
