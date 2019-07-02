<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AddrController extends Controller
{

    public function addr(Request $request)
    {

        $id=$request->session()->get('uid');
        $data=Db::table('addr')->where('user_id',$id)->get();
        if ($data) {
            return code(200,$data);
        }else{
            return code(0);
        }
    }


    public function add(Request $request)
    {
        $data=$request->input();
        $res=Db::table('addr')->insert($data);
        if ($res) {
            return code(200,$res);
        }else{
            return code(0);
        }
    }

    public function del(Request $request)
    {
        $id = $request->input('id');
        $res=Db::table('addr')->where('id',$id)->delete();
        if ($res) {
            return code(200,$res);
        }else{
            return code(0);
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $addr=$request->input('addr');
        $res=Db::table('addr')->where('id',$id)->update(['addr'=>$addr]);
        if ($res) {
            return code(200,$res);
        }else{
            return code(0);
        }
    }

    
} 