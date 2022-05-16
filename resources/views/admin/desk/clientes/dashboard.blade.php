@extends('layouts.admin')
@section('content')
    <style type="text/css">

        .cdr-celeste {
            background: #4A98FF;
        }

        .cdr-amarillo {
            background: #FFCB63;
        }

        .cdr-morado {
            background: #AC84FF;
        }

        .cdr-azul {
            background: #6863FF;
        }

        .cdr-verde {
            background: #6DC866;
        }

        .cdr-rojo {
            background: #FF417B;
        }

        .caja_secciones section {
            overflow: unset !important;
        }

        .tarjetas_seguridad_indicadores {

            width: 100%;
            height: 80px;
            color: #fff;
            margin-bottom: 40px;
            font-size: 15pt;
            border-radius: 6px;
        }

        .tarjetas_seguridad_indicadores div {
            width: 100%;
            text-align: center;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .numero{
            font-size:20pt;
        }

    </style>
    <h5 class="col-12 titulo_general_funcion">Dashboard</h5>

    <div class="row">
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-celeste">
                <div class="numero"><i class="mr-2 fas fa-exclamation-triangle"></i> {{ $total_quejasClientes }}</div>
                <div>Quejas Clientes</div>
            </div>
        </div>
        <div class="col-6 col-md-2 ">
            <div class="tarjetas_seguridad_indicadores cdr-amarillo">
                <div class="numero"><i class="mr-2 far fa-arrow-alt-circle-right"></i> {{ $nuevos_quejasClientes }}</div>
                <div>Sin atender</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-morado">
                <div class="numero"><i class="mr-2 fas fa-redo-alt"></i> {{ $en_curso_quejasClientes }}</div>
                <div>En curso</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-azul">
                <div class="numero"><i class="mr-2 fas fa-history"></i> {{ $en_espera_quejasClientes }}</div>
                <div>En espera</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-verde">
                <div class="numero"><i class="mr-2 far fa-check-circle"></i> {{ $cerrados_quejasClientes }}</div>
                <div>Cerrados</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-rojo">
                <div class="numero"><i class="mr-2 far fa-circle"></i> {{ $cancelados_quejasClientes }}</div>
                <div>No procedentes</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="background-color: #345183;">
            <h5 style="font-size:20px" class="text-white">Registro de tickets</h5>
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
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Prioridad de los Tickets</h5>
                </div>
                <div class="card-body">

                    <canvas id="oilChart" height="250"></canvas>

                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Canal de recepción</h5>
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
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Proyectos</h5>
                </div>
                <div class="card-body">

                    <canvas id="speedChart" width="600" height="200"></canvas>

                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="card ">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Clientes</h5>
                </div>
                <div class="card-body">

                    <canvas id="clienteChart" width="600" height="200"></canvas>

                </div>
            </div>
        </div>

    </div>





    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Categorización</h5>
                </div>
                <div class="card-body">

                    <canvas id="chartCategorizacion" width="600" height="250"></canvas>

                </div>
            </div>
        </div>

        {{-- <div class="col-12">
            <div class="card ">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Tickets por áreas</h5>
                </div>
                <div class="card-body">

                    <canvas id="chartAreas" width="600" height="200"></canvas>

                </div>
            </div>
        </div> --}}
    </div>

    <div class="row">

        <div class="col-6">
            <div class="card">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Tickets enviados a AC</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartTicketsEnviados" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card ">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Cumplimiento de las acciones comprometidas</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartCumplimientoComprometido" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
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
                labels: ["Sin atender", "En curso", "En espera", "Cerrado", "No procedentes"],
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
            }
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
            data: oilData
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
            data: ticketsEnviados
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
                labels: ["Correo electronico", "Via telefonica", "Presencial", "Remota", "Oficio", "Otro"],
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
            }
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
                    ],
                }, ]
            }
        });
    </script>

    <script>
        let quejaCumplioFecha = @json($quejaCumplioFecha);
        let quejaNoCumplioFecha = @json($quejaNoCumplioFecha);
        var chartCumplimiento = document.getElementById("chartCumplimientoComprometido");

        var cumplimientoDacciones = {
            labels: [
                "Retraso de la atención",
                "Cumplimiento de la atención"
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
            data: cumplimientoDacciones
        });
    </script>

    <script>
        let proyectos = @json($proyectosLabel);
        var speedCanvas = document.getElementById("speedChart");
        let proyectosLabelArray = [];
        let cantidadProyectosArray = [];

        proyectos.forEach(proyecto => {
            proyectosLabelArray.push(proyecto.nombre)
            cantidadProyectosArray.push(proyecto.cantidad)

        });
        console.log(proyectos);
        var speedData = {
            labels: proyectosLabelArray,
            datasets: [{
                label: "Proyectos",
                data: cantidadProyectosArray,
                lineTension: 0,
                fill: false,
                borderColor: '#3490dc',
                backgroundColor: 'transparent',
                borderDash: [5, 5],
                pointBorderColor: '#321fdb',
                pointBackgroundColor: '6CABDF',
                pointRadius: 5,
                pointHoverRadius: 10,
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'rectRounded'
            }]
        };

        var chartOptions = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 80,
                    fontColor: 'black'
                }
            }
        };

        var lineChart = new Chart(speedCanvas, {
            type: 'line',
            data: speedData,
            options: chartOptions
        });
    </script>



    <script>
        let clientes = @json($clientesLabel);
        var clienteCanva = document.getElementById("clienteChart");
        let clientesLabelArray = [];
        let cantidadClientesArray = [];

        clientes.forEach(cliente => {
            clientesLabelArray.push(cliente.nombre)
            cantidadClientesArray.push(cliente.cantidad)

        });
        console.log(clientes);
        var clienteData = {
            labels: clientesLabelArray,
            datasets: [{
                label: "Clientes",
                data: cantidadClientesArray,
                lineTension: 0,
                fill: false,
                borderColor: '#38c172',
                backgroundColor: 'transparent',
                borderDash: [5, 5],
                pointBorderColor: '#6CDF8F',
                pointBackgroundColor: 'rgba(56,193,114,0.5)',
                pointRadius: 5,
                pointHoverRadius: 10,
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'rectRounded'
            }]
        };

        var chartCliente = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 80,
                    fontColor: 'black'
                }
            }
        };

        var lineChartCliente = new Chart(clienteCanva, {
            type: 'line',
            data: clienteData,
            options: chartCliente
        });
    </script>

    <script>
        let ticketPorArea = @json($ticketPorArea);
        var areaCanva = document.getElementById("chartAreas");
        var areaData = {
            labels: ticketPorArea,
            datasets: [{
                label: "Áreas",
                data: ticketPorArea,
                lineTension: 0,
                fill: false,
                borderColor: '#f9b115',
                backgroundColor: 'transparent',
                borderDash: [5, 5],
                pointBorderColor: '#38c172',
                pointBackgroundColor: 'rgba(249,177,21,0.5)',
                pointRadius: 5,
                pointHoverRadius: 10,
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'rectRounded'
            }]
        };

        var chartArea = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 80,
                    fontColor: 'black'
                }
            }
        };

        var lineChartArea = new Chart(areaCanva, {
            type: 'line',
            data: areaData,
            options: chartArea
        });
    </script>
@endsection
