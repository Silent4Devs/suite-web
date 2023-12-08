@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@endsection
@section('content')
    {{ Breadcrumbs::render('Ajustes-vacaciones') }}

    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}
    <div style="display:flex; justify-content:space-between;">
        <h5 class="titulo_general_funcion">Administración de Day Off</h5>
    </div>
    <div class="card card-body card-btns-vacaciones">

        @can('reglas_dayoff_acceder')
            <a href="dayOff">
                <i class="fa-solid fa-book"></i>
                Lineamientos
            </a>
        @endcan
        @can('incidentes_dayoff_acceder')
            <a href="incidentes-dayoff">
                <i class="fa-solid fa-scale-unbalanced"></i>
                Excepciones
            </a>
        @endcan
        @can('reglas_dayoff_vista_global')
            <a href="vista-global-dayoff">
                <i class="fa-solid fa-globe"></i>
                Vista Global
            </a>
        @endcan

    </div>
@endsection
