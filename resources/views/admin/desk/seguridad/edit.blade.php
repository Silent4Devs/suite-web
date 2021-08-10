@extends('layouts.admin')
@section('content')


    <style type="text/css">
        #desk .caja_botones {
            display: flex;
        }

        #desk .caja_botones a {
            width: 33.33%;
            text-decoration: none;
            display: inline-block;
            color: #008186;
            padding: 5px 0px;
            border-top: 1px solid #ccc !important;
            border-right: 1px solid #ccc;
            background-color: #f9f9f9;
            margin: 0;
            text-align: center;
            align-items: center;
        }

        #desk .caja_botones a:first-child {
            border-left: 1px solid #ccc;
        }

        #desk .caja_botones a:not(#desk .caja_botones a.btn_activo) {
            border-bottom: 1px solid #ccc;
        }

        #desk .caja_botones a i {
            margin-right: 7px;
            font-size: 15pt;
        }

        #desk .caja_botones a.btn_activo,
        #desk .caja_botones a.btn_activo:hover {
            background-color: #fff;
        }

        #desk .caja_botones a:hover {
            background-color: #f1f1f1;
        }


        #desk .caja_caja_secciones {
            width: 100%;
        }

        #desk .caja_secciones {
            width: 100%;
            display: flex;
        }

        #desk .caja_secciones section {
            width: 0px;
            overflow: hidden;
            transition: 0.4s;
            opacity: 0;
        }

        .caja_tab_reveldada {
            width: 100% !important;
            overflow: none;
            opacity: 1 !important;
        }

        .seccion_div {
            overflow: hidden;
            width: 990px;
        }

        .caja_tab_reveldada .seccion_div {
            overflow: hidden;
            transition-delay: 0.5s;
            width: 100%;
        }

        .caja_oculta_dinamica {
            display: none;
        }


        #digrama textarea {
            position: absolute;
            background-color: #f1f1f1;
            width: 200px;
            min-height: 70px !important;
            max-height: 70px !important;
            border: none;
            box-shadow: none;
            border-radius: 6px;
            resize: none;
        }

        .politicas_txtarea {
            top: 40px;
            left: calc(50% - 380px);
        }

        .procesos_txtarea {
            top: 40px;
            left: calc(50% - 120px);
        }

        .personas_txtarea {
            top: 40px;
            left: calc(50% + 150px);
        }

        .tecnologia_txtarea {
            top: 230px;
            left: calc(50% - 470px);
        }

        .metodos_txtarea {
            top: 230px;
            left: calc(50% - 200px);
        }

        .ambiente_txtarea {
            top: 230px;
            left: calc(50% + 70px);
        }

        .problemas_txtarea {
            top: 270px;
            right: 0px;
            width: 150px !important;
        }

        .txt_obj_secundarios_a {
            margin-top: 80px;
            margin-left: 20px;
            background-color: #e1e1e1 !important;
        }

        .txt_obj_secundarios_b {
            margin-top: 80px;
            margin-left: -20px;
            background-color: #e1e1e1 !important;
        }

    </style>


    <div class="card" id="desk">
        <div class="card-header text-center" style="background-color: #00abb2;">
            <strong style="font-size: 16pt; color: #fff;"><i class="fas fa-exclamation-triangle mr-4"></i>Incidentes de
                seguridad</strong>
        </div>
        <div class="caja_botones">
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

                                <div class="form-group mt-2 col-2">
                                    <label class="form-label">Folio</label>
                                    <div class="form-control" id="input_folio">{{ $incidentesSeguridad->folio }}</div>
                                </div>

                                <div class="form-group mt-2 col-5">
                                    <label class="form-label">Título</label>
                                    <input type="" name="titulo" value="{{ $incidentesSeguridad->titulo }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mt-2 col-5">
                                    <label class="form-label">Estatus</label>
                                    <select name="estatus" class="form-control">
                                        <option
                                            {{ old('estatus', $incidentesSeguridad->estatus) == 'nuevo' ? 'selected' : '' }}
                                            value="nuevo">nuevo</option>
                                        <option
                                            {{ old('estatus', $incidentesSeguridad->estatus) == 'en curso' ? 'selected' : '' }}
                                            value="en curso">en curso</option>
                                        <option
                                            {{ old('estatus', $incidentesSeguridad->estatus) == 'en espera' ? 'selected' : '' }}
                                            value="en espera">en espera</option>
                                        <option
                                            {{ old('estatus', $incidentesSeguridad->estatus) == 'cerrado' ? 'selected' : '' }}
                                            value="cerrado">cerrado</option>
                                        <option
                                            {{ old('estatus', $incidentesSeguridad->estatus) == 'cancelado' ? 'selected' : '' }}
                                            value="cancelado">cancelado</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Fecha y hora de ocurrencia del incidente</label>
                                    <input type="datetime" name="fecha" value="{{ $incidentesSeguridad->fecha }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Fecha y hora de recepcion del reporte</label>
                                    <input type="datetime" name="fecha" value="{{ $incidentesSeguridad->fecha }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Fecha y hora de cierre del incidente</label>
                                    <input type="datetime" name="fecha" value="{{ $incidentesSeguridad->fecha }}"
                                        class="form-control">
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Reportó</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->name }}</div>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Correo</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->email }}</div>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Teléfono</label>
                                    <div class="form-control">{{ $incidentesSeguridad->reporto->telefono }}</div>
                                </div>


                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Categoría</label>
                                    <select class="form-control" value="{{ $incidentesSeguridad->categoria }}"
                                        name="categoria"></select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Subcategoría</label>
                                    <select class="form-control" value="{{ $incidentesSeguridad->subcategoria }}"
                                        name="subcatgoría"></select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Asignado a</label>
                                    <select name="empleado_asignado_id" class="form-control">
                                        <option value="}" disabled selected></option>
                                        @foreach ($empleados as $empleado)
                                            <option
                                                {{ old('empleado_asignado_id', $incidentesSeguridad->empleado_asignado_id) ? 'selected' : '' }}
                                                value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Urgencia</label>
                                    <select class="form-control" value="{{ $incidentesSeguridad->prioridad }}"
                                        name="prioridad">
                                        <option name="alta">Alta</option>
                                        <option name="media">Media</option>
                                        <option name="baja">Baja</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Impacto</label>
                                    <select class="form-control" value="{{ $incidentesSeguridad->prioridad }}"
                                        name="prioridad">
                                        <option name="alta">Alta</option>
                                        <option name="media">Media</option>
                                        <option name="baja">Baja</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Prioridad</label>
                                    <select class="form-control" value="{{ $incidentesSeguridad->prioridad }}"
                                        name="prioridad">
                                        <option name="alta">Alta</option>
                                        <option name="media">Media</option>
                                        <option name="baja">Baja</option>
                                    </select>
                                </div>


                                <div class="form-group mt-2 col-12">
                                    <label class="form-label">Describa detalladamente el incidente</label>
                                    <textarea name="descripcion" class="form-control">{{ $incidentesSeguridad->descripcion }}
                                    </textarea>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Áreas afectadas</label>
                                    <select class="form-control" id="activos">
                                        <option disabled selected>Seleccionar áreas</option>
                                        @foreach ($activos as $activo)
                                            <option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="activos_afectados" class="form-control" id="texto_activos"
                                        required>{{ $incidentesSeguridad->activos_afectados }}</textarea>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Procesos afectados</label>
                                    <select class="form-control" id="activos">
                                        <option disabled selected>Seleccionar procesos</option>
                                        @foreach ($activos as $activo)
                                            <option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="activos_afectados" class="form-control" id="texto_activos"
                                        required>{{ $incidentesSeguridad->activos_afectados }}</textarea>
                                </div>

                                <div class="form-group mt-2 col-4">
                                    <label class="form-label">Activos afectados</label>
                                    <select class="form-control" id="activos">
                                        <option disabled selected>Seleccionar afectados</option>
                                        @foreach ($activos as $activo)
                                            <option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <textarea name="activos_afectados" class="form-control" id="texto_activos"
                                        required>{{ $incidentesSeguridad->activos_afectados }}</textarea>
                                </div>



                                <div class="form-group mt-2 col-12">
                                    <label class="form-label">Comentarios</label>
                                    <textarea name="comentarios"
                                        class="form-control">{{ $incidentesSeguridad->comentarios }}</textarea>
                                </div>

                                <div class="form-group mt-2 text-right col-12">
                                    <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cancelar</a>
                                    <input type="submit" name="" class="btn btn-success" value="Enviar">
                                </div>
                            </form>
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

                </div>

            </div>

        </div>
    </div>
@endsection



@section('scripts')
    @parent
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('#activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('#texto_activos');

                texto_activos.value += `${this.value}, `;

            });


            function padLeftWithBounds(input, padChar, maxLength, min, max) {
                if (input <= min)
                    return min;
                if (input >= max)
                    return max;

                var s = input.toString(10);
                var padding = "";
                for (var i = 0; i < maxLength; ++i)
                    padding += padChar;

                return padding.substring(0, maxLength - s.length) + s;
            };

            $("#input_folio").on("keyup", function() {
                if (!$(this).val())
                    return;
                $(this).val(padLeftWithBounds(parseInt($(this).val()), '0', 3, 0, 999));
            });
        });
    </script>





    <script type="text/javascript">
        $(".caja_botones a").click(function() {
            $(".caja_botones a").removeClass("btn_activo");
            $(".caja_botones a:hover").addClass("btn_activo");
        });
    </script>


    <script type="text/javascript">
        $(".caja_botones a").click(function() {
            $("section").removeClass("caja_tab_reveldada");
            var id_seccion = $(".caja_botones a:hover").attr('data-tabs');
            $(document.getElementById(id_seccion)).addClass("caja_tab_reveldada");
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
