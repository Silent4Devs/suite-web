@extends('layouts.admin')

@section('content')


    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.incidentes-vacaciones.index') !!}">Excepciones Vacaciones</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Registrar: Excepción de Vacaciones</h5>
    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Amenaza</h3>
        </div> --}}
        <div class="card-body">
            {!! Form::open(['route' => 'admin.incidentes-vacaciones.store']) !!}

            @include('admin.incidentesVacaciones.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
