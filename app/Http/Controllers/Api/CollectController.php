<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CollectController extends Controller
{

    //收藏列表
    public function collect(Request $request)
    {
        $id=$request->input('id');
        $data=Db::table('collect')->where('user_id',$id)->join('goods','goods.id','=','collect.goods_id')->get();
        //var_dump($data);die;
        if ($data) {
            return code('200',$data);
        }else{
            return code('0');
        }
    } 


    //收藏删除
    public function del(Request $request)
    {
        $user_id=$request->input('user_id');
        $goods_id=$request->input('goods_id');
        $data=Db::table('collect')->where("user_id",$user_id)->where("goods_id",$goods_id)->delete();
        if ($data) {
            return code('200');
        }else{
            return code(0);
        }

    }


    //收藏
    public function add(Request $request)
    {

        $data=$request->input();

        $res=Db::table('collect')->insert($data);
        if ($res) {
            return code('200');
        }else{
            return code(0);
        }
    }  
}