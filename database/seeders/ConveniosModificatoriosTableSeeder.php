<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConveniosModificatoriosTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('convenios_modificatorios')->delete();

        \DB::table('convenios_modificatorios')->insert([
            0 => [
                'id' => 1,
                'contrato_id' => 2,
            'no_convenio' => 'Convenio modificatorio al contrato abierto plurianual para la prestación del Servicio Administrado de Seguridad de la Información (SASI) número SE-25-2018',
                'fecha' => '2030-11-01',
                'descripcion' => 'Convenio modificatorio de las clausulas segunda y tercera del contrato principal.',
                'created_at' => '2022-03-10 18:01:54',
                'updated_at' => '2022-04-06 08:27:19',
                'deleted_at' => '2022-04-06 08:27:19',
            ],
            1 => [
                'id' => 2,
                'contrato_id' => 2,
                'no_convenio' => 'CM09/2019',
                'fecha' => '2019-04-01',
                'descripcion' => 'Convenio modificatorio de las clausulas segunda y tercera del contrato principal.',
                'created_at' => '2022-04-04 13:36:39',
                'updated_at' => '2022-04-04 13:36:39',
                'deleted_at' => null,
            ],
            2 => [
                'id' => 3,
                'contrato_id' => 10,
                'no_convenio' => 'con1',
                'fecha' => '2030-11-01',
                'descripcion' => 'test',
                'created_at' => '2022-04-05 15:23:27',
                'updated_at' => '2022-04-05 15:54:09',
                'deleted_at' => null,
            ],
            3 => [
                'id' => 4,
                'contrato_id' => 10,
                'no_convenio' => 'conv2',
                'fecha' => '2030-11-01',
                'descripcion' => 'test',
                'created_at' => '2022-04-05 15:25:36',
                'updated_at' => '2022-04-05 15:54:24',
                'deleted_at' => null,
            ],
            4 => [
                'id' => 5,
                'contrato_id' => 10,
                'no_convenio' => 'conv3',
                'fecha' => '2030-11-01',
                'descripcion' => 'test',
                'created_at' => '2022-04-05 15:27:51',
                'updated_at' => '2022-04-05 16:52:46',
                'deleted_at' => null,
            ],
        ]);
    }
}
