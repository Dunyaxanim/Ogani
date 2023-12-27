<?php

namespace App\Http\Controllers\front;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Hero;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $hero = Hero::get()->first();
        $blogs = Blog::latest()->take(3)->get();
        if (Auth::check()) {
            $products = Product::with('wishlist')->withCount('wishlist')->paginate(8);
        } else {
            $products = Product::paginate(8);
        }
        $randomProducts = Product::inRandomOrder()->take(6)->get();
        $lastedProducts = Product::latest()->take(6)->get();
        $raitingProducts = Product::Join('raitings', 'products.id', 'raitings.product_id')->orderBy('raitings.rating', 'DESC')->with('translations')->take(6)->get();
        return view('front.pages.home', ["categories" => $categories, "products" => $products, "hero" => $hero, "blogs" => $blogs,'lastedProducts'=>$lastedProducts,'raitingProducts'=>$raitingProducts, 'randomProducts'=> $randomProducts]);
    }
}
