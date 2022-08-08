@extends('layouts.admin')
@section('content')

<h5 class="col-12 titulo_general_funcion">Registrar: Tipo de Acceso</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.tipo-acceso.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                <label class="required"><i
                    class="fas fa-user-lock iconos-crear"></i>Nombre del acceso</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                    id="nombre" value="{{ old('nombre', '') }}" required>
                @if ($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>


            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                <label for="descripcion"><i
                    class="fas fa-file-alt iconos-crear"></i>Descripción</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
                    id="descripcion" required>{{ old('descripcion', '') }}</textarea>
                @if ($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
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