@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Editar: Subcategoría de Activos</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.subtipoactivos.update", $subcategoria)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

        <div class="row">
            <div class="form-group col-sm-6">
                <i class="fas fa-layer-group iconos-crear"></i>{!! Form::label('categoria_id', 'Categoria:') !!}
                <select class="custom-select" id="categoria_id" name="categoria_id">
                    <option selected value="" disabled>Seleccione una opción</option>
                    @forelse ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ $subcategoria->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->tipo }}
                        </option>
                    @empty
                        <option value="" disabled>Sin Datos</option>
                    @endforelse

                </select>
            </div>

            <div class="form-group col-sm-6">
                <label class="required" for="subcategoria"><i class="fas fa-layer-group iconos-crear"></i>Subcategoría</label>
                <input class="form-control {{ $errors->has('subcategoria') ? 'is-invalid' : '' }}" type="text" name="subcategoria" id="subcategoria" value="{{ old('subcategoria', $subcategoria->subcategoria) }}" required>
                @if($errors->has('subcategoria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subcategoria') }}
                    </div>
                @endif
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
