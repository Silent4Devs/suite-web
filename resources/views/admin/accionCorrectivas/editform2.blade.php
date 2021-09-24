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

        <form method="POST" class="col-12"
            action="{{ route('admin.desk.analisis_queja-update', $accionCorrectiva->id) }}">
            @csrf

            <div class="col-12" style="position: relative;">

                <div id="ideas" class="caja_oculta_dinamica row">
                    <div class="form-group col-12">
                        <label>Ideas</label>
                        <textarea class="form-control"
                            name="ideas">{{ $accionCorrectiva->ideas }}</textarea>
                    </div>

                    <div class="form-group col-12">
                        <label>Causa Raíz</label>
                        <textarea class="form-control"
                            name="causa_ideas">{{ $accionCorrectiva->causa_ideas }}</textarea>
                    </div>
                </div>



                <div id="porque" class="caja_oculta_dinamica row">
                    <div class="form-group col-12">
                        Problema: <textarea class="form-control"
                            name="problema_porque">{{ $accionCorrectiva->problema_porque }}</textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>1er porqué:</label>
                        <input name="porque_1" class="form-control"
                            value="{{ $accionCorrectiva->porque_1 }}">
                        <label>2do porqué:</label>
                        <input name="porque_2" class="form-control"
                            value="{{ $accionCorrectiva->porque_2 }}">
                        <label>3er porqué:</label>
                        <input name="porque_3" class="form-control"
                            value="{{ $accionCorrectiva->porque_3 }}">
                        <label>4to porqué:</label>
                        <input name="porque_4" class="form-control"
                            value="{{ $accionCorrectiva->porque_4 }}">
                        <label>5to porqué:</label>
                        <input name="porque_5" class="form-control"
                            value="{{ $accionCorrectiva->porque_5 }}">
                    </div>
                    <div class="form-group col-12">
                        Causa Raíz: <textarea class="form-control"
                            name="causa_porque">{{ $accionCorrectiva->causa_porque }}</textarea>
                    </div>
                </div>



                <div id="digrama" class="caja_oculta_dinamica">
                    <div class="mt-5 col-12" style="overflow: auto;">
                        <div style="width: 100%; min-width:540px; position: relative;">
                            <img src="{{ asset('img/diagrama_causa_raiz.png') }}"
                                style="width:100%">

                            <textarea name="control_a"
                                class="politicas_txtarea">{{ $accionCorrectiva->control_a }}</textarea>
                            <textarea name="control_b"
                                class="politicas_txtarea txt_obj_secundarios_a">{{ $accionCorrectiva->control_b }}</textarea>

                            <textarea name="proceso_a"
                                class="procesos_txtarea">{{ $accionCorrectiva->proceso_a }}</textarea>
                            <textarea name="proceso_b"
                                class="procesos_txtarea txt_obj_secundarios_a">{{ $accionCorrectiva->proceso_b }}</textarea>

                            <textarea name="personas_a"
                                class="personas_txtarea">{{ $accionCorrectiva->personas_a }}</textarea>
                            <textarea name="personas_b"
                                class="personas_txtarea txt_obj_secundarios_a">{{ $accionCorrectiva->personas_b }}</textarea>

                            <textarea name="tecnologia_a"
                                class="tecnologia_txtarea txt_obj_secundarios_b">{{ $accionCorrectiva->tecnologia_a }}</textarea>
                            <textarea name="tecnologia_b"
                                class="tecnologia_txtarea ">{{ $accionCorrectiva->tecnologia_b }}</textarea>

                            <textarea name="metodos_a"
                                class="metodos_txtarea txt_obj_secundarios_b">{{ $accionCorrectiva->metodos_a }}</textarea>
                            <textarea name="metodos_b"
                                class="metodos_txtarea ">{{ $accionCorrectiva->metodos_b }}</textarea>

                            <textarea name="ambiente_a"
                                class="ambiente_txtarea txt_obj_secundarios_b">{{ $accionCorrectiva->ambiente_a }}</textarea>
                            <textarea name="ambiente_b"
                                class="ambiente_txtarea ">{{ $accionCorrectiva->ambiente_b }}</textarea>

                            <textarea name="problema_diagrama"
                                class="problemas_txtarea">{{ $accionCorrectiva->problema_diagrama }}</textarea>
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
