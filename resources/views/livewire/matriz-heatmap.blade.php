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

<div>
    <div class="row">
        <div class="col-md-4">
            <p class="text-xl text-gray-700">Sede:</p>
            <select class="form-control" wire:model="sede">
                <option value="" selected disabled>Seleccione una sede</option>
                @foreach ($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <p class="text-xl text-gray-700">Area:</p>
            <select class="form-control" wire:model="area">
                <option value="" selected disabled>Seleccione un area</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <p class="text-xl text-gray-700">Proceso:</p>
            <select class="form-control" wire:model="sede">
                <option value="" selected disabled>Seleccione una proceso</option>
                @foreach ($procesos as $proceso)
                    <option value="{{ $proceso->id }}">{{ $proceso->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="calor">
                <div class="datosCalor">
                    <label>Riesgo inicial</label>
                    <div class="barra1" id="s_baja">Baja</div>
                    <div class="barra1" id="s_media">Media</div>
                    <div class="barra1" id="s_alta">Alta</div>
                    <div class="barra1" id="s_muyAlta">Muy Alta</div>
                </div>
                <div class="mapaCalor">
                    <div class="txtVertical">Impacto</div>
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
                    <div class="txtHorizontal">Probabilidad</div>
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="calor">
                <div class="datosCalor">
                    <label style="margin-left:100px;">Riesgo residual</label>
                </div>
                <div class="mapaCalor">
                    <div class="txtVertical text-primary font-weight-bold" style="position:absolute; margin-top: 20px;font-size: 20px;">Impacto</div>
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
                    <div class="txtHorizontal" style="margin-left: 150px;">Probabilidad</div>
                </div>
            </div>

        </div>
    </div>
</div>
