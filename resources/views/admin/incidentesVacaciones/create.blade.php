@extends('layouts.admin')

@section('content')
    @include('admin.incidentesVacaciones.estilos')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.incidentes-vacaciones.index') !!}">Excepciones Vacaciones</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Registrar: Excepción de Vacaciones</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.incidentes-vacaciones.store']) !!}

            @include('admin.incidentesVacaciones.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
