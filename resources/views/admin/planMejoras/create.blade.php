@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Plan de Implementación </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.plan-mejoras.store') }}" enctype="multipart/form-data" class="row">
                @csrf
                <div class="form-group col-12">
                    <label for="mejora_id"><i
                            class="fas fa-thumbs-up iconos-crear"></i>{{ trans('cruds.planMejora.fields.mejora') }}</label>
                    <select class="form-control select2 {{ $errors->has('mejora') ? 'is-invalid' : '' }}" name="mejora_id"
                        id="mejora_id">
                        @foreach ($mejoras as $id => $mejora)
                            <option value="{{ $id }}" {{ old('mejora_id') == $id ? 'selected' : '' }}>
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
                <div class="form-group col-12">
                    <label for="descripcion"><i
                            class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.planMejora.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.descripcion_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="responsable_id"><i
                            class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.planMejora.fields.responsable') }}</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="responsable_id" id="responsable_id">
                        @foreach ($responsables as $id => $responsable)
                            <option value="{{ $id }}" {{ old('responsable_id') == $id ? 'selected' : '' }}>
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
                <div class="form-group col-md-6">
                    <label for="fecha_compromiso"><i
                            class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planMejora.fields.fecha_compromiso') }}</label>
                    <input class="form-control date {{ $errors->has('fecha_compromiso') ? 'is-invalid' : '' }}"
                        type="text" name="fecha_compromiso" id="fecha_compromiso" value="{{ old('fecha_compromiso') }}">
                    @if ($errors->has('fecha_compromiso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_compromiso') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.fecha_compromiso_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.planMejora.fields.estatus') }}</label>
                    <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus"
                        id="estatus">
                        <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\PlanMejora::ESTATUS_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('estatus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('estatus'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estatus') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planMejora.fields.estatus_helper') }}</span>
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
