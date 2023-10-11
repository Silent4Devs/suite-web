<?php

namespace Database\Seeders;

use App\Models\SubcategoriaIncidente;
use Illuminate\Database\Seeder;

class SubcategoriaIncidenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategorias = [
            [
                'id' => 1,
                'subcategoria' => 'Ataque dirigido',
                'categoria_id' => '1',
                'descripcion' => 'Es aquel en el que el objetivo (individuos u organizaciones) han sido elegidos deliberadamente. El ataque dirigido puede incluir otros tipos de incidentes (envío de código malicioso a través de correo electrónico, denegación de servicio, etc.), pero debido a su criticidad, el ataque dirigido se tiene en cuenta como un tipo de ataque independiente.',
            ],
            [
                'id' => 2,
                'subcategoria' => 'Modificación de sitios web (Defacement)',
                'categoria_id' => '1',
                'descripcion' => 'Ataque en el que un ciberdelincuente modifica una página web (contenido, aspecto, etc.), ya sea aprovechándose de vulnerabilidades que permiten el acceso al servidor donde se encuentra alojada la página, o vulnerabilidades del propio gestor de contenidos (software desactualizado o plugins no oficiales por ejemplo).',
            ],
            [
                'id' => 3,
                'subcategoria' => 'Infección extendida',
                'categoria_id' => '2',
                'descripcion' => 'Infección que a través de la ejecución de código malicioso (virus, scripts, gusanos, etc.), afecta a un conjunto de sistemas debido al fallo de las medidas establecidas de detección y/o contención.',
            ],
            [
                'id' => 4,
                'subcategoria' => 'Infección única',
                'categoria_id' => '2',
                'descripcion' => 'A diferencia de la infección extendida, ésta solo afecta a un dispositivo, usuario o sistema, compartiendo el resto de similitudes',
            ],
            [
                'id' => 5,
                'subcategoria' => 'Denegación de Servicio (DoS) o Denegación de Servicio Distribuida (DDoS)',
                'categoria_id' => '2',
                'descripcion' => '"El ataque más común se realiza mediante el envío de grandes cantidades de tráfico y/o peticiones, aunque también se puede conseguir a través de explotaciones de vulnerabilidades presentes en las infraestructuras de los sistemas. Puede ser:
                    Exitoso: se considera un ataque de denegación de servicio exitoso aquel cuyo resultado provoca que los sistemas no sean capaces de responder a las peticiones enviadas por los usuarios legítimos.
                    No exitoso: cuando el ataque ha sido mitigado por los sistemas de seguridad y no ha afectado a la continuidad del servicio."',
            ],
            [
                'id' => 6,
                'subcategoria' => 'Acceso no autorizado',
                'categoria_id' => '3',
                'descripcion' => 'Se produce cuando un ciberdelincuente logra el acceso a un sistema o recurso técnico ya sea física o remotamente. Este ataque puede tener su origen tanto interna como externamente.',
            ],
            [
                'id' => 7,
                'subcategoria' => 'Robo o pérdida de equipos',
                'categoria_id' => '3',
                'descripcion' => 'Se trata de la sustracción o pérdida de equipamiento TIC: ordenadores de sobremesa, portátiles, dispositivos de copias de seguridad, etc.',
            ],
            [
                'id' => 8,
                'subcategoria' => 'Pérdida de datos',
                'categoria_id' => '3',
                'descripcion' => 'Pérdida de información que puede comprometer la seguridad e integridad de una organización como consecuencia de la sustracción y pérdida de equipos.',
            ],
            [
                'id' => 9,
                'subcategoria' => 'Pruebas no autorizadas',
                'categoria_id' => '4',
                'descripcion' => 'Cualquier actividad que conlleve el acceso o la identificación de sistemas, cuentas de usuario, aplicaciones, etc., como paso previo a lanzar un ataque, una intrusión o realizar un uso ilícito de los mismos.',
            ],
            [
                'id' => 10,
                'subcategoria' => 'Alarmas de sistemas de monitorización',
                'categoria_id' => '4',
                'descripcion' => 'Son alarmas de los sistemas de seguridad (sistemas de filtrado web, cortafuegos, sistemas de detección de intrusiones, etc.) que son reveladores de intentos de acceso no habituales o sospechosos pero que no sirven para clasificar los incidentes en ninguna categoría.',
            ],
            [
                'id' => 11,
                'subcategoria' => 'Daños o cambios físicos no autorizados a los sistemas',
                'categoria_id' => '5',
                'descripcion' => 'Se producen cuando un ciberdelincuente consigue acceso físico a los sistemas y realiza cambios no autorizados en los mismos, por ejemplo, desconexión de cableado, vertido de sustancias, destrucción o fuego.',
            ],
            [
                'id' => 12,
                'subcategoria' => 'Abuso de privilegios o de políticas de seguridad de la información',
                'categoria_id' => '6',
                'descripcion' => 'Cuando un individuo realiza un uso ilegítimo de los sistemas y redes de una organización a los que tiene acceso.',
            ],
            [
                'id' => 13,
                'subcategoria' => 'Infracciones de derechos de autor o piratería',
                'categoria_id' => '6',
                'descripcion' => 'uso no autorizado o copia de material protegido por derechos de propiedad intelectual.',
            ],
            [
                'id' => 14,
                'subcategoria' => 'Uso indebido de la marca',
                'categoria_id' => '6',
                'descripcion' => 'empleo de elementos identificativos de la marca corporativa (nombre, logo, imágenes, etc.), con el fin de recabar información sensible sobre la misma (contraseñas, datos de usuarios, información confidencial, etc.) que permitirán la suplantación de la entidad legítima para realizar ataques de phishing.',
            ],
        ];

        SubcategoriaIncidente::insert($subcategorias);
    }
}
