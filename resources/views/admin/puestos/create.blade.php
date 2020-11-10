@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.puesto.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.puestos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="puesto">{{ trans('cruds.puesto.fields.puesto') }}</label>
                <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text" name="puesto" id="puesto" value="{{ old('puesto', '') }}" required>
                @if($errors->has('puesto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('puesto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.puesto.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.puesto.fields.descripcion_helper') }}</span>
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