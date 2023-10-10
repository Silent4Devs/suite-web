@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Registrar: Categoría de Activo</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipoactivos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" >
                <label class="required" for="tipo"><i class="fas fa-layer-group iconos-crear"></i>Categoría</label>
                <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text" name="tipo" id="tipo" value="{{ old('tipo', '') }}" required>
                @if($errors->has('tipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoactivo.fields.tipo_helper') }}</span>
            </div>

            <div class="form-group col-12 text-right" style="margin-left:15px;" >
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
