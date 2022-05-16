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

        .select2-results__option {
            position: relative;
            padding-left: 30px !important;

        }

        .select2-selection__rendered {
            padding-left: 30px !important;

        }

        .select2-selection__rendered[title*="Alta"]::before,
        .select2-selection__rendered[title*="Alto"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title*="Media"]::before,
        .select2-selection__rendered[title*="Medio"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title*="Baja"]::before,
        .select2-selection__rendered[title*="Bajo"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-select_urgencia-results li[id*="Alta"]::before,
        #select2-select_impacto-results li[id*="Alto"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        #select2-select_urgencia-results li[id*="Media"]::before,
        #select2-select_impacto-results li[id*="Medio"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        #select2-select_urgencia-results li[id*="Baja"]::before,
        #select2-select_impacto-results li[id*="Bajo"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }



        .select2-selection__rendered[title*="Sin atender"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="Sin atender"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FFCB63;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }



        .select2-selection__rendered[title*="En curso"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #AC84FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="En curso"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #AC84FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title*="En espera"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6863FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="En espera"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6863FF;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title*="Cerrado"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="Cerrado"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #6DC866;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title*="No procedente"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 11px;
        }

        #select2-opciones-results li[id*="No procedente"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: #FF417B;
            margin-left: -15px;
            border-radius: 100px;
            margin-top: 6px;
        }

    </style>
