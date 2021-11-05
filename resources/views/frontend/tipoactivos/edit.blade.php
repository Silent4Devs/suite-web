@extends('layouts.admin')
@section('content')

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Categoría de Activos</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipoactivos.update", [$tipoactivo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tipo"><i class="fas fa-layer-group iconos-crear"></i>Categoría</label>
                <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text" name="tipo" id="tipo" value="{{ old('tipo', $tipoactivo->tipo) }}" required>
                @if($errors->has('tipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoactivo.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subtipo"><i class="fas fa-adjust iconos-crear"></i>Subcategoría</label>
                <input class="form-control {{ $errors->has('subtipo') ? 'is-invalid' : '' }}" type="text" name="subtipo" id="subtipo" value="{{ old('subtipo', $tipoactivo->subtipo) }}" required>
                @if($errors->has('subtipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subtipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoactivo.fields.subtipo_helper') }}</span>
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
