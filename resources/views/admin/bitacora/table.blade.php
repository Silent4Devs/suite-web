<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>
<style>
    .iconos-crear {
        font-size: 20pt;
        margin-right: 18px;
    }

    /*select*/



    .p-oculta {
        display: none;
    }

    .alert-contrato-file {
        text-align: center;
        font-size: 12pt;
        color: #3e3e3e;
        border: 2px solid #26a69a !important;
        background: #38c88dd1;
        border-radius: 10px;
        padding: 3px;
        font-weight: bolder;
    }

    .alert-contrato-async {
        text-align: center;
        font-size: 12pt;
        color: #3e3e3e;
        border: 2px solid #2659a6 !important;
        background: #388ec8d1;
        border-radius: 10px;
        padding: 3px;
        font-weight: bolder;
    }

    #contenedor_dolares .select-wrapper {
        display: block !important;
    }


    .d-none {
        display: none !important;
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

        #contenedor_dolares .select-wrapper {
            display: block !important;
        }

    }

    div.recuadro-instruccion {
        width: 688px;
        height: 46px;
        background: #FFFBEE;
        border: 1px solid #FFA200;
        border-radius: 9px;
        opacity: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FF8000;
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
<form method="POST" action="{{ route('contract_manager.contratos-katbol.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card card-body">
        <div class="row">

            <div class="col m12" style="margin-top: 30px;">
                <h3 class="titulo-form">INSTRUCCIONES</h3>
                <p class="instrucciones">Por favor ingrese los datos del contrato para poder darlo de alta</p>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="">
                    <label>
                        {{-- <input type="checkbox" class="filled-in" checked="checked" /> --}}
                        <input type="checkbox" name="aprobadores_firma" id="aprobadores_firma" value="1"
                            style="width: 20px; height: 20px; vertical-align:middle;" />
                        <span>Activar flujo de aprobación</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row d-none" id="aprobadores-firma-box">
            <div class="col-md-12 form-group">
                <label for="">Asignar Aprobadores</label>
                <select name="aprobadores_firma[]" id="aprobadores" multiple class="form-control">
                    @foreach ($firma->aprobadores as $aprobador)
                        <option value="{{ $aprobador->id }}">
                            {{ $aprobador->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <h4 class="sub-titulo-form col s12">INFORMACIÓN GENERAL DEL CONTRATO</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="distancia">
                        <label>
                            {{-- <input type="checkbox" class="filled-in" checked="checked" /> --}}
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
            @if ($contratos->no_contrato == null)
                <div class="distancia
            form-group col-md-6">
                    <label for="no_contrato" class="txt-tamaño">N° Contrato
                        <font class="asterisco">*
                        </font>
                    </label>
                    <input class="form-control" {{ $errors->has('no_contrato') ? 'is-invalid' : '' }} type="text"
                        name="no_contrato" id="no_contrato" value="{{ old('no_contrato', '') }}" maxlength="230">
                    <span id="existCode"></span>
                    {{-- @if ($errors->has('no_contrato'))
                        <span class="text-danger">{{ $errors->first('no_contrato') }}</span>
                    @endif --}}
                    <span class="text-danger codigo_error error-ajax"></span>
                    @if ($errors->has('no_contrato'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('no_contrato') }}
                        </div>
                    @endif
                </div>
            @else
                <label for="codigo">N° Contrato</label>
                <p class="m-0"
                    style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background: #0fe85c69;">
                    {{ $contratos->no_contrato }}</p>
            @endif




            <div class="distancia form-group col-md-6">
                <label for="tipo_contrato" class="txt-tamaño">&nbsp;Tipo de
                    contrato
                    <font class="asterisco">*</font>
                </label>
                <select name="tipo_contrato" class="form-control required">
                    <option value="Fábrica de desarrollo">Fábrica de desarrollo</option>
                    <option value="Fábrica de pruebas">Fábrica de pruebas</option>
                    <option value="Telecomunicaciones">Telecomunicaciones</option>
                    <option value="Seguridad de la información">Seguridad de la información</option>
                    <option value="Infraestructura">Infraestructura</option>
                    <option value="Servicios en la Nube">Servicios en la Nube</option>
                    <option value="Servicios de consultoría Normativa">Servicios de consultoría Normativa</option>
                    <option value="Arrendamiento de Equipos">Arrendamiento de Equipos</option>
                    <option value="Impresión">Impresión</option>
                    <option value="Licenciamiento">Licenciamiento</option>
                    <option value="Administrativo">Administrativo</option>
                    <option value="Adquisición de papelería">Adquisición de papelería</option>
                    <option value="Servicios de Consultoría">Servicios de Consultoría</option>
                    <option value="Servicios Médicos">Servicios Médicos</option>
                    <option value="Servicio de Seguros">Servicio de Seguros</option>
                    <option value="Seguridad y Vigilancia">Seguridad y Vigilancia</option>
                    <option value="Servicio de Limpieza">Servicio de Limpieza</option>
                    <option value="Servicios de Alimentos">Servicios de Alimentos</option>
                    <option value="Educación Continua">Educación Continua</option>
                    <option value="Mantenimiento a Edificio">Mantenimiento a Edificio</option>
                    <option value="Adquisición de Mascarillas">Adquisición de Mascarillas</option>
                    <option value="Adquisición de Pruebas COVID">Adquisición de Pruebas COVID</option>
                    <option value="Restauracion">Restauración de Edificios</option>
                    <option value="Servicio">Servicio de Estacionamiento</option>
                    <option value="Abastecimiento">Abastecimiento y Distribución de Revista y Periodicos</option>
                    <option value="Otro">Otro</option>
                </select>
                @if ($errors->has('tipo_contrato'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('tipo_contrato') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="distancia form-group col-md-12">
                <label for="nombre_servicio" class="txt-tamaño">
                    Nombre del servicio<font class="asterisco">*</font></label>
                <div class="form-floating">
                    <textarea id="textarea1" class="form-control" maxlength="550" name="nombre_servicio" required>{{ old('nombre_servicio') }}</textarea>
                </div>
                @if ($errors->has('nombre_servicio'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('nombre_servicio') }}
                    </div>
                @endif
            </div>
        </div>


        <div class="row">
            <div class="distancia form-group col-md-6">
                <label for="proveedor_id" class="txt-tamaño">&nbsp;Nombre
                    del
                    cliente<font class="asterisco">*</font></label>
                <select name="proveedor_id" class="form-control required">
                    @if ($proveedores)
                        @foreach ($proveedores as $proveedores)
                            <option value="{{ $proveedores->id }}">
                                {{ $proveedores->nombre }}
                            </option>
                        @endforeach
                    @else
                        <option value="">No hay Clientes registrados</option>
                    @endif
                </select>
                @if ($errors->has('proveedor_id'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('proveedor_id') }}
                    </div>
                @endif
            </div>


            <div class="distancia form-group col-md-6">
                <label for="area_id" class="txt-tamaño"> Área a la
                    que
                    pertenece el contrato:</label>
                <select class=" form-control" name="area_id" id="area_id" required>
                    <option disabled>Seleccione área</option>
                    {{-- <option value="" selected disabled>Seleccione área</option> --}}
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
                @if ($errors->has('area_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_id') }}
                    </div>
                @endif
            </div>
        </div>

        <div style="margin-left: 10px;">
            @livewire('contratos-identificador-proyectos-int-ext')
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="fase" class="txt-tamaño">
                    &nbsp;Fase<font class="asterisco">*
                    </font></label>
                <select name="fase" class="form-control">
                    <option disabled>Seleccione</option>
                    <option>Solicitud de contrato</option>
                    <option>Autorización</option>
                    <option>Negociación</option>
                    <option>Aprobación</option>
                    <option>Ejecución</option>
                    <option>Gestión de obligaciónes</option>
                    <option>Modificación de contrato</option>
                    <option>Auditoría y reportes</option>
                    <option>Renovación</option>
                </select>
                @if ($errors->has('fase'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('fase') }}
                    </div>
                @endif
            </div>
            {{-- <p class="grey-text estafase">
                Adjuntar Proyecto
            </p> --}}

            {{-- <div class="input-field col s12">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Document</span>
                        <input type="hidden" id="fileContratoName" name="file_contrato" value="">
                        <input id="adjuntarContrato" type="file" accept="{{ $organizacion ? $organizacion->formatos : '.docx,.pdf,.doc,.xlsx,.pptx,.txt' }}">
                    </div>
                </div>
            </div> --}}
            <div class="form-group col-md-6">
                <label for="estatus" class="txt-tamaño">&nbsp;
                    Estatus<font class="asterisco">*</font>
                </label><br>
                {{ Form::select('estatus', ['vigentes' => 'Vigente', 'Cerrado' => 'Cerrado', 'renovaciones' => 'Renovación'], null, ['class' => 'form-control']) }}
                @if ($errors->has('estatus'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
            </div>

        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="objetivo" class="txt-tamaño">
                    Objetivo del servicio<font class="asterisco">*</font></label>
                <textarea id="textarea1" class="texto-linea form-control" maxlength="500" name="objetivo" required>{{ old('objetivo') }}</textarea>
                @if ($errors->has('objetivo'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('nombre_servicio') }}
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Elegir documento" readonly>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="estatus" class="txt-tamaño">Adjuntar
                    Contrato<font class="asterisco">*</font></label><br>
                <div class="">
                    <div class="file-field input-field">
                        <div class="btn">
                            <input type="file" name="file_contrato" class="form-control input_file_validar"
                                id="file_contrato" placeholder="Elegir documento"
                                accept=".docx,.pdf,.doc,.xlsx,.pptx,.txt" required readonly>
                            {{-- <input type="hidden" id="fileContratoName" name="file_contrato" value="">
                            <input class="input_file_validar form-control" id="adjuntarContrato" type="file"
                                accept="{{ $organizacion ? $organizacion->formatos : '.docx,.pdf,.doc,.xlsx,.pptx,.txt' }}"> --}}
                        </div>
                        {{-- <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Elegir documento pdf"
                                required> --}}
                        @if ($errors->has('file_contrato'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('file_contrato') }}
                            </div>
                        @endif
                        {{-- </div> --}}
                    </div>

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
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="no_contrato" class="txt-tamaño">Vigencia
                    <font class="asterisco">*</font>
                </label><br>
                {!! Form::text('vigencia_contrato', null, ['class' => 'form-control', 'required', 'maxlength' => '150']) !!}
                @if ($errors->has('vigencia_contrato'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('vigencia_contrato') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Fecha
                    de
                    inicio<font class="asterisco">*</font></label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                {{-- {!! Form::text('fecha_inicio', null, ['class' => 'form-control fecha_inicio_contrato', 'required']) !!}  --}}
                @if ($errors->has('fecha_inicio'))
                    <div class="invalid-feedback red-text" style="position:absolute;">
                        {{ $errors->first('fecha_inicio') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Fecha
                    fin
                    <font class="asterisco">*</font>
                </label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', '') }}"
                    class='form-control' required>
                {{-- {!! Form::text('fecha_fin', old('fecha_fin'), [
                    'class' => 'form-control fecha_fin_contrato required',
                    'required',
                ]) !!} --}}
                @if ($errors->has('fecha_fin'))
                    <div class="invalid-feedback red-text" style="position:absolute;">
                        {{ $errors->first('fecha_fin') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Fecha
                    de
                    firma<font class="asterisco">*</font></label>
                <input type="date" name="fecha_firma" id="fecha_firma" class="form-control" required>
                {{-- {!! Form::text('fecha_firma', old('fecha_firma'), ['class' => 'form-control fecha_firma', 'required']) !!} --}}
                @if ($errors->has('fecha_firma'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('fecha_firma') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">
                    &nbsp;No. Pagos<font class="asterisco">*</font></label><br>

                {!! Form::number('no_pagos', null, ['class' => 'form-control', 'required'], ['min' => '1']) !!}
                @if ($errors->has('no_pagos'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('no_pagos') }}
                    </div>
                @endif
            </div>


            <div class="form-group col-md-4">
                <label for="no_contrato" class="txt-tamaño">Tipo
                    Cambio
                    <font class="asterisco">*
                    </font>
                </label>
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
                    <select name="tipo_cambio" id="dolares_filtro" class="form-control" required>
                        <option value="">Seleccione </option>
                        @foreach ($divisas as $key => $divisa)
                            <option value='{{ $divisa }}'>{{ $divisa }}</option>
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
        {{-- modal --}}
        <div class="col s12">
            <div id="campos_dolares" class="{{ $contratos->tipo_cambio == 'USD' ? '' : 'd-none' }}">
                <div class="col l12 m12 s12">
                    <div class="card hoverable">
                        <div class="card-content center-align">

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="no_contrato" class="txt-tamaño">
                                        Valor del Dolar
                                    </label>
                                    {!! Form::text('valor_dolar', !is_null($dolares) ? $dolares->valor_dolar : null, [
                                        'class' => 'form-control',
                                        'id' => 'valor_dol',
                                        'autocomplete' => 'off',
                                        'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="no_contrato" class="txt-tamaño">
                                        Monto de
                                        pago
                                    </label>
                                    {!! Form::text('monto_dolares', !is_null($dolares) ? $dolares->monto_dolares : null, [
                                        'class' => 'form-control',
                                        'id' => 'dolar',
                                        'autocomplete' => 'off',
                                        'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="no_contrato" class="txt-tamaño">
                                        Monto
                                        Máximo
                                    </label>
                                    {!! Form::text('maximo_dolares', !is_null($dolares) ? $dolares->maximo_dolares : null, [
                                        'class' => 'form-control',
                                        'id' => 'dolar_maximo',
                                        'autocomplete' => 'off',
                                        'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="no_contrato" class="txt-tamaño">
                                        Monto
                                        Mínimo
                                    </label>
                                    {!! Form::text('minimo_dolares', !is_null($dolares) ? $dolares->minimo_dolares : null, [
                                        'class' => 'form-control',
                                        'id' => 'dolar_minimo',
                                        'autocomplete' => 'off',
                                        'onkeypress' => "$(this).mask(' #.00', {reverse: true});",
                                    ]) !!}
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $contrato_importe_total = $contratos->monto_pago;
                                @endphp
                                @foreach ($contratos->ampliaciones as $ampliacion)
                                    @php
                                        $contrato_importe_total += $ampliacion->importe;
                                    @endphp
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px; margin-left: 10px; margin-right: 10px;">
                <div class="form-group col-md-4">
                    <label for="no_contrato" class="txt-tamaño">Monto de
                        Pago M.X.N.<font class="asterisco">*</font></label>
                    {!! Form::text('monto_pago', null, [
                        'id' => 'teste',
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                        'required',
                    ]) !!}
                    @if ($errors->has('monto_pago'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('monto_pago') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="no_contrato" class="txt-tamaño">Monto
                        máximo
                        M.X.N.<font class="asterisco">*</font></label>
                    {!! Form::text('maximo', null, ['id' => 'este', 'class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
                </div>
                <div class="form-group col-md-4">
                    <label for="no_contrato" class="txt-tamaño">Monto
                        mínimo
                        M.X.N.<font class="asterisco">*</font></label>
                    {!! Form::text('minimo', null, [
                        'id' => 'prueba',
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                        'required',
                    ]) !!}
                </div>
            </div>

            <div class="row" style="margin-top: 20px; margin-left: 10px; margin-right: 10px;">
                <div class="col s12 m4 distancia">
                    <p style="color:#2395AA">
                        &nbsp;¿Aplica fianza o responsabilidad civil? </p>
                    {{-- <div class="form custom-control custom-switch">
                        No
                        <input id="check_aplica_fianza" type="checkbox" name="aplicaFinaza"
                            class="custom-control-input">
                        Si
                    </div> --}}
                    <div class="custom-control custom-switch form">
                        <input type="checkbox" class="custom-control-input" id="check_aplica_fianza"
                            name="aplicaFinaza">
                        <label class="custom-control-label" for="check_aplica_fianza">No/Sí</label>
                    </div>
                </div>
                <style type="text/css">
                    .td_fianza {
                        display: none;
                    }
                </style>
                <div class="form-group col-md-12 distancia">
                    <div class="td_fianza">
                        <label class="txt-tamaño">Folio</label>
                        {!! Form::text('folio', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group col-md-12 distancia">
                    <div class="td_fianza">
                        <label class="txt-tamaño ">Documento</label>
                        <div class="file-field input-field">
                            <span>PDF</span>
                            <div class="btn">
                                <input type="hidden" id="" name="" value="">
                                <input class="input_file_validar form-control" type="file" name="documento"
                                    accept=".pdf" readonly>
                            </div>
                            {{-- <div class="file-path-wrapper">
                                <input class="file-path validate form-control" type="text"
                                    placeholder="Elegir documento pdf" readonly>
                            </div> --}}
                        </div>

                        <div class="ml-4 display-flex">
                            <label class="red-text">{{ $errors->first('Type') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="sub-titulo-form col s12">RESPONSABLES</h4>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="txt-tamaño">&nbsp;Nombre
                        del Supervisor 1<font class="asterisco">*
                        </font></label>
                    <div>
                        {!! Form::text('pmp_asignado', null, ['class' => 'form-control', 'required', 'maxlength' => '250']) !!}
                        @if ($errors->has('pmp_asignado'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('pmp_asignado') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="txt-tamaño">&nbsp;Puesto</label>
                    <div>
                        {!! Form::text('puesto', null, ['class' => 'form-control', 'maxlength' => '250']) !!}
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="txt-tamaño">&nbsp;Área</label>
                    <div>
                        {!! Form::text('area', null, ['class' => 'form-control', 'maxlength' => '250']) !!}
                        @if ($errors->has('area'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('area') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="txt-tamaño">&nbsp;Nombre
                        del Supervisor 2</label>
                    <div>
                        {!! Form::text('administrador_contrato', null, ['class' => 'form-control', 'maxlength' => '250']) !!}
                        @if ($errors->has('administrador_contrato'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('administrador_contrato') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="txt-tamaño">&nbsp;Puesto</label>
                    <div>
                        {!! Form::text('cargo_administrador', null, ['class' => 'form-control', 'maxlength' => '150']) !!}
                        @if ($errors->has('cargo_administrador'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('cargo_administrador') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="txt-tamaño">&nbsp;Área</label>
                    <div>
                        {!! Form::text('area_administrador', null, ['class' => 'form-control', 'maxlength' => '150']) !!}
                        @if ($errors->has('area_administrador'))
                            <div class="invalid-feedback red-text">
                                {{ $errors->first('area_administrador') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- <div class="row"></div>
            <div class="row">
            <label class="txt-tamaño" for="firma">
                Firma:</label>
            </div>
            <div class="col s12 m3 distancia"></div>
            <div class="col s12 m4 distancia">
                    <div id="signaturePad" >
                        <textarea id="signature64" name="signed" style="display:none; text-align:center;"></textarea>
                    </div>
                    <button id="clear" class="btn btn-danger btn-sm">Borrar firma</button>
                <br/>
                    @if ($errors->has('signed'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('signed') }}
                    </div>
            @endif
            </div> --}}

            <div class="form-group col-12 text-right mt-4">
                <div class="col s12 m12 right-align btn-grd distancia">
                    <a id="btnCancelar" href="{{ route('contract_manager.contratos-katbol.index') }}"
                        class="btn btn_cancelar">Cancelar</a>
                    {!! Form::submit('Guardar', ['class' => 'btn btn-success', 'id' => 'btnGuardar']) !!}
                </div>
            </div>
        </div>
    </div>
</form>







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script type="text/javascript">
    function showContent() {
        element = document.getElementById("no_contrato");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.visibility = 'hidden';
        } else {
            element.style.visibility = 'visible';
        }
    }
</script>

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

<script>
    //Upload in tmp folder
    document.addEventListener('DOMContentLoaded', function() {
        window.random = (length =
            8) => { // Generate Random name for contracts files when it are uploaded in tmp folder
            let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let str = '';
            for (let i = 0; i < length; i++) {
                str += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return str;
        };

        const clearErrors = () => {
            document.querySelectorAll(".errors").forEach(item => {
                item.innerHTML = '';
            })
        }

        const inputFile = document.getElementById('adjuntarContrato');
        const url = "{{ route('contract_manager.contratos-katbol.fileUploadTmp') }}";
        inputFile.addEventListener('change', function(e) {
            const formData = new FormData();
            const tmpName = this.getAttribute('tmp-file-name');
            const uploadedFile = this.files[0];
            formData.append('file', uploadedFile);
            formData.append('tmpFileName', tmpName);
            $.ajax({
                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percentComplete = (evt.loaded / evt.total) * 100;
                            // Place upload progress bar visibility code here
                            document.getElementById(
                                    'progressUploadContract').style.width =
                                `${Math.ceil(percentComplete)}%`;
                            if (percentComplete == 100) {
                                document.getElementById('loaderContractTmpFile')
                                    .style.display = 'block';
                            }
                        }
                    }, false);
                    return xhr;
                },
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    clearErrors();
                    document.getElementById('btnGuardar').setAttribute('disabled', true)
                    document.getElementById('btnCancelar').setAttribute('disabled', true)
                    document.getElementById('alertContratoUploadTmp')
                        .style.display = 'none'
                    document.getElementById('progressUploadContractContainer').style
                        .display =
                        'block';
                    document.getElementById('progressUploadContract').style.width =
                        `0%`;
                    document.getElementById('loaderContractTmpFile').style.display = 'none';
                    document.getElementById('fileContratoName').value = null
                },
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    document.getElementById('loaderContractTmpFile').style.display = 'none';
                    document.getElementById(
                            'progressUploadContractContainer').style
                        .display =
                        'none';
                    document.getElementById('alertContratoUploadTmp')
                        .style.display = 'block'
                    document.getElementById('fileContratoName').value = response.fileName
                    document.getElementById('btnGuardar').removeAttribute('disabled')
                    document.getElementById('btnCancelar').removeAttribute('disabled')
                    console.log(response);
                },
                error: function(request, status, error) {
                    console.log(error);
                    $.each(request.responseJSON.errors, function(indexInArray,
                        valueOfElement) {
                        console.log(indexInArray);
                        document.querySelector(`#${indexInArray}_error`)
                            .innerHTML =
                            ` ${valueOfElement[0]}`;
                    });
                    document.getElementById('btnGuardar').removeAttribute('disabled')
                    document.getElementById('btnCancelar').removeAttribute('disabled')
                    document.getElementById('loaderContractTmpFile').style.display = 'none';
                    document.getElementById('progressUploadContractContainer').style
                        .display =
                        'none';
                    document.getElementById('progressUploadContract').style.width =
                        `0%`;
                    document.getElementById('alertContratoUploadTmp')
                        .style.display = 'none'
                }
            });
        })
    })
</script>
<script>
    function replaceSlash(elemento) {
        elemento.value = elemento.value.replace("/", "-");
        elemento.value = elemento.value.replace("\\", "-");
    }
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


        $('.fecha_firma').datepicker({
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
                    text: 'La fecha de fin del contrato no puede ser igual a la fecha del inicio de contrato',
                });
                $(".fecha_fin_contrato").val("");
            }
        });

        $(function() {
            new AutoNumeric('#teste', {

                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                emptyInputBehavior: "zero",
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#este', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                emptyInputBehavior: "zero",
                decimalPlacesOverride: 2
            });
        });

        $(function() {
            new AutoNumeric('#prueba', {
                decimalCharacter: ',',
                decimalCharacter: '.',
                maximumValue: '100000000000',
                minimumValue: '0.00',
                currencySymbol: '$',
                emptyInputBehavior: "zero",
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
    $('#check_aplica_fianza').click(function(e) {
        if ($('#check_aplica_fianza').is(':checked')) {
            $('.td_fianza').fadeIn(0);
        } else {
            $('.td_fianza').fadeOut(0);
        }
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
