<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermisosMensajeriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'title' => 'solicitud_mensajeria_acceder',
                'name' => 'Este permiso permite al usuario acceder a solicitud de mensajeria',
            ],
            [
                'title' => 'solicitud_mensajeria_crear',
                'name' => 'Este permiso permite al usuario crear solicitud de mensajeria',
            ],
            [
                'title' => 'solicitud_mensajeria_editar',
                'name' => 'Este permiso permite al usuario editar solicitud de mensajeria',
            ],
            [
                'title' => 'solicitud_mensajeria_ver',
                'name' => 'Este permiso permite al usuario ver solicitud de mensajeria',
            ],
            [
                'title' => 'solicitud_mensajeria_eliminar',
                'name' => 'Este permiso permite al usuario eliminar solicitud de mensajeria',
            ],
            [
                'title' => 'solicitud_mensajeria_ajustes',
                'name' => 'Este permiso permite al usuario ajustar solicitudes de mensajeria',
            ],
            [
                'title' => 'solicitud_mensajeria_atencion',
                'name' => 'Este permiso permite al usuario acceder al modulo de atencion de solicitudes de mensajeria',
            ],

        ];

        Permission::insert($permissions);

        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
    }
}
