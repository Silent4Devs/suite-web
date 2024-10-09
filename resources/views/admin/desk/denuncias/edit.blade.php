@extends('layouts.admin')
@section('content')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/centerAttention/forms.css') }}{{ config('app.cssVersion') }}">
    <style type="text/css">
        .caja-firmas-doc .flex {
            justify-content: center;
            gap: 50px;
            margin-top: 20px;
        }

        .caja-firmas-doc .flex-item {
            width: 300px;
            padding: 20px !important;
        }

        .firma-content {
            width: 300px;
            height: 200px;
            border: 1px solid #ccc;
        }

        .caja-space-firma {
            position: relative;
            width: 500px;
            height: 350px;
        }

        .caja-space-firma input {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .caja-space-firma canvas {
            /* width: 100%;
                            height: 100%; */
            border: 1px solid #5a5a5a;
            ;
        }

        .img-firma {
            width: 80%;
            margin-left: 10%;
        }

        .caja-firmas-doc p {
            width: 100%;
            text-align: center;
        }


        .flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flex-item {
            width: 100%;
            max-height: 100%;
            padding: 30px;
            box-sizing: border-box;
            align-self: stretch;
        }

        sup {
            color: red;
        }

        ol.breadcrumb {
            margin-bottom: 0px;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ADD8E6 !important;
        }
    </style>
@endsection
{{ Breadcrumbs::render('denuncias-create') }}
@include('partials.flashMessages')
<div class="card">
    <div class="text-center card-header" style="background-color: var(--color-tbj)">
        <strong style="font-size: 16pt; color: #fff;"><i class="mr-4 fas fa-hand-paper"></i>Denuncias</strong>
    </div>
    <div class="caja_botones_menu">
        <a href="#" data-tabs="registro" class="btn_activo"><i class="mr-4 fas fa-hand-paper"></i>Registro de
            Denuncia</a>
        <a href="#" data-tabs="analisis"><i class="mr-4 fas fa-clipboard-list"></i>Análisis Causa Raíz</a>
        <a href="#" data-tabs="plan"><i class="mr-4 fas fa-tasks"></i>Plan de Trabajo</a>
    </div>
    <div class="card-body">

        <div class="caja_caja_secciones">

            <div class="caja_secciones">

                <section id="registro" class="caja_tab_reveldada">
                    <div class="seccion_div">
                        <form class="row" method="POST"
                            action="{{ route('admin.desk.denuncias-update', $denuncias) }}">
                            @csrf

                            <div class="px-1 py-2 mx-3 mb-4 rounded shadow"
                                style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                                <div class="row w-100">
                                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                        <div class="w-100">
                                            {{-- <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i> --}}
                                        </div>
                                    </div>
                                    <div class="col-12" style="width: 300rem;">
                                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                            Instrucciones</p>
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Al final de
                                            cada formulario dé clic en el botón guardar antes de cambiar de pestaña,
                                            de lo contrario la información capturada no será guardada.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                Tipo de denuncia:
                                @if ($denuncias->anonimo == 'no')
                                    <label class="form-label"><strong>Datos proporcionados</strong></label>
                                @else
                                    <label class="form-label"><strong>Denuncia anónima</strong></label>
                                @endif
                            </div>
                            <div class="mt-1 form-group col-12">
                                <b>Datos generales:</b>
                            </div>

                            @if (is_null($firma_validacion))
                                <div style="position: relative; left: 2rem;">
                                    <label>
                                        <input type="checkbox" id="toggle-info"
                                            {{ !empty($aprobadoresArray) ? 'checked' : '' }}>
                                        Activar flujo de firma(s)
                                    </label>
                                    <br>
                                </div>


                                <div class="mt-2 form-group col-md-12">
                                    <div class="info-bar" id="info-bar"
                                        style="display: {{ !empty($aprobadoresArray) ? 'block' : 'none' }};">
                                        <p>Seleccione cuántos participantes de aprobación tendrá tu lista.</p>
                                        <select id="participantes" name="participantes[]" class="form-control"
                                            multiple="multiple"
                                            style="padding: 10px; border-radius: 50px; border: 1px solid #007BFF;">
                                            @if ($firmaModules && $firmaModules->empleados)
                                                @if (count($firmaModules->empleados) > 0)
                                                    @foreach ($firmaModules->empleados as $empleado)
                                                        <option value="{{ $empleado->id }}"
                                                            @if (is_array($aprobadoresArray) && in_array($empleado->id, $aprobadoresArray)) selected @endif>
                                                            {{ $empleado->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>No hay participantes disponibles.
                                                    </option>
                                                @endif
                                            @else
                                                <option value="" disabled>No hay participantes disponibles.
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif



                            <div class="mt-2 form-group col-6">
                                <label class="form-label"><i class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                <div class="form-control">{{ $denuncias->folio }}</div>
                            </div>

                            <div class="mt-2 form-group col-md-6">
                                <label class="form-label"><i
                                        class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                <select name="estatus" class="form-control" id="opciones" onchange='cambioOpciones();'>
                                    <option {{ old('estatus', $denuncias->estatus) == 'nuevo' ? 'selected' : '' }}
                                        value="nuevo">Nuevo</option>
                                    <option {{ old('estatus', $denuncias->estatus) == 'en curso' ? 'selected' : '' }}
                                        value="en curso">En curso</option>
                                    <option {{ old('estatus', $denuncias->estatus) == 'en espera' ? 'selected' : '' }}
                                        value="en espera">En espera</option>
                                    <option {{ old('estatus', $denuncias->estatus) == 'cerrado' ? 'selected' : '' }}
                                        value="cerrado">Cerrado</option>
                                    <option {{ old('estatus', $denuncias->estatus) == 'cancelado' ? 'selected' : '' }}
                                        value="cancelado">Cancelado</option>
                                </select>
                            </div>

                            <div class="mt-2 form-group col-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de identificación</label>
                                <input type="datetime" name="fecha" value="{{ $denuncias->fecha }}"
                                    class="form-control">
                            </div>

                            <div class="mt-2 form-group col-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de recepción del reporte</label>
                                <div class="form-control">{{ $denuncias->created_at }}</div>
                            </div>

                            <div class="mt-2 form-group col-md-4">
                                <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y
                                    hora
                                    de cierre del ticket</label>

                                <input class="form-control" name="fecha_cierre" type="datetime"
                                    value="{{ $denuncias->fecha_cierre }}" id="solucion" readonly>

                            </div>

                            @if ($denuncias->anonimo == 'no')
                                <div class="mt-2 form-group col-12">
                                    <label class="form-label">
                                        <strong>Denuncia emitida por:</strong>
                                    </label>
                                </div>

                                <div class="mt-2 form-group col-4">
                                    <label class="form-label"><i class="fas fa-user iconos-crear"></i>Nombre</label>
                                    <div class="form-control">{{ $denuncias->denuncio->name }}</div>
                                </div>

                                <div class="mt-2 form-group col-4">
                                    <label class="form-label"><i
                                            class="fas fa-user-tag iconos-crear"></i>Puesto</label>
                                    <div class="form-control">{{ $denuncias->denuncio->puesto }}</div>
                                </div>

                                <div class="mt-2 form-group col-4">
                                    <label class="form-label"><i
                                            class="fas fa-project-diagram iconos-crear"></i>Área</label>
                                    <div class="form-control">{{ $denuncias->denuncio->area->area }}</div>
                                </div>

                                <div class="mt-2 form-group col-6">
                                    <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                                        electrónico</label>
                                    <div class="form-control">{{ $denuncias->denuncio->email }}</div>
                                </div>

                                <div class="mt-2 form-group col-6">
                                    <label class="form-label"><i
                                            class="fas fa-phone iconos-crear"></i>Teléfono</label>
                                    <div class="form-control">{{ $denuncias->denuncio->telefono }}</div>
                                </div>
                            @endif

                            <div class="mt-2 form-group col-12">
                                <label class="form-label">
                                    <strong>Denuncia dirigida a:</strong>
                                </label>
                            </div>

                            <div class="mt-4 form-group col-4">
                                <label class="form-label"><i class="fas fa-user-times iconos-crear"></i>Nombre</label>
                                <div class="form-control">{{ Str::limit($denuncias->denunciado->name, 30, '...') }}
                                </div>
                            </div>

                            <div class="mt-4 form-group col-4">
                                <label class="form-label"><i class="fas fa-user-tag iconos-crear"></i>Puesto
                                </label>
                                <div class="form-control">{{ $denuncias->denunciado->puesto }}</div>
                            </div>

                            <div class="mt-4 form-group col-4">
                                <label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i>Área
                                </label>
                                <div class="form-control">{{ $denuncias->denunciado->area->area }}</div>
                            </div>

                            <div class="mt-4 form-group col-12">
                                <label class="form-label"><i class="fas fa-hand-paper iconos-crear"></i>Tipo de
                                    denuncia<sup>*</sup></label>
                                <input type="" name="tipo" class="form-control"
                                    value="{{ $denuncias->tipo }}">
                            </div>

                            <div class="mt-4 form-group col-12">
                                <label class="form-label"><i class="fas fa-hand-paper iconos-crear"></i>Otro
                                    <input type="" name="tipo" class="form-control"
                                        value="{{ $denuncias->tipo }}">
                            </div>

                            <div class="mt-4 form-group col-12">
                                <label class="form-label"><i
                                        class="fas fa-file-alt iconos-crear"></i>Descripción<sup>*</sup></label><br>
                                <textarea type="" name="descripcion" class="form-control" required>{{ $denuncias->descripcion }}</textarea>
                            </div>

                            <div class="mt-4 text-center form-group col-12">
                                <div class="container">
                                    <div class="mb-4 row">
                                        <div class="col text-start">
                                            <a href="#" class="btn btn-primary" data-toggle="modal"
                                                data-target="#largeModal">Evidencia</a>
                                        </div>
                                    </div>
                                    <!-- modal -->
                                    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog"
                                        aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    @if (count($denuncias->evidencias_denuncias))
                                                        <!-- carousel -->
                                                        <div id='carouselExampleIndicators' class='carousel slide'
                                                            data-ride='carousel'>
                                                            <ol class='carousel-indicators'>
                                                                @foreach ($denuncias->evidencias_denuncias as $idx => $evidencia)
                                                                    <li data-target='#carouselExampleIndicators'
                                                                        data-slide-to='{{ $idx }}'
                                                                        class='{{ $idx == 0 ? 'active' : '' }}'>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                            <div class='carousel-inner'>
                                                                @foreach ($denuncias->evidencias_denuncias as $idx => $evidencia)
                                                                    @if (pathinfo($evidencia->evidencia, PATHINFO_EXTENSION) == 'pdf')
                                                                        <div
                                                                            class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                                            <iframe class='img-size'
                                                                                style="width:100%;height:300px;"
                                                                                src='{{ asset('storage/evidencias_denuncias' . '/' . $evidencia->evidencia) }}'></iframe>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class='text-center my-5 carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                                            <a
                                                                                href="{{ asset('storage/evidencias_denuncias') }}/{{ $evidencia->evidencia }}">
                                                                                <i class="fas fa-file-download mr-2"
                                                                                    style="font-size:18px"></i>{{ $evidencia->evidencia }}</a>
                                                                        </div>
                                                                    @endif
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


                            <div class="mt-4 text-right form-group col-12">
                                <a href="{{ asset('admin/desk') }}" class="btn btn-outline-primary">Cancelar</a>
                                <input type="submit" name="" class="btn btn-primary" value="Enviar">
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
                                    <div class="col-12" style="width: 300rem;">
                                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                            Instrucciones</p>
                                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Al final de
                                            cada formulario dé clic en el botón guardar antes de cambiar de pestaña,
                                            de lo contrario la información capturada no será guardada.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-sm-12 col-lg-12 col-md-12 text-primary ">
                                <strong style="font-size:13pt;">Folio: {{ $denuncias->folio }}</strong>
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
                                action="{{ route('admin.desk.analisis_denuncia-update', $analisis) }}">
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
                                                    <textarea name="control_a" id="analisisControl" class="politicas_txtarea">{{ $analisis->control_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="control_b"
                                                    class="politicas_txtarea txt_obj_secundarios_a">{{ $analisis->control_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="top:55px; left:810px; position: absolute; height:30px !important;">
                                                    <textarea name="proceso_a" id="analisisProceso" class="procesos_txtarea">{{ $analisis->proceso_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="proceso_b"
                                                    class="procesos_txtarea txt_obj_secundarios_a">{{ $analisis->proceso_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="top:55px; left:1315px; position: absolute; height:30px !important;">
                                                    <textarea name="personas_a" id="analisisPersona" class="personas_txtarea">{{ $analisis->personas_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="personas_b"
                                                    class="personas_txtarea txt_obj_secundarios_a">{{ $analisis->personas_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; right:480px; position: absolute;">
                                                    <textarea name="tecnologia_a" id="analisisTecnologia" class="tecnologia_txtarea txt_obj_secundarios_b">{{ $analisis->tecnologia_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="tecnologia_b"
                                                    class="tecnologia_txtarea ">{{ $analisis->tecnologia_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; left:540px; position: absolute;">
                                                    <textarea name="metodos_a" class="metodos_txtarea txt_obj_secundarios_b" id="analisisMetodos">{{ $analisis->metodos_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="metodos_b"
                                                    class="metodos_txtarea ">{{ $analisis->metodos_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; left:1060px; position: absolute;">
                                                    <textarea name="ambiente_a" class="ambiente_txtarea txt_obj_secundarios_b" id="analisisAmbiente">{{ $analisis->ambiente_a }}</textarea>
                                                </div>
                                                {{-- <textarea name="ambiente_b"
                                                    class="ambiente_txtarea ">{{ $analisis->ambiente_b }}</textarea> --}}
                                                <div class="col-6"
                                                    style="bottom:5px; left:1600px; position: absolute;">
                                                    <textarea name="problema_diagrama" class="problemas_txtarea" id="analisisProblema">{{ $analisis->problema_diagrama }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3 text-right col-12">
                                    <input type="submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <section id="plan">
                    <div class="seccion_div">
                        <div class="" style=" position: relative; ">
                            <div class=" row">
                                <div class="mb-3 col-sm-12 col-lg-12 col-md-12 text-primary ">
                                    <strong style="font-size:13pt;">Folio: {{ $denuncias->folio }}</strong>
                                </div>
                            </div>
                            <h5 style=" position: ;"><b>Acciones para la Atención de la Denuncia</b></h5>
                            <button style="position:absolute; right: 2px; top:2px;"
                                class="btn btn-primary btn_modal_form">Agregar actividad</button>
                            @if (count($denuncias->planes))
                                <a style="position:absolute; right: 170px; top:2px;"
                                    href="{{ route('admin.planes-de-accion.show', $denuncias->planes->first()->id) }}"
                                    class="btn btn-primary"><i class="mr-2 fas fa-stream"></i> Plan De
                                    Acción</a>
                            @endif
                        </div>
                        <div class="mt-4 datatable-fix" style="width: 100%;">
                            <table id="tabla_plan_accion_denuncias" class="table">
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
                                action="{{ route('admin.desk-denuncias-actividades.store') }}">
                                <input type="hidden" name="denuncia_id" value="{{ $denuncias->id }}">
                                <div class="text-center card-header" style="background-color: var(--color-tbj)">
                                    <strong style="font-size: 16pt; color: #fff;"><i
                                            class="mr-4 fas fa-tasks"></i>Crear:
                                        Plan de Trabajo</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label"><i
                                                    class="fas fa-wrench iconos-crear"></i>Actividad</label>
                                            <input type="" name="actividad" class="form-control"
                                                id="actividad">
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
                                            <input type="date" name="fecha_fin" class="form-control"
                                                id="fecha_fin">
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
                                            <a href="#" class="btn btn-outline-primary">Cancelar</a>
                                            <input type="submit" value="Guardar"
                                                class="btn btn-primary btn_enviar_form_modal">
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

@php
    $userIsAuthorized = false;
    $existingRecord = App\Models\FirmaCentroAtencion::where('id_denuncias', $denuncias->id)
        ->where('user_id', Auth::id())
        ->first();
    if ($aprobadores) {
        $aprobadoresArray = json_decode($aprobadores->aprobadores, true); // Decodificar JSON a array
        if (is_array($aprobadoresArray) && in_array(Auth::id(), $aprobadoresArray)) {
            $userIsAuthorized = true;
        }
    }
@endphp


@if ($denuncias->estatus === 'cerrado' || $denuncias->estatus === 'cancelado')
    @if ($userIsAuthorized)
        @if (!$existingRecord)
            <form method="POST" action="{{ route('admin.module_firmas.denuncias', ['id' => $denuncias->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="card card-body">
                    <div class="" style="position: relative; left: 2rem;">
                        <br>
                        <h5><strong>Firma*</strong></h5>
                        <p>
                            Indispensable firmar antes de guardar y enviarla a aprobación.
                        </p>
                    </div>
                    <div class="flex caja-firmar">
                        <div class="flex-item"
                            style="display:flex; justify-content: center; flex-direction: column; align-items:center;">
                            <div id="firma_content" class="caja-space-firma"
                                style="display:flex; justify-content: center; flex-direction: column; align-items:center;">
                                <canvas id="firma_requi" width="500px" height="300px">
                                    Navegador no compatible
                                </canvas>
                                <input type="hidden" name="firma" id="firma">
                            </div>
                            <div>
                                <div class="btn"
                                    style="color: white; background:  gray !important; transform: translateY(-40px) scale(0.8);"
                                    id="clear">Limpiar</div>
                            </div>
                            <div class="flex my-4" style="justify-content: end;">
                                <button onclick="validar()" class="btn btn-primary" type="submit">Firmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @endif
@endif

@if ($userIsAuthorized || auth()->user()->roles->contains('title', 'Admin'))
    <div class="card card-content" style="margin-bottom: 30px">
        <div class="caja-firmas-doc">
            @foreach ($firmas as $firma)
                <div class="flex" style="margin-top: 70px;">
                    <div class="flex-item">
                        @if ($firma->firma)
                            <img src="{{ $firma->firma_ruta_denuncias }}" class="img-firma" width="200"
                                height="100">
                            <p>Fecha: {{ $firma->created_at->format('d-m-Y') }}</p>
                            <p>Firmante: {{ $firma->empleado->name }}</p>
                        @else
                            <div style="height: 137px;"></div>
                        @endif
                        <hr>
                        <p>
                            <small>FECHA, FIRMA Y NOMBRE DEL PARTICIPANTE </small>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.signature.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@section('scripts')
<script>
    function validar(params) {
        var x = $("#firma").val();
        if (x) {
            document.getElementById("myForm").submit();
        } else {
            Swal.fire(
                'Aun no ha firmado',
                'Porfavor Intentelo nuevamente',
                'error');
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        (function() {


            window.requestAnimFrame = (function(callback) {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function(callback) {
                        window.setTimeout(callback, 1000 / 60);
                    };
            })();

            if (document.getElementById('firma_requi')) {
                renderCanvas("firma_requi", "clear");
            }

        })();

        $('#firma_requi').mouseleave(function() {
            var canvas = document.getElementById('firma_requi');
            var dataUrl = canvas.toDataURL();
            $('#firma').val(dataUrl);
        });

        function renderCanvas(contenedor, clearBtnCanvas) {

            var canvas = document.getElementById(contenedor);
            console.log(canvas);
            var ctx = canvas.getContext("2d");
            ctx.strokeStyle = "#222222";
            ctx.lineWidth = 1;

            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;

            canvas.addEventListener("mousedown", function(e) {
                drawing = true;
                lastPos = getMousePos(canvas, e);
            }, false);

            canvas.addEventListener("mouseup", function(e) {
                drawing = false;
            }, false);

            canvas.addEventListener("mousemove", function(e) {
                mousePos = getMousePos(canvas, e);
            }, false);

            // Add touch event support for mobile
            canvas.addEventListener("touchstart", function(e) {

            }, false);

            canvas.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var me = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                var touch = e.touches[0];
                var me = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchend", function(e) {
                var me = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(me);
            }, false);

            function getMousePos(canvasDom, mouseEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: mouseEvent.clientX - rect.left,
                    y: mouseEvent.clientY - rect.top
                }
            }

            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                }
            }

            function renderCanvas() {
                if (drawing) {
                    ctx.moveTo(lastPos.x, lastPos.y);
                    ctx.lineTo(mousePos.x, mousePos.y);
                    ctx.stroke();
                    lastPos = mousePos;
                }
            }

            // Prevent scrolling when touching the canvas
            document.body.addEventListener("touchstart", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchend", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchmove", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);

            (function drawLoop() {
                requestAnimFrame(drawLoop);
                renderCanvas();
            })();

            function clearCanvas() {
                canvas.width = canvas.width;
            }

            function isCanvasBlank() {
                const context = canvas.getContext('2d');

                const pixelBuffer = new Uint32Array(
                    context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
                );

                return !pixelBuffer.some(color => color !== 0);
            }

            // Set up the UI
            // var sigText = document.getElementById(dataBaseCanvas);
            // var sigImage = document.getElementById(imageCanvas);
            var clearBtn = document.getElementById(clearBtnCanvas);
            // var submitBtn = document.getElementById(submitBtnCanvas);
            clearBtn.addEventListener("click", function(e) {
                clearCanvas();
                // sigText.innerHTML = "Data URL for your signature will go here!";
                // sigImage.setAttribute("src", "");
            }, false);
            // submitBtn.addEventListener("click", function(e) {
            //     const blank = isCanvasBlank();
            //     if (!blank) {
            //         // var dataUrl = canvas.toDataURL();
            //         // sigText.innerHTML = dataUrl;
            //         // sigImage.setAttribute("src", dataUrl);
            //     } else {
            //         if (toastr) {
            //             toastr.info('No has firmado en el canvas');
            //         } else {
            //             alert('No has firmado en el canvas');
            //         }
            //     }
            // }, false);

        }

        function isCanvasEmpty(canvas) {
            const context = canvas.getContext('2d');

            const pixelBuffer = new Uint32Array(
                context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
            );

            return !pixelBuffer.some(color => color !== 0);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#participantes').select2({
            placeholder: 'Selecciona participantes',
            allowClear: true,
            tags: true,
            tokenSeparators: [',', ' '],
            templateResult: formatEmpleado,
            templateSelection: formatEmpleadoSelection,
            maximumSelectionLength: 5 // Limita a un máximo de 5 selecciones
        });

        function formatEmpleado(empleado) {
            if (!empleado.id) {
                return empleado.text;
            }
            var $nombre = $('<span>' + empleado.text + '</span>');
            var $container = $('<span>').append($nombre);
            return $container;
        }

        function formatEmpleadoSelection(empleado) {
            return empleado.text;
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('toggle-info');
        const infoBar = document.getElementById('info-bar');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                infoBar.style.display = 'block';
            } else {
                infoBar.style.display = 'none';
            }
        });
    });
</script>
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

    $(document).ready(function() {
        window.tbl_plan = $("#tabla_plan_accion_denuncias").DataTable({
            ajax: "{{ route('admin.desk-denuncias-actividades.index', $denuncias->id) }}",
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
    $(document).on('change', '#select_metodos', function(event) {
        $(".caja_oculta_dinamica").removeClass("d-block");
        var metodo_v = $("#select_metodos option:selected").attr('data-metodo');
        $(document.getElementById(metodo_v)).addClass("d-block");
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
