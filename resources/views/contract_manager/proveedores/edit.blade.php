
@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Actualizar:  Proveedor</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('contract_manager.proveedores.update', [$proveedores->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="nombre"><i class="fa-solid fa-signature fa-lg"></i>>&nbsp;&nbsp;Nombre</label>
                <input  value="{{ old("nombre", $proveedores->nombre) }}" class="form-control  {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="nombre" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                @if($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="descripcion"><i class="fa-solid fa-file-lines fa-lg"></i>&nbsp;&nbsp;Descripción</label>
                <input value="{{old("razon_social",  $proveedores->razon_social)}}"  class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="razon_social" name="razon_social" id="razon_social" required>
                @if($errors->has('razon_social'))
                    <div class="invalid-feedback">
                        {{ $errors->first('razon_social') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="rfc"><i class="fa-solid fa-fingerprint fa-lg"></i>&nbsp;&nbsp;RFC</label>
                <input value="{{old("rfc",  $proveedores->rfc)}}"  class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="rfc" name="rfc" id="rfc" required>
                @if($errors->has('rfc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rfc') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="contacto"><i class="fa-solid fa-id-badge fa-lg"></i>&nbsp;&nbsp;Contacto</label>
                <input value="{{old("contacto",  $proveedores->contacto)}}"  class="form-control {{ $errors->has('contacto') ? 'is-invalid' : '' }}" type="contacto" name="contacto" id="contacto" required>
                @if($errors->has('contacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contacto') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="cuenta_contable"><i class="fa-solid fa-calculator fa-lg"></i>&nbsp;&nbsp;Cuenta Contable</label>
                <input value="{{old("facturacion",  $proveedores->facturacion)}}"  class="form-control {{ $errors->has('facturacion') ? 'is-invalid' : '' }}" type="facturacion" name="facturacion" id="facturacion" required>
                @if($errors->has('facturacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facturacion') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="direccion"><i class="fa-regular fa-address-book fa-lg"></i>&nbsp;&nbsp;Dirección</label>
                <input value="{{old("direccion",  $proveedores->direccion)}}"  class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="direccion" name="direccion" id="direccion" required>
                @if($errors->has('direccion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('direccion') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="envio"><i class="fa-solid fa-paper-plane fa-lg"></i>&nbsp;&nbsp;Envio</label>
                <input value="{{old("envio",  $proveedores->envio)}}"  class="form-control {{ $errors->has('envio') ? 'is-invalid' : '' }}" type="envio" name="envio" id="envio" required>
                @if($errors->has('envio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('envio') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="credito"><i class="fa-solid fa-credit-card fa-lg"></i>&nbsp;&nbsp;Credito</label>
                <input value="{{old("credito",  $proveedores->credito)}}"  class="form-control {{ $errors->has('credito') ? 'is-invalid' : '' }}" type="credito" name="credito" id="credito" required>
                @if($errors->has('credito'))
                    <div class="invalid-feedback">
                        {{ $errors->first('credito') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="fecha_inicio"><i class="fa-regular fa-calendar fa-lg"></i>&nbsp;&nbsp;Fecha Inicio</label>
                <input value="{{old("fecha_inicio",  $proveedores->fecha_inicio)}}"  class="form-control {{ $errors->has('fecha_inicio') ? 'is-invalid' : '' }}" type="fecha_inicio" name="fecha_inicio" id="fecha_inicio" required>
                @if($errors->has('fecha_inicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_inicio') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="fecha_fin"><i class="fa-solid fa-calendar fa-lg"></i>&nbsp;&nbsp;Fecha Fin</label>
                <input value="{{old("fecha_fin",  $proveedores->fecha_fin)}}"  class="form-control {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}" type="fecha_fin" name="fecha_fin" id="fecha_fin" required>
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
