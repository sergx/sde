<?php

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

Route::prefix('cart')->group(function() {
    Route::get(     '/',                         'CartController@index')            ->name('cart.index');
    Route::put(     '/',                         'CartController@add')              ->name('cart.add');
    Route::delete(  '/',                         'CartController@clear')            ->name('cart.clear');
    Route::post(    '/{id}/more',                'CartController@more')             ->name('cart.more');
    Route::post(    '/{id}/less',                'CartController@less')             ->name('cart.less');
    Route::post(    '/{id}/remove',              'CartController@removeItem')       ->name('cart.remove_item');
    Route::get(     '/thanks',                   'CartController@thanks')           ->name('cart.thanks');
});
