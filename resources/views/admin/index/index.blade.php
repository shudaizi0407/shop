<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="js/jquery.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

</head>
<style type="text/css">
  .main{position: absolute;left: 220px;right: 0px;}
</style>
<body>
<!--header-->
@include('admin.common.header')
<!--aside nav-->
@include('admin.common.aside')
<div class="main">
	<iframe src="admin-welcome" onload="resetMainHeight(this)" style="width: 100%;height: 100%;" frameborder="0" scrolling="0">
       </iframe>
</div>
</body>
</html>
<script type="text/javascript">
	    // 重新设置菜单高度
    function resetMenuHeight()
    {
      var height = document.documentElement.clientHeight - 50;
        $('#menu').height(height);
    }

    // 重新设置主操作页面的高度
    function resetMainHeight(obj)
    {
      var height = parent.document.documentElement.clientHeight - 55;
      $(obj).parent('div').height(height);
    }

    // 菜单点击
    function menuFire(obj)
    {
      // 获取url
      var src = $(obj).attr('src');
      // 设置iframe的src
      $('iframe').attr('src',src);
    }
	$("dt").click(function(){
		var dd = $(this).siblings();
		if(dd.is(":hidden"))
		{
			dd.show();
		}else{
			dd.hide();
		}
	})
</script>