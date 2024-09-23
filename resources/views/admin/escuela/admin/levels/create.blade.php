@extends('layouts.admin')

@section('title', 'Crear nivel')

@section('content')
    <h5 class="col-12 titulo_general_funcion">Crear Niveles</h5>
    <div class="mt-5 card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.levels.store']) !!}
            <h5 class="font-weight-bold mb-4">Nivel</h5>
            <div class="form-group">
                {!! Form::label('name', 'Nombre del Nivel*', ['class' => 'asterisco']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <div class="text-right">
                    {!! Form::submit('CREAR NIVEL  +', ['class' => 'btn tb-btn-primary', 'style' => 'color: #ffff;']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
