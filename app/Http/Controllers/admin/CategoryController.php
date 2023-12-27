<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Contracts\CategoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use App\Enums\Status;

class CategoryController extends Controller
{
    public function __construct(protected CategoryInterface $interface)
    {
    }
    public function index()
    {
        $data = $this->interface->get();
        return view('admin.pages.Category.index', ['model' => $data]);
    }
    public function create()
    {
        $statuses = (new \ReflectionClass(Status::class))->getConstants();
        return view('admin.pages.Category.form',["enums"=>$statuses]);
    }
    public function store(CategoryRequest $request)
    {
        $this->interface->store($request);
        return redirect()->action('App\Http\Controllers\admin\CategoryController@index');
    }
    public function show(Category $data)
    {
        $statuses = (new \ReflectionClass(Status::class))->getConstants();
        return view('admin.pages.Category.form', ['model' => $data,"enums"=>$statuses]);
    }
    public function update(CategoryRequest $request, Category $model)
    {
        $this->interface->update($request, $model);
        return redirect()->action('App\Http\Controllers\admin\CategoryController@index');
    }
    public function destroy(Category $model)
    {
        $this->interface->destroy($model);
        return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
    }
}
