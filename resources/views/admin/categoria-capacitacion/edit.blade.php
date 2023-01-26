@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('../css/colores.css') }}">
    <h5 class="col-12 titulo_general_funcion"> Editar: Categoría</h5>
    <div class="mt-4 card">
         <div class="card-body">
            <form method="POST" action="{{ route('admin.categoria-capacitacion.update', $categoriaCapacitacion) }}"
                class="row">
                @csrf
                @method('PATCH')

                <div class="form-group col-sm-12 col-lg-12 col-md-12">
                    <label class="required" for="nombre"><i class="fas fa-layer-group iconos-crear"></i> Nombre de la
                        Categoría</label>
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                        id="nombre" value="{{ old('nombre', $categoriaCapacitacion->nombre) }}" required>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.categoria-capacitacion.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
