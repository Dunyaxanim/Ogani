<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ProductInterface;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Measurement;
use App\Enums\Status;

use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function __construct(protected ProductInterface $interface)
    {

    }
    public function index()
    {
        $data = $this->interface->getWith('category');
        return view('admin.pages.Product.index', ['model' => $data]);
    }
    public function create()
    {
        $statuses = (new \ReflectionClass(Status::class))->getConstants();
        $stockEnums = (new \ReflectionClass(Status::class))->getConstants();
        $categories = Category::get();
        $measurements = Measurement::get();
        return view('admin.pages.Product.form', ["enums" => $statuses, "stockEnums" => $stockEnums, "categories" => $categories, "measurements"=> $measurements]);
    }

    public function store(ProductRequest $request)
    {
        // dd($request);
        try {
            $this->interface->store($request);
            return redirect()->action('App\Http\Controllers\admin\ProductController@index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(Product $data)
    {
        $statuses = (new \ReflectionClass(Status::class))->getConstants();
        $stockEnums = (new \ReflectionClass(Status::class))->getConstants();
        $categories = Category::get();
        $measurements = Measurement::get();
        return view('admin.pages.Product.form', ['model' => $data, "enums" => $statuses, "stockEnums" => $stockEnums, 'categories' => $categories, "measurements" => $measurements]);
    }
    public function update(ProductRequest $request, Product $model)
    {
        try {
            $this->interface->update($request, $model);
            return redirect()->action('App\Http\Controllers\admin\ProductController@index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Product $model)
    {
        $this->interface->destroy($model);
        return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
    }
    public function search(Request $request)
    {
        $search = $request->input('query');
        $products = Product::WhereHas('translations', function ($query) use ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        })->paginate(8);
        return view('front.pages.filterProduct', compact('products'));
    }
    public function filter(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $integerMaxPrice = Product::max('price')* $maxPrice/100;
        $integerMinPrice = Product::min('price') * $minPrice / 100;
        $products = Product::whereBetween('price', [$integerMinPrice, $integerMaxPrice])->get();
        return response()->json(["products"=> $products],200);
    }
}
