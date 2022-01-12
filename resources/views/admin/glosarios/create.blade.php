@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Crear Glosario </h5>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.glosarios.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="numero">Inciso</label>
                <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" type="text" name="numero" id="numero" required>
                @if($errors->has('numero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="norma">Norma</label>
                <input class="form-control {{ $errors->has('norma') ? 'is-invalid' : '' }}" type="text" name="norma" id="norma" value="{{ old('norma', '') }}" required>
                @if($errors->has('norma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('norma') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="concepto">{{ trans('cruds.glosario.fields.concepto') }}</label>
                <input class="form-control {{ $errors->has('concepto') ? 'is-invalid' : '' }}" type="text" name="concepto" id="concepto" required>
                @if($errors->has('concepto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('concepto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.glosario.fields.concepto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="definicion">{{ trans('cruds.glosario.fields.definicion') }}</label>
                <textarea class="form-control {{ $errors->has('definicion') ? 'is-invalid' : '' }}" name="definicion" id="definicion">{{ old('definicion') }}</textarea>
                @if($errors->has('definicion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('definicion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.glosario.fields.definicion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="explicacion">{{ trans('cruds.glosario.fields.explicacion') }}</label>
                <textarea class="form-control {{ $errors->has('explicacion') ? 'is-invalid' : '' }}" name="explicacion" id="explicacion">{{ old('explicacion') }}</textarea>
                @if($errors->has('explicacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('explicacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.glosario.fields.explicacion_helper') }}</span>
            </div>
            <div class="form-group">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
