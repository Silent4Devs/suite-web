@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Registrar: Subcategoría de Activos</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.subtipoactivos.store") }}" enctype="multipart/form-data">
            @csrf

        <div class="row">
            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="id_asignada"><i class="fas fa-layer-group iconos-crear"></i>Categoría</label>
                <select class="form-control  {{ $errors->has('tipo') ? 'is-invalid' : '' }}"
                    name="categoria_id" id="categoria_id" required>
                    <option value="">Seleccione una opción</option>
                    @foreach ($tipos as $tipo)
                        <option data-puesto="{{ $tipo->tipo }}" value="{{ $tipo->id }}">
                            {{ $tipo->tipo }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('categoria_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categoria_id') }}
                    </div>
                @endif
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <label class="required" for="tipo"><i class="fas fa-layer-group iconos-crear"></i>Subcategoría</label>
                <input class="form-control {{ $errors->has('subcategoria') ? 'is-invalid' : '' }}" type="text" name="subcategoria" id="subcategoria" value="{{ old('subcategoria', '') }}" required>
                @if($errors->has('subcategoria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoactivo.fields.tipo_helper') }}</span>
            </div>
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
