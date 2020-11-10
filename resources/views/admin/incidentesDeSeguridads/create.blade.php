@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.incidentesDeSeguridad.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incidentes-de-seguridads.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="folio">{{ trans('cruds.incidentesDeSeguridad.fields.folio') }}</label>
                <input class="form-control {{ $errors->has('folio') ? 'is-invalid' : '' }}" type="text" name="folio" id="folio" value="{{ old('folio', '') }}" required>
                @if($errors->has('folio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('folio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.folio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="resumen">{{ trans('cruds.incidentesDeSeguridad.fields.resumen') }}</label>
                <textarea class="form-control {{ $errors->has('resumen') ? 'is-invalid' : '' }}" name="resumen" id="resumen">{{ old('resumen') }}</textarea>
                @if($errors->has('resumen'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resumen') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.resumen_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.incidentesDeSeguridad.fields.prioridad') }}</label>
                <select class="form-control {{ $errors->has('prioridad') ? 'is-invalid' : '' }}" name="prioridad" id="prioridad">
                    <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\IncidentesDeSeguridad::PRIORIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('prioridad', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('prioridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prioridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.prioridad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fechaocurrencia">{{ trans('cruds.incidentesDeSeguridad.fields.fechaocurrencia') }}</label>
                <input class="form-control date {{ $errors->has('fechaocurrencia') ? 'is-invalid' : '' }}" type="text" name="fechaocurrencia" id="fechaocurrencia" value="{{ old('fechaocurrencia') }}">
                @if($errors->has('fechaocurrencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechaocurrencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.fechaocurrencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="activos">{{ trans('cruds.incidentesDeSeguridad.fields.activo') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('activos') ? 'is-invalid' : '' }}" name="activos[]" id="activos" multiple>
                    @foreach($activos as $id => $activo)
                        <option value="{{ $id }}" {{ in_array($id, old('activos', [])) ? 'selected' : '' }}>{{ $activo }}</option>
                    @endforeach
                </select>
                @if($errors->has('activos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('activos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.activo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clasificacion">{{ trans('cruds.incidentesDeSeguridad.fields.clasificacion') }}</label>
                <input class="form-control {{ $errors->has('clasificacion') ? 'is-invalid' : '' }}" type="text" name="clasificacion" id="clasificacion" value="{{ old('clasificacion', '') }}">
                @if($errors->has('clasificacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clasificacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.clasificacion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estado_id">{{ trans('cruds.incidentesDeSeguridad.fields.estado') }}</label>
                <select class="form-control select2 {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado_id" id="estado_id">
                    @foreach($estados as $id => $estado)
                        <option value="{{ $id }}" {{ old('estado_id') == $id ? 'selected' : '' }}>{{ $estado }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.estado_helper') }}</span>
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