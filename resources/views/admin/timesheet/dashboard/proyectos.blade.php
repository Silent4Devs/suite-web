<div class="row">
    <div class="col-12">
        <div class="card-body card">
            <h5 class="titulo-grafica d-flex justify-content-between">
                <span>
                    <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Horas invertidas por proyecto activo
                </span>
            </h5>
            <div class="row p-3">
                <div class="form-group col-3">
                    <select class="form-control">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <select class="form-control">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <select class="form-control">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3 row">
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Inicio</div>
                        </div>
                        <input type="date" class="form-control" placeholder="Inicio"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3 col-6">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Fin</div>
                        </div>
                        <input type="date" class="form-control" placeholder="Fin" aria-label="Recipient's username"
                            aria-describedby="basic-addon2">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineRadio1">Terminados</label>
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineRadio2">En proceso</label>
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2">
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineRadio3">Cancelados</label>
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="option3">
                    </div>
                </div>
            </div>
            <canvas id="graf-proyectos-times-general"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class=" col-md-4 p-4">
        <div class="card card-body">
            <h4 class="titulo-grafica d-flex justify-content-between">Horas invertidas en proyectos <a
                    href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="graf-proyectos" width="400" height="400"></canvas>

            <div class="d-flex mt-4">
                Horas invertidas totales: <strong class="ml-3">
                    {{ $proyectos_proceso_array + $proyectos_cancelado_array + $proyectos_terminado_array }}</strong>
            </div>
        </div>
    </div>

    <div class=" col-md-4 p-4">
        <div class="card card-body">
            <h4 class="titulo-grafica d-flex justify-content-between">Proyectos <a
                    href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="graf-proyectos-estatus" width="400" height="400"></canvas>
            <div class="d-flex mt-4">
                Proyectos totales: <strong class="ml-3">
                    {{ $proyectos_proceso_c + $proyectos_cancelados_c + $proyectos_terminados_c }}</strong>
            </div>
        </div>
    </div>

    <div class=" col-md-4 p-4">
        <div class="card card-body">
            <h4 class="titulo-grafica d-flex justify-content-between">Áreas <a
                    href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="graf-areas" width="400" height="400"></canvas>
            <div class="d-flex mt-4">
                Horas invertidas totales: <strong class="ml-3">
                    {{ $proyectos_proceso_c + $proyectos_cancelados_c + $proyectos_terminados_c }}</strong>
            </div>
        </div>
    </div>
</div>
<script>
    new Chart(document.getElementById('graf-proyectos-estatus'), {
        type: 'doughnut',
        data: {
            labels: ['En proceso', 'Cancelados', 'Terminados'],
            datasets: [{
                label: '%',
                data: [{{ $proyectos_proceso_c }}, {{ $proyectos_cancelados_c }},
                    {{ $proyectos_terminados_c }}
                ],
                backgroundColor: [
                    '#F48C16',
                    '#bbb',
                    '#61CB5C',
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
    new Chart(document.getElementById('graf-proyectos'), {
        type: 'doughnut',
        data: {
            labels: ['En proceso', 'Cancelados', 'Terminados'],
            datasets: [{
                label: 'Horas',
                data: [
                    {{ $proyectos_proceso_array }}, {{ $proyectos_cancelado_array }},
                    {{ $proyectos_terminado_array }}
                ],
                backgroundColor: [
                    '#F48C16',
                    '#bbb',
                    '#61CB5C',
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
    new Chart(document.getElementById('graf-areas'), {
        type: 'doughnut',
        data: {
            labels: ['En proceso', 'Cancelados', 'Terminados'],
            datasets: [{
                label: 'Horas',
                data: [
                    {{ $proyectos_proceso_array }}, {{ $proyectos_cancelado_array }},
                    {{ $proyectos_terminado_array }}
                ],
                backgroundColor: [
                    '#F48C16',
                    '#bbb',
                    '#61CB5C',
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
    new Chart(document.getElementById('graf-proyectos-times-general'), {
        type: "horizontalBar",
        data: {
            labels: [
                @foreach ($areas_array as $area_a)
                    '{{ $area_a['area'] }}',
                @endforeach
            ],
            datasets: [{
                    type: "horizontalBar",
                    backgroundColor: "#61CB5C",
                    label: "Aprobados",
                    data: [
                        @foreach ($areas_array as $area)
                            {{ $area['times_aprobados'] }},
                        @endforeach
                    ],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#F48C16",
                    label: "Pendientes",
                    data: [
                        @foreach ($areas_array as $area)
                            {{ $area['times_pendientes'] }},
                        @endforeach
                    ],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#EA7777",
                    label: "Rechazados",
                    data: [
                        @foreach ($areas_array as $area)
                            {{ $area['times_rechazados'] }},
                        @endforeach
                    ],
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#aaa",
                    label: "Borradores",
                    data: [
                        @foreach ($areas_array as $area)
                            {{ $area['times_papelera'] }},
                        @endforeach
                    ],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                }
            ]
        },
        options: {
            yAxis: {
                title: {
                    text: 'Total tipo contrato'
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Áreas',
                        fontSize: 15,
                        fontColor: "#345183"
                    },
                    gridLines: {
                        color: "#ccc"
                    },
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Registros de Timesheet',
                        fontSize: 15,
                        fontColor: "#345183"
                    },
                    gridLines: {
                        color: "#ccc"
                    },
                }]
            },
            plugins: {
                datalabels: {
                    color: '#000',
                    display: true,
                    font: {
                        size: 8
                    },
                    formatter: function(value, index, values) {
                        if (value > 0) {
                            return value;
                        }
                        return '';
                    }
                },
            },
        },
    });
</script>
