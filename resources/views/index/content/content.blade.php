<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="order by dede58.com"/>
		<title>商城-个人中心</title>
        <base href="./index/">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>
	<body>
	<!-- start header -->
   
	<!--end header -->
	<!-- start banner_x -->
	@include('index.common.header')
<!-- end banner_x -->
<!-- self_info -->
	<div class="grzxbj">
		<div class="selfinfo center">
		<div class="lfnav fl">
		
			
			<div class="ddzx" data-id="{{Session::get('uid')}}">个人中心</div>
			<div class="subddzx">
				<ul>
					<li><a href="/cart">我的购物车</a></li>
					<li><a href="javascript:;" onclick="info()">我的个人中心</a></li>
					<li><a href="javascript:;" onclick="addr()">我的地址管理</a></li>
					<li><a href="javascript:;" onclick="money()">我的钱包</a></li>
					<li><a href="javascript:;" onclick="message()">我的消息</a></li>
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
					 <li><a href="/collectlist" >我的收藏</a></li>
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
					    <li>{{$vo->goodsname}}</li>	
						<li>{{$vo->price}}</li>
						<li>{{$vo->state}}</li>

					  
					 	<li><?php echo (date("y/m/d h:i",$vo->create_time))?>
                                						 
						 </li>

					         <li>
					         	<a href="/orderdetail?number={{$vo->order_number}}">详情 ></a>
					         	<a href="/orderdel?order_number={{$vo->order_number}}">移除</a>
					         </li>			
						<div class="clear" ></div>



					</ul>
				</div>
				<div class="clear"></div>
		    </div>
          @endforeach	
	</div>
<!-- self_info -->
		
		<!-- <input type="text" name="user_id" value="2"><span>收货人:</span><input type="text" name="names"><span>联系电话:</span><input type="number" name="tels"><span>收货地址:</span><input type="text" name="addr"><input type="button" class="addradd" value="添加"> -->
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
                  str+='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a><a href="/orderdel?number='+v.order_number+'">移除</a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';

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
                  str +='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a><a href="/orderdel?number='+v.order_number+'">移除</a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';
                   
				  
			  })
			    
              
			  $(".rtcont").html(str);
			//   $(".ddxq").remove();
			 
		}

	})

}

$(document).on('click','.addradd',function(){      
        var addr=$("input[name=addr]").val();
        var names=$("input[name=names]").val();
        var tels=$("input[name=tels]").val();
        var id=$(".ddzx").attr('data-id');
          $.ajax({    
            type:'post',    
            url:'/addr/add',    
            data:{    
                user_id:id,    
                addr:addr,
                names:names,
                tels:tels  
            },
            dataType:'json',
            success:function(res){  
                if(res.code == 200){ 
                	alert('添加成功');  
                	setTimeout(function(){window.location.reload();},100);  
                }else{    
                	alert('超时');  
                }    
    
            }    
       })    
    })    
  



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
                  str +='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a><a href="/orderdel?number='+v.order_number+'">移除</a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';
                   
				  
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
                  str +='<div class="ddxq"><div class="ddspt fl"><img src="'+v.img+'" width="80px;" alt=""></div><div class="ddbh fl">订单号:'+v.order_number+'</div><div class="ztxx fr"><ul><li>'+v.goodsname+'</li><li>'+v.price+'</li><li>'+v.state+'</li><li>19/6/24 12:03</li><li><a href="/orderdetail?number='+v.order_number+'">详情 ></a><a href="/orderdel?number='+v.order_number+'">移除</a></li><div class="clear"></div></ul></div><div class="clear"></div></div>';
                   
				  
			  })
			    
              
			  $(".rtcont").html(str);
		}

	})

}

function info()
{
	$.ajax({
        
		 url:"/info",
		 dataType:"json",
		 success:function(res){
			var str='';
			  $.each(res.data,function(i,v){

				// console.log(v)
                  str +='<div class="rtcont fr"><div class="grzlbt ml40">我的资料</div><div class="subgrzl ml40" data-id="'+v.id+'"><span>昵称</span><span class="uname">'+v.uname+'</span></div><div class="subgrzl ml40" data-id="'+v.id+'"><span>手机号</span><span class="tel">'+v.tel+'</span></div><div class="subgrzl ml40" data-id="'+v.id+'"><span>密码</span><span class="pwd">'+v.pwd+'</span></div><div class="subgrzl ml40" data-id="'+v.id+'"><span>邮箱</span><span class="email">'+v.email+'</span></div></div>';
                   
				  
			  })
			    
              
			  $(".rtcont").html(str);
		}

	})
}


function addr()
{
	$.ajax({
        
		 url:"/addr",
		 dataType:"json",
		 success:function(res){
			var str='<div class="rtcont fr"><div class="grzlbt ml40">我的地址 </div><div class="grzlbt ml40"><span>收货人:</span><input type="text" name="names"><span>&nbsp;&nbsp;联系电话:&nbsp;</span><input type="text" name="tels"><span>&nbsp;&nbsp;收货地址:&nbsp;</span><input type="text" name="addr"><span class="addradd"> &nbsp;添加</span></div>';
			  $.each(res.data,function(i,v){

				// console.log(v)
                  str +='<div class="subgrzl ml40" data-id="'+v.id+'"><span>收货地址'+(i+1)+'</span><span class="addr">'+v.addr+'</span><span onclick="del('+v.id+')" style="cursor:pointer;">×</span></div>';
			  })
			  str+='</div>';
			  $(".rtcont").html(str);
		}
	})
}

