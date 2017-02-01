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

Route::get('/', [
    'as' => 'home',
    'uses' => 'OrderController@index'
]);

Route::group(['prefix' => 'orders'], function () {
    Route::get('/', ['as' => 'orders', 'uses' => 'OrderController@getOrders']);
    Route::post('/', ['as' => 'orders.create', 'uses' => 'OrderController@create']);
    Route::delete('/{id}', ['as' => 'orders.delete', 'uses' => 'OrderController@delete']);
    Route::put('/{id}', ['as' => 'orders.update', 'uses' => 'OrderController@update']);
    Route::get('/filter', ['as' => 'orders.filter', 'uses' => 'OrderController@filter']);
});
