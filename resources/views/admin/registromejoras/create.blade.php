@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.registromejora.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.registromejoras.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre_reporta_id">{{ trans('cruds.registromejora.fields.nombre_reporta') }}</label>
                <select class="form-control select2 {{ $errors->has('nombre_reporta') ? 'is-invalid' : '' }}" name="nombre_reporta_id" id="nombre_reporta_id">
                    @foreach($nombre_reportas as $id => $nombre_reporta)
                        <option value="{{ $id }}" {{ old('nombre_reporta_id') == $id ? 'selected' : '' }}>{{ $nombre_reporta }}</option>
                    @endforeach
                </select>
                @if($errors->has('nombre_reporta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre_reporta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.nombre_reporta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nombre">{{ trans('cruds.registromejora.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                @if($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.registromejora.fields.prioridad') }}</label>
                <select class="form-control {{ $errors->has('prioridad') ? 'is-invalid' : '' }}" name="prioridad" id="prioridad">
                    <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Registromejora::PRIORIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('prioridad', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('prioridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prioridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.prioridad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clasificacion">{{ trans('cruds.registromejora.fields.clasificacion') }}</label>
                <input class="form-control {{ $errors->has('clasificacion') ? 'is-invalid' : '' }}" type="text" name="clasificacion" id="clasificacion" value="{{ old('clasificacion', '') }}">
                @if($errors->has('clasificacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clasificacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.clasificacion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.registromejora.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.descripcion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responsableimplementacion_id">{{ trans('cruds.registromejora.fields.responsableimplementacion') }}</label>
                <select class="form-control select2 {{ $errors->has('responsableimplementacion') ? 'is-invalid' : '' }}" name="responsableimplementacion_id" id="responsableimplementacion_id">
                    @foreach($responsableimplementacions as $id => $responsableimplementacion)
                        <option value="{{ $id }}" {{ old('responsableimplementacion_id') == $id ? 'selected' : '' }}>{{ $responsableimplementacion }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsableimplementacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsableimplementacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.responsableimplementacion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="participantes">{{ trans('cruds.registromejora.fields.participantes') }}</label>
                <textarea class="form-control {{ $errors->has('participantes') ? 'is-invalid' : '' }}" name="participantes" id="participantes">{{ old('participantes') }}</textarea>
                @if($errors->has('participantes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participantes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.participantes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="recursos">{{ trans('cruds.registromejora.fields.recursos') }}</label>
                <textarea class="form-control {{ $errors->has('recursos') ? 'is-invalid' : '' }}" name="recursos" id="recursos">{{ old('recursos') }}</textarea>
                @if($errors->has('recursos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recursos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.recursos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beneficios">{{ trans('cruds.registromejora.fields.beneficios') }}</label>
                <textarea class="form-control {{ $errors->has('beneficios') ? 'is-invalid' : '' }}" name="beneficios" id="beneficios">{{ old('beneficios') }}</textarea>
                @if($errors->has('beneficios'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beneficios') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.beneficios_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valida_id">{{ trans('cruds.registromejora.fields.valida') }}</label>
                <select class="form-control select2 {{ $errors->has('valida') ? 'is-invalid' : '' }}" name="valida_id" id="valida_id">
                    @foreach($validas as $id => $valida)
                        <option value="{{ $id }}" {{ old('valida_id') == $id ? 'selected' : '' }}>{{ $valida }}</option>
                    @endforeach
                </select>
                @if($errors->has('valida'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valida') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registromejora.fields.valida_helper') }}</span>
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