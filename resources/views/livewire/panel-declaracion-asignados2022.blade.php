<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div>
        <table id="">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Control
                    </th>
                    <th>
                        Clasificación
                    </th>
                    <th>
                        Responsable
                    </th>
                    <th>
                        Aprobador
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($array_asignados as $keyAs => $as)
                <tr>
                    <td>
                        {{$as['gapdos']['control_iso']}}
                    </td>
                    <td>
                        {{$as['gapdos']['anexo_politica']}}
                    </td>
                    <td>
                        {{$as['gapdos']['nombre_clasificacion']}}
                    </td>
                    <td>
                        <select class="select2 form-control" wire:change="cambioResponsable({{ $keyAs }})" wire:model="array_asignados.{{ $keyAs }}.responsable.id">
                            <option value="">
                                Eliga un Colaborador
                            </option>
                            @foreach ($empleados as $keyEmp => $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="select2 form-control" wire:change="cambioAprobador({{ $keyAs }})" wire:model="array_asignados.{{ $keyAs }}.aprobador.id">
                            <option value="">
                                Eliga un Colaborador
                            </option>
                            @foreach ($empleados as $keyEmp => $empleado)
                                <option value="{{ $empleado->id }}">
                                    {{ $empleado->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="btn-primary" wire:click="envioNotificacionControl('individual', {{$keyAs}})">
                            Enviar Correo
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                    }
                });
            });
        });
    </script>
</div>
