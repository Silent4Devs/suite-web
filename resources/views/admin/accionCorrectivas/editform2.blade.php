<div class="seccion_div">
    <div class="row">


        <form method="POST" class="col-12"
            action="{{ route('admin.accion-correctivas.storeAnalisis', $accionCorrectiva->id) }}">
            @csrf
            <div class="px-1 py-2 mx-3 mt-3 mb-4 rounded shadow"
                style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Al final de
                            cada formulario dé clic en el botón guardar antes de cambiar de pestaña,
                            de lo contrario la información capturada no será guardada.
                        </p>

                    </div>
                </div>
            </div>
            <div class="mb-1 text-primary ">
                <strong style="font-size:13pt;">Folio: {{ $accionCorrectiva->folio }}</strong>
            </div>

            <div class="row">
                <div class="mt-3 col-md-4">
                    Seleccione el metódo de análisis
                </div>
                <div class="col-md-8">
                    <select id="select_metodos" class="form-control" name="metodo">
                        <option selected disabled>- -</option>
                        <option
                            {{ old('Lluvia de ideas (Brainstorming)', $analisis?$analisis->metodo:'') == 'Lluvia de ideas (Brainstorming)' ? 'selected' : '' }}
                            class="op_ideas" data-metodo="ideas">Lluvia de ideas (Brainstorming)
                        </option>
                        <option
                        {{ old('5 Porqués (5 Why)', $analisis?$analisis->metodo:'') == '5 Porqués (5 Why)' ? 'selected' : '' }}
                             class="op_porque" data-metodo="porque">5 Porqués (5 Why)</option>
                        <option
                            {{ old('Diagrama causa efecto (Ishikawa)', $analisis?$analisis->metodo:'') == 'Diagrama causa efecto (Ishikawa)' ? 'selected' : '' }}
                            class="op_digrama" data-metodo="digrama">Diagrama causa efecto (Ishikawa)
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-12" style="position: relative;">

                <div id="ideas" class="caja_oculta_dinamica row">
                    <div class="form-group col-12">
                        <label>Ideas</label>
                        <textarea class="form-control" name="ideas">{{$analisis?$analisis->idea:''}}</textarea>
                    </div>

                    <div class="form-group col-12">
                        <label>Causa Raíz</label>
                        <textarea class="form-control" name="causa_ideas">{{$analisis?$analisis->causa_ideas:''}}</textarea>
                    </div>
                </div>



                <div id="porque" class="caja_oculta_dinamica row">
                    <div class="form-group col-12">
                        Problema: <textarea class="form-control"
                            name="problema_porque">{{$analisis?$analisis->problema_porque:''}}</textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>1er porqué:</label>
                        <input name="porque_1" class="form-control" value="{{ $analisis?$analisis->porque_1:'' }}">
                        <label>2do porqué:</label>
                        <input name="porque_2" class="form-control" value="{{ $analisis?$analisis->porque_2:'' }}">
                        <label>3er porqué:</label>
                        <input name="porque_3" class="form-control" value="{{ $analisis?$analisis->porque_3:'' }}">
                        <label>4to porqué:</label>
                        <input name="porque_4" class="form-control" value="{{ $analisis?$analisis->porque_4:'' }}">
                        <label>5to porqué:</label>
                        <input name="porque_5" class="form-control" value="{{ $analisis?$analisis->porque_5:'' }}">
                    </div>
                    <div class="form-group col-12">
                        Causa Raíz: <textarea class="form-control"
                            name="causa_porque">{{ $analisis?$analisis->causa_porque:'' }}</textarea>
                    </div>
                </div>



                <div id="digrama" class="caja_oculta_dinamica">
                    <div class="mt-5 col-12" style="overflow: auto;">
                        <div style="width: 100%; min-width:540px; position: relative;">
                            <img src="{{ asset('img/diagrama_causa_raiz.png') }}" style="width:100%">

                            <textarea name="control_a"
                                class="politicas_txtarea">{{ $analisis?$analisis->control_a:'' }}</textarea>
                            <textarea name="control_b"
                                class="politicas_txtarea txt_obj_secundarios_a">{{ $analisis?$analisis->control_b:'' }}</textarea>

                            <textarea name="proceso_a" class="procesos_txtarea">{{ $analisis?$analisis->proceso_a:'' }}</textarea>
                            <textarea name="proceso_b"
                                class="procesos_txtarea txt_obj_secundarios_a">{{ $analisis?$analisis->proceso_b:'' }}</textarea>

                            <textarea name="personas_a"
                                class="personas_txtarea">{{ $analisis?$analisis->personas_a:'' }}</textarea>
                            <textarea name="personas_b"
                                class="personas_txtarea txt_obj_secundarios_a">{{ $analisis?$analisis->personas_b:'' }}</textarea>

                            <textarea name="tecnologia_a"
                                class="tecnologia_txtarea txt_obj_secundarios_b">{{ $analisis?$analisis->tecnologia_a:'' }}</textarea>
                            <textarea name="tecnologia_b"
                                class="tecnologia_txtarea ">{{ $analisis?$analisis->tecnologia_b:'' }}</textarea>

                            <textarea name="metodos_a"
                                class="metodos_txtarea txt_obj_secundarios_b">{{ $analisis?$analisis->metodos_a:'' }}</textarea>
                            <textarea name="metodos_b" class="metodos_txtarea ">{{ $analisis?$analisis->metodos_b:'' }}</textarea>

                            <textarea name="ambiente_a"
                                class="ambiente_txtarea txt_obj_secundarios_b">{{ $analisis?$analisis->ambiente_a:'' }}</textarea>
                            <textarea name="ambiente_b"
                                class="ambiente_txtarea ">{{ $analisis?$analisis->ambiente_b:'' }}</textarea>

                            <textarea name="problema_diagrama"
                                class="problemas_txtarea">{{ $analisis?$analisis->problema_diagrama:'' }}</textarea>
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
