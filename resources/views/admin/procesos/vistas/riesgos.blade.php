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

    .table-scroll {
        display: block;
        height: 250px;
        overflow-y: scroll;
    }

    .fila_activa{
        background-color:#ccc !important;

    }

</style>

<div class="row">
    <div class="col-sm-7">
        <div class="card-body datatable-fix">
            <p class="ml-5">De click sobre una fila para desplegar información</p>
            <div class="table-scroll">
                <table class="table table-hover table-bordered tbl-categorias w-100" id="riesgos_table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="font-size:10pt">ID</th>
                            <th scope="col" style="font-size:10pt">Descripción</th>
                            <th class="text-center" scope="col" style="font-size:10pt">Nivel de riesgo</th>
                            <th scope="col">Riesgo residual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riesgos as $riesgo)
                            <tr class="clickable-row sesioninicio"
                                onclick='graficasclick_riesgo(event, {{ $riesgo->id }})'>
                                <td class="fila_activa">{{ $riesgo->id }}</td>
                                <td>{{ $riesgo->descripcionriesgo }}</td>
                                <td>{{ $riesgo->nivelriesgo }}</td>
                                <td>{{ $riesgo->nivelriesgo_residual }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <div class="mt-5 col-sm-5">

        <div class="d-flex justify-content-center">
            <div style="" id="resultado_riesgos" style="width:100%;">

            </div>

        </div>

    </div>

</div>


<div id="contenedor_resultado_riesgos" class="row d-none">
    <div class="col-sm-12">
        <canvas id="resultadobarra_riesgos" style="width:100%; height:300px;"></canvas>
    </div>
</div>


<script type="text/javascript">
    // $(document).ready(function() {
    //     alert("ejecuto");
    //     $('#riesgos_table').on('click', '.clickable-row', function(event) {
    //         $(this).addClass('bg-info').siblings().removeClass('bg-info');
    //     });
    // });

    // $(".sesioninicio").mouseenter(function(){
    // 		$(".sesioninicio").css("color","#18CCA6");
    // 	});

    // 	$(".sesioninicio").mouseleave(function(){
    // 		$(".sesioninicio").css("color","#0099CD");
    // 	});

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    function graficasclick_riesgo(e, riesgos_id) {
        if (!e) var e = window.event; // Get the window event
        e.cancelBubble = true; // IE Stop propagation
        if (e.stopPropagation) e.stopPropagation(); // Other Broswers
        //console.log("RESULTADOS", riesgos_id);
        $.ajax({
            data: {
                id: riesgos_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('admin.selectRiesgos') }}',
            type: 'POST',
            beforeSend: function() {
                document.getElementById('contenedor_resultado_riesgos').classList.add("d-none");
                $("#resultado_riesgos").html(
                    '<div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div>'
                );
            },
            success: function(data) {
                document.getElementById('contenedor_resultado_riesgos').classList.remove("d-none");
                $("#resultado_riesgos").html(data);
                $("#resultadobarra_riesgos").html(data);
                console.log("data " + data.datos_riesgos.nivelriesgo);
                // document. getElementById("resultadobarra"). style. display = ""; //show.

                //speedometer
                // Element inside which you want to see the chart
                let element = document.querySelector('#resultado_riesgos')

                // Properties of the gauge
                let gaugeOptions = {
                    hasNeedle: true,
                    needleColor: 'black',
                    needleStartValue: 0,
                    needleUpdateSpeed: 1000,
                    arcColors: ["rgb(255,84,84)", "rgb(239,214,19)", "rgb(61,204,91)"],
                    arcDelimiters: [30, 70],
                    rangeLabel: ['0', '100'],
                    centralLabel: data.datos_riesgos.nivelriesgo,
                }

                // Drawing and updating the chart
                GaugeChart.gaugeChart(element, 300, gaugeOptions).updateNeedle(data.datos.resultado)

                var ctx = document.getElementById("resultadobarra_riesgos");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: datosFecha,
                        datasets: [{
                            label: '# Riesgos',
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
                $("#resultado_riesgos").html(
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
        div = document.getElementById('resultadobarra_riesgos');
        div.style.display = '';
    }

    function cerrar() {
        div = document.getElementById('resultadobarra_riesgos');
        div.style.display = 'none';
    }
</script>
