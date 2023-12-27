<?php

namespace App\Http\Controllers\admin;

use App\Models\News;
use App\Http\Controllers\Controller;
use App\Contracts\NewsInterface;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Redirect;



class NewsController extends Controller
{
     public function __construct(protected NewsInterface $interface)
    {
    }
    public function index()
    {
        $data = $this->interface->get();
        return view('admin.pages.News.index', ['model' => $data]);
    }
    public function create()
    {
        return view('admin.pages.News.form');
    }
    public function store(NewsRequest $request)
    {
        try {
            $this->interface->store($request);
            return redirect()->action('App\Http\Controllers\admin\NewsController@index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(News $data)
    {
        return view('admin.pages.News.form', ['model' => $data]);
    }
    public function update(NewsRequest $request, News $model)
    {
        try{
            $this->interface->update($request, $model);
            return redirect()->action('App\Http\Controllers\admin\NewsController@index');
        }catch(\Throwable $th){
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(News $model)
    {
        $this->interface->destroy($model);
        return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
    }
}
