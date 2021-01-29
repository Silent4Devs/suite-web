@extends('layouts.admin')
@section('content')

<style type="text/css">
    .graph_container {
        display: block;
        width: 600px;
    }

    .letras-dashboard {
        font-size: 15px;
    }

    .letras-dashboard2 {
        font-size: 15px;
    }

    .fondo-azul {
        background-color: deepskyblue;
        color: black;
    }
    .scrollme {
    overflow-y: auto;
}
</style>

<div class="row">
    <div class="col-12">
        <div class="card mt-5">
            <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2  text-center text-white"><strong>Plan de trabajo base</strong></h3>
            </div>

            <div class="row align-self-center">
                <div class="col-md-12" align="center">
                <div class="col-md-12 col-sm-9 mt-2 py-1 card card-body bg-secondary align-self-center " style="margin-top:-40px; ">
                    <h3 class="mb-2  text-center text-white"><strong>Actividades</strong></h3>
                    </div>
                    <div class="scrollme">
                    <table class="table table-responsive" style="font-size: 12px;">
                        <thead class="thead-dark letras-dashboard2 align-middle">
                            <tr>
                                <th scope="col" width="2%">No</th>
                                <th scope="col" width="30%">Actividad</th>
                                <th scope="col" width="10%">Actividad Principal</th>
                                <th scope="col" width="10%">Ejecutar</th>
                                <th scope="col">Estado </th>
                                <th scope="col">Responsable</th>
                                <th scope="col">Colaborador</th>
                                <th scope="col" width="20%">Fecha Inicio  </th>
                                <th scope="col" width="20%">Fecha Fin </th>
                              <th scope="col">Fecha Compromiso</th>
                                <th scope="col" width="17%">Fecha Real</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($planbases as $actividadplan)
                            <tr>
                                <th scope="row">
                                    {{$actividadplan->id}}
                                </th>
                                <td>
                                    {{$actividadplan->actividad}}
                                </td>
                                <td>
                                    {{$actividadplan->actividad_padre_id}}
                                </td>
                                <td>
                                    {{$actividadplan->ejecutar_id}}
                                </td>
                                <td>
                                    <a href="#"
                                       data-type="select"
                                       data-pk="{{$actividadplan->id}}"
                                       data-url="{{route("admin.implementacions.update",  $actividadplan->id)}}"
                                       data-title="Seleccionar estado"
                                       data-value="{{$actividadplan->estatus_id}}"
                                       class="estatus_id"
                                       data-name="estatus_id">
                                    </a>
                                </td>
                                <th scope="row">
                                    {{$actividadplan->responsable_id}}
                                </th>
                                <th scope="row">
                                    {{$actividadplan->colaborador_id}}
                                </th>
                                <th scope="row">
                                    {{$actividadplan->fecha_inicio}}
                                </th>
                                <th scope="row">
                                    {{$actividadplan->fecha_fin}}
                                </th>
                             <th scope="row">
                                    {{$actividadplan->compromiso}}
                                </th>
                                <th scope="row">
                                    {{$actividadplan->real}}
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-md-12">
                <div class="col-md-12 col-sm-9 mt-2 py-1 card card-body bg-secondary align-self-center " style="margin-top:-40px; ">
                    <h3 class="mb-2  text-center text-white"><strong>Diagrama de Gantt</strong></h3>
                    </div>

                    <canvas id="myChart" width="850" height="550px"></canvas>
                </div>

            </div>
        </div>
        @endsection
        @section('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js">
        </script>
        <script>
            var dates = [new Date("2020-12-24"), new Date("2020-12-26"), new Date("2020-12-30"), new Date("2021-1-2"),
            new Date("2021-1-2"),
            new Date("2021-1-3"),
            new Date("2021-1-5"),
            new Date("2021-1-6"),
            new Date("2021-1-7"),
            new Date("2021-1-8"),
            new Date("2021-1-8"),
            new Date("2021-1-9"),
            new Date("2021-2-2"),new Date("2021-2-2"),new Date("2021-1-2"),new Date("2021-1-2"),new Date("2021-1-2"),
            new Date("2021-1-2"),new Date("2021-1-2"),new Date("2021-1-2"),new Date("2021-1-2"),new Date("2021-1-2"),
            new Date("2021-1-2"),new Date("2021-1-2"),

            new Date("2021-1-4"), new Date("2021-1-9"), new Date("2021-1-10")];


            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: dates.map((d, i) => " " + i).splice(1),
                    datasets: [{
                        label: 'Actividades',
                        data: dates.map((d, i) => i == 0 ? null : [dates[i - 1], d]).slice(1),
                        backgroundColor: 'teal',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
            display: false,
        },
        tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
          console.log(tooltipItem, data)
          let values = data.datasets[0].data[tooltipItem.index]
          console.log(values)
          console.log(moment(values[0]).format('YYYY-MM-DD'), moment(values[0]))
          return moment(values[0]).format('YYYY-MM-DD') + ' al ' + moment(values[1]).format('YYYY-MM-DD')
        }
      },
      yAlign: 'top'
    },
                    scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                                displayFormats: {
                                    day: 'YYYY-MM-DD'
                                }
                            },
                            ticks: {
                                min: dates[0].getTime(),
                                max: dates[dates.length - 1].getTime()
                            }
                        }]
                    }
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                $.fn.editable.defaults.mode = 'popup';
                $.fn.editable.defaults.send = "always";

                $.fn.editable.defaults.params = function(params) {
                    params._token = $("#_token").data("token");
                    return params;
                };

                $('#investmentName').editable({

                    type: 'text',
                    url: '/',
                    send: 'always'

                });
            });
        </script>
        <script>
            @section('x-editable')
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //categories table
                $(".estatus_id").editable({
                    dataType: 'json',
                    source: [{
                            value: '1',
                            text: 'Sin iniciar'
                        },
                        {
                            value: '2',
                            text: 'En proceso'
                        },
                        {
                            value: '3',
                            text: 'Completada'
                        },
                        {
                            value: '4',
                            text: 'Retrasada'
                        },
                        {
                            value: '5',
                            text: 'Cancelada'
                        },
                    ],
                    success: function(response, newValue) {
                        console.log('Actualizado, response')
                    }
                });

            });
            @endsection
        </script>
        @endsection
