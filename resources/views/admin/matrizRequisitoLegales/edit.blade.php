@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }}

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px">
         <h3 class="mb-1 text-center text-white"><strong>Editar:</strong> Matriz de Requisitos Legales  </h3>
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.matriz-requisito-legales.update", [$matrizRequisitoLegale->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-12">
                <label class="required" for="nombrerequisito"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.nombrerequisito') }}</label>
                <input class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }}" type="text" name="nombrerequisito" id="nombrerequisito" value="{{ old('nombrerequisito', $matrizRequisitoLegale->nombrerequisito) }}" required>
                @if($errors->has('nombrerequisito'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombrerequisito') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.nombrerequisito_helper') }}</span>
            </div>
            <div class="form-group col-sm-3">
                <label for="fechaexpedicion"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion') }}</label>
                <input class="form-control date {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }}" type="text" name="fechaexpedicion" id="fechaexpedicion" value="{{ old('fechaexpedicion', $matrizRequisitoLegale->fechaexpedicion) }}">
                @if($errors->has('fechaexpedicion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechaexpedicion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span>
            </div>
            <div class="form-group col-sm-3">
                <label for="fechavigor"> <i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}</label>
                <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }}" type="text" name="fechavigor" id="fechavigor" value="{{ old('fechavigor', $matrizRequisitoLegale->fechavigor) }}">
                @if($errors->has('fechavigor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechavigor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor_helper') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label for="requisitoacumplir"> <i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir') }}</label>
                <input class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }}" type="text" name="requisitoacumplir" id="requisitoacumplir" value="{{ old('requisitoacumplir', $matrizRequisitoLegale->requisitoacumplir) }}">
                @if($errors->has('requisitoacumplir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requisitoacumplir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir_helper') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label> <i class="fas fa-question-circle iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.cumplerequisito') }}</label>
                <select class="form-control {{ $errors->has('cumplerequisito') ? 'is-invalid' : '' }}" name="cumplerequisito" id="cumplerequisito">
                    <option value disabled {{ old('cumplerequisito', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('cumplerequisito', $matrizRequisitoLegale->cumplerequisito) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('cumplerequisito'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cumplerequisito') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.cumplerequisito_helper') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label for="formacumple"><i class="fas fa-question-circle iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.formacumple') }}</label>
                <input class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }}" type="text" name="formacumple" id="formacumple" value="{{ old('formacumple', $matrizRequisitoLegale->formacumple) }}">
                @if($errors->has('formacumple'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formacumple') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.formacumple_helper') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label for="periodicidad_cumplimiento"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.periodicidad_cumplimiento') }}</label>
                <input class="form-control {{ $errors->has('periodicidad_cumplimiento') ? 'is-invalid' : '' }}" type="text" name="periodicidad_cumplimiento" id="periodicidad_cumplimiento" value="{{ old('periodicidad_cumplimiento', $matrizRequisitoLegale->periodicidad_cumplimiento) }}">
                @if($errors->has('periodicidad_cumplimiento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('periodicidad_cumplimiento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.periodicidad_cumplimiento_helper') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label for="fechaverificacion"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.matrizRequisitoLegale.fields.fechaverificacion') }}</label>
                <input class="form-control date {{ $errors->has('fechaverificacion') ? 'is-invalid' : '' }}" type="text" name="fechaverificacion" id="fechaverificacion" value="{{ old('fechaverificacion', $matrizRequisitoLegale->fechaverificacion) }}">
                @if($errors->has('fechaverificacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechaverificacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaverificacion_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection