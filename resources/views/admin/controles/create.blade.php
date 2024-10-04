@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Control </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.controles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="numero"><i
                            class="fas fa-list-ol iconos-crear"></i>{{ trans('cruds.controle.fields.numero') }}</label>
                    <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text"
                        name="numero" id="numero" value="{{ old('numero', '') }}">
                    @if ($errors->has('numero'))
                        <div class="invalid-feedback">
                            {{ $errors->first('numero') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.controle.fields.numero_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="control"><i
                            class="fab fa-empire iconos-crear"></i>{{ trans('cruds.controle.fields.control') }}</label>
                    <input class="form-control {{ $errors->has('control') ? 'is-invalid' : '' }}" type="text"
                        name="control" id="control" value="{{ old('control', '') }}">
                    @if ($errors->has('control'))
                        <div class="invalid-feedback">
                            {{ $errors->first('control') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.controle.fields.control_helper') }}</span>
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
