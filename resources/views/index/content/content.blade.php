<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>小米商城-个人中心</title>
        <base href="./index/">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>
	<body>
	<!-- start header -->
     @include('index.common.header')
	<!--end header -->
	<!-- start banner_x -->
	
<!-- end banner_x -->
<!-- self_info -->
	<div class="grzxbj">
		<div class="selfinfo center">
		<div class="lfnav fl">
		
			
			<div class="ddzx">个人中心</div>
			<div class="subddzx">
				<ul>
			         
					
					<li><a href="/cart">我的购物车</a></li>
					
				</ul>
			</div>
			<div class="ddzx">我的订单</div>
			<div class="subddzx">
				<ul>
			         <li><a href="javascript:;" onclick="unpaid()">待支付订单</a></li>
					 <li><a href="javascript:;" onclick="wait()">待收货</a></li>
					 <li><a href="javascript:;" onclick="comment()">待评论</a></li>
					 <li><a href="javascript:;" onclick="order()">全部订单</a></li>
					 <li><a href="/goodsnew" >为你推荐</a></li>
				</ul>
			</div>
			
		</div>
	

		<div class="rtcont fr">
			<div class="ddzxbt">全部订单</div>
        

           @foreach ($data as $vo)
			<div class="ddxq">
				<div class="ddspt fl"><img src="{{$vo->img}}" width="80px;" alt=""></div>
				<div class="ddbh fl">订单号:{{$vo->order_number}}</div>
				<div class="ztxx fr">
					<ul>
					    <li>{{$vo->goodsname}}
						 
						    </li>
							
						<li>{{$vo->price}}</li>
						<li>{{$vo->state}}</li>
					  
					 	<li><?php echo (date("y/m/d h:i",$vo->create_time))?>
                                						 
						 </li>
					         <li>
					         	<a href="/orderdetail?number={{$vo->order_number}}">详情 ></a>
					         </li>
						<div class="clear"></div>
					</ul>
				</div>
				
				<div class="clear"></div>
			</div>

			
          @endforeach

			
	
		<div class="clear"></div>
		</div>
		
	</div>
<!-- self_info -->
		
		
	</body>
</html>
<script src="./js/jquery-1.8.3.js"> </script>
<script>
function wait(){
    
	$.ajax({
        
		 url:"/wait",
		 dataType:"json",
		success:function(res){
				  
				
			   var str='';
			   str+='<div class="rtcont fr"><div class="ddzxbt">带收货</div>';


			  $.each(res.data,function(i,v){
				//   data= new Date(v.create_time);


                  console.log(v)
                  str+='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';

			  })

			  $(".rtcont").html(str);
		}

	})

}

function order(){
    
	$.ajax({
        
		 url:"/orderall",
		 dataType:"json",
		success:function(res){
			
			   var str='';
			       str+='<div class="rtcont fr"><div class="ddzxbt">全部订单</div>';
			  $.each(res.data,function(i,v){

				// console.log(v)
                  str +='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';
                   
				  
			  })
			    
              
			  $(".rtcont").html(str);
			//   $(".ddxq").remove();
			 
		}

	})

}





function comment(){
    //  alert(1)
	$.ajax({
        
		 url:"/ordercomment",
		 dataType:"json",
		success:function(res){
			var str='';
			       str+='<div class="rtcont fr"><div class="ddzxbt">待评论</div>';
			  $.each(res.data,function(i,v){

				// console.log(v)
                  str +='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';
                   
				  
			  })
			    
              
			  $(".rtcont").html(str);
		}

	})

}

function unpaid(){
    //  alert(1)
	$.ajax({
        
		 url:"/unpaid",
		 dataType:"json",
		success:function(res){
			var str='';
			       str+='<div class="rtcont fr"><div class="ddzxbt">未支付</div>';
			  $.each(res.data,function(i,v){

				// console.log(v)
                  str +='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';
                   
				  
			  })
			    
              
			  $(".rtcont").html(str);
		}

	})

}
</script>