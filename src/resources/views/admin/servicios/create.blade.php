@extends('layouts.admin')
@section('content')

<h5 class="col-12 titulo_general_funcion">Registrar: Servicio</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.servicios.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                <label class="required"><i
                    class="fas fa-handshake iconos-crear"></i>Nombre del servicio</label>
                <input class="form-control {{ $errors->has('servicio') ? 'is-invalid' : '' }}" type="text" name="servicio"
                    id="servicio" value="{{ old('servicio', '') }}" required>
                @if ($errors->has('servicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('servicio') }}
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
