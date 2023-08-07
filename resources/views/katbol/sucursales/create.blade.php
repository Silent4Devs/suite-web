@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Registrar:  Producto</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("katbol.sucursales.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="clave"><i class="fas fa-envelope iconos-crear"></i>Clave</label>
                    <input  class="form-control  {{ $errors->has('clave') ? 'is-invalid' : '' }}" type="clave" name="clave" id="clave" value="{{ old('clave') }}" required>
                    @if($errors->has('clave'))
                        <div class="invalid-feedback">
                            {{ $errors->first('clave') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="descripcion"><i class="fas fa-lock iconos-crear"></i>Descripción</label>
                    <input   class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="descripcion" name="descripcion" id="descripcion" required>
                    @if($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
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
                    <label class="required" for="empresa"><i class="fas fa-lock iconos-crear"></i>Empresa</label>
                    <input   class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="empresa" name="empresa" id="empresa" required>
                    @if($errors->has('empresa'))
                        <div class="invalid-feedback">
                            {{ $errors->first('empresa') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="cuenta_contable"><i class="fas fa-lock iconos-crear"></i>Cuenta Contable</label>
                    <input   class="form-control {{ $errors->has('cuenta_contable') ? 'is-invalid' : '' }}" type="cuenta_contable" name="cuenta_contable" id="cuenta_contable" required>
                    @if($errors->has('cuenta_contable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cuenta_contable') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="zona"><i class="fas fa-lock iconos-crear"></i>Zona</label>
                    <input class="form-control {{ $errors->has('zona') ? 'is-invalid' : '' }}" type="zona" name="zona" id="zona" required>
                    @if($errors->has('zona'))
                        <div class="invalid-feedback">
                            {{ $errors->first('zona') }}
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
                    <label class="required" for="mylogo"><i class="fas fa-lock iconos-crear"></i>Logo</label>
                    <input   class="form-control {{ $errors->has('mylogo') ? 'is-invalid' : '' }}" type="mylogo" name="mylogo" id="mylogo" required>
                    @if($errors->has('mylogo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mylogo') }}
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
