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

Route::prefix('org')->group(function() {
    Route::get(     '/',                    'OrgController@index')      ->name('org.index');
    Route::get(     '/create',              'OrgController@create')     ->name('org.create');
    Route::post(    '/',                    'OrgController@store')      ->name('org.store');
    Route::get(     '/{id}',                'OrgController@show')       ->name('org.show');
    Route::get(     '/{id}/edit',           'OrgController@edit')       ->name('org.edit');
    Route::put(     '/{id}',                'OrgController@update')     ->name('org.update');
    Route::delete(  '/{id}',                'OrgController@destroy')    ->name('org.destroy');
    Route::get(     '/{id}/orders',         'OrgController@getOrders')  ->name('org.orders');
});
