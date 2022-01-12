@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Evaluacion-Resumen', $evaluacion) }}
    <style>
        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(11px at 50% 50%);
            height: 20px;
        }

        table {
            height: 1px;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Resumen: </strong> Evaluación </h3>
        </div>
        <div class="mt-3 col-12">
            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                RESUMEN GENERAL
            </div>
        </div>
        @livewire('ev360-resumen-tabla', ['evaluacion' => $evaluacion->id])
        <div class="mt-3 col-12">
            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                GRÁFICAS
            </div>
        </div>
        <div class="container row">
            <div class="col-6">
                <canvas id="resultadosGenerales"></canvas>
            </div>
            <div class="col-6">
                <table class="table table-sm">
                    <thead>
                        <th class="text-center" colspan="2">Calificaciones</th>
                    </thead>
                    <tbody>
                        @foreach ($calificaciones as $key => $calificacion)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $calificacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('resultadosGenerales').getContext('2d');
        var resultadosGenerales = new Chart(ctx, {
            type: 'bar',
            data: {

                datasets: [{
                    label: 'Resultados Generales',
                    data: @json($calificaciones),
                    backgroundColor: [
                        'rgba(231, 76, 60, 0.8)',
                        'rgba(230, 126, 34 , 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(46, 204, 113 , 0.8)',

                    ],
                    borderColor: [
                        'rgba(231, 76, 60, 1)',
                        'rgba(230, 126, 34 , 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(46, 204, 113 , 1)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
