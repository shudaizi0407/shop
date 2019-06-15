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
<!--aside nav-->
@include('admin.common.aside');
<!--aside nav-->

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">添加优惠券</h2>
       <a class="fr top_rt_btn" href="/discount-index">返回优惠券列表</a>
      </div>
     <section>
        <form action="discount-add" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">优惠券名称：</span>
        <input type="text" class="textbox textbox_295" name="discount_name" placeholder="活动名称..."/>
        <!-- <span class="errorTips">错误提示信息...</span> -->
       </li>
       <li>
        <span class="item_name" style="width:120px;">开始时间：</span>
        <input type="datetime-local" name="start_time" class="textbox textbox_295">
       </li>
       <li>
        <li>
        <span class="item_name" style="width:120px;">截至时间：</span>
        <input type="datetime-local" name="end_time" class="textbox textbox_295">
       </li>
       <li>
        <span class="item_name" style="width:120px;">面值：</span>
        <input type="text" class="textbox textbox_150" name="nominal" placeholder="数值类型"/>
        <!-- <span class="errorTips">错误提示信息...</span> -->
       </li>
       <li>
        <span class="item_name" style="width:120px;">订单金额：</span>
        <input type="text" class="textbox textbox_150" name="discount_money" placeholder="数值类型"/>
        <!-- <span class="errorTips">错误提示信息...</span> -->
       </li>
       <li>
        <span class="item_name" style="width:120px;">发放总数：</span>
        <input type="text" class="textbox textbox_150" name="discount_amount" placeholder="数值类型">
       </li>
       <li>
        <span class="item_name" style="width:120px;">所属商品：</span>
        <label class="single_selection"><input type="radio" name="is_all" value="1" />全部可用</label>
        <label class="single_selection"><input type="radio" name="is_all" id="showPopTxt" value="0" />选择商品</label>
       </li>
       <li>
       <li>
        <span class="item_name" style="width:120px;">使用说明：</span>
        <input type="text"  class="textbox textbox_295" name="instructions" placeholder="满多少可见">
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn"/>
       </li>
      </ul>
      </form>
     </section>
 </div>
</section>
<script src="js/ueditor.config.js"></script>
<script src="js/ueditor.all.min.js"> </script>
</body>
</html>
<!--弹出框效果-->
     <script>
     $(document).ready(function(){
         var ids='0';
         //弹出文本性提示框
         $("#showPopTxt").click(function(){
             $(".pop_bg").fadeIn();
         });
         //弹出：确认按钮
         $(".trueBtn").click(function(){
             alert("你点击了确认！");//测试
             alert(ids);
             
             $(".pop_bg").fadeOut();
             $("input[name='ids']").prop('checked', false);
             $("input[name='ids']").prop('disabled', false);
             $("#showPopTxt").val(ids);
             ids='0';
             // alert(ids);
         });
         //弹出：取消或关闭按钮
         $(".falseBtn").click(function(){
             alert("你点击了取消/关闭！");//测试
             ids='0';
             $(".pop_bg").fadeOut();
             $("input[name='ids']").prop('checked', false);
             $("input[name='ids']").prop('disabled', false);
             $("#showPopTxt").prop('checked', false);
         });
         $("input[name='ids']").on('click', function(){
            if ($(this).prop('checked')) {
                ids+= ','+$(this).val();
                $(this).prop('checked',true);
                $(this).prop('disabled','true');
            } 
         });
     });
     </script>
     <section class="pop_bg">
      <div class="pop_cont" style="width: 500px; height: 400px;">
       <!--title-->
       <h3>商品列表</h3>
       <!--content-->
       <div class="pop_cont_input">
        <table class="table">
            <tr>
        @foreach($good as $k=>$v) 
        <td width="90px;" style="vertical-align:middle; text-align:left;"><input type="checkbox" name="ids" value="{{$v->id}}" >{{$v->goodsname}}</td>
           @if(($k+1)%4==0)
            </tr><tr>
            @endif 
        @endforeach
        </table>
        
       </div>
       <!--以pop_cont_text分界-->
       <div class="pop_cont_text">
       </div>
       <!--bottom:operate->button-->
       <div class="btm_btn">
        <input type="button" value="确认" class="input_btn trueBtn"/>
        <input type="button" value="关闭" class="input_btn falseBtn"/>
       </div>
      </div>
     </section>
     <!--结束：弹出框效果-->
