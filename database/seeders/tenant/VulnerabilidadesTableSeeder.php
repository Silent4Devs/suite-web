<?php

namespace Database\Seeders;

use App\Models\Vulnerabilidad;
use Illuminate\Database\Seeder;

class VulnerabilidadesTableSeeder extends Seeder
{
    public function run()
    {
        $vulnerabilidades = [

            [
                'id' => 1,
                'nombre' => 'Interfaz de usuario complicada',
            ],
            [
                'id' => 2,
                'nombre' => 'Contraseñas predeterminadas no modificadas',
            ],
            [
                'id' => 3,
                'nombre' => 'Eliminación de medios de almacenamiento sin eliminar datos',
            ],
            [
                'id' => 4,
                'nombre' => 'Sensibilidad del equipo a los cambios de voltaje',
            ],
            [
                'id' => 5,
                'nombre' => 'Sensibilidad del equipo a la humedad, temperatura o contaminantes',
            ],
            [
                'id' => 6,
                'nombre' => 'Inadecuada seguridad del cableado',
            ],
            [
                'id' => 7,
                'nombre' => 'Inadecuada gestión de capacidad del sistema',
            ],
            [
                'id' => 8,
                'nombre' => 'Gestión inadecuada del cambio',
            ],
            [
                'id' => 9,
                'nombre' => 'Clasificación inadecuada de la información',
            ],
            [
                'id' => 10,
                'nombre' => 'Control inadecuado del acceso físico',
            ],
            [
                'id' => 11,
                'nombre' => 'Mantenimiento inadecuado',
            ],
            [
                'id' => 12,
                'nombre' => 'Inadecuada gestión de red',
            ],
            [
                'id' => 13,
                'nombre' => 'Respaldo inapropiado o irregular',
            ],
            [
                'id' => 14,
                'nombre' => 'Inadecuada gestión y protección de contraseñas',
            ],
            [
                'id' => 15,
                'nombre' => 'Protección física no apropiada',
            ],
            [
                'id' => 16,
                'nombre' => 'Reemplazo inadecuado de equipos viejos',
            ],
            [
                'id' => 17,
                'nombre' => 'Falta de formación y conciencia sobre seguridad',
            ],
            [
                'id' => 18,
                'nombre' => 'Inadecuada segregación de funciones',
            ],
            [
                'id' => 19,
                'nombre' => 'Mala segregación de las instalaciones operativas y de prueba',
            ],
            [
                'id' => 20,
                'nombre' => 'Insuficiente supervisión de los empleados y vendedores',
            ],
            [
                'id' => 21,
                'nombre' => 'Especificación incompleta para el desarrollo de software',
            ],
            [
                'id' => 22,
                'nombre' => 'Pruebas de software insuficientes',
            ],
            [
                'id' => 23,
                'nombre' => 'Falta de política de acceso o política de acceso remoto',
            ],
            [
                'id' => 24,
                'nombre' => 'Ausencia de política de escritorio limpio y pantalla clara',
            ],
            [
                'id' => 25,
                'nombre' => 'Falta de control sobre los datos de entrada y salida',
            ],
            [
                'id' => 26,
                'nombre' => 'Falta de documentación interna',
            ],
            [
                'id' => 27,
                'nombre' => 'Carencia o mala implementación de la auditoría interna',
            ],
            [
                'id' => 28,
                'nombre' => 'Falta de políticas para el uso de la criptografía',
            ],
            [
                'id' => 29,
                'nombre' => 'Falta de procedimientos para eliminar los derechos de acceso a la terminación del empleo ',
            ],
            [
                'id' => 30,
                'nombre' => 'Desprotección en equipos móviles',
            ],
            [
                'id' => 31,
                'nombre' => 'Falta de redundancia, copia única',
            ],
            [
                'id' => 32,
                'nombre' => 'Ausencia de sistemas de identificación y autenticación',
            ],
            [
                'id' => 33,
                'nombre' => 'No validación de los datos procesados',
            ],
            [
                'id' => 34,
                'nombre' => 'Ubicación vulnerable a inundaciones',
            ],
            [
                'id' => 35,
                'nombre' => 'Mala selección de datos de prueba',
            ],
            [
                'id' => 36,
                'nombre' => 'Copia no controlada de datos',
            ],
            [
                'id' => 37,
                'nombre' => 'Descarga no controlada de Internet',
            ],
            [
                'id' => 38,
                'nombre' => 'Uso incontrolado de sistemas de información',
            ],
            [
                'id' => 39,
                'nombre' => 'Software no documentado',
            ],
            [
                'id' => 40,
                'nombre' => 'Empleados desmotivados',
            ],
            [
                'id' => 41,
                'nombre' => 'Conexiones a red pública desprotegidas',
            ],
            [
                'id' => 42,
                'nombre' => 'Los derechos del usuario no se revisan regularmente',
            ],

        ];

        Vulnerabilidad::insert($vulnerabilidades);
    }
}
