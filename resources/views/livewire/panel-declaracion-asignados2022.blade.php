<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div>
        <div class="row">
            <div class="text-left">
                {{-- Botón para abrir el modal de notificación --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Enviar Notificación
                </button>
            </div>
            <div class="text-right">
                {{-- <button id="btnCSV" class="btn-sm rounded pr-2" style="background-color:#c2efe0; border: #fff">
                    <i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc" title="Exportar CSV"></i>
                    Exportar CSV
                </button> --}}
                <button wire:click="descargarArchivo" class="btn-sm rounded pr-2" style="background-color:#b9eeb9; border: #fff">
                    <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935" title="Exportar Excel"></i>
                    Exportar Excel
                </button>
            </div>
        </div>

        {{-- Modal para seleccionar el tipo de notificación --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control" name="select_envio" id="select_envio" wire:model="select_envio">
                            <option value="no_notificado">No notificados</option>
                            <option value="todos">Todos</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="enviarNotificacionBtn">Enviar notificaciones</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de controles --}}
        <div>
            <table id="">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Control</th>
                        <th>Clasificación</th>
                        <th>Responsable</th>
                        <th>Aprobador</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($array_asignados as $keyAs => $as)
                    <tr>
                        <td>{{ $as['gapdos']['control_iso'] }}</td>
                        <td>{{ $as['gapdos']['anexo_politica'] }}</td>
                        <td>{{ $as['gapdos']['nombre_clasificacion'] }}</td>
                        <td>
                            <select class="select2 form-control" wire:change="cambioResponsable({{ $keyAs }})" wire:model="array_asignados.{{ $keyAs }}.responsable.id">
                                <option value="">Eliga un Colaborador</option>
                                @foreach ($empleados as $keyEmp => $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="select2 form-control" wire:change="cambioAprobador({{ $keyAs }})" wire:model="array_asignados.{{ $keyAs }}.aprobador.id">
                                <option value="">Eliga un Colaborador</option>
                                @foreach ($empleados as $keyEmp => $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn-primary enviarCorreoBtn" data-key="{{ $keyAs }}">
                                Enviar Correo
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Scripts para manejar Sweet Alerts y llamadas a Livewire --}}
        <script>
            document.addEventListener('livewire:initialized', function() {
                // Sweet Alert para el botón de enviar notificaciones
                document.getElementById('enviarNotificacionBtn').addEventListener('click', function() {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¿Desea enviar un correo de notificación al grupo seleccionado?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, enviar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.call('enviarNotificacion');
                        }
                    });
                });

                // Sweet Alert para los botones de enviar correo individual
                document.querySelectorAll('.enviarCorreoBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const keyAs = this.getAttribute('data-key');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: '¿Desea enviar un correo de notificación al responsable del control?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, enviar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                @this.call('envioNotificacionControl', 'individual', keyAs);
                            }
                        });
                    });
                });
            });
        </script>
    </div>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('asignacionResponsable', (data) => {
                const responsable = data.nuevoResponsable;


                Swal.fire({
                    title: 'Asignación de responsable',
                    text: '¿Deseas asignar como responsable a ' + responsable.nombre + '?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ffffff',
                    cancelButtonText: '<span style="color: #057BE2;">Cancelar</span>',
                    confirmButtonText: 'Sí, estoy seguro'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Llama al método del backend y, por ejemplo, pasa el id del responsable
                        @this.call('guardarResponsable', responsable);
                    } else {
                        @this.call('asignacionControles');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('desasignacionResponsable', (data) => {
                const responsable = data.nuevoResponsable;


                Swal.fire({
                    title: 'Desasignación de responsable',
                    text: '¿Desea remover al responsable de este control?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ffffff',
                    cancelButtonText: '<span style="color: #057BE2;">Cancelar</span>',
                    confirmButtonText: 'Sí, estoy seguro'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Llama al método del backend y, por ejemplo, pasa el id del responsable
                        @this.call('quitarResponsable', responsable);
                    } else {
                        @this.call('asignacionControles');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('asignacionAprobador', (data) => {
                const aprobador = data.nuevoAprobador;


                Swal.fire({
                    title: 'Asignación de aprobador',
                    text: '¿Deseas asignar como aprobador a ' + aprobador.nombre + '?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ffffff',
                    cancelButtonText: '<span style="color: #057BE2;">Cancelar</span>',
                    confirmButtonText: 'Sí, estoy seguro'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Llama al método del backend y, por ejemplo, pasa el id del responsable
                        @this.call('guardarAprobador', aprobador);
                    } else {
                        @this.call('asignacionControles');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('desasignacionAprobador', (data) => {
                const aprobador = data.nuevoAprobador;


                Swal.fire({
                    title: 'Desasignación de aprobador',
                    text: '¿Desea remover al aprobador de este control?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ffffff',
                    cancelButtonText: '<span style="color: #057BE2;">Cancelar</span>',
                    confirmButtonText: 'Sí, estoy seguro'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Llama al método del backend y, por ejemplo, pasa el id del responsable
                        @this.call('quitarAprobador', aprobador);
                    } else {
                        @this.call('asignacionControles');
                    }
                });
            });
        });
    </script>
</div>
