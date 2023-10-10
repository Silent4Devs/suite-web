<div class="row">
    <div class="card card-body">
        <h5 class="titulo-grafica d-flex justify-content-between">
            <div>
                <i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Empleados por área
            </div>
        </h5>
        <div class="row p-4">
            <div class="form-group row col-12">
                <!--
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
                </div> -->
                <div class="col-6">
                    <select class="form-control" id="empleados-area">
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

<div class="row" style="display: flex; justify-content:center">
    <div class=" col-lg-7">
        <div class="card card-body" style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">
                Participación de empleados
                <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h4>
            <canvas id="graf-participacion-de-empleados" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<div class="row" style="display: flex; justify-content:center">
    <div class=" col-lg-7">
        <div class="card card-body" style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">
                Registros Timesheet de este Mes
                <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h4>
            <div class="row p-2">
                <div class="col-12">
                    <select class="form-control" id="registros-atrazados-empleado">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <canvas id="graf-registros-atrasados" width="400" height="400"></canvas>
        </div>
    </div>
    {{-- <div class=" col-lg-6">
        <div class="card card-body" style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">
                Registros en rechazados
                <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
            </h4>
            <div class="row p-2">
                <div class="col-12">
                    <select class="form-control" id="registros-rechazados-empleado">
                        @foreach ($areas_array as $area)
                            <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <canvas id="graf-registros-pendientes" width="400" height="400"></canvas>
        </div>
    </div> --}}
</div>



<script>
    let empleados_general = new Chart(document.getElementById('graf-empleados-por-area'), {
        type: 'horizontalBar',
        data: {
            labels: areas_array[0].empleados.map(item => item.empleado),
            datasets: [{
                    type: "horizontalBar",
                    backgroundColor: "#61CB5C",
                    label: "Aprobados",
                    data: areas_array[0].empleados.map(item => item.aprobado),
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
                    data: areas_array[0].empleados.map(item => item.pendiente),
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
                    data: areas_array[0].empleados.map(item => item.rechazado),
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#aaa",
                    label: "Borradores",
                    data: areas_array[0].empleados.map(item => item.papelera),
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                }
            ]
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
                    display: false,
                    font: {
                        size: 20
                    }
                },
            },
        }
    });
</script>

<script>
    function getRandomColor() {
        let letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    let colores = [];

    for (let k = 0; k < areas_array.length; k++) {
        colores[k] = getRandomColor();
    }

    new Chart(document.getElementById('graf-participacion-de-empleados'), {
        type: 'doughnut',
        data: {
            labels: areas_array.map(item => item.area),
            datasets: [{
                label: null,
                data: areas_array.map(item => item.total_participacion_porcentaje),
                backgroundColor: colores,
            }]
        },
        options: {
            aspectRatio: 1,
            plugins: {
            datalabels: {
                color: '#fff',
                display: false,
                font: {
                    size: 20
                }
            },
        },
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
    });
</script>

<script>
    let registros_atrazados = new Chart(document.getElementById('graf-registros-atrasados'), {
        type: 'doughnut',
        data: {
            labels: ['Registros totales', 'Registros aprobados', 'Registros rechazados'],
            datasets: [{
                label: '%',
                data: [
                    areas_array[0].times_esperados,
                    areas_array[0].times_aprobados,
                    areas_array[0].times_rechazados
                ],
                backgroundColor: [
                    '#29C0D2',
                    '#61CB5C',
                    '#FF5454',
                ],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    display: false,
                    font: {
                        size: 20
                    }
                },
            }
        },
    });
</script>

{{-- <script>
    let grafica_rechazados = new Chart(document.getElementById('graf-registros-pendientes'), {
        type: 'doughnut',
        data: {
            labels: ['Total de registros', 'Registros rechazados'],
            datasets: [{
                data: [
                    areas_array[0].times_esperados,
                    areas_array[0].times_rechazados
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
            },
            plugins: {
                    datalabels: {
                        color: '#fff',
                        display: false,
                        font: {
                            size: 20
                        }
                    },
                }
        },
    });
</script> --}}
