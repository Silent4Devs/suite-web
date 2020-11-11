@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.planAuditorium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.plan-auditoria.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fecha_id">{{ trans('cruds.planAuditorium.fields.fecha') }}</label>
                <select class="form-control select2 {{ $errors->has('fecha') ? 'is-invalid' : '' }}" name="fecha_id" id="fecha_id">
                    @foreach($fechas as $id => $fecha)
                        <option value="{{ $id }}" {{ old('fecha_id') == $id ? 'selected' : '' }}>{{ $fecha }}</option>
                    @endforeach
                </select>
                @if($errors->has('fecha'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.fecha_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objetivo">{{ trans('cruds.planAuditorium.fields.objetivo') }}</label>
                <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" name="objetivo" id="objetivo">{{ old('objetivo') }}</textarea>
                @if($errors->has('objetivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.objetivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alcance">{{ trans('cruds.planAuditorium.fields.alcance') }}</label>
                <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" name="alcance" id="alcance">{{ old('alcance') }}</textarea>
                @if($errors->has('alcance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alcance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.alcance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="criterios">{{ trans('cruds.planAuditorium.fields.criterios') }}</label>
                <textarea class="form-control {{ $errors->has('criterios') ? 'is-invalid' : '' }}" name="criterios" id="criterios">{{ old('criterios') }}</textarea>
                @if($errors->has('criterios'))
                    <div class="invalid-feedback">
                        {{ $errors->first('criterios') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.criterios_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="documentoauditar">{{ trans('cruds.planAuditorium.fields.documentoauditar') }}</label>
                <textarea class="form-control {{ $errors->has('documentoauditar') ? 'is-invalid' : '' }}" name="documentoauditar" id="documentoauditar">{{ old('documentoauditar') }}</textarea>
                @if($errors->has('documentoauditar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documentoauditar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.documentoauditar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="equipoauditor">{{ trans('cruds.planAuditorium.fields.equipoauditor') }}</label>
                <input class="form-control {{ $errors->has('equipoauditor') ? 'is-invalid' : '' }}" type="text" name="equipoauditor" id="equipoauditor" value="{{ old('equipoauditor', '') }}">
                @if($errors->has('equipoauditor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('equipoauditor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.equipoauditor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="auditados">{{ trans('cruds.planAuditorium.fields.auditados') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('auditados') ? 'is-invalid' : '' }}" name="auditados[]" id="auditados" multiple>
                    @foreach($auditados as $id => $auditados)
                        <option value="{{ $id }}" {{ in_array($id, old('auditados', [])) ? 'selected' : '' }}>{{ $auditados }}</option>
                    @endforeach
                </select>
                @if($errors->has('auditados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auditados') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.auditados_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.planAuditorium.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planAuditorium.fields.descripcion_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection