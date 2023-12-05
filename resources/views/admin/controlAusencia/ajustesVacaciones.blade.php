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
                <div>
                    <i class="fa-solid fa-book"></i>
                    <br>
                    Lineamientos
                </div>
            </a>
        @endcan
        @can('incidentes_vacaciones_acceder')
            <a href="incidentes-vacaciones">
                <div>
                    <i class="fa-solid fa-scale-unbalanced"></i><br>
                    Excepciones
                </div>
            </a>
        @endcan
        @can('reglas_vacaciones_vista_global')
            <a href="vista-global-vacaciones">
                <div>
                    <i class="fa-solid fa-globe"></i><br>
                    Vista Global
                </div>
            </a>
        @endcan
    </div>
@endsection
