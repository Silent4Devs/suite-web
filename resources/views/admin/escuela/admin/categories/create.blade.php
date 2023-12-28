@extends('layouts.admin')

@section('title', 'Nueva categoría')

@section('content')
<h5 class="col-12 titulo_general_funcion">Nueva categoría</h5>
<div class="mt-5 card">
    <div class="card-body">
        <h1 class="font-weight-bold mb-4" style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 20px; border-bottom-style:solid;border-width: 1px;">Categoría</h1>
        {!! Form::open(['route' => 'admin.categories.store']) !!}
        <div class="form-group d-flex align-items-center anima-focus">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
            {!! Form::label('name', 'Nombre*', ['class' => 'asterisco']) !!}
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <br>
            {!! Form::submit('CREAR CATEGORÍA  +', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection



