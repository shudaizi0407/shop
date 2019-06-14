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
       <h2 class="fl">订单信息修改</h2>
       
      </div>
      <form action="order-update" method="post">
      <ul class="ulColumn2"> 
       <li>
        <input type="hidden" name="id" value="{{$data[0]->id}}">
        <span class="item_name" style="width:120px;">收件人：</span>
        <input type="text" class="textbox textbox_295" name="name" value="{{$data[0]->name}}" />

       </li>
       <li>
       
        <span class="item_name" style="width:120px;">电话：</span>
        <input type="text" class="textbox textbox_295" name="user_tel" value="{{$data[0]->user_tel}}" />

       </li>

        <li>
       
        <span class="item_name" style="width:120px;">地址：</span>
        <textarea name="address" id="" class="textbox textbox_295" cols="30" rows="50">{{$data[0]->address}}</textarea>
       

       </li>
       <li>
         <span class="item_name" style="width:120px;">订单状态：</span>
          <select class="select" name="order_status">
        
           @foreach($list as $v)
            
              <option value="{{$v->id}}" @if($data[0]->order_status==$v->id) selected @endif>{{$v->state}}</option>
             
            @endforeach
       </select>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="编辑"/>
       </li>
      </ul>
      </form>
 </div>
</section>
</body>
</html>
