<div class="col-12">
    <div class="form-group">
        <div class="row">
            <div class="col-10">
                <div class="row">
                    <div class="col-7">
                        <label>Competencia <span class="text-danger">*</span></label>
                        <select class="form-control" name="competencia_id" id="competencia_id">
                            <option value="" selected disabled>-- Selecciona un competencia --</option>
                            @foreach ($competencias as $competencia)
                                <option value="{{ $competencia->id }}" data-description="{{$competencia->descripcion}}">{{ $competencia->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger errores error_competencia_id"></small>
                    </div>
                    <div class="col-5">
                        <label>Nivel esperado <span class="text-danger">*</span>
                            <span id="niveles_cargando" class="d-none"><i
                                    class="fas fa-circle-notch fa-spin"></i>
                                Cargando niveles</span>
                            {{-- <span title="Diccionario de competencia" id="visualizarSignificado" class="text-muted d-none"><i
                                    class="fas fa-info-circle"></i></span> --}}
                        </label>
                        <div class="row">
                            <div class="pr-0 col-5">
                                <select class="form-control" name="nivel_esperado" id="nivel_esperado"></select>
                            </div>
                            <div class="p-0 col-7">
                                <button id="visualizarSignificado" class="h-100 btn btn-sm btn_cancelar"
                                    style="margin-left: 16px;"><i class="mr-2 fas fa-book"></i>Diccionario</button>
                            </div>
                        </div>
                        <small class="text-danger errores error_nivel_esperado"></small>
                    </div>
                </div>
            </div>
            <div class="pl-0 col">
                <label for="">&nbsp;</label>
                <div style="height: 37px;">
                    <button id="asignarBtn" class="w-100 h-100 btn btn-sm btn-success"><i
                            class="mr-2 fas fa-sync"></i>Asignar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="competenciaModal" tabindex="-1" aria-labelledby="competenciaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_competencia"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="padding-left: 20px; padding-right:20px;text-align: justify;">
                    <p id="descripcion_competencia"></p>
                </div>
                <div class="pb-0 modal-body">
                    <div class="row"
                        style="font-size: 12px;font-weight: bold; border-bottom:2px solid #585858">
                        <div class="text-center col-sm-1 col-lg-1">
                            Nivel
                        </div>
                        <div class="text-center col-sm-11 col-lg-11">
                            Conducta Esperada
                        </div>
                    </div>
                    <div id="competenciaInformacion"></div>
                </div>
                {{-- <div class="modal-footer">
                   <button type="button" class="btn_cancelar" data-dismiss="modal">Cerrar</button>
               </div> --}}
            </div>
        </div>
    </div>
</div>
