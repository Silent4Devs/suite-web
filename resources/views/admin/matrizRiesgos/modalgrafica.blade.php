<!-- Modal -->
<div class="modal fade" id="graficaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gráfica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-around" align="center">
                    <div>
                        <h5>Sede</h5>
                        <select class="sedeSelect" name="sede" id="sede">
                            <option value="">Seleccion una opción</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h5>Área</h5>
                        <select class="areaSelect" name="area" id="area">
                            <option value="">Seleccion una opción</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h5>Proceso</h5>
                        <select class="sedeSelect" name="state">
                            <option value="">Seleccion una opción</option>
                            @foreach ($procesos as $proceso)
                                <option value="{{ $proceso->id }}">{{ $proceso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="calor">
                    <div class="datosCalor">
                        <label>Severidad</label>
                        <div class="barra1" id="s_baja">Baja</div>
                        <div class="barra1" id="s_media">Media</div>
                        <div class="barra1" id="s_alta">Alta</div>
                        <div class="barra1" id="s_muyAlta">Muy Alta</div>

                        <label>Probabilidad</label>
                        <div class="barra2" id="p_baja">Baja</div>
                        <div class="barra2" id="p_media">Media</div>
                        <div class="barra2" id="p_alta">Alta</div>
                        <div class="barra2" id="p_muyAlta">Muy Alta</div>

                        <label>Riesgo</label>
                        <div class="barra3" id="r_baja">Baja</div>
                        <div class="barra3" id="r_media">Media</div>
                        <div class="barra3" id="r_alta">Alta</div>
                        <div class="barra3" id="r_muyAlta">Muy Alta</div>
                    </div>
                    <div class="mapaCalor">
                        <div class="txtVertical">Probabilidad</div>
                        <table>
                            <tr>
                                <td>Muy Alta</td>
                                <td class="amarillo" id="s_baja_p_muyAlta"></td>
                                <td class="naranja" id="s_media_p_muyAlta"></td>
                                <td class="rojo" id="s_alta_p_muyAlta"></td>
                                <td class="rojo" id="s_muyAlta_p_muyAlta"></td>
                            </tr>
                            <tr>
                                <td>Alta</td>
                                <td class="amarillo" id="s_baja_p_alta"></td>
                                <td class="naranja" id="s_media_p_alta"></td>
                                <td class="naranja" id="s_alta_p_alta"></td>
                                <td class="rojo" id="s_muyAlta_p_alta"></td>
                            </tr>
                            <tr>
                                <td>Media</td>
                                <td class="verde" id="s_baja_p_media"></td>
                                <td class="amarillo" id="s_media_p_media"></td>
                                <td class="naranja" id="s_alta_p_media"></td>
                                <td class="naranja" id="s_muyAlta_p_media"></td>
                            </tr>
                            <tr>
                                <td>Baja</td>
                                <td class="verde" id="s_baja_p_baja"></td>
                                <td class="verde" id="s_media_p_baja"></td>
                                <td class="amarillo" id="s_alta_p_baja"></td>
                                <td class="amarillo" id="s_muyAlta_p_baja"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Baja</td>
                                <td>Media</td>
                                <td>Alta</td>
                                <td>Muy Alta</td>
                            </tr>
                        </table>
                        <div class="txtHorizontal">Severidad</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
