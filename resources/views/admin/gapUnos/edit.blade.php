@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.gapUno.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.gap-unos.update", [$gapUno->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="pregunta">{{ trans('cruds.gapUno.fields.pregunta') }}</label>
                <input class="form-control {{ $errors->has('pregunta') ? 'is-invalid' : '' }}" type="text" name="pregunta" id="pregunta" value="{{ old('pregunta', $gapUno->pregunta) }}">
                @if($errors->has('pregunta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pregunta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.gapUno.fields.pregunta_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.gapUno.fields.valoracion') }}</label>
                <select class="form-control {{ $errors->has('valoracion') ? 'is-invalid' : '' }}" name="valoracion" id="valoracion">
                    <option value disabled {{ old('valoracion', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\GapUno::VALORACION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('valoracion', $gapUno->valoracion) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('valoracion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valoracion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.gapUno.fields.valoracion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="evidencia">{{ trans('cruds.gapUno.fields.evidencia') }}</label>
                <input class="form-control {{ $errors->has('evidencia') ? 'is-invalid' : '' }}" type="text" name="evidencia" id="evidencia" value="{{ old('evidencia', $gapUno->evidencia) }}">
                @if($errors->has('evidencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('evidencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.gapUno.fields.evidencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="recomendacion">{{ trans('cruds.gapUno.fields.recomendacion') }}</label>
                <input class="form-control {{ $errors->has('recomendacion') ? 'is-invalid' : '' }}" type="text" name="recomendacion" id="recomendacion" value="{{ old('recomendacion', $gapUno->recomendacion) }}">
                @if($errors->has('recomendacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recomendacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.gapUno.fields.recomendacion_helper') }}</span>
            </div>
            <div class="form-group">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection