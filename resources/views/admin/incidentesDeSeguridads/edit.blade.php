@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.incidentes-de-seguridads.create') }}

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Incidentes de Seguridad </h3>
        </div>

        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.incidentes-de-seguridads.update', [$incidentesDeSeguridad->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-12">
                    <label class="required" for="folio"><i
                            class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.incidentesDeSeguridad.fields.folio') }}</label>
                    <input class="form-control {{ $errors->has('folio') ? 'is-invalid' : '' }}" type="text"
                        name="folio" id="folio" value="{{ old('folio', $incidentesDeSeguridad->folio) }}" required>
                    @if ($errors->has('folio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('folio') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.folio_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="resumen"><i
                            class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.incidentesDeSeguridad.fields.resumen') }}</label>
                    <textarea class="form-control {{ $errors->has('resumen') ? 'is-invalid' : '' }}" name="resumen" id="resumen">{{ old('resumen', $incidentesDeSeguridad->resumen) }}</textarea>
                    @if ($errors->has('resumen'))
                        <div class="invalid-feedback">
                            {{ $errors->first('resumen') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.resumen_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label><i
                            class="fas fa-sitemap iconos-crear"></i>{{ trans('cruds.incidentesDeSeguridad.fields.prioridad') }}</label>
                    <select class="form-control {{ $errors->has('prioridad') ? 'is-invalid' : '' }}" name="prioridad"
                        id="prioridad">
                        <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\IncidentesDeSeguridad::PRIORIDAD_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('prioridad', $incidentesDeSeguridad->prioridad) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('prioridad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('prioridad') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.prioridad_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="fechaocurrencia"><i
                            class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.incidentesDeSeguridad.fields.fechaocurrencia') }}</label>
                    <input class="form-control date {{ $errors->has('fechaocurrencia') ? 'is-invalid' : '' }}"
                        type="text" name="fechaocurrencia" id="fechaocurrencia"
                        value="{{ old('fechaocurrencia', $incidentesDeSeguridad->fechaocurrencia) }}">
                    @if ($errors->has('fechaocurrencia'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechaocurrencia') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.fechaocurrencia_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="activos"><i
                            class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.incidentesDeSeguridad.fields.activo') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                            style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('activos') ? 'is-invalid' : '' }}" name="activos[]"
                        id="activos" multiple>
                        @foreach ($activos as $id => $activo)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('activos', [])) || $incidentesDeSeguridad->activos->contains($id) ? 'selected' : '' }}>
                                {{ $activo }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('activos'))
                        <div class="invalid-feedback">
                            {{ $errors->first('activos') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.activo_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="clasificacion"><i
                            class="fas fa-list-ul iconos-crear"></i>{{ trans('cruds.incidentesDeSeguridad.fields.clasificacion') }}</label>
                    <input class="form-control {{ $errors->has('clasificacion') ? 'is-invalid' : '' }}" type="text"
                        name="clasificacion" id="clasificacion"
                        value="{{ old('clasificacion', $incidentesDeSeguridad->clasificacion) }}">
                    @if ($errors->has('clasificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('clasificacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.clasificacion_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="estado_id"><i
                            class="fas fa-signal iconos-crear"></i>{{ trans('cruds.incidentesDeSeguridad.fields.estado') }}</label>
                    <select class="form-control select2 {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado_id"
                        id="estado_id">
                        @foreach ($estados as $id => $estado)
                            <option value="{{ $id }}"
                                {{ (old('estado_id') ? old('estado_id') : $incidentesDeSeguridad->estado->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $estado }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('estado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estado') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.incidentesDeSeguridad.fields.estado_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
