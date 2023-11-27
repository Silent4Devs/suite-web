@extends('layouts.admin')

@section('content')
    @include('admin.dayOff.estilos')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.dayOff.index') !!}">Linemainetos para Day Off</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>


    <h5 class="col-12 titulo_general_funcion">Editar: Lineamiento Day Off</h5>
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
            <h5>Modificación de lineamientos</h5>
        </div>
        <div class="card-body">
            {!! Form::model($vacacion, ['route' => ['admin.dayOff.update', $vacacion->id], 'method' => 'patch']) !!}

            @include('admin.dayOff.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
