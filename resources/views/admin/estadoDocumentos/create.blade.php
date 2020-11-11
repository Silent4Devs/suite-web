@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.estadoDocumento.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.estado-documentos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="estado">{{ trans('cruds.estadoDocumento.fields.estado') }}</label>
                <input class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" type="text" name="estado" id="estado" value="{{ old('estado', '') }}">
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estadoDocumento.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.estadoDocumento.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.estadoDocumento.fields.descripcion_helper') }}</span>
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