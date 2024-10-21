@extends('layouts.admin')
@section('title', 'Nuup')

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <h5 class="col-12 titulo_general_funcion">Editar categoría</h5>
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bold mb-4">Categoría</h5>
            {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'put']) !!}
            <div class="form-group mt-4">
                {!! Form::label('name', 'Nombre*', ['class' => 'asterisco']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
            </div>
            <div class="text-right">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-cancelar" id="btn_cancelar"
                    style="color:#057BE2;">Cancelar</a>
                {!! Form::submit('ACTUALIZAR CATEGORIA', ['class' => 'btn tb-btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
