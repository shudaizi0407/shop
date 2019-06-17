<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
<script src="js/jquery.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="layui/layui.js"></script>
</head>
<body>
 <div class="rt_content">
       <div class="page_title">
       <h2 class="fl">管理员添加</h2>
       <a href="admin-index" class="fr top_rt_btn money_icon">管理员列表</a>
      </div>
      <ul class="ulColumn2">
       <form>
        <input type="hidden" name="id">
       <li>
        <span class="item_name" style="width:120px;">管理员名称：</span>
        <input type="text" name="username" class="textbox textbox_225" placeholder="会员账号..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">登陆密码：</span>
        <input type="password" name="password" class="textbox textbox_225" placeholder="会员密码..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">选择角色：</span>
        <select class="select" name="rid">
          <option value="0">请选择</option>
          @foreach($role as $v)
          <option value="{{$v->rid}}">{{$v->rolename}}</option>
          @endforeach
        </select>
       </li>
       </form>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit"  class="link_btn" value="保存" onclick="save()" />
       </li>
      </ul>
 </div>
</body>
</html>
<script type="text/javascript">
      layui.use(['form','layer'],function(){
          layer = layui.layer;
          form = layui.form;
          $ = layui.jquery;
      });
      function save()
      {
          var id = $('input[name="id"]').val();
          var username = $.trim($('input[name="username"]').val());
          var password = $.trim($('input[name="password"]').val());
          var rid = $.trim($('select[name="rid"]').val());
          if(username.length < 2 || username.length > 20)
          {
              layer.alert('请输入3-20个字符名称');return;
          }
          var regpwd = /^[a-zA-Z0-9]{6,30}$/;
          if(isNaN(id) &&!regpwd.test(password))
          {
              layer.alert('请输入正确的密码');return;
          }
          if(rid == 0)
          {
              layer.alert('请选择相应的角色');return;
          }
          $.post('admin-save',$('form').serialize(),function(res){
              if(res.code > 0)
              {
                  layer.alert(res.msg);
              }else{
                  layer.alert(res.msg);
                  setTimeout(function(){window.location.href='admin-index';},1000);
              }
          },'json');
      }
</script>
