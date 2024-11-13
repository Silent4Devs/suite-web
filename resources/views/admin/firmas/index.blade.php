@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}{{config('app.cssVersion')}}">
    @include('admin.listadistribucion.estilos')
@endsection
@section('content')

    <div class="row">
        <h5 class="col-12 titulo_general_funcion">Modulo de Firmas</h5>
    </div>

    <div class="text-right">
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.module_firmas.create') }}" type="button" class="btn tb-btn-primary">Registrar
                Modulo</a>
        </div>
    </div>


    @include('partials.flashMessages')
    <div class="datatable-rds w-100">
        <h3 class="title-table-rds">Modulo de Firmas</h3>
        @include('admin.firmas.table')
    </div>

@endsection
