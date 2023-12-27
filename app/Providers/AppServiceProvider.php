<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use App\Models\General;
use App\Models\SocialMedia;
use App\Models\Blog;
use App\Models\News;
use App\Models\Category;
use App\Models\Favory;
use App\Models\Basket;
use App\Models\Product;
use App\Models\Hero;
use App\Observers\BlogObserver;
use App\Observers\NewsObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\HeroObserver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Blog::observe(BlogObserver::class);
        News::observe(NewsObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Hero::observe(HeroObserver::class);

        view()->composer([
            'front.pages.blog', 'front.pages.contact',
            'front.pages.home', 'front.pages._topheader',
            'front.pages.shop-detail', 'front.pages.shop',
            'front.partials._hero', 'front.pages.filterProduct',
            'front.pages.contact','front.pages.favory-list',
            'front.pages.basket-list','front.pages.order-list', 
            'front.pages.blog-detail','front.pages.check-out'
        ], function ($view) {
            $lang = App::getLocale();
            $view->with('lang', $lang);
        });
        
        view()->composer(['front.partials._hero', 'front.partials._topheader','admin.partials._header'], function ($view) {
            if (Auth::check()) {
                $ad = Auth::user()->name;
                $soyAd = Auth::user()->last_name;
                $basHarf = strtoupper(substr($ad, 0, 1)) . '' . strtoupper(substr($soyAd, 0, 1));
                $view->with('basHarf', $basHarf);
            }
            });
       

        view()->composer(['front.partials._topheader', 'front.partials._footer', 'front.partials._hero', 'front.partials._header'], function ($view) {
            $view->with('general', General::get()->first());
        });
        view()->composer(['front.partials._topheader', 'front.pages.blog-detail', 'front.partials._footer'], function ($view) {
            $view->with('socialMedias', SocialMedia::get());
        });
        view()->composer(['front.partials._hero'], function ($view) {
            $categories =  Category::get();
            $view->with('categories', $categories);
        });

        view()->composer(['front.partials._header'], function ($view) {
            if (Auth::check()) {
                $id = Auth::user()->id;
                $total = Basket::where("user_id", $id)->sum('total');
                $wishlist_count =  Favory::where('user_id', $id)->count();
            } else {
                $wishlist_count = 0;
            }
            $view->with('wishlist_count', $wishlist_count);
        });
        view()->composer(['front.partials._header'], function ($view) {
            if (Auth::check()) {
                $id = Auth::user()->id;
                $total = Basket::where("user_id", $id)->sum('total');
            } else {
                $total = 0;
            }
            $view->with('total', $total);
        });
        view()->composer(['front.partials._header'], function ($view) {
            if (Auth::check()) {
                $id = Auth::user()->id;
                $basket_count =  Basket::where('user_id', $id)->count();
            } else {
                $basket_count = 0;
            }
            $view->with('basket_count', $basket_count);
        });

        view()->composer('front.partials._hero', function ($view) {
            $hero = Hero::get()->first();
            $view->with('hero', $hero);
        });
    }
}
