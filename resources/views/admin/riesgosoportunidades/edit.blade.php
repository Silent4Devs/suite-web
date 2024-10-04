@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.riesgosoportunidades.create') }}

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Riesgos y Oportunidades </h3>
        </div>

        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.riesgosoportunidades.update', [$riesgosoportunidade->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-md-6">
                    <label for="control_id"><i
                            class="fas fa-layer-group iconos-crear"></i>{{ trans('cruds.riesgosoportunidade.fields.control') }}</label>
                    <select class="form-control select2 {{ $errors->has('control') ? 'is-invalid' : '' }}" name="control_id"
                        id="control_id">
                        @foreach ($controls as $id => $control)
                            <option value="{{ $id }}"
                                {{ (old('control_id') ? old('control_id') : $riesgosoportunidade->control->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $control }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('control'))
                        <div class="invalid-feedback">
                            {{ $errors->first('control') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.riesgosoportunidade.fields.control_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label><i
                            class="fas fa-sitemap iconos-crear"></i>{{ trans('cruds.riesgosoportunidade.fields.aplicaorganizacion') }}</label>
                    <select class="form-control {{ $errors->has('aplicaorganizacion') ? 'is-invalid' : '' }}"
                        name="aplicaorganizacion" id="aplicaorganizacion">
                        <option value disabled {{ old('aplicaorganizacion', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Riesgosoportunidade::APLICAORGANIZACION_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('aplicaorganizacion', $riesgosoportunidade->aplicaorganizacion) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('aplicaorganizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('aplicaorganizacion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.riesgosoportunidade.fields.aplicaorganizacion_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="justificacion"><i
                            class="far fa-file iconos-crear"></i>{{ trans('cruds.riesgosoportunidade.fields.justificacion') }}</label>
                    <textarea class="form-control {{ $errors->has('justificacion') ? 'is-invalid' : '' }}" name="justificacion"
                        id="justificacion">{{ old('justificacion', $riesgosoportunidade->justificacion) }}</textarea>
                    @if ($errors->has('justificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('justificacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.riesgosoportunidade.fields.justificacion_helper') }}</span>
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
