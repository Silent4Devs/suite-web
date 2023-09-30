<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConveniosModificatoriosFilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('convenios_modificatorios_files')->delete();
        
        \DB::table('convenios_modificatorios_files')->insert(array (
            0 => 
            array (
                'id' => 1,
                'convenios_file' => NULL,
                'convenios_modificatorios_id' => 1,
                'created_at' => '2022-03-10 18:01:54',
                'updated_at' => '2022-03-10 18:01:54',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'convenios_file' => NULL,
                'convenios_modificatorios_id' => 2,
                'created_at' => '2022-04-04 13:36:39',
                'updated_at' => '2022-04-04 13:36:39',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'convenios_file' => '05-04-20223Exam-excel-2l.docx',
                'convenios_modificatorios_id' => 3,
                'created_at' => '2022-04-05 15:23:27',
                'updated_at' => '2022-04-05 15:28:18',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'convenios_file' => '4employee7.xml',
                'convenios_modificatorios_id' => 4,
                'created_at' => '2022-04-05 15:25:36',
                'updated_at' => '2022-04-05 15:25:36',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'convenios_file' => '5TestCaseTemplate.xls',
                'convenios_modificatorios_id' => 5,
                'created_at' => '2022-04-05 15:27:51',
                'updated_at' => '2022-04-05 15:27:51',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'convenios_file' => NULL,
                'convenios_modificatorios_id' => 6,
                'created_at' => '2022-04-06 10:03:30',
                'updated_at' => '2022-04-06 10:03:30',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'convenios_file' => '07-04-20227UNE-ISO-IEC_27001-2014.pdf',
                'convenios_modificatorios_id' => 7,
                'created_at' => '2022-04-07 13:02:05',
                'updated_at' => '2022-04-07 13:02:46',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'convenios_file' => '8factura-0.pdf',
                'convenios_modificatorios_id' => 8,
                'created_at' => '2022-04-26 14:58:20',
                'updated_at' => '2022-04-26 14:58:20',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'convenios_file' => '9Actualizacion de Contrato.pdf',
                'convenios_modificatorios_id' => 9,
                'created_at' => '2022-05-20 08:44:23',
                'updated_at' => '2022-05-20 08:44:23',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'convenios_file' => '10CM 03 2022 S4B-Ampliación 2 meses.pdf',
                'convenios_modificatorios_id' => 10,
                'created_at' => '2022-09-30 09:30:52',
                'updated_at' => '2022-09-30 09:30:52',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'convenios_file' => '11Convenio 4 meses FIRMADO.pdf',
                'convenios_modificatorios_id' => 11,
                'created_at' => '2022-09-30 09:49:40',
                'updated_at' => '2022-09-30 09:49:40',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'convenios_file' => '122023-01-09 10-12.pdf',
                'convenios_modificatorios_id' => 12,
                'created_at' => '2023-04-11 13:41:17',
                'updated_at' => '2023-04-11 13:41:17',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'convenios_file' => '13CONSENTIMIENTO DE CONVENIO  MODIFICATORIO VULNERABILIDADES.pdf',
                'convenios_modificatorios_id' => 13,
                'created_at' => '2023-04-14 10:38:57',
                'updated_at' => '2023-04-14 10:38:57',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'convenios_file' => '14Contrato SERV-DGRMSG-020-I-O1-22 Cibersegurid.pdf',
                'convenios_modificatorios_id' => 14,
                'created_at' => '2023-09-04 13:03:45',
                'updated_at' => '2023-09-04 13:03:45',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}