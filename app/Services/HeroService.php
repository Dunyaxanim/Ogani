<?php

namespace App\Services;

use App\Models\Hero;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HeroRequest;
use Illuminate\Http\Request;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\Cache;


class HeroService
{
    public function __construct(protected FileUploadService $uploadService){

    }
    public function store(HeroRequest $request)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            $img = $this->uploadService->uploadFile($request['img'], 'hero');
            $request['img'] = $img;
            $minor_img = $this->uploadService->uploadFile($request['minor_img'], 'hero');
            $request['minor_img'] = $minor_img;
            Hero::create($request);
            Cache::rememberForever('hero',function(){
                return Hero::all();
            });
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function getAll()
    {
        $model = Hero::get();
        return $model;
    }
    public function update(HeroRequest $request, Hero $model)
    {
        $request=$request->validated();
        try {
            DB::beginTransaction();
                if(isset($request["img"])){ 
                $img = $this->uploadService->replaceFile($request['img'],$model->img, 'hero');
                $request['img'] = $img;
            }
             if(isset($request["minor_img"])){ 
                $minor_img = $this->uploadService->replaceFile($request['minor_img'],$model->minor_img, 'hero');
                $request['minor_img'] = $minor_img;
            }
            $model->update($request);
            Cache::rememberForever('hero',function(){
                return Hero::all();
            });
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function destroy(Hero $model)
    {
        $this->uploadService->removeFile($model->img);
        $this->uploadService->removeFile($model->minor_img);
        $model->delete();
        Cache::rememberForever('hero',function(){
            return Hero::all();
        });
    }
}
