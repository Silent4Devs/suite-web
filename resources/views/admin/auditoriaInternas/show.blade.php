@extends('layouts.admin')
@section('content')
    @include('layouts.datatables_css')
    <link rel="stylesheet" href="{{ asset('css/requisiciones.css') }}">

    <head>
        <meta charset="utf-8">
        <style>
            /* body {
                                                                    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                                                                    text-align: justify;
                                                                    font-size: 12px;
                                                                    color: #6c6c6c;
                                                                } */

            table td {
                border: none;
            }

            table {
                border: none;
                width: 100%;
                max-width: 100%;
                border-spacing: 0px;
                margin: 0px;
                overflow-wrap: break-word !important;
                table-layout: fixed !important;


            }

            table td {
                border: none;
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
                background: #CDCDCD 0% 0% no-repeat padding-box;
                /* border: 1px solid #707070; */
                */ opacity: 1;
                text-align: left;
                font: normal normal medium 16px/19px Roboto;
                letter-spacing: 0px;
                color: #414141;
                opacity: 1;
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

            table.objalc {
                background: #F2F2F2 0% 0% no-repeat padding-box;
                opacity: 1;
            }

            table.general {
                background: #DDDDDD 0% 0% no-repeat padding-box;
                opacity: 1;
            }

            p {
                text-align: left;
                font: normal normal normal 12px/14px Roboto;
                letter-spacing: 0px;
                color: #464646;
                opacity: 1;
            }

            p.parametro {
                text-align: left;
                font: normal normal medium 12px/14px Roboto;
                letter-spacing: 0px;
                color: #414141;
                opacity: 1;
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
                text-align: left;
                font: normal normal normal 15px/20px Roboto;
                letter-spacing: 0px;
                color: #3D3D3D;
                opacity: 1;
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

    <div class="print-none">
        {{ Breadcrumbs::render('admin.auditoria-internas.create') }}
    </div>

    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('admin.auditoria-internas.index') }}" class="btn btn_cancelar">Regresar</a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <form method="POST"
                                action="{{ route('admin.auditoria-internas.pdf', ['id' => $auditoriaInterna->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-print"></i>&nbsp;&nbsp;Imprimir
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-3 mb-3">
                        <br>
                    </div>
                    {{-- <button class="btn btn-danger print-none" style="position: absolute; right:20px;"
                        onclick="javascript:window.print()">
                        <i class="fas fa-print"></i>
                        Imprimir
                    </button> --}}

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
                                                <img style="width:100%; max-width:150px;"
                                                    src="{{ public_path('razon_social/' . $logotipo) }}">
                                            @else
                                                <img src="{{ public_path('sinLogo.png') }}"
                                                    style="width:100%; max-width:150px;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="info-header">
                                            {{ $organizacion->empresa ?? '' }} <br>
                                            {{ $organizacion->rfc ?? '' }} <br>
                                            {{ $organizacion->direccion ?? '' }} <br>
                                        </div>
                                    </div>
                                    <div class="col-4" style="text-align: right;">
                                        <p
                                            style="text-align: left;
font: normal normal medium 18px/13px Roboto;
letter-spacing: 0px;
color: #606060;
opacity: 1;">
                                            INFORME DE AUDITORIA</p>
                                        <p
                                            style="text-align: left;
font: normal normal medium 16px/20px Roboto;
letter-spacing: 0px;
color: #606060;
text-transform: uppercase;
opacity: 1;">
                                            ID AUDITORÍA: {{ $auditoriaInterna->id_auditoria ?? '' }}</p>
                                        <p
                                            style="text-align: left;
font: normal normal medium 14px/20px Roboto;
letter-spacing: 0px;
color: #606060;
text-transform: uppercase;
opacity: 1;">
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
                                        <p>{{ $auditoriaInterna->nombre_auditoria ?? '' }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p><strong>Equipo Auditoria:</strong></p><br>
                                        <div class="row">
                                            @foreach ($auditoriaInterna->equipo as $equipo)
                                                <div class="col-4">
                                                    <p>{{ $equipo->name ?? '' }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <p><strong>Nombre Auditor externo</strong></p>
                                        <p>{{ $auditoriaInterna->auditor_externo ?? '' }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <p><strong>Área:</strong></p>
                                        <p>{{ $auditoriaInterna->lider->area->area ?? '' }}</p>
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
                                    <td style="text-align: left;" colspan="2">
                                        <p style="font: normal medium 16px/19px;"><strong>
                                                Hallazgos del
                                                equipo: {{ $reporte->empleado->name ?? '' }}</strong></p>
                                    </td>
                                    <td style="text-align: right;">
                                        <p style="font: normal medium 16px/19px;"> <strong>Área Relacionada:
                                                {{ $reporte->empleado->area->area ?? '' }}</strong></p>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reporte->hallazgos as $hallazgos)
                                    <tr>
                                        <td colspan="3">
                                            <div style="padding: 10px;">
                                                <div class="row">
                                                    <div class="col-3" style="margin-bottom: 10px;">
                                                        <p><strong>Clausula</strong></p>
                                                        <p>{{ $hallazgos->clausula->nombre_clausulas ?? '' }}</p>
                                                    </div>
                                                    <div class="col-5" style="margin-bottom: 10px;">
                                                        <p><strong>Subtema y Titulo</strong></p>
                                                        <p>{{ $hallazgos->no_tipo ?? '' }} &nbsp;
                                                            {{ $hallazgos->titulo ?? '' }}</p>
                                                    </div>
                                                    <div class="col-4" style="margin-bottom: 10px;">
                                                        <p><strong>Requisito</strong></p>
                                                        <p>{{ $hallazgos->incumplimiento_requisito ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5" style="margin-bottom: 10px;">
                                                        <p><strong>Descripción:</strong></p>
                                                        <p>{{ $hallazgos->descripcion ?? '' }}</p>
                                                    </div>
                                                    <div class="col-4" style="margin-bottom: 10px;">
                                                        <p><strong>Proceso Relacionado:</strong></p>
                                                        <p>{{ $hallazgos->procesos->nombre ?? '' }}</p>
                                                    </div>
                                                    <div class="col-3" style="margin-bottom: 10px;">
                                                        <p><strong>Clasificación:</strong></p>
                                                        <p>{{ $hallazgos->clasificacion->nombre_clasificaciones ?? '' }}
                                                        </p>
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
