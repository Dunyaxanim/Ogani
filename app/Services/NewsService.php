<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Cache;


class NewsService
{
    public function __construct(protected FileUploadService $uploadService){

    }
    public function store(NewsRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'news');
            $request['img'] = $img;
            News::create($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function getAll()
    {
        $model = News::get();
        return $model;
    }
    public function update(NewsRequest $request, News $model)
    {
        $request=$request->validated();
        try {
            DB::beginTransaction();
                if(isset($request["img"])){ 
                $img = $this->uploadService->replaceFile($request['img'],$model->img, 'news');
                $request['img'] = $img;
            }
            $model->update($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function destroy(News $model)
    {
        $this->uploadService->removeFile($model->img);
        $model->delete();
    }
}
