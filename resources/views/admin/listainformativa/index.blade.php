@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/listainformativa.css') }}{{config('app.cssVersion')}}">
    @include('admin.listainformativa.estilos')
@endsection
@section('content')


    <div class="row">
        <h5 class="col-12 titulo_general_funcion">Lista Informativa</h5>
    </div>



    @include('partials.flashMessages')
    <div class="datatable-rds w-100">
        <h3 class="title-table-rds">Lista Informativa</h3>
        @include('admin.listainformativa.table')
    </div>

@endsection

