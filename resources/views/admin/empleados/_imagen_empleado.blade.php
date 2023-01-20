<style>
    .img-clip {
        clip-path: circle(50% at 50% 50%);
    }

</style>
<div class="row align-items-center">
    <div class="text-center col-sm-12 col-md-6 col-6">
        @php
            $foto = asset('storage/empleados/imagenes/man.png');
            if ($empleado->foto) {
                $foto = asset('storage/empleados/imagenes/' . $empleado->foto);
            }
        @endphp
        <img class="img-clip" id="picture" src="{{ $foto }}" style="max-width:170px">
    </div>
    <div class="col-sm-12 col-md-6 col-6">
        <div class="input-group is-invalid">
            <div class="form-group">
                <div class="text-center row" style="padding: 20px 0;">
                    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-center">
                        <label style="cursor: pointer" for="foto">
                            <div class="d-flex align-items-center">
                                <h5>
                                    <i class="fas fa-image iconos-crear"
                                        style="font-size: 20pt;position: relative;top: 4px;"></i>
                                    <span id="texto-imagen" class="pl-2">
                                        Subir imágen
                                        <small class="text-danger" style="font-size: 10px"></small>
                                    </span>
                                    <small id="error_foto" class="text-danger"></small>
                                </h5>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-center" id="avatar_choose">
                        <label style="cursor: pointer">
                            <div class="d-flex align-items-center">
                                <h5>
                                    <i class="fas fa-camera iconos-crear"
                                        style="font-size: 20pt;position: relative;top: 4px;"></i>
                                    <span id="texto-imagen-avatar" class="pl-2">
                                        Tomar Foto&nbsp;&nbsp;&nbsp;
                                    </span>
                                    <small id="error_snap_foto" class="text-danger"></small>
                                </h5>
                            </div>
                        </label>
                    </div>
                </div>
                <input name="foto" type="file" accept="image/png, image/jpeg" class="imageCrop form-control-file"
                    id="foto" hidden=""   enctype="multipart/form-data">
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
    <input type="hidden" id="snapshoot" readonly autocomplete="off" name="snap_foto" class="imageCrop"   enctype="multipart/form-data">
</div>

<script>
    //Cambiar imagen
    document.getElementById("foto").addEventListener('change', cambiarImagen);

    function cambiarImagen(event) {
        var file = event.target.files[0];

        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("picture").setAttribute('src', event.target.result);
        };

        reader.readAsDataURL(file);
    }
</script>