@endsection
{{-- {{ Breadcrumbs::render('quejas-edit', $quejas) }} --}}
@include('partials.flashMessages')
<div class="card">
    <div class="text-center card-header mt-4" style="background-color: #345183;">
        <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-thumbs-down mr-2"></i> Quejas Clientes
        </strong>
    </div>
    <div class="caja_botones_menu mt-4">
        <a href="#" data-tabs="registro" class="btn_activo"><i class="fas fa-thumbs-down mr-2"></i>Registro de
            Queja</a>
        <a href="#" data-tabs="analisis"><i class="mr-2 fas fa-clipboard-list"></i>Análisis Inicial de la queja</a>
        <div id="menu_queja_recibida" style="display: none;">
            <a href="#" data-tabs="resolucion"><i class="mr-2 fas fa-gavel"></i>Atención de la queja</a>
            <a href="#" data-tabs="cierre"><i class="mr-2 fas fa-door-closed"></i>Cierre la queja</a>
        </div>
        {{-- <a href="#" data-tabs="plan"><i class="mr-4 fas fa-tasks"></i>Plan de Acción</a> --}}
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

                            <div class="row col-md-12">
                                <div class="mt-2 form-group col-2">
                                    <label class="form-label"><i
                                            class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                    <div class="mt-2 form-control" readonly>{{ $quejasClientes->folio }}</div>
                                </div>

                                <div class="mt-2 form-group col-md-3 col-sm-12">
                                    <label class="form-label"><i
                                            class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                    <select name="estatus" class="form-control select2" id="opciones"
                                        onchange='cambioOpciones();'>
                                        <option
                                            {{ old('estatus', $quejasClientes->estatus) == 'Sin atender' ? 'selected' : '' }}
                                            value="Sin atender">Sin atender</option>
                                        <option
                                            {{ old('estatus', $quejasClientes->estatus) == 'En curso' ? 'selected' : '' }}
                                            value="En curso">En curso</option>
                                        <option
                                            {{ old('estatus', $quejasClientes->estatus) == 'En espera' ? 'selected' : '' }}
                                            value="En espera">En espera</option>
                                        <option
                                            {{ old('estatus', $quejasClientes->estatus) == 'Cerrado' ? 'selected' : '' }}
                                            value="Cerrado">Cerrado</option>
                                        <option
                                            {{ old('estatus', $quejasClientes->estatus) == 'No procedente' ? 'selected' : '' }}
                                            value="No procedente">No procedente</option>
                                    </select>
                                </div>


                                <div class="mt-2 form-group col-3">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                                        de registro del reporte</label>
                                    <div class="form-control mt-2" readonly>
                                        {{ \Carbon\Carbon::parse($quejasClientes->created_at)->format('d-m-Y H:i:s') }}
                                    </div>
                                </div>

                                <div class="mt-2 form-group col-md-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                                        de cierre del ticket</label>


                                    <input class="form-control mt-2" readonly name="fecha_cierre" type="datetime"
                                        value="{{ old('fecha_cierre', $quejasClientes->fecha_cierre ? \Carbon\Carbon::parse($quejasClientes->fecha_cierre)->format('d-m-Y H:i:s') : null) }}"
                                        id="solucion">

                                </div>
                            </div>
                            {{-- <div class="d-none row col-md-12" id="cerradoCampo">
                                @if ($cierre->count() == 0)
                                    <div class="mt-2 form-group col-md-12">
                                        <label class="form-label"><i
                                                class="fas fa-file-import iconos-crear"></i>Adjuntar
                                            evidencia(s) de cierre</label>
                                        <input type="file" name="cierre[]" class="form-control" multiple="multiple">
                                    </div>
                                @else
                                    <div class="form-group col-md-8">
                                        <label class="form-label"><i
                                                class="fas fa-file-import iconos-crear"></i>Adjuntar
                                            evidencia(s) de cierre</label>
                                        <input type="file" name="cierre[]" class="form-control" multiple="multiple">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span type="button" class="mt-5 mr-5" data-toggle="modal"
                                            data-target="#cierreEvidencia">
                                            <i class="mr-2 fas fa-file-download text-primary"
                                                style="font-size:14pt"></i>Ver evidencia(s) de cierre
                                        </span>
                                    </div>
                                @endif
                            </div> --}}


                            <div class="mt-1 form-group col-12">
                                <b>Datos generales:</b>
                            </div>

                            <div class="row col-12">
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
                                    <select class="form-control mt-2" name="proyectos_id">
                                        <option disabled selected>Seleccionar el proyecto</option>
                                        @foreach ($proyectos as $proyecto)
                                            <option value="{{ $proyecto->id }}"
                                                {{ old('proyectos_id', $quejasClientes->proyectos_id) == $proyecto->id ? 'selected' : '' }}>
                                                {{ $proyecto->proyecto }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-1 form-group col-12">
                                <b>Reportó:</b>
                            </div>

                            <div class="row col-12">
                                <div class="mt-0 form-group col-6">
                                    <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre del
                                        cliente<sup>*</sup></label>
                                    <input type="text" name="nombre"
                                        value="{{ old('nombre', $quejasClientes->nombre) }}" class="form-control"
                                        required>
                                    @if ($errors->has('nombre'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nombre') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-0 form-group col-6">
                                    <label class="form-label"><i
                                            class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
                                    <input type="text" name="puesto"
                                        value="{{ old('puesto', $quejasClientes->puesto) }}" class="form-control">
                                </div>
                            </div>

                            <div class="row col-12">
                                <div class="mt-0 form-group col-6">
                                    <label class="form-label"><i
                                            class="fas fa-envelope iconos-crear"></i>Teléfono</label>
                                    <input type="text" name="telefono"
                                        value="{{ old('telefono', $quejasClientes->telefono) }}"
                                        class="form-control">
                                </div>

                                <div class="mt-0 form-group col-6">
                                    <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                                        electrónico</label>
                                    <input type="text" name="correo" class="form-control"
                                        value="{{ old('correo', $quejasClientes->correo) }}">
                                </div>

                            </div>


                            <div class="mt-1 form-group col-12">
                                <b>Queja del cliente dirigida a:</b>
                            </div>

                            <div class="row col-12">
                                <div class="form-group col-3 multiselect_areas">
                                    <label class="form-label"><i
                                            class="bi bi-geo mr-2 iconos-crear"></i>Área(s)<sup>*</sup></label>
                                    <select class="form-control" required>
                                        <option disabled selected>Seleccionar áreas</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->area }}">
                                                {{ $area->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="area_quejado" class="form-control">{{ $quejasClientes->area_quejado }}</textarea>
                                    @if ($errors->has('area_quejado'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('area_quejado') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-2 form-group col-3 multiselect_empleados">
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

                                <div class="mt-2 form-group col-3 multiselect_procesos">
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

                                <div class="mt-2 form-group col-3">
                                    <label class="form-label"><i
                                            class="fas fa-user-plus iconos-crear"></i>Otro(s)</label>
                                    <textarea style="min-height:187px;" name="otro_quejado" class="form-control">{{ old('otro_quejado', $quejasClientes->otro_quejado) }}
                                </textarea>
                                </div>
                            </div>

                            <div class="mt-1 form-group col-12">
                                <b>Descripción de la queja:</b>
                            </div>

                            <div class="row col-12">
                                <div class="mt-2 form-group col-8">
                                    <label class="form-label"><i class="fas fa-text-width iconos-crear"></i>Título
                                        corto
                                        de
                                        la queja<sup>*</sup></label>
                                    <input class="form-control" name="titulo"
                                        value="{{ $quejasClientes->titulo }}" required>
                                    @if ($errors->has('titulo'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('titulo') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-2 form-group col-4">
                                    <label class="form-label"><i
                                            class="fas fa-calendar-alt iconos-crear"></i>Fecha
                                        y
                                        hora
                                        de ocurrencia</label>
                                    <input type="datetime-local" name="fecha" class="form-control"
                                        value="{{ old('fecha', \Carbon\Carbon::parse($quejasClientes->fecha)->format('Y-m-d\TH:i')) }}"
                                        required>
                                    @if ($errors->has('fecha'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('fecha') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row col-12">
                                <div class="mt-2 form-group col-6">
                                    <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación
                                        física donde se originó la queja
                                    </label>
                                    <input type="" name="ubicacion" class="form-control"
                                        value="{{ $quejasClientes->ubicacion }}">
                                </div>
                                <div class="mt-2 form-group col-6">
                                    <label class="form-label"><i class="fas fa-satellite iconos-crear"></i> Canal
                                        de
                                        recepción de la queja<sup>*</sup>
                                    </label>
                                    <select name="canal"
                                        class="form-control {{ $errors->has('canal') ? 'is-invalid' : '' }}"
                                        id="otros_campo" required>
                                        <option value="{{ old('canal', $quejasClientes->canal) }}" selected>
                                            Selecciona una opción</option>
                                        <option
                                            {{ old('canal', $quejasClientes->canal) == 'Correo electronico' ? 'selected' : '' }}
                                            value="Correo electronico">Correo electrónico</option>
                                        <option
                                            {{ old('canal', $quejasClientes->canal) == 'Via telefonica' ? 'selected' : '' }}
                                            value="Via telefonica">Vía telefónica</option>
                                        <option
                                            {{ old('canal', $quejasClientes->canal) == 'Forma presencial' ? 'selected' : '' }}
                                            value="Presencial">Presencial</option>
                                        <option
                                            {{ old('canal', $quejasClientes->canal) == 'Forma remota' ? 'selected' : '' }}
                                            value="Remota">Remota</option>
                                        <option
                                            {{ old('canal', $quejasClientes->canal) == 'Oficio' ? 'selected' : '' }}
                                            value="Oficio">Oficio</option>
                                        <option
                                            {{ old('canal', $quejasClientes->canal) == 'Otro' ? 'selected' : '' }}
                                            value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 d-none" id="campos_otro">
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <input class="form-control {{ $errors->has('otro_canal') ? 'is-invalid' : '' }}"
                                        type="text" name="otro_canal"
                                        value="{{ old('otros', $quejasClientes->otro_canal) }}">
                                </div>
                            </div>


                            <div class="row col-12">
                                <div class="mt-2 form-group col-12">
                                    <label class="form-label required"><i
                                            class="fas fa-file-alt iconos-crear"></i>Descripción detallada de la
                                        queja</label>
                                    <textarea name="descripcion" class="form-control" required>{{ $quejasClientes->descripcion }}</textarea>

                                </div>
                            </div>

                            <div class="row col-12">
                                @if ($evidenciaCreate->count() == 0)
                                    <div class="mt-2 form-group col-12">
                                        <label class="form-label"><i
                                                class="fas fa-file-import iconos-crear"></i>Adjuntar evidencia(s) de la
                                            queja</label>
                                        <input type="file" name="evidencia[]" class="form-control"
                                            multiple="multiple">
                                    </div>
                                @else
                                    <div class="form-group col-md-8">
                                        <label class="form-label"><i
                                                class="fas fa-file-import iconos-crear"></i>Adjuntar evidencia(s) de la
                                            queja</label>
                                        <input type="file" name="evidencia[]" class="form-control"
                                            multiple="multiple">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span type="button" class="mt-5 mr-5" data-toggle="modal"
                                            data-target="#largeModal">
                                            <i class="mr-2 fas fa-file-download text-primary"
                                                style="font-size:14pt"></i>Ver evidencia(s) de la queja
                                        </span>
                                    </div>
                                @endif

                            </div>

                            <div class="row col-12">
                                <div class="mt-2 form-group col-12">
                                    <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Solución
                                        que requiere el cliente
                                        <sup>*</sup></label>
                                    <textarea name="solucion_requerida_cliente" class="form-control"
                                        required>{{ $quejasClientes->solucion_requerida_cliente }}</textarea>
                                    @if ($errors->has('solucion_requerida_cliente'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('solucion_requerida_cliente') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 text-center form-group col-12">
                                <div class="container">
                                    {{-- <div class="mb-4 row">
                                        <div class="col text-start">
                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                data-target="#largeModal">Evidencia</a>
                                        </div>
                                    </div> --}}
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

                            <div style="margin-top:-28px;" class="form-group col-12">
                                <b>Registró:</b>
                            </div>

                            <div class="row col-12">
                                <div class="mt-2 form-group col-6">
                                    <label class="form-label"><i
                                            class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                                    <div class="form-control" readonly>
                                        {{ Str::limit($quejasClientes->registro->name, 30, '...') }}</div>
                                </div>

                                <div class="mt-2 form-group col-6">
                                    <label class="form-label"><i
                                            class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                    <div class="form-control" readonly>{{ $quejasClientes->registro->puesto }}
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12">
                                <div class="form-group col-6">
                                    <label class="form-label"><i
                                            class="bi bi-geo mr-2 iconos-crear"></i>Área</label>
                                    <div class="form-control" readonly>{{ $quejasClientes->registro->area->area }}
                                    </div>
                                </div>

                                <div class="mt-2 form-group col-6">
                                    <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                                        electrónico</label>
                                    <div class="form-control" readonly>{{ $quejasClientes->registro->email }}
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12">
                                <div class="form-group col-12">
                                    <label class="form-label"><i
                                            class="fas fa-comment-dots iconos-crear"></i>Comentarios
                                        del receptor</label>
                                    <textarea name="comentarios" class="form-control">{{ $quejasClientes->comentarios }}</textarea>
                                </div>
                            </div>

                            <div class="row col-12">
                                <div class="float-left mt-4 text-right form-group col-12">
                                    <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
                                    <input type="submit" class="btn btn-success" value="Guardar">
                                </div>
                            </div>
                            {{-- </form> --}}
                    </div>

                    {{-- <div style="width:50%; border: 1px solid rgb(39, 165, 255); border-radius: 1px">
                        <div style="width:30%;border-top: 2px rgb(23, 167, 140); ">
                            <strong style="color:rgb(0, 38, 100); justify: center">Hola</strog>

                        </div>
                    </div> --}}


                </section>

                <section id="analisis">

                    <div class="row">
                        <div class="mt-4 form-group col-md-12">
                            <b>¿La queja recibida es procedente?</b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-body" style="margin-top:-30px;">
                                <div class="pregunta_queja_procedente">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="queja_procedente"
                                            id="queja_procedente" value="1"
                                            {{ old('queja_procedente', $quejasClientes->queja_procedente) == true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="queja_procedente">
                                            Sí
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="queja_procedente"
                                            id="queja_procedente" value="2"
                                            {{ old('queja_procedente', $quejasClientes->queja_procedente) == false ? 'checked' : '' }}>
                                        <label class="form-check-label" for="queja_procedente">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>

                    <div class="display:none" id="porque_queja_procedente">
                        <div class="row">
                            <div class="form-group col-12">
                                <label class="form-label">¿Por qué?</label>
                                <textarea name="porque_procedente" class="form-control">{{ $quejasClientes->porque_procedente }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div id="contenedor_queja_procedente" style="margin-top:-25px; display: none;">
                        <div class="row">
                            <div class=" form-group col-md-12">
                                <b>Priorización de la queja:</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2 form-group col-md-4 select_elegir_prioridad">
                                <label class="form-label"><i
                                        class="fas fa-chart-line iconos-crear"></i>Urgencia</label>
                                <select class="form-control select2" name="urgencia" id="select_urgencia">
                                    <option value="{{ old('urgencia', $quejasClientes->urgencia) }}" selected>
                                        Selecciona una opción</option>
                                    <option data-urgencia="3"
                                        {{ old('urgencia', $quejasClientes->urgencia) == 'Alta' ? 'selected' : '' }}>
                                        Alta</option>
                                    <option data-urgencia="2"
                                        {{ old('urgencia', $quejasClientes->urgencia) == 'Media' ? 'selected' : '' }}>
                                        Media</option>
                                    <option data-urgencia="1"
                                        {{ old('urgencia', $quejasClientes->urgencia) == 'Baja' ? 'selected' : '' }}>
                                        Baja</option>
                                </select>
                            </div>

                            <div class="mt-2 form-group col-md-4 select_elegir_prioridad">
                                <label class="form-label"><i
                                        class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                                <select class="form-control select2" name="impacto" id="select_impacto">
                                    <option value="{{ old('impacto', $quejasClientes->impacto) }}" selected>
                                        Selecciona una opción</option>
                                    <option data-impacto="3"
                                        {{ old('impacto', $quejasClientes->impacto) == 'Alto' ? 'selected' : '' }}>
                                        Alto</option>
                                    <option data-impacto="2"
                                        {{ old('impacto', $quejasClientes->impacto) == 'Medio' ? 'selected' : '' }}>
                                        Medio</option>
                                    <option data-impacto="1"
                                        {{ old('impacto', $quejasClientes->impacto) == 'Bajo' ? 'selected' : '' }}>
                                        Bajo</option>
                                </select>
                            </div>

                            <div class="mt-3 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-flag iconos-crear"></i>Prioridad de
                                    atención</label>
                                <input class="form-control" id="prioridad" name="prioridad" readonly></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-4 form-group col-md-12">
                                <b>Categorización de la queja:</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-1 form-group col-6">
                                <label class="form-label"><i class="fas fa-bars iconos-crear"></i> Categoría de la
                                    queja
                                </label>
                                <select name="categoria_queja"
                                    class="form-control {{ $errors->has('categoria_queja') ? 'is-invalid' : '' }}"
                                    id="categoria_otros">
                                    <option value="{{ old('categoria_queja', $quejasClientes->categoria_queja) }}"
                                        selected>
                                        Selecciona una opción</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Servicio no prestado' ? 'selected' : '' }}
                                        value="Servicio no prestado">Servicio no prestado/prestado parcialmente</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Retraso en la prestacion' ? 'selected' : '' }}
                                        value="retraso en la prestacion">Retraso en la prestación del servicio</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Entregable no conforme' ? 'selected' : '' }}
                                        value="Entregable no conforme">Entregable no conforme con lo solicitado</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incumplimiento de los compromisos contractuales' ? 'selected' : '' }}
                                        value="Incumplimiento de los compromisos contractuales">Incumplimiento de los
                                        compromisos contractuales</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incumplimiento de los compromisos contractuales' ? 'selected' : '' }}
                                        value="Incumplimiento de los compromisos contractuales">Incumplimiento de los
                                        niveles de servicio</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incumplimiento de los compromisos contractuales' ? 'selected' : '' }}
                                        value="Incumplimiento de los compromisos contractuales">Canales de comunicación
                                        inadecuados</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Negativa de prestación del servicio' ? 'selected' : '' }}
                                        value="Negativa de prestación del servicio">Negativa de prestación del servicio
                                    </option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Incorrecta facturacion' ? 'selected' : '' }}
                                        value="Incorrecta facturacion">Incorrecta facturación</option>
                                    <option
                                        {{ old('categoria_queja', $quejasClientes->categoria_queja) == 'Otro' ? 'selected' : '' }}
                                        value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="mt-1 form-group col-sm-6 col-md-6 d-none" id="camposQuejaOtro">
                                <label>¿Cuál?</label>
                                <input class="form-control {{ $errors->has('otro_categoria') ? 'is-invalid' : '' }}"
                                    type="text" name="otro_categoria"
                                    value="{{ old('otro_categoria', $quejasClientes->otro_categoria) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-4 form-group col-md-12">
                                <b>Responsable de la atención de la queja</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label for="responsable_atencion_queja_id"><i
                                        class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                                <select
                                    class="form-control {{ $errors->has('responsable_atencion_queja_id') ? 'is-invalid' : '' }}"
                                    name="responsable_atencion_queja_id" id="responsable_atencion_queja_id">
                                    <option
                                        value="{{ old('responsable_atencion_queja_id', $quejasClientes->responsable_atencion_queja_id) }}"
                                        selected>Selecciona una opción</option>
                                    @foreach ($empleados as $id => $empleado)
                                        <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                            data-area="{{ $empleado->area->area }}"
                                            {{ old('responsable_atencion_queja_id', $quejasClientes->responsable_atencion_queja_id) == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('responsable_atencion_queja_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('responsable_atencion_queja_id') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                <div class="form-control" id="atencion_puesto"></div>
                            </div>


                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label><i class="fas fa-street-view iconos-crear"></i>Área</label>
                                <div class="form-control" id="atencion_area"></div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="mt-4 form-group col-md-12">
                                <b>¿Se requiere levantar una acción correctiva?</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body" style="margin-top:-30px;">
                                    <div class="levantamiento_ac">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="desea_levantar_ac"
                                                value="1"
                                                {{ old('desea_levantar_ac', $quejasClientes->desea_levantar_ac) == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="desea_levantar_ac">
                                                Sí
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="desea_levantar_ac"
                                                value="2"
                                                {{ old('desea_levantar_ac', $quejasClientes->desea_levantar_ac) == false ? 'checked' : '' }}>
                                            <label class="form-check-label" for="desea_levantar_ac">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        {{-- <div clas="mt-2 form-group col-md-12">
                            <b class="mr-4 text-primary">Al Nota: Se enviará la solicitud de generación de
                                Acción Correctiva al Responsable del Sistema de
                                Gestión
                            </b>
                        </div> --}}
                        <div class="row">
                            <div class="col-12" id="indicaciones_levantamiento" style="display: none;">
                                <div class="row">
                                    <div class="col-12">
                                        <b class="mr-4 text-primary">Seleccione al responsable del Sistema de Gestión
                                        </b>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mt-2 form-group col-sm-12 col-md-4 col-lg-4">
                                        <label for="responsable_sgi_id"><i
                                                class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                                        <select
                                            class="form-control {{ $errors->has('responsable_sgi_id') ? 'is-invalid' : '' }}"
                                            name="responsable_sgi_id" id="responsable_sgi_id">
                                            <option
                                                value="{{ old('responsable_sgi_id', $quejasClientes->responsable_sgi_id) }}"
                                                selected>Selecciona una opción</option>
                                            @foreach ($empleados as $id => $empleado)
                                                <option data-puesto="{{ $empleado->puesto }}"
                                                    value="{{ $empleado->id }}"
                                                    data-area="{{ $empleado->area->area }}"
                                                    {{ old('responsable_sgi_id', $quejasClientes->responsable_sgi_id) == $empleado->id ? 'selected' : '' }}>
                                                    {{ $empleado->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('responsable_sgi_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('responsable_sgi_id') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-2 form-group col-md-4">
                                        <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                        <div class="form-control" id="responsable_sgi_puesto"></div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                        <label><i class="bi bi-geo mr-2 iconos-crear"></i>Área</label>
                                        <div class="form-control" id="responsable_sgi_area"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="float-left mt-4 text-right form-group col-12">
                            <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div>
                    </div>
                </section>


                <section id="resolucion">
                    <div class="seccion_div">
                        <div class="row">
                            <div class="px-1 py-2 mx-3 mb-4 rounded shadow col-12"
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
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                                            priorice,
                                            categorice, analice y determine si la queja es procedente.
                                        </p>
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 form-group col-md-12">
                                <b>1. ¿Se realizó alguna acción inmediata?</b>
                            </div>

                            <div class="row col-12">
                                <div class="card-body" style="margin-top:-30px;">
                                    <div class="accion_inmediata">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="realizar_accion"
                                                id="realizarAccion" value="1"
                                                {{ old('realizar_accion', $quejasClientes->realizar_accion) == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="realizar_accion">
                                                Sí
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="realizar_accion"
                                                value="2"
                                                {{ old('realizar_accion', $quejasClientes->realizar_accion) == false ? 'checked' : '' }}>
                                            <label class="form-check-label" for="realizar_accion">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div><br>

                            <div class="form-group col-md-12 col-sm-12 col-lg-12">
                                <div id="contenidoAccion" style="display: none;">
                                    <label class="form-label">¿Cuál?</label>
                                    <textarea name="cual_accion" class="form-control">{{ $quejasClientes->cual_accion }}</textarea>
                                </div>
                            </div>

                            <div class="mt-4 form-group col-md-12">
                                <b>2. Acciones que tomará el responsable para la resolución de la queja</b>
                            </div>


                            <div class="form-group col-12">
                                <textarea name="acciones_tomara_responsable"
                                    class="form-control">{{ $quejasClientes->acciones_tomara_responsable }}</textarea>
                            </div>

                            <div class="mt-4 form-group col-md-12">
                                <b>3. Fecha compromiso para la resolución de esta queja</b>
                            </div>

                            <div class="mt-2 form-group col-md-4">

                                <input type="date" name="fecha_limite" class="form-control"
                                    value="{{ old('fecha_limite', \Carbon\Carbon::parse($quejasClientes->fecha_limite)->format('Y-m-d\TH:i')) }}">
                            </div>

                            <div class="mt-2 form-group col-md-12">
                                <label class="form-label"><i
                                        class="fas fa-comment-dots iconos-crear"></i>Comentarios</label>
                                <textarea type="text" name="comentarios_atencion"
                                    class="form-control">{{ $quejasClientes->comentarios_atencion }}</textarea>
                            </div>

                            <div class="mt-4 text-right form-group col-12">
                                <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
                                <input type="submit" class="btn btn-success" value="Guardar">
                            </div>



                            {{-- <div class="mb-3 col-sm-12 col-lg-12 col-md-12 text-primary ">
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
                            </div> --}}

                            {{-- <form method="POST" class="col-12"
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
                                    </div> --}}



                            {{-- <div id="porque" class="caja_oculta_dinamica row">
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
                                    </div> --}}



                            {{-- <div id="digrama" class="caja_oculta_dinamica">
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
                                                </div> --}}
                            {{-- <div class="col-6"
                                                    style="top:55px; left:290px; position: absolute; height:30px !important;">
                                                    <textarea name="control_a" class="politicas_txtarea" id="analisisControl">{{ $analisis->control_a }}</textarea>
                                                </div> --}}
                            {{-- <textarea name="control_b" class="politicas_txtarea txt_obj_secundarios_a">{{ $analisis->control_b }}</textarea> --}}
                            {{-- <div class="col-6"
                                                    style="top:55px; left:810px; position: absolute; height:30px !important;">
                                                    <textarea name="proceso_a" class="procesos_txtarea" id="analisisProceso">{{ $analisis->proceso_a }}</textarea>
                                                </div> --}}
                            {{-- <textarea name="proceso_b" class="procesos_txtarea txt_obj_secundarios_a">{{ $analisis->proceso_b }}</textarea> --}}
                            {{-- <div class="col-6"
                                                    style="top:55px; left:1315px; position: absolute; height:30px !important;">
                                                    <textarea name="personas_a" class="personas_txtarea" id="analisisPersona">{{ $analisis->personas_a }}</textarea>
                                                </div> --}}
                            {{-- <textarea name="personas_b" class="personas_txtarea txt_obj_secundarios_a">{{ $analisis->personas_b }}</textarea> --}}
                            {{-- <div class="col-6"
                                                    style="bottom:5px; right:480px; position: absolute;">
                                                    <textarea name="tecnologia_a" id="analisisTecnologia"
                                                        class="tecnologia_txtarea txt_obj_secundarios_b">{{ $analisis->tecnologia_a }}</textarea>
                                                </div> --}}
                            {{-- <textarea name="tecnologia_b" class="tecnologia_txtarea ">{{ $analisis->tecnologia_b }}</textarea> --}}
                            {{-- <div class="col-6"
                                                    style="bottom:5px; left:540px; position: absolute;">
                                                    <textarea name="metodos_a" class="metodos_txtarea txt_obj_secundarios_b"
                                                        id="analisisMetodos">{{ $analisis->metodos_a }}</textarea>
                                                </div> --}}
                            {{-- <textarea name="metodos_b" class="metodos_txtarea ">{{ $analisis->metodos_b }}</textarea> --}}
                            {{-- <div class="col-6"
                                                    style="bottom:5px; left:1060px; position: absolute;">
                                                    <textarea name="ambiente_a" class="ambiente_txtarea txt_obj_secundarios_b"
                                                        id="analisisAmbiente">{{ $analisis->ambiente_a }}</textarea>
                                                </div> --}}
                            {{-- <textarea name="ambiente_b" class="ambiente_txtarea ">{{ $analisis->ambiente_b }}</textarea> --}}
                            {{-- <div class="col-6"
                                                    style="bottom:5px; left:1600px; position: absolute;">
                                                    <textarea name="problema_diagrama" class="problemas_txtarea"
                                                        id="analisisProblema">{{ $analisis->problema_diagrama }}</textarea>
                                                </div> --}}
                            {{-- </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3 text-right col-12">
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </section>

                <section id="cierre">

                    <div class="mt-4 form-group col-md-12">
                        <b>¿Se cumplieron las acciones comprometidas por el responsable
                            de la atención de la queja?
                        </b>
                    </div>

                    <div class="row col-12">
                        <div class="card-body" style="margin-top:-30px;">
                            <div class="aCumplidoResponsable">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cumplio_ac_responsable"
                                        id="cumplioResponsable" value="1"
                                        {{ old('cumplio_ac_responsable', $quejasClientes->cumplio_ac_responsable) == true ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cumplio_ac_responsable">
                                        Sí
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cumplio_ac_responsable"
                                        value="2"
                                        {{ old('cumplio_ac_responsable', $quejasClientes->cumplio_ac_responsable) == false ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cumplio_ac_responsable">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div><br>


                    <div class="form-group col-md-12 col-sm-12 col-lg-12" style="margin-top:-30px">
                        <div id="porqueNoCumplio" style="display: none;">
                            <label class="form-label">¿Por qué?</label>
                            <textarea name="porque_no_cumplio_responsable"
                                class="form-control">{{ $quejasClientes->porque_no_cumplio_responsable }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 form-group col-md-12">
                        <b>¿Se cumplieron las acciones comprometidas en el tiempo establecido?
                        </b>
                    </div>

                    <div class="row col-12">
                        <div class="card-body" style="margin-top:-30px;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cumplio_fecha"
                                    id="cumplioResponsable" value="1"
                                    {{ old('cumplio_fecha', $quejasClientes->cumplio_fecha) == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="cumplio_fecha">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cumplio_fecha" value="2"
                                    {{ old('cumplio_fecha', $quejasClientes->cumplio_fecha) == false ? 'checked' : '' }}>
                                <label class="form-check-label" for="cumplio_fecha">
                                    No
                                </label>
                            </div>
                        </div>
                    </div><br>

                    <div class=" form-group col-md-12">
                        <b>¿El cliente ha quedado conforme con la solución otorgada?
                        </b>
                    </div>

                    <div class="row col-12">
                        <div class="card-body" style="margin-top:-30px;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="conforme_solucion"
                                    id="conforme_solucion" value="1"
                                    {{ old('conforme_solucion', $quejasClientes->conforme_solucion) == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="conforme_solucion">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="conforme_solucion" value="2"
                                    {{ old('conforme_solucion', $quejasClientes->conforme_solucion) == false ? 'checked' : '' }}>
                                <label class="form-check-label" for="conforme_solucion">
                                    No
                                </label>
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group col-md-12">
                        <b>¿Cerrar el ticket?
                        </b>
                    </div>

                    <div class="row col-12">
                        <div class="card-body" style="margin-top:-30px;">
                            <div class="preguntaCierreTicket">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cerrar_ticket" id="cerrarTicket"
                                        value="1"
                                        {{ old('cerrar_ticket', $quejasClientes->cerrar_ticket) == true ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cerrar_ticket">
                                        Sí
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cerrar_ticket" value="2"
                                        {{ old('cerrar_ticket', $quejasClientes->cerrar_ticket) == false ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cerrar_ticket">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div><br>


                    <div style="display: none;" id="ticketcerrado">
                        @if ($cierre->count() == 0)
                            <div class="mt-2 form-group col-md-12">
                                <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Adjuntar
                                    evidencia(s) de cierre</label>
                                <input type="file" name="cierre[]" class="form-control" multiple="multiple">
                            </div>
                        @else
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label class="form-label"><i
                                            class="fas fa-file-import iconos-crear"></i>Adjuntar
                                        evidencia(s) de cierre</label>
                                    <input type="file" name="cierre[]" class="form-control" multiple="multiple">
                                </div>
                                <div class="form-group col-md-4">
                                    <span type="button" class="mt-5 mr-5" data-toggle="modal"
                                        data-target="#evidenciaDeCierreAgregada">
                                        <i class="mr-2 fas fa-file-download text-primary"
                                            style="font-size:14pt"></i>Ver
                                        evidencia(s) de cierre
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                     <!-- modal Evidencia Cierre -->
                     <div class="modal fade" id="evidenciaDeCierreAgregada" tabindex="-1" role="dialog"
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

                    <div class="mt-4 text-right form-group col-12">
                        <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
                        <input type="submit" class="btn btn-success" value="Guardar">
                    </div>

                    </form>
                </section>


                <section id="plan">
                    <div class="seccion_div">
                        <div class="row">
                            <div class="mb-3 col-sm-4 col-lg-4 col-md-4 text-primary ">
                                <strong style="font-size:13pt;">Folio: {{ $quejasClientes->folio }}</strong>
                            </div>
                            <div class="mb-3 col-sm-6 col-lg-6 col-md-6 text-primary ">
                                <strong
                                    style="font-size:13pt; text-transform: lowercase;">{{ $quejasClientes->titulo }}</strong>
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

                    <div class="row col-12">
                        <div class="mt-4 text-right form-group col-12">
                            <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
{{-- <script type="text/javascript">
    $(document).ready(function() {
        let estatus = @json($quejasClientes->estatus);
        if (estatus == 'Cerrado') {

            $('#cerradoCampo').removeClass('d-none')

        } else {

            $('#cerradoCampo').addClass('d-none')

        }
    })

    $(document).on('change', '#opciones', function(event) {
        if ($('#opciones option:selected').val() == 'Cerrado') {
            $('#cerradoCampo').removeClass('d-none');
        } else {
            $('#cerradoCampo').addClass('d-none');
        }
    });
</script> --}}

<script type="text/javascript">
    $(document).ready(function() {
        let estatus = @json($quejasClientes->estatus);
        if (estatus == 'Cerrado') {

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
        if (opcion == "Cerrado") {
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

<script type="text/javascript">
    $(document).ready(function() {
        let canal = @json($quejasClientes->canal);
        if (canal == 'Otro') {

            $('#campos_otro').removeClass('d-none')

        } else {

            $('#campos_otro').addClass('d-none')

        }
    })


    $(document).on('change', '#otros_campo', function(event) {
        if ($('#otros_campo option:selected').attr('value') == 'Otro') {
            $('#campos_otro').removeClass('d-none');
        } else {
            $('#campos_otro').addClass('d-none');
        }
    });
</script>


<script>
    $(document).ready(function() {
        let categoria_queja = @json($quejasClientes->categoria_queja);
        if (categoria_queja == 'Otro') {

            $('#camposQuejaOtro').removeClass('d-none')

        } else {

            $('#camposQuejaOtro').addClass('d-none')

        }
    })

    $(document).on('change', '#categoria_otros', function(event) {
        if ($('#categoria_otros option:selected').attr('value') == 'Otro') {
            $('#camposQuejaOtro').removeClass('d-none');
        } else {
            $('#camposQuejaOtro').addClass('d-none');
        }
    });
</script>

<script>
    $(document).ready(function() {
        let realizarAcciones = @json($quejasClientes->realizar_accion);
        if (realizarAcciones == true) {

            $("#contenidoAccion").fadeIn(100);

        } else {

            $("#contenidoAccion").fadeOut(100);

        }
    })

    $('.accion_inmediata input[value="1"]').click(function() {
        $("#contenidoAccion").fadeIn(100);
    });

    $('.accion_inmediata input[value="2"]').click(function() {
        $("#contenidoAccion").fadeOut(100);
    });
</script>

<script>
    $(document).ready(function() {
        let deseaLevantarAc = @json($quejasClientes->desea_levantar_ac);
        if (deseaLevantarAc == true) {

            $("#indicaciones_levantamiento").fadeIn(100);

        } else {

            $("#indicaciones_levantamiento").fadeOut(100);

        }
    })

    $('.levantamiento_ac input[value="1"]').click(function() {
        $("#indicaciones_levantamiento").fadeIn(100);
    });

    $('.levantamiento_ac input[value="2"]').click(function() {
        $("#indicaciones_levantamiento").fadeOut(100);
    });
</script>

<script>
    $(document).ready(function() {
        let cumplioAc = @json($quejasClientes->cumplio_ac_responsable);
        if (cumplioAc == true) {

            $("#porqueNoCumplio").fadeIn(100);

        } else {

            $("#porqueNoCumplio").fadeOut(100);

        }
    })

    $('.aCumplidoResponsable input[value="1"]').click(function() {
        $("#porqueNoCumplio").fadeIn(100);
    });

    $('.aCumplidoResponsable input[value="2"]').click(function() {
        $("#porqueNoCumplio").fadeOut(100);
    });
</script>

<script>
    $(document).ready(function() {
        let ticketSiCerrado = @json($quejasClientes->cerrar_ticket);
        if (ticketSiCerrado == true) {

            $("#ticketcerrado").fadeIn(100);

        } else {

            $("#ticketcerrado").fadeOut(100);

        }
    })

    $('.preguntaCierreTicket input[value="1"]').click(function() {
        $("#ticketcerrado").fadeIn(100);
    });

    $('.preguntaCierreTicket input[value="2"]').click(function() {
        $("#ticketcerrado").fadeOut(100);
    });
</script>


<script>
    $(document).ready(function() {
        let visualizarQuejaProcedente = @json($quejasClientes->queja_procedente);
        if (visualizarQuejaProcedente == true) {

            $("#contenedor_queja_procedente").fadeIn(100);
            $("#menu_queja_recibida").fadeIn(100);
            $("#porque_queja_procedente").fadeOut(100);

        } else {

            $("#contenedor_queja_procedente").fadeOut(100);
            $("#menu_queja_recibida").fadeOut(100);
            $("#porque_queja_procedente").fadeIn(100);
        }
    })

    $('.pregunta_queja_procedente input[value="1"]').click(function() {
        $("#contenedor_queja_procedente").fadeIn(100);
        $("#menu_queja_recibida").fadeIn(100);
        $("#porque_queja_procedente").fadeOut(100);
    });

    $('.pregunta_queja_procedente input[value="2"]').click(function() {
        $("#contenedor_queja_procedente").fadeOut(100);
        $("#menu_queja_recibida").fadeOut(100);
        $("#porque_queja_procedente").fadeIn(100);
    });
</script>

<script type="text/javascript">
    var prioridad = 0;
    var impacto = 0;
    var urgencia = 0;
    var prioridad_nombre = '';
    let color = "red";
    let colorText = "black";
    urgencia = Number($('#select_urgencia option:selected').attr('data-urgencia'));
    impacto = Number($('#select_impacto option:selected').attr('data-impacto'));
    prioridad = urgencia + impacto;
    establecerPrioridad(prioridad);

    function establecerPrioridad(prioridad) {
        if (prioridad != null) {
            prioridad_nombre = '';
            color = "white";
            colorText = "black";
        }
        if (prioridad <= 2) {
            prioridad_nombre = 'Baja';
            color = "#6DC866";
            colorText = "white";
        }
        if (prioridad >= 3) {
            prioridad_nombre = 'Media';
            color = "#FFCB63";
            colorText = "white";
        }
        if (prioridad >= 5) {
            prioridad_nombre = 'Alta';
            color = "#FF417B";
            colorText = "white";
        }

        document.getElementById("prioridad").value = prioridad_nombre;
        document.getElementById("prioridad").style.background = color;
        document.getElementById("prioridad").style.color = colorText;

    }


    $(document).on('change', '#select_urgencia', function(event) {
        urgencia = Number($('#select_urgencia option:selected').attr('data-urgencia'));

        prioridad = urgencia + impacto;

        establecerPrioridad(prioridad)
    });
    $(document).on('change', '#select_impacto', function(event) {
        impacto = Number($('#select_impacto option:selected').attr('data-impacto'));

        prioridad = urgencia + impacto;

        establecerPrioridad(prioridad)

    });
</script>

<script>
    let atencion = document.querySelector('#responsable_atencion_queja_id');
    let area_init = atencion.options[atencion.selectedIndex].getAttribute('data-area');
    let puesto_init = atencion.options[atencion.selectedIndex].getAttribute('data-puesto');
    document.getElementById('atencion_puesto').innerHTML = puesto_init
    document.getElementById('atencion_area').innerHTML = area_init

    let autorizo = document.querySelector('#responsable_sgi_id');
    let area = autorizo.options[autorizo.selectedIndex].getAttribute('data-area');
    let puesto = autorizo.options[autorizo.selectedIndex].getAttribute('data-puesto');
    document.getElementById('responsable_sgi_puesto').innerHTML = puesto
    document.getElementById('responsable_sgi_area').innerHTML = area

    atencion.addEventListener('change', function(e) {
        e.preventDefault();
        let area = this.options[this.selectedIndex].getAttribute('data-area');
        let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
        document.getElementById('atencion_puesto').innerHTML = puesto
        document.getElementById('atencion_area').innerHTML = area
    })

    autorizo.addEventListener('change', function(e) {
        e.preventDefault();
        let area = this.options[this.selectedIndex].getAttribute('data-area');
        let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
        document.getElementById('responsable_sgi_puesto').innerHTML = puesto
        document.getElementById('responsable_sgi_area').innerHTML = area
    })
</script>
@endsection
