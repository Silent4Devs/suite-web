@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.objetivosseguridads.create') }}
 
<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Objetivos de Seguridad </h3>
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.objetivosseguridads.update", [$objetivosseguridad->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-12">
                <label class="required" for="objetivoseguridad"><i class="fas fa-shield-alt iconos-crear"></i>{{ trans('cruds.objetivosseguridad.fields.objetivoseguridad') }}</label>
                <input class="form-control {{ $errors->has('objetivoseguridad') ? 'is-invalid' : '' }}" type="text" name="objetivoseguridad" id="objetivoseguridad" value="{{ old('objetivoseguridad', $objetivosseguridad->objetivoseguridad) }}" required>
                @if($errors->has('objetivoseguridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivoseguridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.objetivoseguridad_helper') }}</span>
            </div>
            <div class="form-group col-md-8">
                <label for="indicador"><i class="fas fa-map-marker iconos-crear"></i>{{ trans('cruds.objetivosseguridad.fields.indicador') }}</label>
                <input class="form-control {{ $errors->has('indicador') ? 'is-invalid' : '' }}" type="text" name="indicador" id="indicador" value="{{ old('indicador', $objetivosseguridad->indicador) }}">
                @if($errors->has('indicador'))
                    <div class="invalid-feedback">
                        {{ $errors->first('indicador') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.indicador_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="anio"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.objetivosseguridad.fields.anio') }}</label>
                <input class="form-control date {{ $errors->has('anio') ? 'is-invalid' : '' }}" type="text" name="anio" id="anio" value="{{ old('anio', $objetivosseguridad->anio) }}">
                @if($errors->has('anio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.objetivosseguridad.fields.anio_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection