@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tratamientoRiesgo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tratamiento-riesgos.update", [$tratamientoRiesgo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nivelriesgo">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', $tratamientoRiesgo->nivelriesgo) }}">
                @if($errors->has('nivelriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="control_id">{{ trans('cruds.tratamientoRiesgo.fields.control') }}</label>
                <select class="form-control select2 {{ $errors->has('control') ? 'is-invalid' : '' }}" name="control_id" id="control_id">
                    @foreach($controls as $id => $control)
                        <option value="{{ $id }}" {{ (old('control_id') ? old('control_id') : $tratamientoRiesgo->control->id ?? '') == $id ? 'selected' : '' }}>{{ $control }}</option>
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
                <textarea class="form-control {{ $errors->has('acciones') ? 'is-invalid' : '' }}" name="acciones" id="acciones">{{ old('acciones', $tratamientoRiesgo->acciones) }}</textarea>
                @if($errors->has('acciones'))
                    <div class="invalid-feedback">
                        {{ $errors->first('acciones') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.acciones_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responsable_id">{{ trans('cruds.tratamientoRiesgo.fields.responsable') }}</label>
                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}" name="responsable_id" id="responsable_id">
                    @foreach($responsables as $id => $responsable)
                        <option value="{{ $id }}" {{ (old('responsable_id') ? old('responsable_id') : $tratamientoRiesgo->responsable->id ?? '') == $id ? 'selected' : '' }}>{{ $responsable }}</option>
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
                <input class="form-control date {{ $errors->has('fechacompromiso') ? 'is-invalid' : '' }}" type="text" name="fechacompromiso" id="fechacompromiso" value="{{ old('fechacompromiso', $tratamientoRiesgo->fechacompromiso) }}">
                @if($errors->has('fechacompromiso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechacompromiso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.fechacompromiso_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}</label>
                <select class="form-control {{ $errors->has('prioridad') ? 'is-invalid' : '' }}" name="prioridad" id="prioridad">
                    <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\TratamientoRiesgo::PRIORIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('prioridad', $tratamientoRiesgo->prioridad) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <input class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" type="text" name="estatus" id="estatus" value="{{ old('estatus', $tratamientoRiesgo->estatus) }}">
                @if($errors->has('estatus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="probabilidad">{{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}</label>
                <input class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', $tratamientoRiesgo->probabilidad) }}">
                @if($errors->has('probabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('probabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.probabilidad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="impacto">{{ trans('cruds.tratamientoRiesgo.fields.impacto') }}</label>
                <input class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" type="text" name="impacto" id="impacto" value="{{ old('impacto', $tratamientoRiesgo->impacto) }}">
                @if($errors->has('impacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('impacto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.impacto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nivelriesgoresidual">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgoresidual') ? 'is-invalid' : '' }}" type="text" name="nivelriesgoresidual" id="nivelriesgoresidual" value="{{ old('nivelriesgoresidual', $tratamientoRiesgo->nivelriesgoresidual) }}">
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



@endsection