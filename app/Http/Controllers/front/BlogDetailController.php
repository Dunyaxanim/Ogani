<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class BlogDetailController extends Controller
{
    public function  index($blog)
    {
        $blog = Blog::where('id', $blog)->first();
        $news = Cache::rememberForever('news', function () {
            return News::latest()->take(3)->get();
        });
        $admin = User::where('type',1)->get()->first();
        $categories = Category::get();
        return view('front.pages.blog-detail', ['blog' => $blog,'news'=>$news,'categories'=>$categories, 'admin'=> $admin]);
    }
}
