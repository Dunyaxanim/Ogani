<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Raiting;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RaitingController extends Controller
{
    public function rateProduct(Request $request, Product $productId)
    {
        $userId = auth()->user()->id;

        $existingRating = Raiting::where('user_id', $userId)
        ->where('product_id', $request->productId)
        ->first();

        if ($existingRating) {
            return response()->json(['success' => false, 'message' => 'User has already rated this product.']);
        }

        $rating = $request->rating;
        $productRating = new Raiting();
        $productRating->product_id = $request->productId;
        $productRating->rating = $rating;

        $productRating->save();
        $averageRating = Raiting::where('product_id', $request->productId)->avg('rating');
        return response()->json(['success' => true, 'averageRating' => $averageRating]);
    }
}

