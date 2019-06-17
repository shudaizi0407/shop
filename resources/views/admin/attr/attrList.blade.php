<!DOCTYPE html>
<html>
<style type="text/css">
  .page li {display: inline-block;margin-right: -1px;padding: 5px;border: 1px solid #e2e2e2;min-width: 20px;text-align: center;}
</style>
@include('admin.common.head')
<body>
<!--header-->



 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">添加/更新属性</h2>
      </div>
      <form method="get" action="attr-valueAdd">
      <table class="table">
       <tr>
        <td style="text-align:center;">属性值名称：</td>
        <td>
        	<input type="hidden" name="id" value="{{$id}}">
         <input type="text" class="textbox" name="attribute_name" placeholder="属性值名称"/>
        </td>
        <td>
         <input type="submit" value="添加" class="full_link_td" style="line-height:58px">
        </td>
       </tr>
      </table>
      </form>
      <div class="page_title">
       <h2 class="fl"> </h2>
      </div>
      <table class="table">
       <tr>
        <th>属性值名称</th>
        <th>修改值名称</th>
        <th>操作</th>
       </tr>
      @foreach($attr as $attr)
       <tr>
         
        <td class="center">{{$attr->attribude_value}}</td>
         
        <td class="center" id="{{$attr->id}}">
        <span  >{{$attr->attribude_value}}</span>
        </td>
        <td class="center">
          <button   class="button" id="texts" jsid="{{$attr->id}}" >{{$attr->is_show?'V':'X'}}</button>
          
         <a id="del" jsid="{{$attr->id}}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
      @endforeach
      </table>
      <page class="page">
     
      </page>
 </div>

</body>
</html>
<script type="text/javascript" src=""></script>
<script type="text/javascript">
	$(document).on("click","span",function(){
			span=$(this).html();
			$(this).parent().html("<input type='text' value='"+span+"' />");
		})
	$(document).on("blur",":text",function(){
			id=$(this).parent().attr('id');
			val=$(this).val();
			if (val==span) {
				$(this).parent().html("<span>"+val+"</span>");
				return false;
			}
			$obj=$(this);
			$.ajax({
				method:'get',
				url:'attr-valueUpd',
				data:{id:id,attribude_value:val},
				success:function(msg){
					if (msg==1) {
					$obj.parent().html("<span>"+val+"</span>");	
					}
				}
			})
		})
// $(".upd").change(function(){
//     var aaa = $('#text').val();
//     var id = $('#text').attr('jsid');
//     $.ajax({
//       url:"attr-valueUpd",
//       data:{id:id,attribude_value:aaa},
//       method:"get"
//     }).success(function(msg){
//       // alert(msg);
//       if(msg == 1){
//         alert('属性值名称修改完成');
//         window.location.reload();
//       }else{
//       	console.log(msg);
//       }
//     })
// })
$(".button").click(function(){
    var id = $('#texts').attr('jsid');
    $.ajax({
      url:"value-isShow",
      data:{id:id},
      method:"get"
    }).success(function(msg){
      // alert(msg);
      if(msg == 1){
        alert('属性状态值修改完成');
        window.location.reload();
      }
    })
})
$(".link_icon").click(function(){
	 var id = $('#del').attr('jsid');
    $.ajax({
      url:"attr-valueDel",
      data:{id:id},
      method:"get"
    }).success(function(msg){
      // alert(msg);
      if(msg == 1){
        
      }
    })
	  $(this).parent().parent().remove();
})
</script>