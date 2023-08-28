@extends('layouts.admin')

@section('title', 'Nueva categoría')

@section('content')
<h5 class="col-12 titulo_general_funcion">Nueva categoría</h5>
<div class="mt-5 card">
    <div class="card-body">
        <h1 class="font-weight-bold mb-4" style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 20px; border-bottom-style:solid;border-width: 1px;">Categoría</h1>
        <h2 style="font-size: 15px;">
            <span style="color: #3086AF;">Nombre</span><span style="color: #AF3041;">*</span>
        </h2>
        {!! Form::open(['route' => 'admin.categories.store']) !!}
        <div class="form-group d-flex align-items-center">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoría']) !!}
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            {!! Form::submit('CREAR CATEGORÍA  +', ['class' => 'btn btn-link', 'style' => 'color: #006DDB; font-size: 15px; margin-left: 60px; font-weight: bold;']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection



