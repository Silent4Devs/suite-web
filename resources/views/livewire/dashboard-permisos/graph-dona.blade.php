<div>
    <div class="card card-body">
        <div class="d-flex justify-content-end">
            <input type="month" placeholder="Mes | Año" name="" id="" class="form-control"
                style="width: 200px;">
        </div>
        <div id="chart-container-solicitudes-global" style="width: 100%; height: 300px;"></div>
    </div>
    <script>
        var dom = document.getElementById('chart-container-solicitudes-global');
        var myChart = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        var app = {};

        var option;

        option = {
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: '5%',
                left: 'center'
            },
            series: [{
                name: 'Access From',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 40,
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: [{
                        value: 40,
                        name: 'Vacaciones'
                    },
                    {
                        value: 10,
                        name: 'Day Off'
                    },
                    {
                        value: 50,
                        name: 'Permisos'
                    },
                ]
            }]
        };

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);
    </script>
</div>