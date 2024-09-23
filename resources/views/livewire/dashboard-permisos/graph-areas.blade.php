<div>
    <div class="card card-body">
        <div class="d-flex justify-content-end">
            <input type="month" placeholder="Mes | Año" name="mes_año" wire:model.live="mes_año" id=""
                class="form-control" style="width: 200px;">
        </div>
        <div id="chart-container-solicitudes-areas" style="width: 100%; height: 400px;"></div>
    </div>

    @section('scripts')
        @parent
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    var dom = document.getElementById('chart-container-solicitudes-areas');
                    var myChart = echarts.init(dom, null, {
                        renderer: 'canvas',
                        useDirtyRect: false
                    });
                    var app = {};

                    var option;

                    let dataAreas = [
                        ['', 'Vacaciones', 'Day Off', 'Permisos'],
                        // ['Dearrollo', 43.3, 85.8, 93.7],
                        // ['Innovación', 83.1, 73.4, 55.1],
                        // ['Soporte', 86.4, 65.2, 82.5],
                        // ['Marketing', 72.4, 53.9, 39.1],
                        // ['Ciberinteligencia', 72.4, 53.9, 39.1],
                        // ['Contabilida', 72.4, 53.9, 39.1],
                        // ['Dearrollo', 72.4, 53.9, 39.1],
                        // ['Innovación', 72.4, 53.9, 39.1],
                        // ['SOC/NOC', 72.4, 53.9, 39.1],
                        // ['Ciberinteligencia', 72.4, 53.9, 39.1],
                        // ['Soporte', 72.4, 53.9, 39.1],
                    ];
                    let areasDataBase = @json($areasCollect);
                    areasDataBase.forEach(area => {
                        dataAreas.push([area['area'], area['vacaciones'], area['dayOff'], area[
                            'permisos']]);
                    });

                    option = {
                        legend: {},
                        tooltip: {},
                        dataset: {
                            source: dataAreas,
                        },
                        xAxis: {
                            type: 'category',
                            axisLabel: {
                                rotate: 45,
                                formatter: function(value) {
                                    // Puedes ajustar el valor de 10 según el espacio disponible
                                    var maxLength = 10;
                                    if (value.length > maxLength) {
                                        return value.slice(0, maxLength) +
                                            '...'; // Mostrar solo una parte del texto
                                    }
                                    return value;
                                }
                            }
                        },
                        yAxis: {},
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
                }, 1000);
            });

            Livewire.on('renderScripts', (data) => {
                setTimeout(() => {

                    console.log(data[0]);
                    var dom = document.getElementById('chart-container-solicitudes-areas');
                    var myChart = echarts.init(dom, null, {
                        renderer: 'canvas',
                        useDirtyRect: false
                    });
                    var app = {};

                    var option;

                    let dataAreas = [
                        ['', 'Vacaciones', 'Day Off', 'Permisos'],
                        // ['Dearrollo', 43.3, 85.8, 93.7],
                        // ['Innovación', 83.1, 73.4, 55.1],
                        // ['Soporte', 86.4, 65.2, 82.5],
                        // ['Marketing', 72.4, 53.9, 39.1],
                        // ['Ciberinteligencia', 72.4, 53.9, 39.1],
                        // ['Contabilida', 72.4, 53.9, 39.1],
                        // ['Dearrollo', 72.4, 53.9, 39.1],
                        // ['Innovación', 72.4, 53.9, 39.1],
                        // ['SOC/NOC', 72.4, 53.9, 39.1],
                        // ['Ciberinteligencia', 72.4, 53.9, 39.1],
                        // ['Soporte', 72.4, 53.9, 39.1],
                    ];

                    data[0].forEach(area => {
                        dataAreas.push([area['area'], area['vacaciones'], area['dayOff'], area[
                            'permisos']]);
                    });

                    option = {
                        legend: {},
                        tooltip: {},
                        dataset: {
                            source: dataAreas,
                        },
                        xAxis: {
                            type: 'category',
                            axisLabel: {
                                rotate: 45,
                                formatter: function(value) {
                                    // Puedes ajustar el valor de 10 según el espacio disponible
                                    var maxLength = 10;
                                    if (value.length > maxLength) {
                                        return value.slice(0, maxLength) +
                                            '...'; // Mostrar solo una parte del texto
                                    }
                                    return value;
                                }
                            }
                        },
                        yAxis: {},
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
                }, 1000);
            });
        </script>
    @endsection
</div>
