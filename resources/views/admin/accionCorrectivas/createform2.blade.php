@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularios_centro_atencion.css') }}">
@endsection

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
                        <textarea class="form-control"
                            name="ideas"></textarea>
                    </div>

                    <div class="form-group col-12">
                        <label>Causa Raíz</label>
                        <textarea class="form-control"
                            name="causa_ideas"></textarea>
                    </div>
                </div>



                <div id="porque" class="caja_oculta_dinamica row">
                    <div class="form-group col-12">
                        Problema: <textarea class="form-control"
                            name="problema_porque"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>1er porqué:</label>
                        <input name="porque_1" class="form-control"
                            value="">
                        <label>2do porqué:</label>
                        <input name="porque_2" class="form-control"
                            value="">
                        <label>3er porqué:</label>
                        <input name="porque_3" class="form-control"
                            value="">
                        <label>4to porqué:</label>
                        <input name="porque_4" class="form-control"
                            value="">
                        <label>5to porqué:</label>
                        <input name="porque_5" class="form-control"
                            value="">
                    </div>
                    <div class="form-group col-12">
                        Causa Raíz: <textarea class="form-control"
                            name="causa_porque"></textarea>
                    </div>
                </div>



                <div id="digrama" class="caja_oculta_dinamica">
                    <div class="mt-5 col-12" style="overflow: auto;">
                        <div style="width: 100%; min-width:540px; position: relative;">
                            <img src="{{ asset('img/diagrama_causa_raiz.png') }}"
                                style="width:100%">

                            <textarea name="control_a"
                                class="politicas_txtarea"></textarea>
                            <textarea name="control_b"
                                class="politicas_txtarea txt_obj_secundarios_a"></textarea>

                            <textarea name="proceso_a"
                                class="procesos_txtarea"></textarea>
                            <textarea name="proceso_b"
                                class="procesos_txtarea txt_obj_secundarios_a"></textarea>

                            <textarea name="personas_a"
                                class="personas_txtarea"></textarea>
                            <textarea name="personas_b"
                                class="personas_txtarea txt_obj_secundarios_a"></textarea>

                            <textarea name="tecnologia_a"
                                class="tecnologia_txtarea txt_obj_secundarios_b"></textarea>
                            <textarea name="tecnologia_b"
                                class="tecnologia_txtarea "></textarea>

                            <textarea name="metodos_a"
                                class="metodos_txtarea txt_obj_secundarios_b"></textarea>
                            <textarea name="metodos_b"
                                class="metodos_txtarea "></textarea>

                            <textarea name="ambiente_a"
                                class="ambiente_txtarea txt_obj_secundarios_b"></textarea>
                            <textarea name="ambiente_b"
                                class="ambiente_txtarea "></textarea>

                            <textarea name="problema_diagrama"
                                class="problemas_txtarea"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right form-group col-12">
                <a href="{{ route('admin.accion-correctivas.index') }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit" id="btnGuardar">
                    {{ trans('global.save') }}
                </button>
                {{-- <button id="form-siguienteaccion" data-toggle="collapse" onclick="closetabcollanext2()" data-target="#collapseplan" class="btn btn-danger">Siguiente</button> --}}
            </div>
        </form>
    </div>
</div>



