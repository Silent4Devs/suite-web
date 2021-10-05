<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenaza;

class AmenazasTableSeeder extends Seeder
{
    /**
     * Run the database seeds. *
     * @return void
     */
    public function run()
    {
        $amenazas = [
            [
                'id'    => 1,
                'Nombre' => 'Acceso a la red o al sistema de información por personas no autorizadas',
            ],
            [
                'id'    => 2,
                'Nombre' => 'Amenaza o ataque con bomba',
            ],
            [
                'id'    => 3,
                'Nombre' => 'Incumplimiento de relaciones contractuales',
            ],
            [
                'id'    => 4,
                'Nombre' => 'Infracción legal',
            ],
            [
                'id'    => 5,
                'Nombre' => 'Comprometer información confidencial',
            ],
            [
                'id'    => 6,
                'Nombre' => 'Ocultar la identidad de un usuario',
            ],
            [
                'id'    => 7,
                'Nombre' => 'Daño causado por un tercero',
            ],
            [
                'id'    => 8,
                'Nombre' => 'Daños resultantes de las pruebas de penetración',
            ],
            [
                'id'    => 9,
                'Nombre' => 'Destrucción de registros',
            ],
            [
                'id'    => 10,
                'Nombre' => 'Desastre generado por causas humanas',
            ],
            [
                'id'    => 11,
                'Nombre' => 'Desastre natural, incendio, inundación, rayo',
            ],
            [
                'id'    => 12,
                'Nombre' => 'Revelación de información',
            ],
            [
                'id'    => 14,
                'Nombre' => 'Divulgación de contraseñas',
            ],
            [
                'id'    => 15,
                'Nombre' => 'Malversación y fraude',
            ],
            [
                'id'    => 16,
                'Nombre' => 'Errores en mantenimiento',
            ],
            [
                'id'    => 17,
                'Nombre' => 'Fallo de los enlaces de comunicación',
            ],
            [
                'id'    => 18,
                'Nombre' => 'Falsificación de registros',
            ],
            [
                'id'    => 19,
                'Nombre' => 'Espionaje industrial',
            ],
            [
                'id'    => 20,
                'Nombre' => 'Fuga de información',
            ],
            [
                'id'    => 21,
                'Nombre' => 'Interrupción de procesos de negocio',
            ],
            [
                'id'    => 22,
                'Nombre' => 'Pérdida de electricidad',
            ],
            [
                'id'    => 23,
                'Nombre' => 'Pérdida de servicios de apoyo',
            ],
            [
                'id'    => 24,
                'Nombre' => 'Mal funcionamiento del equipo',
            ],
            [
                'id'    => 25,
                'Nombre' => 'Código malicioso',
            ],
            [
                'id'    => 26,
                'Nombre' => 'Uso indebido de los sistemas de información',
            ],
            [
                'id'    => 27,
                'Nombre' => 'Uso indebido de las herramientas de auditoría',
            ],
            [
                'id'    => 28,
                'Nombre' => 'Contaminación',
            ],
            [
                'id'    => 29,
                'Nombre' => 'Errores de software',
            ],
            [
                'id'    => 30,
                'Nombre' => 'Huelgas o paros',
            ],
            [
                'id'    => 31,
                'Nombre' => 'Hurtos o vandalismo',
            ],
            [
                'id'    => 32,
                'Nombre' => 'Cambio involuntario de datos en un sistema de información',
            ],
            [
                'id'    => 33,
                'Nombre' => 'Cambios no autorizados de registros',
            ],
            [
                'id'    => 34,
                'Nombre' => 'Instalación no autorizada de software',
            ],
            [
                'id'    => 35,
                'Nombre' => 'Acceso físico no autorizado',
            ],
            [
                'id'    => 36,
                'Nombre' => 'Uso no autorizado de material con copyright',
            ],
            [
                'id'    => 37,
                'Nombre' => 'Uso no autorizado de software',
            ],
            [
                'id'    => 38,
                'Nombre' => 'Error de usuario',
            ],
        ];

        Amenaza::insert($amenazas);
    }
}
