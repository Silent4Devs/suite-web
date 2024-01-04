@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/guia_iso.css') }}">
@endsection
@section('content')
    <style>
        .c-main {
            margin-top: 0px !important;
            padding-top: 0px !important;
        }

        .container-fluid {
            padding: 0 !important;
        }
    </style>
    <div class="d-flex">
        <div class="info-inicio-guia">
            <h4>
                GESTIÓN <br>
                NORMATIVA
            </h4>

            <p class="mt-3">
                La gestión normativa es el conjunto de actividades y procesos que se realizan para identificar, analizar,
                interpretar, aplicar y actualizar la normativa aplicable a una organización.
            </p>

            <ul class="mt-2">
                <li>- Reduce el riesgo de sanciones administrativas o judiciales. </li>
                <li>- Mejora la imagen y reputación de la organización. </li>
                <li>- Ahorra tiempo y recursos.</li>
            </ul>

            <div class="mt-5">
                <a href="{{ route('admin.iso27001.normas-guia') }}" class="btn btn-continuar-iso">
                    CONTINUAR
                </a>
            </div>
        </div>
        <div class="caja-img-iso-guia-inicio">
            <img src="{{ asset('img/example-remove/inicio-guia-iso.png') }}" alt="">
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
