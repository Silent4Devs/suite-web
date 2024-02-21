@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{config('app.cssVersion')}}">
@endsection
@section('content')
    <h5 class="titulo_general_funcion">Registrar: Lineamiento Days Off´s</h5>

    <div class="instrucciones">
        <div>
            <img src="{{ asset('img/lineamientos.png') }}" alt="lineamientos">
        </div>
        <div>
            <h5>¿Qué es? Lineamientos DayOff</h5>
            <p>Los Lineamientos de dayoff son documentos normativos que establecen las reglas y condiciones para
                el
                otorgamiento y disfrute de las dayoff de los trabajadores. Estos nuevos lineamientos de
                dayoff
                tienen
                como objetivo garantizar que los trabajadores tengan tiempo suficiente para descansar y reponer
                energías,
                así
                como para disfrutar de su tiempo libre.</p>
        </div>
    </div>

    {!! Form::open(['route' => 'admin.dayOff.store']) !!}
    <div class="mt-4 card card-body">
        <h5>Creación de lineamientos</h5>

        @include('admin.dayOff.fields-create')

    </div>
    <!-- Submit Field -->
    <div class="text-right form-group col-12">
        <a href="{{ route('admin.dayOff.index') }}" class="btn btn-outline-primary">Regresar</a>
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
    {!! Form::close() !!}
@endsection
