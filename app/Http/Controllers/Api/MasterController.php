<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
     public function __construct()
    {
        echo 1;
    }
    public function code($code,$data=array())
    {
    	$message=[
    		'200'=>'成功',
    		'500'=>'内部错误',
    		'400'=>'参数有误'
    	];
    	return json_encode(['code'=>$code, 'message'=>$message[$code], 'data'=>$data]);
    }
}
