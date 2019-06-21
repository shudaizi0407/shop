<!DOCTYPE html>
<html>
	<head>
	
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>我的购物车-小米商城</title>
		<base href="./index/">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>
	<body>
	<!-- start header -->
	<!--end header -->

<!-- start banner_x -->
		<div class="banner_x center">
		   
			<a href="/index1" target="_blank"><div class="logo fl"></div></a>
			
			<div class="wdgwc fl ml40">我的购物车</div>
			<div class="wxts fl ml20">温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</div>
			<div class="dlzc fr">
				<ul>
					<li><a href="./login.html" target="_blank">登录</a></li>
					<li>|</li>
					<li><a href="./register.html" target="_blank">注册</a></li>	
				</ul>
				
			</div>
			<div class="clear"></div>
		</div>
		<div class="xiantiao"></div>
		<div class="gwcxqbj">
			<div class="gwcxd center">
				<div class="top2 center">
					<div class="sub_top fl">
					 <a class="q" >全选</a>	/<a class="qx">取消</a>	
					</div>
					<div class="sub_top fl">商品名称</div>
					<div class="sub_top fl">单价</div>
					<div class="sub_top fl">数量</div>
					<div class="sub_top fl">小计</div>
					<div class="sub_top fr">操作</div>
					<div class="clear"></div>
				</div>
				<div class="content2 center">
					<div class="sub_content fl ">
						<input type="checkbox" name="check"  class="quanxuan"/>
					</div>
					<div class="sub_content fl"><img src="./image/gwc_xiaomi6.jpg"></div>
					<div class="sub_content fl ft20">小米6全网通6GB内存+64GB 亮黑色</div>
					<div class="sub_content fl ">￥<span class="price">2499</span></div>
					<div class="sub_content fl">
						<input class="shuliang num" type="number" value="1" step="1" min="1" >
					</div>
					<div class="sub_content fl A">￥<span class="summMoney"></span></div>
					<div class="sub_content fl"><a href="">×</a></div>
					<div class="clear"></div>
				</div>
				
			</div>
			<div class="jiesuandan mt20 center">
				<div class="tishi fl ml20">
					<ul>
						<li><a href="./liebiao.html">继续购物</a></li>
						<li>|</li>
						<li>共<span>2</span>件商品，已选择<span class="num" > 0</span>件</li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="jiesuan fr">
					<div class="jiesuanjiage fl">合计（不含运费）：￥  <span class="sumM"> 0</span></div>
					<div class="jsanniu fr">
					<input class="jsan" type="submit" name="jiesuan"  value="确认下单"/>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
	
	<!-- footer -->
	<footer class="center">
			
			<div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
			<div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div> 
			<div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
		</footer>

	</body>
</html>
<script src="./js/jquery-1.8.3.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue" charset="utf-8"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script> -->
<!-- <script src="//cdn.bootcss.com/vue-resource/1.0.3/vue-resource.js" type="text/javascript" charset="utf-8"></script> -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="./js/cart.js"></script>
<script>
$(function(){

	//全选
	$(".q").click(function(){
 

		num=$("[name=check]:checkbox").prop("checked",true);
		$(".num").html(num.length);
		price=$(".price").text();
		num=$(".num").val();
		sumM=num*price;
		console.log(sumM)
		$(".sumM").text(sumM);

});
//全不选
$(".qx").click(function(){

	$("[name=check]:checkbox").prop("checked",false);
     $(".num").html(0);
	 $(".sumM").text(0);
});
// 单选
$("[name=check]").click(function(){
	  a=$(this).text();
	  console.log(a)
	 if(a==0){
		$("[name=check]:checkbox").prop("checked",true);
		b=$(this).text(1);
        price=$(".price").text();
		num=$(".num").val();
		sumM=num*price;
		$(".sumM").text(sumM);

	 }else{
		b=$(this).text(0);
		$(".sumM").text(0);
	 }
	    
});

// 计算总金额
price=$(".price").text();
num=$(".num").val();
sumMoney=num*price;
$(".summMoney").text(sumMoney);

$(".num").click(function(){

    price=$(".price").text();
    num=$(".num").val();
    sumMoney=num*price;
	console.log(sumMoney)
    $(".summMoney").text(sumMoney);
})


})
  
</script>
