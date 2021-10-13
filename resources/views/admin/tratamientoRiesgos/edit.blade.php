@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.tratamiento-riesgos.create') }}

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Tratamiento de los Riesgos </h3>
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.tratamiento-riesgos.update", [$tratamientoRiesgo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
           <div class="form-group col-md-6">
                <label for="nivelriesgo"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', $tratamientoRiesgo->nivelriesgo) }}">
                @if($errors->has('nivelriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="control_id"><i class="fas fa-chart-area iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.control') }}</label>
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
           <div class="form-group col-12">
                <label for="acciones"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.acciones') }}</label>
                <textarea class="form-control {{ $errors->has('acciones') ? 'is-invalid' : '' }}" name="acciones" id="acciones">{{ old('acciones', $tratamientoRiesgo->acciones) }}</textarea>
                @if($errors->has('acciones'))
                    <div class="invalid-feedback">
                        {{ $errors->first('acciones') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.acciones_helper') }}</span>
            </div>
            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                <label for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Revisó</label>
                <select class="form-control {{ $errors->has('id_reviso') ? 'is-invalid' : '' }}" name="id_reviso"
                    id="id_reviso">
                    @foreach ($empleados as $id => $empleado)
                        <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                            data-area="{{ $empleado->area->area }}"
                            {{ old('id_reviso', $tratamientoRiesgo->id_reviso) == $empleado->id ? 'selected' : '' }}>

                            {{ $empleado->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('empleados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('empleados') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6 col-sm-12 col-lg-6">
                <label for="fechacompromiso"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de entrada en vigor</label>
                <input class="form-control {{ $errors->has('fechavigor') ? 'is-invalid' : '' }}"
                    type="date" name="fechacompromiso" id="fechacompromiso"
                    value="{{ old('fechacompromiso',\Carbon\Carbon::parse($tratamientoRiesgo->fechacompromiso))->format('Y-m-d') }}">
                @if ($errors->has('fechacompromiso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechacompromiso') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}</label>
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
            <div class="form-group col-md-6">
                <label for="estatus"><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.estatus') }}</label>
                <input class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" type="text" name="estatus" id="estatus" value="{{ old('estatus', $tratamientoRiesgo->estatus) }}">
                @if($errors->has('estatus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="probabilidad"><i class="fas fa-percentage iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}</label>
                <input class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', $tratamientoRiesgo->probabilidad) }}">
                @if($errors->has('probabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('probabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.probabilidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="impacto"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.impacto') }}</label>
                <input class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" type="text" name="impacto" id="impacto" value="{{ old('impacto', $tratamientoRiesgo->impacto) }}">
                @if($errors->has('impacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('impacto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.impacto_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="nivelriesgoresidual"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgoresidual') ? 'is-invalid' : '' }}" type="text" name="nivelriesgoresidual" id="nivelriesgoresidual" value="{{ old('nivelriesgoresidual', $tratamientoRiesgo->nivelriesgoresidual) }}">
                @if($errors->has('nivelriesgoresidual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgoresidual') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual_helper') }}</span>
            </div>
            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
