<style>
    .iconos-crear {
        font-size: 20pt;
        margin-right: 18px;
    }

    .cedula-diseño tr {

        border: none;

    }

    .cedula-diseño td {

        padding: 0;
    }

    .descarga_archivo {

        cursor: pointer;

    }

    #contenedor_dolares .select-wrapper {
        display: block !important;
    }


    .d-none {
        display: none !important;
    }


    .descarga_archivo:hover {
        color: #26a69a !important;
    }


    .card-panel .txt-frm {
        font-weight: bolder !important;
    }



    /*select*/



    .p-oculta {
        display: none;
    }

    #existCode {
        font-weight: bold;
    }

    .input-code {
        border-bottom: : 2px solid rgb(18, 118, 250) !important;
    }

    .exists {
        border-bottom: : 2px solid red !important;
        color: red !important;
    }

    .not-exists {
        /* border-bottom: 2px solid rgb(18, 250, 114) !important; */
    }

    @media(max-width: 768px) {
        .formulario-tabla-datos-responsiva thead {
            display: none;
        }

        .formulario-tabla-datos-responsiva td {
            display: block;
            width: 80% !important;
        }

        .formulario-tabla-datos-responsiva td .select2.select2-container.select2-container--default {
            max-width: 100% !important;
        }

        .formulario-tabla-datos-responsiva td:before {
            display: block;
        }

        .p-oculta {
            display: block;
        }
    }
</style>
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

<style>
    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
</style>



@if (session('mensajeError'))
    <div class="alert alert-danger">
        {{ session('mensajeError') }}
    </div>
@endif

