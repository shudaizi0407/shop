
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>商城</title>
		<link rel="stylesheet" type="text/css" href="./css/style1.css">
	</head>
	<body>
	<!-- start header -->
<<<<<<< HEAD
@include('index.common.header');
=======
@include('index.common.header')
>>>>>>> a2016863e347a1f9b6e672138e12f460a1e3ae44
	<!--end header -->

<!-- start banner_x -->
		<div class="banner_x center">
			<a href="home-list" target="_blank"><div class="logo fl"></div></a>
			<a href=""><div class="ad_top fl"></div></a>
			<div class="nav fl">
				<ul>
					@foreach ($brand as $brand)
					<li><a href="brand-list?id={{$brand->brand_id}}" target="_blank">{{$brand->brand_name}}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="search fr">
				<form action="" method="post">
					<div class="text fl">
						<input type="text" class="shuru"  placeholder="小米6&nbsp;小米MIX现货">
					</div>
					<div class="submit fl">
						<input type="submit" class="sousuo" value="搜索"/>
					</div>
					<div class="clear"></div>
				</form>
				<div class="clear"></div>
			</div>
		</div>
<!-- end banner_x -->

	
	<!-- xiangqing -->
	<form action="post" method="">
	<div class="xiangqing">
		<div class="neirong w">
			<div class="xiaomi6 fl">商品</div>
			<nav class="fr">
				<li><a href="">概述</a></li>
				<li>|</li>
				<li><a href="">功能</a></li>
				<li>|</li>
				<li><a href="">设计</a></li>
				<li>|</li>
				<li><a href="">参数</a></li>
				<li>|</li>
				<li><a href="">F码通道</a></li>
				<li>|</li>
				<li><a href="">用户评价</a></li>
				<div class="clear"></div>
			</nav>
			<div class="clear"></div>
		</div>	
	</div>
	@foreach($data as $data)


	<div class="jieshao mt20 w">
		<div class="left fl"><img src="{{$data->img}}"></div>
		<div class="right fr">
			<div class="h3 ml20 mt20"></div>
			<div class="jianjie mr40 ml20 mt10">
				{!!$data->goods_desc!!}</div>
			<div class="jiage ml20 mt10">{{$data->price}}</div>
			
			<div class="ft20 ml20 mt20">选择颜色</div>
 
			<div class="xqxq mt20 ml20">
				<div class="top1 mt10">
					<div class="left1 fl">
						@php
						echo json_decode($data->attribude);
						
						@endphp
					</div>
					<input type="hidden" id="goods" value="{{$data->id}}">
					<div class="right1 fr">{{$data->price}}元</div>
					<div class="clear">数量：1</div>
				</div>
				<div class="bot mt20 ft20 ftbc">总计：{{$data->price}}元</div>
			</div>
			<div class="xiadan ml20 mt20">
					<input class="jrgwc" id="qj"  type="button" name="jrgwc" value="立即选购" />
					<input class="jrgwc" id="jr" type="button" name="jrgwc" value="加入购物车" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
		@endforeach
	</form>
	<!-- footer -->
	<footer class="mt20 center">
			
			<div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
			<div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div> 
			<div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>

		</footer>

	</body>
</html>
<script type="text/javascript" src="http://code.jquery.com/jquery-3.4.1.js" ></script>
<script type="text/javascript" src="//res.layui.com/layui/dist/layui.js?t=1560414887305" ></script>
<script type="text/javascript">
	var id = $("#goods").val();
	
	$('#qj').click(function(){
		window.location.href = "add-order?id="+id;
	})
	$('#jr').click(function(){
		window.location.href = "add-cart?id="+id;
	})
</script>