<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SucursalesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sucursales')->delete();

        \DB::table('sucursales')->insert([
            0 => [
                'clave' => '1',
                'descripcion' => 'SILENT4BUSINESS',
                'empresa' => 'SILENT4BUSINESS, S.A. DE C.V.',
                'cuenta_contable' => '1155.001',
                'estado' => 'AC',
                'zona' => 'ZONA A',
                'created_at' => null,
                'updated_at' => '2023-07-21 10:21:53',
                'deleted_at' => null,
                'archivo' => 0,
                'direccion' => 'Av. Insurgentes Sur 2453-piso 6, Tizapán San Ángel, Tizapán, Álvaro Obregón, 01090 Ciudad de México, CDMX',
                'rfc' => 'SIL160727HV7',
                'mylogo' => '64bab0a1488af.png',
            ],
            1 => [
                'clave' => '3',
                'descripcion' => 'SILENT4CLOUD',
                'empresa' => 'SILENT4CLOUD, S.A. DE C.V.',
                'cuenta_contable' => '0',
                'estado' => 'AC',
                'zona' => 'ZONA A',
                'created_at' => null,
                'updated_at' => '2023-07-21 10:21:27',
                'deleted_at' => null,
                'archivo' => 0,
                'direccion' => 'Av. Insurgentes Sur 2453-piso 6, Tizapán San Ángel, Tizapán, Álvaro Obregón, 01090 Ciudad de México, CDMX',
                'rfc' => 'SIL171219UW8',
                'mylogo' => '64bab0877f72d.png',
            ],
            2 => [
                'clave' => '5',
                'descripcion' => 'INTELEKTICS',
                'empresa' => 'INTELEKTICS, S.A. DE C.V.',
                'cuenta_contable' => '0',
                'estado' => 'AC',
                'zona' => 'ZONA A',
                'created_at' => null,
                'updated_at' => '2023-07-21 10:22:20',
                'deleted_at' => null,
                'archivo' => 0,
                'direccion' => 'torre murano',
                'rfc' => 'INTELEKTICS456789',
                'mylogo' => '64bab0bc327bd.png',
            ],
        ]);
    }
}
