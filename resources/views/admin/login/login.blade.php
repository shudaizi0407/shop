<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台登录</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="js/jquery.js"></script>
<script src="js/verificationNumbers.js"></script>
<script src="js/Particleground.js"></script>
<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
<script type="text/javascript" src="layui/layui.all.js"></script>
</head>
<body>
  <dl class="admin_login">
     <dt>
        <strong>站点后台管理系统</strong>
        <em>Management System</em>
     </dt>
     <dd class="user_icon">
        <input type="text" name="username" placeholder="账号" class="login_txtbx"/>
     </dd>
     <dd class="pwd_icon">
        <input type="password" name="password" placeholder="密码" class="login_txtbx"/>
     </dd>
     <dd class="val_icon">
        <button id="TencentCaptcha" data-appid="2070165089" data-cbfn="callback" type="button"  class="layui-btn layui-btn-normal" style="width: 300px;height: 40px; background-color: #5cbdaa; border-color: #5cbdaa; color: white;">人机验证</button>
     </dd>
     <dd>
        <input type="button" value="立即登录" class="submit_btn"/>
     </dd>
  </dl>
</body>
</html>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });

  layui.use(['form','layer'],function(){
          layer = layui.layer;
          form = layui.form;
          $ = layui.jquery;
      });
  

  window.callback = function(res){
    $(".submit_btn").click(function(){
    var username = $.trim($('input[name="username"]').val());
    var password = $.trim($('input[name="password"]').val());
      if(username == '')
      {
          layer.alert('请输入正确的账号');return;
      }
      var regpwd = /^[a-zA-Z0-9]{6,30}$/;
      if(!regpwd.test(password))
      {
          layer.alert('请输入正确的密码');return;
      }
      if(res.ret === 0){
                 $.post('admin-login',{'username':username,'password':password},function(res){
                if(res.code > 0)
                {
                    layer.alert(res.msg);
                }else{
                    layer.alert(res.msg);
                    setTimeout(function(){window.location.href = 'admin'},1000);
                }
            },'json');
            }else{
                layer.alert('验证失败',{icon:2});return;
            }
     
  });
            // res（用户主动关闭验证码）= {ret: 2, ticket: null}
            // res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
            
    }
  //测试提交，对接程序删除即可
  
});
</script>
