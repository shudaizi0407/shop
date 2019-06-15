
<!DOCTYPE html>
<html>
@include('admin.common.head')
<body>
<!--header-->
@include('admin.common.header')
<!--aside nav-->
<!--aside nav-->
@include('admin.common.aside')

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">订单详情示例</h2>
      </div>
      <table class="table">
       <tr>
        <td>收件人：{{$data[0]->name}}</td>
        <td>联系电话：{{$data[0]->user_tel}}</td>
        <td>收件地址：{{$data[0]->address}}</td>
        <td>订单时间：{{date("Y-m-d",$data[0]->create_time)}}</td>
       </tr>
      
       <tr>
        <td>订单状态：<a>{{$data[0]->state}}</a></td>
        <td colspan="3">订单备注：<mark>{{$data[0]->remarks}}</mark></td>
        </tr>
      </table>
      <table class="table">
       @foreach($list as $v)
        <tr>
        <td class="center"><img src="{{$v->img}}" width="50" height="50"/></td>
        <td>{{$v->goodsname}}</td>
        <td class="center">{{$v->goods_code}}</td>
        <td class="center"><strong class="rmb_icon">{{$v->price}}</strong></td>
        <td class="center">
         <p>{{$v->goods_attribute}}</p>
         
        </td>
        <td class="center" id="{{$v->id}}"><strong><span>{{$v->number}}</span></strong></td>
        <td class="center"><strong class="rmb_icon">{{$v->number*$v->price}}</strong></td>
        <td class="center">{{$v->unit}}</td>
       </tr>

       @endforeach

      </table>
      
 </div>
</section>
</body>
</html>
<script>
  
  $(document).on("click","span",function(){
      span=$(this).html();
      $(this).parent().html("<input type='text' value='"+span+"' />");
    })
  $(document).on("blur",":text",function(){
      id=$(this).parent().parent().attr('id');
      
      val=$(this).val();
      if (val==span) {
        $(this).parent().html("<span>"+val+"</span>");
        return false;
      }
      $obj=$(this);
      $.ajax({
        type:'get',
        url:'order-info-update',
        data:{id:id,number:val},
        success:function(msg){
          if (msg==1) {

          $obj.parent().html("<span>"+val+"</span>"); 
          location.reload()
          }
        }
      })
    })


</script>
