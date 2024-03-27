@extends('layouts.admin')

@section('title', 'Crear nivel')

@section('content')
<h5 class="col-12 titulo_general_funcion">Crear Niveles</h5>
<div class="mt-5 card">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.levels.store']) !!}
        <h1 class="font-weight-bold mb-4" style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 20px; border-bottom-style:solid;border-width: 1px;">Nivel</h1>
        <div class="form-group d-flex align-items-center anima-focus">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                {!! Form::label('name', 'Nombre del Nivel*', ['class' => 'asterisco']) !!}
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <br>
                {!! Form::submit('CREAR NIVEL  +', ['class' => 'btn btn-primary', 'style' => 'color: #ffff;']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

