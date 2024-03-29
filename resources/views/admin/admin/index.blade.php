<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="js/jquery.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="layui/layui.all.js"></script>
</head>
<body>
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">管理员列表</h2>
       <a href="admin-add" class="fr top_rt_btn add_icon">添加管理员</a>
      </div>
      <table class="table">
       <tr>
        <th>ID</th>
        <th>管理员名称</th>
        <th>操作</th>
       </tr>
       @foreach($data['data'] as $v)
       <tr style="text-align: center;">
        <td class="center" >{{$v['id']}}</td>
        <td>{{$v['username']}}</td>
        <td class="center">
         <a href="admin-update?id={{$v['id']}}" title="编辑" class="link_icon">&#101;</a>
         <a href="javascript:;" title="删除" class="link_icon" onclick="del({{$v['id']}})">&#100;</a>
        </td>
       </tr>
       @endforeach
      </table>
 </div>
</body>
</html>
<script type="text/javascript">
    layui.use(['layer'],function(){
          layer = layui.layer;
          $ = layui.jquery;
      });

    function del(id)
    {
        $.post('admin-del',{'id':id},function(res){
            if(res.code>0)
            {
                layer.alert(res.msg,{icon:2});
            }else{
                layer.alert(res.msg,{icon:1});
                setTimeout(function(){window.location.reload();},1000);
            }
        },'json');
    }
</script>
