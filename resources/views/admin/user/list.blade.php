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
<style type="text/css">
  .page li {display: inline-block;margin-right: -1px;padding: 5px;border: 1px solid #e2e2e2;min-width: 20px;text-align: center;}
</style>
</head>
<body>
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">用户列表</h2>
      
      </div>
      <table class="table">
       <tr>
        <th>ID</th>
        <th>用户名称</th>
        <th>邮箱</th>
        <th>电话</th>
        <th>是否封号</th>
       </tr>
       @foreach($data as $v)
       <tr style="text-align: center;">
        <td class="center" >{{$v->id}}</td>
        <td>{{$v->uname}}</td>
        <td>{{$v->email}}</td>
        <td>{{$v->tel}}</td>
        <td class="center">
       <button   class="button" id="texts" jsid="{{$v->id}}" states="{{$v->status}}">{{$v->status?'V':'X'}}</button>
        
        </td>
       </tr>
       @endforeach
        <div class="page"> {{ $data->links() }}</div>
      </table>
 </div>
</body>
</html>

<script>
  $(".button").click(function(){
    var id = $(this).attr('jsid');
    var status=$(this).attr('states');
    $.ajax({
      url:"user-status",
      data:{id:id,status:status},
      method:"get"
    }).success(function(msg){
      // alert(msg);
      if(msg == 1){
        alert('属性状态值修改完成');
        window.location.reload();
      }
    })
})
</script>

