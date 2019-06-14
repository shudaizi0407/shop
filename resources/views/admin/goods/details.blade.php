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
       <h2 class="fl">商品修改</h2>
       <a href="goods-list" class="fr top_rt_btn">返回产品列表</a>
      </div>
     <section>
      <form method="post" action="up_details" enctype="multipart/form-data">
        <input type="hidden" name="_token" value ="{{ csrf_token() }}">
        <input type="hidden" name="id" value ="{{ $details->id }}">
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">商品货号：</span>
        {{$details->goods_code}}

       </li>
       <li>
        <span class="item_name" style="width:120px;">商品名称：</span>
        <input type="text" name="goodsname"  class="textbox textbox_295" value="{{$details->goodsname}}" />

       </li>
       <li>
        <span class="item_name" style="width:120px;">上市时间：</span>
        {{ date('Y-m-d H:i:s',$details->create_time)}}
       </li>
       <li>
        <span class="item_name" style="width:120px;">品牌：</span>
        <select class="select" name="brand_id">

         <option value="{{$details->brand_id}}">{{$details->brand_name}}</option>
          @foreach ($brand as $brand)
          <option value="{{ $brand->brand_id }}"> {{ $brand->brand_name }}</option>
          @endforeach
        </select>
        <span class="item_name" style="width:120px;">分类：</span>
        <select class="select" name="type_id">

         <option value="{{$details->type_id}}">{{$details->type_name}}</option>
          @foreach ($type as $type)
          <option value="{{ $type->type_id }}"> {{ $type->type_name }}</option>
         
          @endforeach
        </select>
       </li>
       <li>
        <span class="item_name"  style="width:120px;">上传图片：</span>
        <label class="uploadImg">
         <input type="file" name="file" />
         <span>上传图片</span>
        </label><span class="errorTips">必选...</span>
        <span class="item_name"  name="price" style="width:120px;">商品库存：</span>
        <input type="text" class="textbox" style="width: 60px" name="stock" value="{{$details->stock}}" />
       </li>
       <li>
        <span class="item_name" style="width:120px;">商品简介：</span>
        <script id="editor" name="goods_desc" type="text/plain" style="width:900px;height:200px;margin-left:120px;margin-top:0;">
          {{$details->goods_desc}}
        </script>
           <!--ueditor可删除下列信息-->
           <div id="btns" style="margin-left:120px;margin-top:8px;">
            <div>
                <button onclick=" UE.getEditor('editor').setHide()">隐藏编辑器</button>
                <button onclick=" UE.getEditor('editor').setShow()">显示编辑器</button>
            </div>        
        </div>
       </li>
       <li>
        <span class="item_name"  name="price" style="width:120px;">商品价格：</span>
        <input type="text" class="textbox" name="price" value="{{$details->price}}" />
       </li>
       <li>
        <span class="item_name" style="width:120px;">运费：</span>
        <label class="single_selection"><input type="radio" name="is_delivery_fee" value="1" name="name"/>免运费</label>
        <label class="single_selection"><input type="radio"  name="is_delivery_fee" value="0" />收取运费</label><span class="errorTips">必选...现为{{$details->is_delivery_fee?'免邮':'不包邮'}}</span>
        
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" value="修改" class="link_btn"/>
       </li>
      </ul>
      </form>
     </section>
 </div>
</section>
<script src="js/ueditor.config.js"></script>
<script src="js/ueditor.all.min.js"> </script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
</script>
</body>
</html>
