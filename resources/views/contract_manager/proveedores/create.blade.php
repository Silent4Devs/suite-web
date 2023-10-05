@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Registrar:  Proveedor</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("contract_manager.proveedores.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="clave">&nbsp;&nbsp;Clave del Registro</label>
                    <input   class="form-control  {{ $errors->has('clave') ? 'is-invalid' : '' }}" type="number" name="clave" id="clave" value="{{ old('clave') }}" required>
                    @if($errors->has('clave'))
                        <div class="invalid-feedback">
                            {{ $errors->first('clave') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="nombre">&nbsp;&nbsp;Nombre</label>
                    <input   class="form-control  {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    @if($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="descripcion">&nbsp;&nbsp;Razón Social</label>
                    <input   class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="text" name="razon_social" id="razon_social" required>
                    @if($errors->has('razon_social'))
                        <div class="invalid-feedback">
                            {{ $errors->first('razon_social') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label class="required" for="rfc">&nbsp;&nbsp;RFC</label>
                    <input   class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="text" name="rfc" id="rfc" required>
                    @if($errors->has('rfc'))
                        <div class="invalid-feedback">
                            {{ $errors->first('rfc') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                        <label for="">Fecha Inicio<span class="text-danger">*</span></label>
                        <input class="form-control" id="fechaInicio" type="date" name="fecha_inicio" required>
                        <small class="errores error_fecha_inicio text-danger"></small>
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <label for="">Fecha Fin<span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="fechaFin" name="fecha_inicio" required>
                    <small class="errores error_fecha_inicio text-danger"></small>
                </div>
              </div>
            <div class="text-right form-group col-12" style="margin-left:15px;">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger"  type="submit">
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

<script>
    // Obtén referencias a los elementos de entrada
    const fechaInicioInput = document.getElementById('fechaInicio');
    const fechaFinInput = document.getElementById('fechaFin');

    // Agrega un evento de escucha al campo de fecha de inicio
    fechaInicioInput.addEventListener('change', validarFechas);

    // Agrega un evento de escucha al campo de fecha de finalización
    fechaFinInput.addEventListener('change', validarFechas);

    function validarFechas() {
    // Obtén los valores de las fechas de inicio y finalización
    const fechaInicio = new Date(fechaInicioInput.value);
    const fechaFin = new Date(fechaFinInput.value);

    // Verifica si la fecha de finalización es mayor que la fecha de inicio
    if (fechaFin < fechaInicio) {
        alert('La fecha de finalización no puede ser mayor que la fecha de inicio');
        fechaFinInput.value = ''; // Limpia el campo de fecha de finalización
    }
    }
</script>
@endsection
