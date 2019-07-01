<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>会员登录</title>
		<link rel="stylesheet" type="text/css" href="index/css/login.css">
		<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
		<script type="text/javascript" src="layui/layui.js"></script>
		<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
	</head>
	<body>
		<!-- login -->
		<div class="top center">
			<div class="logo center">
				<a href="javascript:;" target="_blank"><img src="index/image/mistore_logo.png" alt=""></a>
			</div>
		</div>
		<form class="form center">
		<div class="login">
			<div class="login_center">
				<div class="login_top">
					<div class="left fl">会员登录</div>
					<div class="right fr">您还不是我们的会员？<a href="index-register" target="_self">立即注册</a></div>
					<div class="clear"></div>
					<div class="xian center"></div>
				</div>
				<div class="login_main center">
					<div class="username">用户名:&nbsp;<input class="shurukuang" type="text" name="uname" placeholder="请输入你的用户名"/></div>
					<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;<input class="shurukuang" type="password" name="pwd" placeholder="请输入你的密码"/></div>
					<div class="username">
						<button id="TencentCaptcha" data-appid="2070165089" class="submit"  data-cbfn="callback" type="button"  class="layui-btn layui-btn-normal" style="width: 240px;height: 50px; color: #cccccc;">人机验证</button>
					</div>
				</div>
				<div class="login_submit">
					<input class="submit" type="button" id="login" name="submit" value="立即登录" >
				</div>
				
			</div>
		</div>
		</form>
		<footer>
			<div class="copyright">简体 | 繁体 | English | 常见问题</div>
			<div class="copyright">小米公司版权所有-京ICP备10046444-<img src="index/image/ghs.png" alt="">京公网安备11010802020134号-京ICP证110507号</div>

		</footer>
	</body>
</html>

<script>
	layui.use(['form','layer'],function(){
          layer = layui.layer;
          form = layui.form;
          $ = layui.jquery;
      });
  
  window.callback = function(res){
    $("#login").click(function(){
    var uname = $.trim($('input[name="uname"]').val());
    var pwd = $.trim($('input[name="pwd"]').val());
      if(uname == '')
      {
          layer.alert('请输入正确的账号');return;
      }
      var regpwd = /^[a-zA-Z0-9]{6,30}$/;
      if(!regpwd.test(pwd))
      {
          layer.alert('请输入正确的密码');return;
      }
      if(res.ret === 0){
                $.post('login',{'uname':uname,'pwd':pwd},function(result){
                if(result.code == 200)
                {
                    setTimeout(function(){window.location.href = "home-list";},1000);
                }else{
                	layer.alert(result.msg,{icon:2});
                }
            },'json');
            }else{
                layer.alert('验证失败',{icon:2});return;
            }
     
     });
            // res（用户主动关闭验证码）= {ret: 2, ticket: null}
            // res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
            
    }
</script>