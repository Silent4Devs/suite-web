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
        
        \DB::table('productos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Servicio de administración telefónica',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '1',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Educación y Capacitación',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '2',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Gestión de eventos',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '3',
            ),
            3 => 
            array (
                'id' => 4,
                'descripcion' => 'Papeleria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '4',
            ),
            4 => 
            array (
                'id' => 5,
                'descripcion' => 'Servicio de mensajeria y transporte',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '5',
            ),
            5 => 
            array (
                'id' => 6,
                'descripcion' => 'Servicios de mantenimiento',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '6',
            ),
            6 => 
            array (
                'id' => 7,
                'descripcion' => 'Membresías',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '7',
            ),
            7 => 
            array (
                'id' => 8,
                'descripcion' => 'Ferias de empleo',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '8',
            ),
            8 => 
            array (
                'id' => 9,
                'descripcion' => 'Reclutamiento',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '9',
            ),
            9 => 
            array (
                'id' => 10,
                'descripcion' => 'Licencias Software',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '10',
            ),
            10 => 
            array (
                'id' => 11,
                'descripcion' => 'Renovación de Licenciamiento',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '11',
            ),
            11 => 
            array (
                'id' => 12,
                'descripcion' => 'Consultoria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '12',
            ),
            12 => 
            array (
                'id' => 13,
                'descripcion' => 'Actividades de Venta y Promoción de Negocios',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '13',
            ),
            13 => 
            array (
                'id' => 14,
                'descripcion' => 'Arrendamiento de equipos de cómputo',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '14',
            ),
            14 => 
            array (
                'id' => 15,
                'descripcion' => 'Pago de bases para licitación',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '15',
            ),
            15 => 
            array (
                'id' => 16,
                'descripcion' => 'Fianzas',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '16',
            ),
            16 => 
            array (
                'id' => 17,
                'descripcion' => 'Seguros',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '17',
            ),
            17 => 
            array (
                'id' => 18,
                'descripcion' => 'Diseño para marketing',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '18',
            ),
            18 => 
            array (
                'id' => 19,
                'descripcion' => 'Servicio de Arrendamiento de Servidores',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '19',
            ),
            19 => 
            array (
                'id' => 20,
                'descripcion' => 'Servicio de Soporte Tecnico',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '20',
            ),
            20 => 
            array (
                'id' => 21,
                'descripcion' => 'Renovación de Software',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '21',
            ),
            21 => 
            array (
                'id' => 22,
                'descripcion' => 'Servicio de soporte telefónico',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '22',
            ),
            22 => 
            array (
                'id' => 23,
                'descripcion' => 'Servicio de administración del correo de voz',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '23',
            ),
            23 => 
            array (
                'id' => 24,
                'descripcion' => 'Servicio de Ciberseguridad y Consultoría',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '24',
            ),
            24 => 
            array (
                'id' => 25,
                'descripcion' => 'Certificaciones',
                'created_at' => '2023-08-16 18:28:38',
                'updated_at' => '2023-08-16 18:29:13',
                'deleted_at' => NULL,
                'archivo' => 0,
                'clave' => '25',
            ),
        ));
        
        
    }
}