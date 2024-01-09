<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Analisis de brechas</title>
    <link rel="stylesheet" href="css/analisis_brechas_pdf.css">
</head>
<body>

    <div class="caja-general-doc">
        <table class="encabezado">
            <tr>
                <td class="td-img-doc">
                    @if ($organizacion_actual)
                    <img style="width:100%; max-width:100px; position: relative; left:1rem;" src="{{asset('silent.png')}}">
                    @else
                        <img src="{{ public_path('sinLogo.png') }}"  style="width:100%; max-width:150px;">
                    @endif
                </td>
                <td class="info-header">
                    <div style="position: relative; right: 5rem; text-align: justify;">
                        {{$empresa_actual}} <br>
                        {{$rfc}} <br>
                        {{$direccion}} <br>
                    </div>
                </td>
                <td >
                    <h5 class="td-data-header"></h5>
                    Reporte Análisis de Brechas
                </td>
            </tr>
        </table>
        <br>
        <br>
        <div class="row" style="margin-top: 40px;">
            <div class="col-12">
                <div class="row" style="margin: 0; padding: 0;">
                    <div class="col-11">
                        <h5 class="title-grafics">
                            Porcentaje Total del Análisis
                        </h5>
                    </div>
                </div>
                <hr>
            </div>
            <table>
                <tr>
                    <td>
                        <table>
                            <thead>
                                <tr style="background:#EBEBEB;">
                                    <th>
                                        Sección
                                    </th>
                                    <th>
                                        Meta
                                    </th>
                                    <th>
                                        Alcanzado
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($template->secciones as $key => $seccion)
                                    <tr style="background: #FFFFFF;">
                                        <td>
                                            Sección{{ $seccion->numero_seccion }}
                                        </td>
                                        <td>
                                            {{ round($seccion->porcentaje_seccion) }}%
                                        </td>
                                        <td>
                                            {{ round(number_format((float) $sectionPercentages[$seccion->numero_seccion]['total_porcentaje'], 2, '.')) ?? 0 }}%
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr style="background: #EEFDFF;">
                                    <td colspan="1">Total</td>
                                    <td>100%</td>
                                    <td>{{ number_format((float) $sectionPercentages[0]['percentage'], 2, '.') ?? 0 }}%
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                    <td>
                        <div>
                            <canvas id="donaChart" width="400" height="400"></canvas>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
        @foreach ($template->secciones as $key => $seccion)
            <div class="row" style="margin-top: 40px;">
                <div class="col-12">
                    <div class="row" style="margin: 0; padding: 0;">
                        <div class="col-11">
                            <h5 class="title-grafics">
                                Sección {{ $seccion->numero_seccion }}: {{ $seccion->descripcion }}
                            </h5>
                        </div>
                    </div>
                    <hr>
                </div>
                <table>
                    <tr>
                        <td>
                            <table>
                                <thead >
                                    <tr style="background:#EBEBEB;">
                                        <th>
                                            Estatus
                                        </th>
                                        <th>
                                            Requisitos
                                        </th>
                                        <th>
                                            Peso
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($template->parametros as $parametro)
                                        <tr style="background: #FFFFFF;">
                                            <td>
                                                {{ $parametro->estatus }}
                                            </td>
                                            <td style="background-color: {{ $parametro->color }}">
                                                {{$results[$key]['counts'][$parametro->id] ?? 0}}
                                            </td>
                                            <td>
                                                {{ number_format((float) $results[$key]['porcentaje_parametros'][$parametro->id], 2, '.') ?? 0 }}%
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr style="background: #EEFDFF;">
                                        <td>Total</td>
                                        <td>{{ $results[$key]['totalCount'] ?? 0 }}</td>
                                        <td>{{ number_format((float) $results[$key]['total_porcentaje'], 2, '.') ?? 0 }}%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                        <td>grafica</td>
                    </tr>

                </table>
            </div>
        @endforeach
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('donaChart').getContext('2d');
            var donaChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Dato 1', 'Dato 2'],
                    datasets: [{
                        data: [25, 10],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                        ],
                        borderWidth: 1,
                    }],
                },
            });
        });
    </script> --}}
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                var ctx = document.getElementById('donaChart').getContext('2d');
                var donaChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Dato 1', 'Dato 2'],
                        datasets: [{
                            data:[10,20],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 0.8)',
                            ],
                            borderWidth: 1,
                        }],
                    },
                });
            // });
        });
    </script>
    @endsection
</body>
</html>

