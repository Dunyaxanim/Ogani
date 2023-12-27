<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Redirect;
use App\Contracts\BlogInterface;

class BlogController extends Controller
{
    public function __construct(protected BlogInterface $interface)
    {
        
    }
    public function index()
    {
        $data = $this->interface->get();
        return view('admin.pages.Blog.index', ['model' => $data]);
    }
    public function create()
    {
        return view('admin.pages.Blog.form');
    }
    public function store(BlogRequest $request)
    {
        try {
            $this->interface->store($request);
            return redirect()->action('App\Http\Controllers\admin\BlogController@index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(Blog $data)
    {
        return view('admin.pages.Blog.form', ['model' => $data]);
    }
    public function update(BlogRequest $request, Blog $model)
    {
        try{
            $this->interface->update($request, $model);
            return redirect()->action('App\Http\Controllers\admin\BlogController@index');
        }catch(\Throwable $th){
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Blog $model)
    {
        $this->interface->destroy($model);
        return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
    }
}
