@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.auditoriaAnual.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.auditoria-anuals.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.auditoriaAnual.fields.tipo') }}</label>
                            <select class="form-control" name="tipo" id="tipo" required>
                                <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AuditoriaAnual::TIPO_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tipo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tipo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.tipo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fechainicio">{{ trans('cruds.auditoriaAnual.fields.fechainicio') }}</label>
                            <input class="form-control date" type="text" name="fechainicio" id="fechainicio" value="{{ old('fechainicio') }}">
                            @if($errors->has('fechainicio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechainicio') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.fechainicio_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dias">{{ trans('cruds.auditoriaAnual.fields.dias') }}</label>
                            <input class="form-control" type="number" name="dias" id="dias" value="{{ old('dias', '') }}" step="0.01" min="1" max="100">
                            @if($errors->has('dias'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dias') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.dias_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="auditorlider_id">{{ trans('cruds.auditoriaAnual.fields.auditorlider') }}</label>
                            <select class="form-control select2" name="auditorlider_id" id="auditorlider_id">
                                @foreach($auditorliders as $id => $auditorlider)
                                    <option value="{{ $id }}" {{ old('auditorlider_id') == $id ? 'selected' : '' }}>{{ $auditorlider }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('auditorlider'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('auditorlider') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.auditorlider_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="observaciones">{{ trans('cruds.auditoriaAnual.fields.observaciones') }}</label>
                            <textarea class="form-control" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
                            @if($errors->has('observaciones'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('observaciones') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.observaciones_helper') }}</span>
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