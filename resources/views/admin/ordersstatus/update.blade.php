<!DOCTYPE html>
<html>
@include('admin.common.head')
<body>
<!--header-->



 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">状态修改</h2>
       
      </div>
      <form action="order-status-update" method="post">
      <ul class="ulColumn2"> 
       <li>
        <input type="hidden" name="id" value="{{$data[0]->id}}">
        <span class="item_name" style="width:120px;">状态：</span>
        <input type="text" class="textbox textbox_295" name="state" value="{{$data[0]->state}}" />

       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="编辑"/>
       </li>
      </ul>
      </form>
 </div>

</body>
</html>
