@extends('layouts.admin')
@section('content')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/formularios_centro_atencion.css')}}">
@endsection


    <div class="card" id="desk">
        <div class="card-header text-center" style="background-color: #00abb2;">
            <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-exclamation-triangle mr-4"></i>Incidentes de
                seguridad</strong>
        </div>
        <div class="caja_botones_menu" style=" justify-content: left !important;">
            <a href="#" data-tabs="registro" class="btn_activo"><i class="fas fa-exclamation-triangle mr-4"></i>Registro de
                Incidentes</a>
            <a href="#" data-tabs="analisis"><i class="fas fa-clipboard-list mr-4"></i>Análisis Causa Raíz</a>
            <a href="#" data-tabs="plan"><i class="fas fa-tasks mr-4"></i>Plan de Acción</a>
        </div>
        <div class="card-body">

            <div class="caja_caja_secciones">

                <div class="caja_secciones">

                    <section id="registro" class="caja_tab_reveldada">
                        <div class="seccion_div">

                            <form class="row" method="POST"
                                action="{{ route('admin.desk.seguridad-update', $incidentesSeguridad) }}">
                                @csrf

                                <div class="form-group mt-1 col-12">
                                    <b>Datos generales:</b>
                                </div>

                                <div class="form-group mt-2 col-2">
                                    <label class="form-label"><i class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
                                    <div class="form-control" id="input_folio">{{ $incidentesSeguridad->folio }}</div>
                                </div>

                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Titulo corto del incidente</label>
                                    <input type="" name="titulo" value="{{ $incidentesSeguridad->titulo }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
                                    <select name="estatus" class="form-control">
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

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de ocurrencia del incidente</label>
                                    <input type="datetime" name="fecha" value="{{ $incidentesSeguridad->fecha }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de recepción del reporte</label>
                                        <div class="form-control">{{ $incidentesSeguridad->created_at }}</div>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha y hora de cierre del ticket</label>
                                        <div class="form-control">{{ $incidentesSeguridad->fecha_cierre }}</div>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Asignado a</label>
                                    <select name="empleado_asignado_id" class="form-control">
                                        <option value="" disabled selected></option>
                                        @foreach ($empleados as $empleado)
                                            <option
                                                {{ old('empleado_asignado_id', $incidentesSeguridad->empleado_asignado_id) ? 'selected' : '' }}
                                                value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-layer-group iconos-crear"></i>Categoría</label>
                                    <select id="select_categoria" class="form-control" value="{{ $incidentesSeguridad->categoria }}" name="categoria">
                                            @foreach($categorias as $categoria)
                                                <option id="categoria{{$categoria->id}}" value="{{ $categoria->id}}" class="">{{ $categoria->categoria }}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-adjust iconos-crear"></i>Subcategoría</label>
                                    <select id="select_subcategorias" class="form-control" value="{{ $incidentesSeguridad->subcategoria }}" name="subcatgoría">
                                            @foreach($subcategorias as $subcategoria)
                                                <option class="d-none categoria{{ $subcategoria->categoria->id}}" value="{{ $subcategoria->id}}">{{ $subcategoria->subcategoria }}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Sede</label>
                                    <select class="form-control" name="sede">
                                        <option disabled>seleccione sede</option>
                                        @foreach($sedes as $sede)
                                            <option value="{{ $sede->sede }}">{{ $sede->sede }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-8">
                                    <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación exacta</label>
                                    <input type="" name="ubicacion" class="form-control" value="{{$incidentesSeguridad->ubicacion}}">
                                </div>
                                

                                <div class="form-group mt-2 col-12">
                                    <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Descripción del incidente</label>
                                    <textarea name="descripcion" class="form-control">{{ $incidentesSeguridad->descripcion }}
                                    </textarea>
                                </div>

                                <div class="form-group mt-2 col-12 text-center">
                                    <button class="btn btn-danger">Evidencia</button>
                                </div>

                                <div class="form-group mt-2 col-4 areas_multiselect">
                                    <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i>Área(s) afectada(s)</label>
                                    <select class="form-control" id="activos">
                                        <option disabled selected>Seleccionar áreas</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->area }}">{{ $area->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="areas_afectados" class="form-control" id="texto_activos" required>{{ $incidentesSeguridad->areas_afectados }}</textarea>
                                </div>

                                <div class="form-group mt-2 col-4 procesos_multiselect">
                                    <label class="form-label"><i class="fas fa-dice-d20 iconos-crear"></i>Proceso(s) afectado(s)</label>
                                    <select class="form-control" id="activos">
                                        <option disabled selected>Seleccionar procesos</option>
                                        @foreach ($procesos as $proceso)
                                            <option value="{{ $proceso->nombre }}">{{ $proceso->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="procesos_afectados" class="form-control" id="texto_activos" required>{{ $incidentesSeguridad->procesos_afectados }}</textarea>
                                </div>

                                <div class="form-group mt-2 col-4 activos_multiselect">
                                    <label class="form-label"><i class="fa-fw fas fa-laptop iconos-crear"></i>Activo(s) afectado(s)</label>
                                    <select class="form-control" id="activos">
                                        <option disabled selected>Seleccionar afectados</option>
                                        @foreach ($activos as $activo)
                                            <option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="activos_afectados" class="form-control" id="texto_activos" required>{{ $incidentesSeguridad->activos_afectados }}</textarea>
                                </div>

                                

                                <div class="form-group mt-4 col-12">
                                    <b>Reportó incidente:</b>
                                </div>

                                <div class="form-group mt-0 col-4">
                                    <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->name }}</div>
                                </div>

                                <div class="form-group mt-0 col-4">
                                    <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->puesto }}</div>
                                </div>

                                <div class="form-group mt-0 col-4">
                                    <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i></i>Área</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->area->area }}</div>
                                </div>

                                <div class="form-group mt-2 col-6">
                                   <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->email }}</div>
                                </div>

                                <div class="form-group mt-2 col-6">
                                    <label class="form-label"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->telefono }}</div>
                                </div>


                                <div class="form-group mt-4 col-12">
                                    <b>Priorización del incidente:</b>
                                </div>


                                


                                

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-chart-line iconos-crear"></i>Urgencia</label>
                                    <select class="form-control" name="urgencia">
                                        <option>{{ $incidentesSeguridad->urgencia }}</option>
                                        <option>Alta</option>
                                        <option>Media</option>
                                        <option>Baja</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                                    <select class="form-control" name="impacto">
                                        <option>{{ $incidentesSeguridad->impacto }}</option>
                                        <option>Alta</option>
                                        <option>Media</option>
                                        <option>Baja</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label"><i class="fas fa-flag iconos-crear"></i>Prioridad</label>
                                    <select class="form-control" name="prioridad">
                                        <option>{{ $incidentesSeguridad->prioridad }}</option>
                                        <option>Alta</option>
                                        <option>Media</option>
                                        <option>Baja</option>
                                    </select>
                                </div>

                                



                                <div class="form-group mt-2 col-12">
                                    <label class="form-label"><i class="fas fa-comment-dots iconos-crear"></i>Comentarios</label>
                                    <textarea name="comentarios" class="form-control">{{ $incidentesSeguridad->comentarios }}</textarea>
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

                                <form method="POST" class="col-12" action="{{ route('admin.desk.analisis_seguridad-update', $analisis) }}">
                                    @csrf

                                    <div class="col-12" style="position: relative;">
                                         
                                            <div id="ideas" class="caja_oculta_dinamica row">
                                                <div class="form-group col-12">
                                                    <label>Ideas</label>
                                                    <textarea class="form-control" name="ideas">{{ $analisis->ideas }}</textarea>
                                                </div>

                                                <div class="form-group col-12">
                                                    <label>Causa Raíz</label>
                                                    <textarea class="form-control" name="causa">{{ $analisis->causa }}</textarea>
                                                </div>
                                            </div>



                                            <div id="porque" class="caja_oculta_dinamica row">
                                                <div class="form-group col-12">
                                                    Problema: <textarea class="form-control" name="">{{ $analisis->problema }}</textarea>
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
                                                    Causa Raíz: <textarea class="form-control" name="">{{ $analisis->causa }}</textarea>
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

                                                        <textarea name="problema" class="problemas_txtarea">{{ $analisis->problema }}</textarea>
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
                            <div class="" style="position: relative; ">
                            <h5 style="position: ;"><b>Acciones para la Atención del Incidente</b></h5>
                                <a href="#" style="position:absolute; right: 2px; top:2px;" class="btn btn-success">Agregar actividad</a>
                            </div>
                            <div class="datatable-fix mt-4" style="width: 100%;">
                                <table id="tabla_plan_accion" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Actividad</th>
                                            <th>Fecha&nbsp;de&nbsp;inicio</th>
                                            <th>Fecha&nbsp;de&nbsp;fin</th>
                                            <th>Prioridad</th>
                                            <th>Tipo</th>
                                            <th>Responsable(s)</th>
                                            <th>Estatus</th>
                                            <th>Comentarios</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                                <td>numero consecutivo</td>
                                            <td>text camp</td>
                                            <td>date camp</td>
                                            <td>date camp</td>
                                            <td>select, alta media baja</th>
                                            <td>select, accion inmediata, accion subsecuente, accion posterior</th>
                                            <td>slect silta de empleados</td>
                                            <td>select no iniciado, en proceso, terminado</td>
                                            <td>textarea</td>
                                            <td>botones</td>
                                        </tr>
                                        <tr>
                                            <td>replicar en forms</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <tfoot>
                                    <tr>
                                        Si lo requiere puede generar un plan de trabajo completo para la atencion del incidente.
                                        <br>
                                        <i>agregar enlaces</i>
                                    </tr>
                                </tfoot>
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
                let texto_activos = document.querySelector('.procesos_multiselect #texto_activos');

                texto_activos.value += `${this.value}, `;

            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('.activos_multiselect #activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('.activos_multiselect #texto_activos');

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
        $(document).on('change', '#select_categoria', function(event) {
            $("#select_subcategorias option").addClass("d-none");
            var categoria_selected = $("#select_categoria option:selected").attr('id');
            $(document.getElementsByClassName(categoria_selected)).removeClass("d-none");
        });
    </script>
@endsection
