<div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
    Datos Financieros
</div>
<div class="row mt-4">
    <div class="form-group col-sm-6">
        <label for="banco"><i class="fas fa-landmark iconos-crear"></i>Banco</label>
        <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="banco" id="banco"
            value="{{ old('banco', $empleado->banco) }}">
        <small id="error_banco" class="text-danger"></small>
        @if ($errors->has('banco'))
            <div class="invalid-feedback">
                {{ $errors->first('banco') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="cuenta_bancaria"><i class="fas fa-credit-card iconos-crear"></i>Cuenta
            Bancaria</label>
        <input class="form-control {{ $errors->has('cuenta_bancaria') ? 'is-invalid' : '' }}" type="text"
            name="cuenta_bancaria" id="cuenta_bancaria"
            value="{{ old('cuenta_bancaria', $empleado->cuenta_bancaria) }}">
        <small id="error_cuenta_bancaria" class="text-danger"></small>
        @if ($errors->has('cuenta_bancaria'))
            <div class="invalid-feedback">
                {{ $errors->first('cuenta_bancaria') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="clabe_interbancaria"><i class="fas fa-barcode iconos-crear"></i>Clave
            Interbancaria</label>
        <input class="form-control {{ $errors->has('clabe_interbancaria') ? 'is-invalid' : '' }}" type="text"
            name="clabe_interbancaria" id="clabe_interbancaria"
            value="{{ old('clabe_interbancaria', $empleado->clabe_interbancaria) }}">
        <small id="error_clabe_interbancaria" class="text-danger"></small>
        @if ($errors->has('clabe_interbancaria'))
            <div class="invalid-feedback">
                {{ $errors->first('clabe_interbancaria') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="centro_costos"><i class="fas fa-building iconos-crear"></i>Centro de
            costos</label>
        <input class="form-control {{ $errors->has('centro_costos') ? 'is-invalid' : '' }}" type="text"
            name="centro_costos" id="centro_costos" value="{{ old('centro_costos', $empleado->centro_costos) }}">
        <small id="error_centro_costos" class="text-danger"></small>
        @if ($errors->has('centro_costos'))
            <div class="invalid-feedback">
                {{ $errors->first('centro_costos') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="salario_bruto"><i class="fas fa-dollar-sign iconos-crear"></i>Salario
            Bruto</label>
        <input data-type='currency' placeholder="$1,000,000.00"
            class="form-control {{ $errors->has('salario_bruto') ? 'is-invalid' : '' }}" type="text"
            name="salario_bruto" id="salario_bruto" value="{{ old('salario_bruto', $empleado->salario_bruto) }}">
        <small id="error_salario_bruto" class="text-danger"></small>
        @if ($errors->has('salario_bruto'))
            <div class="invalid-feedback">
                {{ $errors->first('salario_bruto') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="salario_diario"><i class="fas fa-dollar-sign iconos-crear"></i>Salario
            Diario</label>
        <input class="form-control {{ $errors->has('salario_diario') ? 'is-invalid' : '' }}" type="text"
            placeholder="$1,000,000.00" name="salario_diario" id="salario_diario" data-type='currency'
            value="{{ old('salario_diario', $empleado->salario_diario) }}">
        <small id="error_salario_diario" class="text-danger"></small>
        @if ($errors->has('salario_diario'))
            <div class="invalid-feedback">
                {{ $errors->first('salario_diario') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="salario_diario_integrado"><i class="fas fa-dollar-sign iconos-crear"></i>Salario Diario
            Integrado</label>
        <input class="form-control {{ $errors->has('salario_diario_integrado') ? 'is-invalid' : '' }}"
            placeholder="$1,000,000.00" type="text" name="salario_diario_integrado" id="salario_diario_integrado"
            data-type='currency' value="{{ old('salario_diario_integrado', $empleado->salario_diario_integrado) }}">
        <small id="error_salario_diario_integrado" class="text-danger"></small>
        @if ($errors->has('salario_diario_integrado'))
            <div class="invalid-feedback">
                {{ $errors->first('salario_diario_integrado') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="salario_base_mensual"><i class="fas fa-dollar-sign iconos-crear"></i>Salario Base
            Mensual</label>
        <input class="form-control {{ $errors->has('salario_base_mensual') ? 'is-invalid' : '' }}" type="text"
            placeholder="$1,000,000.00" data-type='currency' name="salario_base_mensual" id="salario_base_mensual"
            value="{{ old('salario_base_mensual', $empleado->salario_base_mensual) }}">
        <small id="error_salario_base_mensual" class="text-danger"></small>
        @if ($errors->has('salario_base_mensual'))
            <div class="invalid-feedback">
                {{ $errors->first('salario_base_mensual') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="pagadora_actual"><i class="fas fa-hand-holding-usd iconos-crear"></i>Pagadora Actual</label>
        <input class="form-control {{ $errors->has('pagadora_actual') ? 'is-invalid' : '' }}" type="text"
            name="pagadora_actual" id="pagadora_actual"
            value="{{ old('pagadora_actual', $empleado->pagadora_actual) }}">
        <small id="error_pagadora_actual" class="text-danger"></small>
        @if ($errors->has('pagadora_actual'))
            <div class="invalid-feedback">
                {{ $errors->first('pagadora_actual') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="periodicidad_nomina"><i class="fas fa-sync-alt iconos-crear"></i>Periodicidad de
            nómina</label>
        <select class="select-search form-control {{ $errors->has('periodicidad_nomina') ? 'is-invalid' : '' }}"
            name="periodicidad_nomina" id="periodicidad_nomina">
            <option value="" selected disabled>-- Selecciona la peridicidad --</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Diaria' ? 'selected' : '' }}
                value="Diaria">Diaria</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Semanal' ? 'selected' : '' }}
                value="Semanal">Semanal</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Decenal' ? 'selected' : '' }}
                value="Decenal">Decenal</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Oncenal' ? 'selected' : '' }}
                value="Oncenal">Oncenal</option>
            <option
                {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Catorcenal' ? 'selected' : '' }}
                value="Catorcenal">Catorcenal</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Quincenal' ? 'selected' : '' }}
                value="Quincenal">Quincenal</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Mensual' ? 'selected' : '' }}
                value="Mensual">Mensual</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Semestral' ? 'selected' : '' }}
                value="Semestral">Semestral</option>
            <option {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Anual' ? 'selected' : '' }}
                value="Anual">Anual</option>
        </select>
        <small id="error_periodicidad_nomina" class="text-danger"></small>
        @if ($errors->has('periodicidad_nomina'))
            <div class="invalid-feedback">
                {{ $errors->first('periodicidad_nomina') }}
            </div>
        @endif
    </div>
    {{-- Componente Beneficiarios --}}
    <div class="col-sm-12">
        <label><i class="fas fa-users iconos-crear"></i>Beneficiarios</label>
        @include('admin.empleados.components.beneficiarios',[
        'empleado'=>$empleado
        ])
    </div>
    {{-- Fin Componente Beneficiarios --}}
    <div class="form-group col-sm-6">
        <label for="entidad_crediticias_id"><i class="fas fa-landmark iconos-crear"></i>Entidad
            crediticia</label>
        <select class="form-control select-search {{ $errors->has('entidad_crediticias_id') ? 'is-invalid' : '' }}"
            name="entidad_crediticias_id" id="entidad_crediticias_id"
            value="{{ old('entidad_crediticias_id', $empleado->entidad_crediticias_id) }}">
            <option value="" selected disabled>
                -- Selecciona una entidad crediticia --
            </option>
            @foreach ($entidadesCrediticias as $entidad)
                <option value="{{ $entidad->id }}">{{ $entidad->entidad }}</option>
            @endforeach
        </select>
        <small id="error_entidad_crediticias_id" class="text-danger"></small>
        @if ($errors->has('entidad_crediticias_id'))
            <div class="invalid-feedback">
                {{ $errors->first('entidad_crediticias_id') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="numero_credito"><i class="fas fa-barcode iconos-crear"></i>Número de crédito</label>
        <input class="form-control {{ $errors->has('numero_credito') ? 'is-invalid' : '' }}" type="text"
            name="numero_credito" id="numero_credito" value="{{ old('numero_credito', $empleado->numero_credito) }}">
        <small id="error_numero_credito" class="text-danger"></small>
        @if ($errors->has('numero_credito'))
            <div class="invalid-feedback">
                {{ $errors->first('numero_credito') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-12">
        <label for="descuento"><i class="fas fa-percentage iconos-crear"></i>Descuento</label>
        <input placeholder="$1,000,000.00" data-type='currency'
            class="form-control {{ $errors->has('descuento') ? 'is-invalid' : '' }}" type="text" name="descuento"
            id="descuento" value="{{ old('descuento', $empleado->descuento) }}">
        <small id="error_descuento" class="text-danger"></small>
        @if ($errors->has('descuento'))
            <div class="invalid-feedback">
                {{ $errors->first('descuento') }}
            </div>
        @endif
    </div>
</div>
