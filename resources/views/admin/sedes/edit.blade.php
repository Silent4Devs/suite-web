@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sede.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sedes.update", [$sede->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sede">{{ trans('cruds.sede.fields.sede') }}</label>
                <input class="form-control {{ $errors->has('sede') ? 'is-invalid' : '' }}" type="text" name="sede" id="sede" value="{{ old('sede', $sede->sede) }}" required>
                @if($errors->has('sede'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sede') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.sede_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.sede.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $sede->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.descripcion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="organizacion_id">{{ trans('cruds.sede.fields.organizacion') }}</label>
                <select class="form-control select2 {{ $errors->has('organizacion') ? 'is-invalid' : '' }}" name="organizacion_id" id="organizacion_id">
                    @foreach($organizacions as $id => $organizacion)
                        <option value="{{ $id }}" {{ (old('organizacion_id') ? old('organizacion_id') : $sede->organizacion->id ?? '') == $id ? 'selected' : '' }}>{{ $organizacion }}</option>
                    @endforeach
                </select>
                @if($errors->has('organizacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organizacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
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