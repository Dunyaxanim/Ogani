<?php

namespace App\Repositories;

use App\Http\Requests\SocialMediaRequest;
use App\Contracts\SocialMediaInterface;
use App\Repositories\AbstractRepository\AbstractRepository;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Redirect;
use App\Services\fileUploadService;
use Illuminate\Support\Facades\DB;
class SocialMediaRepository implements SocialMediaInterface
{
    public $model = SocialMedia::class;
    public function __construct(protected FileUploadService $uploadService)
    {
        
    }
    public function get()
    {
        try {
            $model = $this->model::get();
            return $model;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function store(SocialMediaRequest $SocialMediaRequest)
    {
        $SocialMediaRequest = $SocialMediaRequest->validated();
        try {
            DB::beginTransaction();
            $this->model::create($SocialMediaRequest);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is created successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function update(SocialMediaRequest $SocialMediaRequest, SocialMedia $model)
    {
        $SocialMediaRequest = $SocialMediaRequest->validated();
        try {
            DB::beginTransaction();
            $model->update($SocialMediaRequest);
            DB::commit();
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(SocialMedia $model)
    {
        try {
            DB::beginTransaction();
            $model->delete();
            DB::commit();
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
}
