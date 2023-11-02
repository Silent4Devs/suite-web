@extends('layouts.admin')
@section('content')
    <style>
        .titulo-card
        {
            /* UI Properties */
            text-align: left;
            font: 27px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
        }

        .texto-card
        {
            text-align: left;
            font: 16px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
            margin-right: 60px;
            margin-left: 20px:
        }
        .titulo
        {
            text-align: left;
            font: normal normal 600 24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            margin-left: 5px;
            margin-bottom: 12px;
        }

        .card-t.card
        {
            background-color: #3B7EB2;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
        }

        .card-body.card
        {
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 14px;
        }
    </style>
    {{ Breadcrumbs::render('admin.analisisdebrechas-2022.index') }}


    @include('partials.flashMessages')

    <h5 class="titulo">Análisis de Brechas </h5>

    <div class="card card-t">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}"
                    style="margin: 11px 10px 10px 10px;width:500px;" class="img-fluid">
            </div>
            <div class="col-md-10">
                <div class="pt-2">
                    <p class="titulo-card mb-1">Crea tu template</p>
                    <p class="texto-card mb-1">
                        Es una herramienta visual que ayuda a las organizaciones a visualizar las
                        brechas entre el estado actual y el estado deseado. Este dashboard suele incluir indicadores clave
                        de rendimiento
                        (KPI) que miden el desempeño de la organización en las áreas que se están analizando. El dashboard
                        puede ser una
                        herramienta valiosa para la gestión de las brechas. Al proporcionar una visión general de las
                        brechas, el dashboard
                        puede ayudar a las organizaciones a priorizar las áreas de mejora y a tomar medidas para cerrar las
                        brechas.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-left: 180px;">
        <div class="col-12 col-md-5 d-flex justify-content-center align-items-center">
            <div class="card card-body mt-4 text-center">
                <img src="{{ asset('assets/Imagen 18@2x.png') }}" alt="png" class="img-fluid">
                <div class="text-center" style="font:16px Roboto;color:#606060;">Templates</div>
                <div class="text-center">
                    <a href="{{ route('admin.templates') }}" style="font:17px Roboto;color: #FFFFFF;">
                        <button type="button" class="btn btn-primary mt-3 mb-3">Generar</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 d-flex justify-content-center align-items-center">
            <div class="card card-body mt-4 text-center">
                <img src="{{ asset('assets/Imagen 22@2x.png') }}" alt="png" class="img-fluid">
                <div class="text-center" style="font:16px Roboto;color:#606060;">Análisis de brechas</div>
                <div class="text-center">
                    <a href="{{ route('admin.formulario') }}" style="font:17px Roboto;color: #FFFFFF;">
                        <button type="button" class="btn btn-primary mt-3 mb-3">Generar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
