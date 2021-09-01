@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.objetivosseguridads.create') }}

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> </strong>Evaluaciones Objetivos de seguridad</h3>
        </div>
        <div class="card-body">
            @livewire('objetivos-seguridad-component', ['objetivos' => $objetivos])
        </div>
    </div>

@endsection
