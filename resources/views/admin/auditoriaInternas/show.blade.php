@extends('layouts.admin')
@section('content')

    <head>
        <meta charset="utf-8">
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

            .table-product p,
            .table-proveedor p {
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
    <style>
        span.errors {
            font-size: 11px;
        }

        canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }


        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(35px at 50% 50%);
            height: 70px;
        }

        .card-custom {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 10px;
            margin: auto;
            text-align: center;
            height: 100%;
            font-family: arial;
        }

        .title-custom {
            color: grey;
            font-size: 14px;
        }

        .circulo-rojo {
            width: 100px;
            height: 100px;
            -moz-border-radius: 20%;
            -webkit-border-radius: 20%;
            border-radius: 50%;
            background: #FF417B;
        }

        .circulo-naranja {
            width: 10px;
            height: 10px;
            -moz-border-radius: 10%;
            -webkit-border-radius: 10%;
            border-radius: 50%;
            background: #FFCB63;
        }

        @media print {
            header {
                display: none !important;
            }

            .ps__rail-y {
                display: none !important;
            }

            .ps__thumb-y {
                display: none !important;
            }

            .titulo_general_funcion {
                display: none !important;
            }

            #sidebar {
                display: none !important;
            }

            body {
                background-color: #fff !important;
            }

            #but {
                display: none !important;
            }

            .datos_der_cv {
                margin-right: -50px !important;


            }

            .table th td:nth-child(1) {
                min-width: 100px;
            }

            .print-none {
                display: none !important;
            }
        }
    </style>

    <div class="print-none">
        {{ Breadcrumbs::render('admin.auditoria-internas.create') }}
    </div>

    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    <a href="{{ route('admin.auditoria-internas.index') }}" class="btn_cancelar">Regresar</a>
                    <button class="btn btn-danger print-none" style="position: absolute; right:20px;"
                        onclick="javascript:window.print()">
                        <i class="fas fa-print"></i>
                        Imprimir
                    </button>

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
                                    <img style="width:100%; max-width:150px;"
                                        src="{{ public_path('razon_social/' . $logotipo) }}">
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
                                <p>INFORME DE AUDITORIA</p>
                                <p>ID AUDITORÍA: {{ $auditoriaInterna->id_auditoria }}</p>
                                <p>Fecha
                                    inicio:{{ \Carbon\Carbon::parse($auditoriaInterna->fecha_inicio)->format('d-m-Y') }}</p>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td class="parametro">
                                <p>Nombre de la auditoria</p><br>
                                <p>{{ $auditoriaInterna->nombre_auditoria }}</p><br>
                                <p>Área:</p><br>
                                <p>{{ $auditoriaInterna->lider->area->area }}</p>
                            </td>
                            <td class="parametro">
                                <p>Equipo Auditoria:</p>
                                @foreach ($auditoriaInterna->equipo as $equipo)
                                    <p>{{ $equipo->name }}</p>
                                @endforeach
                                {{-- <p>{{ $minutasaltadireccion->hora_termino }}</p> --}}
                            </td>

                            <td class="parametro">
                                <p>Nombre Auditor externo</p>
                                <p>{{ $auditoriaInterna->auditor_externo }}</p>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="parametro">
                                <p>Objetivo de la auditoría</p><br>
                                <p>{!! $auditoriaInterna->objetivo !!}</p><br>
                                <p>Alcance de la auditoría</p><br>
                                <p>{!! $auditoriaInterna->alcance !!}</p><br>
                            </td>
                        </tr>
                    </table>
                    @foreach ($auditoriaInterna->reportes as $reporte)
                        <table>
                            <thead>
                                <tr>
                                    <td>{{ $reporte->empleado->name }}</td>
                                </tr>
                            </thead>
                        </table>
                    @endforeach



                    <table class="table">
                        <thead class="head-light">
                            <tr>
                                <th scope="col-6">Incumplimiento</th>
                                <th scope="col-6">Descripción</th>
                                <th scope="col-6">Clasificación</th>
                                <th scope="col-6">Proceso relacionado</th>
                                <th scope="col-6">Área relacionada</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($auditoriaInterna->auditoriaHallazgos as $hallazgo)
                                <tr>
                                    <td style="min-width:130px;">
                                        {{ $hallazgo->incumplimiento_requisito ? $hallazgo->incumplimiento_requisito : 'Sin registro' }}
                                    </td>
                                    <td style="min-width:100px;">
                                        {{ $hallazgo->descripcion ? $hallazgo->descripcion : 'Sin registro' }}</td>
                                    <td style="min-width:100px;">
                                        {{ $hallazgo->clasificacion_hallazgo ? $hallazgo->clasificacion_hallazgo : 'Sin registro' }}
                                    </td>
                                    <td style="min-width:100px;">
                                        {{ $hallazgo->procesos ? $hallazgo->procesos->nombre : 'n/a' }}</td>
                                    <td style="min-width:100px;">{{ $hallazgo->areas ? $hallazgo->areas->area : 'n/a' }}
                                    </td>

                                </tr>
                            @empty
                                <p>Sin registro</p>
                            @endforelse


                        </tbody>
                    </table>






                </div>

            </div>
        </div>

    </div>
@endsection
