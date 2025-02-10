<div>

    {{-- Do your work, then step back. --}}
    {{-- <form wire:submit="updateContrato"> --}}

    <div class="card card-body">
        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="col s12" style="margin-top: 30px;">
                <h3 class="titulo-form">INSTRUCCIONES</h3>
                <div class="d-flex justify-content-between">
                    <p class="instrucciones">Edite los datos del contrato</p>

                </div>
            </div>
        </div>

        @if (!$show_contrato)
            <div class="row mt-4" style="margin-left: 10px; margin-right: 10px;">
                @if (!$firmado)
                    <div class="col-12">
                        <label for="aprobadores_firma">Activar flujo de aprobación</label>
                        <input type="checkbox" name="firma_check" value="1" id="aprobadores_firma"
                            style="width: 20px; height: 20px; vertical-align: middle;"
                            {{ isset($aprobacionFirmaContratoHisotricoLast->firma_check) && $aprobacionFirmaContratoHisotricoLast->firma_check ? 'checked' : '' }}>
                    </div>
                @endif
                @if (!$firmado)
                    <div class="col-12 {{ isset($aprobacionFirmaContratoHisotricoLast->firma_check) ? ($aprobacionFirmaContratoHisotricoLast->firma_check ? '' : 'd-none') : 'd-none' }}"
                        id="aprobadores-firma-box">
                        <div class="form-group">
                            <label for="">Asignar Aprobadores</label>
                            <select name="aprobadores_firma[]" id="aprobadores" multiple class="form-control">
                                @if ($firma && $firma->aprobadores)
                                    @foreach ($firma->aprobadores as $aprobador)
                                        <option value="{{ $aprobador->id }}"
                                            {{ $aprobacionFirmaContrato->contains('aprobador_id', $aprobador->id) ? 'selected' : '' }}>
                                            {{ $aprobador->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option disabled>No hay aprobadores disponibles</option>
                                @endif
                            </select>
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <p>No es posible modificar el flujo de aprobación una vez iniciado</p>
                    </div>
                @endif
            </div>
        @endif

        <div class="row mt-4" style="margin-left: 10px; margin-right: 10px;">
            <h4 class="sub-titulo-form col s12">INFORMACIÓN GENERAL DEL CONTRATO</h4>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            @if ($convenios->count() > 0)
                <div class="col s12 right-align">
                    <!-- Botón para abrir el modal -->
                    <a id="openModal" class="waves-effect waves-light btn">Visualizar Convenios Modificados</a>
                </div>
            @endif
        </div>

        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">N°
                    Contrato<font class="asterisco">*
                    </font></label>
                <input class="form-control {{ $errors->has('no_contrato') ? 'is-invalid' : '' }}" type="text"
                    maxlength="230" wire:model="no_contrato" id="no_contrato"
                    @if ($show_contrato) disabled @endif required>
                <span id="existCode"></span>
                @if ($errors->has('no_contrato'))
                    <span class="text-danger">{{ $errors->first('no_contrato') }}</span>
                @endif
                <span class="text-danger codigo_error error-ajax"></span>
            </div>

            <div class="distancia form-group col-md-4">
                <label for="tipo_contrato" class="txt-tamaño">Tipo de contrato<font class="asterisco">*</font></label>
                <div>
                    <select wire:model="tipo_contrato" id="tipo_contrato" class="form-control required"
                        {{ $show_contrato ? 'disabled' : '' }}>
                        <option value="">Seleccione...</option>
                        @foreach (['Fábrica de desarrollo', 'Fábrica de pruebas', 'Telecomunicaciones', 'Seguridad de la información', 'Infraestructura', 'Servicios en la Nube', 'Servicios de consultoría Normativa', 'Arrendamiento de Equipos', 'Adquisición de bienes', 'Impresión', 'Soporte', 'Licenciamiento', 'Administrativo', 'Adquisición de papelería', 'Servicios de Consultoría', 'Servicios Médicos', 'Servicio de Seguros', 'Seguridad y Vigilancia', 'Servicio de Limpieza', 'Servicios de Alimentos', 'Educación Continua', 'Mantenimiento a Edificio', 'Adquisición de Mascarillas', 'Adquisición de Pruebas COVID', 'Restauración de Edificios', 'Servicio de Estacionamiento', 'Abastecimiento y Distribución de Revista y Periódicos', 'Otro'] as $option)
                            <option value="{{ $option }}">
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="distancia form-group col-md-4">
                <label for="razon_soc_id">Razón Social con la que se prestará el servicio<font class="asterisco">*
                    </font></label>
                <select class="form-control" wire:model="razon_soc_id" id="razon_soc_id"
                    {{ $show_contrato ? 'disabled' : 'required' }}>
                    <option disabled {{ $contrato->razonSocial ? '' : 'selected' }}>-- Seleccione una Razón Social --
                    </option>
                    @foreach ($razones_sociales as $razon)
                        <option value="{{ $razon->id }}"
                            {{ isset($contrato->razonSocial) && $contrato->razonSocial->id == $razon->id ? 'selected' : '' }}>
                            {{ $razon->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-12">
                <label for="nombre_servicio" class="txt-tamaño">
                    Nombre del servicio<font class="asterisco">*</font></label><br>
                <div class="form-floating">
                    <textarea id="textarea1" maxlength="550" class="form-control" wire:model="nombre_servicio"
                        {{ $show_contrato ? 'readonly' : '' }} @if ($show_contrato) disabled @endif required>{{ $contrato->nombre_servicio }}</textarea>
                </div>
                @if ($errors->has('nombre_servicio'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('nombre_servicio') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Nombre del
                    Cliente<font class="asterisco">*</font></label>
                <select wire:model="proveedor_id" class="form-control required" {{ $show_contrato ? 'disabled' : '' }}
                    required>
                    @if ($proveedores)
                        @foreach ($proveedores as $proveedoress)
                            <option value="{{ $proveedoress->id }}">
                                {{ $proveedoress->nombre }}</option>
                        @endforeach
                    @else
                        <option value="">No hay proveedores registrados</option>
                    @endif
                </select>
            </div>

            @if ($contrato->proyectoConvergencia)
                <div class="distancia form-group col-md-4">
                    <label for="no_proyecto" class="txt-tamaño">Número de proyecto</label>
                    <select class="form-control" wire:model="no_proyecto" id="no_proyecto"
                        @if ($show_contrato) disabled @endif>
                        <option value="" selected>Seleccione un Número de proyecto</option>
                        @foreach ($proyectos as $proyecto)
                            <option data-id="{{ $proyecto->id }}" value="{{ $proyecto->identificador }}">
                                {{ $proyecto->identificador }} - {{ $proyecto->proyecto }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('no_proyecto'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('no_proyecto') }}
                        </div>
                    @endif
                </div>
            @else
                <div class="distancia form-group col-md-4">
                    <label for="no_proyecto" class="txt-tamaño">
                        Número de proyecto</label>
                    <input type="text" maxlength="250" wire:model="no_proyecto" id="no_proyecto"
                        class="form-control" @if ($show_contrato) disabled @endif>
                </div>
            @endif

            @if ($areas->count() > 0)
                <div class="distancia form-group col-md-4">
                    <label for="area_id" class="txt-tamaño">
                        Área a la que pertenece el
                        contrato</label>
                    <select class="form-control" wire:model="area_id" id="area_id"
                        @if ($show_contrato) disabled @endif required>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">
                                {{ $area->area }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('area_id'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('area_id') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="form-group col-md-6">
                <label for="fase" class="txt-tamaño">
                    Fase<font class="asterisco">*</font>
                </label><br>
                <select wire:model="fase" id="fase" class="form-control"
                    {{ $show_contrato ? 'disabled' : '' }}>
                    <option value="">Seleccione...</option>
                    @foreach (['Solicitud de contrato', 'Autorización', 'Negociación', 'Aprobación', 'Ejecución', 'Gestión de obligaciones', 'Modificación de contrato', 'Auditoría y reportes', 'Renovación'] as $option)
                        <option value="{{ $option }}">
                            {{ $option }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('fase'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('fase') }}
                    </div>
                @endif
            </div>

            <div class="distancia form-group col-md-6">
                <label for="estatus" class="txt-tamaño">
                    Estatus<font class="asterisco">*</font>
                </label>
                <select wire:model="estatus" id="estatus" class="form-control"
                    {{ $show_contrato ? 'disabled' : '' }}>
                    <option value="">Seleccione...</option>
                    @foreach ([
        'vigentes' => 'Vigente',
        'Cerrado' => 'Cerrado',
        'renovaciones' => 'Renovación',
    ] as $value => $label)
                        <option value="{{ $value }}">
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('estatus'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
            </div>
        </div>


        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="form-group col-md-12">
                <label for="objetivo" class="txt-tamaño">
                    Objetivo del servicio<font class="asterisco">*</font></label>
                <textarea style="text-align:justify" maxlength="500" id="textarea1" class="form-control" wire:model="objetivo"
                    @if ($show_contrato) disabled @endif required>{{ $contrato->objetivo }}</textarea>
                @if ($errors->has('objetivo'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('objetivo') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            @if ($contrato->file_contrato != null)
                <div class="distancia form-group col-md-6">
                    <label for="" class="txt-tamaño">
                        Adjuntar Contrato
                        <font class="asterisco">*</font>
                    </label>
                    <div class="file-field input-field">
                        <div class="btn" {{ !$show_contrato ? 'onclick=mostrarAlerta()' : '' }}>
                            <span>Documento Actual:</span>
                        </div>

                        <div class="file-path-wrapper">
                            <input value="{{ $contrato->file_contrato }}" class="file-path validate form-control"
                                type="text" placeholder="Elegir documento" {{ $show_contrato ? 'readonly' : '' }}
                                readonly>
                        </div>
                        <a href="{{ asset(trim('storage/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/' . $contrato->file_contrato)) }}"
                            target="_blank" class=" descarga_archivo" style="margin-left:20px;">
                            Descargar archivo actual</a>
                    </div>
                </div>
            @endif
            <div class="distancia form-group col-md-6">
                @if (!$show_contrato)
                    <div class="fondo_delete">
                        <div class="delete">
                            <h6 class="titulo-alert">Cambiar el documento:</h6>
                            <p class="parrafo">Al cambiarlo se eliminara el archivo actual</p>
                        </div>
                    </div>
                    @if (!is_null($organizacion))
                        <input class="form-control" type="file" wire:model.lazy="file_contrato"
                        accept=".docx,.pdf,.doc,.xlsx,.pptx,.txt,.jpg,.jpeg,.png,.tiff">

                        <div wire:loading wire:target="file_contrato">
                            <div class="spinner-grow text-primary" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <div class="spinner-grow text-secondary" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <div class="spinner-grow text-success" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <div class="spinner-grow text-danger" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <div class="spinner-grow text-warning" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <div class="spinner-grow text-info" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <div class="spinner-grow text-light" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <div class="spinner-grow text-dark" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                        @if ($errors->has('file_contrato'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('file_contrato') }}
                            </div>
                        @endif
                    @endif

                @endif

            </div>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label for="vigencia_contrato" class="txt-tamaño">Vigencia<font class="asterisco">*</font></label>
                <input type="text" wire:model="vigencia_contrato" id="vigencia_contrato" class="form-control"
                    required maxlength="150" {{ $show_contrato ? 'readonly' : '' }}>
                @if ($errors->has('vigencia_contrato'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('vigencia_contrato') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="no_pagos" class="txt-tamaño">No. Pagos<font class="asterisco">*</font></label>
                <input type="number" wire:model="no_pagos" id="no_pagos" class="form-control" required
                    pattern="[0-9]+" min="0" step="1" {{ $show_contrato ? 'readonly' : '' }}>
                @if ($errors->has('no_pagos'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('no_pagos') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Fecha
                    de
                    inicio<font class="asterisco">*</font></label>
                <input type="date" wire:model="fecha_inicio" id="fecha_inicio" class="form-control" required
                    @if ($show_contrato) disabled @endif>
                @if ($errors->has('fecha_inicio'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('fecha_inicio') }}
                    </div>
                @endif
            </div>
            <div class="distancia form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Fecha
                    fin<font class="asterisco">*
                    </font></label>
                <input type="date" wire:model="fecha_fin" id="fecha_fin" class="form-control"
                    @if ($show_contrato) disabled @endif>
                @if ($errors->has('fecha_fin'))
                    <div class="invalid-feedback red-text" style="position:absolute;">
                        {{ $errors->first('fecha_fin') }}
                    </div>
                @endif
            </div>
            <div class="distancia form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Fecha
                    de firma
                    <font class="asterisco">*</font>
                </label>
                <input required type="date" wire:model="fecha_firma" id="fecha_firma" class="form-control"
                    @if ($show_contrato) disabled @endif>
                @if ($errors->has('fecha_firma'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('fecha_firma') }}
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div style="padding-left: 25px; padding-right: 25px;">
                {{-- The Master doesn't talk, he acts. --}}
                <div class="row" style="padding-left: 0%;">
                    <div class="form-group col-md-4">
                        <label for="tipo_cambio" class="txt-tamaño">Tipo
                            Cambio
                            <font class="asterisco">*
                            </font>
                        </label>
                        <select wire:model="tipo_cambio" wire:change="changeTipoCambio($event.target.value)"
                            id="tipo_cambio" class="form-control" required>
                            <option value="" disabled selected>Seleccione una moneda</option>
                            @foreach ($divisas as $key => $divisa)
                                <option value="{{ $divisa }}">
                                    {{ $divisa }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('tipo_cambio'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('tipo_cambio') }}
                            </div>
                        @endif
                    </div>

                    @if ($moneda_extranjera)
                        <div class="form-group col-md-4">
                            <label for="valor_dolar" class="txt-tamaño">
                                Valor de la moneda (a día de hoy) <font class="asterisco">*
                                </font>
                            </label>
                            <input min="0" required class="form-control" type="number" step=".01"
                                wire:model="valor_dolar" id="valor_dolar"
                                wire:change="valorManual($event.target.value)"
                                @if (!$edit_moneda) readonly @endif>
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" wire:model="edit_moneda"
                                    id="edit_moneda" wire:model.live="edit_moneda">
                                <label class="form-check-label" for="edit_moneda" style="font-size:16px;">
                                    Ingresar valor de la moneda manualmente.
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($moneda_extranjera)
                    {{-- <div id="campos_dolares" class="{{ $contratos->tipo_cambio == 'USD' ? '' : 'd-none' }}"> --}}
                    <div class="row" style="padding-left: 0%;">
                        <div class="form-group col-md-4">
                            <label for="monto_dolares" class="txt-tamaño">
                                Monto de
                                pago ({{ $tipo_cambio }}) <font class="asterisco">*
                                </font>
                            </label>
                            <input min="0" required type="number" wire:model="monto_dolares"
                                {{-- wire:model="monto_dolares" --}} value="{{ old('monto_dolares', $monto_dolares) }}"
                                wire:change="convertirME($event.target.value,'monto')" id="monto_dolares"
                                class="form-control" step=".01">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="maximo_dolares" class="txt-tamaño">
                                Monto
                                Máximo ({{ $tipo_cambio }})
                            </label>
                            <input type="number" {{-- wire:model="maximo_dolares" --}}
                                value="{{ old('maximo_dolares', $maximo_dolares) }}" wire:model="maximo_dolares"
                                wire:change="convertirME($event.target.value,'maximo')" id="dolar_maximo"
                                class="form-control" step=".01">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="minimo_dolares" class="txt-tamaño">
                                Monto
                                Mínimo ({{ $tipo_cambio }})
                            </label>
                            <input type="number" {{-- wire:model="minimo_dolares" --}}
                                value="{{ old('minimo_dolares', $minimo_dolares) }}" wire:model="minimo_dolares"
                                wire:change="convertirME($event.target.value,'minimo')" id="dolar_minimo"
                                class="form-control" step=".01">
                        </div>
                    </div>
                @endif

                <div class="row" style="padding-left: 0%;">
                    <div class="form-group col-md-4">
                        <label for="monto_pago" class="txt-tamaño">Monto de Pago M.X.N.<font class="asterisco">*
                            </font></label>
                        <input type="number" wire:model="monto_pago" id="monto_pago" class="form-control"
                            step=".01" value="{{ old('monto_pago', $monto_pago) }}" required
                            @if ($moneda_extranjera) readonly @endif>
                        @if ($errors->has('monto_pago'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('monto_pago') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="maximo" class="txt-tamaño">Monto máximo M.X.N.</label>
                        <input type="number" wire:model="maximo" id="maximo" class="form-control"
                            step=".01" value="{{ old('maximo', $maximo) }}"
                            @if ($moneda_extranjera) readonly @endif>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="minimo" class="txt-tamaño">Monto mínimo M.X.N.</label>
                        <input type="number" wire:model="minimo" id="minimo" class="form-control"
                            step=".01" value="{{ old('minimo', $minimo) }}"
                            @if ($moneda_extranjera) readonly @endif>
                    </div>

                    <script>
                        Livewire.on('actualizarValores', ({
                            monto_pago,
                            maximo,
                            minimo
                        }) => {
                            document.getElementById('monto_pago').value = monto_pago;
                            document.getElementById('maximo').value = maximo;
                            document.getElementById('minimo').value = minimo;
                        });
                    </script>

                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px; margin-left: 10px; margin-right: 10px;">
            <div class="col s12 m12">
                <table class="table">
                    <thead style="background-color: transparent !important; color:#3086AF !important;">
                        <th class=""> <label> ¿Aplica fianza o
                                responsabilidad civil? </label></th>
                        <th class=" txt-frm">
                            <label>
                                <font class="td_fianza">Número de folio</font>
                            </label>
                        </th>
                        <th class=" txt-frm">
                            <label>
                                <font class="td_fianza">Adjuntar documento</font>
                            </label>
                        </th>
                    </thead>
                    <tbody>

                        <td>
                            <div class="inline input-field linea">
                                <div class="switch" style="margin-top: -5px; margin-left: 8px;">
                                    @if (isset($contrato))
                                        @if (isset($contrato->documento) || isset($contrato->folio))
                                            <div class="custom-control custom-switch form">
                                                <input type="checkbox" class="custom-control-input" id="check_fianza"
                                                    wire:model="aplicaFinaza" {{ $show_contrato ? 'disabled' : '' }}
                                                    checked>
                                                <label class="custom-control-label" for="check_fianza">No/Sí</label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-switch form">
                                                <input type="checkbox" class="custom-control-input" id="check_fianza"
                                                    wire:model="aplicaFinaza" {{ $show_contrato ? 'disabled' : '' }}>
                                                <label class="custom-control-label" for="check_fianza">No/Sí</label>
                                            </div>
                                        @endif
                                    @else
                                        <div class="custom-control custom-switch form">
                                            <input type="checkbox" class="custom-control-input" id="check_fianza"
                                                wire:model="aplicaFinaza" {{ $show_contrato ? 'disabled' : '' }}>
                                            <label class="custom-control-label" for="check_fianza">No/Sí</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="td_fianza">
                                <input type="text" wire:model="folio" id="folio" class="form-control"
                                    {{ $show_contrato ? 'readonly' : '' }}>
                            </div>
                        </td>
                        <td>
                            <div class="td_fianza">
                                <input class="form-control" type="file" wire:model="documento" accept=".pdf"
                                    readonly>
                            </div>
                            <div wire:loading wire:target="documento">
                                <div class="spinner-grow text-primary" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="spinner-grow text-secondary" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="spinner-grow text-success" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="spinner-grow text-danger" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="spinner-grow text-warning" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="spinner-grow text-info" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="spinner-grow text-light" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <div class="spinner-grow text-dark" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <div class="ml-4 display-flex">
                                <label class="red-text">{{ $errors->first('Type') }}</label>
                            </div>
                            @if ($contrato->documento != null)
                                <a href="{{ asset(trim('storage/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones/' . $contrato->documento)) }}"
                                    target="_blank" class="descarga_archivo" style="margin-left:20px;">
                                    Descargar
                                </a>
                            @endif
                            <div class="ml-4 display-flex">
                                <label class="red-text">{{ $errors->first('Type') }}</label>
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <br>
            <br>
            <br>
        </div>
        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <h4 class="sub-titulo-form col s12">RESPONSABLES</h4>
        </div>
        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label class="txt-tamaño">
                    Nombre del Supervisor 1<font class="asterisco">*</font>
                </label>
                <div>
                    <input type="text" wire:model="pmp_asignado" id="pmp_asignado" maxlength="250"
                        class="form-control" {{ $show_contrato ? 'readonly' : '' }} required>
                </div>
            </div>

            <div class="distancia form-group col-md-4">
                <label class="txt-tamaño">Puesto</label>
                <div>
                    <input type="text" wire:model="puesto" id="puesto" maxlength="250" class="form-control"
                        {{ $show_contrato ? 'readonly' : '' }}>
                </div>
            </div>

            <div class="distancia form-group col-md-4">
                <label class="txt-tamaño">Área</label>
                <div>
                    <input type="text" wire:model="area" id="area" maxlength="250" class="form-control"
                        {{ $show_contrato ? 'readonly' : '' }}>
                    @if ($errors->has('area'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('area') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label class="txt-tamaño">Nombre del Supervisor 2</label>
                <input type="text" wire:model="administrador_contrato" id="administrador_contrato"
                    maxlength="250" class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
                @if ($errors->has('administrador_contrato'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('administrador_contrato') }}
                    </div>
                @endif
            </div>

            <div class="distancia form-group col-md-4">
                <label class="txt-tamaño">Puesto</label>
                <input type="text" wire:model="cargo_administrador" id="cargo_administrador" maxlength="250"
                    class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
                @if ($errors->has('cargo_administrador'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('cargo_administrador') }}
                    </div>
                @endif
            </div>

            <div class="distancia form-group col-md-4">
                <label class="txt-tamaño">Área</label>
                <input type="text" wire:model="area_administrador" id="area_administrador" maxlength="250"
                    class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
                @if ($errors->has('area_administrador'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('area_administrador') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
            <div class="col s12 right-align btn-grd distancia">
                @if (!$show_contrato)
                    <a href="{{ route('contract_manager.contratos-katbol.index') }}"
                        class="btn btn-outline-primary">Cancelar</a>
                    <button type="button" wire:click.prevent="updateContrato"
                        class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>

    </div>
</div>
<!-- Submit Field -->
{{-- </form> --}}
</div>
