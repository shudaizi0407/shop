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
    		return code('200',$data);
    	}else{
    		return code('0',$data);
    	}
    }

    //待收货
    public function wait(Request $request)
    {
    	$id=$request->input('id');
        $data=Db::table('orders')->where('orders.user_id',$id)->leftjoin('orders_status','orders.order_status','=','orders_status.id')->where("order_status",'=',2)->get();
        if ($data) {
            return code('200',$data);
        }else{
            return code('1001');
        }
    }


    //代付款
    public function unpaid()
    {
        $id=$request->input('id');
        $data=Db::table('orders')->where('orders.user_id',$id)->leftjoin('orders_status','orders.order_status','=','orders_status.id')->where("order_status",'=',1)->get();
        if ($data) {
            return code('200',$data);
        }else{
            return code('1001');
        }

    }

    public function comment()
    {
        $id=$request->input('id');
        $data=Db::table('orders')->where('orders.user_id',$id)->leftjoin('orders_status','orders.order_status','=','orders_status.id')->where("order_status",'=',3)->get();
        if ($data) {
            return code('200',$data);
        }else{
            return code('1001');
        }

    }
}
