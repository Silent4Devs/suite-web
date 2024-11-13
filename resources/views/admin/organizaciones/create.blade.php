@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Organización </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.organizaciones.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="organizacion"><i
                            class="fas fa-building iconos-crear"></i>{{ trans('cruds.organizacione.fields.organizacion') }}</label>
                    <input class="form-control {{ $errors->has('organizacion') ? 'is-invalid' : '' }}" type="text"
                        name="organizacion" id="organizacion" value="{{ old('organizacion', '') }}" required>
                    @if ($errors->has('organizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('organizacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacione.fields.organizacion_helper') }}</span>
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
