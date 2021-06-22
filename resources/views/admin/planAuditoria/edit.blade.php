@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.plan-auditoria.create') }}

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Plan de Auditoría  </h3>
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.plan-auditoria.update", [$planAuditorium->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-12">
                <label for="fecha_id"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.fecha') }}</label>
                <select class="form-control select2 {{ $errors->has('fecha') ? 'is-invalid' : '' }}" name="fecha_id" id="fecha_id">
                    @foreach($fechas as $id => $fecha)
                        <option value="{{ $id }}" {{ (old('fecha_id') ? old('fecha_id') : $planAuditorium->fecha->id ?? '') == $id ? 'selected' : '' }}>{{ $fecha }}</option>
                    @endforeach
                </select>
                @if($errors->has('fecha'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.fecha_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="objetivo"><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.objetivo') }}</label>
                <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" name="objetivo" id="objetivo">{{ old('objetivo', $planAuditorium->objetivo) }}</textarea>
                @if($errors->has('objetivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.objetivo_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="alcance"><i class="far fa-chart-line iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.alcance') }}</label>
                <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" name="alcance" id="alcance">{{ old('alcance', $planAuditorium->alcance) }}</textarea>
                @if($errors->has('alcance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alcance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.alcance_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="criterios"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.criterios') }}</label>
                <textarea class="form-control {{ $errors->has('criterios') ? 'is-invalid' : '' }}" name="criterios" id="criterios">{{ old('criterios', $planAuditorium->criterios) }}</textarea>
                @if($errors->has('criterios'))
                    <div class="invalid-feedback">
                        {{ $errors->first('criterios') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.criterios_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="documentoauditar"><i class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.documentoauditar') }}</label>
                <textarea class="form-control {{ $errors->has('documentoauditar') ? 'is-invalid' : '' }}" name="documentoauditar" id="documentoauditar">{{ old('documentoauditar', $planAuditorium->documentoauditar) }}</textarea>
                @if($errors->has('documentoauditar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documentoauditar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.documentoauditar_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="equipoauditor"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.equipoauditor') }}</label>
                <input class="form-control {{ $errors->has('equipoauditor') ? 'is-invalid' : '' }}" type="text" name="equipoauditor" id="equipoauditor" value="{{ old('equipoauditor', $planAuditorium->equipoauditor) }}">
                @if($errors->has('equipoauditor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('equipoauditor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.equipoauditor_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="auditados"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.auditados') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('auditados') ? 'is-invalid' : '' }}" name="auditados[]" id="auditados" multiple>
                    @foreach($auditados as $id => $auditados)
                        <option value="{{ $id }}" {{ (in_array($id, old('auditados', [])) || $planAuditorium->auditados->contains($id)) ? 'selected' : '' }}>{{ $auditados }}</option>
                    @endforeach
                </select>
                @if($errors->has('auditados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auditados') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.auditados_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="descripcion"><i class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $planAuditorium->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.descripcion_helper') }}</span>
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