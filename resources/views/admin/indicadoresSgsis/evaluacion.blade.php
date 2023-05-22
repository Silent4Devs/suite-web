@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Evaluaciones de Indicadores del Sistema de Gestión</h5>
    <div class="card mt-4">
        {{-- <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong>Evaluaciones Indicadores SGSI</h3>
        </div> --}}
        <div class="card-body">
            <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                <span style="font-size: 17px; font-weight: bold;">
                    Información del indicador</span>
            </div>
            @livewire('indicadores-sgsi-component', [
                'indicadoresSgsis' => $indicadoresSgsis,
                'inpvar' => $variables])
        </div>
    </div>
@endsection
