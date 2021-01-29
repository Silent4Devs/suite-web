<style type="text/css">
    .tbla_12 th {
        vertical-align: center;
    }

    .tabla_12 thead tr {
        background: #28ab77;
        color: #fff;
    }

    .tabla_12 tbody tr:nth-child(even) {
        background: rgba(40, 171, 119, 0.1);
        margi
    }
</style>


<div class="scrollme">
    <table class="table table-responsive tabla_12" style="font-size: 12px;">
        <thead class="letras-dashboard2 align-middle">
        <tr>
            <th scope="col" width="2%">No</th>
            <th scope="col" width="30%">Actividad</th>
            <th scope="col" width="10%">Actividad Principal</th>
            <th scope="col" width="10%">Ejecutar</th>
            <th scope="col">Estado</th>
            <th scope="col">Responsable</th>
            <th scope="col">Colaborador</th>
            <th scope="col" width="20%">Fecha Inicio</th>
            <th scope="col" width="20%">Fecha Fin</th>
            <th scope="col">Fecha Compromiso</th>
            <th scope="col" width="17%">Fecha Real</th>

        </tr>
        </thead>
        <tbody>
        @foreach($planbases as $actividadplan)
            <tr>
                <td scope="row">
                    {{$actividadplan->id}}
                </td>
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
                <td scope="row">
                    {{$actividadplan->responsable_id}}
                </td>
                <td scope="row">
                    {{$actividadplan->colaborador_id}}
                </td>
                <td scope="row">
                    {{$actividadplan->fecha_inicio}}
                </td>
                <td scope="row">
                    {{$actividadplan->fecha_fin}}
                </td>
                <td scope="row">
                    {{$actividadplan->compromiso}}
                </td>
                <td scope="row">
                    {{$actividadplan->real}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


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
            new Date("2021-2-2"), new Date("2021-2-2"), new Date("2021-1-2"), new Date("2021-1-2"), new Date("2021-1-2"),
            new Date("2021-1-2"), new Date("2021-1-2"), new Date("2021-1-2"), new Date("2021-1-2"), new Date("2021-1-2"),
            new Date("2021-1-2"), new Date("2021-1-2"),

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
                        label: function (tooltipItem, data) {
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
        $(document).ready(function () {

            $.fn.editable.defaults.mode = 'popup';
            $.fn.editable.defaults.send = "always";

            $.fn.editable.defaults.params = function (params) {
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
        $(document).ready(function () {
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
                success: function (response, newValue) {
                    console.log('Actualizado, response')
                }
            });

        });
        @endsection
    </script>

@endsection
