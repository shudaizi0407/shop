<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersStatus extends Model
{
    public function selects()
    {
    	$data=Db::table('orders_status')->paginate(3);
    	//var_dump($data);die;
    	return $data;

    }

    public function adds($data)
    {
    	$data=Db::table('orders_status')->insert($data);
    	return $data;

    }


    public function deltes($id)
    {

    	$data=Db::table('orders_status')->where('id',$id)->delete();
    	return $data;
    }

    public function getOne($id)
    {

    	$data=Db::table('orders_status')->where('id',$id)->get();
        //var_dump($data);die;
    	return $data;
    }

    public function updates($id,$state)
    {

        $data=Db::table('orders_status')->where('id',$id)->update(['state'=>$state]);
        return $data;
    }

    public function list()
    {
        $data=Db::table('orders_status')->get();
        //var_dump($data);die;
        return $data;

    }
}
