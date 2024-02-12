@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{config('app.cssVersion')}}">
@endsection
@section('content')
    <h5 class=" titulo_general_funcion">Editar: Lineamiento Day Off</h5>
    <div class=" instrucciones">
        <div class="">
            <img src="{{ asset('img/lineamientos.png') }}" alt="lineamientos">
        </div>
        <div class="">
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

    {!! Form::model($vacacion, ['route' => ['admin.dayOff.update', $vacacion->id], 'method' => 'patch']) !!}
    <div class="mt-4 card card-body">
        <h5>Modificación de lineamientos</h5>
        <hr>

        @include('admin.dayOff.fields')

        <div class="text-right form-group col-12">
            <a href="{{ route('admin.dayOff.index') }}" class="btn btn-outline-primary">Regresar</a>
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>

    </div>
    {!! Form::close() !!}
@endsection
