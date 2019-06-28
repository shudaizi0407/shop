<!DOCTYPE html>
<html>
@include('admin.common.head')
<body>
<!--header-->
@include('admin.common.header')
<!--aside nav-->
<!--aside nav-->
@include('admin.common.aside')
<script type="text/javascript" src="https://cdn.bootcss.com/echarts/4.2.1-rc1/echarts-en.common.js"></script>
<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">商品显示图</h2>
       <a href="goods-list" class="fr top_rt_btn">返回产品列表</a>
      </div>
     <div id="main" style="width: 600px;height:400px;"></div>
 </div>
</section>

</body>
</html>
<script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        // myChart.showLoading();
        // $.get('data.json').done(function (data) {
        //     myChart.hideLoading();
        //     myChart.setOption(ar);
        // });
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'ECharts 段跃飞商城热门销量'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        
    </script>