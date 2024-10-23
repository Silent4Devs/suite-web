<!-- No Contrato Field -->
<div class="row mb-4">
    <div class="input-field col s12 m4">
        <small>No. factura:</small>
        <input type="number" name="no_factura" class="form-control" required>
    </div>

    <div class="input-field col s12 m4">
        <small>Periodo:</small>
        <input type="text" name="periodo" class="form-control" required>
    </div>

    <div class="input-field col s12 m4">
        <small>Fecha de recepción:</small>
        <input type="text" name="fecha_recepcion" class="datepicker" required>
    </div>

    <div class="input-field col s12 m4">
        <small>No. revisiones:</small>
        <input type="text" name="no_revisiones" class="form-control" required>
    </div>

    <div class="input-field col s12 m4">
        <small>Cumple/ No Cumple:</small>
        <div class="display-flex ml-4">
            <select class="validate" name="cumple" required>
                <option value="" disabled selected>Escoga una opción</option>
                <option value="1">Cumple</option>
                <option value="0">No cumple</option>
            </select>
        </div>
    </div>

    <div class="input-field col s12 m4">
        <small>Fecha de liberación:</small>
        <input type="text" name="fecha_liberacion" class="datepicker" required>
    </div>

    <div class="input-field col s12 m4">
        <small>Monto factura:</small>
        <input type="number" name="monto_factura" class="form-control" required>
    </div>

    <div class="col s12 m4">
        <div class="file-field input-field">
            <div class="btn">
                <span>PDF</span>
                <input type="file" name="pdf" accept="{{ $organizacion ? $organizacion->formatos : '.docx,.pdf,.doc,.xlsx,.pptx,.txt' }}">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Elegir factura pdf" required>
            </div>
        </div>
        <div class="display-flex ml-4">
            <label class="red-text">{{ $errors->first('pdf') }}</label>
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
            <label class="red-text">{{ $errors->first('xml') }}</label>
        </div>
    </div>

    <div class="input-field col s12 m4">
        <small>Número de pagos:</small>
        <input type="number" name="no_pagos" class="form-control" required>
    </div>

    <div class="input-field col s12 m4">
        <small>Periodicidad de pago:</small>
        <div class="display-flex ml-4">
            <select class="validate" name="perioricidad_pago" required>
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
        <small>Fecha de inicio de pago:</small>
        <div class="display-flex ml-4">
            <input type="text" name="fecha_inicio_pago" class="datepicker" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col s12">
            <div class="form-group col-sm-12 right">
                <button type="submit" class="btn tb-btn-primary">Guardar</button>
                <a href="{{ route('contratos.index') }}" class="btn btn-default">Cancelar</a>
            </div>
        </div>
    </div>
</div>
