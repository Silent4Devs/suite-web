@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/plan_accion.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">PLAN DE TRABAJO</h5>
    <div class="text-right">
        <a href="{{ route('admin.planes-de-accion.create') }}" id="" class="btn btn-xs btn-primary">
            Agregar nuevo
            <i class="material-symbols-outlined">add</i>
        </a>
    </div>
    <div class="mt-3 card">
        @include('partials.flashMessages')
        @livewire('plan-de-accion.plan-accion-index-component')
    </div>
@endsection
