@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.registromejoras.create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Registro de Mejora </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.registromejoras.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-md-6">
                    <label for="nombre_reporta_id"><i
                            class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.registromejora.fields.nombre_reporta') }}</label>
                    <select class="form-control select2 {{ $errors->has('nombre_reporta') ? 'is-invalid' : '' }}"
                        name="nombre_reporta_id" id="nombre_reporta_id">
                        @foreach ($nombre_reportas as $id => $nombre_reporta)
                            <option value="{{ $id }}" {{ old('nombre_reporta_id') == $id ? 'selected' : '' }}>
                                {{ $nombre_reporta }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('nombre_reporta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre_reporta') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.nombre_reporta_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombre"><i
                            class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.registromejora.fields.nombre') }}</label>
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                        name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.nombre_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label><i
                            class="fas fa-project-diagram iconos-crear"></i>{{ trans('cruds.registromejora.fields.prioridad') }}</label>
                    <select class="form-control {{ $errors->has('prioridad') ? 'is-invalid' : '' }}" name="prioridad"
                        id="prioridad">
                        <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Registromejora::PRIORIDAD_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('prioridad', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('prioridad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('prioridad') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.prioridad_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="clasificacion"><i
                            class="fas fa-project-diagram iconos-crear"></i>{{ trans('cruds.registromejora.fields.clasificacion') }}</label>
                    <input class="form-control {{ $errors->has('clasificacion') ? 'is-invalid' : '' }}" type="text"
                        name="clasificacion" id="clasificacion" value="{{ old('clasificacion', '') }}">
                    @if ($errors->has('clasificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('clasificacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.clasificacion_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="descripcion"><i
                            class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.registromejora.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.descripcion_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="responsableimplementacion_id"><i
                            class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.registromejora.fields.responsableimplementacion') }}</label>
                    <select
                        class="form-control select2 {{ $errors->has('responsableimplementacion') ? 'is-invalid' : '' }}"
                        name="responsableimplementacion_id" id="responsableimplementacion_id">
                        @foreach ($responsableimplementacions as $id => $responsableimplementacion)
                            <option value="{{ $id }}"
                                {{ old('responsableimplementacion_id') == $id ? 'selected' : '' }}>
                                {{ $responsableimplementacion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('responsableimplementacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsableimplementacion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.registromejora.fields.responsableimplementacion_helper') }}</span>
                </div>



                <div class="form-group col-12">
                    <label for="recursos"><i
                            class="fas fa-window-restore iconos-crear"></i>{{ trans('cruds.registromejora.fields.recursos') }}</label>
                    <textarea class="form-control {{ $errors->has('recursos') ? 'is-invalid' : '' }}" name="recursos" id="recursos">{{ old('recursos') }}</textarea>
                    @if ($errors->has('recursos'))
                        <div class="invalid-feedback">
                            {{ $errors->first('recursos') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.recursos_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="beneficios"><i
                            class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.registromejora.fields.beneficios') }}</label>
                    <textarea class="form-control {{ $errors->has('beneficios') ? 'is-invalid' : '' }}" name="beneficios" id="beneficios">{{ old('beneficios') }}</textarea>
                    @if ($errors->has('beneficios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('beneficios') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.beneficios_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="valida_id"><i
                            class="fas fa-thumbs-up iconos-crear"></i>{{ trans('cruds.registromejora.fields.valida') }}</label>
                    <select class="form-control select2 {{ $errors->has('valida') ? 'is-invalid' : '' }}" name="valida_id"
                        id="valida_id">
                        @foreach ($validas as $id => $valida)
                            <option value="{{ $id }}" {{ old('valida_id') == $id ? 'selected' : '' }}>
                                {{ $valida }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('valida'))
                        <div class="invalid-feedback">
                            {{ $errors->first('valida') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.registromejora.fields.valida_helper') }}</span>
                </div>
                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
