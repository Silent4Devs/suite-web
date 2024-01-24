<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <style>
        body {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            text-align: justify;
            font-size: 12px;
            color: #6c6c6c;
        }

        table td {
            border: 1px solid black;
        }

        table {
            border: 1px solid #a8a8a8;
            width: 100%;
            max-width: 100%;
            border-spacing: 0px;
            margin: 0px;
            overflow-wrap: break-word !important;
            table-layout: fixed !important;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        table td {
            border: 1px solid #a8a8a8;
            padding: 10px 25px;
            vertical-align: super;
            overflow-wrap: break-word !important;
            table-layout: fixed !important;
            color: black;
        }

        th.parametro {
            /* border: 1px solid #a8a8a8; */
            background-color: #EEF5FF !important;
            color: black !important;
        }

        td.parametro {
            border: 1px solid #a8a8a8;
            background-color: #EEF5FF;
        }

        table thead {
            background: #306BA9 0% 0% no-repeat padding-box;
            /* border: 1px solid #707070; */
            /* border-radius: 8px 8px 0px 0px; */
            opacity: 1;
            text-align: center;
            color: white;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0px;
            margin-bottom: 10px;
        }

        p {
            margin: 0px;
            margin-bottom: 5px;
        }

        hr {
            border: none;
            border-bottom: 1px solid #eaeaea;
        }

        .caja-general-doc {
            width: 100%;
        }

        .encabezado {
            border-left: 10px solid #2395AA !important;
            border-right: 0px solid black;
            border-top: 0px solid black;
            border-bottom: 0px solid black;
        }

        .encabezado td {
            padding-left: 20px;
            padding: 15px auto;
            vertical-align: middle;
            border: 0px solid black;
        }

        .td-img-doc {
            width: 80px !important;
            max-width: 80px !important;
            min-width: 80px !important;
        }

        .td-img-doc img {
            width: 100%;
        }

        .info-header {
            font-size: 13px;
        }

        .td-blue-header {
            background-color: #EEFCFF;
            color: #2395AA;
            font-size: 13px;
        }

        .table-tada-requi {
            background-color: #EEF5FF;
            border-right: 20px solid #295082;
        }

        .title-product {
            font-size: 13px;
            padding: 15px 20px;
            background-color: #EEFCFF;
        }

        .table-product strong,
        .table-proveedor strong {
            color: #3086AF;
        }

        .caja-proveedor {
            background-color: #eee;
        }

        .caja-proveedor:nth-child(even) {
            background-color: #fff;
        }

        .title-proveedor {
            font-size: 13px;
            padding: 15px 20px;
            border-left: 10px solid #2395AA;
            background-color: #D9D9D9;
            font-weight: lighter;
            margin: 0px;
        }

        .caja-firmas {
            margin-top: 70px;
        }

        .img-firma {
            height: 170px;
        }

        .caja-firmas {
            color: #747474;
        }

        .table-totales {
            max-width: 300px !important;
            width: 300px !important;
            background-color: #EEFCFF;
            margin-left: 405px;
        }

        .table-totales td {
            text-align: right;
        }

        .table-politicas {
            /* page-break-before: always; */
            font-size: 14px;
            text-align: justify;
        }

        .table-politicas p {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::getFirst();
        $logotipo = $organizacion->logotipo;
        $empresa = $organizacion->empresa;
    @endphp

    <table class="encabezado">
        <tr>
            <td class="td-img-doc">
                @if ($logotipo)
                    <img style="width:100%; max-width:150px;" src="{{ public_path('razon_social/' . $logotipo) }}">
                @else
                    <img src="{{ public_path('sinLogo.png') }}" style="width:100%; max-width:150px;">
                @endif
            </td>
            <td class="info-header">
                {{ $organizacion->empresa }} <br>
                {{ $organizacion->rfc }} <br>
                {{ $organizacion->direccion }} <br>
            </td>
            <td class="td-blue-header">
                <h5 style="color:#49598A;">Elaboró:</h5>
                <strong>{{ $minutasaltadireccion->responsable->name }}</strong>
            </td>
        </tr>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th colspan="6">Minuta Reunión</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="parametro">
                    <strong>Fecha:</strong>
                </td>
                <td>
                    <strong>{{ $minutasaltadireccion->fechareunion }}</strong>
                </td>
                <td class="parametro">
                    <strong>Hora inicio:</strong>
                </td>
                <td>
                    <strong>{{ $minutasaltadireccion->hora_inicio }}</strong>
                </td>
                <td class="parametro">
                    <strong>Hora Fin:</strong>
                </td>
                <td>
                    <strong>{{ $minutasaltadireccion->hora_termino }}</strong>
                </td>
            </tr>
            <tr>
                <td class="parametro">
                    <strong>Tema:</strong>
                </td>
                <td colspan="2">
                    <strong>{{ $minutasaltadireccion->tema_reunion }}</strong>
                </td>
                <td class="parametro">
                    <strong>Objetivo:</strong>
                </td>
                <td colspan="2">
                    <strong>{{ $minutasaltadireccion->objetivoreunion }}</strong>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th colspan="3">
                    Participantes
                </th>
            </tr>
            <tr>
                <th class="parametro">Nombre/Apellidos</th>
                <th class="parametro">Puesto/Area</th>
                <th class="parametro" style="max-width: 65px;">Asistencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participantesWithAsistencia as $participante)
                <tr>
                    <td>{{ $participante->name }}</td>
                    <td>{{ $participante->puestoRelacionado->puesto }}/{{ $participante->area->area }}
                    </td>
                    <td>{{ $participante->pivot->asistencia ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th colspan="3">
                    Participantes externos.
                </th>
            </tr>
            <tr>
                <th class="parametro">Nombre/Apellidos</th>
                <th class="parametro">Puesto/Área</th>
                <th class="parametro" style="max-width: 100px;">Asistencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($minutasaltadireccion->externos as $externo)
                <tr>
                    <td>{{ $externo->nombreEXT }}</td>
                    <td>{{ $externo->puestoEXT }}</td>
                    <td>{{ $externo->asistenciaEXT ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th>Temas Tratados</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! htmlspecialchars_decode($minutas->tema_tratado) !!}
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th colspan="5">Acuerdos y Compromisos</th>
            </tr>
            <tr>
                <th class="parametro" scope="col">Actividad</th>
                <th class="parametro" scope="col">Responsable(s)</th>
                <th class="parametro" scope="col">Fecha Compromiso</th>
                <th class="parametro" scope="col">Estatus</th>
                <th class="parametro" scope="col">Comentarios</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($actividades))
                @foreach ($actividades as $actividad)
                    @php
                        $estatus = 'Completado';
                        $color = 'rgb(0,200,117)';
                        $textColor = 'white';
                        switch ($actividad->status) {
                            case 'STATUS_ACTIVE':
                                $estatus = 'En Progreso';
                                $color = 'rgb(253, 171, 61)';
                                break;
                            case 'STATUS_DONE':
                                $color = 'rgb(0, 200, 117)';
                                $estatus = 'Completado';
                                break;
                            case 'STATUS_FAILED':
                                $estatus = 'Con Retraso';
                                $color = 'rgb(226, 68, 92)';
                                break;
                            case 'STATUS_SUSPENDED':
                                $estatus = 'Suspendido';
                                $color = '#aaaaaa';
                                break;
                            case 'STATUS_WAITING':
                                $estatus = 'En Espera';
                                $color = '#F79136';

                                break;
                            case 'STATUS_UNDEFINED':
                                $estatus = 'Indefinido';
                                $color = '#00b1e1';
                                break;
                            default:
                                $estatus = 'Indefinido';
                                break;
                        }
                    @endphp
                    <tr>
                        <td>{{ $actividad->name }}</td>
                        <td>
                            <ul>
                                @foreach ($actividad->assigs as $assig)
                                    @php
                                        $empleado = App\Models\Empleado::getAll()->find(intval($assig->resourceId));
                                    @endphp
                                    {{-- <img src="{{ $empleado->avatar_ruta }}" id="res_{{ $empleado->id }}"
                                                    alt="{{ $empleado->name }}" title="{{ $empleado->name }}"
                                                    style="clip-path: circle(15px at 50% 50%);width: 45px;" />
                                                     --}}

                                    <li>{{ $empleado->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp(intval($actividad->end) / 1000)->toDateTimeString())->format('Y-m-d') }}
                        </td>
                        <td style="background: {{ $color }}; color:{{ $textColor }}">
                            {{ $estatus }}
                        </td>
                        <td>{{ $actividad->description }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

</body>

</html>
