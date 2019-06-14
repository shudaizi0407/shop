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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace'=>'Admin' ],function(){
	Route::get('index','IndexController@index');
	Route::get('order-list','OrderController@list');
	Route::get('order-status','OrdersStatusController@list');
	Route::any('order-status-add','OrdersStatusController@add');
	Route::any('order-status-delete','OrdersStatusController@delete');
	Route::any('order-status-update','OrdersStatusController@update');
	Route::any('order-status-search','OrderController@search');
	Route::any('order-update','OrderController@update');
	Route::get('order-info','OrderController@info');
	Route::get('order-info-update','OrderController@infoUpdate');
	Route::get('order-search','OrderController@searchs');
});
