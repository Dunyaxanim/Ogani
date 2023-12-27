<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductImgRequest;
use App\Models\ProductImg;
use Illuminate\Support\Facades\Redirect;
use App\Contracts\ProductImgInterface;
use App\Models\Product;

class ProductImgController extends Controller
{
    public function __construct(protected ProductImgInterface $interface)
    {
        
    }
    public function index(Product $product)
    {
        $images = $this->interface->get($product);
        if($images->count() > 0){
            return view('admin.pages.Product_Img.form', ['product' => $product, 'images'=>$images]);
        }else{
            return view('admin.pages.Product_Img.form',['product'=> $product]);
        }
    }
    public function store(ProductImgRequest $request)
    {
        try {
            $this->interface->store($request);
            return redirect()->route('admin.product-img-index',['product'=>$request->product_id]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(ProductImg $model)
    {
        $this->interface->destroy($model);
        return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
    }
}
