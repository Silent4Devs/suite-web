@extends('layouts.admin')
@section('content')
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

    {{ Breadcrumbs::render('admin.indicadores-dashboard') }}

    <div class="text-right mt-5 mr-5">
        <a class="btn btn-danger" type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
            data-target="#largeModal">Porcentaje de Cumplimiento</a>
    </div>

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <h5>Porcentaje de cumplimiento</h5>
                    <!-- carousel -->
                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>

                        <div class='carousel-inner'>

                            <div class="row mt-2">
                                <div class="form-group col-12">
                                    <label for="nombre"><i class="fas fa-percentage iconos-crear"></i>Porcentaje</label>
                                    <input class="form-control{{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                        type="number" name="nombre" id="porcentaje" value="{{ old('nombre', '') }}">
                                    <span class="text-danger error_porcentaje errors"></span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="guardar_porcentaje" class="btn btn"
                        style="color:white;background-color:#345183 !important">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <div class="print-none">
        <h5 class="col-12 titulo_general_funcion">Dashboard</h5>
    </div>


    <div class="card">
        <div class="row mt-4 ml-2">
            <div class="col-7">
                <table class="table table-striped table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                Área
                            </th>
                            <th>
                                ¿Alcanzó la meta?
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $area)
                            @php
                                
                                $enCumplimiento = 0;
                                $enIncumplimiento = 0;
                                $parametroCumplimiento = $porcentajeCumplimiento ? $porcentajeCumplimiento->porcentaje_cumplimiento : 60;
                                $estaEnCumplimiento = false;
                            @endphp
                            @foreach ($indicadores as $indicador)
                                @if ($area->id == $indicador->id_area)
                                    @foreach ($indicador->evaluacion_indicadors as $evaluacion)
                                        @php
                                            if ($evaluacion->resultado >= $indicador->meta) {
                                                $enCumplimiento++;
                                            } else {
                                                $enIncumplimiento++;
                                            }
                                        @endphp
                                    @endforeach
                                    @php
                                        $totalIndicadores = count($indicador->evaluacion_indicadors) > 0 ? count($indicador->evaluacion_indicadors) : 1;
                                        $porcentajeEnCumplimiento = ($enCumplimiento * 100) / $totalIndicadores;
                                        $estaEnCumplimiento = round($porcentajeEnCumplimiento) >= $parametroCumplimiento ? true : false;
                                        
                                    @endphp
                                @endif
                            @endforeach
                            <tr>
                                <td>
                                    {{ $area->area }}
                                </td>
                                <td>

                                    @if (count($area->indicadores_sistema_gestion) > 0)
                                        @if ($estaEnCumplimiento)
                                            <span class="dotverde mr-2"></span> Sí
                                        @else
                                            <span class="dotred mr-2"></span> No
                                        @endif
                                    @else
                                        Sin indicadores
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-5">
                <canvas id="chart_cumplimiento_area"></canvas>

            </div>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        @foreach ($areas as $area)
            @php
                $contador = 0;
            @endphp
            <div class="card">
                <div class="card-header" id="headingOne{{ $area->id }}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseOne{{ $area->id }}" aria-expanded="true"
                            aria-controls="collapseOne{{ $area->id }}">
                            <p style="font-size:13pt;color:#3086AF">{{ $area->area }}</p>

                        </button>
                    </h2>
                </div>

                <div id="collapseOne{{ $area->id }}" class="collapse {{ $loop->first ? 'show' : '' }}"
                    aria-labelledby="headingOne{{ $area->id }}" data-parent="#accordionExample">
                    <div class="card-body">

                        <div class="row">
                            @foreach ($indicadores as $indicador)
                                @if ($area->id == $indicador->id_area)
                                    @php
                                        $contador++;
                                    @endphp
                                    <div class="col-12">

                                        @if (count($indicador->evaluacion_indicadors) > 0)
                                            <div class="mb-1">
                                                <h5 class="m-0 p-0">{{ $indicador->nombre }}</h5>
                                            </div>
                                            <div class="mb-4">
                                                <p style="color:#3086AF !important">Meta: {{ $indicador->meta }}</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-8">
                                                    <table class="table table-striped table-sm">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>
                                                                    Nombre de la evaluación
                                                                </th>
                                                                <th>
                                                                    Fecha
                                                                </th>
                                                                <th>
                                                                    ¿Alcanzó la meta?
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($indicador->evaluacion_indicadors as $evaluacion)
                                                                <tr>
                                                                    <td>
                                                                        {{ $evaluacion->evaluacion }}
                                                                    </td>
                                                                    <td>
                                                                        {{ \Carbon\Carbon::parse($evaluacion->fecha)->format('d-m-Y') }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($evaluacion->resultado >= $indicador->meta)
                                                                            <span class="dotverde mr-2"></span> Sí
                                                                        @else
                                                                            <span class="dotred mr-2"></span> No
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="col-4">
                                                    <canvas id="chart{{ $indicador->id }}"></canvas>
                                                </div>
                                            </div>
                                            <hr class="mb-5 mt-5">
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        @if ($contador == 0)
                            No contiene indicadores
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script>
        let indicadores = @json($indicadores);
        let areas = @json($areas);
        indicadores.forEach(indicador => {
            areas.forEach(area => {
                if (indicador.id_area == area.id) {
                    let cumplimiento = 0;
                    let incumplimiento = 0;
                    indicador?.evaluacion_indicadors?.forEach(evaluacion => {
                        console.log(evaluacion.resultado, indicador.meta);
                        if (evaluacion.resultado >= Number(indicador.meta)) {
                            cumplimiento++;
                        } else {
                            incumplimiento++;
                        }
                    })
                    console.log(cumplimiento, incumplimiento)
                    var chartCumplimiento = document.getElementById(`chart${indicador.id}`);
                    console.log(chartCumplimiento);
                    var cumplimientoDacciones = {
                        labels: [
                            "En Incumplimiento",
                            "En Cumplimiento"
                        ],
                        datasets: [{
                            data: [incumplimiento, cumplimiento],
                            backgroundColor: [
                                "rgba(255, 65, 123, 1)",
                                "rgba(109, 200, 102, 1)",
                            ]
                        }]
                    };

                    var pieChart = new Chart(chartCumplimiento, {
                        type: 'pie',
                        data: cumplimientoDacciones,
                        options: {
                            plugins: {
                                datalabels: {
                                    color: 'white',
                                    display: true,
                                    font: {
                                        size: 20
                                    }
                                },
                            },
                        },
                    });
                }
            });
        });
    </script> --}}

    <script>
        let indicadores = @json($indicadores);
        let areas = @json($areas);
        let areaEnIncumplimiento = 0;
        let areaEnCumplimiento = 0;
        let contadorSinIndicadores = 0;
        areas.forEach(area => {
            let estaEnCumplimiento = false;
            let totalIndicadores = 0;
            let enCumplimiento = 0;
            let enIncumplimiento = 0;
            let parametroCumplimiento = @json($porcentajeCumplimiento ? $porcentajeCumplimiento->porcentaje_cumplimiento : 60);

            indicadores.forEach(indicador => {

                if (indicador.id_area == area.id) {
                    let cumplimiento = 0;
                    let incumplimiento = 0;

                    indicador?.evaluacion_indicadors?.forEach(evaluacion => {
                        if (evaluacion.resultado >= Number(indicador.meta)) {
                            cumplimiento++;
                            enCumplimiento++;
                        } else {
                            incumplimiento++;
                            enIncumplimiento++;
                        }
                    })
                    console.log(indicador.evaluacion_indicadors.length);
                    totalIndicadores = indicador.evaluacion_indicadors.length > 0 ? indicador
                        .evaluacion_indicadors.length : 1;

                    var chartCumplimiento = document.getElementById(`chart${indicador.id}`);

                    // var chartCumplimientoAreas = document.getElementById(`chart${indicador.id}`);

                    var cumplimientoDacciones = {
                        labels: [
                            "En Incumplimiento",
                            "En Cumplimiento"
                        ],
                        datasets: [{
                            data: [incumplimiento, cumplimiento],
                            backgroundColor: [
                                "rgba(255, 65, 123, 1)",
                                "rgba(109, 200, 102, 1)",
                            ]
                        }]
                    };

                    var pieChart = new Chart(chartCumplimiento, {
                        type: 'pie',
                        data: cumplimientoDacciones,
                        options: {
                            plugins: {
                                datalabels: {
                                    color: 'white',
                                    display: true,
                                    font: {
                                        size: 20
                                    }
                                },
                            },
                        },
                    });
                }
            });
            let porcentajeEnCumplimiento = (enCumplimiento * 100) / totalIndicadores;
            console.log(area.area, area.indicadores_sistema_gestion)
            if (area.indicadores_sistema_gestion.length > 0) {
                estaEnCumplimiento = Math.round(porcentajeEnCumplimiento) >= parametroCumplimiento ?
                    true : false;
                if (estaEnCumplimiento) {
                    areaEnCumplimiento++;
                } else {
                    areaEnIncumplimiento++;
                }
            } else {
                contadorSinIndicadores++
            }
        });
        var chartCumplimientoArea = document.getElementById(`chart_cumplimiento_area`);
        // var chartCumplimientoAreas = document.getElementById(`chart${indicador.id}`);

        var cumplimientoDaccionesArea = {
            labels: [
                "En Incumplimiento",
                "En Cumplimiento",
                "Sin Indicador"
            ],
            datasets: [{
                data: [areaEnIncumplimiento, areaEnCumplimiento, contadorSinIndicadores],
                backgroundColor: [
                    "rgba(255, 65, 123, 1)",
                    "rgba(109, 200, 102, 1)",
                    "rgba(255, 200, 102, 1)",
                ]
            }]
        };

        var pieChartArea = new Chart(chartCumplimientoArea, {
            type: 'pie',
            data: cumplimientoDaccionesArea,
            options: {
                plugins: {
                    datalabels: {
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },
        });

        document.getElementById('guardar_porcentaje').addEventListener('click', (e) => {
            let porcentaje = document.getElementById('porcentaje').value;

            e.preventDefault();
            document.querySelectorAll('.errors').forEach(error => {
                                error.innerHTML = "";
                            });
            $.ajax({
                type: "post",
                url: "{{ route('admin.indicadores-porcentaje-dashboard') }}",
                data: {porcentaje},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.estatus == 200) {
                        Swal.fire('Porcentaje de cumplimiento Actualizado con éxito!', '', 'success')
                            .then(() => {
                                window.location.reload();
                                $('#largeModal').modal('show')
                                document.querySelector('.modal-backdrop').style.display="none";
                            })
                    }
                },
                error: function(request, status, error) {
                            document.querySelectorAll('.errors').forEach(error => {
                                error.innerHTML = "";
                            });
                            $.each(request.responseJSON.errors, function(indexInArray, valueOfElement) {
                                console.log(valueOfElement, indexInArray);
                                $(`span.error_${indexInArray}`).text(valueOfElement[0]);

                            });
                        }
            });
        })
    </script>
@endsection
