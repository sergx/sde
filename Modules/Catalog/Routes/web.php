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

Route::get('/',                   'CatalogController@index')->name('index');
Route::get('/{category_type}',    'CatalogController@filteredByType');

Route::get('/place/{org_id}',     'CatalogController@getOrg')->name('catalog.org');


