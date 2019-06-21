<?php  
function code($code,$data=array())
{
	// echo 2;
	$message=[
		'200'=>'成功',
		'500'=>'内部错误',
		'400'=>'参数有误',
		'101'=>'token不存在',
		'102'=>'token过期',
		'1000'=>'用户不存在',
		'2001'=>'参数不足'
	];
	return json_encode(['code'=>$code, 'message'=>$message[$code], 'data'=>$data]);
}