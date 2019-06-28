<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopcarController extends Controller
{
    //购物车列表
    public function shopcar(Request $request)
    {
        $id=$request->input('id');
        $data=Db::table('shopcar')->where('user_id',$id)->join('goods','shopcar.goods_id','=','goods.id')->get();
        return code('200',$data);
    }

    //修改
    public function update(Request $request)
    {
        $user_id=$request->input('user_id');
        $goods_id=$request->input('goods_id');
        $num=$request->input('num');
        $data=Db::table('shopcar')->where("user_id",$user_id)->where("goods_id",$goods_id)->update(['num'=>$num]);

        if ($data) {
            return code('200');
        }else{
            return code(0);
        }
    }


    //删除
    public function del(Request $request)
    {
        $user_id=$request->input('user_id');
        $goods_id=$request->input('goods_id');
        $data=Db::table('shopcar')->where("user_id",$user_id)->where("goods_id",$goods_id)->delete();
        if ($data) {
            return code('200');
        }else{
            return code(0);
        }

    }

    public function add(Request $request)
    {

        $data=$request->input();

        $res=Db::table('shopcar')->insert($data);
        if ($res) {
            return code('200');
        }else{
            return code(0);
        }  
    }  
    
}