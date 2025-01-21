<?php

namespace App\Livewire;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class EditRolesLivewire extends Component
{

    public $role = null;
    public $permisos = null;
    public $permisosAsignados = [];
    public $titleRol = null;
    public $allSelected = false;

    public function mount($id_role)
    {
        $this->role = Role::where('id', $id_role)->first();
        $this->permisos = Permission::getAll();
        $this->titleRol = $role->title;

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
        dd("funcionamiento");
    }
}
