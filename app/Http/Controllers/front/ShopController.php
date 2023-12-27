<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
class ShopController extends Controller
{
    public function index(Category $category){
        $categories = Category::get();
        $productModel = new Product();
        if (Auth::check()) {
            $discounProducts = $productModel->with('wishlist')
            ->withCount('wishlist')
            ->with('category')
            ->where('category_id', $category->id)
            ->where('discount_price', '>', 0)
            ->paginate(3);

            $noneDiscounProducts = $productModel->with('wishlist')
            ->withCount('wishlist')
            ->with('category')
            ->where('category_id', $category->id)
            ->where('discount_price', '>', 0)
            ->paginate(8);
        } else {
            $discounProducts = Product::with('category')->where('category_id', $category->id)->where('discount_price', '<', 0)->paginate(3);
            $noneDiscounProducts = Product::with('category')->where('category_id', $category->id)->where('discount_price', '<', 0)->paginate(8);
        }
        $maxPrice = Product::where('category_id', $category->id)->max('price');
        $minPrice = Product::where('category_id', $category->id)->min('price');
        $randomProducts = Product::where('category_id', $category->id)->inRandomOrder()->take(6)->get();
        $lastedProducts = Product::where('category_id', $category->id)->latest()->take(6)->get();
        $raitingProducts = Product::where('category_id', $category->id)->Join('raitings', 'products.id', 'raitings.product_id')->orderBy('raitings.rating', 'DESC')->with('translations')->take(6)->get();
        return view('front.pages.shop', ["discounProducts" => $discounProducts, "noneDiscounProducts" => $noneDiscounProducts, 'categories'=> $categories, 'maxPrice'=> $maxPrice, 'minPrice' => $minPrice, 'lastedProducts' => $lastedProducts, 'raitingProducts' => $raitingProducts, 'randomProducts' => $randomProducts]);
    }
}
