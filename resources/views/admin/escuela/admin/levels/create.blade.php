@extends('layouts.admin')

@section('title', 'Crear nivel')

@section('content')
<h5 class="col-12 titulo_general_funcion">Crear Niveles</h5>
<div class="mt-5 card">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.levels.store']) !!}
        <h1 class="font-weight-bold mb-4" style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 20px; border-bottom-style:solid;border-width: 1px;">Nivel</h1>
        <h2 style="font-size: 15px;">
            <span style="color: #3086AF;">Nombre</span><span style="color: #AF3041;">*</span>
        </h2>
        <div class="form-group d-flex align-items-center">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del nivel']) !!}
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                {!! Form::submit('CREAR NIVEL  +', ['class' => 'btn btn-link', 'style' => 'color: #006DDB; font-size: 15px; margin-left: 60px; font-weight: bold;']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

