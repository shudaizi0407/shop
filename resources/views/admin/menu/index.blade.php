<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="author" content="DeathGhost" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="layui/layui.js"></script>
	  <style>
    .scroll{
        overflow-x: hidden; 
        overflow-y: auto;
        height: 100%;  
        width: 100%; 
    }

  </style>
</head>
<body style="padding:10px;">
	<div class="scroll">
   <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">菜单列表</h2>
      </div>
      <form class="layui-form">
    	<input type="hidden" name="pid" value="{{$pid['pid']}}">
	    <table class="layui-table">
	    	<thead>
	    		<tr>
	    			<th>ID</th>
	    			<th>菜单名称</th>
	    			<th>控制器名称</th>
	    			<th>方法名称</th>
	    			<th>是否隐藏</th>
	    			<th>是否禁用</th>
	    			<th>排序</th>
	    			<th>操作</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach($data as $v)
	    		<tr>
	    			<td>{{$v['mid']}}</td>
	    			<td><input type="text" class="layui-input" name="menunames[{{$v['mid']}}]" value="{{$v['menuname']}}"></td>
	    			<td><input type="text" class="layui-input" name="controllers[{{$v['mid']}}]" value="{{$v['controller']}}"></td>
	    			<td><input type="text" class="layui-input" name="methods[{{$v['mid']}}]" value="{{$v['method']}}"></td>
	    			<td><input type="checkbox" lay-skin="primary" name="ishiddens[{{$v['mid']}}]" {{$v['ishidden']?'checked':''}} title="隐藏" value="0"></td>
	    			<td><input type="checkbox" lay-skin="primary" name="status[{{$v['mid']}}]" {{$v['status']?'checked':''}} title="禁用" value="0"></td>
	    			<td><input type="text" class="layui-input" name="sorts[{{$v['mid']}}]" value="{{$v['sort']}}"></td>
	    			<td><button class="layui-btn layui-btn-xs" onclick="child({{$v['mid']}}); return false;">子菜单</button></td>
	    		</tr>
	    		@endforeach
	    		<tr>
	    			<td></td>
	    			<td><input type="text" class="layui-input" name="menunames[0]" ></td>
	    			<td><input type="text" class="layui-input" name="controllers[0]" ></td>
	    			<td><input type="text" class="layui-input" name="methods[0]" ></td>
	    			<td><input type="checkbox" lay-skin="primary" name="ishiddens[0]"  title="隐藏" value="1"></td>
	    			<td><input type="checkbox" lay-skin="primary" name="status[0]"  title="禁用" value="1"></td>
	    			<td><input type="text" class="layui-input" name="sorts[0]" ></td>
	    			<td></td>
	    		</tr>
	    	</tbody>
	    </table>
    </form>
    <button class="layui-btn" onclick="save()">保存</button>
 </div>
 </div>
    <script type="text/javascript">
    	layui.use(['layer','form'],function(){
    		$ = layui.jquery;
            layer = layui.layer;
            form = layui.form;
    	});
        
        // 子菜单
    	function child(pid)
    	{
    		window.location.href = "menu-index?pid="+pid;
    	}

        // 保存菜单
    	function save()
    	{
            $.post('menu-save',$('form').serialize(),function(res){
               if(res.code>0)
               {
                   layer.alert(res.msg,{icon:2});
               }else{
               	   layer.msg(res.msg,{icon:1});
               	   // 自动刷新页面  （就是重新加载页面）
               	   setTimeout(function(){window.location.reload();},1000);
               }
            },'json');
    	}
    </script>
</body>
</html>