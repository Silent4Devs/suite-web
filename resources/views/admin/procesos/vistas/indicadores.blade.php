<style>
    .dotverde {
        height: 15px;
        width: 15px;
        background-color: #38c172;
        border-radius: 50%;
        display: inline-block;
    }

    .dotyellow {
        height: 15px;
        width: 15px;
        background-color: orange;
        border-radius: 50%;
        display: inline-block;
    }

    .dotred {
        height: 15px;
        width: 15px;
        background-color: red;
        border-radius: 50%;
        display: inline-block;
    }

    .cuadro_info{
        width:200px;
        padding:20px 0;
        background-color:#f1f1f1;
        border-radius:6px;
        text-align:center;

    }


</style>




<div class="row">
    <div class="col-sm-7">
        <div class="card-body datatable-fix">

            <p class="ml-5">De click sobre una fila para desplegar información</p>

            <div class="table-scroll">

                <table class="table table-hover table-bordered tbl-categorias w-100">

                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="font-size:10pt">ID</th>
                            <th class="text-center" scope="col" style="font-size:10pt">Nombre del indicador</th>
                            <th scope="col" style="font-size:10pt">Descripción</th>
                            <th class="text-center" scope="col" style="font-size:10pt">Formula de cálculo</th>
                            <th scope="col">Resultado</th>
                            <th scope="col">Meta</th>
                        </tr>
                    </thead>
                    <tbody class="tbody_click">

                        @foreach ($indicadores as $indicador)
                            @php
                                $i = 0;
                                foreach ($indicador->evaluacion_indicadors as $value) {
                                    $i += $value->resultado;
                                }
                            @endphp
                            <tr
                                onclick='graficasclick(event, {{ $indicador->id }}, {{ $indicador->rojo }}, {{ $indicador->amarillo }}, {{ $indicador->verde }}, {{ $i }}, {{ $indicador->meta }})'>
                                <td>{{ $indicador->id }}</td>
                                <td>{{ $indicador->nombre }}</td>
                                <td>{{ $indicador->descripcion }}</td>
                                <td>{{ $indicador->formula }}</td>
                                <td>
                                    @if ($i >= $indicador->verde)
                                        <span class="dotverde"></span>
                                    @elseif($i >= $indicador->amarillo && $i < $indicador->verde)
                                            <span class="dotyellow"></span>
                                        @else
                                            <span class="dotred"></span>
                                    @endif
                                    {{ $i }}{{ $indicador->unidadmedida}}
                                </td>
                                <td>{{ $indicador->meta }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>



    <div class="mt-5 col-sm-5">

        <div class="d-flex justify-content-center">
            <div  id="resultado" id="prueba">

                    {{-- <div class="d-flex justify-content-center">
                        <div class="card-body" style="box-shadow: 0px 0px 0px 1px #424242;">
                            @if ($i >= $indicador->verde)
                            <span class="cuadroverde"></span>
                        @elseif($i >= $indicador->amarillo && $i < $indicador->verde)
                                <span class="cuadroyellow"></span>
                            @else
                                <span class="cuadrored"></span>
                        @endif
                                <h4 class="">%Resultado</h4>
                        </div>
                    </div> --}}

            </div>

        </div>

    </div>

</div>


<div id="contenedor_resultado" class="row d-none">
    <div class="col-sm-12">
        <canvas id="resultadobarra" style="width:100%; height:300px;"></canvas>
    </div>

</div>
<canvas id="resultadotest" style="width:50px!important;">
</canvas>

{{-- <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-gauge@0.3.0/dist/chartjs-gauge.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function graficasclick(e, indicador_id, rojo, amarillo, verde, resultado, meta) {
        if (!e) var e = window.event; // Get the window event
        e.cancelBubble = true; // IE Stop propagation
        if (e.stopPropagation) e.stopPropagation(); // Other Broswers
        console.log(indicador_id, rojo, amarillo, verde, resultado, meta);
        $.ajax({
            data: {
                id: indicador_id,
                rojo: rojo,
                amarillo: amarillo,
                verde: verde,
                resultado: resultado,
                meta: meta,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('admin.selectIndicador') }}',
            type: 'POST',
            beforeSend: function() {
                document.getElementById('contenedor_resultado').classList.add("d-none");
                $("#resultado").html(
                    '<div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div>'
                );
            },
            success: function(data) {
                document.getElementById('contenedor_resultado').classList.remove("d-none");
                $("#resultado").html(data);
                $("#resultadobarra").html(data);
                console.log("data" + data);
                // document. getElementById("resultadobarra"). style. display = ""; //show.
                let {
                    datosbarra
                } = data;

                let datosGrafica = datosbarra.map(dato => {
                    return dato.resultado
                });

                let datosFecha = datosbarra.map(dato => {
                    return dato.fecha
                });


                //speedometer
                // Element inside which you want to see the chart
                let element = document.querySelector('#resultado')

                element.innerHTML += `<div class="cuadro_info"><h4>Riesgos %</h4> <h4>${data.datos.resultado * 100 / data.datos.meta}</h4></div>`


                // let limiteInf = parseInt(data.datos.amarillo);
                // console.log(limiteInf);
                // let limiteSup = parseInt(data.datos.verde);
                // console.log(limiteSup);

                // Properties of the gauge
                let limiteInf = 1;
                if (data.datos.amarillo > 0 && data.datos.amarillo < 100) {
                    limiteInf = data.datos.amarillo
                } else if (data.datos.amarillo >= 100) {
                    limiteInf = 99
                }
                let limiteSup = 1;
                if (data.datos.verde > 0 && data.datos.verde < 100) {
                    limiteSup = data.datos.verde
                } else if (data.datos.verde >= 100) {
                    limiteSup = 99
                }
                console.log(limiteInf, limiteSup)
                // let gaugeOptions = {
                //     hasNeedle: true,
                //     needleColor: 'black',
                //     needleStartValue: 0,
                //     needleUpdateSpeed: 5000,
                //     arcColors: ["rgb(255,84,84)", "rgb(239,214,19)", "rgb(61,204,91)"],
                //     arcDelimiters: [limiteInf, limiteSup],
                //     rangeLabel: ['0', data.datos.meta],
                //     centralLabel: data.datos.resultado,
                // }

                // GaugeChart.gaugeChart(element, 300, gaugeOptions).updateNeedle(data.datos.resultado);

                var ctx = document.getElementById("resultadotest").getContext("2d");

                // var chart = new Chart(ctx, {
                //     type: 'gauge',
                //     data: {
                //         datasets: [{
                //             value: data.datos.resultado,
                //             minValue: 0,
                //             data: [data.datos.rojo, data.datos.amarillo, data.datos.verde],
                //             backgroundColor: [ 'red','yellow','green'],
                //         }]
                //     },
                //     options: {
                //         needle: {
                //             radiusPercentage: 2,
                //             widthPercentage: 3.2,
                //             lengthPercentage: 80,
                //             color: 'rgba(0, 0, 0, 1)'
                //         },
                //         valueLabel: {
                //             display: true,
                //             formatter: (value) => {
                //                 return '$' + Math.round(value);
                //             },
                //             color: 'rgba(255, 255, 255, 1)',
                //             backgroundColor: 'rgba(0, 0, 0, 1)',
                //             borderRadius: 5,
                //             padding: {
                //                 top: 10,
                //                 bottom: 10
                //             }
                //         }
                //     }
                // });

                console.log(data.datos.resultado);
                var ctx = document.getElementById("resultadobarra");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: datosFecha,
                        datasets: [{
                            label: '# Indicadores',
                            data: datosGrafica,

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
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        legend: {
                            display: false
                        },
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
                                // {
                                //     position: "top",
                                //     ticks: {
                                //         maxRotation: 90,
                                //         minRotation: 80
                                //     },
                                //     gridLines: {
                                //         offsetGridLines: true // et matcher pareil ici
                                //     }
                                // }
                            ],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },

            error: function(data) {
                //console.log(data);
                $("#resultado").html(
                    '<div class="spinner-border text-danger" role="status"><span class="sr-only">Intente de nuevo...</span></div>'
                );
            }
        });

    };

    //radarchart
    //Empieza radar chart
    var data = {
        labels: [
            "Dominio 5",
            "Dominio 6",
            "Dominio 7",
            "Dominio 8",
            "Dominio 9",
            "Dominio 10",
            "Dominio 11",
            "Dominio 12",
            "Dominio 13",
            "Dominio 14",
            "Dominio 15",
            "Dominio 16",
            "Dominio 17",
            "Dominio 18",
        ],
        datasets: [{
                label: "Meta",
                backgroundColor: "rgba(179,181,198,0.2)",
                borderColor: "rgba(179,181,198,1)",
                pointBackgroundColor: "rgba(179,181,198,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(179,181,198,1)",
                data: [65, 59, 90, 81, 56, 55, 40, 20, 10, 50, 80, 56, 48, 74]
            },
            {
                label: "Alcanzado",
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                data: [28, 48, 40, 79, 96, 27, 100, 54, 24, 90, 83, 23, 64, 32]
            }
        ]
    };
</script>



<script>
    function mostrar() {
        div = document.getElementById('resultadobarra');
        div.style.display = '';
    }

    function cerrar() {
        div = document.getElementById('resultadobarra');
        div.style.display = 'none';
    }
</script>


