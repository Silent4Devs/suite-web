<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div>
        <table>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('asignacionAprobador', (data) => {
                // data tiene la estructura: { nuevoResponsable: { id, nombre } }
                const aprobador = data.nuevoAprobador;
                console.log(aprobador);

                Swal.fire({
                    title: 'Asignación de aprobador',
                    text: 'Deseas asignar como aprobador a ' + aprobador.nombre,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ffffff',
                    cancelButtonText: '<span style="color: #057BE2; border: 1px solid var(--unnamed-color-057be2); border-radius: 4px; opacity: 1;">Cancelar</span>',
                    confirmButtonText: 'Sí, estoy seguro'
                });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('asignacionResponsable', (data) => {
                // data tiene la estructura: { nuevoResponsable: { id, nombre } }
                const responsable = data.nuevoResponsable;
                console.log(responsable);

                Swal.fire({
                    title: 'Asignación de responsable',
                    text: 'Deseas asignar como responsable a ' + responsable.nombre,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ffffff',
                    cancelButtonText: '<span style="color: #057BE2; border: 1px solid var(--unnamed-color-057be2); border-radius: 4px; opacity: 1;">Cancelar</span>',
                    confirmButtonText: 'Sí, estoy seguro'
                });
            });
        });
    </script>
</div>
