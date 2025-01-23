<div>
    {{-- Stop trying to control. --}}
    <h5 class="col-12 titulo_general_funcion"> Registrar: Rol</h5>
    <div class="card card-body">
        <div class="mt-4">
                <div class="form-group">
                    <div class="anima-focus">
                        <input class="form-control" type="text"
                        wire:model="titleRol" required>
                        <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                    </div>
                    <div>@error('titleRol') {{ $message }} @enderror</div>
                </div>
                <p class="text-muted"><i class="fas fa-info-circle"></i> Asignar Permisos</p>

                <div class="row mt-4 mb-3">
                    <div class="col-3">
                        <label>
                            <input type="checkbox" wire:click="toggleSelectAll($event.target.checked)" {{ $allSelected ? 'checked' : '' }}>
                            Seleccionar todos
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 datatable-fix">
                        <table class="table w-100" id="tblPermissions">
                            <thead>
                                <th></th>
                                <th>No.</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                            </thead>
                            <tbody>
                                @foreach ($permisosAsignados as $idx => $permission)
                                    <tr>
                                        <td><input wire:model="permisosAsignados.{{ $idx }}.asignado" type="checkbox"></td>
                                        <td>{{ $permission['id'] }}</td>
                                        <td>{{ $permission['name'] }}</td>
                                        <td>{{ $permission['title'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <div class="form-group text-end mt-5">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary">Cancelar</a>
            <button class="btn btn-primary" type="submit" wire:click="createRol">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('mostrarMensajeExito', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'El rol fue creado exitosamente',
                text: 'Serás redirigido en breve...',
                timer: 5000,
                showConfirmButton: false,
                allowOutsideClick: false,
                didClose: () => {
                    window.location.href = "{{ route('admin.roles.index') }}";
                }
            });
        });

        document.addEventListener('mostrarMensajeError', function(e) {
            Swal.fire({
                icon: 'error',
                title: 'Ha ocurrido un error al crear el rol',
                text: 'Intente nuevamente mas tarde',
                timer: 5000,
                showConfirmButton: false,
                allowOutsideClick: false,
            });
        });

        document.addEventListener('mostrarErroresValidacion', function (event) {
            // Obtener los mensajes desde el detalle del evento
            const mensajes = event.detail[0].mensajes;

            Swal.fire({
                icon: 'warning',
                title: 'Errores de validación',
                html: mensajes.join('<br>'), // Mostrar los errores en líneas separadas
                timer: 7000,
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        });
    </script>
</div>
