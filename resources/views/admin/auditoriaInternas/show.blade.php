@extends('layouts.admin')
@section('content')
    @include('layouts.datatables_css')
    <link rel="stylesheet" href="{{ asset('css/requisiciones.css') }}">

    <head>
        <meta charset="utf-8">
        <style>
            body {
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif !important;
                text-align: justify !important;
                font-size: 12px !important;
                color: #6c6c6c !important;
            }

            table td {
                border: none !important;
            }

            table {
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
                border-spacing: 0px !important;
                margin: 0px !important;
                overflow-wrap: break-word !important !important;
                table-layout: fixed !important !important;


            }

            table td {
                border: none !important;
                padding: 10px 25px !important;
                vertical-align: super !important;
                overflow-wrap: break-word !important !important;
                table-layout: fixed !important !important;
                color: black !important;
            }

            th.parametro {
                /* border: 1px solid #a8a8a8!important ; */
                background-color: #EEF5FF !important !important;
                color: black !important !important;
            }

            td.parametro {
                border: 1px solid #a8a8a8 !important;
                background-color: #EEF5FF !important;
            }

            table thead {
                background: #CDCDCD 0% 0% no-repeat padding-box !important;
                /* border: 1px solid #707070!important ; */
                */ opacity: 1 !important;
                text-align: left !important;
                font: normal normal medium 16px/19px Roboto !important;
                letter-spacing: 0px !important;
                color: #414141 !important;
                opacity: 1 !important;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                margin: 0px !important;
                margin-bottom: 10px !important;
            }

            table.objalc {
                background: #F2F2F2 0% 0% no-repeat padding-box !important;
                opacity: 1 !important;
            }

            table.general {
                background: #DDDDDD 0% 0% no-repeat padding-box !important;
                opacity: 1 !important;
            }

            p {
                text-align: left !important;
                font: normal normal normal 12px/14px Roboto !important;
                letter-spacing: 0px !important;
                color: #464646 !important;
                opacity: 1 !important;
            }

            p.parametro {
                text-align: left !important;
                font: normal normal medium 12px/14px Roboto !important;
                letter-spacing: 0px !important;
                color: #414141 !important;
                opacity: 1 !important;
            }

            hr {
                border: none !important;
                border-bottom: 1px solid #eaeaea !important;
            }

            .caja-general-doc {
                width: 100% !important;
            }

            .encabezado {
                border-left: 10px solid #2395AA !important !important;
                border-right: 0px solid black !important;
                border-top: 0px solid black !important;
                border-bottom: 0px solid black !important;
            }

            .encabezado td {
                padding-left: 20px !important;
                padding: 15px auto !important;
                vertical-align: middle !important;
                border: 0px solid black !important;
            }

            .td-img-doc {
                width: 80px !important !important;
                max-width: 80px !important !important;
                min-width: 80px !important !important;
            }

            .td-img-doc img {
                width: 100% !important;
            }

            .info-header {
                text-align: left !important;
                font: normal normal normal 15px/20px Roboto !important;
                letter-spacing: 0px !important;
                color: #3D3D3D !important;
                opacity: 1 !important;
            }

            .td-blue-header {
                background-color: #EEFCFF !important;
                color: #2395AA !important;
                font-size: 13px !important;
            }

            .table-tada-requi {
                background-color: #EEF5FF !important;
                border-right: 20px solid #295082 !important;
            }

            .title-product {
                font-size: 13px !important;
                padding: 15px 20px !important;
                background-color: #EEFCFF !important;
            }

            .table-product p,
            .table-proveedor p {
                color: #3086AF !important;
            }

            .caja-proveedor {
                background-color: #eee !important;
            }

            .caja-proveedor:nth-child(even) {
                background-color: #fff !important;
            }

            .title-proveedor {
                font-size: 13px !important;
                padding: 15px 20px !important;
                border-left: 10px solid #2395AA !important;
                background-color: #D9D9D9 !important;
                font-weight: lighter !important;
                margin: 0px !important;
            }

            .caja-firmas {
                margin-top: 70px !important;
            }

            .img-firma {
                height: 170px !important;
            }

            .caja-firmas {
                color: #747474 !important;
            }

            .table-totales {
                max-width: 300px !important !important;
                width: 300px !important !important;
                background-color: #EEFCFF !important;
                margin-left: 405px !important;
            }

            .table-totales td {
                text-align: right !important;
            }

            .table-politicas {
                /* page-break-before: always!important ; */
                font-size: 14px !important;
                text-align: justify !important;
            }

            .table-politicas p {
                margin-top: 20px !important;
            }
        </style>
    </head>

    <div class="print-none">
        {{ Breadcrumbs::render('admin.auditoria-internas.create') }}
    </div>

    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    <div class="print-none">
                        <a href="{{ route('admin.auditoria-internas.index') }}" class="btn_cancelar">Regresar</a>
                        <button class="btn btn-danger print-none"
                            style="position: absolute!important ; right:20px!important ;"
                            onclick="javascript:window.print()">
                            <i class="fas fa-print"></i>
                            Imprimir
                        </button>
                    </div>

                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::getFirst();
                        $logotipo = $organizacion->logotipo;
                        $empresa = $organizacion->empresa;
                    @endphp

                    <table class="encabezado">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="td-img-doc">
                                            @if ($logotipo)
                                                <img style="width:100%!important ; max-width:150px!important ;"
                                                    src="{{ public_path('razon_social/' . $logotipo) }}">
                                            @else
                                                <img src="{{ public_path('sinLogo.png') }}"
                                                    style="width:100%!important ; max-width:150px!important ;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="info-header">
                                            {{ $organizacion->empresa }} <br>
                                            {{ $organizacion->rfc }} <br>
                                            {{ $organizacion->direccion }} <br>
                                        </div>
                                    </div>
                                    <div class="col-4" style="text-align: right!important ;">
                                        <p
                                            style="text-align: left!important ;
