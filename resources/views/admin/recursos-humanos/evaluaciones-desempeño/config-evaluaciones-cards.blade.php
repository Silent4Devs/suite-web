@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluaciones.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Configuración de la Evaluación </h5>

    <div class="d-flex align-items-center rounded-lg text-white p-3" style="background-color: #BF9CC4; gap: 20px;">
        <img src="{{ asset('img/purple-config-ev.png')}}" alt="">
        <div>
            <span style="font-size: 16px;">Asigna los Objetivos Estratégicos</span>
            <p class="mt-2">
                En esta sección puedes asignar los objetivos que le correspondan a cada colaborador de la organización. <br>
                Consulte los Objetivos Estratégicos con el líder de cada Colaborador
            </p>
        </div>
    </div>

    <div class="card card-body mt-4">

    </div>

    <div class="card card-body">

    </div>

@endsection

@section('scripts')
    @parent

@endsection
