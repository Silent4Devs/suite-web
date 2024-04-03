@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluaciones.css') }}{{ config('app.cssVersion') }}">

    <style>
        .alert-danger {
            background: #FFFDE3 0% 0% no-repeat padding-box !important;
            box-shadow: 0px 2px 3px #00000024 !important;
            border: 2px solid #FFC400 !important;
            border-radius: 21px !important;
            opacity: 1 !important;
        }
    </style>
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Configuración de la Evaluación </h5>

    @livewire('create-evaluacion-desempeno')

    {{-- <div class="nav-pasos-create ">
        <div class="nav nav-tabs" role="tablist" style="margin-bottom: 0px !important;">
            <a class="nav-link active" data-type="empleados" data-toggle="tab" href="#nav-config-obj-1"
                role="tab" aria-controls="nav-empleados" aria-selected="true">
                <span>1</span>
                <span>Inicio</span>
            </a>
            <a class="nav-link" id="" data-type="calendario-comunicacion" data-toggle="tab"
                href="#nav-config-obj-2" role="tab" aria-controls="nav-config-obj-2" aria-selected="false">
                Definir Escalas
            </a>
            <a class="nav-link" id="" data-type="ev360" data-toggle="tab" href="#nav-config-obj-3" role="tab"
                aria-controls="nav-ev360" aria-selected="false">
                Definir Permisos
            </a>
            <a class="nav-link" id="" data-type="ev360" data-toggle="tab" href="#nav-config-obj-4" role="tab"
                aria-controls="nav-ev360" aria-selected="false">
                Cargar objetivos
            </a>
        </div>
    </div> --}}
@endsection
