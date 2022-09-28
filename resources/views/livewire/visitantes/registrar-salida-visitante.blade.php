<div class="row m-0">
    <x-loading-indicator />
    @if ($visitante)
        <div class="p-3 col-sm-12 col-md-12 col-lg-6 col-12 mb-3 text-center header-text border border-3 rounded">
            <h3 style="color: #3086AF">DATOS DE REGISTRO</h3>
            @include('visitantes.registro-visitantes._visitante-registrado', [
                'visitante' => $visitante,
                'mostrarQrIngreso' => false,
                'urlQrIngreso' => '',
                'mostrarQrSalida' => false,
                'urlQrSalida' => '',
            ])

        </div>
        <div class="p-3 col-sm-12 col-md-12 col-lg-6 col-12 mb-3 text-center header-text rounded">
            <x-signature wire:model="firma" />
            {{-- <div x-data="signaturePad(@entangle('firma'))">
                <div class="text-center" style="color: #1C274A">
                    <h3>REGISTRO DE SALIDA</h3>
                    <span style="font-size: 18px">Por favor,firma tu salida para
                        completar tu
                        registro</span>
                </div>
                <div class="mt-3">
                    <canvas style="width: 100%; @error('firma') border: 2px solid red !important; @enderror"
                        id="canvas-firma{{ $visitante->id }}" x-ref="signature_canvas" class="border rounded shadow">
                    </canvas>
                </div>
                <div wire:click.prevent="limpiarFirma()" class="text-center" style="cursor: pointer">
                    <i class="bi bi-trash"></i> Limpiar
                </div>
                <div>
                    @error('firma')
                        <strong class="text-danger">
                            <i class="bi bi-info-circle mr-2"></i> {{ $message }}
                        </strong>
                    @enderror
                </div>
            </div>
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('signaturePad', (value) => ({
                        signaturePadInstance: null,
                        value: value,
                        init() {
                            this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
                            this.signaturePadInstance.addEventListener("endStroke", () => {
                                this.value = this.signaturePadInstance.toDataURL('image/png');
                            });
                        },
                    }))
                })
            </script> --}}
        </div>
    @endif
    <div class="d-flex" style="justify-content: end">
        <button type="button" class="btn btn-primary" wire:click.prevent="registrarSalida">Finalizar</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('limpiarFirma', (id) => {
                let canvas = document.getElementById('canvas-firma' + id);
                const context = canvas.getContext('2d');
                context.clearRect(0, 0, canvas.width, canvas.height);
            });

            Livewire.on('salidaRegistradaSelf', (id) => {
                console.log('salidaRegistradaSelf');
                window.location.href = "{{ route('visitantes.presentacion') }}";
            });
        });
    </script>
</div>
