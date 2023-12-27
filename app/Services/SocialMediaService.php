<?php

namespace App\Services;

use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GeneralRequest;
use App\Http\Requests\General\GeneralUpdateRequest;
use Illuminate\Http\Request;

class SocialMediaService{

    public function store(Request $request){
        // $request = $request->validated();
        try{
            DB::beginTransaction();
            SocialMedia::create($request->toArray());
            DB::commit();
        }catch(\Throwable $th){
            DB::rollBack();
            throw $th;
        }
    }
    public function getAll(){
        $model= SocialMedia::get();
        return $model;
    }
    public function update(Request $request,SocialMedia $model){
        try{
            DB::beginTransaction();
            $model->update($request->toArray());
            DB::commit();
        }catch(\Throwable $th){
            DB::rollBack();
            throw $th;
        }
    }
    public function destroy(SocialMedia $model){
        $model->delete();
    }
}

?>