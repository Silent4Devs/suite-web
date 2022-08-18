<div class="row m-0 p-5">
    <div class="col-12 text-center" style="color: #1C274A">
        <h3>REGISTRO DE SALIDA</h3>
        <p>Por favor, da clic en el botón de opciones para completar tu registro</p>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="visitantesSalidaTable">
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
                    <div wire:ignore.self class="modal fade" id="registrarSalida{{ $visitante->id }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row m-0 p-4 justify-content-center">
                                        @if ($visitante)
                                            <div
                                                class="p-3 col-sm-12 col-lg-6 col-6 mb-3 text-center header-text border border-3 rounded">
                                                <h3 style="color: #3086AF">DATOS DE REGISTRO</h3>
                                                @include('visitantes.registro-visitantes._visitante-registrado',
                                                    [
                                                        'visitante' => $visitante,
                                                        'mostrarQrIngreso' => false,
                                                        'urlQrIngreso' => '',
                                                        'mostrarQrSalida' => false,
                                                        'urlQrSalida' => '',
                                                    ])

                                            </div>
                                            <div
                                                class="p-3 col-sm-12 col-lg-6 col-6 mb-3 text-center header-text rounded">
                                                <div x-data="signaturePad(@entangle('firma'))">
                                                    <div class="text-center" style="color: #1C274A">
                                                        <h3>REGISTRO DE SALIDA</h3>
                                                        <span style="font-size: 18px">Por favor,firma tu salida para
                                                            completar tu
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
    </div>


    <div class="col-12 mt-3" style="text-align: end">
        <a href="{{ route('visitantes.presentacion') }}" class="btn btn-primary">Salir</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('openModal', function(visitante) {
                $('#registrarSalida' + visitante.id).modal('show');

            });
            Livewire.on('closeModal', function(visitante) {
                $('#registrarSalida' + visitante.id).modal('hide');
                $('.modal-backdrop').hide();
            });
            Livewire.on('datatable', function() {
                console.log('datatable');
                $('#visitantesSalidaTable').DataTable();
            });
            $('#visitantesSalidaTable').DataTable();
        });
        $(document).ready(function() {});
    </script>
</div>
