@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.planificacion-controls.create') }}

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Planificación y Control  </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.planificacion-controls.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-12">
                <label class="required" for="activo"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.activo') }}</label>
                <input class="form-control {{ $errors->has('activo') ? 'is-invalid' : '' }}" type="text" name="activo" id="activo" value="{{ old('activo', '') }}" required>
                @if($errors->has('activo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('activo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.activo_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="descripcion"><i class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.descripcion_helper') }}</span>
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
                <label for="vulnerabilidad"><i class="fas fa-virus-slash iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.vulnerabilidad') }}</label>
                <input class="form-control {{ $errors->has('vulnerabilidad') ? 'is-invalid' : '' }}" type="text" name="vulnerabilidad" id="vulnerabilidad" value="{{ old('vulnerabilidad', '') }}">
                @if($errors->has('vulnerabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vulnerabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.vulnerabilidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="amenaza"><i class="fas fa-virus iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.amenaza') }}</label>
                <input class="form-control {{ $errors->has('amenaza') ? 'is-invalid' : '' }}" type="text" name="amenaza" id="amenaza" value="{{ old('amenaza', '') }}">
                @if($errors->has('amenaza'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amenaza') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.amenaza_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="confidencialidad"><i class="fas fa-key iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.confidencialidad') }}</label>
                <input class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}" type="text" name="confidencialidad" id="confidencialidad" value="{{ old('confidencialidad', '') }}">
                @if($errors->has('confidencialidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('confidencialidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.confidencialidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="integridad"><i class="fas fa-key iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.integridad') }}</label>
                <input class="form-control {{ $errors->has('integridad') ? 'is-invalid' : '' }}" type="text" name="integridad" id="integridad" value="{{ old('integridad', '') }}">
                @if($errors->has('integridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('integridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.integridad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="disponibilidad"><i class="far fa-clock iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.disponibilidad') }}</label>
                <input class="form-control {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}" type="text" name="disponibilidad" id="disponibilidad" value="{{ old('disponibilidad', '') }}">
                @if($errors->has('disponibilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disponibilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.disponibilidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="probabilidad"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.probabilidad') }}</label>
                <input class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', '') }}">
                @if($errors->has('probabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('probabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.probabilidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="impacto"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.impacto') }}</label>
                <input class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" type="text" name="impacto" id="impacto" value="{{ old('impacto', '') }}">
                @if($errors->has('impacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('impacto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.impacto_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="nivelriesgo"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.nivelriesgo') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', '') }}">
                @if($errors->has('nivelriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.nivelriesgo_helper') }}</span>
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