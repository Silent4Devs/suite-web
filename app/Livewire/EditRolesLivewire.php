<?php

namespace App\Livewire;

use App\Models\Permission;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditRolesLivewire extends Component
{

    use LivewireAlert;

    public $role = null;
    public $permisos = null;
    public $permisosAsignados = [];

    #[Validate('required|min:3|max:250', as: 'Nombre del Rol', message: 'El nombre del rol no puede estar vacio')]
    public $titleRol = null;

    public $allSelected = false;

    public function mount($id_role)
    {
        $this->role = Role::where('id', $id_role)->first();
        $this->permisos = Permission::getAll();
        $this->titleRol = $this->role->title;

        $this->cargarPermisosRol();
    }

    public function cargarPermisosRol()
    {
        // Obtener los IDs de los permisos asignados al rol
        $permisosRol = $this->role->permissions->pluck('id')->toArray();

        // Convertir la colección de permisos a un array y mapear
        $this->permisosAsignados = array_map(function ($permiso) use ($permisosRol) {
            return [
                'asignado' => in_array($permiso['id'], $permisosRol),
                'id' => $permiso['id'],
                'name' => $permiso['name'],
                'title' => $permiso['title'],
            ];
        }, $this->permisos->toArray());

        // Verificar si todos los permisos están asignados al rol
        $this->allSelected = collect($this->permisosAsignados)->every(fn($permiso) => $permiso['asignado']);
    }

    public function toggleSelectAll($checked)
    {
        if ($checked) {
            $this->allSelected = true;
            $this->permisosAsignados = array_map(function ($permiso) {
                return [
                    'asignado' => true,
                    'id' => $permiso['id'],
                    'name' => $permiso['name'],
                    'title' => $permiso['title'],
                ];
            }, $this->permisos->toArray());
        } else {
            $this->allSelected = false;
            $this->cargarPermisosRol();
        }
    }

    public function render()
    {
        return view('livewire.edit-roles-livewire');
    }

    public function updateRol()
    {
        try {
            $this->validate(); // Realizar la validación

            // Actualizar el título del rol
            $this->role->update([
                'title' => $this->titleRol,
            ]);

            // Filtrar los permisos asignados
            $permissionsIds = collect($this->permisosAsignados)
                ->filter(fn($permiso) => $permiso['asignado'])
                ->pluck('id')
                ->toArray();

            // Sincronizar los permisos con el rol
            $this->role->permissions()->sync($permissionsIds);

            // Emitir evento para SweetAlert
            $this->dispatch('mostrarMensajeExito');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Emitir evento para mostrar errores de validación
            $this->dispatch('mostrarErroresValidacion', [
                'mensajes' => $e->validator->errors()->all()
            ]);
        } catch (\Throwable $th) {
            // Emitir evento para errores generales
            $this->dispatch('mostrarMensajeError');
        }
    }
}
