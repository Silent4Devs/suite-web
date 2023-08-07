@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Registrar:  Producto</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("katbol.proveedores.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="nombre"><i class="fas fa-envelope iconos-crear"></i>Nombre</label>
                    <input   class="form-control  {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="nombre" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    @if($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="razon_social"><i class="fas fa-lock iconos-crear"></i>Descripción</label>
                    <input   class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="razon_social" name="razon_social" id="razon_social" required>
                    @if($errors->has('razon_social'))
                        <div class="invalid-feedback">
                            {{ $errors->first('razon_social') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="rfc"><i class="fas fa-lock iconos-crear"></i>RFC</label>
                    <input   class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="rfc" name="rfc" id="rfc" required>
                    @if($errors->has('rfc'))
                        <div class="invalid-feedback">
                            {{ $errors->first('rfc') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="contacto"><i class="fas fa-lock iconos-crear"></i>Contacto</label>
                    <input   class="form-control {{ $errors->has('contacto') ? 'is-invalid' : '' }}" type="contacto" name="contacto" id="contacto" required>
                    @if($errors->has('contacto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contacto') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="facturacion"><i class="fas fa-lock iconos-crear"></i>Cuenta Contable</label>
                    <input   class="form-control {{ $errors->has('facturacion') ? 'is-invalid' : '' }}" type="facturacion" name="facturacion" id="facturacion" required>
                    @if($errors->has('facturacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('facturacion') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="direccion"><i class="fas fa-lock iconos-crear"></i>Dirección</label>
                    <input  class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="direccion" name="direccion" id="direccion" required>
                    @if($errors->has('direccion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('direccion') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="envio"><i class="fas fa-lock iconos-crear"></i>Envio</label>
                    <input class="form-control {{ $errors->has('envio') ? 'is-invalid' : '' }}" type="envio" name="envio" id="envio" required>
                    @if($errors->has('envio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('envio') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="credito"><i class="fas fa-lock iconos-crear"></i>Credito</label>
                    <input  class="form-control {{ $errors->has('credito') ? 'is-invalid' : '' }}" type="credito" name="credito" id="credito" required>
                    @if($errors->has('credito'))
                        <div class="invalid-feedback">
                            {{ $errors->first('credito') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="fecha_inicio"><i class="fas fa-lock iconos-crear"></i>Fecha Inicio</label>
                    <input   class="form-control {{ $errors->has('fecha_inicio') ? 'is-invalid' : '' }}" type="fecha_inicio" name="fecha_inicio" id="fecha_inicio" required>
                    @if($errors->has('fecha_inicio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="fecha_fin"><i class="fas fa-lock iconos-crear"></i>Fecha Fin</label>
                    <input   class="form-control {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}" type="fecha_fin" name="fecha_fin" id="fecha_fin" required>
                    @if($errors->has('fecha_fin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
              </div>
            <div class="text-right form-group col-12" style="margin-left:15px;">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
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
