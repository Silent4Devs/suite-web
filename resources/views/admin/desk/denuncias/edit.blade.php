@extends('layouts.admin')
@section('content')
			



	@section('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('css/formularios_centro_atencion.css')}}">
    @endsection


    <div class="card">
        <div class="card-header text-center" style="background-color: #00abb2;">
            <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-hand-paper mr-4"></i>Denuncias</strong>
        </div>
        <div class="caja_botones_menu">
            <a href="#" data-tabs="registro" class="btn_activo"><i class="fas fa-hand-paper mr-4"></i>Registro de
                Denuncia</a>
            <a href="#" data-tabs="analisis"><i class="fas fa-clipboard-list mr-4"></i>Análisis Causa Raíz</a>
            <a href="#" data-tabs="plan"><i class="fas fa-tasks mr-4"></i>Plan de Acción</a>
        </div>
        <div class="card-body">

            <div class="caja_caja_secciones">

                <div class="caja_secciones">

                    <section id="registro" class="caja_tab_reveldada">
                        <div class="seccion_div">
                            <form class="row" method="POST" action="{{ route('admin.desk.denuncias-update', $denuncias) }}">
                                @csrf
                                <div class="form-group col-12">
                                    Tipo de denuncia:
                                    @if($denuncias->anonimo == 'no')
                                        <label class="form-label"><strong>Datos proporcionados</strong></label>
                                    @else
                                        <label class="form-label"><strong>Denuncia anónima</strong></label>
                                    @endif
                                </div>

                                 <div class="form-group mt-1 col-12">
                                    <b>Datos generales:</b>
                                </div>

                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                    <div class="form-control">{{ $denuncias->folio }}</div>
                                </div>                                 

                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                    <select name="estatus" class="form-control">
                                        <option>{{ $denuncias->estatus }}</option>
                                        <option value="nuevo">Nuevo</option>
                                        <option value="en curso">En curso</option>
                                        <option value="en espera">En espera</option>
                                        <option value="cerrado">Cerrado</option>
                                        <option value="cancelado">Cancelado</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de identificación</label>
                                    <input type="datetime" name="fecha" value="{{$denuncias->fecha}}" class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de recepción del reporte</label>
                                    <div class="form-control">{{ $denuncias->created_at }}</div>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de cierre del ticket</label>
                                    <div class="form-control">{{ $denuncias->fecha_cierre }}</div>
                                </div>


                                

                                 @if($denuncias->anonimo == 'no')

                                    <div class="form-group mt-2 col-12">
                                        <label class="form-label">
                                            <strong>Denuncia emitida por:</strong> 
                                        </label>
                                    </div>

                                    <div class="form-group mt-2 col-4">
                                        <label class="form-label"><i class="fas fa-user iconos-crear"></i>Nombre</label>
                                        <div class="form-control">{{ $denuncias->denuncio->name }}</div>
                                    </div>

                                    <div class="form-group mt-2 col-4">
                                        <label class="form-label"><i class="fas fa-user-tag iconos-crear"></i>Puesto</label>
                                        <div class="form-control">{{ $denuncias->denuncio->puesto }}</div>
                                    </div>

                                    <div class="form-group mt-2 col-4">
                                        <label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i>Área</label>
                                        <div class="form-control">{{ $denuncias->denuncio->area->area }}</div>
                                    </div>

                                    <div class="form-group mt-2 col-6">
                                        <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
                                        <div class="form-control">{{ $denuncias->denuncio->email }}</div>
                                    </div>

                                    <div class="form-group mt-2 col-6">
                                        <label class="form-label"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
                                        <div class="form-control">{{ $denuncias->denuncio->telefono }}</div>
                                    </div>
                                @endif

                                <div class="form-group mt-2 col-12">
                                        <label class="form-label">
                                            <strong>Denuncia dirigida a:</strong> 
                                        </label>
                                    </div>

                                <div class="form-group mt-4 col-4">
                                    <label class="form-label"><i class="fas fa-user-times iconos-crear"></i>Nombre</label>
                                    <div class="form-control">{{ $denuncias->denunciado->name }}</div>
                                </div>

                                <div class="form-group mt-4 col-4">
                                    <label class="form-label"><i class="fas fa-user-tag iconos-crear"></i>Puesto </label>
                                    <div class="form-control">{{ $denuncias->denunciado->puesto }}</div>
                                </div>

                                <div class="form-group mt-4 col-4">
                                    <label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i>Área </label>
                                    <div class="form-control">{{ $denuncias->denunciado->area->area }}</div>
                                </div>

                                <div class="form-group mt-4 col-12">
                                    <label class="form-label"><i class="fas fa-hand-paper iconos-crear"></i>Tipo de denuncia</label>
                                    <input type="" name="tipo" class="form-control" value="{{ $denuncias->tipo }}">
                                </div>

                                <div class="form-group mt-4 col-12">
                                    <label class="form-label"><i class="fas fa-hand-paper iconos-crear"></i>Otro>
                                    <input type="" name="tipo" class="form-control" value="{{ $denuncias->tipo }}">
                                </div>

                                <div class="form-group mt-4 col-12">
                                    <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Descripción</label><br>
                                    <textarea type="" name="descripcion" class="form-control">{{ $denuncias->descripcion }}</textarea>
                                </div>

                                <div class="form-group mt-4 col-12">
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#largeModal">Evidencia</a>
                                        </div>
                                </div>

                                <div class="form-group mt-4 text-right col-12">
                                    <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cancelar</a>
                                    <input type="submit" name="" class="btn btn-success" value="Enviar">
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
                                <div class="col-12" style="position: relative;">


                                    <div id="ideas" class="caja_oculta_dinamica row">
                                        <div class="form-group col-12">
                                            <label>Ideas</label>
                                            <textarea class="form-control"></textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Causa Raíz</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>



                                    <div id="porque" class="caja_oculta_dinamica row">
                                        <div class="form-group col-12">
                                            Problema: <textarea class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>1er porqué:</label>
                                            <input type="" name="" class="form-control">
                                            <label>2do porqué:</label>
                                            <input type="" name="" class="form-control">
                                            <label>3er porqué:</label>
                                            <input type="" name="" class="form-control">
                                            <label>4to porqué:</label>
                                            <input type="" name="" class="form-control">
                                            <label>5to porqué:</label>
                                            <input type="" name="" class="form-control">
                                        </div>
                                        <div class="form-group col-12">
                                            Causa Raíz: <textarea class="form-control"></textarea>
                                        </div>
                                    </div>



                                    <div id="digrama" class="caja_oculta_dinamica">
                                        <div class="col-12 mt-5" style="overflow: auto;">
                                            <div style="width: 100%; min-width:540px; position: relative;">
                                                <img src="{{ asset('img/diagrama_causa_raiz.png') }}" style="width:100%">

                                                <textarea name="" class="politicas_txtarea"></textarea>
                                                <textarea name=""
                                                    class="politicas_txtarea txt_obj_secundarios_a"></textarea>

                                                <textarea name="" class="procesos_txtarea"></textarea>
                                                <textarea name="" class="procesos_txtarea txt_obj_secundarios_a"></textarea>

                                                <textarea name="" class="personas_txtarea"></textarea>
                                                <textarea name="" class="personas_txtarea txt_obj_secundarios_a"></textarea>

                                                <textarea name=""
                                                    class="tecnologia_txtarea txt_obj_secundarios_b"></textarea>
                                                <textarea name="" class="tecnologia_txtarea "></textarea>

                                                <textarea name="" class="metodos_txtarea txt_obj_secundarios_b"></textarea>
                                                <textarea name="" class="metodos_txtarea "></textarea>

                                                <textarea name="" class="ambiente_txtarea txt_obj_secundarios_b"></textarea>
                                                <textarea name="" class="ambiente_txtarea "></textarea>

                                                <textarea name="" class="problemas_txtarea"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
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