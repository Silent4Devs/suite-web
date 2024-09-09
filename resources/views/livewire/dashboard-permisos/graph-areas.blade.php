<div>
    <div class="card card-body">
        <div class="d-flex justify-content-end">
            <input type="month" placeholder="Mes | Año" name="" id="" class="form-control"
                style="width: 200px;">
        </div>
        <div id="chart-container-solicitudes-areas" style="width: 100%; height: 300px;"></div>
    </div>

    <script>
        var dom = document.getElementById('chart-container-solicitudes-areas');
        var myChart = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        var app = {};

        var option;

        option = {
            legend: {},
            tooltip: {},
            dataset: {
                source: [
                    ['', 'Vacaciones', 'Day Off', 'Permisos'],
                    ['Dearrollo', 43.3, 85.8, 93.7],
                    ['Innovación', 83.1, 73.4, 55.1],
                    ['Soporte', 86.4, 65.2, 82.5],
                    ['Marketing', 72.4, 53.9, 39.1],
                    ['Ciberinteligencia', 72.4, 53.9, 39.1],
                    ['Contabilida', 72.4, 53.9, 39.1],
                    ['Dearrollo', 72.4, 53.9, 39.1],
                    ['Innovación', 72.4, 53.9, 39.1],
                    ['SOC/NOC', 72.4, 53.9, 39.1],
                    ['Ciberinteligencia', 72.4, 53.9, 39.1],
                    ['Soporte', 72.4, 53.9, 39.1],
                ]
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {},
            // Declare several bar series, each will be mapped
            // to a column of dataset.source by default.
            series: [{
                type: 'bar'
            }, {
                type: 'bar'
            }, {
                type: 'bar'
            }]
        };

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);
    </script>
</div>
