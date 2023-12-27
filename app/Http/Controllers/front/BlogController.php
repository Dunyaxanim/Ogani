<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::paginate(6);
        $news = Cache::rememberForever('news', function () {
            return News::latest()->take(3)->get();
        });
        $categories = Category::withCount('products')->get();
        return view('front.pages.blog',['blogs'=>$blogs,'news'=>$news,'categories'=> $categories]);
    }
}
