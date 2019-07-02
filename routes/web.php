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



Route::group(['namespace'=>"Admin"], function(){

	Route::get('admin','IndexController@index');
	Route::match(['get','post'],'admin-login','LoginController@login');
	Route::get('admin-logout','LoginController@logout');
	Route::get('admin-welcome','IndexController@welcome');
	Route::get('admin-index','AdminController@index');
	Route::get('admin-add','AdminController@add');
	Route::post('admin-save','AdminController@save');
	Route::post('admin-del','AdminController@del');
	Route::get('admin-update','AdminController@update');
	Route::get('menu-index','MenuController@index');
	Route::post('menu-save','MenuController@save');
	Route::get('role-index','RoleController@index');
	Route::get('role-add','RoleController@add');
	Route::post('role-save','RoleController@save');
	Route::get('role-update','RoleController@update');
	Route::post('role-del','RoleController@del');

	
	
	Route::get('store-list', 'StoreController@storeList');
	Route::post('store-add', 'StoreController@storeAdd')->middleware('store');
	Route::get('store-add-list', 'StoreController@storeAddList');
	Route::get('region', 'StoreController@region');
    Route::get('store-del', 'StoreController@storeDel');
    Route::get('store-update-show', 'StoreController@storeUpdateShow');
    Route::post('store-update', 'StoreController@storeUpdate');
    Route::get('store-status', 'StoreController@storeStatus');
    

    Route::get('comment-list', 'CommentController@list');
    Route::get('comment-content', 'CommentController@content');
    Route::get('comment-status', 'CommentController@contentStatus');
    Route::get('comment-reply', 'CommentController@reply');
    Route::get('comment-delete', 'CommentController@delete');
    
    Route::get('agrees-list', 'AgreesController@list');
    Route::get('agrees-reply', 'AgreesController@reply');
    Route::get('agrees-content', 'AgreesController@content');
    Route::get('agrees-delete', 'AgreesController@delete');

});
Route::group(['namespace'=>'Admin' ],function(){


	Route::get('orders-list','OrderController@list');
	Route::get('ordersstatus-list','OrdersStatusController@list');
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
	Route::get('brand-brandlist','BrandController@brandList');
	Route::get('brand-typelist','BrandController@typeList');
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

Route::group(['namespace'=>'Admin' ],function(){
	Route::get('activity-index','ActivityController@index');
	Route::get('active-del/{id}','ActivityController@delete');
	Route::get('active-add-list','ActivityController@create');
	Route::post('active-add','ActivityController@doCreate');
	Route::post('active-upate','ActivityController@update');

	Route::get('discount-index','DiscountController@index');
	Route::get('discount-del/{id}','DiscountController@delete');
	Route::get('discount-add-list','DiscountController@create');
	Route::post('discount-add','DiscountController@doCreate');


	Route::get('user-list',"UserController@list");
	Route::get('user-status',"UserController@status");

});


Route::group(['namespace'=>'Index' ],function(){

	Route::get('index1','IndexController@index');
	Route::get('cart','CartController@index');
	Route::get('cartdel','CartController@del');
	Route::get('update','CartController@update');
    Route::get('confirmorder','CartController@order');
    Route::post('orderadd','CartController@orderAdd');
	Route::post('orderadddata','CartController@orderAddData');
	Route::get('endorder','CartController@endorder');

	Route::get('content','ContentController@index');
	Route::get('goodsnew','ContentController@goodsnew');
	Route::get('wait','ContentController@wait');
    Route::get('ordercomment','ContentController@comment');
	Route::get('orderall','ContentController@order');
	Route::get('unpaid','ContentController@unpaid');
});

Route::group(['namespace'=>'Api' ],function(){
	Route::post('register',"RegisterController@register");

	Route::get('activate',"RegisterController@activate");

	Route::get('info',"InfoController@info");
	Route::put('info/update',"InfoController@update");

	Route::get('order',"OrderController@order");
	Route::get('order/wait',"OrderController@wait");

	Route::get('order/unpaid',"OrderController@unpaid");
	Route::get('order/comment',"OrderController@comment");

	Route::post('shopcar/add',"ShopcarController@add");
	Route::get('shopcar',"ShopcarController@shopcar");
	Route::put('shopcar/update',"ShopcarController@update");

	Route::delete('shopcar/del',"ShopcarController@del");
	Route::get('collect',"CollectController@collect");
	Route::delete('collect/del',"CollectController@del");
	Route::post('collect/add',"CollectController@add");

	Route::get('addr',"AddrController@addr");
	Route::post('addr/add',"AddrController@add");
	Route::delete('addr/del',"AddrController@del");
	Route::put('addr/update',"AddrController@update");

	Route::get('message',"MessageController@message");
});
Route::group(['namespace'=>'Api'], function(){
	Route::post('login','LoginController@index');
});

Route::group(['namespace'=>'Api', 'middleware'=>'token'], function(){
	Route::get('goods','GoodsController@index');
	Route::get('type','GoodsController@type');
	Route::get('brand','GoodsController@brand');
	Route::get('goods/details','GoodsController@details');
	Route::get('comment','GoodsController@comment');
	Route::get('carousel','GoodsController@carousel');
	Route::get('recommend','GoodsController@recommend');
	Route::get('activity','GoodsController@activity');
	Route::get('discount','GoodsController@discount');
});


Route::group(['namespace'=>'Index'],function(){
	Route::get('home-list','GoodsController@index');
	Route::get('brand-list','GoodsController@brand_list');
	Route::get('details','GoodsController@details');
	Route::get('add-cart','GoodsController@addCart');
	Route::get('add-order','GoodsController@addOrder');
	Route::match(['get','post'],'index-login','LoginController@login');
	Route::match(['get','post'],'index-register','LoginController@register');

});

