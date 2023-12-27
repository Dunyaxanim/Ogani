<?php

namespace App\Repositories;

use App\Contracts\ReviewInterface;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Cache;


class ReviewRepository implements ReviewInterface
{
    protected $model = Review::class;
    public function __construct(protected FileUploadService $uploadService)
    {
    }
    public function store(ReviewRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
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
    public function update(ReviewRequest $request, Review $model)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            if (isset($request["img"])) {
                $img = $this->uploadService->replaceFile($request['img'], $model->img, 'Review');
                $request['img'] = $img;
            }
            $model->update($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Review $model)
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
