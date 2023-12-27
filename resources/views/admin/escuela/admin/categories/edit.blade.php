@extends('layouts.admin')
@section('title', 'Nuup')

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    <h5 class="col-12 titulo_general_funcion">Editar categoría</h5>
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold mb-4" style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 20px; border-bottom-style:solid;border-width: 1px;">Categoría</h1>
            {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'put']) !!}
                <div class="form-group anima-focus">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                            {!! Form::label('name', 'Nombre*', ['class' => 'asterisco']) !!}
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            {!! Form::submit('ACTUALIZAR CATEGORIA', ['class' => 'btn btn-primary']) !!}
                </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
