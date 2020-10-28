@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.registromejora.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.registromejoras.update", [$registromejora->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="nombre_reporta_id">{{ trans('cruds.registromejora.fields.nombre_reporta') }}</label>
                            <select class="form-control select2" name="nombre_reporta_id" id="nombre_reporta_id">
                                @foreach($nombre_reportas as $id => $nombre_reporta)
                                    <option value="{{ $id }}" {{ (old('nombre_reporta_id') ? old('nombre_reporta_id') : $registromejora->nombre_reporta->id ?? '') == $id ? 'selected' : '' }}>{{ $nombre_reporta }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('nombre_reporta'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre_reporta') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.nombre_reporta_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nombre">{{ trans('cruds.registromejora.fields.nombre') }}</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ old('nombre', $registromejora->nombre) }}">
                            @if($errors->has('nombre'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.nombre_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.registromejora.fields.prioridad') }}</label>
                            <select class="form-control" name="prioridad" id="prioridad">
                                <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Registromejora::PRIORIDAD_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('prioridad', $registromejora->prioridad) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('prioridad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('prioridad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.prioridad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="clasificacion">{{ trans('cruds.registromejora.fields.clasificacion') }}</label>
                            <input class="form-control" type="text" name="clasificacion" id="clasificacion" value="{{ old('clasificacion', $registromejora->clasificacion) }}">
                            @if($errors->has('clasificacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clasificacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.clasificacion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">{{ trans('cruds.registromejora.fields.descripcion') }}</label>
                            <textarea class="form-control" name="descripcion" id="descripcion">{{ old('descripcion', $registromejora->descripcion) }}</textarea>
                            @if($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.descripcion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="responsableimplementacion_id">{{ trans('cruds.registromejora.fields.responsableimplementacion') }}</label>
                            <select class="form-control select2" name="responsableimplementacion_id" id="responsableimplementacion_id">
                                @foreach($responsableimplementacions as $id => $responsableimplementacion)
                                    <option value="{{ $id }}" {{ (old('responsableimplementacion_id') ? old('responsableimplementacion_id') : $registromejora->responsableimplementacion->id ?? '') == $id ? 'selected' : '' }}>{{ $responsableimplementacion }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('responsableimplementacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('responsableimplementacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.responsableimplementacion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="participantes">{{ trans('cruds.registromejora.fields.participantes') }}</label>
                            <textarea class="form-control" name="participantes" id="participantes">{{ old('participantes', $registromejora->participantes) }}</textarea>
                            @if($errors->has('participantes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('participantes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.participantes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="recursos">{{ trans('cruds.registromejora.fields.recursos') }}</label>
                            <textarea class="form-control" name="recursos" id="recursos">{{ old('recursos', $registromejora->recursos) }}</textarea>
                            @if($errors->has('recursos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('recursos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.recursos_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="beneficios">{{ trans('cruds.registromejora.fields.beneficios') }}</label>
                            <textarea class="form-control" name="beneficios" id="beneficios">{{ old('beneficios', $registromejora->beneficios) }}</textarea>
                            @if($errors->has('beneficios'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('beneficios') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.beneficios_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="valida_id">{{ trans('cruds.registromejora.fields.valida') }}</label>
                            <select class="form-control select2" name="valida_id" id="valida_id">
                                @foreach($validas as $id => $valida)
                                    <option value="{{ $id }}" {{ (old('valida_id') ? old('valida_id') : $registromejora->valida->id ?? '') == $id ? 'selected' : '' }}>{{ $valida }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('valida'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('valida') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.registromejora.fields.valida_helper') }}</span>
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