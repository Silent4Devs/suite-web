@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Evaluaciones Indicadores SGSI</h5>
    <div class="card mt-4">
        {{-- <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong>Evaluaciones Indicadores SGSI</h3>
        </div> --}}
        <div class="card-body">
            @livewire('indicadores-sgsi-component', ['indicadoresSgsis' => $indicadoresSgsis])
        </div>
    </div>
@endsection
