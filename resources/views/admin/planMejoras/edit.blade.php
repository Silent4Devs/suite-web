@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.planMejora.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.plan-mejoras.update', [$planMejora->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="mejora_id">{{ trans('cruds.planMejora.fields.mejora') }}</label>
                    <select class="form-control select2 {{ $errors->has('mejora') ? 'is-invalid' : '' }}" name="mejora_id"
                        id="mejora_id">
                        @foreach ($mejoras as $id => $mejora)
                            <option value="{{ $id }}"
                                {{ (old('mejora_id') ? old('mejora_id') : $planMejora->mejora->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $mejora }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('mejora'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mejora') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.mejora_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="descripcion">{{ trans('cruds.planMejora.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion', $planMejora->descripcion) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.descripcion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="responsable_id">{{ trans('cruds.planMejora.fields.responsable') }}</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="responsable_id" id="responsable_id">
                        @foreach ($responsables as $id => $responsable)
                            <option value="{{ $id }}"
                                {{ (old('responsable_id') ? old('responsable_id') : $planMejora->responsable->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $responsable }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('responsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.responsable_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="fecha_compromiso">{{ trans('cruds.planMejora.fields.fecha_compromiso') }}</label>
                    <input class="form-control date {{ $errors->has('fecha_compromiso') ? 'is-invalid' : '' }}"
                        type="text" name="fecha_compromiso" id="fecha_compromiso"
                        value="{{ old('fecha_compromiso', $planMejora->fecha_compromiso) }}">
                    @if ($errors->has('fecha_compromiso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_compromiso') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.fecha_compromiso_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.planMejora.fields.estatus') }}</label>
                    <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus"
                        id="estatus">
                        <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\PlanMejora::ESTATUS_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('estatus', $planMejora->estatus) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('estatus'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estatus') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.estatus_helper') }}</span>
                </div>
                <div class="form-group">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
