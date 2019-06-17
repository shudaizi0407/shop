<!--aside nav-->
<aside class="lt_aside_nav content mCustomScrollbar">
 <ul id="menu">
  <li>
   @foreach($menus as $v)
    @if(isset($v['children']))
    <dl>
      <dt style="cursor:pointer;">{{$v['menuname']}}</dt>
    <!--当前链接则添加class:active-->
    <?php foreach($v['children'] as $vo) {?>
     <dd><a href="javascript:;" class="active" onclick="menuFire(this)" src="<?=$vo['controller']?>-<?=$vo['method']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$vo['menuname']?></a></dd>
    <?php }?>
   </dl>
   @else
   <dl>
   <dt style="cursor:pointer;">{{$v['menuname']}}</dt>
    </dl>
   @endif
   @endforeach
  </li>
 </ul>
</aside>
