<div class="card">
    <div class="card-body">
        <h5 class="ml-3" style="font-size: 16px">Controles</h5>
        <div class="row">


            <div class="col-sm-6">
                <table class="table table-responsive-sm letras-dashboard">

                    <tbody>
                        <tr>

                            <td>Total de controles</td>
                            <td>{{$conteoAplica}}</td>


                        </tr>
                    <tbody>
                        <tr>

                            <td>Aplica</td>
                            <td>{{$conteoAplica}}</td>

                        </tr>
                    </tbody>
                    <tr>

                        <td>No aplica</td>
                        <td>{{$conteoAplica + $conteoNoaplica}}</td>

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
                    <tbody>
                        <tr>

                            <td>A.6 Organización de la seguridad de la información</td>
                            <td>{{ $A6 }}</td>
                            <td>{{ $A6No }}</td>

                        </tr>
                    </tbody>
                    <tr>

                        <td>A.7 seguridad de los recursos humanos</td>
                        <td>{{ $A7 }}</td>
                        <td>{{ $A7No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.8 Administración de activos</td>
                        <td>{{ $A8 }}</td>
                        <td>{{ $A8No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.9 Control de acceso</td>
                        <td>{{ $A9 }}</td>
                        <td>{{ $A9No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.10 Criptografía</td>
                        <td>{{ $A10 }}</td>
                        <td>{{ $A10No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.11 Seguridad Física y del Entorno</td>
                        <td>{{ $A11 }}</td>
                        <td>{{ $A11No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.12 Seguridad de las Operaciones</td>

                        <td>{{ $A12 }}</td>
                        <td>{{ $A12No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.13 Seguridad de las comunicaciones</td>
                        <td>{{ $A13 }}</td>
                        <td>{{ $A13No }}</td>

                    </tr>
                    </tbody>
                    <tr>

                        <td>A.14 Adquisición, desarrollo y mantenimiento de los sistemas de información </td>
                        <td>{{ $A14 }}</td>
                        <td>{{ $A14No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.15 Relación con los proveedores</td>
                        <td>{{ $A15 }}</td>
                        <td>{{ $A15No }}</td>
                    </tr>
                    </tbody>
                    <tr>
                        <td>A.16 Gestión de incidentes de Seguridad de la Información</td>
                        <td>{{ $A16 }}</td>
                        <td>{{ $A16No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.17 Aspectos de seguridad de la información para la gestión de la continuidad del Instituto
                        </td>
                        <td>{{ $A17 }}</td>
                        <td>{{ $A17No }}</td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.18 Cumplimiento</td>
                        <td>{{ $A18 }}</td>
                        <td>{{ $A18No }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>



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
                    "Aplican",
                    "No aplican"
                ],
                datasets: [{
                    label: '% Capacitacion',
                    data: [
                        {{ $conteoAplica }},
                        {{ $conteoNoaplica }},
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
                labels: ["A5", "A6", "A7", "A8", "A9", "A10", "A11", "A12", "A13", "A14", "A15", "A16", "A17",
                    "A18"],
                datasets: [{
                    label: '# Controles por dominio',
                    data: [
                        {{ $A5 + $A5No }},
                        {{ $A6 + $A6No }},
                        {{ $A7 + $A7No }},
                        {{ $A8 + $A8No }},
                        {{ $A9 + $A9No }},
                        {{ $A10 + $A10No }},
                        {{ $A11 + $A11No }},
                        {{ $A12 + $A12No  }},
                        {{ $A13 + $A13No }},
                        {{ $A14 + $A14No }},
                        {{ $A15 + $A15No }},
                        {{ $A16 + $A16No }},
                        {{ $A17 + $A17No}},
                        {{ $A18 + $A18No }},
                    ],

                    backgroundColor: [

                        'rgba(32, 165, 147, 0.9)',
                        'rgba(35, 244, 105, 0.9)',
                        'rgba(238, 125, 226, 0.9)',
                        'rgba(15, 143, 73, 0.9)',
                        'rgba(240, 237, 0, 0.9)',
                        'rgba(255, 159, 64, 0.9)',
                        'rgba(255, 99, 132, 0.9)',
                        'rgba(54, 162, 235, 0.9)',
                        'rgba(255, 206, 86, 0.9)',
                        'rgba(75, 192, 192, 0.9)',
                        'rgba(153, 102, 255, 0.9)',
                        'rgba(18, 108, 255, 0.9)',
                        'rgba(105, 206, 15, 0.9)',
                        'rgba(255, 18, 151, 0.9)'
                    ],
                    borderColor: [
                        'rgba(32, 165, 147,1)',
                        'rgba(35, 244, 105,1)',
                        'rgba(238, 125, 226,1)',
                        'rgba(15, 143, 73,1)',
                        'rgba(240, 237, 0,1)',
                        'rgba(255, 159, 64,1)',
                        'rgba(255, 99, 132,1)',
                        'rgba(54, 162, 235,1)',
                        'rgba(255, 206, 86,1)',
                        'rgba(75, 192, 192,1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(18, 108, 255,1)',
                        'rgba(105, 206, 15,1)',
                        'rgba(255, 18, 151,1)'
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
