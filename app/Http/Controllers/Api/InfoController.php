<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function info(Request $request)
    {
    	$id=$request->input('id');
    	$data=Db::table('user')->where('id',$id)->select('uname','email','tel')->get();
    	if ($data) {
    		return json_encode(['code'=>200,'data'=>$data,'msg'=>'查询成功']);
    	}else{
    		return json_encode(['code'=>0,'data'=>$data,'msg'=>'查询失败']);
    	}
    }

    public function update(Request $request)
    {
    	$data=$request->input();
    	$id=$data['id'];
    	unset($data['id']);
    	$res=Db::table('user')->where('id',$id)->update($data);
    	if ($res) {
    		return json_encode(['code'=>200,'data'=>$data,'msg'=>'修改成功']);
    	}else{
    		return json_encode(['code'=>0,'data'=>$data,'msg'=>'修改失败']);
    	}
    }
}
