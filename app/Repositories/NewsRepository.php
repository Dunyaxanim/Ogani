<?php

namespace App\Repositories;

use App\Contracts\NewsInterface;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Cache;


class NewsRepository implements NewsInterface
{
    protected $model = News::class;
    public function __construct(protected FileUploadService $uploadService)
    {
    }
    public function store(NewsRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'news');
            $request['img'] = $img;
            $this->model::create($request);
            DB::commit();
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
    public function update(NewsRequest $request, News $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if (isset($request["img"])) {
                $img = $this->uploadService->replaceFile($request['img'], $model->img, 'news');
                $request['img'] = $img;
            }
            $model->update($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(News $model)
    {
        try {
            DB::beginTransaction();
            $this->uploadService->removeFile($model->img);
            $model->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
        
    }
}
