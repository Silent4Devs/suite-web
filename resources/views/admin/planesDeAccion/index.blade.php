@extends('layouts.admin')

@section('content')
    <h5 class="col-12 titulo_general_funcion">Planes de acción</h5>

    <div class="mt-3 card">
        @include('partials.flashMessages')
        @livewire('plan-de-accion.plan-accion-index-component')
    </div>
@endsection
