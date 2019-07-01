
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>分类列表</title>
		<link rel="stylesheet" type="text/css" href="./css/style1.css">
	</head>
	<body>
	<!-- start header -->
@include('index.common.header');
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

	<!-- start banner_y -->
	<!-- end banner -->

	<!-- start danpin -->
		<div class="danpin center">
			
			<div class="biaoti center">分类列表</div>
			<div class="main center">
				@foreach($data as $data)
				<div class="mingxing fl mb20" style="border:2px solid #fff;width:230px;cursor:pointer;" onmouseout="this.style.border='2px solid #fff'" onmousemove="this.style.border='2px solid red'">
					<div class="sub_mingxing"><a href="details?id={{$data->id}}" target="_blank"><img src="{{$data->img}}" alt=""></a></div>
					<div class="pinpai"><a href="./xiangqing.html" target="_blank">{{$data->goodsname}}</a></div>
					<div class="youhui">{{$data->goodsname}}</div>
					<div class="jiage">{{$data->price}}</div>
				</div>
				@endforeach
				

				<div class="clear"></div>
			</div>
			
		</div>
		



	<!-- end danpin -->


	</body><br>

</html>