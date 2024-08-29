<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CentroCostosTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('centro_costos')->delete();

        \DB::table('centro_costos')->insert([
            0 => [
                'clave' => 1,
                'descripcion' => 'DIRECCIÓN GENERAL',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            1 => [
                'clave' => 2,
                'descripcion' => 'ADMINISTRACIÓN Y FINANZAS',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            2 => [
                'clave' => 3,
                'descripcion' => 'ADMINISTRACIÓN Y FINANZAS/GESTIÓN DE TALENTO',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            3 => [
                'clave' => 4,
                'descripcion' => 'ADMINISTRACIÓN Y FINANZAS/CONTABILIDAD',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            4 => [
                'clave' => 5,
                'descripcion' => 'ADMINISTRACIÓN Y FINANZAS/GESTIÓN DE SERVICIOS',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            5 => [
                'clave' => 6,
                'descripcion' => 'INNOVACIÓN Y DESARROLLO',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            6 => [
                'clave' => 7,
                'descripcion' => 'DIRECCIÓN COMERCIAL',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            7 => [
                'clave' => 8,
                'descripcion' => 'AREA DE OPERACIONES NOC/SOC',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            8 => [
                'clave' => 9,
                'descripcion' => 'CIBER-INTELIGENCIA',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            9 => [
                'clave' => 10,
                'descripcion' => 'CONSULTORIA ESTRATEGICA',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            10 => [
                'clave' => 11,
                'descripcion' => 'ADMINISTRACIÓN Y FINANZAS/CUMPLIMIENTO Y MEJORA CONTINUA',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            11 => [
                'clave' => 12,
                'descripcion' => 'ADMINISTRACIÓN Y FINANZAS/DIRECCION',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            12 => [
                'clave' => 13,
                'descripcion' => 'DIRECCIÓN GENERAL/DIRECCIÓN GRL',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            13 => [
                'clave' => 14,
                'descripcion' => 'DIRECCIÓN GENERAL/ASISTENTES DE DIRECCIÓN GRL',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            14 => [
                'clave' => 15,
                'descripcion' => 'ÁREA DE OPERACIONES NOC/SOC/OPERACIONES NOC/SOC',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            15 => [
                'clave' => 16,
                'descripcion' => 'ÁREA DE OPERACIONES NOC/SOC/SOPORTE INTERNO',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            16 => [
                'clave' => 17,
                'descripcion' => 'ÁREA DE OPERACIONES NOC/SOC/SERVICIOS ADMINISTRADOS',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            17 => [
                'clave' => 18,
                'descripcion' => 'ADMINISTRACIÓN Y FINANZAS/SERVICIOS GENERALES',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            18 => [
                'clave' => 19,
                'descripcion' => 'DIRECCIÓN COMERCIAL/MARKETING',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            19 => [
                'clave' => 20,
                'descripcion' => 'DIRECCIÓN COMERCIAL/VENTAS INFRAESTRUCTURA',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
            20 => [
                'clave' => 21,
                'descripcion' => 'DIRECCIÓN COMERCIAL/DIRECCIÓN COMERCIAL',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
            ],
        ]);
    }
}
