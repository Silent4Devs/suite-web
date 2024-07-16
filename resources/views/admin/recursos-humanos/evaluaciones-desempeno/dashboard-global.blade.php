@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluations/evaluations.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Dashboard Global </h5>

    <div class="text-right mb-3">
        <a href="" class="btn btn-light" style="background-color: #E9FBFF;">Evaluaciones</a>
    </div>

    <div class="card card-body">
        <h6>Resultado anual</h6>
    </div>

    <div class="card card-body">
        <h6>Resultado mensual</h6>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
