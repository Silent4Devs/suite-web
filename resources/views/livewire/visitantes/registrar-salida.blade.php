<div class="container pt-5">
    <div class="col-12 text-center" style="color: #1C274A">
        <h3>REGISTRO DE SALIDA</h3>
        <p>Por favor, da clic en el botón de opciones para completar tu registro</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre(s)</th>
                <th>Apellido(s)</th>
                <th>Foto</th>
                <th>Dispositivo</th>
                <th>Serie</th>
                <th>Motivo</th>
                <th>Visita</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visitantes as $visitante)
                <tr>
                    <td>{{ $visitante->nombre }}</td>
                    <td>{{ $visitante->apellidos }}</td>
                    <td>
                        <img src="{{ $visitante->foto ? $visitante->foto : asset('assets/user.png') }}"
                            style="max-width: 80px;clip-path: circle();" alt="{{ $visitante->nombre }}">
                    </td>
                    <td>{{ $visitante->dispositivo }}</td>
                    <td>{{ $visitante->serie }}</td>
                    <td>{{ $visitante->motivo }}</td>
                    <td>
                        @if ($visitante->tipo_visita == 'persona')
                            <p>PERSONA: {{ $visitante->empleado ? $visitante->empleado->name : 'N/A' }}</p>
                        @else
                            <p>ÁREA: {{ $visitante->area ? $visitante->area->area : 'N/A' }}</p>
                        @endif
                    </td>
                    <td>{{ $visitante->created_at->format('d-m-Y h:i A') }}</td>
                    <td>
                        <i class="bi bi-box-arrow-left btn btn-sm" id="registrarSalida"
                            wire:click.prevent="openModal({{ $visitante->id }})"></i>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal -->
    <div wire:ignore class="modal fade" id="avisoPrivacidadVisitantesModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row container justify-content-center">
                        @if ($visitante)
                            <div class="col-6 text-center header-text border rounded" style="max-width: 100%">
                                <h3 style="color: #3086AF">DATOS DE REGISTRO</h3>
                                <div class="mt-3" style="display: flex;justify-content: space-between">
                                    <span>Fecha: {{ $visitante->created_at->format('d-m-Y') }}</span>
                                    <span>Entrada: {{ $visitante->created_at->format('h:i A') }}</span>
                                </div>
                                <div class="mt-3">
                                    <img src="{{ $visitante->foto ? $visitante->foto : asset('assets/user.png') }}"
                                        style="max-width: 250px;clip-path: circle();" alt="{{ $visitante->nombre }}">
                                </div>
                                <div class="mt-3">
                                    <span style="color: #3086AF">ID: 1</span>
                                </div>
                                <div class="mt-3 border p-2" style="text-transform: capitalize">
                                    {{ $visitante->nombre }} {{ $visitante->apellidos }}
                                </div>
                                <div class="mt-3 border p-2">
                                    Dispositivo: {{ $visitante->dispositivo ? $visitante->dispositivo : 'N/A' }}
                                    Serie: {{ $visitante->serie ? $visitante->serie : 'N/A' }}
                                </div>
                                <div class="mt-3 border p-2">
                                    VISITA
                                    @if ($visitante->tipo_visita == 'persona')
                                        <p>PERSONA: {{ $visitante->empleado ? $visitante->empleado->name : 'N/A' }}</p>
                                    @else
                                        <p>ÁREA: {{ $visitante->area ? $visitante->area->area : 'N/A' }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div x-data="signaturePad(@entangle('firma'))">
                                    <div class="text-center" style="color: #1C274A">
                                        <h3>REGISTRO DE SALIDA</h3>
                                        <span style="font-size: 18px">Por favor,firma tu salida para completar tu
                                            registro</span>
                                    </div>
                                    <div class="mt-3">
                                        <canvas style="width: 100%" x-ref="signature_canvas"
                                            class="border rounded shadow">
                                        </canvas>
                                    </div>
                                    <div wire:click.prevent="limpiarFirma()" class="text-center"
                                        style="cursor: pointer">
                                        <i class="bi bi-trash"></i> Limpiar
                                    </div>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

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

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        wire:click.prevent="registrarSalida">Finalizar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3" style="text-align: end">
        <a href="{{ route('visitantes.presentacion') }}" class="btn btn-primary">Salir</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('openModal', function(id) {
                $('#avisoPrivacidadVisitantesModal').modal('show');
            });
            Livewire.on('closeModal', function(id) {
                $('#avisoPrivacidadVisitantesModal').modal('hide');
            });
        });
    </script>
</div>
