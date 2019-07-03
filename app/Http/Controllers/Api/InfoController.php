<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function info(Request $request)
    {
    	$id=$request->session()->get('uid');
    	$data=Db::table('user')->where('id',$id)->get();
    	if ($data) {
    		return code('200',$data);
    	}else{
    		return code('0',$data);
    	}
    }

    public function update(Request $request)
    {
    	$data = $request->input();
    	$res=Db::table('user')->where('id',$data['id'])->update($data);
    	if ($res) {
    		return code('200',$data);
    	}else{
    		return code('0',$data);
    	}
    }
}
