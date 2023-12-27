<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Services\HeroService;
use App\Http\Requests\HeroRequest;
use Illuminate\Support\Facades\Redirect;


class HeroController extends Controller
{
    public function __construct(protected HeroService $service)
    {
        
    }
    public function index()
    {
        $data = $this->service->getAll();
        return view('admin.pages.Hero.index', ['model' => $data]);
    }
    public function create()
    {
        return view('admin.pages.Hero.form');
    }
    public function store(HeroRequest $request)
    {
        try {
            $this->service->store($request);
            return redirect()->action('App\Http\Controllers\admin\HeroController@index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(Hero $data)
    {
        return view('admin.pages.Hero.form', ['model' => $data]);
    }
    public function update(HeroRequest $request, Hero $model)
    {
        try{
            $this->service->update($request, $model);
            return redirect()->action('App\Http\Controllers\admin\HeroController@index');
        }catch(\Throwable $th){
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Hero $model)
    {
        try {
            $this->service->destroy($model);
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
        
    }
}
