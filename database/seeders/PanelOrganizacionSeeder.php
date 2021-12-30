<?php

namespace Database\Seeders;

use App\Models\PanelOrganizacion;
use Illuminate\Database\Seeder;

class PanelOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $panel = [
            [
                'empresa' => 'true',
                'direccion' => 'true',
                'telefono' => 'true',
                'correo' => 'true',
                'pagina_web' => 'false',
                'giro' => 'false',
                'servicios' => 'false',
                'mision' => 'false',
                'vision' => 'false',
                'valores' => 'false',
                'team_id' => 'false',
                'antecedentes' => 'false',
                'logotipo' => 'false',
                'razon_social' => 'false',
                'rfc' => 'false',
                'representante_legal' => 'false',
                'fecha_constitucion' => 'false',
                'num_empleados' => 'false',
                'tamano' => 'false',
                'schedule' => 'false',
                'linkedln' => 'false',
                'facebook' => 'false',
                'youtube' => 'false',
                'twitter' => 'false',
                // 'redessociales' => 'false',
            ],
        ];

        PanelOrganizacion::insert($panel);
    }
}
