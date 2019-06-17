<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>角色添加</title>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script type="text/javascript" src="layui/layui.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <style>
    .scroll{
        overflow-x: hidden; 
        overflow-y: auto;
        height: 100%;  
        width: 100%; 
    }

  </style>
</head>

<body style="padding: 10px;">
  <div class="scroll">
  <div class="page_title">
       <h2 class="fl">角色详情</h2>
       <a href="role-index" class="fr top_rt_btn add_icon">角色列表</a>
  </div>
 	<form class="layui-form">
 		<div class="layui-form-item">
 			<label class="layui-form-label">角色名称</label>
 			<div class="layui-input-block">
 				<input type="text" class="layui-input" name="rolename">
 			</div>
 		</div>

 		<div class="layui-form-item">
 			<label class="layui-form-label">权限菜单</label>
      @foreach($menus as $v)
      <hr>
 			<div class="layui-input-block">
 				<input type="checkbox" name="menus[{{$v['mid']}}]" lay-skin="primary" title="{{$v['menuname']}}" >
 				<hr>
        <?php foreach($v['children'] as $vo){?>
 				<input type="checkbox" name="menus[{{$vo['mid']}}]" lay-skin="primary" title="{{$vo['menuname']}}">
        <?php }?>
 			</div>
      @endforeach
 		</div>
 	</form>
    <div class="layui-form-item">
    	<div class="layui-input-block">
    		<button class="layui-btn" onclick="save()">保存</button>
    	</div>
    </div>
    </div>
 	<script type="text/javascript">
 		layui.use(['layer','form'],function(){
           layer = layui.layer;
           form = layui.form;
           $ = layui.jquery;
 		});

 		// 保存
 		function save()
 		{
 			var rolename = $.trim($('input[name="rolename"]').val());
 			if(rolename == '')
 			{
 				layer.alert('请输入角色名称',{icon:2});return;
 			}

 			$.post('role-save',$('form').serialize(),function(res){
 				if(res.code>0)
 				{
 					layer.alert(res.msg,{icon:2});
 				}else{
 					layer.msg(res.msg,{icon:1});
 					setTimeout(function(){parent.window.location.reload();},1000);
 				}
 			},'json');
 		} 
 	</script>
</body>
</html>