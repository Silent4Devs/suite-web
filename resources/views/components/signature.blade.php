<h3>REGISTRO DE SALIDA</h3>
<span style="font-size: 18px">Por favor, firma tu salida para completar tu registro</span>
<div class="wrapper" style="border: 1px dotted gray">
    <canvas id="canvas-firma{{ $visitante->id }}"
        style="width: 100%; @error('firma') border: 2px solid red !important; @enderror" class="signature-pad" width=320
        height=250>
    </canvas>
</div>
<div>
    <i id="clear-firma{{ $visitante->id }}" style="cursor: pointer; font-size: 25px;" class="bi bi-trash"></i>
    <div>
        @error('firma')
            <strong class="text-danger">
                <i class="bi bi-info-circle mr-2"></i> {{ $message }}
            </strong>
        @enderror
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function inicializarFirma(visitanteId) {
            let canvas = document.getElementById("canvas-firma" + visitanteId);

            if (!canvas) {
                console.error("No se encontró el canvas para el visitante " + visitanteId);
                return;
            }

            let signaturePad = new SignaturePad(canvas);

            signaturePad.addEventListener("endStroke", function() {
                let firmaDataUrl = signaturePad.toDataURL('image/png');
                Livewire.dispatch("updateFirma", {
                    id: visitanteId,
                    firma: firmaDataUrl
                });
            });

            // Botón para limpiar la firma
            document.getElementById("clear-firma" + visitanteId)?.addEventListener("click", function() {
                signaturePad.clear();
            });
        }

        // Inicializar todas las firmas al cargar la página
        document.querySelectorAll("[id^='canvas-firma']").forEach(canvas => {
            let visitanteId = canvas.id.replace("canvas-firma", "");
            inicializarFirma(visitanteId);
        });

        // Cuando Livewire actualice la lista de visitantes, reinicializar firmas
        Livewire.on("refreshFirmas", (visitanteId) => {
            inicializarFirma(visitanteId);
        });
    });
</script>
