@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.gapTre.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.gap-tres.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="pregunta">{{ trans('cruds.gapTre.fields.pregunta') }}</label>
                    <input class="form-control {{ $errors->has('pregunta') ? 'is-invalid' : '' }}" type="text"
                        name="pregunta" id="pregunta" value="{{ old('pregunta', '') }}">
                    @if ($errors->has('pregunta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pregunta') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapTre.fields.pregunta_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.gapTre.fields.valoracion') }}</label>
                    <select class="form-control {{ $errors->has('valoracion') ? 'is-invalid' : '' }}" name="valoracion"
                        id="valoracion">
                        <option value disabled {{ old('valoracion', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\GapTre::VALORACION_SELECT as $key => $label)
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
                    <span class="help-block">{{ trans('cruds.gapTre.fields.valoracion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="evidencia">{{ trans('cruds.gapTre.fields.evidencia') }}</label>
                    <input class="form-control {{ $errors->has('evidencia') ? 'is-invalid' : '' }}" type="text"
                        name="evidencia" id="evidencia" value="{{ old('evidencia', '') }}">
                    @if ($errors->has('evidencia'))
                        <div class="invalid-feedback">
                            {{ $errors->first('evidencia') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapTre.fields.evidencia_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="recomendacion">{{ trans('cruds.gapTre.fields.recomendacion') }}</label>
                    <input class="form-control {{ $errors->has('recomendacion') ? 'is-invalid' : '' }}" type="text"
                        name="recomendacion" id="recomendacion" value="{{ old('recomendacion', '') }}">
                    @if ($errors->has('recomendacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('recomendacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gapTre.fields.recomendacion_helper') }}</span>
                </div>
                <div class="form-group">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
