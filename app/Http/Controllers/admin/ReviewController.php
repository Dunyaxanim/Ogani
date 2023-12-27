<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Request $request,$productId)
    {
        $comment = request('comment');
        $productId = request('productId');
        if(!Auth::check()){
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $userid = Auth::user()->id;
        $review = new Review();
        $review->commnet = $comment;
        $review->product_id = $productId;
        $review->user_id = $userid;
        $review->save();
        $newreview = Review::where('user_id', $userid)->where('product_id', $productId)->orderBy('created_at', 'desc')->with('user')->first();
        return response()->json([$newreview],200);

    }
}
