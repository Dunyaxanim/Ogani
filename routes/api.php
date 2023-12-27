<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\FilterController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->controller(FilterController::class)->group(function () {
//     Route::post('getdata/{data}', "getdata")->name('getdata');
// });

Route::controller(FilterController::class)->group(function () {
    Route::get('/getdatatest', "getdatatest")->name('getdatatest');
});
