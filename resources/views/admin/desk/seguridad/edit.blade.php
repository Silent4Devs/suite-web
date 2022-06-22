@extends('layouts.admin')
@section('content')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularios_centro_atencion.css') }}">
    <style>
        ol.breadcrumb {
            margin-bottom: 0px;
        }

        .circulo {
            width: 25px;
            height: 25px;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            background: #ffffff;
        }

    </style>
@endsection
{{ Breadcrumbs::render('seguridad-edit', $incidentesSeguridad) }}
@include('partials.flashMessages')
{{-- <h5 class="col-12 titulo_general_funcion">Incidentes de seguridad</h5> --}}
<div class="card" id="desk">
    <div class="text-center card-header" style="margin-bottom: 20px; background-color: #345183;">
        <strong style="font-size: 16pt; color: #fff;"><i class="mr-4 fas fa-exclamation-triangle"></i>Incidentes de
            seguridad</strong>
    </div>
    <div class="caja_botones_menu" style=" justify-content: left !important;">
        <a href="#" data-tabs="registro" class="btn_activo"><i class="mr-4 fas fa-exclamation-triangle"></i>Registro
            de
            Incidentes</a>
        <a href="#" data-tabs="analisis"><i class="mr-4 fas fa-clipboard-list"></i>Análisis Causa Raíz</a>
        <a href="#" data-tabs="plan"><i class="mr-4 fas fa-tasks"></i>Plan de Acción</a>
    </div>



    <div class="card-body">
        <div class="caja_caja_secciones">
            <div class="caja_secciones">
                <section id="registro" class="caja_tab_reveldada">
                    <div class="seccion_div">

                        <form class="row" method="POST"
                            action="{{ route('admin.desk.seguridad-update', $incidentesSeguridad) }}">
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
                                            cada formulario dé clic en el botón guardar antes de cambiar de pestaña, de
                                            lo contrario la información capturada no será guardada.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 form-group col-md-12">
                                <b>Datos generales:</b>
                            </div>

                            <div class="mt-2 form-group col-md-2">
                                <label class="form-label"><i
                                        class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                <div class="form-control" id="input_folio">{{ $incidentesSeguridad->folio }}</div>
                            </div>

                            <div class="mt-2 form-group col-md-6">
                                <label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Título
                                    corto
                                    del incidente</label>
                                <input type="" name="titulo" value="{{ $incidentesSeguridad->titulo }}"
                                    class="form-control" required>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                <select name="estatus" class="form-control" id="opciones"
                                    onchange='cambioOpciones();'>
                                    <option
                                        {{ old('estatus', $incidentesSeguridad->estatus) == 'nuevo' ? 'selected' : '' }}
                                        value="nuevo">Nuevo</option>
                                    <option
                                        {{ old('estatus', $incidentesSeguridad->estatus) == 'en curso' ? 'selected' : '' }}
                                        value="en curso">En curso</option>
                                    <option
                                        {{ old('estatus', $incidentesSeguridad->estatus) == 'en espera' ? 'selected' : '' }}
                                        value="en espera">En espera</option>
                                    <option
                                        {{ old('estatus', $incidentesSeguridad->estatus) == 'cerrado' ? 'selected' : '' }}
                                        value="cerrado">Cerrado</option>
                                    <option
                                        {{ old('estatus', $incidentesSeguridad->estatus) == 'cancelado' ? 'selected' : '' }}
                                        value="cancelado">Cancelado</option>
                                </select>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de ocurrencia del incidente</label>
                                <input type="datetime" name="fecha" value="{{ $incidentesSeguridad->fecha }}"
                                    class="form-control">
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de recepción del reporte</label>
                                <div class="form-control">{{ $incidentesSeguridad->created_at }}</div>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de cierre del ticket</label>

                                <input class="form-control" readonly name="fecha_cierre" type="datetime"
                                    value="{{ $incidentesSeguridad->fecha_cierre }}" id="solucion">

                            </div>

                            {{-- <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Asignado
                                    a</label>
                                <select name="empleado_asignado_id" class="form-control">
                                    @foreach ($empleados as $empleado)
                                    <option value="" disabled selected
                                    {{ old('empleado_asignado_id', $incidentesSeguridad->asignado->name) }}
                                        >
                                    </option>
                                        <option
                                            value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="form-group col-md-4">
                                <label for="empleado_asignado_id"><i
                                        class="fas fa-user-tie iconos-crear"></i>Asignado</label>
                                <select class="form-control {{ $errors->has('id_reviso') ? 'is-invalid' : '' }}"
                                    name="empleado_asignado_id" id="empleado_asignado_id">
                                    <option value="" selected disabled>Selecciona una opción</option>
                                    @foreach ($empleados as $id => $empleado)
                                        <option value="{{ $empleado->id }}"
                                            {{ old('empleado_asignado_id', $incidentesSeguridad->empleado_asignado_id) == $empleado->id ? 'selected' : '' }}>

                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('empleados'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('empleados') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-layer-group iconos-crear"></i>Categoría</label>
                                <select id="select_categoria" class="form-control"
                                    value="{{ $incidentesSeguridad->categoria }}" name="categoria">
                                    <option selected disabled></option>
                                    @foreach ($categorias as $categoria)
                                        <option id="categoria{{ $categoria->id }}" value="{{ $categoria->id }}"
                                            class="">{{ $categoria->categoria }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-adjust iconos-crear"></i>Subcategoría</label>
                                <select id="select_subcategorias" class="form-control"
                                    value="{{ $incidentesSeguridad->subcategoria }}" name="subcatgoría">
                                    <option selected disabled class="option_vacio"></option>
                                    @foreach ($subcategorias as $subcategoria)
                                        <option class="d-none categoria{{ $subcategoria->categoria->id }}"
                                            value="{{ $subcategoria->id }}">
                                            {{ $subcategoria->subcategoria }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i>
                                    Sede</label>
                                <select class="form-control" name="sede">
                                    <option disabled>seleccione sede</option>
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->sede }}">{{ $sede->sede }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-2 form-group col-md-8">
                                <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación
                                    exacta</label>
                                <input type="" name="ubicacion" class="form-control"
                                    value="{{ $incidentesSeguridad->ubicacion }}">
                            </div>


                            <div class="mt-2 form-group col-md-12">
                                <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Descripción
                                    del
                                    incidente</label>
                                <textarea name="descripcion" class="form-control" required>{{ $incidentesSeguridad->descripcion }}
                                    </textarea>
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
                                                    @if (count($incidentesSeguridad->evidencias_seguridad))
                                                        <!-- carousel -->
                                                        <div id='carouselExampleIndicators' class='carousel slide'
                                                            data-ride='carousel'>
                                                            <ol class='carousel-indicators'>
                                                                @foreach ($incidentesSeguridad->evidencias_seguridad as $idx => $evidencia)
                                                                    <li data-target='#carouselExampleIndicators'
                                                                        data-slide-to='{{ $idx }}'
                                                                        class='{{ $idx == 0 ? 'active' : '' }}'></li>
                                                                @endforeach
                                                            </ol>
                                                            <div class='carousel-inner'>
                                                                @foreach ($incidentesSeguridad->evidencias_seguridad as $idx => $evidencia)
                                                                    <div
                                                                        class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                                        <iframe class='img-size'
                                                                            src='{{ asset('storage/evidencias_seguridad' . '/' . $evidencia->evidencia) }}'></iframe>
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
                                </div>
                            </div>

                            <div class="mt-2 form-group col-md-4 areas_multiselect">
                                <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i>Área(s)
                                    afectada(s)</label>
                                <select class="form-control" id="activos">
                                    <option disabled selected>Seleccionar áreas</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->area }}">{{ $area->area }}
                                        </option>
                                    @endforeach
                                </select>
                                <textarea name="areas_afectados" class="form-control"
                                    id="texto_activos">{{ $incidentesSeguridad->areas_afectados }}</textarea>
                            </div>

                            <div class="mt-2 form-group col-md-4 procesos_multiselect">
                                <label class="form-label"><i class="fas fa-dice-d20 iconos-crear"></i>Proceso(s)
                                    afectado(s)</label>
                                <select class="form-control" id="activos">
                                    <option disabled selected>Seleccionar procesos</option>
                                    @foreach ($procesos as $proceso)
                                        <option value="{{ $proceso->nombre }}">{{ $proceso->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <textarea name="procesos_afectados" class="form-control"
                                    id="texto_activos">{{ $incidentesSeguridad->procesos_afectados }}</textarea>
                            </div>

                            <div class="mt-2 form-group col-md-4 activos_multiselect">
                                <label class="form-label"><i class="fa-fw fas fa-laptop iconos-crear"></i>Activo(s)
                                    afectado(s)</label>
                                <select class="form-control" id="activos">
                                    <option disabled selected>Seleccionar afectados</option>
                                    @foreach ($activos as $activo)
                                        <option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}
                                        </option>
                                    @endforeach
                                </select>
                                <textarea name="activos_afectados" class="form-control"
                                    id="texto_activos">{{ $incidentesSeguridad->activos_afectados }}</textarea>
                            </div>



                            <div class="mt-4 form-group col-md-12">
                                <b>Reportó incidente:</b>
                            </div>

                            <div class="mt-0 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                                <div class="form-control">
                                    {{ Str::limit($incidentesSeguridad->reporto->name, 30, '...') }}</div>
                            </div>

                            <div class="mt-0 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                <div class="form-control">{{ $incidentesSeguridad->reporto->puesto }}</div>
                            </div>

                            <div class="mt-0 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-puzzle-piece iconos-crear"></i></i>Área</label>
                                <div class="form-control">{{ $incidentesSeguridad->reporto->area->area }}</div>
                            </div>

                            <div class="mt-2 form-group col-md-6">
                                <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                                    electrónico</label>
                                <div class="form-control">{{ $incidentesSeguridad->reporto->email }}</div>
                            </div>

                            <div class="mt-2 form-group col-md-6">
                                <label class="form-label"><i
                                        class="fas fa-phone iconos-crear"></i>Teléfono</label>
                                <div class="form-control">{{ $incidentesSeguridad->reporto->telefono }}</div>
                            </div>


                            <div class="mt-4 form-group col-md-12">
                                <b>Priorización del incidente:</b>
                            </div>







                            <div class="mt-2 form-group col-md-4 select_elegir_prioridad">
                                <label class="form-label"><i
                                        class="fas fa-chart-line iconos-crear"></i>Urgencia</label>
                                <select class="form-control" name="urgencia" id="select_urgencia">
                                    <option data-urgencia="3"
                                        {{ old('urgencia', $incidentesSeguridad->urgencia) == 'Alta' ? 'selected' : '' }}>
                                        Alta</option>
                                    <option data-urgencia="2"
                                        {{ old('urgencia', $incidentesSeguridad->urgencia) == 'Media' ? 'selected' : '' }}>
                                        Media</option>
                                    <option data-urgencia="1"
                                        {{ old('urgencia', $incidentesSeguridad->urgencia) == 'Baja' ? 'selected' : '' }}>
                                        Baja</option>
                                </select>
                            </div>

                            <div class="mt-2 form-group col-md-4 select_elegir_prioridad">
                                <label class="form-label"><i
                                        class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                                <select class="form-control" name="impacto" id="select_impacto">
                                    <option data-impacto="3"
                                        {{ old('impacto', $incidentesSeguridad->impacto) == 'Alta' ? 'selected' : '' }}>
                                        Alta</option>
                                    <option data-impacto="2"
                                        {{ old('impacto', $incidentesSeguridad->impacto) == 'Media' ? 'selected' : '' }}>
                                        Media</option>
                                    <option data-impacto="1"
                                        {{ old('impacto', $incidentesSeguridad->impacto) == 'Baja' ? 'selected' : '' }}>
                                        Baja</option>
                                </select>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i
                                        class="fas fa-flag iconos-crear"></i>Prioridad</label>
                                <div class="form-control" id="prioridad"></div>
                            </div>





                            <div class="mt-2 form-group col-md-12">
                                <label class="form-label"><i
                                        class="fas fa-comment-dots iconos-crear"></i>Comentarios</label>
                                <textarea name="comentarios" class="form-control">{{ $incidentesSeguridad->comentarios }}</textarea>
                            </div>

                            <div class="mt-2 text-right form-group col-md-12">
                                <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cancelar</a>
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
                                <strong style="font-size:13pt;">Folio: {{ $incidentesSeguridad->folio }}</strong>
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

                            <form method="POST" class="col-md-12"
                                action="{{ route('admin.desk.analisis_seguridad-update', $analisis) }}">
                                @csrf

                                <div class="col-md-12" style="position: relative;">

                                    <div id="ideas" class="caja_oculta_dinamica row">
                                        <div class="form-group col-md-12">
                                            <label>Ideas</label>
                                            <textarea class="form-control" name="ideas">{{ $analisis->ideas }}</textarea>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Causa Raíz</label>
                                            <textarea class="form-control" name="causa_ideas">{{ $analisis->causa_ideas }}</textarea>
                                        </div>
                                    </div>



                                    <div id="porque" class="caja_oculta_dinamica row">
                                        <div class="form-group col-md-12">
                                            Problema:
                                            <textarea class="form-control" name="problema_porque">{{ $analisis->problema_porque }}</textarea>
                                        </div>
                                        <div class="form-group col-md-12">
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
                                        <div class="form-group col-md-12">
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
                                                    style="top:0px;left:170px; position: absolute;height:35px; width:150px;  background-color:#63e4e4; border-radius:15px;">
                                                    <span ><i
                                                            class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-balance-scale" style="padding-top:6px; color:#1E3A8A;"></i></span><strong style="color:#ffffff">Control</strong>
                                                </div>
                                                <div
                                                style="top:0px; left:780px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                <span ><i
                                                        class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-balance-scale" style="padding-top:6px; color:#1E3A8A;"></i></span><strong style="color:#ffffff">Proceso</strong>
                                                </div>
                                                <div
                                                style="top:0px; left:1350px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                <span ><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-users" style="padding-top:6px; color:#1E3A8A;"></i></span><strong style="color:#ffffff">Personas</strong>
                                                </div>
                                                <div
                                                style="buttom:0px; left:450px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                <span ><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-sim-card" style="padding-top:6px; color:#1E3A8A;"></i></span><strong style="color:#ffffff">Tecnología</strong>
                                                </div>
                                                <div
                                                style="buttom:0px; left:1050px; position: absolute;height:35px; width:150px;  background-color:#63e4e4;border-radius:15px;">
                                                <span ><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-sim-card" style="padding-top:6px; color:#1E3A8A;"></i></span><strong style="color:#ffffff">Métodos</strong>
                                                </div>
                                                <div
                                                style="buttom:0px;left:1670px; position: absolute;height:35px; width:150px; background-color:#63e4e4;border-radius:15px;">
                                                <span ><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-chalkboard" style="padding-top:6px; color:#1E3A8A;"></i></span><strong style="color:#ffffff">Recursos</strong>
                                                </div>
                                                {{-- <div> --}}
                                                <div class="col-6" style="top:55px; left:290px; position: absolute; height:30px !important;">
                                                    <textarea style="top:20px;" name="control_a" id="analisisControl" class=" politicas_txtarea">{{ $analisis->control_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="control_b"
                                                    class="politicas_txtarea txt_obj_secundarios_a">{{ $analisis->control_b }}</textarea> --}}
                                                <div class="col-6" style="top:55px; left:890px; position: absolute; height:30px !important;">
                                                    <textarea style="top:20px;" id="analisisProceso" name="proceso_a" class="procesos_txtarea">{{ $analisis->proceso_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="proceso_b" class="procesos_txtarea txt_obj_secundarios_a">{{ $analisis->proceso_b }}</textarea> --}}
                                                <div class="col-6" style="top:55px; left:1480px; position: absolute; height:30px !important;">
                                                    <textarea name="personas_a" id="analisisPersona" class="personas_txtarea">{{ $analisis->personas_a }}</textarea>
                                                </div>
                                                    {{-- <textarea name="personas_b" class="personas_txtarea txt_obj_secundarios_a">{{ $analisis->personas_b }}</textarea> --}}
                                                {{-- </div> --}}
                                                <div class="col-6"
                                                style="bottom:5px; right:590px; position: absolute;">
                                                    <textarea style="margin-top:100px;" name="tecnologia_a" id="analisisTecnologia" class="tecnologia_txtarea txt_obj_secundarios_b">{{ $analisis->tecnologia_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="tecnologia_b" class="tecnologia_txtarea ">{{ $analisis->tecnologia_b }}</textarea> --}}
                                                <div class="col-6" style="bottom:5px; left:590px; position: absolute;">
                                                    <textarea name="metodos_a" class="metodos_txtarea txt_obj_secundarios_b" id="analisisMetodos">{{ $analisis->metodos_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="metodos_b" class="metodos_txtarea ">{{ $analisis->metodos_b }}</textarea> --}}
                                                <div class="col-6" style="bottom:5px; left:1200px; position: absolute;">
                                                    <textarea name="ambiente_a" class="ambiente_txtarea txt_obj_secundarios_b" id="analisisAmbiente">{{ $analisis->ambiente_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="ambiente_b" class="ambiente_txtarea ">{{ $analisis->ambiente_b }}</textarea> --}}
                                                <div class="col-6" style="bottom:5px; left:1800px; position: absolute;">
                                                    <textarea name="problema_diagrama" class="problemas_txtarea" id="analisisProblema">{{ $analisis->problema_diagrama }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3 text-right col-md-12">
                                    <input type="submit" class="btn btn-success" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <section id="plan">
                    <div class="seccion_div">
                        <div class="row">
                            <div class="mb-3 col-sm-12 col-lg-12 col-md-12 text-primary ">
                                <strong style="font-size:13pt;">Folio: {{ $incidentesSeguridad->folio }}</strong>
                            </div>
                        </div>
                        <div class="" style=" position: relative; ">
                            <h5 style=" position: ;"><b>Acciones para la Atención de la Denuncia</b></h5>
                            <button style="position:absolute; right: 2px; top:2px;"
                                class="btn btn-success btn_modal_form">Agregar actividad</button>
                            @if (count($incidentesSeguridad->planes))
                                <a style="position:absolute; right: 170px; top:2px;"
                                    href="{{ route('admin.planes-de-accion.show', $incidentesSeguridad->planes->first()->id) }}"
                                    class="btn btn-success"><i class="mr-2 fas fa-stream"></i> Plan De
                                    Acción</a>
                            @endif
                        </div>
                        <div class="mt-4 datatable-fix" style="width: 100%;">
                            <table id="tabla_plan_accion" class="table w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Actividad</th>
                                        <th>Fecha&nbsp;de&nbsp;inicio</th>
                                        <th>Fecha&nbsp;de&nbsp;fin</th>
                                        <th>Prioridad</th>
                                        <th>Tipo</th>
                                        <th>Responsable(s)</th>
                                        <th>Comentarios</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal_form_plan">
                            <div class="fondo_modal"></div>
                            <form class="card" id="form_plan_accion" method="POST"
                                action="{{ route('admin.desk-seguridad-actividades.store') }}">
                                <input type="hidden" name="seguridad_id" value="{{ $incidentesSeguridad->id }}">
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
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
@parent
<script type="text/javascript">
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
            document.getElementById('solucion').value = fecha.toLocaleString().replaceAll("/", "-");
        } else {
            document.getElementById('solucion').value = "";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        let select_activos = document.querySelector('.areas_multiselect #activos');
        select_activos.addEventListener('change', function(e) {
            e.preventDefault();
            let texto_activos = document.querySelector('.areas_multiselect #texto_activos');

            texto_activos.value += `${this.value}, `;

        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        let select_activos = document.querySelector('.procesos_multiselect #activos');
        select_activos.addEventListener('change', function(e) {
            e.preventDefault();
            let texto_activos = document.querySelector(
                '.procesos_multiselect #texto_activos');

            texto_activos.value += `${this.value}, `;

        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        let select_activos = document.querySelector('.activos_multiselect #activos');
        select_activos.addEventListener('change', function(e) {
            e.preventDefault();
            let texto_activos = document.querySelector(
                '.activos_multiselect #texto_activos');

            texto_activos.value += `${this.value}, `;

        });
    });
</script>
<script type="text/javascript">
    $(document).on('change', '#select_metodos', function(event) {
        $(".caja_oculta_dinamica").removeClass("d-block");
        var metodo_v = $("#select_metodos option:selected").attr('data-metodo');
        $(document.getElementById(metodo_v)).addClass("d-block");
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        window.tbl_plan = $("#tabla_plan_accion").DataTable({
            ajax: "{{ route('admin.desk-seguridad-actividades.index', $incidentesSeguridad->id) }}",
            buttons: [],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'actividad'
                },
                {
                    data: 'fecha_inicio'
                },
                {
                    data: 'fecha_fin'
                },
                {
                    data: 'prioridad'
                },
                {
                    data: 'tipo'
                },
                {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let lista = '<ul>';
                        row.responsables.forEach(responsable => {
                            lista += `<li>${responsable.name}</li>`;
                        })
                        lista += '</ul>';

                        return lista;
                    }
                },
                {
                    data: 'comentarios'
                },
            ]
        });
    });
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
    $(document).on('change', '#select_categoria', function(event) {
        $("#select_subcategorias option").addClass("d-none");
        $("#select_subcategorias option:selected").remove();
        var categoria_selected = $("#select_categoria option:selected").attr('id');
        $(document.getElementsByClassName(categoria_selected)).removeClass("d-none");
    });
</script>

<script type="text/javascript">
    var prioridad = 0;
    var impacto = 0;
    var urgencia = 0;
    var prioridad_nombre = '';

    urgencia = new Number($('#select_urgencia option:selected').attr('data-urgencia'));
    impacto = new Number($('#select_impacto option:selected').attr('data-impacto'));
    prioridad = urgencia + impacto;
    if (prioridad <= 2) {
        prioridad_nombre = 'Baja';
    }
    if (prioridad >= 3) {
        prioridad_nombre = 'Media';
    }
    if (prioridad >= 5) {
        prioridad_nombre = 'Alta';
    }
    $("#prioridad").html(prioridad_nombre);



    $(document).on('change', '#select_urgencia', function(event) {
        urgencia = new Number($('#select_urgencia option:selected').attr('data-urgencia'));

        prioridad = urgencia + impacto;



        if (prioridad <= 2) {
            prioridad_nombre = 'Baja';
        }
        if (prioridad >= 3) {
            prioridad_nombre = 'Media';
        }
        if (prioridad >= 5) {
            prioridad_nombre = 'Alta';
        }

        $("#prioridad").html(prioridad_nombre);
    });
    $(document).on('change', '#select_impacto', function(event) {
        impacto = new Number($('#select_impacto option:selected').attr('data-impacto'));

        prioridad = urgencia + impacto;

        if (prioridad <= 2) {
            prioridad_nombre = 'Baja';
        }
        if (prioridad >= 3) {
            prioridad_nombre = 'Media';
        }
        if (prioridad >= 5) {
            prioridad_nombre = 'Alta';
        }

        $("#prioridad").html(prioridad_nombre);
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
@endsection
