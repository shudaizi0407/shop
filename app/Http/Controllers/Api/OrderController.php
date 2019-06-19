<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function order(Request $request)
    {

    	$id=$request->input('id');
    	$data=Db::table('orders')->join('orders_status','orders.order_status','=','orders_status.id')->where('user_id',$id)->get();
    	if ($data) {
    		return json_encode(['code'=>200,'data'=>$data,'msg'=>'查询成功']);
    	}else{
    		return json_encode(['code'=>0,'data'=>$data,'msg'=>'查询失败']);
    	}
    }
    public function status()
    {
    	
    }
}
