<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>用户注册</title>
		<link rel="stylesheet" type="text/css" href="index/css/login.css">
		<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
		<script type="text/javascript" src="layui/layui.js"></script>
	</head>
	<body>
		<form method="post" action="register" onclick="return false;">
		<div class="regist">
			<div class="regist_center">
				<div class="regist_top">
					<div class="left fl">会员注册</div>
					<div class="right fr"><a href="javascript:;" target="_self">小米商城</a></div>
					<div class="clear"></div>
					<div class="xian center"></div>
				</div>
				<div class="regist_main center">
					<div class="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名:&nbsp;&nbsp;<input class="shurukuang" type="text" name="uname" placeholder="请输入你的用户名"/><span>请不要输入汉字</span></div>
					<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="pwd" placeholder="请输入你的密码"/><span>请输入6位以上字符</span></div>
					
					<div class="username">确认密码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="repwd" placeholder="请确认你的密码"/><span>两次密码要输入一致哦</span></div>
					<div class="username">手&nbsp;&nbsp;机&nbsp;&nbsp;号:&nbsp;&nbsp;<input class="shurukuang" type="text" name="tel" placeholder="请填写正确的手机号"/><span>填写下手机号吧，方便我们联系您！</span></div>
					<div class="username">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱:&nbsp;&nbsp;<input class="shurukuang" type="text" name="email" placeholder="请填写正确的邮箱"/><span>请输入正确的邮箱格式</span></div>
				</div>
				<div class="regist_submit">
					<input class="submit" type="submit" name="submit" value="立即注册" onclick="register()">
				</div>
				
			</div>
		</div>
		</form>
	</body>
</html>
<script>
	layui.use(['form','layer'],function(){
		layer = layui.layer;
		form = layui.form;
		$ = layui.jquery;
	});

	function register()
	{
		var uname = $.trim($('input[name="uname"]').val());
		var pwd = $.trim($('input[name="pwd"]').val());
		var repwd = $.trim($('input[name="repwd"]').val());
		var tel = $.trim($('input[name="tel"]').val());
		var email = $.trim($('input[name="email"]').val());
		var reguname = /^[\u4e00-\u9fa5]+$/;
		if(uname == '' || reguname.test(uname)){ layer.alert('请输入正确的用户名');return;}
		var regpwd=/^(\w){6,20}$/;  
		if(!regpwd.test(pwd)){ layer.alert('请输入正确的密码');return;}
		if(repwd != pwd){ layer.alert('密码不一致');return;}
		var regtel = /^1[3456789]\d{9}$/;
		if(!regtel.test(tel)){ layer.alert('请输入正确的手机号');return;}
		var regemail = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
		if(!regemail.test(email)){ layer.alert('请输入正确的邮箱');return;}
	}
</script>