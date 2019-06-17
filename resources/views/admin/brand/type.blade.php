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
       <h2 class="fl">添加/更新分类</h2>
      </div>

      <form method="get" action="brand-create">
        <select class="select" name="pid">

         <option value="0">选择产品分类</option>
          @foreach ($type as $type)
          <option value="{{$type->type_id}}"> {{$type->type_name}} </option>
          @endforeach
          
        </select>
      <table class="table">
       <tr>
        <td style="text-align:center;">分类名称：</td>
        <td>
         <input type="text" class="textbox" name="type_name" placeholder="分类名称"/>
        </td>
        <td>
         <input type="submit" value="添加" class="full_link_td" style="line-height:58px">
        </td>
       </tr>
      </table>
      </form>
      <div class="page_title">
       <h2 class="fl">分类列表({{$count}})</h2>
      </div>
      <table class="table">
       <tr>
        <th>ID</th>
        <th>分类</th>
        <th>操作</th>
       </tr>
      @foreach ($info as $infos)
       <tr>
        <td class="center">{{$infos->type_id}}</td>
        <td class="center">
          <?php 
          if($infos->pid == 0){
          echo "全部分类::";
          }else{
          $pid = $infos->pid;
          $name = DB::table('goods_type')->where('type_id',$pid)->first();
          echo $name->type_name."::";
              }
          ?> 
          <input type="text" class="textbox" value="{{$infos->type_name}}" id="text" jsid="{{$infos->type_id}}" >
        </td>
        <td class="center">
<a  title="取消/显示" class="type-isShow"  jsid="{{$infos->type_id}}">
<?php echo $infos->is_show?'V':'X'; ?>
</a>
         
         <a  title="删除" jsid="{{$infos->type_id}}"  class="link_icon">&#100;</a>
        </td>
       </tr>
      @endforeach
      </table>
      <page class="page">
      {{ $info->links() }}
      </page>
 </div>

</body>
</html>
<script type="text/javascript" src=""></script>
<script type="text/javascript">
  $('.link_icon').click(function(){
    var t = $(this).parent().parent();
    $.ajax({
      url:"type-del",
      data:{id:$(this).attr('jsid')},
      method:"get"
    }).success(function(e){
      if(e==1){
        t.remove();
      }else{
        alert('删除失败');
      }
    })
    
  })
  $('.type-isShow').click(function(){
    $.ajax({
      url:"goods-typeShow",
      data:{id:$(this).attr('jsid')},
      method:"get"
    }).success(function(msg){
      if(msg == 1){
        window.location.reload();
      }else{
        alert('状态值修改失败');
      }
    })

  })

  $('.textbox').change(function(){
    var aaa = $(this).val();
    var id = $(this).attr('jsid');
    $.ajax({
      url:"input-type",
      data:{id:id,type_name:aaa},
      method:"get"
    }).success(function(msg){
      if(msg == 1){
        alert('分类名称修改完成');
        window.location.reload();
      }
    })
  })
</script>