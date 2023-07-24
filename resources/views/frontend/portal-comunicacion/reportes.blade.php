@extends('layouts.frontend')
@section('content')

@section('styles')
    <style type="text/css">
        .caja_titulo {
            position: relative;
            width: 100%;
            height: 150px;
        }

        .logo_organizacion_politica {
            height: 150px;
            position: absolute;
            right: 50px;
            bottom: 0;
        }

        .caja_titulo h1 {
            position: absolute;
            width: 300px;
            font-weight: bold;
            color: #345183;
            bottom: 0;
        }



        .cards_reportes {
            width: 250px;
            padding: 20px 0px;
            padding-left: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
            display: inline-block;
            margin: 10px;
            cursor: pointer;
            color: #888888;
        }

        .cards_reportes i {
            font-size: 16pt;
            margin-right: 10px;
        }

        .cards_reportes:hover {
            color: #345183;
            border: 1px solid #345183;
        }
    </style>
@endsection
{{ Breadcrumbs::render('portal-comunicacion.reportes') }}
<div class="card card-body" style="margin-top: -50PX;">
    <div class="row" style="border-bottom: 2px solid #ccc;">
        <div class="col-12 caja_titulo">
            <h1>Generar Reporte</h1>

            @php
                use App\Models\Organizacion;
                $organizacion = Organizacion::getFirst();
                $logotipo = $organizacion->logotipo;
            @endphp
            <img src="{{ asset($logotipo) }}" class="logo_organizacion_politica">

        </div>
    </div>
    <div class="row" style="">
        <div style="text-align: center;" class="mt-5">
            <a href="{{ asset('inicioUsuario/reportes/seguridad') }}" class="cards_reportes">
                <i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
            </a>
            <a href="{{ asset('inicioUsuario/reportes/riesgos') }}" class="cards_reportes">
                <i class="fas fa-shield-virus"></i> Riesgo Identificado
            </a>
            <a href="{{ asset('inicioUsuario/reportes/quejas') }}" class="cards_reportes">
                <i class="fas fa-frown"></i> Realizar queja
            </a>
            <a href="{{ asset('inicioUsuario/reportes/denuncias') }}" class="cards_reportes">
                <i class="fas fa-hand-paper"></i> Realizar denuncia
            </a>
            <a href="{{ asset('inicioUsuario/reportes/mejoras') }}" class="cards_reportes">
                <i class="fas fa-rocket"></i> Reportar mejora
            </a>
            <a href="{{ asset('inicioUsuario/reportes/sugerencias') }}" class="cards_reportes">
                <i class="fas fa-lightbulb"></i> Realizar sugerencia
            </a>
        </div>
    </div>
</div>
@endsection
