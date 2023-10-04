<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConveniosModificatoriosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('convenios_modificatorios')->delete();

        \DB::table('convenios_modificatorios')->insert(array(
            0 =>
            array(
                'contrato_id' => 2,
                'no_convenio' => 'Convenio modificatorio al contrato abierto plurianual para la prestación del Servicio Administrado de Seguridad de la Información (SASI) número SE-25-2018',
                'fecha' => '2030-11-01',
                'descripcion' => 'Convenio modificatorio de las clausulas segunda y tercera del contrato principal.',
                'created_at' => '2022-03-10 18:01:54',
                'updated_at' => '2022-04-06 08:27:19',
                'deleted_at' => '2022-04-06 08:27:19',
            ),
            1 =>
            array(
                'contrato_id' => 2,
                'no_convenio' => 'CM09/2019',
                'fecha' => '2019-04-01',
                'descripcion' => 'Convenio modificatorio de las clausulas segunda y tercera del contrato principal.',
                'created_at' => '2022-04-04 13:36:39',
                'updated_at' => '2022-04-04 13:36:39',
                'deleted_at' => NULL,
            ),
            2 =>
            array(
                'contrato_id' => 10,
                'no_convenio' => 'con1',
                'fecha' => '2030-11-01',
                'descripcion' => 'test',
                'created_at' => '2022-04-05 15:23:27',
                'updated_at' => '2022-04-05 15:54:09',
                'deleted_at' => NULL,
            ),
            3 =>
            array(
                'contrato_id' => 10,
                'no_convenio' => 'conv2',
                'fecha' => '2022-04-05',
                'descripcion' => 'test',
                'created_at' => '2022-04-05 15:25:36',
                'updated_at' => '2022-04-05 15:54:24',
                'deleted_at' => NULL,
            ),
            4 =>
            array(
                'contrato_id' => 10,
                'no_convenio' => 'conv3',
                'fecha' => '2022-04-05',
                'descripcion' => 'test',
                'created_at' => '2022-04-05 15:27:51',
                'updated_at' => '2022-04-05 16:52:46',
                'deleted_at' => NULL,
            ),
            5 =>
            array(
                'contrato_id' => 9,
                'no_convenio' => 'Ejemplo',
                'fecha' => '2022-06-17',
                'descripcion' => 'test',
                'created_at' => '2022-04-06 10:03:30',
                'updated_at' => '2022-04-06 10:04:04',
                'deleted_at' => '2022-04-06 10:04:04',
            ),
            6 =>
            array(
                'contrato_id' => 9,
                'no_convenio' => 'prueba',
                'fecha' => '2021-04-29',
                'descripcion' => NULL,
                'created_at' => '2022-04-07 13:02:05',
                'updated_at' => '2022-04-07 13:03:38',
                'deleted_at' => '2022-04-07 13:03:38',
            ),
            7 =>
            array(
                'contrato_id' => 16,
                'no_convenio' => 'conv',
                'fecha' => '2022-04-26',
                'descripcion' => 'test',
                'created_at' => '2022-04-26 14:58:19',
                'updated_at' => '2022-04-26 14:58:19',
                'deleted_at' => NULL,
            ),
            8 =>
            array(
                'contrato_id' => 17,
                'no_convenio' => 'Convenio modificatorio al contrato plurianual para la prestación de servicios de renovación  de 11 licencias Mcaffe Enterprise Threat Protection y 2 licencias  Mcaffe Virus Scan for Storage, así como soporte técnico de la solución',
                'fecha' => '2021-03-11',
                'descripcion' => 'Cambio de Representante Legal de Silent4Business, S.A. de C.V., y de representante común reconociendo a la C. Lourdes del Pilar Abadía Velasco',
                'created_at' => '2022-05-20 08:44:23',
                'updated_at' => '2022-05-20 08:44:23',
                'deleted_at' => NULL,
            ),
            9 =>
            array(

                'contrato_id' => 8,
                'no_convenio' => 'CM-03/2022',
                'fecha' => '2022-05-31',
                'descripcion' => 'Modificación de Clausulas Segunda, Tercera y Decima Primera del contrato principal  y el numeral 20.  LUGARES ESTABLECIDOS PARA LA EJECUCIÓN DEL SERVICIO de su Anexo Único a efecto de ampliar los montos del mismo y la vigencia y plazo para la prestación del servicio, así como eliminar  de la prestación del servicio del inmueble de Vito Alessio Robles de la Secretaría de Energía y actualizar  los Representantes Legales de los Proveedores, para continuar  con la prestación  de servicio administrado de seguridad  de la información (SASI)',
                'created_at' => '2022-09-30 09:30:52',
                'updated_at' => '2022-09-30 09:30:52',
                'deleted_at' => NULL,
            ),
            10 =>
            array(

                'contrato_id' => 8,
                'no_convenio' => 'CM-09/2022',
                'fecha' => '2022-07-29',
                'descripcion' => 'Modificación de las clausulas  Segunda y Tercera del contrato principal, así como de las clausulas Segunda y Quinta del 1er Convenio para continuar  con la prestación del  "Servicio Administrado de Seguridad de la Información (SASI) por el periodo del 1 de agosto 2022 al 30 de noviembre de 2022.',
                'created_at' => '2022-09-30 09:49:40',
                'updated_at' => '2022-09-30 09:49:40',
                'deleted_at' => NULL,
            ),
            11 =>
            array(

                'contrato_id' => 19,
                'no_convenio' => 'SERV/DGRMSG/020-I/01/22',
                'fecha' => '2022-12-29',
                'descripcion' => 'Vigencia de convenio modificatorio: 1° al 15 de enero de 2023',
                'created_at' => '2023-04-11 13:41:17',
                'updated_at' => '2023-04-11 13:41:17',
                'deleted_at' => NULL,
            ),
            12 =>
            array(

                'contrato_id' => 93,
                'no_convenio' => 'Servicio de Evaluación de Riesgos PENSIONISSSTE-AD-043/2022',
                'fecha' => '0022-12-01',
                'descripcion' => NULL,
                'created_at' => '2023-04-14 10:38:57',
                'updated_at' => '2023-04-14 10:38:57',
                'deleted_at' => NULL,
            ),
            13 =>
            array(

                'contrato_id' => 177,
                'no_convenio' => 'SERV/DGRMSG/020-I/01/22',
                'fecha' => '2022-12-29',
                'descripcion' => 'Convenio Modificatorio SERV/DGRMSG/020-I/01/22 que cubrirá el periodo del 01 de enero de 2022 al 15 de enero del 2023. ',
                'created_at' => '2023-09-04 13:03:44',
                'updated_at' => '2023-09-04 13:03:44',
                'deleted_at' => NULL,
            ),
        ));
    }
}
