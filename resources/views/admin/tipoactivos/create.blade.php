@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tipoactivo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipoactivos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tipo">{{ trans('cruds.tipoactivo.fields.tipo') }}</label>
                <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text" name="tipo" id="tipo" value="{{ old('tipo', '') }}" required>
                @if($errors->has('tipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoactivo.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subtipo">{{ trans('cruds.tipoactivo.fields.subtipo') }}</label>
                <input class="form-control {{ $errors->has('subtipo') ? 'is-invalid' : '' }}" type="text" name="subtipo" id="subtipo" value="{{ old('subtipo', '') }}" required>
                @if($errors->has('subtipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subtipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoactivo.fields.subtipo_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection