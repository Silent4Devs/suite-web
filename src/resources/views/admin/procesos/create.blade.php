@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/colores.css') }}">
    <h5 class="col-12 titulo_general_funcion">Registrar: Procesos</h5>
    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" action="{{ route('admin.procesos.store') }}" class="row">
                @csrf
                <div class="col-md-12 col-sm-12">
                    <div class="card vrd-agua">
                        <p class="mb-1 text-center text-white">Crear proceso</p>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="required" for="codigo"><i class="fas fa-barcode iconos-crear"></i>
                        Código</label>
                    <input class="form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" type="text" name="codigo"
                        id="codigo" value="{{ old('codigo', '') }}" required>
                    @if ($errors->has('codigo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('codigo') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-4">
                    <label class="required" for="nombre"><i class="fas fa-file-signature iconos-crear"></i>
                        Nombre</label>
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                        id="nombre" value="{{ old('nombre', '') }}" required>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4 col-sm-4">
                    <label class="required" for="id_macroproceso"><i class="fas fa-cogs iconos-crear"></i>Macroproceso
                    </label>
                    <select class="form-control select2 {{ $errors->has('id_macroproceso') ? 'is-invalid' : '' }}"
                        name="id_macroproceso" id="id_macroproceso" required>
                        <option value="">
                            Escoja un macroproceso
                        </option>
                        @foreach ($macroprocesos as $macroproceso)
                            <option value="{{ $macroproceso->id }}"
                                {{ old('id_macroproceso') == $macroproceso->id ? 'selected' : '' }}>
                                {{ $macroproceso->codigo }} / {{ $macroproceso->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_macroproceso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_macroproceso') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-sm-12">
                    <label for="descripcion"><i class="fas fa-sticky-note iconos-crear"></i>
                        Descripción</label>
                    <textarea rows="3" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text"
                        name="descripcion" id="descripcion">{{ old('descripcion', '') }}</textarea>
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
