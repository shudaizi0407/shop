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
	Route::get('goods-list','GoodsController@list');
});

Route::group(['namespace'=>'Admin' ],function(){
	Route::get('active-index','ActivityController@index');
	Route::get('active-del/{id}','ActivityController@delete');
	Route::get('active-add-list','ActivityController@create');
	Route::post('active-add','ActivityController@doCreate');
	Route::post('active-upate','ActivityController@update');

	Route::get('discount-index','DiscountController@index');
	Route::get('discount-del/{id}','DiscountController@delete');
	Route::get('discount-add-list','DiscountController@create');
	Route::post('discount-add','DiscountController@doCreate');

});
