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


<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">仓库添加</h2>
      
      </div>
      <form action="store-add" method="post">
      <ul class="ulColumn2">
               {{ csrf_field() }}
       <li>
        <span class="item_name" style="width:120px;">仓库名称：</span>
        <input type="text" id="store_name" class="textbox textbox_225" name="store_name"  placeholder="仓库名称..."/>
          <span class="errorTips" id="store_namemsg"></span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">仓库是否启用：</span>
        <label class="single_selection"><input type="radio" value="1" name="is_use" checked />启用</label>
        <label class="single_selection"><input type="radio" value="0" name="is_use"/>未启用</label>
       
       </li>

       <li>
        <span class="item_name" style="width:120px;">仓库所在地区：</span>
        <select class="select" name="location[]" id="provinces">
         <option>选择省份  </option>
         
        </select>
        <select class="select" name="location[]" id="citys">
         <option>选择城市  </option>
       
        </select>
        <select class="select" name="location[]" id="countys">
         <option>选择区/县  </option>
        
        </select>
         <span class="errorTips" id="selectmsg"></span>
       </li>
          
       
        
    
       <li>
        <span class="item_name" style="width:120px;">详细地址：</span>
        <input type="text" class="textbox textbox_295" id="detail" name="detail" placeholder="如街道、门牌号、小区..."/>
        <span class="errorTips" id="detailmsg"></span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">仓库服务地区：</span>
        <input type="text" class="textbox textbox_295" id="area"  name="area" placeholder="仓库服务地区..."/>
        <span class="errorTips" id="areamsg"></span>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="添加仓库"/>
       </li>
      </ul>
      </form>
 </div>
</section>

</body>
<script type="text/javascript">

$(".link_btn").click(function(){
       store_name = $("#store_name").val();
       if(store_name==''){
          alert("仓库名称不能为空")
       }
})

$("#store_name").blur(function(){
     store_name = $("#store_name").val();
       if(store_name==''){
          $("#store_namemsg").text("仓库名称不能为空！");
       }
})
$("#detail").blur(function(){
     detail = $("#detail").val();
       if(detail==''){
          $("#detailmsg").text("请填写详细地址！");
       }
})
$("#area").blur(function(){
     area = $("#area").val();
       if(area==''){
          $("#areamsg").text("请仓库服务地区！");
       }
})
$(".select").blur(function(){
     select = $(".select").val();
     // alert(store_name);
       if(select==''){
          $("#selectmsg").text("请选择地址！");
       }
})


  

$(function() {  
  // alert(1);
    //页面初始，加载所有的省份  
    $.ajax({  
        type: "get",  
        url: "region",  
        data: {"type":1},  
        dataType: "json",  
        success: function(data) {  

            //遍历json数据，组装下拉选框添加到html中
            $("#provinces").html("<option value=''>请选择省</option>");  
            $.each(data, function(i, item) {  
                $("#provinces").append("<option value='" + item.area_id + "'>" + item.area_name + "</option>");  
            });
        }  
    });  

    //监听省select框
    $("#provinces").change(function() {  
        $.ajax({  
            type: "get",  
            url: "region",
            data: {"pnum": $(this).val(),"type":2},  
            dataType: "json",  
            success: function(data) {  
                //遍历json数据，组装下拉选框添加到html中
                $("#citys").html("<option value=''>请选择市</option>");  
                $.each(data, function(i, item) {  
                    $("#citys").append("<option value='" + item.area_id + "'>" + item.area_name + "</option>");  
                });  
            }  
        });  
    });  

    //监听市select框
    $("#citys").change(function() {  
        $.ajax({  
            type: "get",  
            url: "region",
            data: {"cnum": $(this).val(),"type":3},  
            dataType: "json",  
            success: function(data) {  
                //遍历json数据，组装下拉选框添加到html中
                $("#countys").html("<option value=''>请选择区</option>");  
                $.each(data, function(i, item) {  
                    $("#countys").append("<option value='" + item.area_id + "'>" + item.area_name + "</option>");  
                });  
            }  
        });  
    });  
});  

</script>
</html>