{{-- <form method="PATH" action="{{ route('contratos.update', $contrato->id) }}" enctype="multipart/form-data"> --}}
<form action="{{ route('contract_manager.contratos-katbol.update', $contrato->id) }}" method="POST"
    enctype="multipart/form-data" id="update-form">
    @csrf
    @method('PATCH')

    @csrf

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
                    <a class="waves-effect waves-light btn modal-trigger" href="#convenios_modificados">Visualizar
                        Convenios
                        Modificados</a>
                </div>
            @endif
        </div>

        {{-- <div class="distancia form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">N° Contrato<font class="asterisco">*</font></label>
                <div>
                    {!! Form::text('no_contrato', $contrato->no_contrato, ['no_contrato' => 'no_contrato', 'onkeyup' => 'replaceSlash(this);', 'class' => 'form-control', 'required', $show_contrato ? 'readonly' : '', 'autocomplete' => 'off']) !!}
                    @if ($errors->has('no_contrato'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('no_contrato') }}
                        </div>
                    @endif
                </div>
            </div> --}}


        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">N°
                    Contrato<font class="asterisco">*
                    </font></label>
                <input class="form-control {{ $errors->has('no_contrato') ? 'is-invalid' : '' }}" type="text"
                    maxlength="230" name="no_contrato" id="no_contrato"
                    value="{{ old('no_contrato', $contrato->no_contrato) }}"
                    @if ($show_contrato) disabled @endif required>
                <span id="existCode"></span>
                @if ($errors->has('no_contrato'))
                    <span class="text-danger">{{ $errors->first('no_contrato') }}</span>
                @endif
                <span class="text-danger codigo_error error-ajax"></span>
                {{-- @if ($errors->has('no_contrato'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('no_contrato') }}
                    </div>
                @endif --}}
            </div>

            <div class="distancia form-group col-md-4">
                <label for="tipo_contrato" class="txt-tamaño">Tipo de contrato<font class="asterisco">*</font></label>
                <div>
                    <select name="tipo_contrato" id="tipo_contrato" class="form-control required"
                        {{ $show_contrato ? 'disabled' : '' }}>
                        <option value="">Seleccione...</option>
                        @foreach (['Fábrica de desarrollo', 'Fábrica de pruebas', 'Telecomunicaciones', 'Seguridad de la información', 'Infraestructura', 'Servicios en la Nube', 'Servicios de consultoría Normativa', 'Arrendamiento de Equipos', 'Adquisición de bienes', 'Impresión', 'Soporte', 'Licenciamiento', 'Administrativo', 'Adquisición de papelería', 'Servicios de Consultoría', 'Servicios Médicos', 'Servicio de Seguros', 'Seguridad y Vigilancia', 'Servicio de Limpieza', 'Servicios de Alimentos', 'Educación Continua', 'Mantenimiento a Edificio', 'Adquisición de Mascarillas', 'Adquisición de Pruebas COVID', 'Restauración de Edificios', 'Servicio de Estacionamiento', 'Abastecimiento y Distribución de Revista y Periódicos', 'Otro'] as $option)
                            <option value="{{ $option }}"
                                {{ $contrato->tipo_contrato == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="distancia form-group col-md-4">
                <label for="razon_soc_id">Razón Social con la que se prestará el servicio<font class="asterisco">*
                    </font></label>
                <select class="form-control" name="razon_soc_id" id="razon_soc_id"
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
                    <textarea id="textarea1" maxlength="550" class="form-control" value="{{ $contrato->nombre_servicio }}"
                        name="nombre_servicio" {{ $show_contrato ? 'readonly' : '' }} @if ($show_contrato) disabled @endif
                        required>{{ $contrato->nombre_servicio }}</textarea>
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
                <select name="proveedor_id" class="form-control required" {{ $show_contrato ? 'disabled' : '' }}
                    required>
                    @if ($proveedores)
                        @foreach ($proveedores as $proveedoress)
                            <option value="{{ $proveedoress->id }}"
                                {{ $proveedoress->id == $proveedor_id ? 'selected' : '' }}>
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
                    <select class="form-control" name="no_proyecto" id="no_proyecto"
                        @if ($show_contrato) disabled @endif>
                        <option value="" selected>Seleccione un Número de proyecto</option>
                        @foreach ($proyectos as $proyecto)
                            <option data-id="{{ $proyecto->id }}" value="{{ $proyecto->identificador }}"
                                @if ($contrato->proyectoConvergencia->id == $proyecto->id) selected @endif>
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
                    <input type="text" maxlength="250" name="no_proyecto" id="no_proyecto" class="form-control"
                        value="{{ $contrato->no_proyecto }}" @if ($show_contrato) disabled @endif>
                </div>
            @endif

            @if ($areas->count() > 0)
                <div class="distancia form-group col-md-4">
                    <label for="area_id" class="txt-tamaño">
                        Área a la que pertenece el
                        contrato</label>
                    <select class="form-control" name="area_id" id="area_id"
                        @if ($show_contrato) disabled @endif required>
                        @foreach ($areas as $area)
                            <option {{ $area->id == $contrato->area_id ? 'selected' : '' }}
                                value="{{ $area->id }}">
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
                <select name="fase" id="fase" class="form-control" {{ $show_contrato ? 'disabled' : '' }}>
                    <option value="">Seleccione...</option>
                    @foreach (['Solicitud de contrato', 'Autorización', 'Negociación', 'Aprobación', 'Ejecución', 'Gestión de obligaciones', 'Modificación de contrato', 'Auditoría y reportes', 'Renovación'] as $option)
                        <option value="{{ $option }}" {{ $contrato->fase == $option ? 'selected' : '' }}>
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
                <select name="estatus" id="estatus" class="form-control" {{ $show_contrato ? 'disabled' : '' }}>
                    <option value="">Seleccione...</option>
                    @foreach ([
        'vigentes' => 'Vigente',
        'Cerrado' => 'Cerrado',
        'renovaciones' => 'Renovación',
    ] as $value => $label)
                        <option value="{{ $value }}" {{ $contrato->estatus == $value ? 'selected' : '' }}>
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
                <textarea style="text-align:justify" maxlength="500" id="textarea1" class="form-control"
                    value="{{ $contrato->objetivo }}" name="objetivo" @if ($show_contrato) disabled @endif required>{{ $contrato->objetivo }}</textarea>
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
                            {{-- <div align="right" class="caja_botones_alert">
                                    <div class="cancelar btn">Cancelar</div>
                                </div> --}}
                        </div>
                    </div>
                    @if (is_null($organizacion))
                    @else
                        {{-- <div class="btn btn-accion">
                                <span>OK</span>
                            </div> --}}
                        <input class="form-control input_file_validar" type="file" name="file_contrato"
                            accept=".docx,.pdf,.doc,.xlsx,.pptx,.txt" {{ $show_contrato ? 'disabled' : '' }} readonly>
                        @if ($errors->has('file_contrato'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('file_contrato') }}
                            </div>
                        @endif
                    @endif

                @endif

                <small id="file_error" class="errors" style="color:red"></small>
                <div id="loaderContractTmpFile" class="alert-contrato-async" style="display:none">
                    Estámos Guardando su archivo
                </div>
                <div class="progress" id="progressUploadContractContainer" style="display: none">
                    <div class="determinate" id="progressUploadContract"></div>
                </div>
                <div class="alert-contrato-file" id="alertContratoUploadTmp" style="display: none">
                    Contrato Cargado
                </div>
                <div class="ml-4 display-flex">
                    <label class="red-text">{{ $errors->first('Type') }}</label>
                </div>
                <div class="ml-4 display-flex">
                    <label class="red-text">{{ $errors->first('Type') }}</label>
                </div>
            </div>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label for="vigencia_contrato" class="txt-tamaño">Vigencia<font class="asterisco">*</font></label>
                <input type="text" name="vigencia_contrato" id="vigencia_contrato"
                    value="{{ old('vigencia_contrato', $contrato->vigencia_contrato) }}" class="form-control"
                    required maxlength="150" {{ $show_contrato ? 'readonly' : '' }}>
                @if ($errors->has('vigencia_contrato'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('vigencia_contrato') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="no_pagos" class="txt-tamaño">No. Pagos<font class="asterisco">*</font></label>
                <input type="number" name="no_pagos" id="no_pagos"
                    value="{{ old('no_pagos', $contrato->no_pagos) }}" class="form-control" required
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
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                    value="{{ old('fecha_inicio', $contrato->fecha_inicio) }}" required
                    @if ($show_contrato) disabled @endif>
                {{-- {!! Form::text('fecha_inicio', $contrato->fecha_inicio, [
                'class' => 'form-control fecha_inicio_contrato', 'required',
                $show_contrato ? 'disabled' : '',
                'readonly',
            ]) !!} --}}

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
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                    value="{{ old('fecha_fin', $contrato->fecha_fin) }}"
                    @if ($show_contrato) disabled @endif>
                {{-- {!! Form::text('fecha_fin', $contrato->fecha_fin, [
                'class' => 'form-control fecha_fin_contrato' ,'required',
                $show_contrato ? 'disabled' : '',
                'readonly',
            ]) !!} --}}
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
                <input required type="date" name="fecha_firma" id="fecha_firma" class="form-control"
                    value="{{ old('fecha_firma', $contrato->fecha_firma) }}"
                    @if ($show_contrato) disabled @endif>
                {{-- {!! Form::text('fecha_firma', $contrato->fecha_firma, [
                'class' => 'form-control datepicker',
                $show_contrato ? 'disabled' : '',
                'readonly',
            ]) !!} --}}
                @if ($errors->has('fecha_firma'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('fecha_firma') }}
                    </div>
                @endif
            </div>
        </div>

        @livewire('moneda-ext-contratos-edit', ['id_contrato' => $contrato->id])

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
                                    @if (isset($contratos))
                                        @if (isset($contrato->documento) || isset($contratos->folio))
                                            <div class="custom-control custom-switch form">
                                                <input type="checkbox" class="custom-control-input" id="check_fianza"
                                                    name="aplicaFinaza" {{ $show_contrato ? 'disabled' : '' }}
                                                    checked>
                                                <label class="custom-control-label" for="check_fianza">No/Sí</label>
                                            </div>
                                            {{-- <input id="check_fianza" type="checkbox" name="aplicaFinaza" checked
                                            {{ $show_contrato ? 'disabled' : '' }}> --}}
                                        @else
                                            <div class="custom-control custom-switch form">
                                                <input type="checkbox" class="custom-control-input" id="check_fianza"
                                                    name="aplicaFinaza" {{ $show_contrato ? 'disabled' : '' }}>
                                                <label class="custom-control-label" for="check_fianza">No/Sí</label>
                                            </div>
                                            {{-- <input id="check_fianza" type="checkbox" name="aplicaFinaza"
                                            {{ $show_contrato ? 'disabled' : '' }}> --}}
                                        @endif
                                    @else
                                        <div class="custom-control custom-switch form">
                                            <input type="checkbox" class="custom-control-input" id="check_fianza"
                                                name="aplicaFinaza" {{ $show_contrato ? 'disabled' : '' }}>
                                            <label class="custom-control-label" for="check_fianza">No/Sí</label>
                                        </div>
                                        {{-- <input id="check_fianza" type="checkbox" name="aplicaFinaza"
                                        {{ $show_contrato ? 'disabled' : '' }}> --}}
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="td_fianza">
                                <input type="text" name="folio" id="folio"
                                    value="{{ old('folio', $contratos->folio) }}" class="form-control"
                                    {{ $show_contrato ? 'readonly' : '' }}>
                            </div>
                        </td>
                        <td>
                            <div class="td_fianza">
                                <input class="form-control" type="file" name="documento" accept=".pdf" readonly>
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
                <input type="text" name="pmp_asignado" id="pmp_asignado"
                    value="{{ old('pmp_asignado', $contratos->pmp_asignado) }}" maxlength="250" class="form-control"
                    {{ $show_contrato ? 'readonly' : '' }} required>
            </div>
        </div>

        <div class="distancia form-group col-md-4">
            <label class="txt-tamaño">Puesto</label>
            <div>
                <input type="text" name="puesto" id="puesto" value="{{ old('puesto', $contratos->puesto) }}"
                    maxlength="250" class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
            </div>
        </div>

        <div class="distancia form-group col-md-4">
            <label class="txt-tamaño">Área</label>
            <div>
                <input type="text" name="area" id="area" value="{{ old('area', $contratos->area) }}"
                    maxlength="250" class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
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
            <input type="text" name="administrador_contrato" id="administrador_contrato"
                value="{{ old('administrador_contrato', $contratos->administrador_contrato) }}" maxlength="250"
                class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
            @if ($errors->has('administrador_contrato'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('administrador_contrato') }}
                </div>
            @endif
        </div>

        <div class="distancia form-group col-md-4">
            <label class="txt-tamaño">Puesto</label>
            <input type="text" name="cargo_administrador" id="cargo_administrador"
                value="{{ old('cargo_administrador', $contratos->cargo_administrador) }}" maxlength="250"
                class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
            @if ($errors->has('cargo_administrador'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('cargo_administrador') }}
                </div>
            @endif
        </div>

        <div class="distancia form-group col-md-4">
            <label class="txt-tamaño">Área</label>
            <input type="text" name="area_administrador" id="area_administrador"
                value="{{ old('area_administrador', $contratos->area_administrador) }}" maxlength="250"
                class="form-control" {{ $show_contrato ? 'readonly' : '' }}>
            @if ($errors->has('area_administrador'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('area_administrador') }}
                </div>
            @endif
        </div>
        {{-- <div class="row"></div>
    <div class="row">
        <br>
        <label class="txt-tamaño" for="firma">
            Firma:</label>
        <br/>
        <br>
        @if ($contratos->firma1 != null)
            <p>Ya existe una firma registrada para este contrato</p>
            <p>Si desea cambiar la firma registrada de click en el recuadro de abajo y
                firme el espacio.</p><br>
            <label class="txt-tamaño">Actualizar firma </label>
            <input type="checkbox" style="pointer-events: auto; opacity: 1; width: 20px; height: 20px" unchecked
            onclick="var input = document.getElementById('signature64');
            if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" />
        @endif
    </div>
    <div class="col s12 m3 distancia"></div>
    <div class="distancia form-group col-md-4">
        <div id="signaturePad" >
            <textarea id="signature64" name="signed" style="display:none" disabled="disabled"></textarea>
        </div>
        <button id="clear" class="btn btn-primary btn-sm">Borrar firma</button>
        <br/>
    </div> --}}

    </div>
    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 right-align btn-grd distancia">
            @if (!$show_contrato)
                <a href="{{ route('contract_manager.contratos-katbol.index') }}"
                    class="btn btn-outline-primary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            @endif
        </div>
    </div>

    </div>
    </div>
    <!-- Submit Field -->
</form>
{{-- nuevo diseño --}}

<!-- Modal Structure -->
<div id="convenios_modificados" class="modal">
    <div class="modal-content">
        <strong class=" txt-frm">Convenios Modificados</strong>
        @foreach ($convenios as $convenio)
            <li style="margin-top:10px; margin-left:20px; font-size:12pt; font-weight: lighter; color:#000;">
                {{ $convenio->no_convenio }}</label>
        @endforeach
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
</div>

@if ($aprobacionFirmaContrato->count())
    <div class="col-12">
        <div class="card card-body">
            <h5 class="text-center">Aprobaciones firmadas</h5>
            <div class="d-flex flex-wrap gap-4 mt-4 justify-content-center"
                style="width: 100%; max-width: 1000px; margin: auto;">
                @foreach ($aprobacionFirmaContrato as $firma)
                    @if ($firma->firma)
                        <div class="text-center">
                            <img src="{{ $firma->firma_ruta }}" alt="firma" style="width: 400px;"> <br>
                            <span>{{ \Carbon\Carbon::parse($firma->aprobador->created_at)->format('d/m/Y') }}</span><br>
                            <span>{{ $firma->aprobador->name }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif


<style>
    #firma_aprobador canvas {
        border: 1px solid #bbb;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/lemonadejs/dist/lemonade.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@lemonadejs/signature/dist/index.min.js"></script>
@if ($firmar)
    <div class="col-12">
        <div class="card card-body">
            <form action="{{ route('contract_manager.contratos-katbol.aprobacion-firma-contrato') }}" method="POST">
                @csrf
                <div class="d-flex gap-4 align-items-center flex-column">
                    <div>
                        <h5>Ingrese su firma para la aprobación del registro</h5>
                    </div>
                    <div id="firma_aprobador" class="" style="width: auto;"></div>
                    <input type="hidden" name="firma_base" value="" id="firma-input">
                    <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                    <div class="d-flex gap-5">
                        <div id="resetCanvas" class="btn btn-outline-secondary">Limpiar</div>
                        <button class="btn btn-primary">Guardar firma</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
<script>
    // Get the element to render signature component inside
    const firma_aprobador = document.getElementById("firma_aprobador");
    const resetCanvas = document.getElementById("resetCanvas");
    resetCanvas.addEventListener("click", () => {
        // console.log(component.getImage());
        component.value = [];
        document.getElementById('firma-input').value = component.getImage();
    });
    document.querySelector('#firma_aprobador').onmouseup = function() {
        document.getElementById('firma-input').value = component.getImage();
    }
    // Call signature with the firma_aprobador element and the options object, saving its reference in a variable
    const component = Signature(firma_aprobador, {
        width: 700,
        height: 300,
        instructions: ""
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script type="text/javascript">
    function miFuncion() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Registro actualizado con éxito.',
            showConfirmButton: false,
        }).then((result) => {
            // Después de que el usuario interactúa con la alerta (o después de que se cierra),
            // redirigir a la misma página
            window.location.href = window.location.href;
        });
    }
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.0.3/autoNumeric.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let no_contrato = document.getElementById('no_contrato');
        let existSpan = document.getElementById('existCode');
        no_contrato.addEventListener('keyup', function(e) {
            e.preventDefault();
            let no_contrato = e.target.value;

            $.ajax({
                type: "POST",
                url: "{{ route('contract_manager.contratos-katbol.checkCode') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    no_contrato
                },
                dataType: "JSON",
                beforeSend: function() {
                    e.target.classList.remove('exists');
                    e.target.classList.remove('not-exists');
                    existSpan.classList.remove('text-success');
                    existSpan.classList.remove('text-danger');
                    existSpan.classList.add('not-exists');
                    e.target.classList.add('input-code');
                    document.querySelector('span.codigo_error').innerHTML = "";
                    existSpan.innerHTML =
                        ` Buscando...`;
                },
                success: function(response) {
                    if (no_contrato == "") {
                        e.target.classList.remove('exists');
                        e.target.classList.remove('not-exists');
                        existSpan.classList.remove('text-success');
                        existSpan.classList.remove('text-danger');
                        existSpan.classList.add('not-exists');
                        e.target.classList.add('input-code');
                        existSpan.innerHTML =
                            ` Ingresa un número de contrato`;
                    } else {
                        if (response.exists) {
                            e.target.classList.remove('not-exists');
                            e.target.classList.remove('input-code');
                            e.target.classList.add('exists');
                            existSpan.classList.remove('text-success');
                            existSpan.classList.add('text-danger');
                            existSpan.innerHTML =
                                ` Número de contrato existente`;
                        } else {
                            e.target.classList.remove('exists');
                            e.target.classList.remove('input-code');
                            e.target.classList.add('not-exists');
                            existSpan.classList.remove('text-danger');
                            existSpan.classList.add('text-success');
                            existSpan.innerHTML =
                                ` Número de contrato disponible`;
                        }
                    }
                }
            });

        });
    });
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
    rel="stylesheet">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

<script type="text/javascript">
    var signaturePad = $('#signaturePad').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.signature('clear');
        $("#signature64").val('');
    });
