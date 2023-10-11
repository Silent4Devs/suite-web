<?php

namespace Database\Seeders;

use App\Models\Amenaza;
use Illuminate\Database\Seeder;

class AmenazasTableSeeder extends Seeder
{
    /**
     * Run the database seeds. *.
     *
     * @return void
     */
    public function run()
    {
        $amenazas = [
            [
                'nombre' => 'Acceso a la red o al sistema de información por personas no autorizadas',
            ],
            [
                'nombre' => 'Amenaza o ataque con bomba',
            ],
            [
                'nombre' => 'Incumplimiento de relaciones contractuales',
            ],
            [
                'nombre' => 'Infracción legal',
            ],
            [
                'nombre' => 'Comprometer información confidencial',
            ],
            [
                'nombre' => 'Ocultar la identidad de un usuario',
            ],
            [
                'nombre' => 'Daño causado por un tercero',
            ],
            [
                'nombre' => 'Daños resultantes de las pruebas de penetración',
            ],
            [
                'nombre' => 'Destrucción de registros',
            ],
            [
                'nombre' => 'Desastre generado por causas humanas',
            ],
            [
                'nombre' => 'Desastre natural, incendio, inundación, rayo',
            ],
            [
                'nombre' => 'Revelación de información',
            ],
            [
                'nombre' => 'Divulgación de contraseñas',
            ],
            [
                'nombre' => 'Malversación y fraude',
            ],
            [
                'nombre' => 'Errores en mantenimiento',
            ],
            [
                'nombre' => 'Fallo de los enlaces de comunicación',
            ],
            [
                'nombre' => 'Falsificación de registros',
            ],
            [
                'nombre' => 'Espionaje industrial',
            ],
            [
                'nombre' => 'Fuga de información',
            ],
            [
                'nombre' => 'Interrupción de procesos de negocio',
            ],
            [
                'nombre' => 'Pérdida de electricidad',
            ],
            [
                'nombre' => 'Pérdida de servicios de apoyo',
            ],
            [
                'nombre' => 'Mal funcionamiento del equipo',
            ],
            [
                'nombre' => 'Código malicioso',
            ],
            [
                'nombre' => 'Uso indebido de los sistemas de información',
            ],
            [
                'nombre' => 'Uso indebido de las herramientas de auditoría',
            ],
            [
                'nombre' => 'Contaminación',
            ],
            [
                'nombre' => 'Errores de software',
            ],
            [
                'nombre' => 'Huelgas o paros',
            ],
            [
                'nombre' => 'Hurtos o vandalismo',
            ],
            [
                'nombre' => 'Cambio involuntario de datos en un sistema de información',
            ],
            [
                'nombre' => 'Cambios no autorizados de registros',
            ],
            [
                'nombre' => 'Instalación no autorizada de software',
            ],
            [
                'nombre' => 'Acceso físico no autorizado',
            ],
            [
                'nombre' => 'Uso no autorizado de material con copyright',
            ],
            [
                'nombre' => 'Uso no autorizado de software',
            ],
            [
                'nombre' => 'Error de usuario',
            ],
        ];

        Amenaza::insert($amenazas);
    }
}
