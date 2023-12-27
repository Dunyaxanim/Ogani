<?php
use  App\Http\Controllers\admin\GeneralController;
use  Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\SocialMediaController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\HeroController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\admin\MeasurementController;
use App\Http\Controllers\admin\ProductImgController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\OrderController;

Route::middleware(['admin','auth'])->get('/', function () {
    return view('admin.pages.home');
})->name('dashboard');

Route::controller(GeneralController::class)->group(function () {
    Route::get('/general-index', 'index')->name('general-index');
    Route::get('/general-form', 'create')->name('general-create-form');
    Route::post('/general-form', 'store')->name('general-create');
    Route::delete('/general-delete/{model}', 'destroy')->name('general-destroy');
    Route::get('/general-show/{data}', 'show')->name('general-show');
    Route::put('/general-update/{model}', 'update')->name('general-update'); 
});

Route::controller(SocialMediaController::class)->group(function () {
    Route::get('/social-media-index', 'index')->name('social-media-index');
    Route::get('/social-media-form', 'create')->name('social-media-create-form');
    Route::post('/social-media-form', 'store')->name('social-media-create');
    Route::delete('/social-media-delete/{model}', 'destroy')->name('social-media-destroy');
    Route::get('/social-media-show/{data}', 'show')->name('social-media-show');
    Route::put('/social-media-update/{model}', 'update')->name('social-media-update'); 
    Route::put('/social-media-update/{model}', 'update')->name('social-media-update'); 
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/blog-index', 'index')->name('blog-index');
    Route::get('/blog-form', 'create')->name('blog-create-form');
    Route::post('/blog-form', 'store')->name('blog-create');
    Route::delete('/blog-delete/{model}', 'destroy')->name('blog-destroy');
    Route::get('/blog-show/{data}', 'show')->name('blog-show');
    Route::put('/blog-update/{model}', 'update')->name('blog-update');
    Route::put('/blog-update/{model}', 'update')->name('blog-update');
});

Route::controller(NewsController::class)->group(function () {
    Route::get('/news-index', 'index')->name('news-index');
    Route::get('/news-form', 'create')->name('news-create-form');
    Route::post('/news-form', 'store')->name('news-create');
    Route::delete('/news-delete/{model}', 'destroy')->name('news-destroy');
    Route::get('/news-show/{data}', 'show')->name('news-show');
    Route::put('/news-update/{model}', 'update')->name('news-update');
    Route::put('/news-update/{model}', 'update')->name('news-update');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category-index', 'index')->name('category-index');
    Route::get('/category-form', 'create')->name('category-create-form');
    Route::post('/category-form', 'store')->name('category-create');
    Route::delete('/category-delete/{model}', 'destroy')->name('category-destroy');
    Route::get('/category-show/{data}', 'show')->name('category-show');
    Route::put('/category-update/{model}', 'update')->name('category-update');
    Route::put('/category-update/{model}', 'update')->name('category-update');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product-index', 'index')->name('product-index');
    Route::get('/product-form', 'create')->name('product-create-form');
    Route::post('/product-form', 'store')->name('product-create');
    Route::delete('/product-delete/{model}', 'destroy')->name('product-destroy');
    Route::get('/product-show/{data}', 'show')->name('product-show');
    Route::put('/product-update/{model}', 'update')->name('product-update');
    Route::put('/product-update/{model}', 'update')->name('product-update');
});

Route::controller(HeroController::class)->group(function () {
    Route::get('/hero-index', 'index')->name('hero-index');
    Route::get('/hero-form', 'create')->name('hero-create-form');
    Route::post('/hero-form', 'store')->name('hero-create');
    Route::delete('/hero-delete/{model}', 'destroy')->name('hero-destroy');
    Route::get('/hero-show/{data}', 'show')->name('hero-show');
    Route::put('/hero-update/{model}', 'update')->name('hero-update');
    Route::put('/hero-update/{model}', 'update')->name('hero-update');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user-index', 'index')->name('user-index');
    Route::get('/user-form', 'create')->name('user-create-form');
    Route::post('/user-form', 'store')->name('user-create');
    Route::delete('/user-delete/{model}', 'destroy')->name('user-destroy');
    Route::get('/user-show/{data}', 'show')->name('user-show');
    Route::put('/user-update/{model}', 'update')->name('user-update');
    Route::put('/user-update/{model}', 'update')->name('user-update');
});

Route::controller(MapController::class)->group(function () {
    Route::get('/map-index', 'index')->name('map-index');
    Route::get('/map-form', 'create')->name('map-create-form');
    Route::post('/map-form', 'store')->name('map-create');
    Route::delete('/map-delete/{model}', 'destroy')->name('map-destroy');
    Route::get('/map-show/{data}', 'show')->name('map-show');
    Route::put('/map-update/{model}', 'update')->name('map-update');
    Route::put('/map-update/{model}', 'update')->name('map-update');
});

Route::controller(MeasurementController::class)->group(function () {
    Route::get('/measurement-index', 'index')->name('measurement-index');
    Route::get('/measurement-form', 'create')->name('measurement-form');
    Route::post('/measurement-form', 'store')->name('measurement-create');
    Route::delete('/measurement-destroy/{data}', 'destroy')->name('measurement-destroy');
    Route::get('/measurement-show/{data}', 'show')->name('measurement-show');
    Route::put('/measurement-update/{model}', 'update')->name('measurement-update');
    // Route::put('/measurement-update/{model}', 'update')->name('measurement-update');
});

Route::controller(ProductImgController::class)->group(function () {
    Route::get('/product-img-index/{product}', 'index')->name('product-img-index');
    Route::get('/product-img-form', 'create')->name('product-img-create-form');
    Route::post('/product-img-form', 'store')->name('product-img-create');
    Route::delete('/product-img-delete/{model}', 'destroy')->name('product-img-destroy');
});

Route::controller(MenuController::class)->group(function () {
    Route::get('/menu-index', 'index')->name('menu-index');
    Route::get('/menu-form', 'create')->name('menu-create-form');
    Route::post('/menu-form', 'store')->name('menu-create');
    Route::delete('/menu-delete/{model}', 'destroy')->name('menu-destroy');
    Route::get('/menu-show/{data}', 'show')->name('menu-show');
    Route::put('/menu-update/{model}', 'update')->name('menu-update');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/order-index', 'index')->name('order-index');
    // Route::get('/order-destroy', 'destroy')->name('order-destroy');
    Route::get('/order-items-index/{model}', 'items')->name('order-item-index');
});

Route::get('/mailbox', [MessageController::class,'mailbox'])->name('mailbox');

// Route::controller(UserCotroller::class)->group(function () {
//     Route::get('/createToken', 'createToken')->name('getdata');
// });

?>