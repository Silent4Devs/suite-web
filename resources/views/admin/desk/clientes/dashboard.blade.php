@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print_foda.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/centro_atencion_cards.css') }}">

    <style>
        @media print {
            .print-none {
                display: none !important;
            }
        }
    </style>

    <button class="btn btn-danger print-none" style="position: absolute; right:20px;" onclick="javascript:window.print()">
        <i class="fas fa-print"></i>
        Imprimir
    </button>
    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::getFirst();
        $logotipo = $organizacion->logotipo;
        $empresa = $organizacion->empresa;
    @endphp

    <div class="solo-print">
        <div class=" row mt-5 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
            <div class="col-2 pl-0" style="border-right: 2px solid #ccc">
                <img src="{{ asset($logotipo) }}" class="mt-2 mb-2 ml-4" style="width:100px;">
            </div>
            <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                <span style="font-size:13px; text-transform: uppercase;color:#345183;">{{ $empresa }}</span>
                <br>
                <span style="color:#345183; font-size:15px;"><strong>Dashboard: Quejas Clientes.
                    </strong></span>

            </div>
            <div class="col-3 p-2">
                <span style="color:#345183;">Fecha: {{ now()->format('d-m-Y') }}
                </span>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <div class="print-none">
        <h5 class="col-12 titulo_general_funcion">Dashboard</h5>
    </div>

    <div class="row">
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-celeste">
                <div class="numero"><i class="mr-2 fas fa-exclamation-triangle"></i> {{ $total_quejasClientes }}
                </div>
                <div class="textoCentroCard">Quejas Clientes</div>
            </div>
        </div>
        <div class="col-6 col-md-2 ">
            <div class="tarjetas_seguridad_indicadores cdr-amarillo">
                <div class="numero"><i class="mr-2 far fa-arrow-alt-circle-right"></i>
                    {{ $nuevos_quejasClientes }}
                </div>
                <div class="textoCentroCard">Sin atender</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-morado">
                <div class="numero"><i class="mr-2 fas fa-redo-alt"></i> {{ $en_curso_quejasClientes }}</div>
                <div class="textoCentroCard">En curso</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-azul">
                <div class="numero"><i class="mr-2 fas fa-history"></i> {{ $en_espera_quejasClientes }}</div>
                <div class="textoCentroCard">En espera</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-verde">
                <div class="numero"><i class="mr-2 far fa-check-circle"></i> {{ $cerrados_quejasClientes }}</div>
                <div class="textoCentroCard">Cerrados</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-rojo">
                <div class="numero"><strong><i class="bi bi-dash-circle mr-2"></i></strong>{{ $cancelados_quejasClientes }}
                </div>
                <div class="textoCentroCard">No procedentes</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="height:40px; background-color: #345183;">
            <h5 style="font-size:15px" class="text-white">Quejas por Estatus y Prioridad</h5>
        </div>
        <div class="card-body">
            <div class="col-12">
                <canvas id="myChart" width="1000" height="400"></canvas>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header" style="height:40px; background-color: #345183;">
                    <h5 style="font-size:15px" class="text-white">Quejas por Prioridad</h5>
                </div>
                <div class="card-body">

                    <canvas id="oilChart" height="250"></canvas>

                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header" style="height:40px; background-color: #345183;">
                    <h5 style="font-size:15px" class="text-white">Canal de Recepción de las Quejas</h5>
                </div>
                <div class="card-body">

                    <canvas id="chartCanalRecepcion" width="600" height="500"></canvas>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>


    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header" style="height:40px; background-color: #345183;">
                    <h5 style="font-size:15px" class="text-white">Quejas por Cliente</h5>
                </div>
                <div class="card-body">

                    <canvas id="clienteChart" width="600" height="200"></canvas>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card ">
                <div class="card-header" style="height:40px; background-color: #345183;">
                    <h5 style="font-size:15px" class="text-white">Quejas por Proyecto</h5>
                </div>
                <div class="card-body">

                    <canvas id="proyectoChart" width="600" height="200"></canvas>

                </div>

            </div>
        </div>

    </div>





    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="height:40px; background-color: #345183;">
                    <h5 style="font-size:15px" class="text-white">Quejas por Categoría</h5>
                </div>
                <div class="card-body">

                    <canvas id="chartCategorizacion" width="600" height="300"></canvas>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card ">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Tickets por áreas</h5>
                </div>
                <div class="card-body">

                    <canvas id="chartAreas" width="600" height="300"></canvas>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Tickets por procesos</h5>
                </div>
                <div class="card-body">

                    <canvas id="chartProcesos" width="600" height="300"></canvas>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-6">
            <div class="card">
                <div class="card-header" style="height:40px; background-color: #345183;">
                    <h5 style="font-size:15px" class="text-white">Quejas con Acción Correctiva Vinculada</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartTicketsEnviados" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card ">
                <div class="card-header" style="height:40px; background-color: #345183;">
                    <h5 style="font-size:15px" class="text-white">Estatus de los Planes de Acción</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartCumplimientoComprometido" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
    </script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>


    <script>
        let quejaEstatusAltaArray = @json($quejaEstatusAltaArray);
        let quejaEstatusMediaArray = @json($quejaEstatusMediaArray);
        let quejaEstatusBajaArray = @json($quejaEstatusBajaArray);
        let quejaEstatusSinDArray = @json($quejaEstatusSinDArray);

        var ctx = document.getElementById("myChart");
        var chart = new Chart(ctx, {
            type: "horizontalBar",
            data: {
                labels: [`Sin atender`, "En curso", "En espera", "Cerrado", "No procedentes"],
                datasets: [{
                        type: "horizontalBar",
                        backgroundColor: "rgba(255, 65, 123, 1)",
                        borderColor: "rgba(255, 65, 123, 1)",
                        borderWidth: 1,
                        label: "Alta",
                        data: quejaEstatusAltaArray,
                        options: {
                            indexAxis: 'y',
                        }
                    },
                    {
                        type: "horizontalBar",
                        backgroundColor: "rgb(255, 203, 99, 1)",
                        borderColor: "rgba(255, 203, 99, 1)",
                        label: "Media",
                        data: quejaEstatusMediaArray,
                        lineTension: 0,
                        fill: true,
                        options: {
                            indexAxis: 'y',
                        }
                    },
                    {
                        type: "horizontalBar",
                        backgroundColor: "rgba(109, 200, 102, 1)",
                        borderColor: "rgba(109, 200, 102, 1)",
                        label: "Baja",
                        data: quejaEstatusBajaArray,
                        lineTension: 0,
                        fill: true,
                        options: {
                            indexAxis: 'y',
                        }
                    },
                    {
                        type: "horizontalBar",
                        label: "Sin definir",
                        data: quejaEstatusSinDArray,
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
                            labelString: 'Estatus',
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
                            labelString: 'Prioridad',
                            fontSize: 15,
                            fontColor: "#345183"

                        },
                    }]
                },

                plugins: {
                    datalabels: {
                        color: 'white',
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

    <script>
        let quejaPrioridadA = @json($quejaPrioridadA);
        let quejaPrioridadM = @json($quejaPrioridadM);
        let quejaPrioridadB = @json($quejaPrioridadB);
        var oilCanvas = document.getElementById("oilChart");



        var oilData = {
            labels: [
                "Alta",
                "Media",
                "Baja",


            ],
            datasets: [{
                data: [quejaPrioridadA, quejaPrioridadM, quejaPrioridadB],
                backgroundColor: [
                    "rgba(255, 65, 123, 1)",
                    "rgb(255, 203, 99, 0.5)",
                    "rgba(109, 200, 102, 0.5)",
                ]
            }]
        };

        var pieChart = new Chart(oilCanvas, {
            type: 'pie',
            data: oilData,
            options: {
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },
        });
    </script>

    <script>
        let quejaAcSolicitada = @json($quejaAcSolicitada);
        let quejaAcNoSolicitada = @json($quejaAcNoSolicitada);
        var chartTickets = document.getElementById("chartTicketsEnviados");

        var ticketsEnviados = {
            labels: [
                "AC solicitada",
                "AC no solicitada"
            ],
            datasets: [{
                data: [quejaAcSolicitada, quejaAcNoSolicitada],
                backgroundColor: [
                    "#8463FF",
                    "#6384FF"
                ]
            }]
        };

        var pieChart = new Chart(chartTickets, {
            type: 'pie',
            data: ticketsEnviados,
            options: {
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },
        });
    </script>

    <script>
        let quejaCanalTelefono = @json($quejaCanalTelefono);
        let quejaCanalCorreoE = @json($quejaCanalCorreoE);
        let quejaCanalOtro = @json($quejaCanalOtro);
        let quejaCanalOficio = @json($quejaCanalOficio);
        let quejaCanalRemota = @json($quejaCanalRemota);
        let quejaCanalPresencial = @json($quejaCanalPresencial);

        var canvas_sgsi = document.getElementById("chartCanalRecepcion");
        var pie_sgsi = new Chart(canvas_sgsi, {
            type: 'bar',
            data: {
                labels: ["Correo electrónico", "Vía telefónica", "Presencial", "Remota", "Oficio", "Otro"],
                datasets: [{
                    backgroundColor: [
                        "rgba(74, 152, 255, 1)",
                        "rgba(255, 203, 99, 1)",
                        "rgba(172, 132, 255, 1)",
                        "rgba(104, 99, 255, 1)",
                        "rgba(109, 200, 102, 1)",
                        "rgba(190, 102, 200, 1)",
                    ],
                    borderColor: [
                        "rgba(74, 152, 255, 1)",
                        "rgba(255, 203, 99, 1)",
                        "rgba(172, 132, 255, 1)",
                        "rgba(104, 99, 255, 1)",
                        "rgba(109, 200, 102, 1)",
                        "rgba(190, 102, 200, 1)",
                    ],
                    borderWidth: 1,
                    label: ["Canal"],

                    data: [quejaCanalCorreoE,
                        quejaCanalTelefono,
                        quejaCanalOficio,
                        quejaCanalRemota,
                        quejaCanalPresencial,
                        quejaCanalOtro
                    ],
                }, ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },


            },
        });
    </script>

    <script>
        let quejaCategoriaServNoP = @json($quejaCategoriaServNoP);
        let quejaCategoriaRetrasoP = @json($quejaCategoriaRetrasoP);
        let quejaCategoriaEntreNoC = @json($quejaCategoriaEntreNoC);
        let quejaCategoriaIncuComC = @json($quejaCategoriaIncuComC);
        let quejasCategoriaIncuNivServ = @json($quejasCategoriaIncuNivServ);
        let quejasCategoriaNegPresServ = @json($quejasCategoriaNegPresServ);
        let quejasCategoriaIncFact = @json($quejasCategoriaIncFact);
        let quejasCategoriaOtro = @json($quejasCategoriaOtro);

        var canvas_categoria = document.getElementById("chartCategorizacion");
        var pie_categoria = new Chart(canvas_categoria, {
            type: 'bar',
            data: {
                labels: [
                    "Servicio no prestado",
                    "Retraso en la prestacion",
                    "Entregable no conforme",
                    "Incumplimiento de los compromisos contractuales",
                    "Incumplimiento de los niveles de servicio",
                    "Negativa de prestación del servicio",
                    "Incorrecta facturacion",
                    "Otro"
                ],
                datasets: [{
                    backgroundColor: [
                        "rgba(74, 152, 255, 1)",
                        "rgba(255, 203, 99, 1)",
                        "rgba(172, 132, 255, 1)",
                        "rgba(104, 99, 255, 1)",
                        "rgba(109, 200, 102, 1)",
                        "rgba(190, 102, 200, 1)",
                        "rgba(102, 200, 193, 1)",
                        "rgba(230, 108, 162, 1)",

                    ],
                    borderColor: [
                        "rgba(74, 152, 255, 1)",
                        "rgba(255, 203, 99, 1)",
                        "rgba(172, 132, 255, 1)",
                        "rgba(104, 99, 255, 1)",
                        "rgba(109, 200, 102, 1)",
                        "rgba(190, 102, 200, 1)",
                        "rgba(102, 200, 193, 1)",
                        "rgba(230, 108, 162, 1)",

                    ],
                    borderWidth: 1,
                    label: ["Categoria"],

                    data: [
                        quejaCategoriaServNoP,
                        quejaCategoriaRetrasoP,
                        quejaCategoriaEntreNoC,
                        quejaCategoriaIncuComC,
                        quejasCategoriaIncuNivServ,
                        quejasCategoriaNegPresServ,
                        quejasCategoriaIncFact,
                        quejasCategoriaOtro
                    ]
                }]
            },
            options: {
                legend: {
                    display: false

                },

                scales: {

                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },

                    }]
                },

                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            weight: "normal",
                            size: 20
                        }

                    },
                },

            },


        });
    </script>

    <script>
        let quejaCumplioFecha = @json($quejaCumplioFecha);
        let quejaNoCumplioFecha = @json($quejaNoCumplioFecha);
        var chartCumplimiento = document.getElementById("chartCumplimientoComprometido");

        var cumplimientoDacciones = {
            labels: [
                "Con retraso",
                "En Cumplimiento"
            ],
            datasets: [{
                data: [quejaAcSolicitada, quejaAcNoSolicitada],
                backgroundColor: [
                    "rgba(255, 65, 123, 1)",
                    "rgba(109, 200, 102, 1)",
                ]
            }]
        };

        var pieChart = new Chart(chartCumplimiento, {
            type: 'pie',
            data: cumplimientoDacciones,
            options: {
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },
        });
    </script>

    <script>
        let proyectos = @json($proyectosLabel);
        var proyectoCanva = document.getElementById("proyectoChart");
        let proyectosLabelArray = [];
        let cantidadProyectosArray = [];
        let coloresAutomaticosProyectos = [];

        proyectos.forEach(proyecto => {
            proyectosLabelArray.push(`${proyecto.nombre} - ${proyecto.cliente}`)
            cantidadProyectosArray.push(proyecto.cantidad)

        });


        for (let index = 0; index < cantidadProyectosArray.length; index++) {
            coloresAutomaticosProyectos.push("rgba(172, 132, 255, 1)");

        }
        var pie_proyecto = new Chart(proyectoCanva, {
            type: 'bar',
            data: {
                labels: proyectosLabelArray,
                datasets: [{
                    backgroundColor: coloresAutomaticosProyectos,
                    borderColor: coloresAutomaticosProyectos,
                    borderWidth: 1,
                    label: ["Proyectos"],

                    data: cantidadProyectosArray,

                }]
            },

            options: {
                legend: {
                    display: false

                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },

                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },

        });
    </script>



    <script>
        let clientes = @json($clientesLabel);
        var clienteCanva = document.getElementById("clienteChart");
        let clientesLabelArray = [];
        let cantidadClientesArray = [];
        let coloresAutomaticos = [];

        clientes.forEach(cliente => {
            clientesLabelArray.push(cliente.nombre)
            cantidadClientesArray.push(cliente.cantidad)

        });



        for (let index = 0; index < cantidadClientesArray.length; index++) {
            coloresAutomaticos.push("rgba(74, 152, 255, 1)");

        }




        var pie_cliente = new Chart(clienteCanva, {
            type: 'bar',
            data: {
                labels: clientesLabelArray,
                datasets: [{
                    backgroundColor: coloresAutomaticos,
                    borderColor: coloresAutomaticos,
                    borderWidth: 1,
                    label: ["Clientes"],

                    data: cantidadClientesArray,

                }]
            },

            options: {
                legend: {
                    display: false

                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },



        });
    </script>

    <script>
        let areasCollect = @json($areasCollect);
        let labels = [];
        let data = [];
        let coloresEnAutomatico = [];
        Object.entries(areasCollect).forEach(([key, value]) => {
            labels.push(key);
            data.push(value);
        });
        console.log(labels, data);

        for (let index = 0; index < data.length; index++) {
            coloresEnAutomatico.push("rgba(109, 200, 102, 1)");

        }

        var pie_area = new Chart(chartAreas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: coloresEnAutomatico,
                    borderColor: coloresEnAutomatico,
                    borderWidth: 1,
                    label: ["Areas"],

                    data: data,

                }]
            },


            options: {
                legend: {
                    display: false

                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },



        });
    </script>


    <script>
        let procesosCollect = @json($procesosCollect);
        let informacionprocesos = [];
        let cantidadprocesos = [];
        let coloresAutomaticamente = [];
        Object.entries(procesosCollect).forEach(([key, value]) => {
            informacionprocesos.push(key);
            cantidadprocesos.push(value);
        });
        console.log(Object.entries(procesosCollect));

        for (let index = 0; index < data.length; index++) {
            coloresAutomaticamente.push("rgba(230, 108, 162, 1)");

        }

        var pie_procesos = new Chart(chartProcesos, {
            type: 'bar',
            data: {
                labels: informacionprocesos,
                datasets: [{
                    backgroundColor: coloresAutomaticamente,
                    borderColor: coloresAutomaticamente,
                    borderWidth: 1,
                    label: ["Procesos"],

                    data: cantidadprocesos,

                }]
            },


            options: {
                legend: {
                    display: false

                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },



        });
    </script>
@endsection
