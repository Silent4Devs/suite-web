@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@endsection
@section('content')
    {{ Breadcrumbs::render('Ajustes-vacaciones') }}

    <h5 class="titulo_general_funcion">Administración de Vacaciones</h5>

    <div class="card card-body card-btns-vacaciones">
        @can('reglas_vacaciones_acceder')
            <a href="vacaciones">
                <i class="fa-solid fa-book"></i>
                Lineamientos
            </a>
        @endcan
        @can('incidentes_vacaciones_acceder')
            <a href="incidentes-vacaciones">
                <i class="fa-solid fa-scale-unbalanced"></i>
                Excepciones </a>
        @endcan
        @can('reglas_vacaciones_vista_global')
            <a href="vista-global-vacaciones">
                <i class="fa-solid fa-globe"></i>
                Vista Global
            </a>
        @endcan
    </div>
@endsection
