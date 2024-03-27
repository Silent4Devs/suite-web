<!-- No Contrato Field -->
<div class="row mb-4">
    <div class="input-field col s12 m4">
        <small>No. factura:</small>
        {!! Form::number('no_factura', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Nombre Proveedor Field -->
    <div class="input-field col s12 m4">
        <small>Periodo:</small>
        {!! Form::text('periodo', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Area Field -->
    <div class="input-field col s12 m4">
        <small>Fecha de recepción:</small>
        {!! Form::text('fecha_recepcion', null, ['class' => 'datepicker', 'required']) !!}
    </div>

    <!-- Nombre Servicio Field -->
    <div class="input-field col s12 m4">
        <small>No. revisiones</small>

        {!! Form::text('no_revisiones', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Clasificacion Field -->
    <div class="input-field col s12 m4">
        <small>Cumple/ No Cumple</small>
        <div class="display-flex ml-4">
            <select class="validate" required="" aria-required="true" name="cumple">
                <option value="" disabled selected>Escoga una opción</option>
                <option value="1">Cumple</option>
                <option value="0">No cumple</option>
            </select>
        </div>
    </div>

    <!-- Administrador Field -->
    <div class="input-field col s12 m4">
        <small>Fecha de liberación</small>
        {!! Form::text('fecha_liberacion', null,['class' => 'datepicker' , 'required']) !!}
    </div>

    <!-- Fase Field -->
    <div class="input-field col s12 m4">
        <small>Monto factura</small>
        {!! Form::number('monto_factura', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Estatus Field -->
    <div class="col s12 m4">
        <div class="file-field input-field">
            <div class="btn">
                <span>PDF</span>
                <input class="input_file_validar" type="file" name="pdf" accept="{{$organizacion ? $organizacion->formatos : '.docx,.pdf,.doc,.xlsx,.pptx,.txt'}}">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Elegir factura pdf" required>
            </div>
        </div>
        <div class="display-flex ml-4">
            <label class="red-text">{{ $errors->first('Type') }}</label>
        </div>
    </div>

    <div class="input-field col s12 m4">
        <div class="file-field input-field">
            <div class="btn">
                <span>XML</span>
                <input type="file" name="xml" accept="text/xml">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Elegir factura xml" required>
            </div>
        </div>
        <div class="display-flex ml-4">
            <label class="red-text">{{ $errors->first('Type') }}</label>
        </div>
    </div>

    <!-- Vigencia Contrato Field -->
    <div class="input-field col s12 m4">
        <small>Numero de pagos</small>
        {!! Form::number('no_pagos', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Pmp Asignado Field -->
    <div class="input-field col s12 m4">
        <small>Perioricidad de pago</small>
        <div class="display-flex ml-4">
            <select class="validate" required="" aria-required="true" name="perioricidad_pago" required>
                <option value="" disabled selected>Escoga una opción</option>
                <option value="1">Mensual</option>
                <option value="2">Bimestral</option>
                <option value="3">Trimestral</option>
                <option value="6">Semestral</option>
                <option value="12">Anual</option>
                <option value="15">Quincenal</option>
            </select>
        </div>
    </div>

    <div class="input-field col s12 m4">
        <small>Fecha de inicio de pago</small>
        <div class="display-flex ml-4">
            {!! Form::text('fecha_inicio_pago', null,['class' => 'datepicker', 'required']); !!}
        </div>
    </div>
    <!-- Submit Field -->
    <div class="row mb-3">
        <div class="col s12">
            <div class="form-group col-sm-12 right">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('contratos.index') }}" class="btn btn-default">Cancelar</a>
            </div>
        </div>
    </div>
</div>
