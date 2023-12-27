<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralRequest;
use App\Models\General;
use App\Contracts\GeneralInterface;
class GeneralController extends Controller
{
    public function __construct(protected GeneralInterface $interface){

    }
    public function index()
    {
        $data = $this->interface->get();
        return view('admin.pages.General.index',['model'=>$data]);
    }
    public function create()
    {
        return view('admin.pages.General.form');
    }
    public function store(GeneralRequest $request)
    {
       $this->interface->store($request);
       return redirect()->action('App\Http\Controllers\admin\GeneralController@index');
    }
    public function show(General $data)
    {
        if($data!==null){
            return view('admin.pages.General.form',['model'=>$data]);
        }else{
             return redirect()->action('App\Http\Controllers\admin\GeneralController@index');
        }
    }
    public function update(GeneralRequest $request,General $model )
    {
        $this->interface->update($request,$model);
        return redirect()->action('App\Http\Controllers\admin\GeneralController@index');
    }
    public function destroy(General $model)
    {
         $this->interface->destroy($model);
        return redirect()->action('App\Http\Controllers\admin\GeneralController@index');
    }
}
