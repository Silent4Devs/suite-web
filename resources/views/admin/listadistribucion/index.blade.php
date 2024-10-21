@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}{{config('app.cssVersion')}}">
    @include('admin.listadistribucion.estilos')
@endsection
@section('content')

    <div class="row">
        <h5 class="col-12 titulo_general_funcion">Lista de Distribución</h5>
    </div>


    @include('partials.flashMessages')
    <div class="datatable-rds w-100">
        <h3 class="title-table-rds">Lista de Distribución</h3>
        @include('admin.listadistribucion.table')
    </div>

@endsection
