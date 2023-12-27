<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Favory;
use App\Models\Product;

class FavoryListController extends Controller
{
    public function index(User $user){
        $favoryList = Favory::where('user_id',$user->id)->with('product')->get();
        return view('front.pages.favory-list',['favoryList'=> $favoryList]);
    }
}
