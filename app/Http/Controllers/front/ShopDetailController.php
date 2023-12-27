<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\Review;
use App\Models\Raiting;

class ShopDetailController extends Controller
{
    public function  index($product){
        $product = Product::where('id', $product)->first();
        $products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->paginate(4);
        $productImages = ProductImg::where('product_id', $product->id)->get();
        $reviews = Review::where('product_id', $product->id)->with('user')->orderBy('created_at', 'desc')->limit(10)->get();
        $revcount = Review::where('product_id', $product->id)->count();
        $averageRating = Raiting::where('product_id', $product->id)->avg('rating');
        if($productImages->count()>0){
            return view('front.pages.shop-detail', ['product' => $product, 'products' => $products, 'productImages'=> $productImages, 'reviews'=> $reviews, 'revcount' => $revcount, 'rating' => $averageRating ]);
        }else{
            return view('front.pages.shop-detail', ['product' => $product, 'products' =>$products, 'reviews' => $reviews, 'revcount' => $revcount, 'rating' => $averageRating]);

        }
    }
}
