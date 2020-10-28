@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.planificacionControl.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.planificacion-controls.update", [$planificacionControl->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="activo">{{ trans('cruds.planificacionControl.fields.activo') }}</label>
                            <input class="form-control" type="text" name="activo" id="activo" value="{{ old('activo', $planificacionControl->activo) }}" required>
                            @if($errors->has('activo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('activo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.activo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">{{ trans('cruds.planificacionControl.fields.descripcion') }}</label>
                            <textarea class="form-control" name="descripcion" id="descripcion">{{ old('descripcion', $planificacionControl->descripcion) }}</textarea>
                            @if($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.descripcion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dueno_id">{{ trans('cruds.planificacionControl.fields.dueno') }}</label>
                            <select class="form-control select2" name="dueno_id" id="dueno_id">
                                @foreach($duenos as $id => $dueno)
                                    <option value="{{ $id }}" {{ (old('dueno_id') ? old('dueno_id') : $planificacionControl->dueno->id ?? '') == $id ? 'selected' : '' }}>{{ $dueno }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('dueno'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dueno') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.dueno_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="vulnerabilidad">{{ trans('cruds.planificacionControl.fields.vulnerabilidad') }}</label>
                            <input class="form-control" type="text" name="vulnerabilidad" id="vulnerabilidad" value="{{ old('vulnerabilidad', $planificacionControl->vulnerabilidad) }}">
                            @if($errors->has('vulnerabilidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vulnerabilidad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.vulnerabilidad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="amenaza">{{ trans('cruds.planificacionControl.fields.amenaza') }}</label>
                            <input class="form-control" type="text" name="amenaza" id="amenaza" value="{{ old('amenaza', $planificacionControl->amenaza) }}">
                            @if($errors->has('amenaza'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amenaza') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.amenaza_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="confidencialidad">{{ trans('cruds.planificacionControl.fields.confidencialidad') }}</label>
                            <input class="form-control" type="text" name="confidencialidad" id="confidencialidad" value="{{ old('confidencialidad', $planificacionControl->confidencialidad) }}">
                            @if($errors->has('confidencialidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confidencialidad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.confidencialidad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="integridad">{{ trans('cruds.planificacionControl.fields.integridad') }}</label>
                            <input class="form-control" type="text" name="integridad" id="integridad" value="{{ old('integridad', $planificacionControl->integridad) }}">
                            @if($errors->has('integridad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('integridad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.integridad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="disponibilidad">{{ trans('cruds.planificacionControl.fields.disponibilidad') }}</label>
                            <input class="form-control" type="text" name="disponibilidad" id="disponibilidad" value="{{ old('disponibilidad', $planificacionControl->disponibilidad) }}">
                            @if($errors->has('disponibilidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('disponibilidad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.disponibilidad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="probabilidad">{{ trans('cruds.planificacionControl.fields.probabilidad') }}</label>
                            <input class="form-control" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', $planificacionControl->probabilidad) }}">
                            @if($errors->has('probabilidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.probabilidad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="impacto">{{ trans('cruds.planificacionControl.fields.impacto') }}</label>
                            <input class="form-control" type="text" name="impacto" id="impacto" value="{{ old('impacto', $planificacionControl->impacto) }}">
                            @if($errors->has('impacto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.impacto_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nivelriesgo">{{ trans('cruds.planificacionControl.fields.nivelriesgo') }}</label>
                            <input class="form-control" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', $planificacionControl->nivelriesgo) }}">
                            @if($errors->has('nivelriesgo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nivelriesgo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.planificacionControl.fields.nivelriesgo_helper') }}</span>
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