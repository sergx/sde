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

Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index');
});

Route::prefix('product_category')->group(function() {
    Route::get(     '/',                    'ProductCategoryController@index')      ->name('product_category.index');
    Route::get(     '/create',              'ProductCategoryController@create')     ->name('product_category.create');
    Route::post(    '/',                    'ProductCategoryController@store')      ->name('product_category.store');
    Route::get(     '/{id}',                'ProductCategoryController@show')       ->name('product_category.show');
    Route::get(     '/{id}/edit',           'ProductCategoryController@edit')       ->name('product_category.edit');
    Route::put(     '/{id}',                'ProductCategoryController@update')     ->name('product_category.update');
    Route::delete(  '/{id}',                'ProductCategoryController@destroy')    ->name('product_category.destroy');
});

Route::prefix('product')->group(function() {
    Route::get(     '/',                    'ProductController@index')      ->name('product.index');
    Route::get(     '/create',              'ProductController@create')     ->name('product.create');
    Route::post(    '/',                    'ProductController@store')      ->name('product.store');
    Route::get(     '/{id}',                'ProductController@show')       ->name('product.show');
    Route::get(     '/{id}/edit',           'ProductController@edit')       ->name('product.edit');
    Route::put(     '/{id}',                'ProductController@update')     ->name('product.update');
    Route::delete(  '/{id}',                'ProductController@destroy')    ->name('product.destroy');
});
