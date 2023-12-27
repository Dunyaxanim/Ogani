<?php

namespace App\Repositories;

use App\Contracts\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class CategoryRepository implements CategoryInterface
{
    protected $model = Category::class;
    public function __construct(protected fileUploadService $uploadService)
    {
    }

    public function store(CategoryRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'category');
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
        $model = Category::get();
        return $model;
    }
    public function update(CategoryRequest $request, Category $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if (isset($request["img"])) {
                $img = $this->uploadService->replaceFile($request['img'], $model->img, 'category');
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
    public function destroy(Category $model)
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
