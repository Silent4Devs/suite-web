<div class="row">
    <div class="col-12">
        <div class="card-body card">
            <h5 class="titulo-grafica d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registros Totales del mes
                </div>
            </h5>
            <div class="row p-2 d-flex align-items-center justify-content-center">
                <div class="col-12 row d-flex justify-content-center">
                    <div class="card col-2 bg-secondary text-center text-light m-1 p-3">
                        <span>
                            <strong>{{ $aprobados_contador + $rechazos_contador + $pendientes_contador + $borrador_contador }}</strong>
                        </span>
                        <span>Totales</span>
                    </div>
                    <div class="card col-2 bg-success text-center text-light m-1 p-3">
                        <span>
                            <strong>{{ $aprobados_contador }}</strong>
                        </span>
                        <span>Aprobados</span>
                    </div>
                    <div class="card col-2 bg-primary text-center text-light m-1 p-3">
                        <span>
                            <strong>{{ $pendientes_contador }}</strong>
                        </span>
                        <span>Pendientes</span>
                    </div>
                    <div class="card col-2 bg-warning text-center text-light m-1 p-3">
                        <span>
                            <strong>{{ $rechazos_contador }}</strong>
                        </span>
                        <span>Rechazados</span>
                    </div>
                    <div class="card col-2 bg-danger text-center text-light m-1 p-3">
                        <span>
                            <strong>{{ $borrador_contador }}</strong>
                        </span>
                        <span>Borradores</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-body card">
            <h5 class="titulo-grafica d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registros de Timesheet por Área
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <select class="form-control" id="areas-graf-areas-time">
                            <option value="todas">Todas</option>
                            @foreach ($areas_array as $area)
                                <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Inicio</div>
                            </div>
                            <input type="date" class="form-control" placeholder="Inicio"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>
                    </div>

                    <div class="form-group col-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Fin</div>
                            </div>
                            <input type="date" class="form-control" placeholder="Fin"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
            </h5>
            <canvas id="graf-areas-times-estatus-general" width="400" height="200"></canvas>
            <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 h-100">
        <div class="card card-body">
            <h5 class="titulo-grafica d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registros en Timesheet
                </div>
                <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h5>
            <div class="row p-4">
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
            <canvas id="graf-registros-general" width="400" height="400"></canvas>
            <div class="total_graf_times_inner"
                style="position: absolute; z-index:2; top: -10px; left:0; right:0; bottom: 0; width: 30px; margin:auto; height: 30px; color:#000;">
                <div class="d-flex justify-content-center align-items-center"
                    style="font-size: 50px; font-weight: lighter; margin-top: -40px;">
                    {{-- {{ $aprobados_contador + $rechazos_contador + $pendientes_contador + $borrador_contador }} --}}
                </div>
                <div class="d-flex justify-content-center align-items-center"
                    style="font-size: 30px; margin-top:-15px; font-weight: lighter;">
                    {{-- <small style="color:#777;">Registros</small> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 h-100">
        <div class="card card-body">
            <h5 class="titulo-grafica d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registros de horas trabajadas por Área
                </div>
                <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h5>
            <div class="row p-4">
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
            <canvas id="graf-registros-por-area"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-body card caja-cards-areas">
            <h5 class="titulo-grafica d-flex justify-content-between">
                <div>
                    <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registros Aprobados por Área
                </div>
                <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h5>
            <div style="width: 100%; overflow:auto;" class="scroll_estilo mt-3 d-flex p-2">
                @php
                    $i = 0;
                @endphp
                @foreach ($areas_array as $area_p)
                    @php
                        $i++;
                    @endphp
                    @if ($i == 1)
                        <div>
                    @endif
                    <div class="card-body card" style="position:relative;">
                        <div
                            style="background-color:#DBEBF4; padding: 4px; border-radius: 4px; position: absolute; right: 6px; top: 6px; font-size: 9px;">
                            Total de registros:
                            <strong>{{ $area_p['times_aprobados'] + $area_p['times_pendientes'] + $area_p['times_rechazados'] + $area_p['times_papelera'] }}</strong>
                        </div>
                        <h5 class="mt-2">{{ Str::limit($area_p['area'], 30, '...') }}</h5>
                        <h4>{{ $area_p['partisipacion'] }}% <small style="font-size: 13px;">de participación</small>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar partisipacion-{{ $area_p['nivel_p'] }}" role="progressbar"
                                style="width: {{ $area_p['partisipacion'] }}%"
                                aria-valuenow="{{ $area_p['partisipacion'] }}" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <small><strong>{{ $area_p['times_aprobados'] }}</strong> aprobados</small>

                        {{-- <div class="mt-2">
                                <strong>Aprobación del Área</strong><br>
                                <small><strong>{{ $area_p['times_aprobados'] }}</strong> aprobados / <strong>{{ $area_p['times_pendientes'] }}</strong> pendientes</small>
                            </div> --}}
                    </div>


                    @if ($i == 2)
            </div>
            @php
                $i = 0;
            @endphp
            @endif
            @endforeach
            @if ($i == 1)
        </div>
        @endif
    </div>
</div>
</div>
</div>

<script>
    // TODO: Hay que estructurar los datos que recibimos para esto
    new Chart(document.getElementById('graf-registros-por-area'), {
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
    const legendMargin = {
        id: 'legendMargin',
        beforeInit(chart, legend, options) {
            const fitValue = chart.legend.fit;

            chart.legend.fit = function fit() {
                fitValue.bind(chart.legend)();
                return this.height += 20;
            }
        }
    };
    new Chart(document.getElementById('graf-registros-general'), {
        type: 'doughnut',
        data: {
            labels: ['Aprobados', 'Rechazados', 'Pendientes', 'Borradores'],
            datasets: [{
                label: '# of Votes',
                data: [{{ $aprobados_contador }}, {{ $rechazos_contador }},
                    {{ $pendientes_contador }}, {{ $borrador_contador }}
                ],
                backgroundColor: [
                    '#61CB5C',
                    '#EA7777',
                    '#F48C16',
                    '#aaa',
                ],
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

    // Chart.pluginService.register({
    //   beforeDraw: function(chart) {
    //     var width = chart.chart.width,
    //         height = chart.chart.height,
    //         ctx = chart.chart.ctx;
    //     ctx.restore();
    //     var fontSize = (height / 114).toFixed(2);
    //     ctx.font = fontSize + "em sans-serif";
    //     ctx.textBaseline = "middle";
    //     var text = "{{ $aprobados_contador + $rechazos_contador + $pendientes_contador + $borrador_contador }}",
    //         textX = Math.round((width - ctx.measureText(text).width) / 2),
    //         textY = height / 2;
    //     ctx.fillText(text, textX, textY);
    //     ctx.save();
    //   }
    // });
</script>
<script>
    new Chart(document.getElementById('graf-areas-aprobadas-general'), {
        type: 'bar',
        data: {
            labels: [
                @foreach ($areas_array as $area_a)
                    '{{ $area_a['area'] }}',
                @endforeach
            ],
            datasets: [{
                label: '',
                data: [
                    @foreach ($areas_array as $area_a)
                        {{ $area_a['times_aprobados'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($areas_array as $area_a)
                        '#61CB5C',
                    @endforeach
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
    new Chart(document.getElementById('graf-areas-pendientes-general'), {
        type: 'bar',
        data: {
            labels: [
                @foreach ($areas_array as $area_a)
                    '{{ $area_a['area'] }}',
                @endforeach
            ],
            datasets: [{
                label: '',
                data: [
                    @foreach ($areas_array as $area_a)
                        {{ $area_a['times_pendientes'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($areas_array as $area_a)
                        '#F48C16',
                    @endforeach
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
    new Chart(document.getElementById('graf-areas-rechazadas-general'), {
        type: 'bar',
        data: {
            labels: [
                @foreach ($areas_array as $area_a)
                    '{{ $area_a['area'] }}',
                @endforeach
            ],
            datasets: [{
                label: '',
                data: [
                    @foreach ($areas_array as $area_a)
                        {{ $area_a['times_rechazados'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($areas_array as $area_a)
                        '#EA7777',
                    @endforeach
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
    let areas_array = @json($areas_array);
    console.log(areas_array, 'test')
    document.addEventListener('DOMContentLoaded', function() {
        const areas_labels = (area) => {
            const areas = areas_array.filter(item => item.area === area)
            chart.data.labels = areas.map(item => item['area'])
            chart.data.datasets[0].data = areas.map(item => item['times_aprobados'])
            chart.data.datasets[1].data = areas.map(item => item['times_pendientes'])
            chart.data.datasets[2].data = areas.map(item => item['times_rechazados'])
            chart.data.datasets[3].data = areas.map(item => item['times_papelera'])
            chart.update()
        }
        $('#areas-graf-areas-time').on('change', function(event) {
            if (event.target.value != 'todas') {
                areas_labels(event.target.value)
            } else {
                chart.data.labels = areas_array.map(item => item['area'])
                chart.data.datasets[0].data = areas_array.map(item => item['times_aprobados'])
                chart.data.datasets[1].data = areas_array.map(item => item['times_pendientes'])
                chart.data.datasets[2].data = areas_array.map(item => item['times_rechazados'])
                chart.data.datasets[3].data = areas_array.map(item => item['times_papelera'])
                chart.update()
            }
        });
    });

    var chart = new Chart(document.getElementById("graf-areas-times-estatus-general"), {
        type: "horizontalBar",
        data: {
            labels: areas_array.map(item => {
                return item['area']
            }),
            datasets: [{
                    type: "horizontalBar",
                    backgroundColor: "#61CB5C",
                    label: "Aprobados",
                    data: areas_array.map(item => {
                        return item['times_aprobados']
                    }),
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
                    data: areas_array.map(item => {
                        return item['times_pendientes']
                    }),
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
                    data: areas_array.map(item => {
                        return item['times_rechazados']
                    }),
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#aaa",
                    label: "Borradores",
                    data: areas_array.map(item => {
                        return item['times_papelera']
                    }),
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
