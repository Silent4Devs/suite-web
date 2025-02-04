<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row mt-4">
        <h4 class="sub-titulo-form col s12">INFORMACIÓN GENERAL DEL CONTRATO</h4>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <div class="distancia">
                    <label>
                        <input type="checkbox" name="identificador_privado" id="check" value="1"
                            onchange="javascript:showContent()"
                            style="width: 20px; height: 20px; vertical-align:middle;" />
                        <span>Contrato Privado</span>
                    </label>
                </div>
            </div>
        </div>
        <input type="text" name="contrato_privado" style="visibility:hidden">
    </div>

    <div class="row">
        {{-- N° Contrato --}}
        <div class="distancia form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">
                N° Contrato <font class="asterisco">*</font>
            </label>
            <input type="text" class="form-control @error('no_contrato') is-invalid @enderror"
                wire:model.defer="no_contrato" id="no_contrato" maxlength="230">
            <span class="text-danger codigo_error error-ajax"></span>
            @error('no_contrato')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tipo de contrato --}}
        <div class="distancia form-group col-md-4">
            <label for="tipo_contrato" class="txt-tamaño">Tipo de contrato <font class="asterisco">*</font></label>
            <select class="form-control" wire:model="tipo_contrato">
                <option value="" selected disabled>Seleccione un tipo de contrato</option>
                @foreach ($tipos_contrato as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
            @error('tipo_contrato')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Razón Social --}}
        <div class="distancia form-group col-md-4">
            <label for="razon_soc_id">Razón Social con la que se prestará el servicio <font class="asterisco">*</font></label>
            <select class="form-control" wire:model="razon_soc_id">
                <option value="" selected disabled>-- Seleccione una Razón Social --</option>
                @foreach ($razones_sociales as $razon)
                    <option value="{{ $razon->id }}">{{ $razon->descripcion }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        {{-- Nombre del servicio --}}
        <div class="distancia form-group col-md-12">
            <label for="nombre_servicio" class="txt-tamaño">Nombre del servicio <font class="asterisco">*</font></label>
            <textarea id="textarea1" class="form-control" wire:model.defer="nombre_servicio" maxlength="550"></textarea>
            @error('nombre_servicio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        {{-- Nombre del cliente --}}
        <div class="distancia form-group col-md-6">
            <label for="proveedor_id" class="txt-tamaño">Nombre del cliente <font class="asterisco">*</font></label>
            <select class="form-control" wire:model="proveedor_id">
                <option value="" selected disabled>Seleccione un cliente</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            @error('proveedor_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Área --}}
        <div class="distancia form-group col-md-6">
            <label for="area_id" class="txt-tamaño">Área a la que pertenece el contrato:</label>
            <select class="form-control" wire:model="area_id">
                <option value="" selected disabled>Seleccione área</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                @endforeach
            </select>
            @error('area_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div style="margin-left: 10px;">
        @livewire('contratos-identificador-proyectos-int-ext')
    </div>

    <div class="row">
        {{-- Fase --}}
        <div class="form-group col-md-6">
            <label for="fase" class="txt-tamaño">
                Fase <font class="asterisco">*</font>
            </label>
            <select wire:model="fase" class="form-control">
                <option disabled selected>Seleccione</option>
                @foreach($fases as $faseItem)
                    <option value="{{ $faseItem }}">{{ $faseItem }}</option>
                @endforeach
            </select>
            @error('fase')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror
        </div>

        {{-- Estatus --}}
        <div class="form-group col-md-6">
            <label for="estatus" class="txt-tamaño">
                Estatus <font class="asterisco">*</font>
            </label>
            <select wire:model="estatus" class="form-control">
                <option disabled selected>Seleccionar...</option>
                @foreach($estatuses as $estatusItem)
                    <option value="{{ $estatusItem }}">{{ ucfirst($estatusItem) }}</option>
                @endforeach
            </select>
            @error('estatus')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Objetivo del Servicio --}}
    <div class="mt-4">
        <label for="objetivo" class="txt-tamaño">
            Objetivo del servicio <font class="asterisco">*</font>
        </label>
        <textarea wire:model="objetivo" class="form-control texto-linea" maxlength="500"></textarea>
        @error('objetivo')
            <div class="invalid-feedback red-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="row mt-4">
        {{-- Adjuntar Contrato --}}
        <div class="form-group col-md-4">
            <label for="file_contrato" class="txt-tamaño">Adjuntar Contrato <font class="asterisco">*</font></label>
            <input type="file" wire:model="file_contrato" id="file_contrato"
                class="form-control input_file_validar" accept=".docx,.pdf,.doc,.xlsx,.pptx,.txt" required>

            @error('file_contrato')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror

            <p id="compressStatus" class="mt-2 text-muted"></p>
            <small id="file_error" class="errors text-red-500"></small>

            {{-- Mensaje mientras se sube el archivo --}}
            <div wire:loading wire:target="file_contrato" class="alert-contrato-async">Estamos guardando su archivo</div>
        </div>

        {{-- Vigencia del contrato --}}
        <div class="form-group col-md-4">
            <label for="vigencia_contrato" class="txt-tamaño">Vigencia <font class="asterisco">*</font></label>
            <input type="text" wire:model="vigencia_contrato" id="vigencia_contrato"
                class="form-control" required maxlength="150">

            @error('vigencia_contrato')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror
        </div>

        {{-- Número de pagos --}}
        <div class="form-group col-md-4">
            <label for="no_pagos" class="txt-tamaño">No. Pagos <font class="asterisco">*</font></label>
            <input type="number" wire:model="no_pagos" id="no_pagos" class="form-control"
                required min="1">

            @error('no_pagos')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        {{-- Fecha de inicio --}}
        <div class="form-group col-md-4">
            <label for="fecha_inicio" class="txt-tamaño">Fecha de Inicio <font class="asterisco">*</font></label>
            <input type="date" wire:model="fecha_inicio" id="fecha_inicio" class="form-control" required>

            @error('fecha_inicio')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fecha de fin --}}
        <div class="form-group col-md-4">
            <label for="fecha_fin" class="txt-tamaño">Fecha de Fin <font class="asterisco">*</font></label>
            <input type="date" wire:model="fecha_fin" id="fecha_fin" class="form-control" required>

            @error('fecha_fin')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fecha de firma --}}
        <div class="form-group col-md-4">
            <label for="fecha_firma" class="txt-tamaño">Fecha de Firma <font class="asterisco">*</font></label>
            <input type="date" wire:model="fecha_firma" id="fecha_firma" class="form-control" required>

            @error('fecha_firma')
                <div class="invalid-feedback red-text">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div style="padding-left: 0%;">
        @livewire('moneda-ext-contratos-create')
    </div>

    <div class="col s12">
        <div class="row" style="margin-top: 20px; margin-left: 10px; margin-right: 10px;">
            <div class="col s12 m4 distancia">
                <p style="color:#2395AA">¿Aplica fianza o responsabilidad civil?</p>
                <div class="custom-control custom-switch form">
                    <input type="checkbox" id="check_aplica_fianza" class="custom-control-input"
                           wire:model="aplicaFianza">
                    <label class="custom-control-label" for="check_aplica_fianza">No/Sí</label>
                </div>
            </div>

            <div class="form-group col-md-12 distancia" x-show="aplicaFianza">
                <label class="txt-tamaño">Folio</label>
                <input type="text" wire:model.defer="folio" class="form-control"/>
            </div>

            <div class="form-group col-md-12 distancia" x-show="aplicaFianza">
                <label class="txt-tamaño">Documento</label>
                <input type="file" wire:model="documento" accept=".pdf" class="form-control"/>

                <div wire:loading wire:target="documento">Subiendo...</div>
                @error('documento') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mt-4">
            <h4 class="sub-titulo-form col s12">RESPONSABLES</h4>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label class="txt-tamaño">Nombre del Supervisor 1<span class="asterisco">*</span></label>
                <input type="text" wire:model.defer="pmp_asignado" class="form-control" required maxlength="250"/>
                @error('pmp_asignado') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group col-md-4">
                <label class="txt-tamaño">Puesto</label>
                <input type="text" wire:model.defer="puesto" class="form-control" maxlength="250"/>
            </div>

            <div class="form-group col-md-4">
                <label class="txt-tamaño">Área</label>
                <input type="text" wire:model.defer="area" class="form-control" maxlength="250"/>
                @error('area') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label class="txt-tamaño">Nombre del Supervisor 2</label>
                <input type="text" wire:model.defer="administrador_contrato" class="form-control" maxlength="250"/>
            </div>

            <div class="form-group col-md-4">
                <label class="txt-tamaño">Puesto</label>
                <input type="text" wire:model.defer="cargo_administrador" class="form-control" maxlength="150"/>
            </div>

            <div class="form-group col-md-4">
                <label class="txt-tamaño">Área</label>
                <input type="text" wire:model.defer="area_administrador" class="form-control" maxlength="150"/>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success mt-2">{{ session('message') }}</div>
        @endif


        <div class="form-group col-12 text-right mt-4">
            <div class="col s12 m12 right-align btn-grd distancia">
                <a id="btnCancelar" href="{{ route('contract_manager.contratos-katbol.index') }}"
                    class="btn btn-outline-primary">Cancelar</a>
                <button type="submit" class="btn btn-primary" wire:click="save">Guardar</button>
            </div>

        </div>
    </div>
</div>
