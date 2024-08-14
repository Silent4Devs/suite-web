@extends('layouts.admin')
@section('css')
    <link rel="stylesheet"
        href="{{ asset('css/dahsboardSolicitudesPermisos/dahsboardSolicitudesPermisos.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('Reglas-DayOff') }} --}}

    <h5 class="titulo_general_funcion">Solicitudes: <span style="font-weight: lighter;">Dashboard</span></h5>

    <div class="row">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <span>Directivo</span>
                <div>
                    <strong>Nombre del colaborador</strong> <br>
                    <span>Karen</span>
                </div>
                <div class="img-person">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            vc
        </div>
        <div class="col-md-4">
            day
        </div>
        <div class="col-md-4">
            per
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            apro
        </div>
        <div class="col-md-4">
            por
        </div>
        <div class="col-md-4">
            rech
        </div>
    </div>

    <div class="row">
        <div class="ccol-md-6">
            calendar
        </div>
        <div class="col-md-6">
            agenda
        </div>
    </div>

    <div class="card card-body">
        table
    </div>
@endsection

@section('scripts')
    @parent
@endsection
