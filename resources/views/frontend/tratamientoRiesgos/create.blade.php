@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.tratamientoRiesgo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tratamiento-riesgos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="nivelriesgo">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo') }}</label>
                            <input class="form-control" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', '') }}">
                            @if($errors->has('nivelriesgo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nivelriesgo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="control_id">{{ trans('cruds.tratamientoRiesgo.fields.control') }}</label>
                            <select class="form-control select2" name="control_id" id="control_id">
                                @foreach($controls as $id => $control)
                                    <option value="{{ $id }}" {{ old('control_id') == $id ? 'selected' : '' }}>{{ $control }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('control'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('control') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.control_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="acciones">{{ trans('cruds.tratamientoRiesgo.fields.acciones') }}</label>
                            <textarea class="form-control" name="acciones" id="acciones">{{ old('acciones') }}</textarea>
                            @if($errors->has('acciones'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('acciones') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.acciones_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="responsable_id">{{ trans('cruds.tratamientoRiesgo.fields.responsable') }}</label>
                            <select class="form-control select2" name="responsable_id" id="responsable_id">
                                @foreach($responsables as $id => $responsable)
                                    <option value="{{ $id }}" {{ old('responsable_id') == $id ? 'selected' : '' }}>{{ $responsable }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('responsable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('responsable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.responsable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fechacompromiso">{{ trans('cruds.tratamientoRiesgo.fields.fechacompromiso') }}</label>
                            <input class="form-control date" type="text" name="fechacompromiso" id="fechacompromiso" value="{{ old('fechacompromiso') }}">
                            @if($errors->has('fechacompromiso'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechacompromiso') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.fechacompromiso_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}</label>
                            <select class="form-control" name="prioridad" id="prioridad">
                                <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\TratamientoRiesgo::PRIORIDAD_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('prioridad', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('prioridad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('prioridad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.prioridad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="estatus">{{ trans('cruds.tratamientoRiesgo.fields.estatus') }}</label>
                            <input class="form-control" type="text" name="estatus" id="estatus" value="{{ old('estatus', '') }}">
                            @if($errors->has('estatus'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('estatus') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.estatus_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="probabilidad">{{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}</label>
                            <input class="form-control" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', '') }}">
                            @if($errors->has('probabilidad'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('probabilidad') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.probabilidad_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="impacto">{{ trans('cruds.tratamientoRiesgo.fields.impacto') }}</label>
                            <input class="form-control" type="text" name="impacto" id="impacto" value="{{ old('impacto', '') }}">
                            @if($errors->has('impacto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impacto') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.impacto_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nivelriesgoresidual">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual') }}</label>
                            <input class="form-control" type="text" name="nivelriesgoresidual" id="nivelriesgoresidual" value="{{ old('nivelriesgoresidual', '') }}">
                            @if($errors->has('nivelriesgoresidual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nivelriesgoresidual') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual_helper') }}</span>
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