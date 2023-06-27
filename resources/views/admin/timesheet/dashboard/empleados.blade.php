<div class="row">
    <div class="card card-body">
        <h5 class="titulo-grafica d-flex justify-content-between">
            <div>
                <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Empleados por área
            </div>
        </h5>
        <div class="row p-4">
            <div class="form-group row col-12">
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Inicio</div>
                    </div>
                    <input type="date" class="form-control">
                </div>
                <div class="input-group col-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                    </div>
                    <input type="date" class="form-control">
                </div>
                <div class="col-6">
                    <select class="form-control">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <canvas id="graf-empleados-por-area"></canvas>
    </div>
</div>

<div class="row">
    <div class=" col-lg-4 p-4">
        <div class="card card-body" style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">Participación de empleados <a
                    href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h4>
            <div class="row p-2">
                <div class="col-12">
                    <select class="form-control">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <div class="row mt-2">
                        <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Inicio</div>
                            </div>
                            <input type="date" class="form-control">
                        </div>
                        <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Fin</div>
                            </div>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="graf-participacion-de-empleados" width="400" height="400"></canvas>
        </div>
    </div>
    <div class=" col-lg-4 p-4">
        <div class="card card-body">
            <h4 class="titulo-grafica d-flex justify-content-between">
                Registros atrasados este mes
                <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h4>
            <div class="row p-2">
                <div class="col-12">
                    <select class="form-control">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <div class="row mt-2">
                        <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Inicio</div>
                            </div>
                            <input type="date" class="form-control">
                        </div>
                        <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Fin</div>
                            </div>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="graf-registros-atrasados" width="400" height="400"></canvas>
        </div>
    </div>
    <div class=" col-lg-4 p-4">
        <div class="card card-body" style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">Registros pendientes <a
                    href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h4>
            <div class="row p-2">
                <div class="col-12">
                    <select class="form-control">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <div class="row mt-2">
                        <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Inicio</div>
                            </div>
                            <input type="date" class="form-control">
                        </div>
                        <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Fin</div>
                            </div>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="graf-registros-pendientes" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="card card-body">
        <h5 class="titulo-grafica d-flex justify-content-between">
            <div>
                <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registro de horas por Área
            </div>
        </h5>
        <div class="row p-4">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Intervalo de tiempo</label>
            <div class="form-group row">
                <div class="input-group col-6">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Inicio</div>
                    </div>
                    <input type="date" class="form-control">
                </div>
                <div class="input-group col-6">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                    </div>
                    <input type="date" class="form-control">
                </div>
            </div>
        </div>
        <canvas id="graf-horas-por-area"></canvas>
    </div>
</div>

<script>
    // TODO: Hay que estructurar los datos que recibimos para esto
    new Chart(document.getElementById('graf-empleados-por-area'), {
        type: 'bar',
        data: {
            labels: [
                @foreach ($areas_array as $area_a)
                    '{{ $area_a['area'] }}',
                @endforeach
            ],
            datasets: [{
                label: null,
                data: [{{ $aprobados_contador }}, {{ $rechazos_contador }},
                    {{ $pendientes_contador }}, {{ $borrador_contador }}
                ],
                backgroundColor: '#25A0E2',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            layout: {
                padding: {
                    top: 20
                }
            },
            legend: {
                display: true,
                position: 'bottom',
                align: 'start',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 10
                }
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    display: true,
                    font: {
                        size: 20
                    }
                },
            },
        }
    });
</script>

<script>
    new Chart(document.getElementById('graf-participacion-de-empleados'), {
        type: 'doughnut',
        data: {
            labels: ['Empleados con registros', 'Empleados sin registros'],
            datasets: [{
                label: 'Empleados',
                data: [
                    @foreach ($areas as $area)
                        {{ $area->empleados->count() }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($areas as $area)
                        '#34DCCF',
                    @endforeach
                ],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        },

        plugins: [{
            /* Adjust axis labelling font size according to chart size */
            beforeDraw: function(c) {
                var chartHeight = c.chart.height;
                var size = chartHeight * 5 / 100;
                c.scales['y-axis-0'].options.ticks.minor.fontSize = size;
            }
        }]
    });
</script>

<script>
    new Chart(document.getElementById('graf-registros-atrasados'), {
        type: 'doughnut',
        data: {
            labels: ['Registros actuales', 'Registros atrasados'],
            datasets: [{
                label: '%',
                data: [{{ $porcentaje_participacion }}, {{ 100 - $porcentaje_participacion }}],
                backgroundColor: [
                    '#29C0D2',
                    '#bbb',
                ],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    new Chart(document.getElementById('graf-registros-pendientes'), {
        type: 'doughnut',
        data: {
            labels: ['Empleados con registros', 'Empleados sin registros'],
            datasets: [{
                label: 'Empleados',
                data: [{{ $empleados_times_atrasados }},
                    {{ $empleados_count - $empleados_times_atrasados }}
                ],
                backgroundColor: [
                    '#FF5454',
                    '#29C0D2',
                ],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    // TODO: Hay que estructurar los datos que recibimos para esto
    new Chart(document.getElementById('graf-horas-por-area'), {
        type: 'bar',
        data: {
            labels: [
                @foreach ($areas_array as $area_a)
                    '{{ $area_a['area'] }}',
                @endforeach
            ],
            datasets: [{
                label: null,
                data: [{{ $aprobados_contador }}, {{ $rechazos_contador }},
                    {{ $pendientes_contador }}, {{ $borrador_contador }}
                ],
                backgroundColor: '#25A0E2',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            layout: {
                padding: {
                    top: 20
                }
            },
            legend: {
                display: true,
                position: 'bottom',
                align: 'start',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 10
                }
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    display: true,
                    font: {
                        size: 20
                    }
                },
            },
        }
    });
</script>
