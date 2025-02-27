<div class="row m-0 p-5">
    <x-loading-indicator />
    <div class="col-12 text-center" style="color: #1C274A">
        <h3>REGISTRO DE SALIDA</h3>
        <p>Por favor, da clic en el botón de opciones para completar tu registro</p>
    </div>

    <div class="table-responsive card p-4" style="font-size: 12px">
        <table class="table table-sm table-striped" id="visitantesSalidaTable">
            <thead>
                <tr>
                    <th>Nombre(s)</th>
                    <th>Apellido(s)</th>
                    <th>Foto</th>
                    <th>Dispositivos</th>
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
                                style="max-width: 40px; clip-path: circle();" alt="{{ $visitante->nombre }}"
                                width="40px" height="40px">
                        </td>
                        <td>
                            @if ($visitante->dispositivos->count() > 0)
                                @foreach ($visitante->dispositivos as $item)
                                    <p class="m-0">
                                        <strong>Dispositivo: </strong> {{ $item->dispositivo }}
                                    </p>
                                    <p class="m-0">
                                        <strong>Serie: </strong> {{ $item->serie }}
                                    </p>
                                    @if (!$loop->last)
                                        <hr class="my-1" style="border: 1px solid red !important;">
                                    @endif
                                @endforeach
                            @else
                                Sin dispositivos registrados
                            @endif
                        </td>
                        <td>{{ $visitante->motivo }}</td>
                        <td>
                            @if ($visitante->tipo_visita == 'persona')
                                <p>{{ $visitante->empleado ? $visitante->empleado->name : 'N/A' }}</p>
                            @else
                                <p>{{ $visitante->area ? $visitante->area->area : 'N/A' }}</p>
                            @endif
                        </td>
                        <td>{{ $visitante->created_at->format('d-m-Y h:i A') }}</td>
                        <td>
                            <i class="bi bi-box-arrow-left btn btn-sm" data-bs-toggle="modal"
                                data-bs-target="#registrarSalida{{ $visitante->id }}"
                                data-visitante-id="{{ $visitante->id }}"></i>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No hay registros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex" style="justify-content: end">
            {!! $visitantes->links() !!}
        </div>
    </div>

    <div class="col-12 mt-3" style="text-align: end">
        <a href="{{ route('visitantes.presentacion') }}" class="btn tb-btn-primary text-white">Salir</a>
    </div>

    <!-- Aquí movemos los modales fuera de la tabla -->
    @foreach ($visitantes as $visitante)
        <div wire:ignore.self class="modal fade" id="registrarSalida{{ $visitante->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row m-0 p-2 justify-content-center">
                            @livewire('visitantes.registrar-salida-visitante', ['visitanteId' => $visitante->id], key($visitante->id))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        const modalInstances = {};

        document.addEventListener('DOMContentLoaded', function() {
            // Abrir modal
            Livewire.on('openModal', function(visitanteId) {
                console.log('Visitante ID recibido:', visitanteId);
                if (visitanteId) {
                    const modalElement = document.getElementById('registrarSalida' + visitanteId);
                    if (modalElement) {
                        let modal = new bootstrap.Modal(modalElement);
                        modal.show();
                        modalInstances[visitanteId] = modal;
                        console.log('Modal abierto para visitante:', visitanteId);
                    } else {
                        console.error('Modal con id registrarSalida' + visitanteId + ' no encontrado');
                    }
                } else {
                    console.error('No se recibió un ID válido de visitante');
                }
            });


            // Cerrar modal correctamente
            Livewire.on('closeModal', function(visitanteId) {
                if (visitanteId && modalInstances[visitanteId]) {
                    modalInstances[visitanteId].hide();
                    delete modalInstances[visitanteId]; // Remueve la instancia del modal
                    console.log('Modal cerrado para visitante:', visitanteId);

                    // 🔴 SOLUCIÓN: Eliminar el fondo oscuro manualmente
                    setTimeout(() => {
                        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                        document.body.classList.remove(
                        'modal-open'); // Permite hacer scroll de nuevo
                    }, 300); // Pequeño delay para evitar errores
                } else {
                    console.error('No se pudo cerrar el modal. ID no encontrado:', visitanteId);
                }
            });

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Función para asignar eventos a los botones de los modales
            function attachModalEvents() {
                document.querySelectorAll("[data-bs-toggle='modal']").forEach(button => {
                    button.addEventListener("click", function() {
                        const visitanteId = this.getAttribute("data-visitante-id");
                        Livewire.dispatch('openModal',
                            visitanteId); // Emitir evento Livewire para abrir el modal
                    });
                });
            }
            // Asigna los eventos cuando la página se carga
            attachModalEvents();

            // Se asegura de que los eventos se asignen después de que Livewire actualice la vista
            Livewire.hook("message.processed", (message, component) => {
                attachModalEvents(); // Reasignar los eventos después de cada actualización
            });
        });
    </script>


</div>
