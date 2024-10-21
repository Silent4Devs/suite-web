@extends('layouts.admin')

@section('title', 'Nueva categoría')

@section('content')
    <h5 class="col-12 titulo_general_funcion">Nueva categoría</h5>
    <div class="mt-5 card">
        <div class="card-body">
            <h5 class="font-weight-bold mb-4">Categoría</h5>
            {!! Form::open(['route' => 'admin.categories.store']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre*', ['class' => 'asterisco']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-cancelar" id="btn_cancelar"
                        style="color:#057BE2;">Cancelar</a>
                    <button class="btn tb-btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
