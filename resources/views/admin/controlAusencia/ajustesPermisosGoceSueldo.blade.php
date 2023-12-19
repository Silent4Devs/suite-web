@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@endsection
@section('content')
    {{ Breadcrumbs::render('Ajustes-permisos-goce-sueldo') }}

    <h5 class="titulo_general_funcion">Administración de Permisos</h5>

    <div class="card-btns-vacaciones">
        @can('reglas_goce_sueldo_acceder')
            <a href="permisos-goce-sueldo">
                <i class="fa-solid fa-book"></i>
                Lineamientos
            </a>
        @endcan
        @can('reglas_goce_sueldo_vista_global')
            <a href="vista-global-permisos-goce-sueldo">
                <i class="fa-solid fa-globe"></i>
                Vista Global
            </a>
        @endcan
    </div>
@endsection
