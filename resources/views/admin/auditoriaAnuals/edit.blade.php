@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.auditoria-anuals.create') }}
<h5 class="col-12 titulo_general_funcion">Editar: Programa Anual de Auditoría</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.auditoria-anuals.update", [$auditoriaAnual->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-md-6">
                <label class="required"><i class="fas fa-list iconos-crear"></i>{{ trans('cruds.auditoriaAnual.fields.tipo') }}</label>
                <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo" required>
                    <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AuditoriaAnual::TIPO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tipo', $auditoriaAnual->tipo) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                <label for="fechainicio"> <i class="fas fa-calendar-alt iconos-crear"></i>
                    Fecha
                    Inicio</label>
                <input class="form-control" type="datetime-local" id="fechainicio"
                    name="fechainicio"
                    value="{{ old('fechainicio', \Carbon\Carbon::parse($auditoriaAnual->fechainicio)->format('Y-m-d\TH:i')) }}">
                <span class="text-danger error_text fecha_curso_error"></span>
            </div>
            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                <label for="fechafin"> <i class="fas fa-calendar-alt iconos-crear"></i>
                    Fecha
                    Fin</label>
                <input class="form-control" type="datetime-local" id="fechafin"
                    name="fechafin"
                    value="{{ old('fechafin', \Carbon\Carbon::parse($auditoriaAnual->fechafin)->format('Y-m-d\TH:i')) }}">
                <span class="text-danger error_text fecha_curso_error"></span>
            </div>
            {{-- <div class="form-group col-md-6">
                <label for="dias"><i class="far fa-calendar-minus iconos-crear"></i>{{ trans('cruds.auditoriaAnual.fields.dias') }}</label>
                <input class="form-control {{ $errors->has('dias') ? 'is-invalid' : '' }}" type="number" name="dias" id="dias" value="{{ old('dias', $auditoriaAnual->dias) }}" step="0.01" min="1" max="100">
                @if($errors->has('dias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.dias_helper') }}</span>
            </div> --}}


            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="auditorlider_id"><i class="fas fa-user-tie iconos-crear"></i>Auditor(a) líder</label>
                <select class="form-control {{ $errors->has('auditorlider_id') ? 'is-invalid' : '' }}" name="auditorlider_id"
                    id="auditorlider_id">
                    <option value="">Seleccione una opción</option>
                    @foreach ($empleados as $id => $empleado)
                        <option value="{{ $empleado->id }}"
                            {{ old('auditorlider_id', $auditoriaAnual->auditorlider_id) == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('id_asignada'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_asignada') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
            </div>

            <div class="form-group col-12">
                <label for="observaciones"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.auditoriaAnual.fields.observaciones') }}</label>
                <textarea class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}" name="observaciones" id="observaciones">{{ old('observaciones', $auditoriaAnual->observaciones) }}</textarea>
                @if($errors->has('observaciones'))
                    <div class="invalid-feedback">
                        {{ $errors->first('observaciones') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.observaciones_helper') }}</span>
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