</script>

<script>
    function replaceSlash(elemento) {
        elemento.value = elemento.value.replace("/", "-");
        elemento.value = elemento.value.replace("\\", "-");
    }
</script>
<script>
    $("#no_contrato").keyup(function(e) {
        let no_contrato = $("#no_contrato").val();
        let id_contrato = $("#contrato_id").val();
        let contenedor = document.querySelector("#validar_no_contrato");
        if (no_contrato == "" || no_contrato == null) {
            contenedor.innerHTML = "";
        }

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/contratos/numero/existe`,
            data: {
                no_contrato,
                id_contrato
            },
            success: function(response) {
                if (response != 0) {
                    if (!response.existe) {
                        // console.log("No Existe");
                        contenedor.innerHTML = "";
                        contenedor.style.color = "green";
                        contenedor.innerHTML = "Número de contrato disponible";
                    } else {
                        contenedor.innerHTML = "";
                        if (response.pertenece) {
                            contenedor.style.color = "green";
                            contenedor.innerHTML = "Número de contrato disponible";
                        } else {
                            contenedor.style.color = "red";
                            contenedor.innerHTML = "Número de contrato existente";
                        }
                    }
                }

            }
        });
    });
</script>
<script>
    function mostrarAlerta() {
        $(".fondo_delete").css("display", "block");
        $(".btn-accion").css("display", "block");
    }

    $(".cancelar").click(function() {
        $(".fondo_delete").css("display", "none");
        $(".btn-accion").css("display", "none");
    });

    $(".btn-accion").click(function() {
        $(".fondo_delete").css("display", "none");
        $(".btn-accion").css("display", "none");
    });
</script>

<script>
    $(document).ready(function() {
        // Verifica si los campos vienen del backend
        let checkFianzaInicial = {{ $contratos->folio ? 'true' : 'false' }};

        // Al cargar la página, ajusta la visibilidad según el valor inicial
        if (checkFianzaInicial) {
            $(".td_fianza").fadeIn(0);
            $('#check_fianza').prop('checked', true);
        } else {
            $(".td_fianza").fadeOut(0);
            $('#check_fianza').prop('checked', false);
        }

        // Al cambiar el checkbox, ajusta la visibilidad
        $(document).on('change', '#check_fianza', function(e) {
            if (this.checked) {
                $(".td_fianza").fadeIn(0);
            } else {
                $(".td_fianza").fadeOut(0);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('.fecha_inicio_contrato').datepicker({
            firstDay: true,
            format: 'dd-mm-yyyy',
            i18n: {
                cancel: 'Cancelar',
                clear: 'Limpar',
                done: 'Ok',
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                    "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct",
                    "Nov", "Dic"
                ],
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
            },
            //autoclose: false
        });

        $('.fecha_fin_contrato').datepicker({
            firstDay: true,
            format: 'dd-mm-yyyy',
            i18n: {
                cancel: 'Cancelar',
                clear: 'Limpar',
                done: 'Ok',
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                    "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct",
                    "Nov", "Dic"
                ],
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
            }
        });

        // let fecha_inicio;
        // $(".fecha_inicio_contrato").change(function (e) {
        //     e.preventDefault();
        //     fecha_inicio = moment(e.target.value,'DD-MM-YYYY');
        // });

        $(".fecha_fin_contrato").change(function(e) {
            e.preventDefault();
            let fecha_inicio = moment($('.fecha_inicio_contrato').val(), 'DD-MM-YYYY');
            let fecha_seleccionada = moment(e.target.value, 'DD-MM-YYYY');
            let es_fecha_antes_fecha_fin = fecha_seleccionada.isBefore(fecha_inicio);
            let es_fecha_igual_fecha_fin = fecha_seleccionada.isSame(fecha_inicio);
            if (es_fecha_antes_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de fin del contrato no puede ser anterior a la fecha de inicio del contrato',
                });
                $(".fecha_fin_contrato").val("");
            } else if (es_fecha_igual_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de fin del contrato no puede ser igual a la fecha de inicio del contrato',
                });
                $(".fecha_fin_contrato").val("");
            }
        });

        $(function() {
            new AutoNumeric('#monto_pago', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#minimo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#maximo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#dolar', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#dolar_maximo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#dolar_minimo', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#valor_dol', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                decimalPlacesOverride: 2
            });
        });
    });
</script>

{{-- <script>
    $("#dolares_filtro").select2('destroy');
</script> --}}

{{-- <script type="text/javascript">
    $(document).on('change', '#dolares_filtro', function(event) {
        console.log('select');
        if ($('#dolares_filtro option:selected').attr('value') == 'USD') {
            $('#campos_dolares').removeClass('d-none');
        } else {
            $('#campos_dolares').addClass('d-none');
        }

    });
</script> --}}
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const url = "{{ route('contract_manager.contratos-katbol.validar-documento') }}";
        $('.input-field').click(function(e) {
            $('.input-field:hover').addClass('caja_input_file_activa');
        });
        // $('.input_file_validar').change(function(e) {

        //     $('.caja_input_file_activa .errors').remove();
        //     let loader_file = $('<div>');
        //     loader_file.addClass('progress');
        //     loader_file.addClass('d-none');
        //     $('.caja_input_file_activa').append(loader_file);
        //     let loader_progres_file = $('<div>');
        //     loader_progres_file.addClass('indeterminate');
        //     $('.caja_input_file_activa .progress').append(loader_progres_file);

        //     let file = e.target.files[0];
        //     let formData = new FormData();
        //     formData.append('file', file);
        //     $.ajax({
        //         xhr: function() {
        //             let xhr = new window.XMLHttpRequest();
        //             xhr.upload.addEventListener("progress", function(evt) {


        //                 if (evt.lengthComputable) {
        //                     let percentComplete = (evt.loaded / evt.total) * 100;
        //                     // Place upload progress bar visibility code here
        //                     $('.caja_input_file_activa .progress').removeClass(
        //                         'd-none');
        //                     if (percentComplete == 100) {

        //                     }
        //                 }
        //             }, false);
        //             return xhr;
        //         },

        //         url: url,

        //         data: formData,

        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },

        //         type: 'POST',

        //         dataType: 'json',

        //         contentType: false,
        //         processData: false,

        //         success: function(json) {
        //             console.log('json');
        //         },

        //         error: function(request, status, error) {
        //             console.log('Disculpe, existió un problema');
        //             $.each(request.responseJSON.errors, function(indexInArray,
        //                 valueOfElement) {
        //                 console.log(indexInArray);

        //                 let error_small = $('<small>');
        //                 error_small.addClass(`${indexInArray}_error`);
        //                 error_small.addClass('errors');
        //                 $('.caja_input_file_activa').append(error_small);

        //                 document.querySelector(
        //                         `.caja_input_file_activa .${indexInArray}_error`)
        //                     .innerHTML =
        //                     ` ${valueOfElement[0]}`;

        //                 e.target.value = '';
        //             });
        //         },

        //         complete: function(jqXHR, status) {
        //             console.log('Petición realizada');
        //             $('.caja_input_file_activa .progress').remove();
        //             $('.caja_input_file_activa').removeClass('caja_input_file_activa');
        //         }
        //     });
        // });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#update-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Create a FormData object from the form
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'), // Form action URL
                method: $(this).attr('method'), // Form method
                data: formData,
                processData: false, // Prevent jQuery from automatically transforming the data into a query string
                contentType: false, // Set the content type to false as jQuery will tell the server it's a query string request
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr) {
                    var errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#aprobadores").select2({
            theme: "bootstrap4",
        });
    });

    document.getElementById('aprobadores_firma').addEventListener('change', (e) => {
        console.log(e.target.checked);
        if (e.target.checked) {
            document.getElementById('aprobadores-firma-box').classList.remove('d-none');
        } else {
            document.getElementById('aprobadores-firma-box').classList.add('d-none');
        }
    });
</script>
