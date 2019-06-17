<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="js/jquery.js"></script>
<script src="js/jquery-1.4.4.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

	(function($){
		$(window).load(function(){
			
			$("a[rel='load-content']").click(function(e){
				e.preventDefault();
				var url=$(this).attr("href");
				$.get(url,function(data){
					$(".content .mCSB_container").append(data); //load new content inside .mCSB_container
					//scroll-to appended content 
					$(".content").mCustomScrollbar("scrollTo","h2:last");
				});
			});
			
			$(".content").delegate("a[href='top']","click",function(e){
				e.preventDefault();
				$(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
			});
			
		});
	})(jQuery);
</script>
</head>
<body>

<!--aside nav-->
<!--aside nav-->


 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">仓库列表</h2>
       <a class="fr top_rt_btn add_icon" href="/store-add-list">添加仓库</a>
      </div>
       <form action="store-list" method="get">
       <input type="text" class="textbox textbox_225" name="ee"  placeholder="输入仓库名关键词"/>
       <input type="submit" value="查询" class="group_btn"/>
       </form>
      <table class="table">
       <tr>
        <th>仓库名称</th>
        <th>仓库编码</th>
        <th>仓库是否启用</th>
        <th>仓库所在地区</th>
        <th>仓库服务地区</th>
   
        <th>操作</th>
       </tr>
         @foreach ($data as $vo)
           
   
           <tr>
            <td class="center">  {{ $vo->store_name }}</td>
            <td class="center"> {{ $vo->store_number }}</td>
            <td class="center">
               @if( ($vo->is_use) == 1) 
                   <font style="color:green;font-weight:bold"><span class="status" data-id="{{ $vo->id }}" name="{{ $vo->is_use }}" >启用</span></font> 
               @elseif( ($vo->is_use) ==0)
            <font style="color:red;font-weight:bold"><span class="status" data-id="{{ $vo->id }}" name="{{ $vo->is_use }}">未启用</span></font> 
               @endif  
            </td>
            <td>
             <address>{{ $vo->location }}</address>
            </td>
            <td class="center">{{ $vo->area }}</td>
         
            <td class="center">
       
             <a href="store-update-show?id={{ $vo->id }}" title="编辑"  class="link_icon">&#101;</a>


             <a href="store-del?id={{ $vo->id }}" title="删除" class="link_icon">&#100;</a>
            </td>
           </tr>
         @endforeach

      </table>
      <aside class="paging">
       <span>共  {{$sumye}}  页 / 第 {{$page}} 页</span>
      <span><a href="store-list?page=1">   首页  </a></span> 
       <span><a href="store-list?page={{$prev}}"> 上一页  </a></span>  
      <span><a href="store-list?page={{$next}}">下一页  </a></span> 
      <span><a href="store-list?page={{$sumye}}">尾页  </a></span> 
      </aside>
 </div>

</body>
<script type="text/javascript">
    $(".status").click(function(){
           var id=$(this).attr("data-id");
          var is_use=$(this).attr('name');
          $.ajax({
               
                url:"store-status",
                data:{id:id,is_use:is_use},
                type:"get",
                dataType:"json",
                success:function(e){
                 
                    history.go(0)
                }

          })
    })
</script>
     
</html>
