<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favory;
use App\Models\Basket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index(User $user)
    {
        $basgetList = Basket::where('user_id', $user->id)->with('product')->get();
        $total = Basket::where('user_id', $user->id)->sum('total');
        return view('front.pages.basket-list', ['basketList' => $basgetList, 'total' => $total]);
    }
    public function add(Product $product, Request $request)
    {
        $count = $request->input('count');

        $request->validate([
            'count' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $existBasket = Basket::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        $data = Product::where('id', $product->id)
            ->first();

        if (!$existBasket) {
            $basket = new Basket();
            $basket->user_id = $user->id;
            $basket->product_id = $data->id;
            $basket->count = $count;
            $basket->total = $data->total * $count; // Calculate the total based on the count
            $basket->save();
            $total = Basket::where("user_id", $user->id)->sum('total');
            $basketCount = Basket::where('user_id', $user->id)->count();
            return response()->json(['basketcount' => $basketCount, 'total' => $total], 200);
        } else {
            $existBasket->count = $count;
            $existBasket->total = $data->total * $count; // Update the total based on the new count
            $existBasket->save();
        }
        $total = Basket::where("user_id", $user->id)->sum('total');
       
        $basketCount = Basket::where('user_id', $user->id)->count();
        return response()->json(['basketcount' => $basketCount, 'total'=> $total], 200);
    }

    public function delete(Product $productId)
    {
        $user = Auth::user();
        $product = Basket::where('product_id',$productId->id);
        $product->delete();
        $total = Basket::where("user_id", $user->id)->sum('total');
        $basketCount = Basket::where('user_id', $user->id)->count();
        return response()->json(['basketcount' => $basketCount, 'total' => $total], 200);
    }
}
