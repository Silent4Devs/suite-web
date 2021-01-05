@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong>Indicadores SGSI</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.indicadores-sgsis.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-md-6">
                <label class="required" for="control"><i class="fas fa-sitemap iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.control') }}</label>
                <input class="form-control {{ $errors->has('control') ? 'is-invalid' : '' }}" type="text" name="control" id="control" value="{{ old('control', '') }}" required>
                @if($errors->has('control'))
                    <div class="invalid-feedback">
                        {{ $errors->first('control') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.control_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="titulo"><i class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', '') }}">
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="responsable_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.responsable') }}</label>
                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}" name="responsable_id" id="responsable_id">
                    @foreach($responsables as $id => $responsable)
                        <option value="{{ $id }}" {{ old('responsable_id') == $id ? 'selected' : '' }}>{{ $responsable }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.responsable_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="formula"><i class="fas fa-square-root-alt iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.formula') }}</label>
                <textarea class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" name="formula" id="formula">{{ old('formula') }}</textarea>
                @if($errors->has('formula'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formula') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.formula_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label><i class="far fa-calendar-minus iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.frecuencia') }}</label>
                <select class="form-control {{ $errors->has('frecuencia') ? 'is-invalid' : '' }}" name="frecuencia" id="frecuencia">
                    <option value disabled {{ old('frecuencia', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\IndicadoresSgsi::FRECUENCIA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('frecuencia', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('frecuencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('frecuencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.frecuencia_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label><i class="fas fa-ruler-combined iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.unidadmedida') }}</label>
                <select class="form-control {{ $errors->has('unidadmedida') ? 'is-invalid' : '' }}" name="unidadmedida" id="unidadmedida">
                    <option value disabled {{ old('unidadmedida', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\IndicadoresSgsi::UNIDADMEDIDA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('unidadmedida', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('unidadmedida'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unidadmedida') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.unidadmedida_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="meta"><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.meta') }}</label>
                <input class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" type="text" name="meta" id="meta" value="{{ old('meta', '') }}">
                @if($errors->has('meta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.meta_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label><i class="fas fa-traffic-light iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.semaforo') }}</label>
                <select class="form-control {{ $errors->has('semaforo') ? 'is-invalid' : '' }}" name="semaforo" id="semaforo">
                    <option value disabled {{ old('semaforo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\IndicadoresSgsi::SEMAFORO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('semaforo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('semaforo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('semaforo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.semaforo_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="enero"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.enero') }}</label>
                <input class="form-control {{ $errors->has('enero') ? 'is-invalid' : '' }}" type="number" name="enero" id="enero" value="{{ old('enero', '') }}" step="0.01" max="100">
                @if($errors->has('enero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('enero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.enero_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="febrero"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.febrero') }}</label>
                <input class="form-control {{ $errors->has('febrero') ? 'is-invalid' : '' }}" type="number" name="febrero" id="febrero" value="{{ old('febrero', '') }}" step="0.01" max="100">
                @if($errors->has('febrero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('febrero') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.febrero_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="marzo"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.marzo') }}</label>
                <input class="form-control {{ $errors->has('marzo') ? 'is-invalid' : '' }}" type="number" name="marzo" id="marzo" value="{{ old('marzo', '') }}" step="0.01" max="100">
                @if($errors->has('marzo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marzo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.marzo_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="abril"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.abril') }}</label>
                <input class="form-control {{ $errors->has('abril') ? 'is-invalid' : '' }}" type="number" name="abril" id="abril" value="{{ old('abril', '') }}" step="0.01" max="100">
                @if($errors->has('abril'))
                    <div class="invalid-feedback">
                        {{ $errors->first('abril') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.abril_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="mayo"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.mayo') }}</label>
                <input class="form-control {{ $errors->has('mayo') ? 'is-invalid' : '' }}" type="number" name="mayo" id="mayo" value="{{ old('mayo', '') }}" step="0.01" max="100">
                @if($errors->has('mayo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mayo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.mayo_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="junio"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.junio') }}</label>
                <input class="form-control {{ $errors->has('junio') ? 'is-invalid' : '' }}" type="number" name="junio" id="junio" value="{{ old('junio', '') }}" step="0.01" max="100">
                @if($errors->has('junio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('junio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.junio_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="julio"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.julio') }}</label>
                <input class="form-control {{ $errors->has('julio') ? 'is-invalid' : '' }}" type="number" name="julio" id="julio" value="{{ old('julio', '') }}" step="0.01" max="100">
                @if($errors->has('julio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('julio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.julio_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="agosto"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.agosto') }}</label>
                <input class="form-control {{ $errors->has('agosto') ? 'is-invalid' : '' }}" type="number" name="agosto" id="agosto" value="{{ old('agosto', '') }}" step="0.01" max="100">
                @if($errors->has('agosto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agosto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.agosto_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="septiembre"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.septiembre') }}</label>
                <input class="form-control {{ $errors->has('septiembre') ? 'is-invalid' : '' }}" type="number" name="septiembre" id="septiembre" value="{{ old('septiembre', '') }}" step="0.01" max="100">
                @if($errors->has('septiembre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('septiembre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.septiembre_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="octubre"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.octubre') }}</label>
                <input class="form-control {{ $errors->has('octubre') ? 'is-invalid' : '' }}" type="number" name="octubre" id="octubre" value="{{ old('octubre', '') }}" step="0.01" max="100">
                @if($errors->has('octubre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('octubre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.octubre_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="noviembre"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.noviembre') }}</label>
                <input class="form-control {{ $errors->has('noviembre') ? 'is-invalid' : '' }}" type="number" name="noviembre" id="noviembre" value="{{ old('noviembre', '') }}" step="0.01" max="100">
                @if($errors->has('noviembre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('noviembre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.noviembre_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="diciembre"><i class="fas fa-calendar-week iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.diciembre') }}</label>
                <input class="form-control {{ $errors->has('diciembre') ? 'is-invalid' : '' }}" type="number" name="diciembre" id="diciembre" value="{{ old('diciembre', '') }}" step="0.01" max="100">
                @if($errors->has('diciembre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('diciembre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.diciembre_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="anio"><i class="fas fa-calendar iconos-crear"></i>{{ trans('cruds.indicadoresSgsi.fields.anio') }}</label>
                <input class="form-control {{ $errors->has('anio') ? 'is-invalid' : '' }}" type="text" name="anio" id="anio" value="{{ old('anio', '') }}">
                @if($errors->has('anio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.indicadoresSgsi.fields.anio_helper') }}</span>
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
