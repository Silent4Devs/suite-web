@extends('layouts.frontend')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('../css/colores.css') }}">

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white align-items-centera"><strong> Editar: </strong>Categoría </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('categoria-capacitacion.update', $categoriaCapacitacion) }}"
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
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
