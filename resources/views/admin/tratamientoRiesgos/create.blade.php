@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.tratamiento-riesgos.create') }}
<h5 class="col-12 titulo_general_funcion">Registrar: Tratamiento de los Riesgos</h5>
<div class="card mt-4">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.tratamiento-riesgos.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            {{-- <div class="form-group col-md-6">
                <label for="nivelriesgo"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', '') }}">
                @if($errors->has('nivelriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo_helper') }}</span>
            </div> --}}
            
            <div class="row">
                <div class="form-group col-md-12 mb-12">
                    <label for="validationServer01"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                    <input type="number" class="form-control" name="identificador" id="identificador">
                    <div id="identificadorDisponible">
                    </div>
                </div>
            </div>

           
            <div class="col-md-12">
                <label for="acciones_tratamiento"><i class="fas fa-chart-bar iconos-crear"></i>Acciones de Tratamiento</label> 
                <textarea class="form-control"></textarea>
                @if($errors->has('acciones_tratamiento'))
                <div class="invalid-feedback">
                    {{ $errors->first('acciones_tratamiento') }}
                </div>
                @endif
            </div>
            <div class="col-md-12">
                <label for="acciones_tratamiento"><i class="fas fa-chart-bar iconos-crear"></i>Proceso</label> 
                <textarea class="form-control"></textarea>
                @if($errors->has('acciones_tratamiento'))
                <div class="invalid-feedback">
                    {{ $errors->first('acciones_tratamiento') }}
                </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="control_id"><i class="fas fa-chart-area iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.control') }}</label>
                <select class="form-control select2 {{ $errors->has('control') ? 'is-invalid' : '' }}" name="control_id" id="control_id">
                    @foreach($controls as $id => $control)
                        <option value="{{ $control->id }}" {{ old('control_id') == $id ? 'selected' : '' }}>{{ $control->anexo_indice }} {{ $control->anexo_politica }}</option>
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
                <textarea class="form-control {{ $errors->has('acciones') ? 'is-invalid' : '' }}" name="acciones" id="acciones">{{ old('acciones') }}</textarea>
                @if($errors->has('acciones'))
                    <div class="invalid-feedback">
                        {{ $errors->first('acciones') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.acciones_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                <select class="form-control {{ $errors->has('reviso') ? 'is-invalid' : '' }}" name="id_reviso" id="id_reviso">
                    @foreach ($empleados as $empleado)
                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}" data-area="{{ $empleado->area->area }}">

                        {{ $empleado->name }}
                    </option>

                    @endforeach
                </select>
                @if ($errors->has('empleados'))
                <div class="invalid-feedback">
                    {{ $errors->first('id_reviso') }}
                </div>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="fechacompromiso"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.fechacompromiso') }}</label>
                <input class="form-control {{ $errors->has('fechacompromiso') ? 'is-invalid' : '' }}" type="date" name="fechacompromiso" id="fechacompromiso" value="{{ old('fechacompromiso') }}">
                @if($errors->has('fechacompromiso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechacompromiso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.fechacompromiso_helper') }}</span>
            </div>

            <div class="form-group col-md-6">
                <label><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}</label>
                <select class="form-control {{ $errors->has('prioridad') ? 'is-invalid' : '' }}" name="prioridad" id="prioridad">
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
            <div class="form-group col-md-6">
                <label for="estatus"><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.estatus') }}</label>
                <input class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" type="text" name="estatus" id="estatus" value="{{ old('estatus', '') }}">
                @if($errors->has('estatus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="probabilidad"><i class="fas fa-percentage iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}</label>
                <input class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', '') }}">
                @if($errors->has('probabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('probabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.probabilidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="impacto"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.impacto') }}</label>
                <input class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" type="text" name="impacto" id="impacto" value="{{ old('impacto', '') }}">
                @if($errors->has('impacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('impacto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.impacto_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="nivelriesgoresidual"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgoresidual') ? 'is-invalid' : '' }}" type="text" name="nivelriesgoresidual" id="nivelriesgoresidual" value="{{ old('nivelriesgoresidual', '') }}">
                @if($errors->has('nivelriesgoresidual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgoresidual') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
