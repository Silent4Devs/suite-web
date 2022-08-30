<div class="seccion_div">
    <div class="row">


        <form method="POST" class="col-12"
            action="{{ route('admin.accion-correctivas.storeAnalisis', $accionCorrectiva->id) }}">
            @csrf
            <div class="px-1 py-2 mx-3 mt-3 mb-4 rounded shadow"
                style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
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
                <div class="form-group mt-2 col-md-4 ml-4">
                    <label><i class="fas fa-check-square iconos-crear"></i>Seleccione el método de análisis</label>
                </div>
                <div class="col-md-7">
                    <select id="select_metodos" class="form-control" name="metodo">
                        <option selected disabled>- -</option>
                        <option
                            {{ old('Lluvia de ideas (Brainstorming)', $analisis ? $analisis->metodo : '') =='Lluvia de ideas (Brainstorming)'? 'selected': '' }}
                            class="op_ideas" data-metodo="ideas">Lluvia de ideas (Brainstorming)
                        </option>
                        <option
                            {{ old('5 Porqués (5 Why)', $analisis ? $analisis->metodo : '') == '5 Porqués (5 Why)' ? 'selected' : '' }}
                            class="op_porque" data-metodo="porque">5 Porqués (5 Why)</option>
                        <option
                            {{ old('Diagrama causa efecto (Ishikawa)', $analisis ? $analisis->metodo : '') =='Diagrama causa efecto (Ishikawa)'? 'selected': '' }}
                            class="op_digrama" data-metodo="digrama">Diagrama causa efecto (Ishikawa)
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-12" style="position: relative;">

                <div id="ideas" class="caja_oculta_dinamica row">
                    <div class="form-group col-12">
                        <label>Ideas</label>
                        <textarea class="form-control" id="escritura_ideas" name="ideas">{{ $analisis ? $analisis->ideas : '' }}</textarea>

                    </div>

                    {{-- <div class="form-group col-12">
                        <label>Causa Raíz</label>
                        <textarea class="form-control" id="escritura_causa" name="causa_ideas">{{$analisis?$analisis->causa_ideas:''}}</textarea>
                    </div> --}}
                </div>



                <div id="porque" class="caja_oculta_dinamica row">
                    <div class="form-group col-12">
                        <label>Problema:</label>
                        <textarea class="form-control" name="problema_porque">{{ $analisis ? $analisis->problema_porque : '' }}</textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>1. ¿Por qué?</label>
                        <textarea name="porque_1" class="form-control">{{ $analisis ? $analisis->porque_1 : '' }}</textarea>
                        <label class="mt-4">2. ¿Por qué?</label>
                        <textarea name="porque_2" class="form-control">{{ $analisis ? $analisis->porque_2 : '' }}</textarea>
                        <label class="mt-4">3. ¿Por qué?</label>
                        <textarea name="porque_3" class="form-control">{{ $analisis ? $analisis->porque_3 : '' }}</textarea>
                        <label class="mt-4">4. ¿Por qué?</label>
                        <textarea name="porque_4" class="form-control">{{ $analisis ? $analisis->porque_4 : '' }}</textarea>
                        <label class="mt-4">5. ¿Por qué?</label>
                        <textarea name="porque_5" class="form-control">{{ $analisis ? $analisis->porque_5 : '' }}</textarea>
                    </div>
                    {{-- <div class="form-group col-12">
                        Causa Raíz: <textarea class="form-control"
                            name="causa_porque">{{ $analisis?$analisis->causa_porque:'' }}</textarea>
                    </div> --}}
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
                                style="top:60px; left:290px; position: absolute; height:30px !important;">
                                <textarea name="control_a" class="politicas_txtarea"
                                    id="analisisControl">{{ $analisis ? $analisis->control_a : '' }}</textarea>
                                @error('control_a')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror    
                            </div>
                            
                            {{-- <textarea name="control_b"
                                class="politicas_txtarea txt_obj_secundarios_a">{{ $analisis ? $analisis->control_b : '' }}</textarea> --}}
                            <div class="col-6"
                                style="top:60px; left:810px; position: absolute; height:30px !important;">
                                <textarea name="proceso_a" class="procesos_txtarea"
                                    id="analisisProceso">{{ $analisis ? $analisis->proceso_a : '' }}</textarea>
                                @error('proceso_a')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <textarea name="proceso_b"
                                class="procesos_txtarea txt_obj_secundarios_a">{{ $analisis ? $analisis->proceso_b : '' }}</textarea> --}}
                            <div class="col-6"
                                style="top:60px; left:1315px; position: absolute; height:30px !important;">
                                <textarea name="personas_a" class="personas_txtarea"
                                    id="analisisPersona">{{ $analisis ? $analisis->personas_a : '' }}</textarea>
                                @error('personas_a')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <textarea name="personas_b"
                                class="personas_txtarea txt_obj_secundarios_a">{{ $analisis ? $analisis->personas_b : '' }}</textarea> --}}
                            <div class="col-6" style="bottom:5px; right:380px; position: absolute;">
                                <textarea name="tecnologia_a" class="tecnologia_txtarea txt_obj_secundarios_b"
                                    id="analisisTecnologia">{{ $analisis ? $analisis->tecnologia_a : '' }}</textarea>
                                @error('tecnologia_a')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <textarea name="tecnologia_b" class="tecnologia_txtarea ">{{ $analisis ? $analisis->tecnologia_b : '' }}</textarea> --}}
                            <div class="col-6" style="bottom:5px; left:540px; position: absolute;">
                                <textarea name="metodos_a" id="analisisMetodos"
                                    class="metodos_txtarea txt_obj_secundarios_b">{{ $analisis ? $analisis->metodos_a : '' }}</textarea>
                                @error('metodos_a')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <textarea name="metodos_b" class="metodos_txtarea ">{{ $analisis ? $analisis->metodos_b : '' }}</textarea> --}}
                            <div class="col-6" style="bottom:5px; left:1060px; position: absolute;">
                                <textarea name="ambiente_a"
                                    class="ambiente_txtarea txt_obj_secundarios_b" id="analisisAmbiente">{{ $analisis ? $analisis->ambiente_a : '' }}</textarea>
                                @error('ambiente_a')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <textarea name="ambiente_b" class="ambiente_txtarea ">{{ $analisis ? $analisis->ambiente_b : '' }}</textarea> --}}
                            <div class="col-6" style="bottom:5px; left:1600px; position: absolute;">
                                <textarea name="problema_diagrama"
                                    class="problemas_txtarea" id="analisisProblema">{{ $analisis ? $analisis->problema_diagrama : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <input type="submit" class="btn btn-success" value="Guardar">
            </div>
            {{-- <div class="py-3 text-right col-12">
            </div> --}}
        </form>
    </div>

</div>
