@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.carpetum.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.carpeta.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nombre">{{ trans('cruds.carpetum.fields.nombre') }}</label>
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                        id="nombre" value="{{ old('nombre', '') }}">
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.carpetum.fields.nombre_helper') }}</span>
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
