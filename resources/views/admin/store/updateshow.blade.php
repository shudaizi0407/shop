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
<!--header-->
@include('admin.common.header');
@include('admin.common.aside');

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">仓库修改</h2>
      
      </div>
      <form action="store-update" method="post">
      <ul class="ulColumn2">
               {{ csrf_field() }}
               <input type="hidden" name="id" value="{{$data->id}}">
       <li>
        <span class="item_name" style="width:120px;">仓库名称：</span>
        <input type="text" class="textbox textbox_225" name="store_name" value="{{$data->store_name}}"  placeholder="仓库名称..."/>
        
       </li>
       <li>
        <span class="item_name" style="width:120px;">仓库是否启用：</span>

        <label class="single_selection">
        <input type="radio" value="1"  name="is_use" checked />启用
        </label>

        <label class="single_selection">
        <input type="radio" value="0"  name="is_use"/>未启用
        </label>
       
       </li>

       <li>
        <span class="item_name" style="width:120px;">仓库所在地区：</span>
       <input type="text" class="textbox textbox_295" value="{{$data->location}}"  name="location" placeholder="仓库所在地区..."/>

       </li>
          
      
       <li>
        <span class="item_name" style="width:120px;">仓库服务地区：</span>
        <input type="text" class="textbox textbox_295" value="{{$data->area}}" name="area" placeholder="仓库服务地区..."/>
        
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="更新/保存"/>
       </li>
      </ul>
      </form>
 </div>
</section>

</body>
<script type="text/javascript">


</script>
</html>
