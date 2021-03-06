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
       <h2 class="fl">商品评论列表</h2>
    
      </div>
        
        
      <table class="table">
       <tr>
        <th>买家名称</th>
        <th>商品名称</th>
        <th>评论时间</th>
        <th>当前状态</th>
        <th>评论内容</th>
        <th>操作</th>
       </tr>
         @foreach ($data as $vo)
           
   
           <tr>
            <td class="center">  {{ $vo->user_id }}</td>
            <td class="center"> {{ $vo->goodsname }}</td>
             
            <td class="center">
             <address><?php echo (date("Y-m-d H:i:s",$vo->create_time))?></address>
            </td>
            <td class="center">
            @if(($vo->status) == 1)
              <a href="#">通过</a> 
            @elseif(($vo->status) == 2)

                待审核
            @elseif(($vo->status) == 0)
              <font color="red">未通过</font>
            @endif
            </td>
            <td class="center">
               <a href="comment-content?id={{$vo->id}}"><input type="button" value="查看内容" class="link_btn"/></a>
            </td>
            <td class="center">
       
     
             <a href="comment-delete?id={{ $vo->id }}" title="删除" class="link_icon">&#100;</a>
            </td>
           </tr>
         @endforeach

      </table>
      <aside class="paging">
       <span>共  {{$sumye}}  页 / 第 {{$page}} 页</span>
      <span><a href="comment-list?page=1">   首页  </a></span> 
       <span><a href="comment-list?page={{$prev}}"> 上一页  </a></span>  
      <span><a href="comment-list?page={{$next}}">下一页  </a></span> 
      <span><a href="comment-list?page={{$sumye}}">尾页  </a></span> 
      </aside>
 </div>

</body>

     
</html>
