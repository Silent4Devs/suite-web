<style>
    .calor {
        width: 100%;
        margin-top: 30px;
        float: left;
    }

    .datosCalor {
        width: 40%;
        float: left;
    }

    .datosColor label {
        font-family: maven regular;
    }

    .barra1 {
        width: 100%;
        height: 25px;
        float: left;
        box-shadow: -3px 3px 3px 0px #999;
        border-radius: 50px;
        font-family: maven regular;
        text-align: center;
        padding-top: 5px;
        color: #fff;
    }

    #s_baja {
        background-color: #18a827;
        display: none;
    }

    #s_media {
        background-color: #eef100;
        display: none;
        color: #000;
    }

    #s_alta {
        background-color: #ff9600;
        display: none;
    }

    #s_muyAlta {
        background-color: #cb0000;
        display: none;
    }

    .barra2 {
        width: 100%;
        height: 25px;
        float: left;
        box-shadow: -3px 3px 3px 0px #999;
        border-radius: 50px;
        font-family: maven regular;
        text-align: center;
        padding-top: 5px;
        color: #fff;
    }

    #p_baja {
        background-color: #18a827;
        display: none;
    }

    #p_media {
        background-color: #eef100;
        display: none;
        color: #000;
    }

    #p_alta {
        background-color: #ff9600;
        display: none;
    }

    #p_muyAlta {
        background-color: #cb0000;
        display: none;
    }

    .barra3 {
        width: 100%;
        height: 25px;
        float: left;
        box-shadow: -3px 3px 3px 0px #999;
        border-radius: 50px;
        font-family: maven regular;
        text-align: center;
        padding-top: 5px;
        color: #fff;
    }

    #r_baja {
        background-color: #18a827;
        display: none;
    }

    #r_media {
        background-color: #eef100;
        display: none;
        color: #000;
    }

    #r_alta {
        background-color: #ff9600;
        display: none;
    }

    #r_muyAlta {
        background-color: #cb0000;
        display: none;
    }

    .mapaCalor {
        width: 60%;
        float: right;
    }

    .mapaCalor table {
        font-family: maven regular;
        margin-top: 50px;
    }

    .mapaCalor td {
        width: 100px;
        height: 50px;
        text-align: center;
    }

    .mapaCalor td:hover {
        filter: saturate(500%);
    }

    .verde {
        background-color: #18a827;
    }

    .amarillo {
        background-color: #eef100;
    }

    .naranja {
        background-color: #ff9600;
    }

    .rojo {
        background-color: #cb0000;
    }

</style>

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

<script>
    $(document).ready(function() {

        $(".verde").mouseenter(function() {
            $("#r_baja").fadeIn(0);



            $("#r_media").fadeOut(0);
            $("#r_alta").fadeOut(0);
            $("#r_muyAlta").fadeOut(0);
        });



        $(".amarillo").mouseenter(function() {
            $("#r_media").fadeIn(0);



            $("#r_baja").fadeOut(0);
            $("#r_alta").fadeOut(0);
            $("#r_muyAlta").fadeOut(0);
        });



        $(".naranja").mouseenter(function() {
            $("#r_alta").fadeIn(0);



            $("#r_media").fadeOut(0);
            $("#r_baja").fadeOut(0);
            $("#r_muyAlta").fadeOut(0);
        });



        $(".rojo").mouseenter(function() {
            $("#r_muyAlta").fadeIn(0);



            $("#r_media").fadeOut(0);
            $("#r_alta").fadeOut(0);
            $("#r_baja").fadeOut(0);
        });





        $("#s_baja_p_muyAlta").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_media_p_muyAlta").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_alta_p_muyAlta").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_muyAlta_p_muyAlta").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_muyAlta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_alta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });



        $("#s_baja_p_alta").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_alta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_media_p_alta").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_alta").fadeIn(0);




            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_alta_p_alta").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_alta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_muyAlta_p_alta").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_alta").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);



            $("#p_media").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });



        $("#s_baja_p_media").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_media").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_media_p_media").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_media").fadeIn(0);




            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_alta_p_media").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_media").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });
        $("#s_muyAlta_p_media").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_media").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_baja").fadeOut(0);
        });



        $("#s_baja_p_baja").mouseenter(function() {
            $("#s_baja").fadeIn(0);
            $("#p_baja").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
        $("#s_media_p_baja").mouseenter(function() {
            $("#s_media").fadeIn(0);
            $("#p_baja").fadeIn(0);




            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
        $("#s_alta_p_baja").mouseenter(function() {
            $("#s_alta").fadeIn(0);
            $("#p_baja").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_muyAlta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
        $("#s_muyAlta_p_baja").mouseenter(function() {
            $("#s_muyAlta").fadeIn(0);
            $("#p_baja").fadeIn(0);




            $("#s_media").fadeOut(0);
            $("#s_baja").fadeOut(0);
            $("#s_alta").fadeOut(0);



            $("#p_alta").fadeOut(0);
            $("#p_muyAlta").fadeOut(0);
            $("#p_media").fadeOut(0);
        });
    });
</script>
