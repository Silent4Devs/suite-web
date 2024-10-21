<div>
    <div class="card card-body">
        <div class="d-flex justify-content-end">
            <input type="month" placeholder="Mes | Año" name="mes_año" wire:model.live="mes_año" id=""
                class="form-control" style="width: 200px;">
        </div>
        <div id="chart-container-solicitudes-tipos" style="width: 100%; height: 300px;"></div>
    </div>
    @section('scripts')
        @parent
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                setTimeout(() => {
                    var dom = document.getElementById('chart-container-solicitudes-tipos');
                    var myChart = echarts.init(dom, null, {
                        renderer: 'canvas',
                        useDirtyRect: false
                    });
                    var app = {};

                    var option;

                    let dataPermisos = [];
                    let permisosDataBase = @json($permisosCollect);
                    permisosDataBase.forEach(permiso => {
                        dataPermisos.push([permiso['nombre'], permiso['noPermisos']]);
                    });

                    option = {
                        legend: {},
                        tooltip: {},
                        dataset: {
                            source: dataPermisos,
                        },
                        xAxis: {
                            type: 'category',
                            axisLabel: {
                                rotate: 45, // Rotar las etiquetas 45 grados
                                formatter: function(value) {
                                    // Ajustar el valor de 10 según el espacio disponible
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
                        }]
                    };

                    if (option && typeof option === 'object') {
                        myChart.setOption(option);
                    }

                    window.addEventListener('resize', myChart.resize);

                }, 500);
            });


            Livewire.on('renderScriptsTypes', (data) => {
                setTimeout(() => {
                    var dom = document.getElementById('chart-container-solicitudes-tipos');
                    var myChart = echarts.init(dom, null, {
                        renderer: 'canvas',
                        useDirtyRect: false
                    });
                    var app = {};

                    var option;

                    let dataPermisos = [];

                    data[0].forEach(permiso => {
                        dataPermisos.push([permiso['nombre'], permiso['noPermisos']]);
                    });

                    option = {
                        legend: {},
                        tooltip: {},
                        dataset: {
                            source: dataPermisos,
                        },
                        xAxis: {
                            type: 'category',
                            axisLabel: {
                                rotate: 45, // Rotar las etiquetas 45 grados
                                formatter: function(value) {
                                    // Ajustar el valor de 10 según el espacio disponible
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
                        }]
                    };

                    if (option && typeof option === 'object') {
                        myChart.setOption(option);
                    }

                    window.addEventListener('resize', myChart.resize);

                }, 500);
            });
        </script>
    @endsection
</div>
