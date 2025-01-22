<?php

namespace App\Livewire;

use App\Models\Permission;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateRolesLivewire extends Component
{

    use LivewireAlert;

    public $role = null;
    public $permisos = null;
    public $permisosAsignados = [];

    #[Validate('required|min:3|max:250', as: 'Nombre del Rol', message: 'El nombre del rol no puede estar vacio')]
    public $titleRol = null;

    public $allSelected = false;

    public function mount()
    {
        $this->permisos = Permission::getAll();
        $this->cargarPermisos();
    }

    public function cargarPermisos()
    {
        foreach ($this->permisos as $key => $permiso) {
            // Convertir la colección de permisos a un array y mapear
            $this->permisosAsignados[] = [
                'asignado' => false,
                'id' => $permiso['id'],
                'name' => $permiso['name'],
                'title' => $permiso['title'],
            ];
        }
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
        }
    }

    public function render()
    {
        return view('livewire.create-roles-livewire');
    }

    public function createRol(){
        $this->validate();

        try {
            $role = Role::create([
                'title' => $this->titleRol,
            ]);
            // Filtrar los permisos asignados para obtener solo los IDs que están marcados como asignados
            $permissionsIds = collect($this->permisosAsignados)
            ->filter(fn($permiso) => $permiso['asignado'])
            ->pluck('id')
            ->toArray();

            // Sincronizar los permisos con el rol
            $role->permissions()->sync($permissionsIds);

            // Emitir el evento para SweetAlert2
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
