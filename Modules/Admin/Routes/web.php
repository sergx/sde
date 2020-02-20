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

Route::prefix('admin')->group(
    // ['middleware' => ['web']],
    function() {
    /**
     * Список пользователей-партнеров       // Заблокировать / и другие действия
     * Список пользователей-покупетелей     // Заблокировать / и другие действия
     * Список типов категорий               // CRUD actions
     * Список заказов
     * 
     * 
     * Вероятно - отдельная авторизация для админа
     */
    Route::get('/',                    'AdminController@index')    ->name('admin');
    
    Route::get('/order',         'AdminController@getOrders')  ->name('admin.order');

    Route::prefix('category-type')->group(function() {
        $prefix = 'admin.category-type';
        $controllerName = "AdminCategoryTypesController";

        Route::get(     '/',                    $controllerName.'@index')      ->name($prefix.'.index');
        Route::get(     '/create',              $controllerName.'@create')     ->name($prefix.'.create');
        Route::post(    '/',                    $controllerName.'@store')      ->name($prefix.'.store');
        Route::get(     '/{id}',                $controllerName.'@show')       ->name($prefix.'.show');
        Route::get(     '/{id}/edit',           $controllerName.'@edit')       ->name($prefix.'.edit');
        Route::put(     '/{id}',                $controllerName.'@update')     ->name($prefix.'.update');
        Route::delete(  '/{id}',                $controllerName.'@destroy')    ->name($prefix.'.destroy');
    });

});
