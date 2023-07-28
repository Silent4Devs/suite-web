<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!--DOMPDF Funciona con Bootstrap 3.3.6-->
    <style>
        .thead-dark {
            background-color: #343A40;
            color: white;
        }

        .bg-info {
            background: #3490DC;
            color: white;
        }


    </style>
</head>

<body>
    <div class="m-0 container-fluid row justify-content-center">
        <table class="table table-bordered" style="font-size: 12px;">
            <tr>
                <td class="text-center" style="vertical-align: middle"><img src="{{ asset($logotipo) }}" alt=""
                        width="128px">
                </td>
                <td class="text-center font-weight-bold"
                    style="vertical-align: middle;font-size: 1.2rem; font-weight: normal">
                    <span style="font-weight: normal">Ficha de:</span> <br>
                    <span style="font-weight: bold">Declaración de Aplicabilidad (SoA)</span>
                </td>
                <td class="text-center font-weight-bold" style="vertical-align: middle;font-size: 1.2rem;">
                    {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                </td>
            </tr>
        </table>
        <div class="col-12" id="d-aplicabilidad">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <table class="table" style="font-size: 12px;">
                                <thead class="text-center thead-dark">
                                    <tr>
                                        <th>INDICE</th>
                                        <th colspan="2">CONTROL</th>
                                        <th>CLASIFICACIÓN</th>
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="negras">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="6">A.5
                                            Políticas de Seguridad de Información</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="6">
                                            A.5.1 Directivas de la gestión para seguridad de la
                                            información</td>
                                    </tr>
                                    @foreach ($gapa5 as $g5s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g5s->gapdos->control_iso }}
                                            </th>
                                            <td>
                                                {{ $g5s->gapdos->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g5s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td>
                                                {{ $g5s->gapdos->clasificacion['nombre'] }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g5s->responsables2022['aplica'] != null ? ($g5s->responsables2022['aplica'] == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g5s->responsables2022->justificacion != null ? $g5s->responsables2022->justificacion : 'Sin capturar' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th>INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th>CLASIFICACIÓN</th>
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="6">A.6
                                            Organización de la seguridad de la información</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="6">
                                            A.6.1 organización interna</td>
                                    </tr>

                                    @foreach ($gapa6 as $g6s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g6s->gapdos->control_iso }}
                                            </th>
                                            <td>
                                                {{ $g6s->gapdos->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g6s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td>
                                                {{ $g6s->gapdos->clasificacion['nombre'] }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g6s->responsables2022['aplica'] != null ? ($g6s->responsables2022['aplica'] == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g6s->responsables2022->justificacion != null ? $g6s->responsables2022->justificacion : 'Sin capturar' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12">
                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th>INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th>CLASIFICACIÓN</th>
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="6">A.7
                                            seguridad de los recursos humanos</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="6">
                                            A.7.1 Antes de empleo</td>
                                    </tr>


                                    @foreach ($gapa7 as $g7s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g7s->gapdos->control_iso }}
                                            </th>
                                            <td>
                                                {{ $g7s->gapdos->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g7s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td>
                                                {{ $g7s->gapdos->clasificacion['nombre'] }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g7s->responsables2022['aplica'] != null ? ($g7s->responsables2022['aplica'] == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g7s->responsables2022->justificacion != null ? $g7s->responsables2022->justificacion : 'Sin capturar' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12">

                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th>INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th>CLASIFICACIÓN</th>
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="6">A.8
                                            Administración de activos</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="6">
                                            A.8.1 Responsabilidad sobre los activos</td>
                                    </tr>

                                    @foreach ($gapa8 as $g8s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g8s->gapdos->control_iso }}
                                            </th>
                                            <td>
                                                {{ $g8s->gapdos->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g8s->gapdos->anexo_descripcion }}
                                            </td>
                                            <td>
                                                {{ $g8s->gapdos->clasificacion['nombre'] }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g8s->responsables2022['aplica'] != null ? ($g8s->responsables2022['aplica'] == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g8s->responsables2022->justificacion != null ? $g8s->responsables2022->justificacion : 'Sin capturar' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
