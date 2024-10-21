<?php

namespace Database\Seeders;

use App\Models\Modulo;
use App\Models\Submodulo;
use Illuminate\Database\Seeder;

class SubmodulosSeeder extends Seeder
{
    public function run()
    {
        $submodulos = [
            ['name' => 'Incidente de seguridad', 'modulo_name' => 'Centro de Atención'],
            ['name' => 'Mejoras', 'modulo_name' => 'Centro de Atención'],
            ['name' => 'Quejas', 'modulo_name' => 'Centro de Atención'],
            ['name' => 'Riesgos', 'modulo_name' => 'Centro de Atención'],
            ['name' => 'Sugerencias', 'modulo_name' => 'Centro de Atención'],
            ['name' => 'Denuncias', 'modulo_name' => 'Centro de Atención'],
            ['name' => 'Contratos', 'modulo_name' => 'Gestión Contractual'],
            ['name' => 'Revision por direccion', 'modulo_name' => 'Gestión Normativa'],
            ['name' => 'Perfil de puestos', 'modulo_name' => 'Gestión de Talento'],
        ];

        foreach ($submodulos as $submodulo) {
            $modulo = Modulo::where('name', $submodulo['modulo_name'])->first();
            Submodulo::create([
                'name' => $submodulo['name'],
                'modulo_id' => $modulo->id,
            ]);
        }
    }
}
