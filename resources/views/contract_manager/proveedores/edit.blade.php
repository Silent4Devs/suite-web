@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Actualizar: Proveedor</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('contract_manager.proveedores.update', [$proveedores->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <input class="form-control {{ $errors->has('clave') ? 'is-invalid' : '' }}"
                               placeholder="" maxlength="255"
                               type="number" name="clave" id="clave"
                               value="{{ old('clave', $proveedores->id) }}" required>
                        <label for="clave" class="asterisco">Clave del Registro*</label>
                        @if ($errors->has('clave'))
                            <div class="invalid-feedback">
                                {{ $errors->first('clave') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                               maxlength="255" type="text"
                               name="nombre" id="nombre"
                               value="{{ old('nombre', $proveedores->nombre) }}" required>
                        <label for="nombre" class="asterisco">Nombre*</label>
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <input class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}"
                               maxlength="255" type="text"
                               name="razon_social" id="razon_social"
                               value="{{ old('razon_social', $proveedores->razon_social) }}" required>
                        <label for="razon_social" class="asterisco">Razón Social*</label>
                        @if ($errors->has('razon_social'))
                            <div class="invalid-feedback">
                                {{ $errors->first('razon_social') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <input class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}"
                               maxlength="255" type="text"
                               name="rfc" id="rfc"
                               value="{{ old('rfc', $proveedores->rfc) }}" required>
                        <label for="rfc" class="asterisco">RFC*</label>
                        @if ($errors->has('rfc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rfc') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <input class="form-control {{ $errors->has('contacto') ? 'is-invalid' : '' }}"
                               type="tel" name="contacto" id="contacto"
                               value="{{ old('contacto', $proveedores->contacto) }}" required>
                        <label for="contacto" class="asterisco">Contacto*</label>
                        @if ($errors->has('contacto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contacto') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <input class="form-control" id="fechaInicio"
                               type="date" name="fecha_inicio"
                               value="{{ old('fecha_inicio', $proveedores->fecha_inicio) }}" required>
                        <label for="fechaInicio" class="asterisco">Fecha Inicio*</label>
                        <small class="errores error_fecha_inicio text-danger"></small>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <input class="form-control" id="fechaFin"
                               type="date" name="fecha_fin"
                               value="{{ old('fecha_fin', $proveedores->fecha_fin) }}" required>
                        <label for="fechaFin" class="asterisco">Fecha Fin*</label>
                        <small class="errores error_fecha_inicio text-danger"></small>
                    </div>
                </div>

                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#roles").select2({
                theme: "bootstrap4",
            });
        });
    </script>
@endsection
