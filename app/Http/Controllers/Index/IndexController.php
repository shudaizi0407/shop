<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{ 
    public function index(Request $request)
    {      
    	$size=$request->input('size');
    	$page=$request->input('page');

    	$size=isset($size)?$size:5;
    	$page=isset($page)?$page:1;

    	$offset=($page-1)*$size;

    	$where[]=['status', 1];
    	$data=DB::table('goods')->where($where)->skip($offset)->take($size)->get();
    	// var_dump($data);die;
    	$brand=DB::table('goods_brand')->get();
       
        return view('index.index.index',['data'=>$data,'brand'=>$brand]);
    }
}