font: normal normal medium 18px/13px Roboto!important ;
letter-spacing: 0px!important ;
color: #606060!important ;
opacity: 1!important ;">
                                            INFORME DE AUDITORIA</p>
                                        <p
                                            style="text-align: left!important ;
font: normal normal medium 16px/20px Roboto!important ;
letter-spacing: 0px!important ;
color: #606060!important ;
text-transform: uppercase!important ;
opacity: 1!important ;">
                                            ID AUDITORÍA: {{ $auditoriaInterna->id_auditoria }}</p>
                                        <p
                                            style="text-align: left!important ;
font: normal normal medium 14px/20px Roboto!important ;
letter-spacing: 0px!important ;
color: #606060!important ;
text-transform: uppercase!important ;
opacity: 1!important ;">
                                            Fecha
                                            inicio:{{ \Carbon\Carbon::parse($auditoriaInterna->fecha_inicio)->format('d-m-Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table class="general">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-3">
                                        <p><strong>Nombre de la auditoria:</strong></p>
                                        <p>{{ $auditoriaInterna->nombre_auditoria }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p><strong>Equipo Auditoria:</strong></p><br>
                                        <div class="row">
                                            @foreach ($auditoriaInterna->equipo as $equipo)
                                                <div class="col-4">
                                                    <p>{{ $equipo->name }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <p><strong>Nombre Auditor externo</strong></p>
                                        <p>{{ $auditoriaInterna->auditor_externo }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <p><strong>Área:</strong></p>
                                        <p>{{ $auditoriaInterna->lider->area->area }}</p>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    </table>
                    <table class="objalc">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-12">
                                        <br>
                                        <p><strong>Objetivo de la auditoría:</strong></p>
                                        <p>{!! $auditoriaInterna->objetivo !!}</p><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>Alcance de la auditoría:</strong></p>
                                        <p>{!! $auditoriaInterna->alcance !!}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    @foreach ($auditoriaInterna->reportes as $reporte)
                        <table class="table-striped">
                            <thead>
                                <tr>
                                    <td style="text-align: left!important ;" colspan="2">
                                        <p style="font: normal medium 16px/19px!important ;"><strong>
                                                Hallazgos del
                                                equipo: {{ $reporte->empleado->name }}</strong></p>
                                    </td>
                                    <td style="text-align: right!important ;">
                                        <p style="font: normal medium 16px/19px!important ;"> <strong>Área Relacionada:
                                                {{ $reporte->empleado->area->area }}</strong></p>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte->hallazgos as $hallazgos)
                                    <tr>
                                        <td colspan="3">
                                            <div style="padding: 10px!important ;">
                                                <div class="row">
                                                    <div class="col-3" style="margin-bottom: 10px!important ;">
                                                        <p><strong>Clausula</strong></p>
                                                        <p>{{ $hallazgos->clausula->nombre_clausulas }}</p>
                                                    </div>
                                                    <div class="col-5" style="margin-bottom: 10px!important ;">
                                                        <p><strong>Subtema y Titulo</strong></p>
                                                        <p>{{ $hallazgos->no_tipo }} &nbsp!important ;
                                                            {{ $hallazgos->titulo }}</p>
                                                    </div>
                                                    <div class="col-4" style="margin-bottom: 10px!important ;">
                                                        <p><strong>Requisito</strong></p>
                                                        <p>{{ $hallazgos->incumplimiento_requisito }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5" style="margin-bottom: 10px!important ;">
                                                        <p><strong>Descripción:</strong></p>
                                                        <p>{{ $hallazgos->descripcion }}</p>
                                                    </div>
                                                    <div class="col-4" style="margin-bottom: 10px!important ;">
                                                        <p><strong>Proceso Relacionado:</strong></p>
                                                        <p>{{ $hallazgos->procesos->nombre }}</p>
                                                    </div>
                                                    <div class="col-3" style="margin-bottom: 10px!important ;">
                                                        <p><strong>Clasificación:</strong></p>
                                                        <p>{{ $hallazgos->clasificacion->nombre_clasificaciones }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><strong>Criterio de auditoría:</strong></p>
                                                        <p>{!! $auditoriaInterna->criterios_auditoria !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                </div>

            </div>
        </div>

    </div>
@endsection
