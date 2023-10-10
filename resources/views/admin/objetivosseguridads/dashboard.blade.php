@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.objetivos-seguridad-dashboard') }}
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
    <div class="print-none">
        <h5 class="col-12 titulo_general_funcion">Dashboard</h5>
    </div>

    <div class="accordion" id="accordionExample">
        @foreach ($tipos as $tipo)
            @php
                $contador = 0;
            @endphp
            <div class="card">
                <div class="card-header" id="headingOne{{ $tipo->id }}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseOne{{ $tipo->id }}" aria-expanded="true"
                            aria-controls="collapseOne{{ $tipo->id }}">
                          <p  style="font-size:13pt;color:#3086AF">{{ $tipo->nombre }}</p>

                        </button>
                    </h2>
                </div>

                <div id="collapseOne{{ $tipo->id }}" class="collapse {{ $loop->first ? 'show' : '' }}"
                    aria-labelledby="headingOne{{ $tipo->id }}" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($objetivos as $objetivo)
                                @if ($tipo->id == $objetivo->tipo_objetivo_sistema_id)
                                    @php
                                        $contador++;
                                    @endphp
                                    <div class="col-12">

                                        <div class="mb-1">
                                            <h5 class="m-0 p-0">{{ $objetivo->indicador }}</h5>
                                        </div>
                                        <div class="mb-4">
                                            <p style="color:#3086AF !important">Meta: {{ $objetivo->meta }}</p>
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
                                                        @foreach ($objetivo->evaluacion_objetivos as $evaluacion)
                                                            <tr>
                                                                <td>
                                                                    {{ $evaluacion->evaluacion }}
                                                                </td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($evaluacion->fecha)->format('d-m-Y') }}
                                                                </td>
                                                                <td>
                                                                    @if($evaluacion->resultado >= $objetivo->meta)
                                                                        <span
                                                                        class="dotverde mr-2"></span> Sí
                                                                        @else
                                                                        <span
                                                                            class="dotred mr-2"></span> No
                                                                     @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-4">
                                                <canvas id="chart{{ $objetivo->id }}"></canvas>

                                            </div>
                                        </div>
                                        <hr class="mb-5 mt-5">

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
    <script>
        let objetivos = @json($objetivos);
        let tipos = @json($tipos);
        objetivos.forEach(objetivo => {
            tipos.forEach(tipo => {
                if (objetivo.tipo_objetivo_sistema_id == tipo.id) {
                    let cumplimiento = 0;
                    console.log('Hola');
                    let incumplimiento = 0;
                    objetivo?.evaluacion_objetivos?.forEach(evaluacion => {
                        console.log(evaluacion.resultado, objetivo.meta);
                        if (evaluacion.resultado >= Number(objetivo.meta)) {
                            cumplimiento++;
                        } else {
                            incumplimiento++;
                        }
                    })
                    console.log(cumplimiento, incumplimiento)
                    var chartCumplimiento = document.getElementById(`chart${objetivo.id}`);
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
    </script>
@endsection
