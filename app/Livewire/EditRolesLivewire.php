<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Permission;
use App\Models\Role;
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

    public function updateRol(){
        try {
            $this->validate();

            $this->role->update([
                'name' => $this->titleRol,
            ]);

            // Filtrar los permisos asignados para obtener solo los IDs que están marcados como asignados
            $permissionsIds = collect($this->permisosAsignados)
            ->filter(fn($permiso) => $permiso['asignado'])
            ->pluck('id')
            ->toArray();

            // Sincronizar los permisos con el rol
            $this->role->permissions()->sync($permissionsIds);

            // Emitir el evento para SweetAlert2
            $this->dispatch('mostrarMensajeExito');
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('mostrarMensajeError');
        }
    }

    public function redirectToIndex()
    {
        return redirect()->route('admin.roles.index');
    }
}
