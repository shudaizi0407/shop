<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;

class LoginController extends Controller
{
	//登录 获取token
    public function index(Request $request)
    {
    	$data=$request->post();
    	$user=DB::table('user')->where($data)->get();
    	if (empty($user[0]->id)) {
    		return code('1000');
    	}
    	$token=hash('sha256', Str::random(60));
    	DB::table('user')
          ->where('id', $user[0]->id)
          ->update(['as_token' => $token]);
        session([$token => time()]);
    }
}
