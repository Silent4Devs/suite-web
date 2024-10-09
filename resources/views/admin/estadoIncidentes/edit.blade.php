@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Estado Incidente </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.estado-incidentes.update', [$estadoIncidente->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="estado">{{ trans('cruds.estadoIncidente.fields.estado') }}</label>
                    <input class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" type="text"
                        name="estado" id="estado" value="{{ old('estado', $estadoIncidente->estado) }}" required>
                    @if ($errors->has('estado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estado') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.estadoIncidente.fields.estado_helper') }}</span>
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
