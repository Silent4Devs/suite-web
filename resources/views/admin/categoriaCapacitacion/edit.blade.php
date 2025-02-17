@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/global/colores.css') }}{{ config('app.cssVersion') }}">
    <h5 class="col-12 titulo_general_funcion"> Editar: Categoría</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categoria-capacitacion.update', $categoriaCapacitacion) }}"
                class="row">
                @csrf
                @method('PATCH')

                <div class="form-group col-sm-12 col-lg-12 col-md-12 anima-focus">
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                           type="text"
                           placeholder=""
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre', $categoriaCapacitacion->nombre) }}"
                           required
                           maxlength="255">
                    <label for="nombre" class="asterisco">Nombre de la Categoría*</label>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>

                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.categoria-capacitacion.index') }}" class="btn btn-outline-primary"
                        id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
                    <button class="btn tb-btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
<style>
    #btn_cancelar {
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        border-radius: 4px;
        opacity: 1;
    }
</style>
