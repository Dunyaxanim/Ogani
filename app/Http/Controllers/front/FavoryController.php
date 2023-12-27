<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favory; 
use Illuminate\Support\Facades\Auth;

class FavoryController extends Controller
{
    public function add(Product $product)
    {
        $user = Auth::user();

        $existingFavory = Favory::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if (!$existingFavory) {
            $favori = new Favory();
            $favori->user_id = $user->id;
            $favori->product_id = $product->id;
            $favori->save();
            return response()->json(['message' => 'Product added.'], 200);
        }else{
            $existingFavory->delete();
        }

        return response()->json(['message' => 'Product already in favorites.'], 200);
    }
}
