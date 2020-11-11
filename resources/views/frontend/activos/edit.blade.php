@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.activo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.activos.update", [$activo->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="tipoactivo_id">{{ trans('cruds.activo.fields.tipoactivo') }}</label>
                            <select class="form-control select2" name="tipoactivo_id" id="tipoactivo_id">
                                @foreach($tipoactivos as $id => $tipoactivo)
                                    <option value="{{ $id }}" {{ (old('tipoactivo_id') ? old('tipoactivo_id') : $activo->tipoactivo->id ?? '') == $id ? 'selected' : '' }}>{{ $tipoactivo }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tipoactivo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tipoactivo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activo.fields.tipoactivo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="subtipo_id">{{ trans('cruds.activo.fields.subtipo') }}</label>
                            <select class="form-control select2" name="subtipo_id" id="subtipo_id">
                                @foreach($subtipos as $id => $subtipo)
                                    <option value="{{ $id }}" {{ (old('subtipo_id') ? old('subtipo_id') : $activo->subtipo->id ?? '') == $id ? 'selected' : '' }}>{{ $subtipo }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subtipo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subtipo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activo.fields.subtipo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">{{ trans('cruds.activo.fields.descripcion') }}</label>
                            <textarea class="form-control" name="descripcion" id="descripcion">{{ old('descripcion', $activo->descripcion) }}</textarea>
                            @if($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activo.fields.descripcion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dueno_id">{{ trans('cruds.activo.fields.dueno') }}</label>
                            <select class="form-control select2" name="dueno_id" id="dueno_id">
                                @foreach($duenos as $id => $dueno)
                                    <option value="{{ $id }}" {{ (old('dueno_id') ? old('dueno_id') : $activo->dueno->id ?? '') == $id ? 'selected' : '' }}>{{ $dueno }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('dueno'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dueno') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activo.fields.dueno_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ubicacion_id">{{ trans('cruds.activo.fields.ubicacion') }}</label>
                            <select class="form-control select2" name="ubicacion_id" id="ubicacion_id">
                                @foreach($ubicacions as $id => $ubicacion)
                                    <option value="{{ $id }}" {{ (old('ubicacion_id') ? old('ubicacion_id') : $activo->ubicacion->id ?? '') == $id ? 'selected' : '' }}>{{ $ubicacion }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ubicacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ubicacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activo.fields.ubicacion_helper') }}</span>
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