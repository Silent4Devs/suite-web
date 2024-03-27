<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Auditoria Interna</title>
    <link rel="stylesheet" href="css/requisiciones_pdf.css{{config('app.cssVersion')}}">
</head>

<body>

    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::getFirst();
        $logotipo = $organizacion->logotipo;
        $empresa = $organizacion->empresa;
    @endphp
    <div class="caja-general-doc">

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
                    <h5>INFORME DE AUDITORIA</h5>
                    ID AUDITORÍA: {{ $auditoriaInterna->id_auditoria ?? '' }} <br>
                    Fecha
                    inicio:{{ \Carbon\Carbon::parse($auditoriaInterna->fecha_inicio)->format('d-m-Y') ?? '' }}
                </td>
            </tr>
        </table>

        <table class="general" style="background: #DDDDDD 0% 0% no-repeat padding-box;
        opacity: 1;">
            <tr>
                <td style="min-width: 25%;">
                    <p><strong>Nombre de la auditoria:</strong></p>
                    <p>{{ $auditoriaInterna->nombre_auditoria ?? '' }}</p>
                </td>
                <td style="min-width: 50%;">
                    <p><strong>Equipo Auditoria:</strong></p>
                    <div class="row">
                        @foreach ($auditoriaInterna->equipo as $equipo)
                            <div class="col-4">
                                <p>{{ $equipo->name ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td style="min-width: 25%;">
                    <p><strong>Nombre Auditor externo</strong></p>
                    <p>{{ $auditoriaInterna->auditor_externo ?? '' }}</p>
                </td>
            </tr>
            <tr>
                <td style="min-width: 25%;">
                    <p><strong>Área:</strong></p>
                    <p>{{ $auditoriaInterna->lider->area->area ?? '' }}</p>
                </td>
            </tr>
        </table>


        <table class="objalc" style="background: #F2F2F2 0% 0% no-repeat padding-box;
        opacity: 1;">
            <tr>
                <td>
                    <br>
                    <p><strong>Objetivo de la auditoría:</strong></p>
                    <p>{!! $auditoriaInterna->objetivo !!}</p><br>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong>Alcance de la auditoría:</strong></p>
                    <p>{!! $auditoriaInterna->alcance !!}</p>
                </td>
            </tr>
        </table>
        @foreach ($auditoriaInterna->reportes as $reporte)
            <table>
                <thead
                    style="background: #CDCDCD 0% 0% no-repeat padding-box;
                text-align: left;
                letter-spacing: 0px;
                color: #414141;
                opacity: 1;">
                    <tr>
                        <td style="text-align: left;" colspan="2">
                            <p><strong>
                                    Hallazgos del
                                    equipo: {{ $reporte->empleado->name ?? '' }}</strong></p>
                        </td>
                        <td style="text-align: right;">
                            <p> <strong>Área Relacionada:
                                    {{ $reporte->empleado->area->area ?? '' }}</strong></p>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reporte->hallazgos as $hallazgos)
                        <tr>
                            <td style="min-width: 25%;">
                                <p><strong>Clausula</strong></p>
                                <p>{{ $hallazgos->clausula->nombre_clausulas ?? '' }}</p>
                            </td>
                            <td style="min-width: 50%;">
                                <p><strong>Subtema y Titulo</strong></p>
                                <p>{{ $hallazgos->no_tipo ?? '' }} &nbsp;
                                    {{ $hallazgos->titulo ?? '' }}</p>
                            </td>
                            <td style="min-width: 25%;">
                                <p><strong>Requisito</strong></p>
                                <p>{{ $hallazgos->incumplimiento_requisito ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 50%;">
                                <p><strong>Descripción:</strong></p>
                                <p>{{ $hallazgos->descripcion ?? '' }}</p>
                            </td>
                            <td style="min-width: 30%;">
                                <p><strong>Proceso Relacionado:</strong></p>
                                <p>{{ $hallazgos->procesos->nombre ?? '' }}</p>
                            </td>
                            <td style="min-width: 20%;">
                                <p><strong>Clasificación:</strong></p>
                                <p>{{ $hallazgos->clasificacion->nombre_clasificaciones ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 100%;">
                                <p><strong>Criterio de auditoría:</strong></p>
                                <p>{!! $auditoriaInterna->criterios_auditoria !!}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

    </div>

</body>

</html>
