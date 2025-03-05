<style>
    .img-clip {
        clip-path: circle(50% at 50% 50%);
    }
</style>
<div class="w-100" id="canvasFoto" wire:ignore>
    <div class="w-100 m-0 display-cover">
        {{-- <span class="badge badge-dark" id="cerrarCanvasFoto">&times;</span> --}}
        <div class="container mt-5">
            <!-- Row para organizar el video y el canvas -->
            <div class="row justify-content-center">

                <!-- Columna para el video -->
                <div class="col-12 col-md-6 text-center mb-4">
                    <h5>Vista previa de la cámara</h5>
                    <video id="video" autoplay class="w-100" style="border: 1px solid #ddd;"></video>
                </div>

                <!-- Columna para el canvas (donde se dibujará la imagen capturada) -->
                <div class="col-12 col-md-6 text-center">
                    <h5>Imagen Capturada</h5>
                    <canvas id="canvas" class="w-100" style="border: 1px solid #ddd;"></canvas>
                </div>
            </div>
        </div>
        <img class="screenshot-image d-none" alt="">

        <div class="controls">
            <button onclick="inicioCamera()" class="btn btn-primary start-camera" title="Iniciar Cámara"><i
                    class="bi bi-play"></i></button>
            <button id="capture" class="btn btn-dark screenshot" title="Capturar Foto"><i
                    class="bi bi-camera"></i></button>
        </div>
    </div>
    <input type="hidden" id="snapshoot" readonly autocomplete="off" wire:model="foto" name="snap_foto"
        class="imageCrop" enctype="multipart/form-data">
</div>
@error('foto')
    <div class="text-center w-100">
        <strong class="text-danger">
            <i class="fas fa-info-circle mr-2"></i> {{ $message }}
        </strong>
    </div>
@enderror


<script>
    // Esta función se encarga de detener la cámara y luego avanzar al siguiente paso con Livewire
    function detenerYAvanzar() {
        // Detener la cámara
        detenerCamera();

        // Ahora proceder con Livewire para cambiar el paso
        @this.call('increaseStep');
    }

    // Función para detener la cámara
    function detenerCamera() {
        // Verificamos si 'cameraStream' existe y detenemos los tracks de la cámara
        if (window.cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());  // Detener la cámara
            console.log("Cámara detenida");
        }
    }

    // Función para iniciar la cámara y tomar la foto
    function inicioCamera() {
        const video = document.getElementById("video");
        const canvas = document.getElementById("canvas");
        const captureButton = document.getElementById("capture");

        // Acceder a la cámara
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                window.cameraStream = stream;  // Guardamos el stream de la cámara
                video.srcObject = stream;
            })
            .catch(error => {
                console.error("Error al acceder a la cámara:", error);
            });

        // Capturar la foto
        captureButton.addEventListener("click", () => {
            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convertir la imagen a base64
            const imageData = canvas.toDataURL("image/png");

            // Guardar la imagen en LocalStorage
            @this.call("guardarImagen", imageData);
            console.log("Imagen guardada:", imageData);
        });
    }

</script>


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
