<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LocalizationController;
use App\Http\Controllers\admin\FilterController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\front\BlogController;
use App\Http\Controllers\front\ContactController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ShopController;
use App\Http\Controllers\front\FavoryController;
use App\Http\Controllers\front\BasketController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\front\ShopDetailController;
use App\Http\Controllers\front\BlogDetailController;
use App\Http\Controllers\front\FavoryListController;
use App\Http\Controllers\front\OrderController;
use App\Http\Controllers\front\BasketListController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\Custom_Auth\LoginController;
use App\Http\Controllers\Custom_Auth\RegisterController;
use App\Http\Controllers\Custom_Auth\ForgetPasswordController;
use App\Http\Controllers\Custom_Auth\UserProfilController;
use App\Http\Controllers\front\RaitingController;
use App\Http\Controllers\front\MessageController;
// Auth::routes();




// Route::get('/contact',
//     function () {
//         return view('front.pages.contact');
//     }
// );

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop/{category}', [ShopController::class, 'index'])->name('shop');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/shop-detail/{product}', [ShopDetailController::class, 'index'])->name('shop-detail');
Route::get('/blog-detail/{blog}', [BlogDetailController::class, 'index'])->name('blog-detail');
Route::get('/contact-index', [ContactController::class, 'index'])->name('contact');
Route::get('/favory-list/{user}', [FavoryListController::class, 'index'])->name('favory-list');
Route::post('/favory/{product}', [FavoryController::class, 'add'])->name('favory');
Route::post('/basket/{product}', [BasketController::class, 'add'])->name('basket');
Route::get('/basket-list/{user}', [BasketController::class, 'index'])->name('basket-list');
Route::post('/basket-delete/{productId}', [BasketController::class, 'delete'])->name('basket-delete');
Route::get('/check-out', [OrderController::class, 'index'])->name('check-out');
Route::post('/orderPost', [OrderController::class, 'orderPost'])->name('orderPost');
Route::get('/myorders', [OrderController::class, 'myorders'])->name('myorders');
Route::post('/orderCancle/{value}', [OrderController::class, 'orderCancle'])->name('orderCancle');

Route::get('/index', [AccountController::class, 'index'])->name('index');
Route::get('/forgot-password', [ForgetPasswordController::class, 'index'])->name('forgot-password-index');
Route::post('/forgot-password', [ForgetPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('/password-post', [ForgetPasswordController::class, 'resetPasswordPost'])->name('forgot-password-post');
Route::get('/login-index', [loginController::class, 'login'])->name('login-index');
Route::post('/loginform', [loginController::class, 'loginPost'])->name('loginform');
Route::get('/registerform', [RegisterController::class, 'register'])->name('registerindex');
Route::post('/registerform', [RegisterController::class, 'registerPost'])->name('registerPost');
Route::post('/changePassword', [UserProfilController::class, 'changePassword'])->name('changePassword');
Route::get('/profil', [UserProfilController::class, 'index'])->name('profil');
Route::post('/updateProfil/{user}', [UserProfilController::class, 'update'])->name('updateProfil');
Route::post('/removePhoto/{user}', [UserProfilController::class, 'removePhoto'])->name('removePhoto');
Route::post('/updatePassword', [UserProfilController::class, 'updatePassword'])->name('updatePassword');
Route::get('/change-password/{token}', [UserProfilController::class, 'changePassword'])->name('update-password');
Route::post('/logout_test', [LogoutController::class, 'logouttest'])->name('logout_test');



// Route::post('/basket/{product}', [BasketController::class, 'add'])->where('basket', '[0-9]+');


Route::post('/search', [ProductController::class, "search"])->name('search');
Route::get('/product-filter', [ProductController::class, "filter"])->name('product-filter');

Route::get('/locale/{lang}', [LocalizationController::class, "setLang"])->name('locale');

// routes/web.php

Route::controller(ReviewController::class)->group(function () {
    Route::post('/review-form/{productId}', 'create')->name('review-form');
    // Route::delete('/review-delete/{model}', 'destroy')->name('review-destroy');
});

Route::post('/rate-product/{productId}', [RaitingController::class, 'rateProduct'])->name('rate-product');
Route::get('/get-product-rating/{productId}', [RaitingController::class, 'getProductRating'])->name('rate-product-rating');


Route::post('/message', [MessageController::class, 'message'])->name('message');