<div class="card">
    <div class="card-body">
        <h5 class="ml-3" style="font-size: 16px">Controles</h5>
        <div class="row">
            <div class="pr-0 col-md-6 card_new">
                <div class="p-3 mb-2 bg-white rounded row shadow-propia" style="margin-right: 10px;">
                    <div class="header">
                        <font class="circulo_iso_27001" style="
                            width: 10px;
                            height: 10px;
                            background-color: #A13D86;
                            border-radius: 100%;
                            position: absolute;
                            top: 29px;
                            left: 18px;
                        "></font>

                    </div>
                    <canvas id="chartIndicadoresSGSI"></canvas>


                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm">
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
                        <td></td>


                    </tr>
                    <tr>

                        <td>A.6 Organización de la seguridad de la información</td>
                        <td></td>

                    </tr>
                    </tbody>
                     <tr>

                        <td>A.7 seguridad de los recursos humanos</td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.8 Administración de activos</td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.9 Control de acceso</td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.10 Criptografía</td>
                        <td></td>
                    </tr>
                    </tbody>
                     <tr>

                        <td>A.11 Seguridad Física y del Entorno</td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tr>

                        <td>A.12 Seguridad de las Operaciones<td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tr>

                            <td>A.13 Seguridad de las comunicaciones</td>
                            <td></td>
                    </tr>
                    </tbody>
                    <tr>

                            <td>A.14 Adquisición, desarrollo y mantenimiento de los sistemas de información </td>
                            <td></td>
                    </tr>
                    </tbody>
                    <tr>

                            <td>A.15 Relación con los proveedores</td>
                            <td></td>
                    </tr>
                    </tbody>
                    <tr>

                            <td>A.17 Aspectos de seguridad de la información para la gestión de la continuidad del Instituto</td>
                            <td></td>
                    </tr>
                    </tbody>
                    <tr>

                            <td>A.18 Cumplimiento</td>
                            <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm">
                 <canvas id="myChart" width="800" height="400"></canvas>
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
                    "Total de controles",
                    "Aplican",
                    "No aplican"
                ],
                datasets: [{
                    label: '% Capacitacion',
                    data: [
                    {{ $conteoAplica + $conteoNoaplica }},
                    {{ $conteoAplica }},
                    {{ $conteoNoaplica }},
                        ],
                    backgroundColor: [
                        'rgba(22, 193, 66, 66)',
                        'rgba(22, 160, 133, 0.6)',
                        'rgba(244, 208, 63, 0.6)',

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
        labels: ["A5", "A6", "A7", "A8", "A9"],
        datasets: [{
          label: '# of Tomatoes',
          data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
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
          }],
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
