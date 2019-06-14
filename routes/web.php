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

	Route::get('goods-list','GoodsController@list');
	Route::get('goods-create','GoodsController@create');
	Route::post('create_do','GoodsController@createDo');
	Route::get('goods-details','GoodsController@details');
	Route::post('up_details','GoodsController@upDetails');
	Route::get('goods-delete','GoodsController@delete');
	Route::get('goods-find','GoodsController@find');
	Route::get('goods-brandList','BrandController@brandList');
	Route::get('goods-typeList','BrandController@typeList');
	Route::get('brand-create','BrandController@create');
	Route::get('brand-del','BrandController@brandDel');
	Route::get('type-del','BrandController@typeDel');
	Route::get('goods-typeShow','BrandController@typeUpd');
	Route::get('goods-brandShow','BrandController@brandUpd');
	Route::get('input-type','BrandController@inputType');
	Route::get('input-brand','BrandController@inputBrand');
	Route::get('goods-attr','AttrController@list');//属性
	Route::get('goods-attrAdd','AttrController@attrAdd');
	Route::get('goods-attrDel','AttrController@attrDel'); 
	Route::get('input-attr','AttrController@attrUpd');
	Route::get('attr-isShow','AttrController@attrisShow');
	Route::get('attr-list','AttrController@attrlist');//属性值
	Route::get('attr-valueAdd','AttrController@valueAdd');
	Route::get('attr-valueUpd','AttrController@valueUpd');
	Route::get('attr-valueDel','AttrController@valueDel');
	Route::get('value-isShow','AttrController@valueShow');
	

});
