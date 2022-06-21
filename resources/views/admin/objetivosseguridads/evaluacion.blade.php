@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.objetivosseguridads.create') }}
    <h5 class="col-12 titulo_general_funcion">Evaluaciones Objetivos de seguridad</h5>
    <div class="card mt-4">
        <div class="card-body">
            @livewire('objetivos-seguridad-component', ['objetivos' => $objetivos])
        </div>
    </div>
@endsection
