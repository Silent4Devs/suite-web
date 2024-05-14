<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('productos')->delete();

        \DB::table('productos')->insert([
            0 => [
                'descripcion' => 'Servicio de administración telefónica',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '1',
            ],
            1 => [
                'descripcion' => 'Educación y Capacitación',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '2',
            ],
            2 => [
                'descripcion' => 'Gestión de eventos',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '3',
            ],
            3 => [
                'descripcion' => 'Papeleria',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '4',
            ],
            4 => [
                'descripcion' => 'Servicio de mensajeria y transporte',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '5',
            ],
            5 => [
                'descripcion' => 'Servicios de mantenimiento',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '6',
            ],
            6 => [
                'descripcion' => 'Membresías',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '7',
            ],
            7 => [
                'descripcion' => 'Ferias de empleo',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '8',
            ],
            8 => [
                'descripcion' => 'Reclutamiento',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '9',
            ],
            9 => [

                'descripcion' => 'Licencias Software',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '10',
            ],
            10 => [

                'descripcion' => 'Renovación de Licenciamiento',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '11',
            ],
            11 => [

                'descripcion' => 'Consultoria',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '12',
            ],
            12 => [

                'descripcion' => 'Actividades de Venta y Promoción de Negocios',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '13',
            ],
            13 => [

                'descripcion' => 'Arrendamiento de equipos de cómputo',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '14',
            ],
            14 => [

                'descripcion' => 'Pago de bases para licitación',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '15',
            ],
            15 => [

                'descripcion' => 'Fianzas',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '16',
            ],
            16 => [

                'descripcion' => 'Seguros',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '17',
            ],
            17 => [

                'descripcion' => 'Diseño para marketing',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '18',
            ],
            18 => [

                'descripcion' => 'Servicio de Arrendamiento de Servidores',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '19',
            ],
            19 => [

                'descripcion' => 'Servicio de Soporte Tecnico',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '20',
            ],
            20 => [

                'descripcion' => 'Renovación de Software',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '21',
            ],
            21 => [

                'descripcion' => 'Servicio de soporte telefónico',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '22',
            ],
            22 => [

                'descripcion' => 'Servicio de administración del correo de voz',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '23',
            ],
            23 => [

                'descripcion' => 'Servicio de Ciberseguridad y Consultoría',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '24',
            ],
            24 => [

                'descripcion' => 'Certificaciones',
                'created_at' => '2023-08-16 18:28:38',
                'updated_at' => '2023-08-16 18:29:13',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '25',
            ],
            25 => [

                'descripcion' => 'Regalos',
                'created_at' => '2023-08-24 13:43:14',
                'updated_at' => '2023-08-24 13:43:14',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '26',
            ],
            26 => [

                'descripcion' => 'Normas',
                'created_at' => '2023-08-31 12:46:26',
                'updated_at' => '2023-08-31 12:46:26',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '27',
            ],
            27 => [

                'descripcion' => 'Material promocional',
                'created_at' => '2023-09-06 16:21:19',
                'updated_at' => '2023-09-06 16:21:41',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '28',
            ],
            28 => [

                'descripcion' => 'Gestión de eventos',
                'created_at' => '2023-09-13 13:24:50',
                'updated_at' => '2023-09-13 13:24:50',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '29',
            ],
            29 => [

                'descripcion' => 'Exámenes de certificación',
                'created_at' => '2023-09-19 16:18:08',
                'updated_at' => '2023-09-19 16:18:39',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '30',
            ],
            30 => [

                'descripcion' => 'Discos / Unidad de estado solido externo',
                'created_at' => '2023-09-19 16:19:30',
                'updated_at' => '2023-09-19 16:19:30',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '31',
            ],
            31 => [

                'descripcion' => 'Tenable AD',
                'created_at' => '2023-09-21 18:59:22',
                'updated_at' => '2023-09-21 18:59:22',
                'deleted_at' => null,
                'archivo' => 0,
                'clave' => '32',
            ],
        ]);
    }
}
