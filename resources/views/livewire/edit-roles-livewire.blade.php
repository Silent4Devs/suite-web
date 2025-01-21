<div>
    {{-- Success is as dangerous as failure. --}}
    <h5 class="col-12 titulo_general_funcion">Editar: Rol</h5>
    <div class="card card-body">
        <div class="">
                <div class="form-group">
                    <div class="anima-focus">
                        <input class="form-control" type="text"
                        wire:model="titleRol" required>
                        <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                    </div>
                    <div>@error('titleRol') {{ $message }} @enderror</div>
                </div>
                <p class="text-muted"><i class="fas fa-info-circle"></i> Asignar Permisos</p>

                <div class="row">
                    <label>
                        <input type="checkbox" wire:click="toggleSelectAll($event.target.checked)" {{ $allSelected ? 'checked' : '' }}>
                        Seleccionar todos
                    </label>
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
                @if ($role->id != null)
                    <input type="hidden" id="role_id" value="{{ $role->id }}">
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
        </div>
        <div class="form-group text-end mt-5">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary">Cancelar</a>
            <button class="btn btn-primary" type="submit" wire:click="updateRol">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>
</div>
