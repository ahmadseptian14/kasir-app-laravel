<?php

use Illuminate\Support\Facades\Auth;
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
Route::middleware(['auth'])
        ->group(function(){
            Route::get('/', 'DashboardController@index')->name('dashboard-kasir');
            Route::get('/products', 'ProductController@index')->name('product-kasir');
            Route::get('/categories/{id}', 'ProductController@categoryDetail')->name('categories-details');
            Route::post('/order/{id}', 'ProductController@order')->name('order-product');

            Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

            Route::post('/checkout', 'CheckoutController@process')->name('checkout');
            Route::get('/success-checkout', 'CheckoutController@success')->name('success');
            

        });


Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth'])
        ->group(function(){
            Route::get('/', 'DashboardController@index')->name('dashboard-admin');
            Route::resource('user', 'UserController');
            Route::resource('category', 'CategoryController');
            Route::resource('product', 'ProductController');

        });


Auth::routes();

