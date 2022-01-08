@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar:</h5>
    <div class="mt-4 card">


        <div class="card-body">
            <form method="POST" action="{{ route('admin.sedes.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="sede"><i
                                class="fas fa-building iconos-crear"></i>{{ trans('cruds.sede.fields.sede') }}</label>
                        <input class="form-control {{ $errors->has('sede') ? 'is-invalid' : '' }}" type="text" name="sede"
                            id="sede" value="{{ old('sede', '') }}" required>
                        @if ($errors->has('sede'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sede') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.sede.fields.sede_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="foto_sedes"> <i class="fas fa-images iconos-crear"></i>Fotografía de la Sede</label>
                                <input type="file"name="foto_sedes"
                                    class="form-control {{ $errors->has('foto_sedes') ? 'is-invalid' : '' }}"
                                     accept="image/*" value="{{ old('foto_sedes', '') }}">
                                     
                        @if ($errors->has('foto_sedes'))
                            <div class="invalid-feedback">
                                {{ $errors->first('foto_sedes') }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    <label class="required " for="direccion"><i class="fas fa-map-marker-alt iconos-crear"></i>
                        Dirección</label>
                    <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }} map-input" type="text"
                        name="direccion" id="direccion" value="{{ old('direccion', '') }}" required>
                    @if ($errors->has('direccion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('direccion') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="descripcion"><i
                            class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.sede.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.descripcion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="organizacion_id"><i class="fas fa-building iconos-crear"></i>Organización</label>
                    <select class="form-control select2 {{ $errors->has('organizacion') ? 'is-invalid' : '' }}"
                        name="organizacion_id" id="organizacion_id">
                        @foreach ($organizacions as $id => $organizacion)
                            <option value="{{ $id }}" {{ old('organizacion_id') == $id ? 'selected' : '' }}>
                                {{ $organizacion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('organizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('organizacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
                </div>
                <div class="text-right form-group col-12" style="margin-left:15px;">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection

