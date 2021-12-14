<div class="row">
    <div class="col">
        <div class="input-group is-invalid">
            <div class="form-group" style="width: 100%;border: dashed 1px #cecece;">
                <div class="row" style="padding: 20px 0;">
                    <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center">
                        <label style="cursor: pointer" for="foto">
                            <div class="d-flex align-items-center">
                                <h5>
                                    <i class="fas fa-image iconos-crear"
                                        style="font-size: 20pt;position: relative;top: 4px;"></i>
                                    <span id="texto-imagen" class="pl-2">
                                        Subir imágen
                                        <small class="text-danger" style="font-size: 10px">
                                            (Opcional)</small>
                                    </span>
                                    <small id="error_foto" class="text-danger"></small>
                                </h5>
                            </div>
                        </label>
                    </div>
                    <div class="col-sm-2 col-md-2 col-12 d-flex justify-content-center">
                        Ó
                    </div>
                    <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center" id="avatar_choose">
                        <label style="cursor: pointer">
                            <div class="d-flex align-items-center">
                                <h5>
                                    <i class="fas fa-image iconos-crear"
                                        style="font-size: 20pt;position: relative;top: 4px;"></i>
                                    <span id="texto-imagen-avatar" class="pl-2">
                                        Tomar Foto
                                        <small class="text-danger" style="font-size: 10px">
                                            (Opcional)</small>
                                    </span>
                                    <small id="error_snap_foto" class="text-danger"></small>
                                </h5>
                            </div>
                        </label>
                    </div>
                </div>
                <input name="foto" type="file" accept="image/png, image/jpeg" class="form-control-file" id="foto"
                    hidden="">
            </div>
        </div>
    </div>
</div>
<div class="row" id="canvasFoto" style="display: none">
    <div class="mt-0 display-cover">
        <span class="badge badge-dark" id="cerrarCanvasFoto">&times;</span>
        <video autoplay></video>
        <canvas class="d-none"></canvas>

        <div class="video-options">
            <select name="" id="" class="custom-select devices">
                <option value="">Selecciona una cámara</option>
            </select>
        </div>

        <img class="screenshot-image d-none" alt="">

        <div class="controls">
            <button class="btn btn-danger play" title="Iniciar"><i class="fas fa-play-circle"></i></button>
            <button class="btn btn-info pause d-none" title="Pausar"><i class="fas fa-pause-circle"></i></button>
            <button class="btn btn-danger stop d-none" title="Detener"><i class="fas fa-stop"></i></button>
            <button class="btn btn-outline-success screenshot d-none" title="Capturar"><i
                    class="fas fa-image"></i></button>
        </div>
    </div>
    <input type="hidden" id="snapshoot" readonly autocomplete="off" name="snap_foto">
</div>
