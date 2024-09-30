@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Estado Incidente</h3>
        </div>


        <div class="card-body">
            <form method="POST" action="{{ route('admin.estado-incidentes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="estado"><i
                            class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.estadoIncidente.fields.estado') }}</label>
                    <input class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" type="text"
                        name="estado" id="estado" value="{{ old('estado', '') }}" required>
                    @if ($errors->has('estado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estado') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.estadoIncidente.fields.estado_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
