<?php

namespace Database\Seeders;

use App\Models\ConfigurarSoporteModel;
use Illuminate\Database\Seeder;

class ConfigurarSoporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $confSoporte = [
            [
                'rol' => 'Soporte técnico',
                'puesto' => 'Líder de Innovación y Desarrollo',
                'telefono' => '5578233000',
                'extension' => '151',
                'tel_celular' => '5572480010',
                'correo' => 'miguel.gaspar@silent4business.com',
                'id_elaboro' => 6,

            ],
            [
                'rol' => 'Soporte técnico',
                'puesto' => 'Líder Técnico de Desarrollo',
                'telefono' => '5578233000',
                'extension' => '',
                'tel_celular' => '',
                'correo' => 'luis.vargas@silent4business.com',
                'id_elaboro' => 78,

            ],
            [
                'rol' => 'Soporte técnico',
                'puesto' => 'Líder Técnico de Desarrollo',
                'telefono' => '5578233000',
                'extension' => '',
                'tel_celular' => '',
                'correo' => 'uriel.santiago@silent4business.com',
                'id_elaboro' => 63,

            ],
            [
                'rol' => 'Consultor',
                'puesto' => 'Consultor Estratégico Jr.',
                'telefono' => '5578233000',
                'extension' => '146',
                'tel_celular' => '',
                'correo' => 'alejandro.pacheco@silent4business.com',
                'id_elaboro' => 18,

            ],
            [
                'rol' => 'Consultor',
                'puesto' => 'Líder de Consultoría Estratégica',
                'telefono' => '5578233000',
                'extension' => '158',
                'tel_celular' => '',
                'correo' => 'marco.luna@silent4business.com',
                'id_elaboro' => 52,

            ],
        ];
        ConfigurarSoporteModel::insert($confSoporte);
    }
}
