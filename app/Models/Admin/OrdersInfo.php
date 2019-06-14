<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersInfo extends Model
{
    public function info($id)
    {
    	$data=Db::table('orders')
    			->join('orders_info','orders_info.order_number','=','orders.order_number')
    			->join('orders_status','orders_status.id','=','orders.order_status')
    			->where('orders.order_number',$id)
    			->get();
    	//var_dump($data);die;
    	return $data;
    }


    public function updates($id,$number)
    {

        $data=Db::table('orders_info')->where('id',$id)->update(['number'=>$number]);
        return $data;
    }
}