$(document).on('click','.addr',function(){    
        old_val=$(this).html();    
        $(this).parent().html("<input type=\'text\' value="+old_val+">");    
        $(document).on('blur','input',function(){    
        var obj=$(this);    
        var id=$(this).parent().attr('data-id'); //获取要修改内容的id    
        var val=$(this).val(); //获取修改后的值  
          $.ajax({    
            type:'put',    
            url:'/addr/update',    
            data:{    
                id:id,    
                addr:val  
            },    
            success:function(res){   
                if(res.code == 200){   
                	setTimeout(function(){window.location.reload();},100);
                    obj.parent().html("<span class='addr'>"+val+"</span>")    
                }else{    
                	setTimeout(function(){window.location.reload();},100);
                    obj.parent().html("<span class='addr'>"+old_val+"</span>")    
                }    
    
            }    
       })    
    })    
})   

function del(id)
{
	$.ajax({    
            type:'delete',    
            url:'/addr/del',    
            data:{    
                id:id    
            },    
            success:function(res){   
                if(res.code == 200){   
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},100);
                }else{    
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},100);
                }    
    
            }    
       }) 
}

function message()
{
	$.ajax({
        
		 url:"/message",
		 dataType:"json",
		 success:function(res){
			var str='';
			  $.each(res.data,function(i,v){

				// console.log(v)
                  str +='<div class="rtcont fr"><div class="grzlbt ml40">我的消息</div><div class="subgrzl ml40"><span>内容</span><span>'+v.content+'</span></div></div>';
			  })
			  $(".rtcont").html(str);
		}

	})
}

$(document).on('click','.uname',function(){    
        old_val=$(this).html();    
        $(this).parent().html("<input type=\'text\' value="+old_val+">");    
        $(document).on('blur','input',function(){    
        var obj=$(this);    
        var id=$(this).parent().attr('data-id'); //获取要修改内容的id    
        var val=$(this).val(); //获取修改后的值  
          $.ajax({    
            type:'put',    
            url:'/info/update',    
            data:{    
                id:id,    
                uname:val
            },    
            success:function(res){   
                if(res.code == 200){   
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},1000); 
                }else{    
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},1000); 
                }    
    
            }    
       })    
    })    
})

$(document).on('click','.email',function(){    
        old_val=$(this).html();    
        $(this).parent().html("<input type=\'text\' value="+old_val+">");    
        $(document).on('blur','input',function(){    
        var obj=$(this);    
        var id=$(this).parent().attr('data-id'); //获取要修改内容的id    
        var val=$(this).val(); //获取修改后的值  
          $.ajax({    
            type:'put',    
            url:'/info/update',    
            data:{    
                id:id,    
                email:val
            },    
            success:function(res){   
                if(res.code == 200){   
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},1000); 
                }else{    
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},1000); 
                }    
    
            }    
       })    
    })    
})

$(document).on('click','.tel',function(){    
        old_val=$(this).html();    
        $(this).parent().html("<input type=\'text\' value="+old_val+">");    
        $(document).on('blur','input',function(){    
        var obj=$(this);    
        var id=$(this).parent().attr('data-id'); //获取要修改内容的id    
        var val=$(this).val(); //获取修改后的值  
          $.ajax({    
            type:'put',    
            url:'/info/update',    
            data:{    
                id:id,    
                tel:val
            },    
            success:function(res){   
                if(res.code == 200){   
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},1000); 
                }else{    
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},1000); 
                }    
    
            }    
       })    
    })    
})

$(document).on('click','.pwd',function(){    
        old_val=$(this).html();    
        $(this).parent().html("<input type=\'text\' value="+old_val+">");    
        $(document).on('blur','input',function(){    
        var obj=$(this);    
        var id=$(this).parent().attr('data-id'); //获取要修改内容的id    
        var val=$(this).val(); //获取修改后的值  
          $.ajax({    
            type:'put',    
            url:'/info/update',    
            data:{    
                id:id,    
                pwd:val
            },    
            success:function(res){   
                if(res.code == 200){ 
                	alert(res.message);  
                	setTimeout(function(){window.location.reload();},1000); 
                }else{   
                	alert(res.message);
                	setTimeout(function(){window.location.reload();},1000); 
                }    
    
            }    
       })    
    })    
})

function money()
{
	$.ajax({
		 url:"/showDiscount",
		 dataType:"json",
		 success:function(res){
			var str='';
			  $.each(res.data,function(i,v){
                  str +='<div class="rtcont fr"><div class="grzlbt ml40">优惠券</div><div class="subgrzl ml40"><span>'+v.instructions+'</span><span>'+v.start_time+'—'+v.end_time+'</span></div></div>';
			  })
			  $(".rtcont").html(str);
		}
	})
}
</script>
