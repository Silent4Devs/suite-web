<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTemplateAnalisisBrechasIso extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'admin_template_analisis_brechas_iso',
                'name' => 'Este permiso permite al usuario poder ser administrador del top 8 de templates para analisis de brechas iso ',
            ]
            ];

            Permission::insert($permissions);
    }
}
