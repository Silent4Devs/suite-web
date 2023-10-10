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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="negras">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="5">A.5
                                            Políticas de Seguridad de Información</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.5.1 Directivas de la gestión para seguridad de la
                                            información</td>
                                    </tr>
                                    @foreach ($gapda5s as $g5s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g5s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g5s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g5s->anexo_descripcion }}
                                            </td>

                                            <td class="text-left">
                                                {{ $g5s->aplica != null ? ($g5s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g5s->justificacion != null ? $g5s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="5">A.6
                                            Organización de la seguridad de la información</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.6.1 organización interna</td>
                                    </tr>

                                    @foreach ($gapda6s as $g6s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g6s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g6s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g6s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g6s->aplica != null ? ($g6s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g6s->justificacion != null ? $g6s->justificacion : 'Sin capturar' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class="table" style="font-size: 12px;">
                            <thead class="thead-dark" align="center">
                                <tr>
                                    <th>INDICE</th>
                                    <th COLSPAN="2">CONTROL</th>
                                    <th>APLICA</th>
                                    <th>JUSTIFICACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gapda62s as $g62s)
                                    <tr>
                                        <th scope="row">
                                            {{ $g62s->anexo_indice }}
                                        </th>
                                        <td>
                                            {{ $g62s->anexo_politica }}
                                        </td>
                                        <td>
                                            {{ $g62s->anexo_descripcion }}
                                        </td>
                                        <td class="text-left">
                                            {{ $g62s->aplica != null ? ($g62s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                        </td>
                                        <td class="text-justify">
                                            {{ $g62s->justificacion != null ? $g62s->justificacion : 'Sin capturar' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="col-12">
                            <table class="table" style="font-size: 12px;">
                                <thead class="thead-dark" align="center">
                                    <tr>
                                        <th>INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">A.7
                                            seguridad de los recursos humanos</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.7.1 Antes de empleo</td>
                                    </tr>


                                    @foreach ($gapda71s as $g71s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g71s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g71s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g71s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g71s->aplica != null ? ($g71s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g71s->justificacion != null ? $g71s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">A
                                            7.2 Durante el empleo</td>
                                    </tr>
                                    @foreach ($gapda72s as $g72s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g72s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g72s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g72s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g72s->aplica != null ? ($g72s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g72s->justificacion != null ? $g72s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.7.3 Cese al empleo o cambio de puesto de trabajo</td>
                                    </tr>
                                    @foreach ($gapda73s as $g73s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g73s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g73s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g73s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g73s->aplica != null ? ($g73s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g73s->justificacion != null ? $g73s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="negras">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">A.8
                                            Administración de activos</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.8.1 Responsabilidad sobre los activos</td>
                                    </tr>

                                    @foreach ($gapda81s as $g81s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g81s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g81s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g81s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g81s->aplica != null ? ($g81s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g81s->justificacion != null ? $g81s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.8.2 Clasificación de la información</td>
                                    </tr>
                                    <tr class="grises">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            Objetivo de control: Asegurar que la información reciba
                                            un
                                            nivel adecuado de protección, de acuerdo con su importancia para la
                                            organización.</td>
                                    </tr>
                                    @foreach ($gapda82s as $g82s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g82s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g82s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g82s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g82s->aplica != null ? ($g82s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g82s->justificacion != null ? $g82s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.8.3 Manipulación de los soportes</td>
                                    </tr>
                                    @foreach ($gapda83s as $g83s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g83s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g83s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g83s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g83s->aplica != null ? ($g83s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g83s->justificacion != null ? $g83s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" class="negras">
                                        <td colspan="5">A.9 Control de acceso</td>
                                    </tr>
                                    <tr class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" class="verdes">
                                        <td colspan="5">A.9.1 Requisitos del negocio para control de acceso</td>
                                    </tr>
                                    @foreach ($gapda91s as $g91s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g91s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g91s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g91s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g91s->aplica != null ? ($g91s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g91s->justificacion != null ? $g91s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.9.2 Gestión de accesos de usuario</td>
                                    </tr>
                                    @foreach ($gapda92s as $g92s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g92s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g92s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g92s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g92s->aplica != null ? ($g92s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g92s->justificacion != null ? $g92s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.9.3 Responsabilidades del usuario</td>
                                    </tr>

                                    @foreach ($gapda93s as $g93s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g93s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g93s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g93s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g93s->aplica != null ? ($g93s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g93s->justificacion != null ? $g93s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.9.4 Control de acceso a sistema y aplicaciones</td>
                                    </tr>
                                    @foreach ($gapda94s as $g94s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g94s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g94s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g94s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g94s->aplica != null ? ($g94s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g94s->justificacion != null ? $g94s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.10 Criptografía</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.10.1 Controles Criptografícos </td>
                                    </tr>
                                    @foreach ($gapda101s as $g101s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g101s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g101s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g101s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g101s->aplica != null ? ($g101s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g101s->justificacion != null ? $g101s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.11 Seguridad Física y del Entorno</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.11.1 Áreas seguras </td>
                                    </tr>
                                    @foreach ($gapda111s as $g111s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g111s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g111s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g111s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g111s->aplica != null ? ($g111s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g111s->justificacion != null ? $g111s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.11.2 Seguridad de los Equipos</td>
                                    </tr>

                                    @foreach ($gapda112s as $g112s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g112s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g112s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g112s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g112s->aplica != null ? ($g112s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g112s->justificacion != null ? $g112s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12 Seguridad de las Operaciones</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12.1 Procedimientos y Responsbilidades Operacionales
                                        </td>
                                    </tr>
                                    @foreach ($gapda121s as $g121s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g121s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g121s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g121s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g121s->aplica != null ? ($g121s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g121s->justificacion != null ? $g121s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12.2 Protección contra el software malicioso</td>
                                    </tr>
                                    @foreach ($gapda122s as $g122s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g122s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g122s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g122s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g122s->aplica != null ? ($g122s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g122s->justificacion != null ? $g122s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12.3 Copias de Seguridad</td>
                                    </tr>
                                    @foreach ($gapda123s as $g123s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g123s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g123s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g123s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g123s->aplica != null ? ($g123s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g123s->justificacion != null ? $g123s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12.4 Registro y Supervisión </td>
                                    </tr>
                                    @foreach ($gapda124s as $g124s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g124s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g124s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g124s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g124s->aplica != null ? ($g124s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g124s->justificacion != null ? $g124s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12.5 Control de Software y Explotación </td>
                                    </tr>
                                    @foreach ($gapda125s as $g125s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g125s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g125s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g125s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g125s->aplica != null ? ($g125s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g125s->justificacion != null ? $g125s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12.6 Gestión de la Vulnerabilidad Técnica </td>
                                    </tr>
                                    @foreach ($gapda126s as $g126s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g126s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g126s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g126s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g126s->aplica != null ? ($g126s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g126s->justificacion != null ? $g126s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.12.7 Consideraciones sobre la auditoria de sistemas de
                                            información</td>
                                    </tr>
                                    @foreach ($gapda127s as $g127s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g127s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g127s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g127s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g127s->aplica != null ? ($g127s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g127s->justificacion != null ? $g127s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.13 Seguridad de las comunicaciones</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.13.1 Gestión de la seguridad de redes</td>
                                    </tr>
                                    @foreach ($gapda131s as $g131s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g131s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g131s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g131s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g131s->aplica != null ? ($g131s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g131s->justificacion != null ? $g131s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.13.2 Intercambio de información</td>
                                    </tr>
                                    @foreach ($gapda132s as $g132s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g132s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g132s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g132s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g132s->aplica != null ? ($g132s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g132s->justificacion != null ? $g132s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.14 Adquisición, desarrollo y mantenimiento de los
                                            sistemas
                                            de información</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.14.1 Requisitos de seguridad en sistemas de
                                            información
                                        </td>
                                    </tr>
                                    @foreach ($gapda141s as $g141s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g141s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g141s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g141s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g141s->aplica != null ? ($g141s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g141s->justificacion != null ? $g141s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.14.2 Seguridad en el desarrollo y en los procesos de
                                            soporte</td>
                                    </tr>

                                    @foreach ($gapda142s as $g142s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g142s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g142s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g142s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g142s->aplica != null ? ($g142s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g142s->justificacion != null ? $g142s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.14.3 Datos de prueba</td>
                                    </tr>
                                    @foreach ($gapda143s as $g143s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g143s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g143s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g143s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g143s->aplica != null ? ($g143s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g143s->justificacion != null ? $g143s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.15 Relación con los proveedores</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.15.1 Requisitos de seguridad en sistemas de
                                            información
                                        </td>
                                    </tr>
                                    @foreach ($gapda151s as $g151s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g151s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g151s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g151s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g151s->aplica != null ? ($g151s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g151s->justificacion != null ? $g151s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.15.2 Gestión de la provisión de servicios del
                                            proveedor
                                        </td>
                                    </tr>
                                    @foreach ($gapda152s as $g152s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g152s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g152s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g152s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g152s->aplica != null ? ($g152s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g152s->justificacion != null ? $g152s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.16 Gestión de incidentes de Seguridad de la
                                            Información
                                        </td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.16.1 Gestión de incidentes de Seguridad de la
                                            Información
                                            y mejoras</td>
                                    </tr>
                                    @foreach ($gapda161s as $g161s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g161s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g161s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g161s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g161s->aplica != null ? ($g161s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g161s->justificacion != null ? $g161s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.17 Aspectos de seguridad de la información para la
                                            gestión
                                            de la continuidad del Instituto</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.17.1 Continuidad de la Seguridad de la Información
                                        </td>
                                    </tr>
                                    @foreach ($gapda171s as $g171s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g171s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g171s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g171s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g171s->aplica != null ? ($g171s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g171s->justificacion != null ? $g171s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.17.2 Redundancias</td>
                                    </tr>

                                    @foreach ($gapda172s as $g172s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g172s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g172s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g172s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g172s->aplica != null ? ($g172s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g172s->justificacion != null ? $g172s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.18 Cumplimiento</td>
                                    </tr>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.18.1 Cumplimiento de los requisitos legales y
                                            contractuales</td>
                                    </tr>
                                    @foreach ($gapda181s as $g181s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g181s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g181s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g181s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g181s->aplica != null ? ($g181s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g181s->justificacion != null ? $g181s->justificacion : 'Sin capturar' }}
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
                                        <th>APLICA</th>
                                        <th>JUSTIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="verdes">
                                        <td class="p-2 mb-2 text-white bg-info" style="font-size: 12px;" colspan="5">
                                            A.18.2 Revisiones de la Seguridad de la Información</td>
                                    </tr>
                                    @foreach ($gapda182s as $g182s)
                                        <tr>
                                            <th scope="row">
                                                {{ $g182s->anexo_indice }}
                                            </th>
                                            <td>
                                                {{ $g182s->anexo_politica }}
                                            </td>
                                            <td>
                                                {{ $g182s->anexo_descripcion }}
                                            </td>
                                            <td class="text-left">
                                                {{ $g182s->aplica != null ? ($g182s->aplica == 1 ? 'Sí' : 'No') : 'Sin capturar' }}
                                            </td>
                                            <td class="text-justify">
                                                {{ $g182s->justificacion != null ? $g182s->justificacion : 'Sin capturar' }}
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
