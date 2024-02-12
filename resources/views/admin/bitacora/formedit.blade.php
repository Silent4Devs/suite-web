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



{{-- <form method="PATH" action="{{ route('contratos.update', $contrato->id) }}" enctype="multipart/form-data"> --}}
{!! Form::open([
    'route' => ['contract_manager.contratos-katbol.update', $contrato->id],
    'method' => 'PATCH',
    'enctype' => 'multipart/form-data',
]) !!}
@csrf

<div class="card card-content">
    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12" style="margin-top: 30px;">
            <h3 class="titulo-form">INSTRUCCIONES</h3>
            <p class="instrucciones">Edite los datos del contrato</p>
        </div>
    </div>
    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <h4 class="sub-titulo-form col s12">INFORMACIÓN GENERAL DEL CONTRATO</h4>
    </div>

    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        @if ($convenios->count() > 0)
            <div class="col s12 right-align">
                <a class="waves-effect waves-light btn modal-trigger" href="#convenios_modificados">Visualizar Convenios
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
        <div class="distancia form-group col-md-6">
            <label for="no_contrato" class="txt-tamaño">N°
                Contrato<font class="asterisco">*
                </font></label>
            <input class="form-control {{ $errors->has('no_contrato') ? 'is-invalid' : '' }}" type="text"
                maxlength="250" name="no_contrato" id="no_contrato"
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

        <div class="distancia form-group col-md-6">
            <label for="" class="txt-tamaño">Tipo de
                contrato<font class="asterisco">*</font></label>
            <div>
                {{ Form::select(
                    'tipo_contrato',
                    [
                        'Fábrica de desarrollo' => 'Fábrica de desarrollo',
                        'Fábrica de pruebas' => 'Fábrica de pruebas',
                        'Telecomunicaciones' => 'Telecomunicaciones',
                        'Seguridad de la información' => 'Seguridad de la información',
                        'Infraestructura' => 'Infraestructura',
                        'Servicios en la Nube' => 'Servicios en la Nube',
                        'Servicios de consultoría Normativa' => 'Servicios de consultoría Normativa',
                        'Arrendamiento de Equipos' => 'Arrendamiento de Equipos',
                        'Adquisición de bienes' => 'Adquisición de bienes',
                        'Impresión' => 'Impresión',
                        'Soporte' => 'Soporte',
                        'Licenciamiento' => 'Licenciamiento',
                        'Administrativo' => 'Administrativo',
                        'Adquisición de papelería' => 'Adquisición de papelería',
                        'Servicios de Consultoría' => 'Servicios de Consultoría',
                        'Servicios Médicos' => 'Servicios Médicos',
                        'Servicio de Seguros' => 'Servicio de Seguros',
                        'Seguridad y Vigilancia' => 'Seguridad y Vigilancia',
                        'Servicio de Limpieza' => 'Servicio de Limpieza',
                        'Servicios de Alimentos' => 'Servicios de Alimentos',
                        'Educación Continua' => 'Educación Continua',
                        'Mantenimiento a Edificio' => 'Mantenimiento a Edificio',
                        'Adquisición de Mascarillas' => 'Adquisición de Mascarillas',
                        'Adquisición de Pruebas COVID' => 'Adquisición de Pruebas COVID',
                        'Restauracion' => 'Restauración de Edificios',
                        'Servicio' => 'Servicio de Estacionamiento',
                        'Abastecimiento' => 'Abastecimiento y Distribución de Revista y Periodicos',
                        'Otro' => 'Otro',
                    ],
                    $contrato->tipo_contrato,
                    [$show_contrato ? 'disabled' : '', 'class' => 'form-control required'],
                ) }}
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-12">
            <label for="nombre_servicio" class="txt-tamaño">
                Nombre del servicio<font class="asterisco">*</font></label><br>
            <div class="form-floating">
                <textarea id="textarea1" class="form-control" value="{{ $contrato->nombre_servicio }}" name="nombre_servicio"
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
            <select name="proveedor_id" class="form-control required" {{ $show_contrato ? 'disabled' : '' }} required>
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

        <div class="distancia form-group col-md-4">
            <label for="no_proyecto" class="txt-tamaño">
                Número de proyecto</label>
            <input type="text" maxlength="250" name="no_proyecto" id="no_proyecto" class="form-control"
                value="{{ $contrato->no_proyecto }}" @if ($show_contrato) disabled @endif>
        </div>

        @if ($areas->count() > 0)
            <div class="distancia form-group col-md-4">
                <label for="area_id" class="txt-tamaño">
                    Área a la que pertenece el
                    contrato</label>
                <select class="form-control" name="area_id" id="area_id"
                    @if ($show_contrato) disabled @endif required>
                    @foreach ($areas as $area)
                        <option {{ $area->id == $contrato->area_id ? 'selected' : '' }} value="{{ $area->id }}">
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
            {{ Form::select(
                'fase',
                [
                    'Solicitud de contrato' => 'Solicitud de contrato',
                    'Autorización' => 'Autorización',
                    'Negociación' => 'Negociación',
                    'Aprobación' => 'Aprobación',
                    'Ejecución' => 'Ejecución',
                    'Gestión de obligaciones' => 'Gestión de obligaciones',
                    'Modificación de contrato' => 'Modificación de contrato',
                    'Auditoría y reportes' => 'Auditoría y reportes',
                    'Renovación' => 'Renovación',
                ],
                $contrato->fase,
                [$show_contrato ? 'disabled' : '', 'class' => 'form-control'],
            ) }}

            @if ($errors->has('fase'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('fase') }}
                </div>
            @endif
        </div>

        <div class="distancia form-group col-md-6">
            <label for="estatus" class="txt-tamaño">
                Estatus<font class="asterisco">*</font></label>
            {{ Form::select(
                'estatus',
                ['vigentes' => 'Vigente', 'Cerrado' => 'Cerrado', 'renovaciones' => 'Renovación'],
                $contrato->estatus,
                [$show_contrato ? 'disabled' : '', 'class' => 'form-control'],
            ) }}
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
            <textarea style="text-align:justify" maxlength="500" id="textarea1" class="form-control" value="{{ $contrato->objetivo }}"
                name="objetivo" @if ($show_contrato) disabled @endif required>{{ $contrato->objetivo }}</textarea>
            @if ($errors->has('objetivo'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('objetivo') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row" style="margin-left: 10px; margin-right: 10px;">
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
            </div>
            @if ($contrato->file_contrato != null)
                <a href="{{ asset(trim('storage/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/' . $contrato->file_contrato)) }}"
                    target="_blank" class=" descarga_archivo" style="margin-left:20px;">
                    Descargar archivo actual</a>
            @endif
        </div>
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
            <input type="date" name="fecha_firma" id="fecha_firma" class="form-control"
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
    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">Vigencia<font class="asterisco">*
                </font></label>
            {!! Form::text('vigencia_contrato', $contrato->vigencia_contrato, [
                'class' => 'form-control',
                'required',
                'maxlength' => '150',
                $show_contrato ? 'readonly' : '',
            ]) !!}
            @if ($errors->has('vigencia_contrato'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('vigencia_contrato') }}
                </div>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">
                No. Pagos<font class="asterisco">*</font></label>
            {!! Form::number('no_pagos', $contrato->no_pagos, [
                'class' => 'form-control',
                'required',
                $show_contrato ? 'readonly' : '',
            ]) !!}
            @if ($errors->has('no_pagos'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('no_pagos') }}
                </div>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">Tipo
                Cambio<font class="asterisco">*</font></label>
            @php
                $divisas = [
                    '0' => 'MXN',
                    '1' => 'USD',
                    '2' => 'EUR',
                    '3' => 'GBP',
                    '4' => 'CHF',
                    '5' => 'JPY',
                    '6' => 'HKD',
                    '7' => 'CAD',
                    '8' => 'CNY',
                    '9' => 'AUD',
                    '10' => 'BRL',
                    '11' => 'RUB',
                ];
            @endphp
            <div id="contenedor_dolares">
                <select name="tipo_cambio" id="dolares_filtro" class="form-control"
                    @if ($show_contrato) disabled @endif required>
                    <option value="">Seleccione </option>
                    @foreach ($divisas as $key => $divisa)
                        <option value='{{ $divisa }}'
                            {{ $divisa == $contratos->tipo_cambio ? 'selected' : '' }}>
                            {{ $divisa }}</option>
                    @endforeach
                </select>

                @if ($errors->has('tipo_cambio'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('tipo_cambio') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($contrato->tipo_cambio == 'USD')
        <div id="campos_dolares">
        @else
            <div id="campos_dolares" class="d-none">
    @endif
    <div class="col s12">
        <div class="col l12 m12 s12">
            <div class="card-body center-align">
                <table class="table">
                    <thead style="background-color: transparent !important; color:#3086AF !important;">
                        <tr>

                            <br>
                            <th>
                                Valor del Dolar
                            </th>
                            <th>
                                Monto
                                de
                                pago
                            </th>
                            <th>
                                Monto
                                Máximo

                            </th>
                            <th>
                                Monto
                                Mínimo
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>

                                {!! Form::text('valor_dolar', !is_null($dolares) ? $dolares->valor_dolar : null, [
                                    'class' => 'form-control',
                                    'id' => 'valor_dol',
                                    'autocomplete' => 'off',
                                    'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    $show_contrato ? 'readonly' : '',
                                ]) !!}

                            </td>

                            <td>
                                {!! Form::text('monto_dolares', !is_null($dolares) ? $dolares->monto_dolares : null, [
                                    'class' => 'form-control',
                                    'id' => 'dolar',
                                    'autocomplete' => 'off',
                                    'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    $show_contrato ? 'readonly' : '',
                                ]) !!}
                            </td>


                            <td>
                                {!! Form::text('maximo_dolares', !is_null($dolares) ? $dolares->maximo_dolares : null, [
                                    'class' => 'form-control',
                                    'id' => 'dolar_maximo',
                                    'autocomplete' => 'off',
                                    'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    $show_contrato ? 'readonly' : '',
                                ]) !!}

                            </td>

                            <td>
                                {!! Form::text('minimo_dolares', !is_null($dolares) ? $dolares->minimo_dolares : null, [
                                    'class' => 'form-control',
                                    'id' => 'dolar_minimo',
                                    'autocomplete' => 'off',
                                    'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    $show_contrato ? 'readonly' : '',
                                ]) !!}

                            </td>



                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 20px; margin-left: 10px; margin-right: 10px;">
    <div class="distancia form-group col-md-4">
        <label for="no_contrato" class="txt-tamaño">Monto
            de Pago M.X.N.<font class="asterisco">*</font></label>
        {!! Form::text('monto_pago', $contratos->monto_pago, [
            'class' => 'form-control',
            'name' => 'monto_pago',
            'id' => 'monto_pago',
            'autocomplete' => 'off',
            'onkeyup' => 'formatarMoeda()',
            $show_contrato ? 'readonly' : '',
            'required',
        ]) !!}
    </div>
    <div class="distancia form-group col-md-4">
        <label for="no_contrato" class="txt-tamaño">Monto
            máximo M.X.N.</label>
        {!! Form::text('maximo', $contratos->maximo, [
            'class' => 'form-control',
            'autocomplete' => 'off',
            'id' => 'maximo',
            'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
            $show_contrato ? 'readonly' : '',
        ]) !!}
    </div>
    <div class="distancia form-group col-md-4">
        <label for="no_contrato" class="txt-tamaño">Monto
            mínimo M.X.N.</label>
        {!! Form::text('minimo', $contratos->minimo, [
            'class' => 'form-control',
            'id' => 'minimo',
            'autocomplete' => 'off',
            'onkeypress' => "$(this).mask('$ ###,##0.00', {reverse: true});",
            $show_contrato ? 'readonly' : '',
        ]) !!}
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
                            @if (isset($contratos))
                                @if ($contrato->documento)
                                    <div class="custom-control custom-switch form">
                                        <input type="checkbox" class="custom-control-input" id="check_fianza"
                                            name="aplicaFinaza" {{ $show_contrato ? 'disabled' : '' }} checked>
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
                        {!! Form::text('folio', $contratos->folio, ['class' => 'form-control', $show_contrato ? 'readonly' : '']) !!}
                    </div>
                </td>
                <td>
                    <div class="td_fianza">
                        @if (is_null($organizacion))
                        @else
                            <div class="row">
                                PDF:
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <input class="input_file_validar form-control" type="file"
                                            name="documento" accept=".pdf" readonly>
                                        {{-- <input type="hidden" id="" name="" value=""> --}}
                                    </div>
                                    {{-- <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text"
                                        placeholder="Elegir documento pdf" readonly>
                                </div> --}}
                                </div>
                            </div>
                        @endif

                        <div class="ml-4 display-flex">
                            <label class="red-text">{{ $errors->first('Type') }}</label>
                        </div>
                        @if ($contrato->documento != null)
                            <a href="{{ asset(trim('storage/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/penalizaciones/' . $contrato->documento)) }}"
                                target="_blank" class=" descarga_archivo" style="margin-left:20px;">

                                Descargar
                            </a>
                        @endif
                        <div class="ml-4 display-flex">
                            <label class="red-text">{{ $errors->first('Type') }}</label>
                        </div>
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
            Nombre del
            Supervisor 1<font class="asterisco">*
            </font></label>
        <div>
            {!! Form::text('pmp_asignado', $contratos->pmp_asignado, [
                'maxlength' => '250',
                'class' => 'form-control',
                $show_contrato ? 'readonly' : '',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="distancia form-group col-md-4">
        <label class="txt-tamaño">Puesto</label>
        <div>
            {!! Form::text('puesto', $contratos->puesto, [
                'class' => 'form-control',
                'maxlength' => '250',
                $show_contrato ? 'readonly' : '',
            ]) !!}
        </div>
    </div>
    <div class="distancia form-group col-md-4">
        <label class="txt-tamaño">Área</label>
        {!! Form::text('area', $contratos->area, [
            'maxlength' => '250',
            'class' => 'form-control',
            'maxlength' => '250',
            $show_contrato ? 'readonly' : '',
        ]) !!}
        @if ($errors->has('area'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('area') }}
            </div>
        @endif
    </div>
</div>
<div class="row" style="margin-left: 10px; margin-right: 10px;">
    <div class="distancia form-group col-md-4">
        <label class="txt-tamaño">Nombre del
            Supervisor 2</label>
        {!! Form::text('administrador_contrato', $contratos->administrador_contrato, [
            'maxlength' => '250',
            'class' => 'form-control',
            $show_contrato ? 'readonly' : '',
        ]) !!}
        @if ($errors->has('administrador_contrato'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('administrador_contrato') }}
            </div>
        @endif
    </div>
    <div class="distancia form-group col-md-4">
        <label class="txt-tamaño">Puesto</label>
        {!! Form::text('cargo_administrador', $contratos->cargo_administrador, [
            'class' => 'form-control',
            'maxlength' => '250',
            $show_contrato ? 'readonly' : '',
        ]) !!}
        @if ($errors->has('cargo_administrador'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('cargo_administrador') }}
            </div>
        @endif
    </div>
    <div class="distancia form-group col-md-4">
        <label class="txt-tamaño">Área</label>
        {!! Form::text('area_administrador', $contratos->area_administrador, [
            'class' => 'form-control',
            'maxlength' => '250',
            $show_contrato ? 'readonly' : '',
        ]) !!}
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
                <button id="clear" class="btn btn-danger btn-sm">Borrar firma</button>
            <br/>
        </div> --}}
</div>
<div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
    <div class="col s12 right-align btn-grd distancia">
        @if (!$show_contrato)
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class="btn btn_cancelar">Cancelar</a>
            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
        @endif
    </div>
</div>
</div>
</div>
<!-- Submit Field -->
{!! Form::close() !!}
{{-- </form> --}}
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

        if ($('#check_fianza').checked) {
            $(".td_fianza").fadeIn(0);
        } else {
            $(".td_fianza").fadeOut(0);
        }
    });
    $(document).on('change', '#check_fianza', function(e) {
        if (this.checked) {
            $(".td_fianza").fadeIn(0);
        } else {
            $(".td_fianza").fadeOut(0);
        }
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


<script>
    $("#dolares_filtro").select2('destroy');
</script>

<script type="text/javascript">
    $(document).on('change', '#dolares_filtro', function(event) {
        console.log('select');
        if ($('#dolares_filtro option:selected').attr('value') == 'USD') {
            $('#campos_dolares').removeClass('d-none');
        } else {
            $('#campos_dolares').addClass('d-none');
        }

    });
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const url = "{{ route('contract_manager.contratos-katbol.validar-documento') }}";
        $('.input-field').click(function(e) {
            $('.input-field:hover').addClass('caja_input_file_activa');
        });
        $('.input_file_validar').change(function(e) {

            $('.caja_input_file_activa .errors').remove();
            let loader_file = $('<div>');
            loader_file.addClass('progress');
            loader_file.addClass('d-none');
            $('.caja_input_file_activa').append(loader_file);
            let loader_progres_file = $('<div>');
            loader_progres_file.addClass('indeterminate');
            $('.caja_input_file_activa .progress').append(loader_progres_file);

            let file = e.target.files[0];
            let formData = new FormData();
            formData.append('file', file);
            $.ajax({
                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {


                        if (evt.lengthComputable) {
                            let percentComplete = (evt.loaded / evt.total) * 100;
                            // Place upload progress bar visibility code here
                            $('.caja_input_file_activa .progress').removeClass(
                                'd-none');
                            if (percentComplete == 100) {

                            }
                        }
                    }, false);
                    return xhr;
                },

                url: url,

                data: formData,

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type: 'POST',

                dataType: 'json',

                contentType: false,
                processData: false,

                success: function(json) {
                    console.log('json');
                },

                error: function(request, status, error) {
                    console.log('Disculpe, existió un problema');
                    $.each(request.responseJSON.errors, function(indexInArray,
                        valueOfElement) {
                        console.log(indexInArray);

                        let error_small = $('<small>');
                        error_small.addClass(`${indexInArray}_error`);
                        error_small.addClass('errors');
                        $('.caja_input_file_activa').append(error_small);

                        document.querySelector(
                                `.caja_input_file_activa .${indexInArray}_error`)
                            .innerHTML =
                            ` ${valueOfElement[0]}`;

                        e.target.value = '';
                    });
                },

                complete: function(jqXHR, status) {
                    console.log('Petición realizada');
                    $('.caja_input_file_activa .progress').remove();
                    $('.caja_input_file_activa').removeClass('caja_input_file_activa');
                }
            });
        });
    });
</script>
