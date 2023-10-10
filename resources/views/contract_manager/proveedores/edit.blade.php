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
                    <div class="form-group col-md-6 col-sm-6">
                        <label class="required" for="clave">&nbsp;&nbsp;Clave del Registro</label>
                        <input class="form-control  {{ $errors->has('clave') ? 'is-invalid' : '' }}" type="number"
                            name="clave" id="clave" value="{{ old('clave', $proveedores->id) }}" required>
                        @if ($errors->has('clave'))
                            <div class="invalid-feedback">
                                {{ $errors->first('clave') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label class="required" for="nombre">&nbsp;&nbsp;Nombre</label>
                        <input value="{{ old('nombre', $proveedores->nombre) }}"
                            class="form-control  {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label class="required" for="razon_social">&nbsp;&nbsp;Razón Social</label>
                        <input value="{{ old('nombre', $proveedores->razon_social) }}"
                            class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="text"
                            name="razon_social" id="razon_social" required>
                        @if ($errors->has('razon_social'))
                            <div class="invalid-feedback">
                                {{ $errors->first('razon_social') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label class="required" for="rfc">&nbsp;&nbsp;RFC</label>
                        <input value="{{ old('rfc', $proveedores->rfc) }}"
                            class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="text"
                            name="rfc" id="rfc" required>
                        @if ($errors->has('rfc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rfc') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label class="required" for="contacto">&nbsp;&nbsp;Contacto</label>
                        <input value="{{ old('contacto', $proveedores->contacto) }}"
                            class="form-control {{ $errors->has('contacto') ? 'is-invalid' : '' }}" type="tel"
                            min="1" max="10" step="2" name="contacto" id="contacto" required>
                        @if ($errors->has('contacto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contacto') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="">Fecha Inicio<span class="text-danger">*</span></label>
                        <input value="{{ old('fecha_inicio', $proveedores->fecha_inicio) }}" id="fechaInicio"
                            class="form-control" type="date" name="fecha_inicio" required>
                        <small class="errores error_fecha_inicio text-danger"></small>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="">Fecha Fin<span class="text-danger">*</span></label>
                        <input value="{{ old('fecha_fin', $proveedores->fecha_fin) }}" id="fechaFin" class="form-control"
                            type="date" name="fecha_fin" required>
                        <small class="errores error_fecha_inicio text-danger"></small>
                    </div>
                </div>

                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
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
