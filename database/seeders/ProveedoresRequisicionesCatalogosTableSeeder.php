<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProveedoresRequisicionesCatalogosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('proveedores_requisiciones_catalogos')->delete();

        \DB::table('proveedores_requisiciones_catalogos')->insert(array(
            0 =>
            array(
                            'requisicion_id' => 1,
                'proveedor_id' => 34,
                'created_at' => '2023-08-14 10:42:32',
                'updated_at' => '2023-08-14 10:42:32',
                'fecha_inicio' => '2023-07-07',
                'fecha_fin' => '2024-07-07',
            ),
            1 =>
            array(
                            'requisicion_id' => 2,
                'proveedor_id' => 21,
                'created_at' => '2023-08-14 16:55:06',
                'updated_at' => '2023-08-14 16:55:06',
                'fecha_inicio' => '2023-08-14',
                'fecha_fin' => '2023-08-15',
            ),
            2 =>
            array(
                            'requisicion_id' => 4,
                'proveedor_id' => 34,
                'created_at' => '2023-08-16 09:23:21',
                'updated_at' => '2023-08-16 09:23:21',
                'fecha_inicio' => '2023-07-07',
                'fecha_fin' => '2023-07-07',
            ),
            3 =>
            array(
                            'requisicion_id' => 6,
                'proveedor_id' => 24,
                'created_at' => '2023-08-16 19:53:15',
                'updated_at' => '2023-08-16 19:53:15',
                'fecha_inicio' => '2023-08-16',
                'fecha_fin' => '2023-08-21',
            ),
            4 =>
            array(
                            'requisicion_id' => 7,
                'proveedor_id' => 34,
                'created_at' => '2023-08-17 14:04:08',
                'updated_at' => '2023-08-17 14:04:08',
                'fecha_inicio' => '2022-11-18',
                'fecha_fin' => '2023-01-29',
            ),
            5 =>
            array(
                            'requisicion_id' => 8,
                'proveedor_id' => 1,
                'created_at' => '2023-08-17 18:50:37',
                'updated_at' => '2023-08-17 18:50:37',
                'fecha_inicio' => '2023-08-17',
                'fecha_fin' => '2023-08-31',
            ),
            6 =>
            array(
                            'requisicion_id' => 12,
                'proveedor_id' => 1,
                'created_at' => '2023-08-21 13:41:02',
                'updated_at' => '2023-08-21 13:41:02',
                'fecha_inicio' => '2023-08-21',
                'fecha_fin' => '2023-08-25',
            ),
            7 =>
            array(

                'requisicion_id' => 14,
                'proveedor_id' => 77,
                'created_at' => '2023-08-21 16:42:58',
                'updated_at' => '2023-08-21 16:42:58',
                'fecha_inicio' => '2023-08-22',
                'fecha_fin' => '2023-08-25',
            ),
            8 =>
            array(

                'requisicion_id' => 15,
                'proveedor_id' => 61,
                'created_at' => '2023-08-22 09:42:18',
                'updated_at' => '2023-08-22 09:42:18',
                'fecha_inicio' => '2023-08-22',
                'fecha_fin' => '2023-08-25',
            ),
            9 =>
            array(

                'requisicion_id' => 16,
                'proveedor_id' => 34,
                'created_at' => '2023-08-22 16:45:19',
                'updated_at' => '2023-08-22 16:45:19',
                'fecha_inicio' => '2023-08-16',
                'fecha_fin' => '2024-12-31',
            ),
            10 =>
            array(

                'requisicion_id' => 17,
                'proveedor_id' => 14,
                'created_at' => '2023-08-23 08:22:29',
                'updated_at' => '2023-08-23 08:22:29',
                'fecha_inicio' => '3798-08-27',
                'fecha_fin' => '3604-08-01',
            ),
            11 =>
            array(

                'requisicion_id' => 85,
                'proveedor_id' => 1,
                'created_at' => '2023-08-24 13:49:08',
                'updated_at' => '2023-08-24 13:49:08',
                'fecha_inicio' => '2023-08-24',
                'fecha_fin' => '2023-08-24',
            ),
            12 =>
            array(

                'requisicion_id' => 86,
                'proveedor_id' => 77,
                'created_at' => '2023-08-24 17:33:42',
                'updated_at' => '2023-08-24 17:33:42',
                'fecha_inicio' => '2023-08-22',
                'fecha_fin' => '2023-08-25',
            ),
            13 =>
            array(

                'requisicion_id' => 87,
                'proveedor_id' => 63,
                'created_at' => '2023-08-25 12:07:38',
                'updated_at' => '2023-08-25 12:07:38',
                'fecha_inicio' => '2023-08-25',
                'fecha_fin' => '2023-08-25',
            ),
            14 =>
            array(

                'requisicion_id' => 88,
                'proveedor_id' => 8,
                'created_at' => '2023-08-28 09:25:30',
                'updated_at' => '2023-08-28 09:25:30',
                'fecha_inicio' => '2023-08-28',
                'fecha_fin' => '2023-08-31',
            ),
            15 =>
            array(

                'requisicion_id' => 89,
                'proveedor_id' => 34,
                'created_at' => '2023-08-29 11:42:59',
                'updated_at' => '2023-08-29 11:42:59',
                'fecha_inicio' => '2023-08-24',
                'fecha_fin' => '2023-12-31',
            ),
            16 =>
            array(

                'requisicion_id' => 92,
                'proveedor_id' => 78,
                'created_at' => '2023-08-30 16:28:44',
                'updated_at' => '2023-08-30 16:28:44',
                'fecha_inicio' => '2023-08-30',
                'fecha_fin' => '2023-08-31',
            ),
            17 =>
            array(

                'requisicion_id' => 93,
                'proveedor_id' => 1,
                'created_at' => '2023-08-30 16:46:50',
                'updated_at' => '2023-08-30 16:46:50',
                'fecha_inicio' => '2023-08-30',
                'fecha_fin' => '2023-08-30',
            ),
            18 =>
            array(

                'requisicion_id' => 94,
                'proveedor_id' => 79,
                'created_at' => '2023-08-31 15:06:56',
                'updated_at' => '2023-08-31 15:06:56',
                'fecha_inicio' => '2023-08-31',
                'fecha_fin' => '2023-08-31',
            ),
            19 =>
            array(

                'requisicion_id' => 96,
                'proveedor_id' => 81,
                'created_at' => '2023-09-04 19:16:34',
                'updated_at' => '2023-09-04 19:16:34',
                'fecha_inicio' => '2023-09-04',
                'fecha_fin' => '2023-09-05',
            ),
            20 =>
            array(

                'requisicion_id' => 97,
                'proveedor_id' => 81,
                'created_at' => '2023-09-04 19:27:02',
                'updated_at' => '2023-09-04 19:27:02',
                'fecha_inicio' => '2023-09-04',
                'fecha_fin' => '2023-09-05',
            ),
            21 =>
            array(

                'requisicion_id' => 98,
                'proveedor_id' => 61,
                'created_at' => '2023-09-06 10:47:12',
                'updated_at' => '2023-09-06 10:47:12',
                'fecha_inicio' => '2023-09-04',
                'fecha_fin' => '2023-09-04',
            ),
            22 =>
            array(

                'requisicion_id' => 99,
                'proveedor_id' => 14,
                'created_at' => '2023-09-06 11:03:38',
                'updated_at' => '2023-09-06 11:03:38',
                'fecha_inicio' => '2023-08-18',
                'fecha_fin' => '2024-08-18',
            ),
            23 =>
            array(

                'requisicion_id' => 100,
                'proveedor_id' => 82,
                'created_at' => '2023-09-06 16:25:30',
                'updated_at' => '2023-09-06 16:25:30',
                'fecha_inicio' => '2023-09-06',
                'fecha_fin' => '2023-09-06',
            ),
            24 =>
            array(

                'requisicion_id' => 101,
                'proveedor_id' => 81,
                'created_at' => '2023-09-07 16:00:26',
                'updated_at' => '2023-09-07 16:00:26',
                'fecha_inicio' => '2023-09-07',
                'fecha_fin' => '2023-09-11',
            ),
            25 =>
            array(

                'requisicion_id' => 109,
                'proveedor_id' => 61,
                'created_at' => '2023-09-18 10:58:24',
                'updated_at' => '2023-09-18 10:58:24',
                'fecha_inicio' => '2023-09-18',
                'fecha_fin' => '2023-09-18',
            ),
            26 =>
            array(

                'requisicion_id' => 113,
                'proveedor_id' => 82,
                'created_at' => '2023-09-19 13:43:27',
                'updated_at' => '2023-09-19 13:43:27',
                'fecha_inicio' => '2023-09-19',
                'fecha_fin' => '2023-09-25',
            ),
            27 =>
            array(

                'requisicion_id' => 114,
                'proveedor_id' => 1,
                'created_at' => '2023-09-19 16:27:12',
                'updated_at' => '2023-09-19 16:27:12',
                'fecha_inicio' => '2023-09-19',
                'fecha_fin' => '2023-09-19',
            ),
            28 =>
            array(

                'requisicion_id' => 115,
                'proveedor_id' => 1,
                'created_at' => '2023-09-19 16:32:34',
                'updated_at' => '2023-09-19 16:32:34',
                'fecha_inicio' => '2023-09-19',
                'fecha_fin' => '2023-09-19',
            ),
            29 =>
            array(

                'requisicion_id' => 117,
                'proveedor_id' => 61,
                'created_at' => '2023-09-20 13:05:46',
                'updated_at' => '2023-09-20 13:05:46',
                'fecha_inicio' => '2023-09-20',
                'fecha_fin' => '2023-09-20',
            ),
            30 =>
            array(

                'requisicion_id' => 119,
                'proveedor_id' => 81,
                'created_at' => '2023-09-21 12:51:15',
                'updated_at' => '2023-09-21 12:51:15',
                'fecha_inicio' => '2023-09-21',
                'fecha_fin' => '2023-09-21',
            ),
            31 =>
            array(

                'requisicion_id' => 121,
                'proveedor_id' => 11,
                'created_at' => '2023-09-21 13:46:23',
                'updated_at' => '2023-09-21 13:46:23',
                'fecha_inicio' => '2023-09-21',
                'fecha_fin' => '2023-09-21',
            ),
            32 =>
            array(

                'requisicion_id' => 121,
                'proveedor_id' => 40,
                'created_at' => '2023-09-21 13:46:23',
                'updated_at' => '2023-09-21 13:46:23',
                'fecha_inicio' => '2023-09-21',
                'fecha_fin' => '2023-09-21',
            ),
            33 =>
            array(

                'requisicion_id' => 123,
                'proveedor_id' => 82,
                'created_at' => '2023-09-22 16:42:33',
                'updated_at' => '2023-09-22 16:42:33',
                'fecha_inicio' => '2023-09-22',
                'fecha_fin' => '2023-09-22',
            ),
        ));
    }
}