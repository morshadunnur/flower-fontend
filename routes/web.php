<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomePageController::class, 'index'])->name('flower.home');
Route::get('product/{slug}', [HomePageController::class, 'detailsProduct'])->name('flower.product.details');

Route::group(['prefix' => 'api'], function (){
    Route::get('product-list', [ProductController::class, 'getProductList'])->name('api.product.list');
    Route::get('product-details', [ProductController::class, 'getProductDetails'])->name('api.product.details');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
