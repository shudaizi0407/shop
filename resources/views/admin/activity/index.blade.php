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
        <input type="hidden" id="_token" value="{{csrf_token()}}">
       <h2 class="fl">活动列表</h2>
       <a class="fr top_rt_btn add_icon" href="/active-add-list">编辑活动</a>
      </div>
      <section class="mtb">
       <select class="select" >
        <option >订单状态</option>
        <option >待付款</option>
        <option>待发货</option>
        <option>待评价</option>
       </select>
       <input type="text" class="textbox textbox_225" placeholder="输入订单编号或收件人姓名/电话..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table">
       <tr>
        <th><input type="checkbox"  class="checkall"></th>
        <th>名称</th>
        <th>折扣</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>状态</th>
        <th>操作</th>
       </tr>
       @foreach($data as $v)
          <tr>
            <td class="center"><input type="checkbox" name="ids"></td>
            <td class="center">{{$v->active_name}}</td>
            <td class="center">{{$v->active_desc}}</td>
            <td>
             <address>{{$v->start_time}}</address>
            </td>
            <td class="center">{{$v->end_time}}</td>
            <td class="center stau" data-id="{{$v->id}}" data-status="{{$v->status}}">{{$v->status}}</td>
            <td class="center">
             <a href="#" title="查看订单" class="link_icon" target="_blank">&#118;</a>
             <a href="/active-del/{{$v->id}}" title="删除" class="link_icon">&#100;</a>
            </td>
         </tr>
       @endforeach
      </table>
      <aside class="paging">
        <a href="{{$data->url(1)}}">首页</a>
        <a href="{{$data->previousPageUrl()}}">上一页</a>
        <a onclick="return false">{{$data->currentPage()}}/{{$data->lastPage()}}</a>
       <a href="{{$data->nextPageUrl()}}">下一页</a>
       <a href="{{$data->url($data->lastPage())}}">尾页</a>
      </aside>
 </div>
</section>
</body>
</html>
<script type="text/javascript">
  //全选
  $(".checkall").click(function(){
    var status=$(".checkall").prop('checked');
    if (status) {
      $("input[name='ids']").prop("checked",true);
    }else{
      $("input[name='ids']").prop("checked",false);
    }
    
  })
 

  $(".stau").on('dblclick', function(){
    var _this=$(this);
    var _token=$("#_token").val();
    var url='active-upate';
    var id=$(this).attr('data-id');
    var status=$(this).attr('data-status');

    $.ajax({
      url:url,
      type:'post',
      data:{"_token":_token, 'id':id, 'status':status},
      dataType:'json',
      success:function(e){
          if (e=='n') {
            alert('修改失败');
          }else{
            _this.text(e);
            _this.attr('data-status', e);
          }
      }
    })
  })
</script>
