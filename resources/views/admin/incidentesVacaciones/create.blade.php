@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{config('app.cssVersion')}}">
@endsection
@section('content')
    <h5 class="titulo_general_funcion">Registrar: Excepción de Vacaciones</h5>

    <div class="instrucciones">
        <div>
            <img src="{{ asset('img/lineamientos.png') }}" alt="lineamientos">
        </div>
        <div>
            <span>¿Qué es? Lineamientos Vacaciones</span>
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

    {!! Form::open(['route' => 'admin.incidentes-vacaciones.store']) !!}
    <div class="mt-4 card card-body">
        <span class="sub-title-vac">Creación de excepciones</span>

        <hr>

        @include('admin.incidentesVacaciones.fields')
    </div>
    <div class="text-right">
        <a href="{{ route('admin.incidentes-vacaciones.index') }}" class="btn btn-outline-primary">Regresar</a>
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
    {!! Form::close() !!}
@endsection
