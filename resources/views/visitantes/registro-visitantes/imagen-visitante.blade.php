<style>
    .img-clip {
        clip-path: circle(50% at 50% 50%);
    }
</style>
<div class="w-100" id="canvasFoto" wire:ignore>
    <div class="w-100 m-0 display-cover">
        {{-- <span class="badge badge-dark" id="cerrarCanvasFoto">&times;</span> --}}
        <video autoplay></video>
        <canvas class="d-none"></canvas>

        <div class="video-options">
            <select name="" id="" class="custom-select devices">
                <option value="">Selecciona una cámara</option>
            </select>
        </div>

        <img class="screenshot-image d-none" alt="">

        <div class="controls">
            <button class="btn btn-success play" title="Iniciar"><i class="bi bi-play"></i></button>
            <button class="btn btn-info pause d-none" title="Pausar"><i class="bi bi-pause"></i></button>
            <button class="btn btn-danger stop d-none" title="Detener"><i class="bi bi-stop"></i></button>
            <button class="btn btn-dark screenshot d-none" title="Capturar"><i class="bi bi-camera"></i></button>
        </div>
    </div>
    <input type="hidden" id="snapshoot" readonly autocomplete="off" wire:model.defer="foto" name="snap_foto"
        class="imageCrop" enctype="multipart/form-data">
</div>
@error('foto')
    <div class="text-center w-100">
        <strong class="text-danger">
            <i class="fas fa-info-circle mr-2"></i> {{ $message }}
        </strong>
    </div>
@enderror
{{-- <script>
    //Cambiar imagen
    document.getElementById("foto")?.addEventListener('change', cambiarImagen);

    function cambiarImagen(event) {
        var file = event.target.files[0];

        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("picture").setAttribute('src', event.target.result);
        };

        reader.readAsDataURL(file);
    }
</script> --}}
