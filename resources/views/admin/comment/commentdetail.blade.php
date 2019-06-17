<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
  .box{
     width: 600px;
     height: 100%;
     margin-left: 100px;
     border:#dbdbdb solid 2px;
     margin-top: 50px;
     border-radius: 5px;
     padding-bottom: 3px;
  }

</style>
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


 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">评论信息</h2>
    
      </div>
  
       
      
          <script id="editor" type="text/plain" style="width:600px;height:200px;margin-left:100px;margin-top:0;">{{ $data->content}}</script>

      
       <br>

          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:;" id="showPopTxt">回复</a>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:;" class="status" data-id="{{ $data->id }}"  status="1">通过</a>
        <a href="javascript:;"  class="status" data-id="{{ $data->id }}"  status="0"><font color="red">未通过</font></a>
       
         
      
         @foreach ($list as $vo) 
       <div class="box">
          <br>
             &nbsp;&nbsp;商家回复：&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
            <?php echo (date('Y-m-d H:i:s',$vo->create_time))?>
          <br>
          <br>
           &nbsp;&nbsp; ##: {{ $vo->content }}

       </div>
       @endforeach
       
   
       
    
      <aside class="paging">
      
      </aside>
 </div>

</body>
<script src="js/ueditor.config.js"></script>
<script src="js/ueditor.all.min.js"> </script>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>
<script type="text/javascript">
   
  $(".status").click(function(){
       var  id = $(this).attr("data-id");
       var status = $(this).attr("status");
 
        $.ajax({
            url:"comment-status",
            data:{id:id,status:status},
            dataType:'json',
            success:function(e){
                if(e.code==1){
                  alert("您已修改为通过");
                }else if(e.code==0){
                    alert("您已修改为未通过");
                }
            }
        })

  })


</script>
    <!--弹出框效果-->
     <script>
     $(document).ready(function(){
     //弹出文本性提示框
     $("#showPopTxt").click(function(){
       $(".pop_bg").fadeIn();
       });
     //弹出：确认按钮
     $(".trueBtn").click(function(){
       // alert("你点击了确认！");//测试
         content = $(".textarea").val();
         comment_id = $(".textarea").attr('data-id');
         $.ajax({

              url:"comment-reply",
              data:{comment_id:comment_id,content:content},
              dataType:"json",
              type:"get",
              success:function(e){
                  if(e.code==1){

                      window.location.reload();
                  }
              
              }
         })
         
       $(".pop_bg").fadeOut();

       });
     //弹出：取消或关闭按钮
     $(".falseBtn").click(function(){
       alert("你点击了取消/关闭！");//测试
       $(".pop_bg").fadeOut();
       });
     });
     </script>
     <section class="pop_bg">
      <div class="pop_cont">
       <!--title-->
       <h3>输入内容</h3>
       <!--content-->
       <div class="pop_cont_input">
        <ul>
       
         <li>
          <textarea class="textarea" data-id="{{ $data->id }}" style="height:70px;width:80%;"></textarea>
         </li>

        </ul>
       </div>
       <!--以pop_cont_text分界-->
       <div class="pop_cont_text">
       
       </div>
       <!--bottom:operate->button-->
       <div class="btm_btn">
        <input type="button" value="提交" id="d" class="input_btn trueBtn"/>
        <input type="button" value="关闭" class="input_btn falseBtn"/>
       </div>
      </div>
     </section>
     <!--结束：弹出框效果-->  
       
</html>
