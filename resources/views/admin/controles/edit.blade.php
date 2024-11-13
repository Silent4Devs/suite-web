@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.controle.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.controles.update', [$controle->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="numero">{{ trans('cruds.controle.fields.numero') }}</label>
                    <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text" name="numero"
                        id="numero" value="{{ old('numero', $controle->numero) }}">
                    @if ($errors->has('numero'))
                        <div class="invalid-feedback">
                            {{ $errors->first('numero') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.controle.fields.numero_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="control">{{ trans('cruds.controle.fields.control') }}</label>
                    <input class="form-control {{ $errors->has('control') ? 'is-invalid' : '' }}" type="text"
                        name="control" id="control" value="{{ old('control', $controle->control) }}">
                    @if ($errors->has('control'))
                        <div class="invalid-feedback">
                            {{ $errors->first('control') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.controle.fields.control_helper') }}</span>
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
