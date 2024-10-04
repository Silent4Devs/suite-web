@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Organización</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.organizaciones.update', [$organizacione->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="organizacion">{{ trans('cruds.organizacione.fields.organizacion') }}</label>
                    <input class="form-control {{ $errors->has('organizacion') ? 'is-invalid' : '' }}" type="text"
                        name="organizacion" id="organizacion"
                        value="{{ old('organizacion', $organizacione->organizacion) }}" required>
                    @if ($errors->has('organizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('organizacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacione.fields.organizacion_helper') }}</span>
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
