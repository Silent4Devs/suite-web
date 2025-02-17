@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Lineamiento</h5>

    <div class="instrucciones">
        <div>
            <img src="{{ asset('img/lineamientos.png') }}" alt="lineamientos">
        </div>
        <div>
            <span>¿Qué es? Lineamientos Vacaciones</span>
            <p>Los Lineamientos de vacaciones son documentos normativos que establecen las reglas y condiciones
                para
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

    <form action="{{ route('admin.vacaciones.update', $vacacion->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mt-4 card card-body">
            <h5>Modificación de lineamientos</h5>
            <hr>

            @include('admin.vacaciones.fields')

        </div>
        <div class="text-right form-group col-12">
            <a href="{{ route('admin.vacaciones.index') }}" class="btn btn-outline-primary">Regresar</a>
            <button class="btn btn-primary" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </form>

@endsection
