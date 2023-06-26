@extends('layouts.admin')
@section('content')



{{ Breadcrumbs::render('admin.declaracion-aplicabilidad-2022.index') }}

<h5 class="col-12 titulo_general_funcion">Declaración de Aplicabilidad Dashboard</h5>
<div class="form-group col-12 text-right">
    <a href="{{ route('admin.declaracion-aplicabilidad-2022.index') }}" class="btn btn-danger">Declaracion Aplicabilidad</a>
    </div>
<div class="card">
    <div class="card-body">

        <div class="px-1 py-2 mx-3 mb-4 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones
                    </p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Para visualizar registros actuales mantener actualizada la página
                    </p>
                </div>
            </div>
        </div>
        <h5 class="ml-3" style="font-size: 16px">Controles</h5>
        <div class="progress">
            <div
                class="progress-bar progress-bar-striped progress-bar-animated"
                role="progressbar" aria-valuenow="40"
                aria-valuemin="0" aria-valuemax="100"
                style="width: {{number_format($porcentaje, 2, '.', '')}}%">{{number_format($porcentaje, 2, '.', '')}}%
            </div>
        </div>
        <div class="row">


            <div class="col-sm-6">
                <table class="table table-responsive-sm letras-dashboard">

                    <tbody>
                        <tr>

                            <td>Total de controles</td>
                            <td>{{ $total }}</td>


                        </tr>
                    </tbody>

                    <tbody>
                        <tr>

                            <td>Aplica</td>
                            <td>{{ $conteoAplica }}</td>

                        </tr>
                    </tbody>
                    <tbody>
                    <tr>

                        <td>No aplica</td>
                        <td>{{ $conteoNoaplica }}</td>

                    </tr>
                    </tbody>
                </table>
            </div>

            <div class=col-sm-6>
                <canvas id="chartIndicadoresSGSI"></canvas>
            </div>

            <canvas id="myChart" width="1000" height="500"></canvas>




        </div>


        <div class="row">

            <div class="col-sm-12">
                <table class="table table-responsive-sm letras-dashboard">
                    <thead>
                        <tr>
                            <th scope="col">Controles por dominio</th>
                            <th scope="col">Aplican</th>
                            <th scope="col">No aplican</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>A.5 Políticas de Seguridad de Información</td>
                            <td>{{ $A5 }}</td>
                            <td>{{ $A5No }}</td>

                        </tr>
                    </tbody>
                    <tbody>
                        <tr>

                            <td>A.6 Organización de la seguridad de la información</td>
                            <td>{{ $A6 }}</td>
                            <td>{{ $A6No }}</td>

                        </tr>
                    </tbody>
                    <tbody>
                    <tr>

                        <td>A.7 seguridad de los recursos humanos</td>
                        <td>{{ $A7 }}</td>
                        <td>{{ $A7No }}</td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>

                        <td>A.8 Administración de activos</td>
                        <td>{{ $A8 }}</td>
                        <td>{{ $A8No }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>


    <script>
        var canvas_sgsi = document.getElementById("chartIndicadoresSGSI");
        var pie_sgsi = new Chart(canvas_sgsi, {
            type: 'pie',
            labels: {
                render: 'value'
            },
            data: {
                labels: [
                    "% de Aprobados",
                    "% de Reprobados",
                ],
                datasets: [{
                    label: '% Capacitacion',
                    data: [
                        {{ $porcentaje }},
                        {{ $faltante }},
                    ],
                    backgroundColor: [
                        'rgba(22, 193, 66, 66)',
                        'rgba(22, 160, 133, 0.6)',


                    ]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontColor: "black",
                        boxWidth: 20,
                        padding: 8
                    }
                },
                tooltips: {
                    mode: 'label'
                },

            }
        });
    </script>


    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["A5", "A6", "A7", "A8"],
                datasets: [{
                    label: '# Controles por dominio',
                    data: [
                        {{ $A5 + $A5No }},
                        {{ $A6 + $A6No }},
                        {{ $A7 + $A7No }},
                        {{ $A8 + $A8No }},
                    ],

                    backgroundColor: [

                        'rgba(32, 165, 147, 0.9)',
                        'rgba(35, 244, 105, 0.9)',
                        'rgba(238, 125, 226, 0.9)',
                        'rgba(15, 143, 73, 0.9)',
                    ],
                    borderColor: [
                        'rgba(32, 165, 147,1)',
                        'rgba(35, 244, 105,1)',
                        'rgba(238, 125, 226,1)',
                        'rgba(15, 143, 73,1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                scales: {
                    xAxes: [{
                            ticks: {
                                maxRotation: 90,
                                minRotation: 80
                            },
                            gridLines: {
                                offsetGridLines: true // à rajouter
                            }
                        },
                        {
                            position: "top",
                            ticks: {
                                maxRotation: 90,
                                minRotation: 80
                            },
                            gridLines: {
                                offsetGridLines: true // et matcher pareil ici
                            }
                        }
                    ],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection
