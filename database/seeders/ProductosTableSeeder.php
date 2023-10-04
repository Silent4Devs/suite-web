<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('productos')->delete();

        \DB::table('productos')->insert(array(
            0 =>
            array(
                        'descripcion' => 'Servicio de administración telefónica',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '1',
            ),
            1 =>
            array(
                        'descripcion' => 'Educación y Capacitación',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '2',
            ),
            2 =>
            array(
                        'descripcion' => 'Gestión de eventos',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '3',
            ),
            3 =>
            array(
                        'descripcion' => 'Papeleria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '4',
            ),
            4 =>
            array(
                        'descripcion' => 'Servicio de mensajeria y transporte',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '5',
            ),
            5 =>
            array(
                        'descripcion' => 'Servicios de mantenimiento',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '6',
            ),
            6 =>
            array(
                        'descripcion' => 'Membresías',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '7',
            ),
            7 =>
            array(
                        'descripcion' => 'Ferias de empleo',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '8',
            ),
            8 =>
            array(
                        'descripcion' => 'Reclutamiento',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '9',
            ),
            9 =>
            array(

                'descripcion' => 'Licencias Software',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '10',
            ),
            10 =>
            array(

                'descripcion' => 'Renovación de Licenciamiento',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '11',
            ),
            11 =>
            array(

                'descripcion' => 'Consultoria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '12',
            ),
            12 =>
            array(

                'descripcion' => 'Actividades de Venta y Promoción de Negocios',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '13',
            ),
            13 =>
            array(

                'descripcion' => 'Arrendamiento de equipos de cómputo',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '14',
            ),
            14 =>
            array(

                'descripcion' => 'Pago de bases para licitación',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '15',
            ),
            15 =>
            array(

                'descripcion' => 'Fianzas',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '16',
            ),
            16 =>
            array(

                'descripcion' => 'Seguros',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '17',
            ),
            17 =>
            array(

                'descripcion' => 'Diseño para marketing',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '18',
            ),
            18 =>
            array(

                'descripcion' => 'Servicio de Arrendamiento de Servidores',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '19',
            ),
            19 =>
            array(

                'descripcion' => 'Servicio de Soporte Tecnico',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '20',
            ),
            20 =>
            array(

                'descripcion' => 'Renovación de Software',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '21',
            ),
            21 =>
            array(

                'descripcion' => 'Servicio de soporte telefónico',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '22',
            ),
            22 =>
            array(

                'descripcion' => 'Servicio de administración del correo de voz',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '23',
            ),
            23 =>
            array(

                'descripcion' => 'Servicio de Ciberseguridad y Consultoría',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '24',
            ),
            24 =>
            array(

                'descripcion' => 'Certificaciones',
                'created_at' => '2023-08-16 18:28:38',
                'updated_at' => '2023-08-16 18:29:13',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '25',
            ),
            25 =>
            array(

                'descripcion' => 'Regalos',
                'created_at' => '2023-08-24 13:43:14',
                'updated_at' => '2023-08-24 13:43:14',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '26',
            ),
            26 =>
            array(

                'descripcion' => 'Normas',
                'created_at' => '2023-08-31 12:46:26',
                'updated_at' => '2023-08-31 12:46:26',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '27',
            ),
            27 =>
            array(

                'descripcion' => 'Material promocional',
                'created_at' => '2023-09-06 16:21:19',
                'updated_at' => '2023-09-06 16:21:41',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '28',
            ),
            28 =>
            array(

                'descripcion' => 'Gestión de eventos',
                'created_at' => '2023-09-13 13:24:50',
                'updated_at' => '2023-09-13 13:24:50',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '29',
            ),
            29 =>
            array(

                'descripcion' => 'Exámenes de certificación',
                'created_at' => '2023-09-19 16:18:08',
                'updated_at' => '2023-09-19 16:18:39',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '30',
            ),
            30 =>
            array(

                'descripcion' => 'Discos / Unidad de estado solido externo',
                'created_at' => '2023-09-19 16:19:30',
                'updated_at' => '2023-09-19 16:19:30',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '31',
            ),
            31 =>
            array(

                'descripcion' => 'Tenable AD',
                'created_at' => '2023-09-21 18:59:22',
                'updated_at' => '2023-09-21 18:59:22',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '32',
            ),
        ));
    }
}