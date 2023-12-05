@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@endsection
@section('content')
    <h5 class="titulo_general_funcion">Registrar: Linemientos Vacaciones</h5>
    {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Amenaza</h3>
        </div> --}}
    <div class="instrucciones">
        <div class="row">
            <div class="col-2">
                <img src="{{ asset('img/lineamientos.png') }}" alt="lineamientos">
            </div>
            <div class="col-10">
                <h5>¿Qué es? Lineamientos Vacaciones</h5>
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
    </div>

    <div class="mt-4 card card-body">
        <h5>Creación de lineamientos</h5>

        <hr>

        {!! Form::open(['route' => 'admin.vacaciones.store']) !!}

        @include('admin.vacaciones.fields')

        {!! Form::close() !!}
    </div>
@endsection
