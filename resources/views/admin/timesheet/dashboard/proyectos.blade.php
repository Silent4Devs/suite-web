<div class="row">
    @livewire('timesheet.dashboard-proyectos')
</div>

{{-- <div class="row">
    <div class="col-12">
        <div class="card-body card">
            <h5 class="titulo-grafica d-flex justify-content-between">
                <span>
                    <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Horas invertidas por proyecto activo
                </span>
            </h5>
            <div class="row p-3">
                <div class="form-group col-3">
                    <label for="">En proceso</label>
                    <select class="form-control" id="proyectos-en-proceso">
                        @foreach ($proyectos['proyectos_lista']['proceso'] as $proyecto)
                            <option value="{{ $proyecto['proyecto'] }}">{{ $proyecto['proyecto'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="">Terminados</label>
                    <select class="form-control" id="proyectos-terminados">
                        @foreach ($proyectos['proyectos_lista']['terminados'] as $proyecto)
                            <option value="{{ $proyecto['proyecto'] }}">{{ $proyecto['proyecto'] }}</option>
                        @endforeach
                    </select>
                </div>
                @if (isset($proyectos['proyectos_lista']['cancelados']))
                    <div class="form-group col-6">
                        <label for="">Cancelado</label>
                        <select class="form-control" id="proyectos-cancelados">
                            @foreach ($proyectos['proyectos_lista']['cancelado'] as $proyecto)
                                <option value="{{ $proyecto['proyecto'] }}">{{ $proyecto['proyecto'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <canvas id="graf-proyectos-times-general"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class=" col-md-6">
        <div class="card card-body">
            <h4 class="titulo-grafica d-flex justify-content-between">Horas invertidas en proyectos <a
                    href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="horas-totales-proyectos" width="400" height="400"></canvas>

            <div class="d-flex mt-4">
                Horas invertidas totales:
                <strong class="ml-3">
                    {{ $proyectos['horas_totales'] }}
                </strong>
            </div>
        </div>
    </div>

    <div class=" col-md-6">
        <div class="card card-body">
            <h4 class="titulo-grafica d-flex justify-content-between">Proyectos <a
                    href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="graf-proyectos-estatus" width="400" height="400"></canvas>
            <div class="d-flex mt-4">
                Proyectos totales:
                <strong class="ml-3">
                    {{ $proyectos['total_proyectos'] }}
                </strong>
            </div>
        </div>
    </div>
</div>
<script>
    console.log(proyectos)
    new Chart(document.getElementById('graf-proyectos-estatus'), {
        type: 'doughnut',
        data: {
            labels: ['En proceso', 'Cancelados', 'Terminados'],
            datasets: [{
                data: [
                    proyectos.proyectos_en_proceso,
                    proyectos.proyectos_cancelados,
                    proyectos.horas_terminados
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
    new Chart(document.getElementById('horas-totales-proyectos'), {
        type: 'doughnut',
        data: {
            labels: ['En proceso', 'Cancelados', 'Terminados'],
            datasets: [{
                label: 'Horas',
                data: [
                    proyectos.horas_proceso,
                    proyectos.horas_cancelados,
                    proyectos.horas_terminados
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
                data: [],
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
    let grafica_proyectos = new Chart(document.getElementById('graf-proyectos-times-general'), {
        type: "bar",
        data: {
            labels: [proyectos.proyectos_lista.proceso[0].proyecto],
            datasets: [{
                    backgroundColor: "#61CB5C",
                    label: "Horas totales",
                    data: [proyectos.proyectos_lista.proceso[0].horas_totales],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    backgroundColor: "#EA7777",
                    label: "Tareas totales",
                    data: [proyectos.proyectos_lista.proceso[0].tareas_count],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
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
</script> --}}
