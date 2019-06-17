<!DOCTYPE html>
<html>
@include('admin.common.head')
<body>
<!--header-->
    <style>
    .scroll{
        overflow-x: hidden; 
        overflow-y: auto;
        height: 100%;  
        width: 100%; 
    }

  </style>
<div class="scroll">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">商品添加</h2>
       <a href="goods-list" class="fr top_rt_btn">返回产品列表</a>
      </div>
     <section>
      <form method="post" action="create_do" enctype="multipart/form-data">
        <input type="hidden" name="_token" value ="{{ csrf_token() }}">
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">商品名称：</span>
        <input type="text" name="goodsname"  class="textbox textbox_295" placeholder="商品名称..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">品牌：</span>
        <select class="select" name="brand_id">

         <option>选择品牌</option>
          @foreach ($brand as $brand)
          <option value="{{ $brand->brand_id }}"> {{ $brand->brand_name }}</option>
          @endforeach
        </select>
        <span class="item_name" style="width:120px;">分类：</span>
        <select class="select" name="type_id">

         <option>选择产品分类</option>
          @foreach ($type as $type)
          <option value="{{ $type->type_id }}"> {{ $type->type_name }}</option>
         
          @endforeach
        </select>
       </li>

       <li>
        <span class="item_name" style="width:120px;">规格：</span>
        <span style="color: red">颜色</span>  
          @foreach ($colors as $color)
          <input type="checkbox" name="color" value="{{$color->attribude_value}}">{{$color->attribude_value}}
          @endforeach
        <span style="color: red">&nbsp;&nbsp;尺寸</span>
          @foreach ($sizes as $size)
          <input type="checkbox" name="size" value="{{$size->attribude_value}}">{{$size->attribude_value}}
          @endforeach
        <span style="color: red">&nbsp;&nbsp;规格</span>
          @foreach ($normss as $norms)
          <input type="checkbox" name="norms" value="{{$norms->attribude_value}}">{{$norms->attribude_value}}
          @endforeach
       </li>

       <li>
        <span class="item_name"  style="width:120px;">上传图片：</span>
        <label class="uploadImg">
         <input type="file" name="file" />
         <span>上传图片</span>
        </label>
        <span class="item_name"  name="price" style="width:120px;">商品库存：</span>
        <input type="text" class="textbox" style="width: 60px" name="stock" placeholder="商品数量..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">商品简介：</span>
        <script id="editor" name="goods_desc" type="text/plain" style="width:900px;height:200px;margin-left:120px;margin-top:0;"></script>
           <!--ueditor可删除下列信息-->
           <div id="btns" style="margin-left:120px;margin-top:8px;">
               
        </div>
       </li>
       <li>
        <span class="item_name"  name="price" style="width:120px;">商品价格：</span>
        <input type="text" class="textbox" name="price" placeholder="商品价格..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">运费：</span>
        <label class="single_selection"><input type="radio" name="is_delivery_fee" value="1" checked="checked"name="name"/>免运费</label>
        <label class="single_selection"><input type="radio"  name="is_delivery_fee" value="0" />收取运费</label>
        
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn"/>
       </li>
      </ul>
      </form>
     </section>
 </div>
</div>
<script src="js/ueditor.config.js"></script>
<script src="js/ueditor.all.min.js"> </script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
</script>
</body>
</html>
