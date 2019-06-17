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
       <h2 class="fl">用户意见反馈列表</h2>
    
      </div>
        
        
      <table class="table">
       <tr>
        <th>商家昵称</th>
        <th>创建时间</th>
        
        <th>评论内容</th>
        <th>操作</th>
       </tr>
         @foreach ($data as $vo)
           
   
           <tr>
            <td class="center">  {{ $vo->user_id }}</td>
         
               <td class="center">
             <address><?php echo (date("Y-m-d H:i:s",$vo->create_time))?></address>
            </td>
           
            <td class="center">
               <a href="agrees-content?id={{$vo->id}}"><input type="button" value="查看内容" class="link_btn"/></a>
            </td>
            <td class="center">
       
           


             <a href="agrees-delete?id={{ $vo->id }}" title="删除" class="link_icon">&#100;</a>
            </td>
           </tr>
         @endforeach

      </table>
      <aside class="paging">
       <span>共  {{$sumye}}  页 / 第 {{$page}} 页</span>
      <span><a href="agrees-list?page=1">   首页  </a></span> 
       <span><a href="agrees-list?page={{$prev}}"> 上一页  </a></span>  
      <span><a href="agrees-list?page={{$next}}">下一页  </a></span> 
      <span><a href="agrees-list?page={{$sumye}}">尾页  </a></span> 
      </aside>
 </div>

</body>

     
</html>
