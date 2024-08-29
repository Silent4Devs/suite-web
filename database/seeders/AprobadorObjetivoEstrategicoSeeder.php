<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class AprobadorObjetivoEstrategicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            [
                'title' => 'aprobacion_objetivos_estrategicos',
                'name' => 'Este permiso permite al usuario aprobar o rechazar los objetivos estrategicos pendientes.',
            ],
        ];
        Permission::insert($permissions);
    }
}
