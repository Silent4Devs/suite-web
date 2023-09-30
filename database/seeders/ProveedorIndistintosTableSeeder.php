<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProveedorIndistintosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('proveedor_indistintos')->delete();
        
        \DB::table('proveedor_indistintos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'requisicion_id' => 3,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-08-15',
                'fecha_fin' => '2023-08-16',
                'created_at' => '2023-08-15 18:54:41',
                'updated_at' => '2023-08-15 18:54:41',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'requisicion_id' => 5,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-08-16',
                'fecha_fin' => '2024-01-16',
                'created_at' => '2023-08-16 16:18:19',
                'updated_at' => '2023-08-16 16:18:19',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'requisicion_id' => 11,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-08-21',
                'fecha_fin' => '2023-09-14',
                'created_at' => '2023-08-21 10:51:48',
                'updated_at' => '2023-08-21 10:51:48',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'requisicion_id' => 102,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-08',
                'fecha_fin' => '2023-09-21',
                'created_at' => '2023-09-08 13:54:35',
                'updated_at' => '2023-09-08 13:54:35',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 7,
                'requisicion_id' => 102,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-08',
                'fecha_fin' => '2023-09-21',
                'created_at' => '2023-09-08 13:54:35',
                'updated_at' => '2023-09-08 13:54:35',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 8,
                'requisicion_id' => 103,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-18',
                'fecha_fin' => '2023-09-29',
                'created_at' => '2023-09-13 11:08:22',
                'updated_at' => '2023-09-13 11:08:22',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 9,
                'requisicion_id' => 103,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-18',
                'fecha_fin' => '2023-09-30',
                'created_at' => '2023-09-13 11:08:22',
                'updated_at' => '2023-09-13 11:08:22',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 10,
                'requisicion_id' => 104,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-30',
                'fecha_fin' => '2023-09-30',
                'created_at' => '2023-09-13 13:32:16',
                'updated_at' => '2023-09-13 13:32:16',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 24,
                'requisicion_id' => 106,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-14',
                'fecha_fin' => '2023-09-18',
                'created_at' => '2023-09-14 09:39:54',
                'updated_at' => '2023-09-14 09:39:54',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 25,
                'requisicion_id' => 107,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-30',
                'fecha_fin' => '2023-09-30',
                'created_at' => '2023-09-14 10:25:14',
                'updated_at' => '2023-09-14 10:25:14',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 26,
                'requisicion_id' => 108,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-18',
                'fecha_fin' => '2024-09-17',
                'created_at' => '2023-09-14 23:18:46',
                'updated_at' => '2023-09-14 23:18:46',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 27,
                'requisicion_id' => 110,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-18',
                'fecha_fin' => '2023-09-18',
                'created_at' => '2023-09-18 15:50:30',
                'updated_at' => '2023-09-18 15:50:30',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 28,
                'requisicion_id' => 111,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-29',
                'fecha_fin' => '2023-09-30',
                'created_at' => '2023-09-18 16:12:36',
                'updated_at' => '2023-09-18 16:12:36',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 29,
                'requisicion_id' => 112,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-29',
                'fecha_fin' => '2023-10-01',
                'created_at' => '2023-09-19 13:03:14',
                'updated_at' => '2023-09-19 13:03:14',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 30,
                'requisicion_id' => 116,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-30',
                'fecha_fin' => '2023-10-01',
                'created_at' => '2023-09-20 11:02:27',
                'updated_at' => '2023-09-20 11:02:27',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 31,
                'requisicion_id' => 118,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-30',
                'fecha_fin' => '2023-09-30',
                'created_at' => '2023-09-20 15:31:28',
                'updated_at' => '2023-09-20 15:31:28',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 32,
                'requisicion_id' => 120,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-22',
                'fecha_fin' => '2023-09-28',
                'created_at' => '2023-09-21 12:52:11',
                'updated_at' => '2023-09-21 12:52:11',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 33,
                'requisicion_id' => 122,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-29',
                'fecha_fin' => '2023-09-29',
                'created_at' => '2023-09-22 11:57:00',
                'updated_at' => '2023-09-22 11:57:00',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 34,
                'requisicion_id' => 127,
                'proveedor_indistinto_id' => 0,
                'fecha_inicio' => '2023-09-26',
                'fecha_fin' => '2023-10-06',
                'created_at' => '2023-09-26 13:53:33',
                'updated_at' => '2023-09-26 13:53:33',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}