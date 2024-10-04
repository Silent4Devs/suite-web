@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Enlace a Ejecutar</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.enlaces-ejecutars.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ejecutar"><i
                            class="fas fa-cogs iconos-crear"></i>{{ trans('cruds.enlacesEjecutar.fields.ejecutar') }}</label>
                    <input class="form-control {{ $errors->has('ejecutar') ? 'is-invalid' : '' }}" type="text"
                        name="ejecutar" id="ejecutar" value="{{ old('ejecutar', '') }}">
                    @if ($errors->has('ejecutar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ejecutar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.enlacesEjecutar.fields.ejecutar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="descripcion"><i
                            class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.enlacesEjecutar.fields.descripcion') }}</label>
                    <input class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text"
                        name="descripcion" id="descripcion" value="{{ old('descripcion', '') }}">
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.enlacesEjecutar.fields.descripcion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="enlace"><i
                            class="fas fa-laptop-code iconos-crear"></i>{{ trans('cruds.enlacesEjecutar.fields.enlace') }}</label>
                    <input class="form-control {{ $errors->has('enlace') ? 'is-invalid' : '' }}" type="text"
                        name="enlace" id="enlace" value="{{ old('enlace', '') }}">
                    @if ($errors->has('enlace'))
                        <div class="invalid-feedback">
                            {{ $errors->first('enlace') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.enlacesEjecutar.fields.enlace_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
