<header>
			<div class="top center">
				<div class="left fl">
					<ul>
						<li><a href="http://www.shop.com/index1" target="_blank">首页</a></li>
						<li>|</li>
						<li><a href="">MIUI</a></li>
						<li>|</li>
						<li><a href="">米聊</a></li>
						<li>|</li>
						<li><a href="">游戏</a></li>
						<li>|</li>
						<li><a href="">多看阅读</a></li>
						<li>|</li>
						<!-- <li><a href="">云服务</a></li>
						<li>|</li>
						<li><a href="">金融</a></li>
						<li>|</li>
						<li><a href="">小米商城移动版</a></li>
						<li>|</li>
						<li><a href="">问题反馈</a></li>
						<li>|</li> -->
						<li><a href="">Select Region</a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="right fr">

					<div class="gouwuche fr"><a href="/cart">购物车</a></div>
					<div class="fr">
						<ul>
							<li>
							@if(Session::get('uid'))

							
								<a href="javascript:void(0);" class="back">欢迎：{{Session::get('uid')}}退出登录</a>
								
									
							
								@else
									
										<a href="/index-login" target="_blank">登录</a>
								@endif
							
									</li>
							<li>|</li>
							<li><a href="/index-register" target="_blank" >注册</a></li>
							<li>|</li>
							<li><a href="/content">个人中心</a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</header>

        
			
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script>
	$(".back").click(function(){

		$.ajax({
			url:'../cleans',
			success:function(res){
				
					//alert(1111111)
					history.go(0)
			
			}
		})
	})
</script>
