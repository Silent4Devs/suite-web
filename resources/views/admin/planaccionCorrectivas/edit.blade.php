@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.planaccionCorrectiva.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.planaccion-correctivas.update', [$planaccionCorrectiva->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label
                        for="accioncorrectiva_id">{{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva') }}</label>
                    <select class="form-control select2 {{ $errors->has('accioncorrectiva') ? 'is-invalid' : '' }}"
                        name="accioncorrectiva_id" id="accioncorrectiva_id">
                        @foreach ($accioncorrectivas as $id => $accioncorrectiva)
                            <option value="{{ $id }}"
                                {{ (old('accioncorrectiva_id') ? old('accioncorrectiva_id') : $planaccionCorrectiva->accioncorrectiva->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $accioncorrectiva }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('accioncorrectiva'))
                        <div class="invalid-feedback">
                            {{ $errors->first('accioncorrectiva') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="actividad">{{ trans('cruds.planaccionCorrectiva.fields.actividad') }}</label>
                    <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}" type="text"
                        name="actividad" id="actividad" value="{{ old('actividad', $planaccionCorrectiva->actividad) }}"
                        required>
                    @if ($errors->has('actividad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('actividad') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.actividad_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="responsable_id">{{ trans('cruds.planaccionCorrectiva.fields.responsable') }}</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="responsable_id" id="responsable_id">
                        @foreach ($responsables as $id => $responsable)
                            <option value="{{ $id }}"
                                {{ (old('responsable_id') ? old('responsable_id') : $planaccionCorrectiva->responsable->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $responsable }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('responsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.responsable_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="fechacompromiso">{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}</label>
                    <input class="form-control date {{ $errors->has('fechacompromiso') ? 'is-invalid' : '' }}"
                        type="text" name="fechacompromiso" id="fechacompromiso"
                        value="{{ old('fechacompromiso', $planaccionCorrectiva->fechacompromiso) }}">
                    @if ($errors->has('fechacompromiso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechacompromiso') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.planaccionCorrectiva.fields.estatus') }}</label>
                    <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus"
                        id="estatus">
                        <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\PlanaccionCorrectiva::ESTATUS_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('estatus', $planaccionCorrectiva->estatus) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('estatus'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estatus') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.estatus_helper') }}</span>
                </div>
                <div class="form-group">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
