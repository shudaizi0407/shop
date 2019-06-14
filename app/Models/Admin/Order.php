<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    public function selects()
    {
    	$data=Db::table('orders')->join('orders_status','orders.order_status','=','orders_status.id')
    							
    							->join('user','user.id','=','orders.user_id')
    							->paginate(5);
    	//var_dump($data);die;
    	return $data;

    }

    public function getOne($id)
    {

    	$data=Db::table('orders')->where('order_number',$id)->get();
    	return $data;
    }

    public function updates($id,$data)
    {
    	   
        $data=Db::table('orders')->where('id',$id)->update($data);
        return $data;
    }

    public function search($search)
    {

        $data=Db::table('orders')->join('orders_status','orders_status.id','=','orders.order_status')
                                ->where('order_number',$search)
                                ->orwhere('user_tel',$search)
                                ->orwhere('name',$search)

                                ->paginate(5);
        //var_dump($data);die;
        return $data;
    }
}
