@extends('layouts.admin')

@section('content')
    @include('admin.dayOff.estilos')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.dayOff.index') !!}">Lineamientos para Days Off </a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Registrar: Lineamiento Days Off´s</h5>

    <div class="card instrucciones">
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('img/lineamientos.png') }}" alt="lineamientos">
                </div>
                <div class="col-10">
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
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-header">
            <h5>Creación de lineamientos</h5>
        </div>
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Amenaza</h3>
        </div> --}}
        <div class="card-body">
            {!! Form::open(['route' => 'admin.dayOff.store']) !!}

            @include('admin.dayOff.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
