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
                'nombre' => 'Interfaz de usuario complicada',
            ],
            [
                'nombre' => 'Contraseñas predeterminadas no modificadas',
            ],
            [
                'nombre' => 'Eliminación de medios de almacenamiento sin eliminar datos',
            ],
            [
                'nombre' => 'Sensibilidad del equipo a los cambios de voltaje',
            ],
            [
                'nombre' => 'Sensibilidad del equipo a la humedad, temperatura o contaminantes',
            ],
            [
                'nombre' => 'Inadecuada seguridad del cableado',
            ],
            [
                'nombre' => 'Inadecuada gestión de capacidad del sistema',
            ],
            [
                'nombre' => 'Gestión inadecuada del cambio',
            ],
            [
                'nombre' => 'Clasificación inadecuada de la información',
            ],
            [
                'nombre' => 'Control inadecuado del acceso físico',
            ],
            [
                'nombre' => 'Mantenimiento inadecuado',
            ],
            [
                'nombre' => 'Inadecuada gestión de red',
            ],
            [
                'nombre' => 'Respaldo inapropiado o irregular',
            ],
            [
                'nombre' => 'Inadecuada gestión y protección de contraseñas',
            ],
            [
                'nombre' => 'Protección física no apropiada',
            ],
            [
                'nombre' => 'Reemplazo inadecuado de equipos viejos',
            ],
            [
                'nombre' => 'Falta de formación y conciencia sobre seguridad',
            ],
            [
                'nombre' => 'Inadecuada segregación de funciones',
            ],
            [
                'nombre' => 'Mala segregación de las instalaciones operativas y de prueba',
            ],
            [
                'nombre' => 'Insuficiente supervisión de los empleados y vendedores',
            ],
            [
                'nombre' => 'Especificación incompleta para el desarrollo de software',
            ],
            [
                'nombre' => 'Pruebas de software insuficientes',
            ],
            [
                'nombre' => 'Falta de política de acceso o política de acceso remoto',
            ],
            [
                'nombre' => 'Ausencia de política de escritorio limpio y pantalla clara',
            ],
            [
                'nombre' => 'Falta de control sobre los datos de entrada y salida',
            ],
            [
                'nombre' => 'Falta de documentación interna',
            ],
            [
                'nombre' => 'Carencia o mala implementación de la auditoría interna',
            ],
            [
                'nombre' => 'Falta de políticas para el uso de la criptografía',
            ],
            [
                'nombre' => 'Falta de procedimientos para eliminar los derechos de acceso a la terminación del empleo ',
            ],
            [
                'nombre' => 'Desprotección en equipos móviles',
            ],
            [
                'nombre' => 'Falta de redundancia, copia única',
            ],
            [
                'nombre' => 'Ausencia de sistemas de identificación y autenticación',
            ],
            [
                'nombre' => 'No validación de los datos procesados',
            ],
            [
                'nombre' => 'Ubicación vulnerable a inundaciones',
            ],
            [
                'nombre' => 'Mala selección de datos de prueba',
            ],
            [
                'nombre' => 'Copia no controlada de datos',
            ],
            [
                'nombre' => 'Descarga no controlada de Internet',
            ],
            [
                'nombre' => 'Uso incontrolado de sistemas de información',
            ],
            [
                'nombre' => 'Software no documentado',
            ],
            [
                'nombre' => 'Empleados desmotivados',
            ],
            [
                'nombre' => 'Conexiones a red pública desprotegidas',
            ],
            [
                'nombre' => 'Los derechos del usuario no se revisan regularmente',
            ],

        ];

        Vulnerabilidad::insert($vulnerabilidades);
    }
}
