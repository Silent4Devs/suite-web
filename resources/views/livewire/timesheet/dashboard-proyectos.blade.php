<div>
    <x-loading-indicator />
    <div class="card card-body">
        <div class="row">
            <div class="col-md-6 form-group" style="padding-left:0px !important;">
                <label class="form-label">Estatus</label>
                <select class="form-control" wire:model="estatus">
                    <option selected value="todos">Todos</option>
                    <option value="proceso">En Proceso</option>
                    <option value="terminado">Terminados</option>
                    <option value="cancelado">Cancelados</option>
                </select>
            </div>
            <div class="col-md-6 form-group" style="padding-left:0px !important;">
            <label class="form-label">Proyecto</label>
            <select class="form-control" wire:model="proy_id">
                <option value="0" selected>Seleccione un proyecto</option>
                @foreach ($lista_proyectos as $pro)
                    <option value="{{ $pro->id }}">{{$pro->identificador}} - {{ $pro->proyecto }}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group" style="padding-left:0px !important;">
            <label class="form-label">Areas</label>
            <select class="form-control" wire:model="area_id">
                <option value="todas">Todas</option>
                @foreach ($lista_areas as $area)
                    <option value="{{ $area->area->id }}">{{ $area->area->area }}</option>
                @endforeach
            </select>
            </div>
        </div>
    </div>
    <div class="card card-body" style="min-height:330px !important; min-width:1200px;" id="contenedor-principal">
        <canvas id="graf-proyectos-area"></canvas>
    </div>
    <div class="row">
        <div class=" col-lg-6">
            <div class="card card-body" style="min-height:500px !important; min-width:500px !important;" id="contenedor-areas">
                <h3>Horas Invertidas en el Proyecto por Área</h3>
                <canvas id="graf-participacion-areas" width="600" height="600"></canvas>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="card card-body" style="min-height:500px !important; min-width:500px !important;" id="contenedor-tareas">
                <h3>Tareas en el Proyecto por Área</h3>
                <canvas id="graf-participacion-tareas" width="600" height="600"></canvas>
            </div>
        </div>
    </div>
    <div class="card card-body" style="min-height:330px !important; min-width:1200px;" id="contenedor-empleados">
        <canvas id="graf-proyectos-empleado"></canvas>
    </div>
</div>

<script>
    function getRandomColor() {
        let letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
        }

    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('renderAreas', (datos_areas, datos_empleados) => {
            // console.log(datos_areas);
            // console.log(datos_empleados);

            document.getElementById('graf-proyectos-area').remove();

            var canvas = document.createElement("canvas");
            canvas.id = "graf-proyectos-area";
            document.getElementById("contenedor-principal").appendChild(canvas);

            let grafica_proyectos = new Chart(document.getElementById('graf-proyectos-area'), {
                type: 'horizontalBar',
        data: {
            labels: datos_areas.map(item => item.area),
            datasets: [{
                    type: "horizontalBar",
                    backgroundColor: "#61CB5C",
                    label: "Horas Invertidas",
                    data: datos_areas.map(item => item.total_horas_area),
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#F48C16",
                    label: "Tareas Asignadas del Proyecto",
                    data: datos_areas.map(item => item.tareas),
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
            ]
        },
            options: {
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
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Horas Trabajadas en el Proyecto',
                        fontSize: 15,
                        fontColor: "#345183"
                    },
                    gridLines: {
                        color: "#ccc"
                    },
                }]
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

        document.getElementById('graf-participacion-areas').remove();

        var donareas = document.createElement("canvas");
        donareas.id = "graf-participacion-areas";
        document.getElementById("contenedor-areas").appendChild(donareas);

        let colores = [];

        for (let j = 0; j < datos_areas.length; j++) {
            colores[j] = getRandomColor();
        }

        let grafica_areas = new Chart(document.getElementById('graf-participacion-areas'), {
        type: 'doughnut',
        data: {
            labels: datos_areas.map(item => item.area),
            datasets: [{
                label: 'Total Horas',
                data: datos_areas.map(item => item.total_horas_area),
                backgroundColor: colores,
            }]
        },
        options: {
            aspectRatio: 1.6,
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
                boxWidth: 30,
                padding: 10
            }
        }
    });


        document.getElementById('graf-participacion-tareas').remove();

        var dontareas = document.createElement("canvas");
        dontareas.id = "graf-participacion-tareas";
        document.getElementById("contenedor-tareas").appendChild(dontareas);

        let grafica_tareas = new Chart(document.getElementById('graf-participacion-tareas'), {
        type: 'doughnut',
        data: {
            labels: datos_areas.map(item => item.area),
            datasets: [{
                label: 'Total Tareas',
                data: datos_areas.map(item => item.tareas),
                backgroundColor: colores,
            }]
        },
        options: {
            aspectRatio: 1.6,
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
                boxWidth: 30,
                padding: 10
            }
        },
    });

    document.getElementById('graf-proyectos-empleado').remove();

    var baremp = document.createElement("canvas");
    baremp.id = "graf-proyectos-empleado";
    document.getElementById("contenedor-empleados").appendChild(baremp);

    let grafica_empleados = new Chart(document.getElementById('graf-proyectos-empleado'), {
        type: 'bar',
    data: {
    labels: datos_empleados.map(item => [item.empleado, item.area]),
    datasets: [{
            // type: "bar",
            backgroundColor: "#61CB5C",
            label: "Horas Trabajadas en Proyecto",
            data: datos_empleados.map(item => item.horas_proyecto),
            lineTension: 0,
            fill: true,
            options: {
                indexAxis: 'y',
            }
        },
    ]
    },
    options: {
        scales: {
            yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Horas',
                        fontSize: 15,
                        fontColor: "#345183"
                    },
                    gridLines: {
                        color: "#ccc"
                    },
                }],
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

    });
});
</script>
