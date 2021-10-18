@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.objetivosseguridad.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.objetivosseguridads.update", [$objetivosseguridad->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="objetivoseguridad">{{ trans('cruds.objetivosseguridad.fields.objetivoseguridad') }}</label>
                            <input class="form-control" type="text" name="objetivoseguridad" id="objetivoseguridad" value="{{ old('objetivoseguridad', $objetivosseguridad->objetivoseguridad) }}" required>
                            @if($errors->has('objetivoseguridad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('objetivoseguridad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.objetivoseguridad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="indicador">{{ trans('cruds.objetivosseguridad.fields.indicador') }}</label>
                            <input class="form-control" type="text" name="indicador" id="indicador" value="{{ old('indicador', $objetivosseguridad->indicador) }}">
                            @if($errors->has('indicador'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('indicador') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.indicador_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="anio">{{ trans('cruds.objetivosseguridad.fields.anio') }}</label>
                            <input class="form-control date" type="text" name="anio" id="anio" value="{{ old('anio', $objetivosseguridad->anio) }}">
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

        </div>
    </div>
</div>
@endsection