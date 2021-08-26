@extends('layouts.admin')
@section('content')

	@section('styles')
	    <link rel="stylesheet" type="text/css" href="{{asset('css/formularios_centro_atencion.css')}}">
	@endsection


    <div class="card">
        <div class="card-header text-center" style="background-color: #00abb2;">
            <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-frown mr-4"></i></i>Quejas</strong>
        </div>
        <div class="caja_botones_menu">
            <a href="#" data-tabs="registro" class="btn_activo"><i class="fas fa-frown mr-4"></i>Registro de
                Queja</a>
            <a href="#" data-tabs="analisis"><i class="fas fa-clipboard-list mr-4"></i>Análisis Causa Raíz</a>
            <a href="#" data-tabs="plan"><i class="fas fa-tasks mr-4"></i>Plan de Acción</a>
        </div>
        <div class="card-body">

            <div class="caja_caja_secciones">

                <div class="caja_secciones">

                    <section id="registro" class="caja_tab_reveldada">
                        <div class="seccion_div"> 
                        	<form class="row" method="POST" action="{{ route('admin.desk.quejas-update', $quejas) }}" enctype="multipart/form-data">
								@csrf

								










                                <div class="form-group mt-1 col-12">
                                    <b>Datos generales:</b>
                                </div>

                                <div class="form-group mt-2 col-2">
                                    <label class="form-label"><i class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                    <div class="form-control">{{ $quejas->folio }}</div>
                                </div>


                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-text-width iconos-crear"></i>Título corto de la queja</label>
                                    <input class="form-control" name="titulo" value="{{ $quejas->titulo }}">
                                </div>

                                 

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                    <select name="estatus" class="form-control">
                                        <option>{{ $quejas->estatus }}</option>
                                        <option value="nuevo">Nuevo</option>
                                        <option value="en curso">En curso</option>
                                        <option value="en espera">En espera</option>
                                        <option value="cerrado">Cerrado</option>
                                        <option value="cancelado">Cancelado</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de identificación</label>
                                    <input type="datetime" name="fecha" value="{{$quejas->fecha}}" class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de recepción del reporte</label>
                                    <div class="form-control">{{ $quejas->created_at }}</div>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de cierre del ticket</label>
                                    <div class="form-control">{{ $quejas->fecha_cierre }}</div>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Sede</label>
                                    <select class="form-control">
                                        <option>{{ $quejas->sede }}</option>
                                        @foreach($sedes as $sede)
                                            <option value="{{ $sede->sede }}">{{ $sede->sede }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-8">
                                    <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación exacta</label>
                                    <input type="" name="ubicacion" class="form-control" value="{{ $quejas->ubicacion }}">
                                </div>

                                <div class="form-group mt-2 col-12">
                                    <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Descripción del riesgo identificado</label>
                                    <textarea name="descripcion" class="form-control">{{ $quejas->descripcion }}</textarea>
                                </div>


                                <div class="form-group mt-4 col-12 text-center">
                                    
                                    <style type="text/css">
                                        .img-size{
                                        /*  padding: 0;
                                            margin: 0; */
                                            height: 400px;
                                            width: 100%;
                                            background-size: contain;
                                        }
                                        .modal-content {

                                            height: 400px;
                                            border:none;
                                        }
                                        .modal-body {
                                           padding: 0;
                                        }

                                        .carousel-control-next, .carousel-control-prev{
                                            width: 30px;
                                            height: 48px;
                                            top: 50%;
                                        }
                                        .carousel-control-next{
                                            right: 30px !important;
                                        }
                                        .carousel-control-prev{
                                            left: 30px;
                                         }
                                        .carousel-control-prev-icon {
                                            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
                                            width: 30px;
                                            height: 48px;
                                        }
                                        .carousel-control-next-icon {
                                            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
                                            width: 30px;
                                            height: 48px;
                                        }
                                    </style>

                                    <div class="container">

                                      <div class="row mb-4">
                                        <div class="col text-start">
                                          <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#largeModal">Evidencia</a>
                                        </div>
                                      </div>

                                      <!-- modal -->
                                      <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <div class="modal-body">
                                               <!-- carousel -->
                                              <div
                                                   id='carouselExampleIndicators'
                                                   class='carousel slide'
                                                   data-ride='carousel'
                                                   >
                                                <ol class='carousel-indicators'>
                                                    @foreach($quejas->evidencias_quejas as $idx=>$evidencia)
                                                      <li
                                                          data-target='#carouselExampleIndicators'
                                                          data-slide-to='{{ $idx }}'
                                                          class='{{ $idx == 0 ? 'active' : ''}}'
                                                          ></li>
                                                    @endforeach
                                                </ol>
                                                <div class='carousel-inner'>
                                                    @foreach($quejas->evidencias_quejas as $idx=>$evidencia)
                                                      <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <iframe class='img-size' src='{{ asset('storage/evidencias_quejas' . '/'.$evidencia->evidencia) }}'></iframe>
                                                      </div>
                                                    @endforeach
                                                </div>
                                                <a
                                                   class='carousel-control-prev'
                                                   href='#carouselExampleIndicators'
                                                   role='button'
                                                   data-slide='prev'
                                                   >
                                                  <span class='carousel-control-prev-icon'
                                                        aria-hidden='true'
                                                        ></span>
                                                  <span class='sr-only'>Previous</span>
                                                </a>
                                                <a
                                                   class='carousel-control-next'
                                                   href='#carouselExampleIndicators'
                                                   role='button'
                                                   data-slide='next'
                                                   >
                                                  <span
                                                        class='carousel-control-next-icon'
                                                        aria-hidden='true'
                                                        ></span>
                                                  <span class='sr-only'>Next</span>
                                                </a>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-2 col-12">
                                    <label class="form-label">
                                        <strong>Queja dirigida a:</strong> 
                                    </label>
                                </div>  

                                 <div class="form-group mt-4 col-3 multiselect_areas">
                                    <label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i>Área(s)</label>
                                    <select class="form-control">
                                        <option disabled selected>Seleccionar áreas</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->area }}">
                                                {{ $area->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="area_quejado" class="form-control">{{ $quejas->area_quejado }}</textarea>
                                </div>

                                <div class="form-group mt-4 col-3 multiselect_empleados">
                                    <label class="form-label"><i class="fas fa-user iconos-crear"></i>Colaborador(es)</label>
                                    <select class="form-control">
                                        <option disabled selected>Seleccionar colaborador</option>
                                        @foreach ($empleados as $empleado)
                                            <option value="{{ $empleado->name }}">
                                                {{ $empleado->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="colaborador_quejado" class="form-control">{{ $quejas->colaborador_quejado }}</textarea>
                                </div>

                                <div class="form-group mt-4 col-3 multiselect_procesos">
                                    <label class="form-label"><i class="fas fa-code-branch iconos-crear"></i>Proceso(s)</label>
                                    <select class="form-control">
                                        <option disabled selected>Seleccionar proceso</option>
                                        @foreach ($procesos as $proceso)
                                            <option value="{{ $proceso->codigo }}: {{ $proceso->nombre }}">
                                                {{ $proceso->codigo }}: {{ $proceso->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="proceso_quejado" class="form-control">{{ $quejas->proceso_quejado }}</textarea>
                                </div>

                                <div class="form-group mt-4 col-3">
                                    <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Externo(s)</label>
                                    <textarea name="externo_quejado" class="form-control">{{ $quejas->externo_quejado }}</textarea>
                                </div>

                                <div class="form-group mt-2 col-12">
                                    <label class="form-label"><i class="fas fa-comment-dots iconos-crear"></i>Comentarios del receptor</label>
                                    <textarea name="comentarios" class="form-control">{{ $quejas->comentarios }}</textarea>
                                </div>












                                @if($quejas->anonimo == 'no')

                                    <div class="form-group mt-2 col-12">
                                        <label class="form-label">
                                            <strong>Queja emitida por:</strong> 
                                        </label>
                                    </div>
                                    
    								<div class="form-group mt-2 col-4">
    									<label class="form-label"><i class="fas fa-user iconos-crear"></i>Nombre</label>
    									<div class="form-control">{{ $quejas->quejo->name }}</div>
    								</div>

    								<div class="form-group mt-2 col-4">
    									<label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i>Área</label>
    									<div class="form-control">{{ $quejas->quejo->area->area }}</div>
    								</div>

    								<div class="form-group mt-2 col-4">
    									<label class="form-label"><i class="fas fa-user-tag iconos-crear"></i>Puesto</label>
    									<div class="form-control">{{ $quejas->quejo->puesto }}</div>
    								</div>

    								<div class="form-group mt-2 col-6">
    									<label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
    									<div class="form-control">{{ $quejas->quejo->email }}</div>
    								</div>

    								<div class="form-group mt-2 col-6">
    									<label class="form-label"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
    									<div class="form-control">{{ $quejas->quejo->telefono }}</div>
    								</div>
                                @endif

                                			

								<div class="form-group mt-4 text-right col-12">
									<a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cancelar</a>
									<input type="submit" class="btn btn-success" value="Enviar">
								</div>
							</form>
                        </div>
                    </section>

                    

                    <section id="analisis">
                        <div class="seccion_div">
                            <div class="row">
                                <div class="col-md-4">
                                    Seleccione el metódo de análisis
                                </div>
                                <div class="col-md-8">
                                    <select id="select_metodos" class="form-control">
                                        <option selected disabled>- -</option>
                                        <option class="op_ideas" data-metodo="ideas">Lluvia de ideas (Brainstorming)
                                        </option>
                                        <option class="op_porque" data-metodo="porque">5 Porqués (5 Why)</option>
                                        <option class="op_digrama" data-metodo="digrama">Diagrama causa efecto (Ishikawa)
                                        </option>
                                    </select>
                                </div>

                                <form method="POST" class="col-12" action="{{ route('admin.desk.analisis_queja-update', $analisis->id) }}">
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
                                                    Problema: <textarea class="form-control" name="problema_porque">{{ $analisis->problema_porque }}</textarea>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>1er porqué:</label>
                                                    <input name="porque_1" class="form-control" value="{{ $analisis->porque_1 }}">
                                                    <label>2do porqué:</label>
                                                    <input name="porque_2" class="form-control" value="{{ $analisis->porque_2 }}">
                                                    <label>3er porqué:</label>
                                                    <input name="porque_3" class="form-control" value="{{ $analisis->porque_3 }}">
                                                    <label>4to porqué:</label>
                                                    <input name="porque_4" class="form-control" value="{{ $analisis->porque_4 }}">
                                                    <label>5to porqué:</label>
                                                    <input name="porque_5" class="form-control" value="{{ $analisis->porque_5 }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    Causa Raíz: <textarea class="form-control" name="causa_porque">{{ $analisis->causa_porque }}</textarea>
                                                </div>
                                            </div>



                                            <div id="digrama" class="caja_oculta_dinamica">
                                                <div class="col-12 mt-5" style="overflow: auto;">
                                                    <div style="width: 100%; min-width:540px; position: relative;">
                                                        <img src="{{ asset('img/diagrama_causa_raiz.png') }}" style="width:100%">

                                                        <textarea name="control_a" class="politicas_txtarea">{{ $analisis->control_a }}</textarea>
                                                        <textarea name="control_b" class="politicas_txtarea txt_obj_secundarios_a">{{ $analisis->control_b }}</textarea>

                                                        <textarea name="proceso_a" class="procesos_txtarea">{{ $analisis->proceso_a }}</textarea>
                                                        <textarea name="proceso_b" class="procesos_txtarea txt_obj_secundarios_a">{{ $analisis->proceso_b }}</textarea>

                                                        <textarea name="personas_a" class="personas_txtarea">{{ $analisis->personas_a }}</textarea>
                                                        <textarea name="personas_b" class="personas_txtarea txt_obj_secundarios_a">{{ $analisis->personas_b }}</textarea>

                                                        <textarea name="tecnologia_a" class="tecnologia_txtarea txt_obj_secundarios_b">{{ $analisis->tecnologia_a }}</textarea>
                                                        <textarea name="tecnologia_b" class="tecnologia_txtarea ">{{ $analisis->tecnologia_b }}</textarea>

                                                        <textarea name="metodos_a" class="metodos_txtarea txt_obj_secundarios_b">{{ $analisis->metodos_a }}</textarea>
                                                        <textarea name="metodos_b" class="metodos_txtarea ">{{ $analisis->metodos_b }}</textarea>

                                                        <textarea name="ambiente_a" class="ambiente_txtarea txt_obj_secundarios_b">{{ $analisis->ambiente_a }}</textarea>
                                                        <textarea name="ambiente_b" class="ambiente_txtarea ">{{ $analisis->ambiente_b }}</textarea>

                                                        <textarea name="problema_diagrama" class="problemas_txtarea">{{ $analisis->problema_diagrama }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-12 text-right py-3">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>



                    <section id="plan">
                        <div class="seccion_div">
                            <div class="datatable-fix" style="width: 100%;">
                                <table id="tabla_plan_accion" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Acción</th>
                                            <th>Fecha compromiso</th>
                                            <th>Fecha real</th>
                                            <th>Prioridad</th>
                                            <th>Tipo</th>
                                            <th>Asignados</th>
                                            <th>Estatus</th>
                                            <th>Comentarios</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                        <tr>
                                            <td>ID</td>
                                            <td>Acción</td>
                                            <td>Fecha compromiso</td>
                                            <td>Fecha real</td>
                                            <td>Prioridad</td>
                                            <td>Tipo</td>
                                            <td>Asignados</td>
                                            <td>Estatus</td>
                                            <td>Comentarios</td>
                                            <td>Opciones</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>







@endsection



@section('scripts')
	<script type="text/javascript">
        $(document).on('change', '#select_metodos', function(event) {
            $(".caja_oculta_dinamica").removeClass("d-block");
            var metodo_v = $("#select_metodos option:selected").attr('data-metodo');
            $(document.getElementById(metodo_v)).addClass("d-block");
        });
    </script>
@endsection