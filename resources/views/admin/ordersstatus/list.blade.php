<!DOCTYPE html>
<html>
@include('admin.common.head')
<style type="text/css">
  .page li {display: inline-block;margin-right: -1px;padding: 5px;border: 1px solid #e2e2e2;min-width: 20px;text-align: center;}
</style>

<body>
@include('admin.common.header')
@include('admin.common.aside')


<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">订单状态列表</h2>
       <a class="fr top_rt_btn add_icon" href="order-status-add">添加状态</a>
      </div>
      
      <table class="table">
       <tr>
        <th>状态ID</th>
        <th>订单状态</th>
        
       
        <th>操作</th>
       </tr>
       <tr>
        @foreach($data as $v)
        <td>{{$v->id}}</td>
        <td>{{$v->state}}</td>
        <td class="center">
         <a href="order-status-update?id={{$v->id}}" title="编辑" class="link_icon">&#101;</a>

         <a href="order-status-delete?id={{$v->id}}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
       @endforeach
      </table>
     <div class="page"> {{ $data->links() }}</div>
 </div>
</section>
</body>
</html>

