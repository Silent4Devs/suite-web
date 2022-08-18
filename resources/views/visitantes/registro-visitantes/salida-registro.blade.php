@extends('layouts.visitantes')

@section('content')
    @if ($visitante)
        <div class="p-3 col-sm-12 col-lg-6 col-6 mb-3 text-center header-text border border-3 rounded">
            <h3 style="color: #3086AF">DATOS DE REGISTRO</h3>
            @include('visitantes.registro-visitantes._visitante-registrado', [
                'visitante' => $visitante,
                'mostrarQrIngreso' => false,
                'urlQrIngreso' => '',
                'mostrarQrSalida' => false,
                'urlQrSalida' => '',
            ])

        </div>
        <div class="p-3 col-sm-12 col-lg-6 col-6 mb-3 text-center header-text rounded">
            <div x-data="signaturePad(@entangle('firma'))">
                <div class="text-center" style="color: #1C274A">
                    <h3>REGISTRO DE SALIDA</h3>
                    <span style="font-size: 18px">Por favor,firma tu salida para
                        completar tu
                        registro</span>
                </div>
                <div class="mt-3">
                    <canvas style="width: 100%" x-ref="signature_canvas" class="border rounded shadow">
                    </canvas>
                </div>
                <div wire:click.prevent="limpiarFirma()" class="text-center" style="cursor: pointer">
                    <i class="bi bi-trash"></i> Limpiar
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
            </script>
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
@endsection
