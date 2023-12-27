<?php

namespace App\Repositories;

use App\Contracts\BlogInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BlogRequest;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Redirect;
class BlogRepository implements BlogInterface
{
    public $model = Blog::class;
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
    public function store(BlogRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'blog');
            $request['img'] = $img;
            $this->model::create($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function update(BlogRequest $request, Blog $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if (isset($request["img"])) {
                $img = $this->uploadService->replaceFile($request['img'], $model->img, 'blog');
                $request['img'] = $img;
            }
            $model->update($request);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function destroy(Blog $model)
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
