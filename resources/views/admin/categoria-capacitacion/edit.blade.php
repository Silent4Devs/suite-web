@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('../css/colores.css') }}">

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white align-items-centera"><strong> Registrar: </strong>Mi organización </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.categoria-capacitacion.update', $categoriaCapacitacion) }}"
                class="row">
                @csrf
                @method('PATCH')
                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <p class="mb-1 text-center text-white">Crear Categoría</p>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="nombre"><i class="far fa-building iconos-crear"></i> Nombre de la
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
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
