<?php  
function code($code,$data=array())
{
	// echo 2;
	$message=[
		'200'=>'成功',
		'0'=>'失败',
		'500'=>'内部错误',
		'400'=>'参数有误',
		'101'=>'token不存在',
		'102'=>'token过期',
		'1000'=>'用户不存在',
		'1001'=>'数据不存在',
		'1002'=>'图片为空'
	];
	return json_encode(['code'=>$code, 'message'=>$message[$code], 'data'=>$data]);
}