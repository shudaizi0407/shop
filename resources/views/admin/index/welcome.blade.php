<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script type="text/javascript" src="https://cdn.bootcss.com/echarts/4.2.1-rc1/echarts-en.common.js"></script>
<body>
	<div style="text-align: center;color: #19a97b; font-size: 20px;">
		<h2>欢迎使用商城后台管理系统</h2>
		<div><div id="main" style="width: 600px;height:400px;"></div></div>
		<div><div id="zhexian" style="width: 600px;height:400px;"></div></div>
	</div>
</body>
</html>
<script>
        // 绘制图表。
        echarts.init(document.getElementById('main')).setOption({
            series: {
                type: 'pie',
                data: [
                    {name: '衣物', value: 1212},
                    {name: '食品', value: 2323},
                    {name: '其他', value: 1919}
                ]
            }
        });

        echarts.init(document.getElementById('zhexian')).setOption({
        
	    xAxis: {
	        type: 'category',
	        data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
	    },
	    yAxis: {
	        type: 'value'
	    },
	    series: [{
	        data: [820, 932, 901, 934, 1290, 1330, 1320],
	        type: 'line'
	    }]
	
  });
    </script>