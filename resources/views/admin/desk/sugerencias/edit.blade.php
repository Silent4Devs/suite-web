@extends('layouts.admin')
@section('content')
	
			
	

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/formularios_centro_atencion.css')}}">
@endsection


    <div class="card">
        <div class="card-header text-center" style="background-color: #00abb2;">
            <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-lightbulb mr-4"></i>Sugerencias</strong>
        </div>
        <div class="caja_botones_menu">
            <a href="#" data-tabs="registro" class="btn_activo"><i class="fas fa-lightbulb mr-4"></i>Registro de
                Sugerencia</a>
            <a href="#" data-tabs="analisis"><i class="fas fa-clipboard-list mr-4"></i>Análisis Causa Raíz</a>
            <a href="#" data-tabs="plan"><i class="fas fa-tasks mr-4"></i>Plan de Acción</a>
        </div>
        <div class="card-body">

            <div class="caja_caja_secciones">

                <div class="caja_secciones">

                    <section id="registro" class="caja_tab_reveldada">
                        <div class="seccion_div">
                        	<form method="POST" action="{{ route('admin.desk.sugerencias-update', $sugerencias) }}" class="row">
								@csrf



                                <div class="form-group mt-4 col-12">
                                    <b>Datos generales:</b>
                                </div>

                                <div class="form-group mt-2 col-2">
                                    <label class="form-label"><i class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                    <div class="form-control" id="input_folio">{{ $sugerencias->folio }}</div>
                                </div>

                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Titulo corto de la sugerencia</label>
                                    <input name="titulo" value="{{ $sugerencias->titulo }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                    <select name="estatus" class="form-control">
                                        <option
                                            {{ old('estatus', $sugerencias->estatus) == 'nuevo' ? 'selected' : '' }}
                                            value="nuevo">Nuevo</option>
                                        <option
                                            {{ old('estatus', $sugerencias->estatus) == 'en curso' ? 'selected' : '' }}
                                            value="en curso">En curso</option>
                                        <option
                                            {{ old('estatus', $sugerencias->estatus) == 'en espera' ? 'selected' : '' }}
                                            value="en espera">En espera</option>
                                        <option
                                            {{ old('estatus', $sugerencias->estatus) == 'cerrado' ? 'selected' : '' }}
                                            value="cerrado">Cerrado</option>
                                        <option
                                            {{ old('estatus', $sugerencias->estatus) == 'cancelado' ? 'selected' : '' }}
                                            value="cancelado">Cancelado</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de recepción del reporte</label>
                                        <div class="form-control">{{ $sugerencias->created_at }}</div>
                                </div>

                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de cierre del ticket</label>
                                        <div class="form-control">{{ $sugerencias->fecha_cierre }}</div>
                                </div>



                                <div class="form-group mt-4 col-12">
                                    <b>Sugerencia emitida por:</b>
                                </div>


								<div class="form-group mt-2 col-4">
									<label class="form-label"><i class="fas fa-user iconos-crear"></i> Nombre</label>
									<div class="form-control">{{ $sugerencias->sugirio->name }}</div>
								</div>

								<div class="form-group mt-2 col-4">
									<label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i>Área</label>
									<div class="form-control">{{ $sugerencias->sugirio->area->area }}</div>
								</div>

								<div class="form-group mt-2 col-4">
									<label class="form-label"><i class="fas fa-user-tag iconos-crear"></i> Puesto</label>
									<div class="form-control">{{ $sugerencias->sugirio->puesto }}</div>
								</div>

								<div class="form-group mt-2 col-6">
									<label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo Electrónico</label>
									<div class="form-control">{{ $sugerencias->sugirio->email }}</div>
								</div>

								<div class="form-group mt-2 col-6">
									<label class="form-label"><i class="fas fa-phone iconos-crear"></i> Teléfono</label>
									<div class="form-control">{{ $sugerencias->sugirio->telefono }}</div>
								</div>


                                <div class="form-group mt-4 col-12">
                                    <b>Sugerencia dirigida a:</b>
                                </div>

								<div class="form-group mt-4 col-6 multiselect_areas">
                                    <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i>Área(s)</label>
                                    <select class="form-control">
                                        <option disabled selected>Seleccionar áreas</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->area }}">
                                                {{ $area->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="area_sugerencias" class="form-control">{{ $sugerencias->area_sugerencias }}</textarea>
                                </div>

                                <div class="form-group mt-4 col-6 multiselect_procesos">
                                    <label class="form-label"><i class="fas fa-dice-d20 iconos-crear"></i>Proceso(s)</label>
                                    <select class="form-control" name="">
                                        <option disabled selected>Seleccionar proceso</option>
                                        @foreach ($procesos as $proceso)
                                            <option value="{{ $proceso->codigo }}: {{ $proceso->nombre }}">
                                                {{ $proceso->codigo }}: {{ $proceso->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="proceso_sugerencias" class="form-control">{{ $sugerencias->proceso_sugerencias }}</textarea>
                                </div>

								<div class="form-group mt-2 col-12">
									<label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> Describa detalladamente su sugerencia</label>
									<textarea name="descripcion" class="form-control">{{ $sugerencias->descripcion }}</textarea>
								</div>

								<div class="form-group mt-2 text-right col-12">
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
        document.addEventListener('DOMContentLoaded', function(){
            let select_activos = document.querySelector('.multiselect_areas select');
            select_activos.addEventListener('change', function(e){
                e.preventDefault();
                let texto_activos = document.querySelector('.multiselect_areas textarea');
                
                    texto_activos.value += `${this.value}, `;
                
            });
        });


        document.addEventListener('DOMContentLoaded', function(){
            let select_activos = document.querySelector('.multiselect_procesos select');
            select_activos.addEventListener('change', function(e){
                e.preventDefault();
                let texto_activos = document.querySelector('.multiselect_procesos textarea');
                
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
@endsection