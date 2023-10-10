<?php

namespace Database\Seeders;

use App\Models\Amenaza;
use Illuminate\Database\Seeder;

class AmenazasTableSeeder extends Seeder
{
    /**
     * Run the database seeds. *.
     * @return void
     */
    public function run()
    {
        $amenazas = [
            [
                'id'    => 1,
                'nombre' => 'Acceso a la red o al sistema de información por personas no autorizadas',
            ],
            [
                'id'    => 2,
                'nombre' => 'Amenaza o ataque con bomba',
            ],
            [
                'id'    => 3,
                'nombre' => 'Incumplimiento de relaciones contractuales',
            ],
            [
                'id'    => 4,
                'nombre' => 'Infracción legal',
            ],
            [
                'id'    => 5,
                'nombre' => 'Comprometer información confidencial',
            ],
            [
                'id'    => 6,
                'nombre' => 'Ocultar la identidad de un usuario',
            ],
            [
                'id'    => 7,
                'nombre' => 'Daño causado por un tercero',
            ],
            [
                'id'    => 8,
                'nombre' => 'Daños resultantes de las pruebas de penetración',
            ],
            [
                'id'    => 9,
                'nombre' => 'Destrucción de registros',
            ],
            [
                'id'    => 10,
                'nombre' => 'Desastre generado por causas humanas',
            ],
            [
                'id'    => 11,
                'nombre' => 'Desastre natural, incendio, inundación, rayo',
            ],
            [
                'id'    => 12,
                'nombre' => 'Revelación de información',
            ],
            [
                'id'    => 14,
                'nombre' => 'Divulgación de contraseñas',
            ],
            [
                'id'    => 15,
                'nombre' => 'Malversación y fraude',
            ],
            [
                'id'    => 16,
                'nombre' => 'Errores en mantenimiento',
            ],
            [
                'id'    => 17,
                'nombre' => 'Fallo de los enlaces de comunicación',
            ],
            [
                'id'    => 18,
                'nombre' => 'Falsificación de registros',
            ],
            [
                'id'    => 19,
                'nombre' => 'Espionaje industrial',
            ],
            [
                'id'    => 20,
                'nombre' => 'Fuga de información',
            ],
            [
                'id'    => 21,
                'nombre' => 'Interrupción de procesos de negocio',
            ],
            [
                'id'    => 22,
                'nombre' => 'Pérdida de electricidad',
            ],
            [
                'id'    => 23,
                'nombre' => 'Pérdida de servicios de apoyo',
            ],
            [
                'id'    => 24,
                'nombre' => 'Mal funcionamiento del equipo',
            ],
            [
                'id'    => 25,
                'nombre' => 'Código malicioso',
            ],
            [
                'id'    => 26,
                'nombre' => 'Uso indebido de los sistemas de información',
            ],
            [
                'id'    => 27,
                'nombre' => 'Uso indebido de las herramientas de auditoría',
            ],
            [
                'id'    => 28,
                'nombre' => 'Contaminación',
            ],
            [
                'id'    => 29,
                'nombre' => 'Errores de software',
            ],
            [
                'id'    => 30,
                'nombre' => 'Huelgas o paros',
            ],
            [
                'id'    => 31,
                'nombre' => 'Hurtos o vandalismo',
            ],
            [
                'id'    => 32,
                'nombre' => 'Cambio involuntario de datos en un sistema de información',
            ],
            [
                'id'    => 33,
                'nombre' => 'Cambios no autorizados de registros',
            ],
            [
                'id'    => 34,
                'nombre' => 'Instalación no autorizada de software',
            ],
            [
                'id'    => 35,
                'nombre' => 'Acceso físico no autorizado',
            ],
            [
                'id'    => 36,
                'nombre' => 'Uso no autorizado de material con copyright',
            ],
            [
                'id'    => 37,
                'nombre' => 'Uso no autorizado de software',
            ],
            [
                'id'    => 38,
                'nombre' => 'Error de usuario',
            ],
        ];

        Amenaza::insert($amenazas);
    }
}
