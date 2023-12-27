<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BlogRequest;
use App\Services\fileUploadService;

class BlogService
{
    public function __construct(protected FileUploadService $uploadService){

    }

    public function store(BlogRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'blog');
            $request['img'] = $img;
            Blog::create($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function getAll()
    {
        $model = Blog::get();
        return $model;
    }
    public function update(BlogRequest $request, Blog $model)
    {
        $request=$request->validated();
        try {
            DB::beginTransaction();
            if(isset($request["img"])){ 
                $img = $this->uploadService->replaceFile($request['img'],$model->img, 'blog');
                $request['img'] = $img;
            }
            $model->update($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function destroy(Blog $model)
    {
        $this->uploadService->removeFile($model->img);
        $model->delete();
    }
}
