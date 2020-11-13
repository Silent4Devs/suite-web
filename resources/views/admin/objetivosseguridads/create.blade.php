@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center" style="margin-top: -40px">
         <h3 class="mb-1  text-center text-white">
        {{ trans('global.create') }} {{ trans('cruds.objetivosseguridad.title_singular') }} </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.objetivosseguridads.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="objetivoseguridad">{{ trans('cruds.objetivosseguridad.fields.objetivoseguridad') }}</label>
                <input class="form-control {{ $errors->has('objetivoseguridad') ? 'is-invalid' : '' }}" type="text" name="objetivoseguridad" id="objetivoseguridad" value="{{ old('objetivoseguridad', '') }}" required>
                @if($errors->has('objetivoseguridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivoseguridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.objetivoseguridad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="indicador">{{ trans('cruds.objetivosseguridad.fields.indicador') }}</label>
                <input class="form-control {{ $errors->has('indicador') ? 'is-invalid' : '' }}" type="text" name="indicador" id="indicador" value="{{ old('indicador', '') }}">
                @if($errors->has('indicador'))
                    <div class="invalid-feedback">
                        {{ $errors->first('indicador') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.indicador_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anio">{{ trans('cruds.objetivosseguridad.fields.anio') }}</label>
                <input class="form-control date {{ $errors->has('anio') ? 'is-invalid' : '' }}" type="text" name="anio" id="anio" value="{{ old('anio') }}">
                @if($errors->has('anio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.anio_helper') }}</span>
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