@extends('layouts.admin')

@section('content')
    @include('admin.incidentesVacaciones.estilos')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.incidentes-vacaciones.index') !!}">Excepciones Vacaciones</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12">Registrar: Excepción de Vacaciones</h5>

    <div class="card instrucciones">
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('img/lineamientos.png') }}" alt="lineamientos">
                </div>
                <div class="col-10">
                    <h5>¿Qué es? Lineamientos Vacaciones</h5>
                    <p>Los Lineamientos de vacaciones son documentos normativos que establecen las reglas y condiciones para
                        el
                        otorgamiento y disfrute de las vacaciones de los trabajadores. Estos nuevos lineamientos de
                        vacaciones
                        tienen
                        como objetivo garantizar que los trabajadores tengan tiempo suficiente para descansar y reponer
                        energías,
                        así
                        como para disfrutar de su tiempo libre.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-header">
            <h5>Creación de excepciones</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'admin.incidentes-vacaciones.store']) !!}

            @include('admin.incidentesVacaciones.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
