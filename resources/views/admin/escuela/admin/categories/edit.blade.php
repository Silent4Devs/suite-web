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
                <div class="form-group">
                    <span style="color: #3086AF;">Nombre</span><span style="color: #AF3041;">*</span>
                    <div class="row align-items-start">
                        <div class="col-9">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoría']) !!}
                        </div>
                        <div class="col-3">
                            {!! Form::submit('ACTUALIZAR CATEGORIA', ['class' => 'btn btn-link', 'style' => 'color: #006DDB; font-size: 15px; margin-left: 30px; font-weight: bold;']) !!}
                        </div>
                    </div>

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
