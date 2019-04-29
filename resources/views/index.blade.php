<html>
    <head>
        <title>echart学习</title>
        <script src="/js/echarts.common.min.js"></script>
    </head>
    <body>
        <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
        <div id="main" style="width: 600px;height:400px;"></div>
        <script type="text/javascript">
            // 基于准备好的dom，初始化echarts实例
            // var chart = echarts.init(dom, 'light');

            //参数一：dom; 参数二：内置主题    light ,dark
            var myChart = echarts.init(document.getElementById('main'),'dark');

            //loading 加载动画
            myChart.hideLoading();               
            // 指定图表的配置项和数据
            var option = {
                title: {
                    text: 'ECharts 入门示例',
                    position:'center',
                },
                tooltip: {},
                legend: {
                    data:['销量']
                },
                xAxis: {
                    data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
                },
                //鼠标悬浮到图形元素上设置（高亮）
                emphasis: {
                    itemStyle: {
                        // 高亮时点的颜色。
                        color: 'blue'
                    },
                    label: {
                        show: true,
                        // 高亮时标签的文字。
                        formatter: 'This is a emphasis label.'
                    }
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
            myChart.on('click', function (params) {
                // 控制台打印数据的名称
                console.log(params.data);
            });
        </script>
    </body>
    
</html>