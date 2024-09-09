<div>
    <div class="card card-body">
        <div class="d-flex justify-content-end">
            <input type="month" placeholder="Mes | Año" name="" id="" class="form-control"
                style="width: 200px;">
        </div>
        <div id="chart-container-solicitudes-tipos" style="width: 100%; height: 300px;"></div>
    </div>

    <script>
        var dom = document.getElementById('chart-container-solicitudes-tipos');
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
                    ['Nacimiento', 0],
                    ['Exámen profesional', 0],
                    ['Cumpleaños', 0],
                    ['Muerte familiar', 0]
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
            }, ]
        };

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);
    </script>
</div>
