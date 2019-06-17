<!DOCTYPE html>
<html>
@include('admin.common.head')
<body>

<style type="text/css">
  .page li {display: inline-block;margin-right: -1px;padding: 5px;border: 1px solid #e2e2e2;min-width: 20px;text-align: center;}
</style>

 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">订单列表</h2>
      
      </div>
      <section class="mtb">
       <select class="select">
        <option value="0">订单状态</option>
        @foreach($list as $v)
        <option value="{{$v->id}}">{{$v->state}}</option>
       @endforeach
       </select>
       <input type="text" class="textbox textbox_225" id="search" name="search" placeholder="输入订单编号或收件人姓名/电话..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table">
       <tr>
        <th>订单编号</th>
        <th>收件人</th>
        <th>联系电话</th>
        <th>收件人地址</th>
        
        <th>订单状态</th>
        
        <th>操作</th>
       </tr>
       
         @foreach($data as $v)
       <tr class="tbody">
        <td class="center">{{$v->order_number}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->user_tel}}</td>
        <td>
         <address>{{$v->address}}</address>
        </td>
        <td class="center">{{$v->state}}</td>
        <td class="center">
         <a href="order-info?id={{$v->order_number}}" title="查看订单" class="link_icon" >&#118;</a>
         <a href="order-update?id={{$v->order_number}}" title="编辑" class="link_icon">&#101;</a>
         <!-- <a href="#" title="删除" class="link_icon">&#100;</a> -->
        </td>
       </tr>
       @endforeach
       
      </table>
     <div class="page"> {{ $data->links() }}</div>
 </div>

</body>
</html>
<script>
  $(".select").change(function(){
    var id=$(".select").val();
    $.ajax({
      url:"order-status-search",
      type:'get',
      dataType:'json',
      data:{id:id},
      success:function(res){
        // console.log(res);return ;
        $(".tbody").remove()
          $.each(res.data,function(k,v){
            $(".table").append('<tr class="tbody">\
        <td class="center">'+v.order_number+'</td>\
        <td>'+v.name+'</td>\
        <td>'+v.user_tel+'</td>\
        <td>\
         <address>'+v.address+'</address>\
        </td>\
        <td class="center">'+v.state+'</td>\
        <td class="center">\
         <a href="order-info?id='+v.order_number+'" title="查看订单" class="link_icon" >&#118;</a>\
         <a href="order-update?id='+v.order_number+'" title="编辑" class="link_icon">&#101;</a>\
        </td>\
       </tr>')
          })
      }
    })
  })

  $(".group_btn").click(function(){
    var search=$("#search").val();
    $.ajax({
      url:'order-search',
      type:'get',
      dataType:'json',
      data:{search:search},
      success:function(res){
         $(".tbody").remove()
          $.each(res.data,function(k,v){
            $(".table").append('<tr class="tbody">\
        <td class="center">'+v.order_number+'</td>\
        <td>'+v.name+'</td>\
        <td>'+v.user_tel+'</td>\
        <td>\
         <address>'+v.address+'</address>\
        </td>\
        <td class="center">'+v.state+'</td>\
        <td class="center">\
         <a href="order-info?id='+v.order_number+'" title="查看订单" class="link_icon" >&#118;</a>\
         <a href="order-update?id='+v.order_number+'" title="编辑" class="link_icon">&#101;</a>\
        </td>\
       </tr>')
          })
      }
    })
  })
</script>
