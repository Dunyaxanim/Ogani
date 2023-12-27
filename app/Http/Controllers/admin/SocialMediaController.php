<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use App\Contracts\SocialMediaInterface;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Redirect;
class SocialMediaController extends Controller
{
    
    public function __construct(protected SocialMediaInterface $interface){

    }
    public function index()
    {
        $data=$this->interface->get();
        return view('admin.pages.SocialMedia.index',['model'=>$data]);
    }
    public function create()
    {
        return view('admin.pages.SocialMedia.form');
    }
    public function store(SocialMediaRequest $SocialMediaRequest)
    {
        $this->interface->store($SocialMediaRequest);
        return redirect()->action('App\Http\Controllers\admin\SocialMediaController@index');
    }
    public function show(SocialMedia $data)
    {
        return view('admin.pages.SocialMedia.form',['model'=>$data]);
    }
    public function update(SocialMediaRequest $SocialMediaRequest, SocialMedia $model)
    {
        $this->interface->update($SocialMediaRequest,$model);
        return redirect()->action('App\Http\Controllers\admin\SocialMediaController@index');
    }
    public function destroy(SocialMedia $model)
    {
        $this->interface->destroy($model);
        return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
    }
}
