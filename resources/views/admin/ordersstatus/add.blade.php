<!DOCTYPE html>
<html>
@include('admin.common.head')
<body>
<!--header-->
@include('admin.common.header')
@include('admin.common.aside')


<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">状态添加</h2>
       
      </div>
      <form action="order-status-add" method="post">
      <ul class="ulColumn2"> 
       <li>
        <span class="item_name" style="width:120px;">状态：</span>
        <input type="text" class="textbox textbox_295" name="state" />

       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="添加"/>
       </li>
      </ul>
      </form>
 </div>
</section>
</body>
</html>
