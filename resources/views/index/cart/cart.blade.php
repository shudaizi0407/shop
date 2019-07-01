<!DOCTYPE html>
<html>
	<head>
	
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>我的购物车-小米商城</title>
		<style type="text/css">
   .page li {display: inline-block;margin-right: -1px;padding: 5px;border: 1px solid #e2e2e2;min-width: 20px;text-align: center;}
</style>
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

				<form action="/orderadd" method="post">
				@csrf
				@foreach($data as $vo)
				<div class="content2 center" >

			            <!-- <input type="hidden" name="goods_id[]" value="{{$vo->id}}"> -->
					<div class="sub_content fl ">
						<input type="checkbox" name="check[]"  value="{{$vo->id}}" class="quanxuan" data="{{ $vo->price * $vo->num }}" />
					</div>
					<div class="sub_content fl"><img src="{{$vo->img}}" style="width:80px;" ></div>
					<div class="sub_content fl ft20">{{$vo->goodsname }} 
			
					 <span style="font-size:13px;">
					 {{ json_decode($vo->attribude,true) }}
					 </span>
					 
					 </div>
					<div class="sub_content fl ">￥<span id="price{{ $vo->id}}" >{{ $vo->price}}</span></div>
					<div class="sub_content fl">
						<input class="shuliang num" type="number" data-id="{{$vo->id}}"  value="{{$vo->num}}" step="1" min="1" >
					</div>
					<div class="sub_content fl A">￥<span id="summMoney{{$vo->id}}" >{{ $vo->price * $vo->num }}</span></div>
					<div class="sub_content fl"><a href="/cartdel?goods_id={{$vo->id}}">×</a></div>
					<div class="clear"></div>
					
				</div>
				@endforeach
				<div class="page">
				{{ $data->links() }}
				</div>
				
			</div>

			<div class="jiesuandan mt20 center">
				<div class="tishi fl ml20">
					<ul>
						<li><a href="./liebiao.html">继续购物</a></li>
					<div class="clear"></div>
					</ul>
				</div>
				<div class="jiesuan fr">
                         


					<div class="jiesuanjiage fl">合计（不含运费）：￥  <span class="sumM"> 0</span></div>
					<div class="jsanniu fr">
					      <input class="jsan" type="submit" name="jiesuan"  value="去结算"/>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			</form>
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
<script src="https://cdn.staticfile.org/vue/2.2.2/vue.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script> -->
<!-- <script src="//cdn.bootcss.com/vue-resource/1.0.3/vue-resource.js" type="text/javascript" charset="utf-8"></script> -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>

//计算数量的总价格
$(".num").click(function(){
	 var id=$(this).attr("data-id");
	  
	  num=$(this).attr("value");
	  price=$('#price'+id).html();
	 
	  sum=num * price;
	 $("#summMoney"+id).html(sum);
	  
	 $.ajax({
		 url:"/update",
		 data:{goods_id:id,num:num},

	 })

 })


$(function(){

	//全选
	$(".q").click(function(){
 

		num=$(".quanxuan:checkbox").prop("checked",true);
		getAllPrice() 

});
//全不选
$(".qx").click(function(){

	$(".quanxuan:checkbox").prop("checked",false);
	$(".sumM").text(0);
});
// 单选
$(".quanxuan").on("click",function(){
	var par_label = $(this).parent();
	id=$(".num").attr("data-id");
	var items = document.getElementsByName("check"); 


	for(var i=0;i<items.length;i++){ 
              if(items[i].checked){ 
				
		
              } 
		  } 
		  getAllPrice() 
});
//
function getAllPrice() {
    var s = 0.0;
    $(".quanxuan").each(function () {
		
        if(this.checked == true){
		
			s += parseInt($(this).attr('data'));
			// alert(s)
        }
    })
    $(".sumM").text(s);
}




// 计算总金额



// $(".num").click(function(){

// 	id=$(this).attr('data-id');
	
// 	price=$(".price"+id).html();
// 	console.log(price);
// 	num=$(".num"+id).val();
// 	console.log(num);

//     sumMoney=num*price;
   
//     $(".summMoney"+id).html(sumMoney);
// })


})
  
</script>
