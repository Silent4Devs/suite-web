@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.auditoria-anuals.create') }}
<h5 class="col-12 titulo_general_funcion">Registrar: Programa Anual de Auditoría</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.auditoria-anuals.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-md-6">
                <label class="required"><i class="fas fa-list iconos-crear"></i>{{ trans('cruds.auditoriaAnual.fields.tipo') }}</label>
                <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo" required>
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
            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="fechainicio"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de inicio</label>
                <input class="form-control {{ $errors->has('fechainicio') ? 'is-invalid' : '' }}" type="datetime-local" name="fechainicio" id="fechainicio" value="{{ old('fechainicio') }}">
                @if($errors->has('fechainicio'))
                <div class="invalid-feedback">
                    {{ $errors->first('fechainicio') }}
                </div>
                @endif
            </div>

            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="fechafin"> <i class="far fa-calendar-alt iconos-crear"></i>Fecha fin</label>
                <input class="form-control {{ $errors->has('fechafin') ? 'is-invalid' : '' }}" type="datetime-local" name="fechafin" id="fechafin" value="{{ old('fechafin') }}">
                @if($errors->has('fechafin'))
                <div class="invalid-feedback">
                    {{ $errors->first('fechafin') }}
                </div>
                @endif
            </div>

            {{-- <div class="form-group col-md-6">
                <label for="auditorlider_id"><i class="fas fa-user-tie iconos-crear"></i>{{ trans('cruds.auditoriaAnual.fields.auditorlider') }}</label>
                <select class="form-control select2 {{ $errors->has('auditorlider') ? 'is-invalid' : '' }}" name="auditorlider_id" id="auditorlider_id">
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
            </div> --}}


            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="auditorlider_id"><i class="fas fa-user-tie iconos-crear"></i>Auditor(a) líder</label>
                <select class="form-control  {{ $errors->has('auditorlider_id') ? 'is-invalid' : '' }}"
                    name="auditorlider_id" id="auditorlider_id">
                    <option value="">Seleccione una opción</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}">
                            {{ $empleado->name }}
                        </option>

                    @endforeach
                </select>
                @if ($errors->has(' id_asignada'))
                    <div class="invalid-feedback">
                        {{ $errors->first(' id_asignada') }}
                    </div>
                @endif
            </div>


            <div class="form-group col-12">
                <label for="observaciones"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.auditoriaAnual.fields.observaciones') }}</label>
                <textarea class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
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
