<div>
    <style>
        .cert-null {
            opacity: 0.5;
        }
    </style>
    @if ($course->certificado)
        <div class="card card-body d-none" id="certificados-select">
            <div class="d-flex justify-content-between">
                <h5 class="color-tbj">Certificado para Capacitaciones</h5>
                <div class="btn btn-outline-secondary" onclick="cambioConfig()">Configurar</div>
            </div>
            <hr>
            <p>
                Selecciona y asigna el diseño del Certificado que se otorgará en la sección de Capacitaciones como
                predeterminado para tu empresa.
            </p>

            <div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start justify-content-center">
                            <label for="certificado1" style="width: 60%;" wire:click="selectCert(1)">
                                <input type="radio" id="certificado1" name="certificado"
                                    {{ $course->certificado === 1 ? 'checked' : '' }}>
                                <img src="{{ asset('img/escuela/certificaciones/certificado-example1.png') }}"
                                    alt="" style="width: 100%;">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start justify-content-center">
                            <label for="certificado2" style="width: 60%;" wire:click="selectCert(2)">
                                <input type="radio" id="certificado2" name="certificado"
                                    {{ $course->certificado === 2 ? 'checked' : '' }}>
                                <img src="{{ asset('img/escuela/certificaciones/certificado-example2.png') }}"
                                    alt="" style="width: 100%;">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div id="certificados-config">
        {{-- <div class="row">
            <div class="col-12 text-right">
                <div class="btn btn-outline-secondary {{ $course->certificado ? '' : 'cert-null' }}"
                    onclick="cambioConfig()">Seleccionar Certificado</div>
            </div>
        </div> --}}
        <div class="row mt-3">
            <div class="col-md-6 d-flex">
                <div class="card card-body">
                    <h5 class="color-tbj">Certificaciones</h5>
                    <hr>
                    <div>
                        <input type="checkbox" name="habilitar_certificado" id="habilitar_certificado"
                            wire:model.live="habilitar_certificado" style="display: none;">
                        <label for="habilitar_certificado">
                            <div class="btn btn-outline-primary">
                                Emitir certificado del curso
                            </div>
                        </label>
                    </div>

                    <div class="{{ $course->certificado ? '' : 'cert-null' }}">
                        <p class="text-center">
                            <strong>Certificado asignado</strong>
                        </p>
                        <div class="d-flex justify-content-center">
                            <img src="{{ $course->certificado_ruta }}" alt="" style="width: 50%;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-body">
                    <div class="{{ $course->certificado ? '' : 'cert-null' }}">
                        <div class="d-flex justify-content-between">
                            <h5 class="color-tbj">Firma</h5>

                            <div class="btn btn-outline-secondary" wire:click="habilitarFirma()">
                                {{ $course->firma_habilitar ? 'Ocultar' : 'Habilitar' }} firma
                            </div>
                        </div>
                        <hr>
                        <p class="text-center">
                            <strong>Firma del evaluador</strong>
                        </p>
                        <div class="d-flex justify-content-center {{ $course->firma_habilitar ? '' : 'cert-null' }}">
                            @if ($course->firma_instructor)
                                <img src="{{ $course->firma_instructor }}" alt="" style="width: 100%;">
                            @endif
                        </div>
                        <div class="text-center mt-3">
                            @if ($course->certificado && $course->firma_habilitar)
                                <div class="btn btn-secondary" disabled data-bs-toggle="modal"
                                    data-bs-target="#modal-firma">
                                    {{ $course->firma_instructor ? 'EDITAR' : 'AGREGAR' }} FIRMA
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-firma" tabindex="-1" aria-labelledby="modal-firma" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <p class="text-center">
                        <strong>Por favor firma dentro del siguiente recuadro</strong>
                    </p>
                    <p class="mt-4 text-center">
                        Firma del evaluador
                    </p>
                    <form wire:submit.prevent="addFirma(Object.fromEntries(new FormData($event.target)))">
                        <div class="d-flex justify-content-center">
                            <canvas id="signature-pad" width="460" height="200"
                                style="border: 1px solid #000; border-radius: 6px;"></canvas>

                            <input type="hidden" id="signature-image" name="firma_instructor">
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="btn btn-outline-primary" onclick="clearSignature()">Limpiar</div>
                            <button class="btn btn-primary" onclick="getSignatureImage()" data-bs-dismiss="modal"
                                aria-label="Close">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        function cambioConfig() {
            document.getElementById('certificados-select').classList.toggle('d-none');
            document.getElementById('certificados-config').classList.toggle('d-none');
        }

        // Selecciona el elemento canvas y el input oculto
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);
        const signatureImageInput = document.getElementById('signature-image');

        // Verificar si el canvas y SignaturePad se inicializan correctamente
        console.log("Canvas inicializado:", !!canvas);
        console.log("SignaturePad inicializado:", !!signaturePad);

        // Función para limpiar la firma
        function clearSignature() {
            signaturePad.clear();
            signatureImageInput.value = ""; // Limpia el input también
            console.log("Firma borrada");
        }

        // Actualiza el input con la firma en base64 en tiempo real
        function updateSignatureInput() {
            const signatureData = signaturePad.toDataURL();
            signatureImageInput.value = signatureData;
        }

        // Detecta cambios en el canvas(movimientos de ratón o toque) y actualiza el input
        canvas.addEventListener("mouseup", updateSignatureInput); // Evento al soltar el clic del ratón
        canvas.addEventListener("touchend", updateSignatureInput); // Evento al soltar el toque en pantallas táctiles
        canvas.addEventListener("mousemove", updateSignatureInput); // Evento al mover el ratón
        canvas.addEventListener("touchmove", updateSignatureInput); // Evento al mover el dedo en pantallas táctiles
    </script>

</div>
