@extends('layouts.admin')
@section('content')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularios_centro_atencion.css') }}">
    <style type="text/css">
        sup {
            color: red;
        }

        ol.breadcrumb {
            margin-bottom: 0px;
        }

    </style>
@endsection
{{-- {{ Breadcrumbs::render('quejas-edit', $quejas) }} --}}
@include('partials.flashMessages')
<div class="card">
    <div class="text-center card-header" style="background-color: #345183;">
        <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-thumbs-down mr-2"></i> Quejas Clientes
        </strong>
    </div>
    <div class="caja_botones_menu">
        <a href="#" data-tabs="registro" class="btn_activo"><i class="fas fa-thumbs-down mr-2"></i>Registro de
            Queja a cliente</a>
        <a href="#" data-tabs="analisis"><i class="mr-4 fas fa-clipboard-list"></i>Análisis Causa Raíz</a>
        <a href="#" data-tabs="plan"><i class="mr-4 fas fa-tasks"></i>Plan de Acción</a>
    </div>
    <div class="card-body">

        <div class="caja_caja_secciones">

            <div class="caja_secciones">

                <section id="registro" class="caja_tab_reveldada">
                    <div class="seccion_div">
                        <form class="row" method="POST"
                            action="{{ route('admin.desk.quejasClientes-update', $quejasClientes) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="px-1 py-2 mx-3 mb-4 rounded shadow"
                                style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                <div class="row w-100">
                                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                        <div class="w-100">
                                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <p class="m-0"
                                            style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Al final de
                                            cada formulario dé clic en el botón guardar antes de cambiar de pestaña,
                                            de lo contrario la información capturada no será guardada.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 form-group col-12">
                                <b>Datos generales:</b>
                            </div>
                            <div class="mt-2 form-group col-2">
                                <label class="form-label"><i
                                        class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                <div class="form-control">{{ $quejasClientes->folio }}</div>
                            </div>
                            <div class="mt-2 form-group col-6">
                                <label class="form-label"><i class="fas fa-text-width iconos-crear"></i>Título corto
                                    de
                                    la queja<sup>*</sup></label>
                                <input class="form-control" name="titulo" value="{{ $quejasClientes->titulo }}"
                                    required>
                            </div>
                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                <select name="estatus" class="form-control" id="opciones"
                                    onchange='cambioOpciones();'>
                                    <option
                                        {{ old('estatus', $quejasClientes->estatus) == 'nuevo' ? 'selected' : '' }}
                                        value="nuevo">Nuevo</option>
                                    <option
                                        {{ old('estatus', $quejasClientes->estatus) == 'en curso' ? 'selected' : '' }}
                                        value="en curso">En curso</option>
                                    <option
                                        {{ old('estatus', $quejasClientes->estatus) == 'en espera' ? 'selected' : '' }}
                                        value="en espera">En espera</option>
                                    <option
                                        {{ old('estatus', $quejasClientes->estatus) == 'cerrado' ? 'selected' : '' }}
                                        value="cerrado">Cerrado</option>
                                    <option
                                        {{ old('estatus', $quejasClientes->estatus) == 'cancelado' ? 'selected' : '' }}
                                        value="cancelado">Cancelado</option>
                                </select>
                            </div>
                            <div class="mt-2 form-group col-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de identificación</label>
                                <input type="datetime" name="fecha"
                                value="{{ old('fecha_publicacion',\Carbon\Carbon::parse($quejasClientes->fecha))->format('d-m-Y H:i:s') }}"
                                    class="form-control">
                            </div>

                            <div class="mt-2 form-group col-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de recepción del reporte</label>
                                <div class="form-control">
                                    {{  \Carbon\Carbon::parse($quejasClientes->created_at)->format("d-m-Y H:i:s") }}
                                </div>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de cierre del ticket</label>
                                <input class="form-control" readonly name="fecha_cierre" type="datetime"
                                    value="{{ old('fecha_publicacion',\Carbon\Carbon::parse($quejasClientes->fecha_cierre))->format('d-m-Y H:i:s') }}"
                                    id="solucion">

                            </div>

                            <div class="d-none row col-12" id="cerradoCampo">

                                <div class="mt-2 form-group col-8">
                                    <label class="form-label"><i
                                            class="fas fa-file-import iconos-crear"></i>Adjuntar
                                        evidencia</label>
                                    <input type="file" name="cierre[]" class="form-control" multiple="multiple">
                                </div>

                                <div class="mt-5 form-group col-4">
                                    <span type="button" data-toggle="modal" data-target="#cierreEvidencia">
                                        <i class="mr-2 fas fa-file-download text-primary"
                                            style="font-size:14pt"></i>Descargar Documentos
                                    </span>
                                </div>

                            </div>

                            <div class="mt-0 form-group col-6">
                                <label class="form-label"><i
                                        class="bi bi-building mr-2 iconos-crear"></i>Cliente<sup>*</sup></label>
                                <select class="form-control" name="cliente_id">
                                    <option disabled selected>Seleccionar al cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            {{ old('cliente_id', $quejasClientes->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-0 form-group col-6">
                                <label class="form-label"><i
                                        class="fas fa-list iconos-crear"></i>Proyecto<sup>*</sup></label>
                                <select class="form-control" name="proyectos_id">
                                    <option disabled selected>Seleccionar el proyecto</option>
                                    @foreach ($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}"
                                            {{ old('proyectos_id', $quejasClientes->proyectos_id) == $proyecto->id ? 'selected' : '' }}>
                                            {{ $proyecto->proyecto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-0 form-group col-8">
                                <label class="form-label"><i
                                        class="fas fa-user-tie iconos-crear"></i>Nombre<sup>*</sup></label>
                                <input type="text" name="nombre" value="{{ old('nombre', $quejasClientes->nombre) }}"
                                    class="form-control" required>
                            </div>

                            <div class="mt-0 form-group col-4">
                                <label class="form-label"><i
                                        class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
                                <input type="text" name="puesto" value="{{ old('puesto', $quejasClientes->puesto) }}"
                                    class="form-control">
                            </div>

                            <div class="mt-0 form-group col-6">
                                <label class="form-label"><i
                                        class="fas fa-envelope iconos-crear"></i>Teléfono</label>
                                <input type="text" name="telefono"
                                    value="{{ old('telefono', $quejasClientes->telefono) }}" class="form-control">
                            </div>

                            <div class="mt-0 form-group col-6">
                                <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                                    electrónico</label>
                                <input type="text" name="correo" class="form-control"
                                    value="{{ old('correo', $quejasClientes->correo) }}">
                            </div>


                            <div class="mt-2 form-group col-12">
                                <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación
                                    exacta</label>
                                <input type="" name="ubicacion" class="form-control"
                                    value="{{ $quejasClientes->ubicacion }}">
                            </div>

                            <div class="mt-2 form-group col-12">
                                <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Descripción
                                    del
                                    riesgo identificado<sup>*</sup></label>
                                <textarea name="descripcion" class="form-control" required>{{ $quejasClientes->descripcion }}</textarea>
                            </div>
                            <div class="mt-4 text-center form-group col-12">
                                <div class="container">
                                    <div class="mb-4 row">
                                        <div class="col text-start">
                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                data-target="#largeModal">Evidencia</a>
                                        </div>
                                    </div>
                                    <!-- modal -->
                                    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog"
                                        aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @if (count($quejasClientes->evidencias_quejas))
                                                        <div id='carouselExampleIndicators' class='carousel slide'
                                                            data-ride='carousel'>
                                                            <ol class='carousel-indicators'>
                                                                @foreach ($quejasClientes->evidencias_quejas as $idx => $evidencia)
                                                                    <li data-target='#carouselExampleIndicators'
                                                                        data-slide-to='{{ $idx }}'
                                                                        class='{{ $idx == 0 ? 'active' : '' }}'></li>
                                                                @endforeach
                                                            </ol>
                                                            <div class='carousel-inner'>
                                                                @foreach ($quejasClientes->evidencias_quejas as $idx => $evidencia)
                                                                    <div
                                                                        class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                                        <iframe class='img-size'
                                                                            src='{{ asset('storage/evidencias_quejas_clientes' . '/' . $evidencia->evidencia) }}'></iframe>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <a class='carousel-control-prev'
                                                                href='#carouselExampleIndicators' role='button'
                                                                data-slide='prev'>
                                                                <span class='carousel-control-prev-icon'
                                                                    aria-hidden='true'></span>
                                                                <span class='sr-only'>Previous</span>
                                                            </a>
                                                            <a class='carousel-control-next'
                                                                href='#carouselExampleIndicators' role='button'
                                                                data-slide='next'>
                                                                <span class='carousel-control-next-icon'
                                                                    aria-hidden='true'></span>
                                                                <span class='sr-only'>Next</span>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="text-center">
                                                            <h3 style="text-align:center" class="mt-3">Sin
                                                                archivo agregado</h3>
                                                            <img src="{{ asset('img/undrawn.png') }}"
                                                                class="img-fluid " style="width:350px !important">
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- modal Evidencia Cierre -->
                                    <div class="modal fade" id="cierreEvidencia" tabindex="-1" role="dialog"
                                        aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @if (count($quejasClientes->cierre_evidencias))
                                                        <div id='carouselExampleIndicators' class='carousel slide'
                                                            data-ride='carousel'>
                                                            <ol class='carousel-indicators'>
                                                                @foreach ($quejasClientes->cierre_evidencias as $idx => $cierre)
                                                                    <li data-target='#carouselExampleIndicators'
                                                                        data-slide-to='{{ $idx }}'
                                                                        class='{{ $idx == 0 ? 'active' : '' }}'></li>
                                                                @endforeach
                                                            </ol>
                                                            <div class='carousel-inner'>
                                                                @foreach ($quejasClientes->cierre_evidencias as $idx => $cierre)
                                                                    <div
                                                                        class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                                        <iframe class='img-size'
                                                                            src='{{ asset('storage/evidencias_quejas_clientes_cerrado' . '/' . $cierre->cierre) }}'></iframe>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <a class='carousel-control-prev'
                                                                href='#carouselExampleIndicators' role='button'
                                                                data-slide='prev'>
                                                                <span class='carousel-control-prev-icon'
                                                                    aria-hidden='true'></span>
                                                                <span class='sr-only'>Previous</span>
                                                            </a>
                                                            <a class='carousel-control-next'
                                                                href='#carouselExampleIndicators' role='button'
                                                                data-slide='next'>
                                                                <span class='carousel-control-next-icon'
                                                                    aria-hidden='true'></span>
                                                                <span class='sr-only'>Next</span>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="text-center">
                                                            <h3 style="text-align:center" class="mt-3">Sin
                                                                archivo agregado</h3>
                                                            <img src="{{ asset('img/undrawn.png') }}"
                                                                class="img-fluid " style="width:350px !important">
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2 form-group col-12">
                                <label class="form-label">
                                    <strong>Queja cliente dirigida a:</strong>
                                </label>
                            </div>

                            <div class="mt-4 form-group col-3 multiselect_areas">
                                <label class="form-label"><i
                                        class="fas fa-project-diagram iconos-crear"></i>Área(s)</label>
                                <select class="form-control">
                                    <option disabled selected>Seleccionar áreas</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->area }}">
                                            {{ $area->area }}
                                        </option>
                                    @endforeach
                                </select>
                                <textarea name="area_quejado" class="form-control">{{ $quejasClientes->area_quejado }}</textarea>
                            </div>

                            <div class="mt-4 form-group col-3 multiselect_empleados">
                                <label class="form-label"><i
                                        class="fas fa-user iconos-crear"></i>Colaborador(es)</label>
                                <select class="form-control">
                                    <option disabled selected>Seleccionar colaborador</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->name }}">
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <textarea name="colaborador_quejado" class="form-control">{{ $quejasClientes->colaborador_quejado }}</textarea>
                            </div>

                            <div class="mt-4 form-group col-3 multiselect_procesos">
                                <label class="form-label"><i
                                        class="fas fa-code-branch iconos-crear"></i>Proceso(s)</label>
                                <select class="form-control">
                                    <option disabled selected>Seleccionar proceso</option>
                                    @foreach ($procesos as $proceso)
                                        <option value="{{ $proceso->codigo }}: {{ $proceso->nombre }}">
                                            {{ $proceso->codigo }}: {{ $proceso->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <textarea name="proceso_quejado" class="form-control">{{ $quejasClientes->proceso_quejado }}</textarea>
                            </div>

                            <div class="mt-4 form-group col-3">
                                <label class="form-label"><i
                                        class="fas fa-user-plus iconos-crear"></i>Otro(s)</label>
                                <textarea name="otro_quejado" class="form-control">
                                    {{ old('otro_quejado', $quejasClientes->otro_quejado) }}
                                </textarea>
                            </div>

                            <div class="mt-2 form-group col-12">
                                <label class="form-label"><i
                                        class="fas fa-comment-dots iconos-crear"></i>Comentarios
                                    del receptor</label>
                                <textarea name="comentarios" class="form-control">{{ $quejasClientes->comentarios }}</textarea>
                            </div>


                            <div class="mt-4 text-right form-group col-12">
                                <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
                                <input type="submit" class="btn btn-success" value="Enviar">
                            </div>
                        </form>
                    </div>
                </section>
                <section id="analisis">
                    <div class="seccion_div">
                        <div class="row">
                            <div class="px-1 py-2 mx-3 mb-4 rounded shadow"
                                style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                <div class="row w-100">
                                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                        <div class="w-100">
                                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <p class="m-0"
                                            style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Al final de
                                            cada formulario dé clic en el botón guardar antes de cambiar de pestaña,
                                            de lo contrario la información capturada no será guardada.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-sm-12 col-lg-12 col-md-12 text-primary ">
                                <strong style="font-size:13pt;">Folio: {{ $quejasClientes->folio }}</strong>
                            </div>
                            <div class="col-md-4">
                                Seleccione el metódo de análisis
                            </div>
                            <div class="col-md-8">
                                <select id="select_metodos" class="form-control">
                                    <option selected disabled>- -</option>
                                    <option class="op_ideas" data-metodo="ideas">Lluvia de ideas (Brainstorming)
                                    </option>
                                    <option class="op_porque" data-metodo="porque">5 Porqués (5 Why)</option>
                                    <option class="op_digrama" data-metodo="digrama">Diagrama causa efecto
                                        (Ishikawa)
                                    </option>
                                </select>
                            </div>

                            <form method="POST" class="col-12"
                                action="{{ route('admin.desk.analisis_quejasClientes-update', $analisis->id) }}">
                                @csrf

                                <div class="col-12" style="position: relative;">

                                    <div id="ideas" class="caja_oculta_dinamica row">
                                        <div class="form-group col-12">
                                            <label>Ideas</label>
                                            <textarea class="form-control" name="ideas">{{ $analisis->ideas }}</textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Causa Raíz</label>
                                            <textarea class="form-control" name="causa_ideas">{{ $analisis->causa_ideas }}</textarea>
                                        </div>
                                    </div>



                                    <div id="porque" class="caja_oculta_dinamica row">
                                        <div class="form-group col-12">
                                            Problema:
                                            <textarea class="form-control" name="problema_porque">{{ $analisis->problema_porque }}</textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>1er porqué:</label>
                                            <input name="porque_1" class="form-control"
                                                value="{{ $analisis->porque_1 }}">
                                            <label>2do porqué:</label>
                                            <input name="porque_2" class="form-control"
                                                value="{{ $analisis->porque_2 }}">
                                            <label>3er porqué:</label>
                                            <input name="porque_3" class="form-control"
                                                value="{{ $analisis->porque_3 }}">
                                            <label>4to porqué:</label>
                                            <input name="porque_4" class="form-control"
                                                value="{{ $analisis->porque_4 }}">
                                            <label>5to porqué:</label>
                                            <input name="porque_5" class="form-control"
                                                value="{{ $analisis->porque_5 }}">
                                        </div>
                                        <div class="form-group col-12">
                                            Causa Raíz:
                                            <textarea class="form-control" name="causa_porque">{{ $analisis->causa_porque }}</textarea>
                                        </div>
                                    </div>



                                    <div id="digrama" class="caja_oculta_dinamica">
                                        <div class="mt-5 col-md-12" style="overflow: auto;">
                                            <div style="width: 100%; min-width:980px; margin-left:80px;">
                                                <img src="{{ asset('img/diagrama_causa_raiz.png') }}"
                                                    style="width:190%; margin-top:20px;">
                                                <div
                                                    style="top:0px;left:150px; position: absolute;height:35px; width:150px;  background-color:#63e4e4; border-radius:15px;">
                                                    <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-balance-scale"
                                                            style="padding-top:6px; color:#1E3A8A;"></i></span><strong
                                                        style="color:#ffffff">Control</strong>
                                                </div>
                                                <div
                                                    style="top:0px; left:680px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                    <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-balance-scale"
                                                            style="padding-top:6px; color:#1E3A8A;"></i></span><strong
                                                        style="color:#ffffff">Proceso</strong>
                                                </div>
                                                <div
                                                    style="top:0px; left:1200px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                    <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-users"
                                                            style="padding-top:6px; color:#1E3A8A;"></i></span><strong
                                                        style="color:#ffffff">Personas</strong>
                                                </div>
                                                <div
                                                    style="buttom:0px; left:410px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                    <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-sim-card"
                                                            style="padding-top:6px; color:#1E3A8A;"></i></span><strong
                                                        style="color:#ffffff">Tecnología</strong>
                                                </div>
                                                <div
                                                    style="buttom:0px; left:920px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                    <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-sim-card"
                                                            style="padding-top:6px; color:#1E3A8A;"></i></span><strong
                                                        style="color:#ffffff">Métodos</strong>
                                                </div>
                                                <div
                                                    style="buttom:0px;left:1450px; position: absolute;height:35px; width:150px; background-color:#63e4e4;border-radius:15px;">
                                                    <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-chalkboard"
                                                            style="padding-top:6px; color:#1E3A8A;"></i></span><strong
                                                        style="color:#ffffff">Recursos</strong>
                                                </div>
                                                <div class="col-6"
                                                    style="top:55px; left:290px; position: absolute; height:30px !important;">
                                                    <textarea name="control_a" class="politicas_txtarea" id="analisisControl">{{ $analisis->control_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="control_b" class="politicas_txtarea txt_obj_secundarios_a">{{ $analisis->control_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="top:55px; left:810px; position: absolute; height:30px !important;">
                                                    <textarea name="proceso_a" class="procesos_txtarea" id="analisisProceso">{{ $analisis->proceso_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="proceso_b" class="procesos_txtarea txt_obj_secundarios_a">{{ $analisis->proceso_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="top:55px; left:1315px; position: absolute; height:30px !important;">
                                                    <textarea name="personas_a" class="personas_txtarea" id="analisisPersona">{{ $analisis->personas_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="personas_b" class="personas_txtarea txt_obj_secundarios_a">{{ $analisis->personas_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; right:480px; position: absolute;">
                                                    <textarea name="tecnologia_a" id="analisisTecnologia"
                                                        class="tecnologia_txtarea txt_obj_secundarios_b">{{ $analisis->tecnologia_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="tecnologia_b" class="tecnologia_txtarea ">{{ $analisis->tecnologia_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; left:540px; position: absolute;">
                                                    <textarea name="metodos_a" class="metodos_txtarea txt_obj_secundarios_b"
                                                        id="analisisMetodos">{{ $analisis->metodos_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="metodos_b" class="metodos_txtarea ">{{ $analisis->metodos_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; left:1060px; position: absolute;">
                                                    <textarea name="ambiente_a" class="ambiente_txtarea txt_obj_secundarios_b"
                                                        id="analisisAmbiente">{{ $analisis->ambiente_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="ambiente_b" class="ambiente_txtarea ">{{ $analisis->ambiente_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; left:1600px; position: absolute;">
                                                    <textarea name="problema_diagrama" class="problemas_txtarea"
                                                        id="analisisProblema">{{ $analisis->problema_diagrama }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3 text-right col-12">
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <section id="plan">
                    <div class="seccion_div">
                        <div class="row">
                            <div class="mb-3 col-sm-12 col-lg-12 col-md-12 text-primary ">
                                <strong style="font-size:13pt;">Folio: {{ $quejasClientes->folio }}</strong>
                            </div>
                        </div>
                        <div class="" style=" position: relative; ">
                            <h5 style=" position: ;"><b>Acciones para la Atención de la Queja Cliente</b></h5>
                            <button style="position:absolute; right: 2px; top:2px;"
                                class="btn btn-success btn_modal_form" id="vincularPlan">Vincular Plan</button>
                            @if (count($quejasClientes->planes))
                                @foreach ($quejasClientes->planes as $plan)
                                    <a style="position:absolute; right: 170px; top:2px;"
                                        href="{{ route('admin.planes-de-accion.show', $plan->id) }}"
                                        class="btn btn-success"><i class="mr-2 fas fa-stream"></i> Plan De
                                        Acción {{ $plan->parent }}</a>
                                @endforeach
                            @endif
                        </div>
                        {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}

                        <div class="row w-100">

                            <label for="plan_accion" style="margin-left: 15px; margin-bottom:5px;"> <i
                                    class="fas fa-question-circle iconos-crear"></i> ¿Vincular con plan de
                                acción?</label>

                            @livewire('planes-implementacion-select',['planes_seleccionados'=>$quejasClientes->planes->pluck('id')->toArray()])

                            <div class="pl-0 ml-0 col-2">

                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#planAccionModal">

                                    <i class="mr-1 fas fa-plus-circle"></i> Crear

                                </button>

                            </div>

                            @livewire('plan-implementacion-create', ['referencia' => null,'modulo_origen'=>'Quejas
                            Clientes'])

                        </div>

                        {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}

                        {{-- <div class="modal_form_plan">
                                <div class="fondo_modal"></div>
                                <form class="card" id="form_plan_accion" method="POST"
                                    action="{{ route('admin.desk-quejas-actividades.store') }}">
                                    <input type="hidden" name="queja_id" value="{{ $quejas->id }}">
                                    <div class="text-center card-header" style="background-color: #345183;">
                                        <strong style="font-size: 16pt; color: #fff;"><i
                                                class="mr-4 fas fa-tasks"></i>Crear: Plan de Acción</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label"><i
                                                        class="fas fa-wrench iconos-crear"></i>Actividad</label>
                                                <input type="" name="actividad" class="form-control" id="actividad">
                                                <span class="text-danger error_actividad errors"></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label"><i
                                                        class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                                                    inicio</label>
                                                <input type="date" name="fecha_inicio" class="form-control"
                                                    id="fecha_inicio">
                                                <span class="text-danger error_fecha_inicio errors"></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label"><i
                                                        class="fas fa-calendar-alt iconos-crear"></i>Fecha de fin</label>
                                                <input type="date" name="fecha_fin" class="form-control" id="fecha_fin">
                                                <span class="text-danger error_fecha_fin errors"></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label"><i
                                                        class="fas fa-flag iconos-crear"></i>Prioridad</label>
                                                <select class="form-control" name="prioridad" id="prioridad">
                                                    <option value="Alta">Alta</option>
                                                    <option value="Media">Media</option>
                                                    <option value="Baja">Baja</option>
                                                </select>
                                                <span class="text-danger error_prioridad errors"></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label"><i
                                                        class="fas fa-list-alt iconos-crear"></i>Tipo</label>
                                                <select class="form-control" name="tipo" id="tipo">
                                                    <option value="Acción inmediata">Acción inmediata</option>
                                                    <option value="Acción subsecuente">Acción subsecuente</option>
                                                    <option value="Acción posterior">Acción posterior </option>
                                                </select>
                                                <span class="text-danger error_tipo errors"></span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label"><i
                                                        class="fas fa-users iconos-crear"></i>Responsables</label>
                                                <select class="form-control select2" name="responsables[]" multiple
                                                    id="responsables">
                                                    @foreach ($empleados as $empleado)
                                                        <option value="{{ $empleado->id }}">{{ $empleado->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error_responsables errors"></span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label"><i
                                                        class="fas fa-comments iconos-crear"></i>Comentarios</label>
                                                <textarea class="form-control" name="comentarios" id="comentarios"></textarea>
                                                <span class="text-danger error_comentarios errors"></span>
                                            </div>
                                            <div class="text-right form-group col-md-12">
                                                <a href="#" class="btn btn_cancelar">Cancelar</a>
                                                <input type="submit" value="Guardar"
                                                    class="btn btn-success btn_enviar_form_modal">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        let estatus = @json($quejasClientes->estatus);
        if (estatus == 'cerrado') {

            $('#cerradoCampo').removeClass('d-none')

        } else {

            $('#cerradoCampo').addClass('d-none')

        }
    })

    $(document).on('change', '#opciones', function(event) {
        if ($('#opciones option:selected').val() == 'cerrado') {
            $('#cerradoCampo').removeClass('d-none');
        } else {
            $('#cerradoCampo').addClass('d-none');
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        let estatus = @json($quejasClientes->estatus);
        if (estatus == 'cerrado') {

            document.getElementById('solucion').value = formatDate(fecha);

        } else {

            document.getElementById('solucion').value = "";

        }
    })


    const formatDate = (current_datetime) => {
        let formatted_date = current_datetime.getFullYear() + "-" + (current_datetime.getMonth() + 1) + "-" +
            current_datetime.getDate() + " " + current_datetime.getHours() + ":" + current_datetime.getMinutes() +
            ":" + current_datetime.getSeconds();
        return formatted_date;
    }

    function cambioOpciones() {
        var combo = document.getElementById('opciones');
        var opcion = combo.value;
        if (opcion == "cerrado") {
            var fecha = new Date();
            document.getElementById('solucion').value = formatDate(fecha);
        } else {
            document.getElementById('solucion').value = "";
        }
    }
</script>

<script type="text/javascript">
    $(".btn_modal_form").click(function() {
        $(".modal_form_plan").addClass("modal_vista_plan");
        $(".select2").select2({
            theme: 'bootstrap4'
        });
    });
    $(".modal_form_plan .btn.btn_cancelar").click(function() {
        $(".modal_form_plan").removeClass("modal_vista_plan");
    });

    $(".fondo_modal").click(function() {
        $(".modal_form_plan").removeClass("modal_vista_plan");
    });

    $(".btn_enviar_form_modal").click(function(e) {
        e.preventDefault();
        let datos = $('#form_plan_accion').serialize();
        let url = document.getElementById('form_plan_accion').getAttribute('action')

        $.ajax({
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: datos,
            beforeSend: function() {
                toastr.info('Validando y Guardando');
            },
            success: function(response) {
                if (response.success) {
                    $(".modal_form_plan").removeClass("modal_vista_plan");
                    tbl_plan.ajax.reload();
                    limpiarCampos();
                    Swal.fire('Actividad Creada', 'La actividad ha sido creada con éxito',
                        'success');
                }
            },
            error: function(request, status, error) {
                document.querySelectorAll('.errors').forEach(error => {
                    error.innerHTML = "";
                });
                $.each(request.responseJSON.errors, function(indexInArray, valueOfElement) {
                    console.log(valueOfElement, indexInArray);
                    $(`span.error_${indexInArray}`).text(valueOfElement[0]);

                });
            }
        });
    });


    function limpiarCampos() {

        document.getElementById('actividad').value = "";
        document.getElementById('fecha_inicio').value = "";
        document.getElementById('fecha_fin').value = "";
        document.getElementById('prioridad').value = "";
        document.getElementById('tipo').value = "";
        document.getElementById('responsables').value = "";
        document.getElementById('comentarios').value = "";

    }
</script>


<script type="text/javascript">
    $(document).on('change', '#select_metodos', function(event) {
        $(".caja_oculta_dinamica").removeClass("d-block");
        var metodo_v = $("#select_metodos option:selected").attr('data-metodo');
        $(document.getElementById(metodo_v)).addClass("d-block");
    });
</script>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelector('.multiselect_areas select').addEventListener('change', function(e) {
            e.preventDefault();

            (document.querySelector('.multiselect_areas textarea')).value += `${this.value}, `;

        });
    });

    document.addEventListener('DOMContentLoaded', function() {

        document.querySelector('.multiselect_empleados select').addEventListener('change', function(e) {
            e.preventDefault();

            (document.querySelector('.multiselect_empleados textarea')).value += `${this.value}, `;

        });
    });

    document.addEventListener('DOMContentLoaded', function() {

        document.querySelector('.multiselect_procesos select').addEventListener('change', function(e) {
            e.preventDefault();

            (document.querySelector('.multiselect_procesos textarea')).value += `${this.value}, `;

        });
    });
</script>

<script>
    $(document).ready(function() {
        CKEDITOR.replace('analisisControl', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('analisisProceso', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('analisisPersona', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('analisisTecnologia', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('analisisMetodos', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('analisisAmbiente', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('analisisProblema', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

    });
</script>

<script type="text/javascript">
    Livewire.on('planStore', () => {

        $('#planAccionModal').modal('hide');

        $('.modal-backdrop').hide();

        toastr.success('Plan de Acción creado con éxito');

    });

    window.initSelect2 = () => {

        $('.select2').select2({

            'theme': 'bootstrap4'

        });

    }



    initSelect2();



    Livewire.on('select2', () => {

        initSelect2();

    });

    $(document).ready(function() {
        document.getElementById('vincularPlan').addEventListener('click', (e) => {
            e.preventDefault();
            let planes = $("#plan_accion").select2("val");
            let idQuejaCliente = @json($quejasClientes->id);
            if (planes.length > 0) {
                Swal.fire({
                    title: 'Desea vincular plan(es)?',
                    text: "Esta acción se visualizara en planes de acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, vincular',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: "{{ route('admin.desk.planesQuejasClientes') }}",
                            data: {
                                planes,
                                id: idQuejaCliente
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.success) {
                                    window.location.reload();
                                }
                            }
                        });
                    }
                })
            }
        })

    });
</script>
@endsection
