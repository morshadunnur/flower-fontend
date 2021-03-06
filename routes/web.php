<?php

use App\Http\Controllers\CartPageController;
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
Route::get('cart', [CartPageController::class, 'singleCartPage'])->name('flower.cart.page');
Route::get('confirm-checkout', [CartPageController::class, 'confirmCheckOut'])->name('flower.cart.confirm');

Route::group(['prefix' => 'api'], function (){
    Route::get('product-list', [ProductController::class, 'getProductList'])->name('api.product.list');
    Route::get('product-details', [ProductController::class, 'getProductDetails'])->name('api.product.details');
    Route::post('process-cart', [ProductController::class, 'processCart'])->name('api.product.cart');
    Route::get('cart-item', [CartPageController::class, 'cartList'])->name('api.cart.list');
    Route::post('check-out', [CartPageController::class, 'checkoutCart'])->name('api.cart.checkout');
    Route::post('update-cart', [CartPageController::class, 'updateCart'])->name('api.cart.update');
    Route::post('remove-cart', [CartPageController::class, 'removeCart'])->name('api.cart.remove');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
