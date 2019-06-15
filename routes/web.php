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

	Route::get('admin-index', 'IndexController@index');
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