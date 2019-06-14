<!DOCTYPE html>
<html>
@include('admin.common.head')
<style type="text/css">
  .page li {display: inline-block;margin-right: -1px;padding: 5px;border: 1px solid #e2e2e2;min-width: 20px;text-align: center;}
</style>
<body>
<!--header-->
<!--header-->
@include('admin.common.header')
<!--aside nav-->
@include('admin.common.aside')
<!--aside nav-->

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">商品列表示例</h2>
       <a href="goods-create" class="fr top_rt_btn add_icon">添加商品</a>
      </div>
      <section class="mtb">
        <form method="get" action="goods-find">
       <select class="select" name="brand">
        <option value="">品牌</option>
        @foreach ($brand as $brand)
        <option value="{{$brand->brand_name}}">{{$brand->brand_name}}</option>
        @endforeach
       </select>
       <select class="select" name="type">
        <option value="">分类</option>
        
        @foreach ($type as $type)
        <option value="{{$type->type_name}}">{{$type->type_name}}</option>
        @endforeach
       </select>
       <input type="text" name="world" class="textbox textbox_225" placeholder="输入产品关键词或产品货号..."/>
       <input type="submit" value="查询" class="group_btn"/>
       </form>
      </section>
      <table class="table">
       <tr>
        <th width="60px"><input type="checkbox" name=""></th>
        <th width="150px">货号</th>
        <th>产品名称</th>
        <th>缩略图</th>
        <th>单价</th>
        <th>单位</th>
        <th>新品</th>
        <th>热销</th>
        <th>库存</th>
        <th>操作</th>
       </tr>
       @foreach ($list as $goods)
       <tr>
        <td class="center"><input type="checkbox" name=""></td>
        <td class="center">{{ $goods->goods_code }}</td>
        <td class="center"><a href="goods-details?id={{ $goods->id }}">{{ $goods->goodsname }}</a></td>
        <td class="center"><img src="{{ $goods->img }}" width="50" height="50"/></td>
        <td class="center"><strong class="rmb_icon">{{ $goods->price }}</strong></td>
        <td class="center">{{ $goods->brand_name }} | {{ $goods->type_name }}</td>
        <td class="center">
          <?php   if(time()-$goods->create_time<60*60*24*7){
           echo "<a><b>V</b></a>"; 
         }else{
          echo "<a><b>X</b></a>";} ?>   
          </td>
        <td class="center"><?php   if($goods->sale>35){
           echo "<a><b>V</b></a>"; 
         }else{
          echo "<a><b>X</b></a>";} ?>   </td>
        <td class="center">{{ $goods->stock }}</td>
        <td class="center">
         <a href="goods-details?id={{ $goods->id }}" title="详情" class="link_icon" >&#118;</a>
         <a href="product_detail.html" title="编辑" class="link_icon">&#101;</a>
         <a href="goods-delete?id={{ $goods->id }}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
       @endforeach
      </table>
      <page class="page">
      </page>
 </div>
</section>
</body>
</html>
