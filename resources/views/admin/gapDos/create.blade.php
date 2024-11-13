@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.gapDo.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.gap-dos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="anexo_indice">{{ trans('cruds.gapDo.fields.anexo_indice') }}</label>
                    <input class="form-control {{ $errors->has('anexo_indice') ? 'is-invalid' : '' }}" type="text"
                        name="anexo_indice" id="anexo_indice" value="{{ old('anexo_indice', '') }}">
                    @if ($errors->has('anexo_indice'))
                        <div class="invalid-feedback">
                            {{ $errors->first('anexo_indice') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapDo.fields.anexo_indice_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="control">{{ trans('cruds.gapDo.fields.control') }}</label>
                    <input class="form-control {{ $errors->has('control') ? 'is-invalid' : '' }}" type="text"
                        name="control" id="control" value="{{ old('control', '') }}">
                    @if ($errors->has('control'))
                        <div class="invalid-feedback">
                            {{ $errors->first('control') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapDo.fields.control_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="descripcion_control">{{ trans('cruds.gapDo.fields.descripcion_control') }}</label>
                    <input class="form-control {{ $errors->has('descripcion_control') ? 'is-invalid' : '' }}"
                        type="text" name="descripcion_control" id="descripcion_control"
                        value="{{ old('descripcion_control', '') }}">
                    @if ($errors->has('descripcion_control'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion_control') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapDo.fields.descripcion_control_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.gapDo.fields.valoracion') }}</label>
                    <select class="form-control {{ $errors->has('valoracion') ? 'is-invalid' : '' }}" name="valoracion"
                        id="valoracion">
                        <option value disabled {{ old('valoracion', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\GapDo::VALORACION_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('valoracion', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('valoracion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('valoracion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapDo.fields.valoracion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="evidencia">{{ trans('cruds.gapDo.fields.evidencia') }}</label>
                    <input class="form-control {{ $errors->has('evidencia') ? 'is-invalid' : '' }}" type="text"
                        name="evidencia" id="evidencia" value="{{ old('evidencia', '') }}">
                    @if ($errors->has('evidencia'))
                        <div class="invalid-feedback">
                            {{ $errors->first('evidencia') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapDo.fields.evidencia_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="recomendacion">{{ trans('cruds.gapDo.fields.recomendacion') }}</label>
                    <input class="form-control {{ $errors->has('recomendacion') ? 'is-invalid' : '' }}" type="text"
                        name="recomendacion" id="recomendacion" value="{{ old('recomendacion', '') }}">
                    @if ($errors->has('recomendacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('recomendacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapDo.fields.recomendacion_helper') }}</span>
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
