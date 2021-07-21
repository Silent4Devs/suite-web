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

</style>



<div class="row">
    <div class="col-sm-7">
        <div class="card-body datatable-fix">

            <table class="table table-bordered tbl-categorias w-100">

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
                <tbody>

                    @foreach ($indicadores as $indicador)
                        <tr>
                            <td ><a class="btnId" name="" id="" class="btn btn-primary" role="button"></a>{{ $indicador->id }}</td>
                            <td>{{ $indicador->nombre }}</td>
                            <td>{{ $indicador->descripcion }}</td>
                            <td>{{ $indicador->formula }}</td>
                            @php
                                $i = 0;
                                foreach ($indicador->evaluacion_indicadors as $value) {
                                    $i += $value->resultado;
                                }
                            @endphp
                            <td>
                                @if ($i >= $indicador->verde)
                                    <span class="dotverde"></span>
                                @elseif($i >= $indicador->amarillo && $i < $indicador->verde)
                                        <span class="dotyellow"></span>
                                    @else
                                        <span class="dotred"></span>
                                @endif
                                {{ $i . $indicador->unidadmedida }}
                            </td>
                            <td>{{ $indicador->meta }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
    <div class="col-sm-5">

        <div id="gaugeArea" width="800" height="650"></div>

    </div>

</div>

<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script>


    document.querySelectorAll("td.btnId").forEach(function(elem) {

        elem.addEventListener('click', generarGrafica, false);

    });

    function generaGrafica() {
        var btnId=this.value;
        alert(btnId);
    }
    // Drawing and updating the chart


    //speedometer
    // Element inside which you want to see the chart
    let element = document.querySelector('#gaugeArea')

    // Properties of the gauge
    let gaugeOptions = {
        hasNeedle: 1,
        needleColor: 'black',
        needleStartValue: 0,
        needleUpdateSpeed: 1000,
        arcColors: ["rgb(255,84,84)", "rgb(239,214,19)", "rgb(61,204,91)"],
        arcDelimiters: [{{ $indicador->yellow }}, 66.66],
        rangeLabel: ['0', '100'],
        centralLabel: 1,
    }

    // Drawing and updating the chart
    GaugeChart.gaugeChart(element, 300, gaugeOptions).updateNeedle(100)

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
