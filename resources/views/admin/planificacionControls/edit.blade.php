@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.planificacion-controls.create') }}
<h5 class="col-12 titulo_general_funcion">Editar: Planificación y Control</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.planificacion-controls.update", [$planificacionControl->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            {{-- <div class="form-group col-12">
                <label class="required" for="activo"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.activo') }}</label>
                <input class="form-control {{ $errors->has('activo') ? 'is-invalid' : '' }}" type="text" name="activo" id="activo" value="{{ old('activo', $planificacionControl->activo) }}" required>
                @if($errors->has('activo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('activo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.activo_helper') }}</span>
            </div> --}}
            
            <div class="form-group col-md-4 col-lg-4 col-sm-12 mt-3">
                <label for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Revisó</label>
                <select class="form-control {{ $errors->has('id_reviso') ? 'is-invalid' : '' }}" name="id_reviso"
                    id="id_reviso">
                    @foreach ($empleados as $id => $empleado)
                        <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                            data-area="{{ $empleado->area->area }}"
                            {{ old('id_reviso', $planificacionControl->id_reviso) == $empleado->id ? 'selected' : '' }}>

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

            <div class="form-group col-lg-4 col-md-4 col-sm-12 mt-3">
                <label><i class="fas fa-briefcase iconos-crear"></i>Puesto<sup>*</sup></label>
                <div class="form-control" id="reviso_puesto" readonly></div>
            </div>


            <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-3">
                <label><i class="fas fa-street-view iconos-crear"></i>Área<sup>*</sup></label>
                <div class="form-control" id="reviso_area" readonly></div>
            </div>


            <div class="form-group col-md-4 col-sm-12">
                <label for="id_amenaza" class="required"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
                <select class="procesoSelect form-control" name="id_amenaza" id="id_amenaza">
                    <option value="">Seleccione una opción</option>
                    @foreach ($amenazas as $amenaza)
                        <option {{ old('id_amenaza') == $amenaza->id ? ' selected="selected"' : '' }}
                            value="{{ $amenaza->id }}">{{ $amenaza->nombre }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('id_amenaza'))
                    <span class="text-danger"> {{ $errors->first('id_amenaza') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4 col-sm-12">
                <label for="id_vulnerabilidad" class="required"><i
                        class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
                <select class="procesoSelect form-control" name="id_vulnerabilidad" id="id_vulnerabilidad">
                    <option value="">Seleccione una opción</option>
                    @foreach ($vulnerabilidades as $vulnerabilidad)
                        <option {{ old('id_vulnerabilidad') == $vulnerabilidad->id ? ' selected="selected"' : '' }}
                            value="{{ $vulnerabilidad->id }}">{{ $vulnerabilidad->nombre }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('id_vulnerabilidad'))
                    <span class="text-danger"> {{ $errors->first('id_vulnerabilidad') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4 col-sm-12">
                <label for="activo_id"  class="required"><i class="fas fa-user-tie iconos-crear"></i>Activo (subcategoría)</label><br>
                <select class="responsableSelect form-control" name="activo_id" id="activo_id">
                    <option value="">Seleccione una opción</option>
                    @foreach ($activos as $activo)
                        <option {{old('activo_id') == $activo->id ? ' selected="selected"' : ''}} value="{{ $activo->id }}">{{ $activo->subcategoria }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('activo_id'))
                <span class="text-danger"> {{ $errors->first('activo_id') }}</span>
                @endif
            </div>
            
            <div class="form-group col-sm-3">
                <div class="custom-control custom-checkbox">
                    <input type="hidden" name="confidencialidad" value="off">
                    <input type="checkbox" class="custom-control-input" id="confidencialidad"
                        name="confidencialidad"
                        {{ old('confidencialidad', $planificacionControl->confidencialidad) == 'on' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="confidencialidad"><i
                            class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                </div>

                @if ($errors->has('confidencialidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('confidencialidad') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-sm-3">
                <div class="custom-control custom-checkbox">
                    <input type="hidden" name="integridad" value="off">
                    <input type="checkbox" class="custom-control-input" id="integridad" name="integridad"
                        {{ old('integridad', $planificacionControl->integridad) == 'on' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="integridad"><i
                            class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                </div>
                @if ($errors->has('integridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('integridad') }}
                    </div>
                @endif
            </div>

            


            <div class="form-group col-md-6">
                <label for="probabilidad"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.probabilidad') }}</label>
                <input class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', $planificacionControl->probabilidad) }}">
                @if($errors->has('probabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('probabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.probabilidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="impacto"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.impacto') }}</label>
                <input class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" type="text" name="impacto" id="impacto" value="{{ old('impacto', $planificacionControl->impacto) }}">
                @if($errors->has('impacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('impacto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.impacto_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="nivelriesgo"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.nivelriesgo') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', $planificacionControl->nivelriesgo) }}">
                @if($errors->has('nivelriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.nivelriesgo_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="descripcion"><i class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $planificacionControl->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.descripcion_helper') }}</span>
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
