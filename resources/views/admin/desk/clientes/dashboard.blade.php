@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Dashboard</h5>
    <div class="card">
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

                    <canvas id="oilChart"></canvas>

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card ">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Tickets enviados a AC</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartTicketsEnviados"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background-color: #345183;">
                    <h5 style="font-size:20px" class="text-white">Canal de recepción</h5>
                </div>
                <div class="card-body">

                    <canvas id="chartCanalRecepcion"></canvas>

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
                labels: ["Sin atender", "En curso", "En espera", "Cerrados", "Cancelados"],
                datasets: [{
                        type: "horizontalBar",
                        backgroundColor: "rgba(255, 65, 123, 0.5)",
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
                        backgroundColor: "rgb(255, 203, 99, 0.5)",
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
                        backgroundColor: "rgba(109, 200, 102, 0.5)",
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
        let quejaPrioridadB = @json($quejaPrioridadB);
        var oilCanvas = document.getElementById("oilChart");



        var oilData = {
            labels: [
                "Alta",
                "Baja",


            ],
            datasets: [{
                data: [quejaPrioridadA, quejaPrioridadB, ],
                backgroundColor: [
                    "rgba(255, 65, 123, 1)",
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
                        "rgba(74, 152, 255, 0.5)",
                        "rgba(255, 203, 99, 0.5)",
                        "rgba(172, 132, 255, 0.5)",
                        "rgba(104, 99, 255, 0.5)",
                        "rgba(109, 200, 102, 0.5)",
                        "rgba(190, 102, 200, 0.5)",
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
                    label:[ "Canal"
                    ],

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
@endsection
