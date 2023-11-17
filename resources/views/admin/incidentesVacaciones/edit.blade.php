@extends('layouts.admin')

@section('content')
    @include('admin.incidentesVacaciones.estilos')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.vacaciones.index') !!}">Excepciones Vacaciones</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Excepcion</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($vacacion, [
                'route' => ['admin.incidentes-vacaciones.update', $vacacion->id],
                'method' => 'patch',
            ]) !!}

            @include('admin.incidentesVacaciones.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
