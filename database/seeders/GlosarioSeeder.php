<?php

namespace Database\Seeders;

use App\Models\Glosario;
use Illuminate\Database\Seeder;

class GlosarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $glosario = [
            [
                'numero' => '3.1',
                'norma' => 'ISO 27001',
                'concepto' => 'Control de Acceso',
                'definicion' => '“Medios para garantizar que el acceso a los activos esté autorizado y restringido según los
                            requisitos comerciales y de seguridad”',
                'explicacion' => 'El control de acceso es una forma de limitar el acceso a un sistema o a recursos físicos o
                            virtuales. En sistemas de la información, el control de acceso es un proceso mediante el cual
                            los usuarios obtienen acceso y ciertos privilegios a los sistemas, recursos o información.
                            En los sistemas de control de acceso, los usuarios deben presentar las credenciales antes de que
                            se les pueda otorgar el acceso. En los sistemas físicos, estas credenciales pueden tener muchas
                            formas, pero las credenciales que no se pueden transferir brindan la mayor seguridad.',
            ],
            [
                'numero' => '3.2',
                'norma' => 'ISO 27001',
                'concepto' => 'Ataque',
                'definicion' => '"Intentar destruir, exponer, alterar, deshabilitar, robar u obtener acceso no autorizado o hacer
                            un uso no autorizado de un activo"',
                'explicacion' => 'Los ataques cibernéticos son los mas comunes hoy en día. Un ciber ataque es un ataque contra un
                            sistema informático, una red o una aplicación o dispositivo habilitado para Internet. Los
                            piratas informáticos utilizan una variedad de herramientas para lanzar ataques, incluidos
                            malware, ransomware , kits de explotación y otros métodos.',
            ],
            [
                'numero' => '3.3.',
                'norma' => 'ISO 27001',
                'concepto' => 'Auditoría',
                'definicion' => 'Proceso sistemático, independiente y documentado para obtener evidencia de auditoría y evaluarla
                            objetivamente para determinar hasta qué punto se cumplen los criterios de auditoría.

                            Las auditorias pueden ser internas o externas

                            En cuanto a las auditorías Internas pueden ser realizadas por la misma organización o por una
                            parte externa en su nombre.

                            Los conceptos de "Evidencia de auditoría" y "criterios de auditoría" se definen en ISO 19011
                            dentro del proceso de recopilación de información para alcanzar las conclusiones de auditoria.
                        ',
                'explicacion' => 'Una auditoría incluye una verificación que garantice que la seguridad de la información cumple
                            con todas las expectativas y requisitos de la norma ISO 27001 dentro de una organización.
                            Durante este proceso, se revisa la documentación del SGSI se entrevista a los empleados sobre
                            los roles de seguridad y otros detalles relevantes.

                            Cada organización debe realizar auditorías de seguridad de forma periódica para garantizar que
                            los datos y los activos estén protegidos.

                            En primer lugar se define el alcance de la auditoría detallando los activos de la empresa
                            relacionados con la seguridad de la información, incluidos equipos informáticos, teléfonos,
                            redes, correo electrónico, datos y cualquier elemento relacionado con el acceso, como tarjetas,
                            tokens y contraseñas.
                            En segundo lugar, se deben revisar las amenazas de activos, tanto las que ya se han detectado
                            como las posibles o futuras. Para ello deberemos debe mantenerse al tanto de las nuevas
                            tendencias en el campo de la seguridad de la información, así como de las medidas de seguridad
                            adoptadas por otras compañías.
                            En tercer lugar, el equipo de auditoría debe estimar impacto que podría causar la posible
                            materialización de las amenazas para la seguridad de la informaciones este momento es cuando hay
                            que evaluar el plan y los controles establecidos para mantener las operaciones comerciales
                            después de que haya ocurrido una amenaza.
                            Finalmente deberemos evaluar la eficacia de las medidas de control establecidas y de la
                            evaluación del riesgo potencial de las amenazas a los distintos activos de información para
                            establecer informes de resultados de auditorías que nos permitan evaluar las necesidades de
                            mejora tanto en los controles establecidos como en las necesidades de hacer cambios en la
                            evaluación de los riesgos de los activos.',

            ],
            [
                'numero' => '3.4 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Alcance de Auditoría',
                'definicion' => 'Alcance y límites de una auditoría',
                'explicacion' => 'El alcance de una auditoria generalmente incluye una descripción de las áreas físicas, unidades
                            organizacionales, actividades y procesos, así como el periodo de tiempo cubierto',

            ],
            [
                'numero' => '3.5 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Autenticación',
                'definicion' => '"Garantía de que una característica reivindicada de una entidad es correcta"',
                'explicacion' => 'En el contexto de los sistemas informáticos, la autenticación es un proceso que garantiza y
                            confirma la identidad de un usuario. La autenticación es uno de los aspectos básicos en la
                            seguridad de la informacion, junto con los tres pilares, a saber: la integridad, disponibilidad,
                            y confidencialidad.

                            La autenticación comienza cuando un usuario intenta acceder a la información. Primero, el
                            usuario debe probar sus derechos de acceso y su identidad. Al iniciar sesión en una computadora,
                            los usuarios comúnmente ingresan nombres de usuario y contraseñas con fines de autenticación.
                            Esta combinación de inicio de sesión, que debe asignarse a cada usuario, autentica el acceso.
                            Sin embargo, este tipo de autenticación puede ser evitado por los hackers.

                            Una mejor forma de autenticación, la biométrica, depende de la presencia del usuario y la
                            composición biológica (es decir, la retina o las huellas dactilares). Esta tecnología hace que
                            sea más difícil para los piratas informáticos ingresar en los sistemas informáticos.

                            El método de autenticación de la infraestructura de clave pública (PKI) utiliza certificados
                            digitales para probar la identidad de un usuario. También hay otras herramientas de
                            autenticación, como tarjetas de claves y tokens USB. Una de las mayores amenazas de
                            autenticación ocurre con el correo electrónico, donde la autenticidad suele ser difícil de
                            verificar.',

            ],
            [
                'numero' => '3.6',
                'norma' => 'ISO 27001',
                'concepto' => 'Autenticidad',
                'definicion' => 'Propiedad que una entidad es lo que dice ser.',
                'explicacion' => '¿Qué es la autenticidad? ¿Qué entendemos por autenticidad en Seguridad de la Información? La
                            autenticidad es la seguridad de que un mensaje, una transacción u otro intercambio de
                            información proviene de la fuente de la que afirma ser. Autenticidad implica prueba de
                            identidad.

                            Podemos verificar la autenticidad a través de la autenticación . El proceso de autenticación
                            usualmente involucra más de una "prueba" de identidad (aunque una puede ser suficiente).

                            Asegurando la autenticidad. Para la interacción del usuario con los sistemas, programas y entre
                            sí, la autenticación es fundamental. La entrada de ID de usuario y contraseña es el método de
                            autenticación más frecuente. También parece presentar la mayoría de los problemas. Las
                            contraseñas pueden ser robadas u olvidadas. Descifrar contraseñas puede ser simple para los
                            hackers si las contraseñas no son lo suficientemente largas o no lo suficientemente complejas.
                            Recordar docenas de contraseñas para docenas de aplicaciones puede ser frustrante para usuarios
                            domésticos y usuarios empresariales',

            ],
            [
                'numero' => '3.7 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Disponibiidad',
                'definicion' => 'Propiedad de ser accesible y utilizable a solicitud de una entidad autorizada',
                'explicacion' => 'Los sistemas de almacenamiento de datos son los que en definitiva nos garantizan la
                            disponibilidad de la información. El almacenamiento de datos por lo general puede ser local o en
                            una instalación externa o en la nube. También pueden establecerse planes para garantizar la
                            disponibilidad de la información en instalaciones externas cuando fallan los elementos de
                            almacenamiento internos.
                            El caso es que la información debe estar disponible para en todo momento pero solo para aquellos
                            con autorización para acceder a ella.',

            ],
            [
                'numero' => '3.8 ',
                'norma' => 'ISO 27001',
                'concepto' => ' Medida Base',
                'definicion' => 'Definida en términos de un atributo y el método para cuantificarlo.
                            Una medida base es funcionalmente independiente de otras medidas ',
                'explicacion' => 'Se ha realizado un trabajo considerable para desarrollar medidas e indicadores que puedan
                            utilizarse para los resultados de los proyectos de desarrollo.

                            Los términos "medida", "métrica" e indicador "a menudo se usan indistintamente y sus
                            definiciones varían según los diferentes documentos y organizaciones. Por lo tanto, siempre es
                            útil verificar qué significan estos términos en contextos específicos.

                            Los términos que comúnmente se asocian con las mediciones incluyen:

                            Un objetivo es el valor de un indicador que se espera alcanzar en un punto específico en el
                            tiempo. A menudo se utiliza un punto de referencia para significar lo mismo.
                            Un índice es un conjunto de indicadores relacionados que pretenden proporcionar un medio para
                            realizar comparaciones significativas y sistemáticas de desempeño entre programas que son
                            similares en contenido y / o tienen las mismas metas y objetivos.
                            Un estándar es un conjunto de indicadores, puntos de referencia o índices relacionados que
                            proporcionan información socialmente significativa con respecto al desempeño.',

            ],

            [
                'numero' => '3.9',
                'norma' => 'ISO 27001',
                'concepto' => 'Competencia',
                'definicion' => 'Capacidad de aplicar conocimientos y habilidades para lograr los resultados esperados. ',
                'explicacion' => 'Hoy más que nunca, en el mundo interconectado y moderno se revela como algo absolutamente
                            necesario, establecer requisitos en las competencias para los profesionales de seguridad de la
                            información. Las peculiaridades del enfoque europeo para el desarrollo de las competencias
                            profesionales de la seguridad de la información se discuten utilizando el ejemplo del Marco
                            Europeo de Competencia Electrónica e-CF 3.0. Sobre esta base, se proponen dos incluso dos marcos
                            específicos, si bien breves de contenido, como son las nuevas normas internacionales ISO / IEC
                            27021 e ISO / IEC 19896.

                            Por otro lado, la cultura corporativa de una organización influye en el comportamiento de los
                            empleados y, en última instancia, contribuye a la efectividad de una organización. La
                            información es un activo vital para la mayoría de las organizaciones. Por lo tanto, idealmente,
                            una cultura corporativa debe incorporar controles de seguridad de la información en las rutinas
                            diarias y el comportamiento implícito de los empleados.

                            Sin duda el nivel de madurez de la “competencia “en seguridad de la información es un posible
                            método para evaluar en qué medida la seguridad de la información está incorporada en la cultura
                            corporativa actual de una organización.',

            ],

            [
                'numero' => '3.10',
                'norma' => 'ISO 27001',
                'concepto' => 'Confidencialidad',
                'definicion' => 'Propiedad por la que la información no se pone a disposición o se divulga a personas, entidades
                            o procesos no autorizados ',
                'explicacion' => 'La confidencialidad, cuando nos referimos a sistemas de información, permite a los usuarios
                            autorizados acceder a datos confidenciales y protegidos. Existen mecanismos específicos
                            garantizan la confidencialidad y salvaguardan los datos de intrusos no deseados o que van a
                            causar daño.

                            La confidencialidad es uno de los pilares de Seguridad de la información junto con la,
                            disponibilidad e integridad.

                            La información o los datos confidenciales deben divulgarse únicamente a usuarios
                            autorizados.Siempre que hablamos de confidencialidad en el ámbito de la seguridad de la
                            información nos hemos de plantear un sistema de clasificación de la información.

                            Por ejemplo, en el ámbito de la seguridad de la información en una organización militar, está
                            claro que se debe obtener un cierto nivel de autorización dependiendo de los requisitos de datos
                            a los que se puede o desea acceder. Según el caso, los datos pueden estar clasificados como
                            confidencial (secreta), o en un nivel superior como “Top Secret” “. Aquellos con autorizaciones
                            para acceder a datos confidenciales sin más no deben poder en ningún caso acceder a información
                            “Top Secret”.

                            Las mejores prácticas utilizadas para garantizar la confidencialidad son las siguientes:

                            * Un proceso de autenticación, que garantiza que a los usuarios autorizados se les asignen
                            identificaciones de usuario y contraseñas confidenciales. Otro tipo de autenticación es la
                            biométrica.
                            * Se pueden emplear métodos de seguridad basados en roles para garantizar la autorización del
                            usuario o del espectador. Por ejemplo, los niveles de acceso a los datos pueden asignarse al
                            personal del departamento específico.
                            * Los controles de acceso aseguran que las acciones del usuario permanezcan dentro de sus roles.
                            Por ejemplo, si un usuario está autorizado para leer pero no escribir datos, los controles del
                            sistema definidos pueden integrarse.',

            ],
            [
                'numero' => '3.11',
                'norma' => 'ISO 27001',
                'concepto' => 'Conformidad',
                'definicion' => 'Cumplimiento de un requisito ',
                'explicacion' => 'La conformidad es el “cumplimiento de un requisito”. Cumplir significa cumplir o cumplir con los
                            requisitos. Hay muchos tipos de requisitos. Existen requisitos de calidad, requisitos del
                            cliente, requisitos del producto, requisitos de gestión, requisitos legales, requisitos de la
                            seguridad de la información etc. Los requisitos pueden especificarse explícitamente (como los
                            requisitos de la norma ISO 27001) o estar implícitos. Un requisito específico es uno que se ha
                            establecido (en un documento, por ejemplo la política de seguridad o de uso del correo
                            electrónico). Cuando su organización cumple con un requisito, puede decir que cumple con ese
                            requisito.

                            La no conformidad es el "incumplimiento de un requisito". La no conformidad se refiere a la
                            falta de cumplimiento de los requisitos. Una no conformidad es una desviación de una
                            especificación, un estándar o una expectativa.

                            Un requisito es una necesidad, expectativa u obligación. Puede ser declarado o implícito por una
                            organización, sus clientes u otras partes interesadas. Hay muchos tipos de requisitos. Algunos
                            de estos incluyen requisitos de la Seguridad de la Informacion, Proteccion de datos personales,
                            requisitos del cliente, requisitos de gestión, requisitos del producto y requisitos legales.
                            Cuando su organización no cumple con uno de estos requisitos, se produce una no conformidad. ISO
                            27001 enumera los requisitos del sistema de gestión de la Seguridad de la informacion. Cuando su
                            organización se desvía de estos requisitos, se produce una no conformidad. Las no conformidades
                            se clasifican como críticas, mayores o menores.

                            No conformidad menor: cualquier no conformidad que no afecte de manera adversa la seguridad de
                            la información, el rendimiento, la durabilidad, la capacidad de intercambio, la fiabilidad, la
                            facilidad de mantenimiento, el uso u operación efectiva, el peso o la apariencia (cuando sea un
                            factor), la salud o la seguridad de un producto. Múltiples no conformidades menores cuando se
                            consideran colectivamente pueden elevar la categoría a una no conformidad mayor o crítica.

                            No conformidad Mayor: cualquier no conformidad que no sea crítica, que puede dar lugar a fallas
                            o reducir sustancialmente la seguridad de la información, la capacidad de uso del producto para
                            el propósito previsto y que no pueda ser completamente eliminada por medidas correctivas o
                            reducido a una no conformidad menor por un un control establecido.

                            No conformidad crítica: cualquier no conformidad sobre la seguridad de la información que pueda
                            causar daño a las personas, su imagen o su reputación, tanto las que usan, mantienen o dependen
                            del producto, o aquellas que impiden el desempeño de procesos críticos para la organización.
                        ',

            ],

            [
                'numero' => '3.12 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Consecuencia',
                'definicion' => 'Resultado de un evento que afecta a los objetivos ',
                'explicacion' => 'Como vemos las consecuencias son algo relacionado con los eventos y los objetivos de la
                            seguridad de la información.

                            EVENTOS

                            Un evento en la seguridad de la información es un cambio en las operaciones diarias de una red o
                            servicio de tecnología de la información que indica que una política de seguridad puede haber
                            sido violada o que un control de seguridad puede haber fallado.

                            Cuando un evento afecta a los resultados de un proceso o tiene consecuencias no deseadas como la
                            interrupción de servicios, pérdida de datos o afecta a la confidencialidad, disponibilidad o
                            integridad de la información entonces decimos que es un evento con consecuencias.

                            En un contexto informático, los eventos incluyen cualquier ocurrencia identificable que tenga
                            importancia para el hardware o software del sistema.

                            Los eventos de seguridad son aquellos que pueden tener importancia para la seguridad de los
                            sistemas o datos. La primera indicación de un evento puede provenir de una alerta definida por
                            software o de que los usuarios finales notifiquen al departamento de mantenimiento o al centro
                            de soporte que, por ejemplo, los servicios de red se han desacelerado.

                            Como regla general, un evento es una ocurrencia o situación relativamente menor que se puede
                            resolver con bastante facilidad y los eventos que requieren que un administrador de TI tome
                            medidas y clasifique los eventos cuando sea necesario como como incidentes.

                            Un ticket del departamento de soporte de un solo usuario que informa que cree haber contraído un
                            virus es un evento de seguridad, ya que podría indicar un problema de seguridad. Sin embargo, si
                            se encuentra evidencia del virus en el ordenador del usuario, puede considerarse un incidente de
                            seguridad.

                            Según los informes de los organismos nacionales de ciberseguridad se producen decenas de miles
                            de eventos de seguridad por día en las grandes organizaciones. Los productos de seguridad, como
                            el software antivirus, pueden reducir la cantidad de eventos de seguridad y muchos procesos de
                            respuesta de incidencia pueden automatizarse para que la carga de trabajo sea más manejable.

                            SISTEMAS DE ADMINISTRACION DE EVENTOS (¿QUE SON?)

                            Los eventos que no requieren la acción de un administrador pueden ser manejados automáticamente
                            por la información de seguridad y por sistemas denominados de administración de eventos (SIEM).

                            Los sistemas de administración de información y eventos nacieron en el entorno de la industria
                            de métodos de pago por tarjeta para luego extenderse como solución para grandes y medianas
                            empresas

                            Se trata de ver todos los datos relacionados con la seguridad desde un único punto de vista para
                            facilitar que las organizaciones de todos los tamaños detecten patrones fuera de lo común
                            aplicando

                            Tecnologías de la información (firewalls, antivirus, prevención de intrusiones
                            Bases de datos (Registros de información y patrones de comportamientos)
                            Inteligencia artificial
                            Análisis forense y de comportamientos
                            Informes de seguridad
                            OBJETIVOS DE SEGURIDAD

                            Los sistemas de información son vulnerables a la modificación, intrusión o mal funcionamiento.

                            Los sistemas de gestión para la seguridad de la información tienen como objetivo proteger a los
                            sistemas de estas amenazas. Para ello se establecen criterios basados en una evaluación previa
                            de los riesgos que estas amenazas suponen para poner los controles necesarios de forma que las
                            pérdidas o perjuicios esperados por estas amenazas se encuentren en algún momento en niveles
                            aceptables

                            Para definir los objetivos de seguridad podríamos tener en cuenta el siguiente principio
                            fundamental:

                            "La protección de los intereses de quienes dependen de la información, y los sistemas de
                            información y Comunicaciones que entregan la información, por daños resultantes de fallas de
                            disponibilidad, confidencialidad e integridad”

                            El objetivo de seguridad utiliza tres términos.

                            Disponibilidad los sistemas de información en cuanto a que estén disponibles y se pueden
                            utilizar cuando sea necesario;
                            Confidencialidad los datos y la información son revelados solamente a aquellos que tienen
                            derecho a saber de ella
                            La Integridad los datos y la información están protegidos contra modificaciones no autorizadas
                            (integridad).
                            La prioridad relativa y la importancia de la disponibilidad, la confidencialidad y la integridad
                            varían de acuerdo con los datos y su clasificación dentro del sistema de información y el
                            contexto empresarial en el que se utiliza.',

            ],

            [
                'numero' => '3.13',
                'norma' => 'ISO 27001',
                'concepto' => 'Mejora Continua',
                'definicion' => 'Actividad recurrente para mejorar el rendimiento ',
                'explicacion' => 'Si la mejora se define como acciones que se traducen en una mejora de los resultados, entonces
                            la mejora continua es simplemente identificar y realizar cambios enfocados a conseguir la mejora
                            del rendimiento y resultados de una organización. La mejora continua es un concepto que es
                            fundamental para las teorías y programas de gestión de la calidad y de la seguridad de la
                            información. La mejora continua es clave para la gestión de la seguridad de la Información

                            La seguridad de la información es un problema complejo en muchos sentidos: redes complejas,
                            requisitos complejos y tecnología compleja. Pero sería mucho más manejable si fuera estático.
                            Sin embargo, está lejos de ser estático. Se agregan nuevos sistemas a la red. Los requisitos del
                            negocio cambian con frecuencia. Y el panorama de amenazas es extremadamente dinámico. Gestionar
                            la seguridad en este entorno es un reto importante.

                            Una clave para una administración de seguridad efectiva es comprender el estado actual de los
                            riesgos y las tareas de la seguridad de la información

                            La complejidad introduce intrínsecamente errores, huecos y los oculta al mismo tiempo.

                            Con los cambios casi constantes que ocurren en la red y el panorama dinámico de amenazas, se
                            requiere una evaluación continua de la seguridad.

                            La forma más efectiva de automatizar este análisis es establecer controles, definiciones de
                            configuración o comportamiento correctos o incorrectos y evaluar continuamente la seguridad de
                            la red con respecto a esos controles. Lo que hace con este análisis es lo que separa a las
                            organizaciones de seguridad verdaderamente efectivas del resto.

                            Mejorar la seguridad requiere algo más que arreglar lo que está roto. Requiere medir la
                            efectividad de las operaciones de seguridad; Tecnología, personas y procesos. La evaluación
                            continua de los controles de seguridad definidos y la medición de los resultados a lo largo del
                            tiempo crea un marco para medir las operaciones de seguridad.

                            Establecer la expectativa de que la mejora es el objetivo, dará como resultado una mejor
                            seguridad.',

            ],
            [
                'numero' => '3.14',
                'norma' => 'ISO 27001',
                'concepto' => 'Control',
                'definicion' => 'Medida que modifica un riesgo.',
                'explicacion' => 'Los controles de seguridad son medidas de seguridad técnicas o administrativas para evitar,
                            contrarrestar o minimizar la pérdida o falta de disponibilidad debido a las amenazas que actúan
                            por una vulnerabilidad asociada a la amenaza. En esto consiste un riesgo de seguridad.

                            Los controles están referenciados casi siempre a un aspecto de la seguridad, pero rara vez se
                            definen.

                            Los controles también se pueden definir por su propia naturaleza, como controles de compensación
                            técnicos, administrativos, de personal, preventivos, de detección y correctivos, así como
                            controles generales.

                            Esto de los controles de seguridad podría parecer algo extremadamente técnico sin embargo la
                            experiencia nos dice que el “ambiente de control” establece el tono de una organización,
                            influyendo en la conciencia de control de su gente. Es la base de todos los otros componentes
                            del control interno como son la disciplina y la estructura.

                            Los valores éticos en una organización se desarrollan también con la competencia de su personal
                            y el estilo con el que se organizan y hacen cumplir los controles establecidos, también para la
                            seguridad de la información

                            En primer lugar, encontramos los controles asociados a las acciones que las personas toman,
                            llamamos a estos controles administrativos.

                            Los controles administrativos son el proceso de desarrollar y garantizar el cumplimiento de las
                            políticas y los procedimientos. Tienden a ser cosas que los empleados pueden hacer, o deben
                            hacer siempre, o no pueden hacer. Otra clase de controles en seguridad que se llevan a cabo o
                            son administrados por sistemas informáticos, estos son controles técnicos.

                            Los controles de la fase de actividad pueden ser técnicos o administrativos y se clasifican de
                            la siguiente manera:

                            Controles preventivos para evitar que la amenaza entre en contacto con la debilidad.
                            Controles de detección para identificar que la amenaza ha aterrizado en nuestros sistemas.
                            Controles correctivos para mitigar o disminuir los efectos de la amenaza que se manifiesta.',

            ],

            [
                'numero' => '3.15',
                'norma' => 'ISO 27001',
                'concepto' => 'Objetivo de Control',
                'definicion' => 'Declaración que describe lo que se debe lograr como resultado de la implementación de controles
                            (3.14)',
                'explicacion' => 'Este concepto hace posible cumplir con la filosofía de la norma ISO 27001 donde la base de la
                            misma se encuentra el ciclo PDCA donde se hace imprescindible conocer y averiguar hasta qué
                            punto se alcanzan los objetivos

                            En concreto:

                            En la planificación del sistema se establecen los objetivos
                            En la implantación del sistema se debe establecen en qué medida se alcanzan sus objetivos
                            En la monitorización del sistema deberemos realizar una medición real del desempeño de los
                            objetivos
                            En la Evaluación del desempeño deberemos evaluar el cumplimiento de los objetivos y establecer
                            medidas de mejora si fueran necesarias
                            Los requisitos de la norma ISO 27001 nos llevan a establecer al menos dos tipos de objetivos
                            medibles

                            Objetivos medibles para los procesos de Gestión de Seguridad de la Información y en general para
                            todo el SGSI
                            Objetivos para los controles de seguridad
                            Esto no quita que podamos definir objetivos a otros niveles como departamentos, personales etc.
                        ',

            ],

            [
                'numero' => '3.16',
                'norma' => 'ISO 27001',
                'concepto' => 'Corrección',
                'definicion' => 'Acción para eliminar una no conformidad detectada',
                'explicacion' => 'Una no conformidad es cualquier incumplimiento de un requisito. VEASE 3.11

                            Un requisito puede ser el de un cliente, de un organismo legal o regulador, de la normas ISO
                            27001 o de un procedimiento interno de la propia organización o de la seguridad de la
                            información.

                            A la hora de reaccionar ante una no conformidad podemos tomar acciones para

                            Corregir una no conformidad tratando las consecuencias inmediatas
                            Determinar las causas de la no conformidad para eliminarlas mediante una acción correctiva de
                            forma que ya no se vuelva a producir
                            En este sentido una correccción se define como la acción tomada para evitar las consecuencias
                            inmediatas de una no conformidad.',

            ],

            [
                'numero' => '3.17',
                'norma' => 'ISO 27001',
                'concepto' => 'Acción Correctiva',
                'definicion' => 'Acción para eliminar la causa de una no conformidad y para prevenir la recurrencia.',
                'explicacion' => 'Una acción correctiva se define como la acción tomada para evitar la repetición de una no
                            conformidad mediante la identificación y tratamiento de las causas que la provocaron.',

            ],

            [
                'numero' => '3.18',
                'norma' => 'ISO 27001',
                'concepto' => 'Medida Derivada',
                'definicion' => 'Medida (3.42) que se define como una función de dos o más valores de medidas base (3.8)',
                'explicacion' => 'Las medidas o indicadores derivados son aquellos que se establecen en base a otro indicador
                            existente. Los indicadores derivados normalmente se refieren a:

                            Fórmulas de Cálculo como los subtotales o funciones de agregación dinámica de datos como son los
                            datos pre-calculados como por ejemplo sumas continuas etc.
                            Datos o indicadores y de funciones sin agregación dinámica intrínseca o propia como pueden ser
                            cálculos de promedios o conteo de ocurrencias de la variable o medida base.',

            ],

            [
                'numero' => '3.19',
                'norma' => 'ISO 27001',
                'concepto' => 'Información Documentada',
                'definicion' => 'Se refiere a la información necesaria que una organización debe controlar y mantener actualizada
                            tomando en cuenta y el soporte en que se encuentra. La información documentada puede estar en
                            cualquier formato (audio, video, ficheros de texto etc.) así como en cualquier tipo de soporte o
                            medio independientemente de la fuente de dicha información. En general la información
                            documentada se refiere a:

                            * Al sistema de gestión y sus procesos
                            * Información necesaria para la actividad de la propia
                            * Evidencias o registros de los resultados obtenidos en cualquier proceso del sistema de gestión
                            o de la organización',
                'explicacion' => 'En un sistema de gestión no debemos pasar por alto el control y la organización de nuestra
                            documentación de forma que cumplamos con los requisitos para almacenar, administrar y revisar la
                            documentación.

                            En primer lugar deberemos garantizar que los contenidos de la documentación sean adecuados y
                            describan de la forma más práctica y correcta posible los procesos ya que la documentación debe
                            ser la herramienta para demostrar que se han implementado correctamente los procesos.

                            A veces una estructura demasiado compleja con distintos niveles de información y accesos
                            diferenciados puede no ser necesaria y complicar las cosas innecesariamente

                            Nuestra experiencia nos enseña que la mayoría de las veces basta con una buena asesoría de
                            implementación en Sistemas de Gestión para organizar la información de acuerdo a lo que la
                            organización necesita y que diseñas un sistema propio de gestión documental puede resultar
                            costoso y un gasto de tiempo y recursos que no siempre es necesario.',

            ],

            [
                'numero' => '3.20 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Efectividad',
                'definicion' => 'En qué medida se realizan las actividades planificadas y se logran los resultados planificados.
                        ',
                'explicacion' => 'Un sistema de Gestión para la seguridad de la información es un conjunto de elementos
                            interrelacionados entre sí mediante las múltiples actividades de la organización. Cada actividad
                            definida por un proceso tendrá una o varias entradas así como salidas, necesarias por lo demás
                            para su control. Todas las salidas de los procesos estarán enfocadas a la consecución de los
                            objetivos de la seguridad de la información de la organización. La eficacia por tanto es la
                            medida en que los procesos contribuyen a la consecución de los objetivos de la Seguridad de la
                            Información. En el caso la eficacia de los procesos se medirá en el orden en que contribuyen a
                            la consecución de los objetivos de seguridad de la información

                            La efectividad se refiere al grado en que se logra un efecto planificado para la seguridad de la
                            información. Las actividades planeadas para la seguridad de la información serán efectivas si
                            estas actividades se realizan de acuerdo a lo planificado en los objetivos para la seguridad de
                            la información.

                            De manera similar, los resultados planificados son efectivos si estos resultados se logran
                            realmente.

                            La efectividad consiste en hacer lo planificado, completar las actividades y alcanzar los
                            objetivos.',

            ],

            [
                'numero' => '3.21',
                'norma' => 'ISO 27001',
                'concepto' => 'Evento',
                'definicion' => 'Ocurrencia o cambio de un conjunto particular de circunstancias

                            Un evento puede ser repetitivo y puede tener varias causas.
                            Un evento puede consistir en algo que no sucede.
                            Un evento puede ser clasificado como un “incidente” o “accidente”.',
                'explicacion' => 'Un evento de seguridad es cualquier ocurrencia observable que sea relevante para la seguridad de
                            la información. Esto puede incluir intentos de ataques o fallos que descubren vulnerabilidades
                            de seguridad existentes

                            Hemos de diferenciar los eventos en la seguridad de la información de los incidentes de
                            seguridad. Un incidente es un evento de seguridad que provoca daños o riesgos para los activos y
                            operaciones de seguridad de la información.

                            Un evento de seguridad es algo que sucede que podría tener implicaciones de seguridad de la
                            información. Un correo electrónico no deseado es un evento de seguridad porque puede contener
                            enlaces a malware. Las organizaciones pueden recibir miles o incluso millones de eventos de
                            seguridad identificables cada día. Estos normalmente se manejan mediante herramientas
                            automatizadas o simplemente se registran.

                            Un incidente de seguridad es un evento de seguridad que provoca daños como la pérdida de datos.
                            Los incidentes también pueden incluir eventos que no implican daños, pero son riesgos viables.
                            Por ejemplo, un empleado que hace clic en un enlace en un correo electrónico no deseado que lo
                            hizo a través de los filtros puede ser visto como un incidente.

                            Los eventos de seguridad pasan en su mayoría inadvertidos para los usuarios. En el momento que
                            los usuarios detectan actividad sospechosa, normalmente se recomienda que se reporte como un
                            incidente.',

            ],

            [
                'numero' => '3.22 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Contexto Externo',
                'definicion' => 'Entorno externo en el que la organización busca alcanzar sus objetivos el contexto externo puede
                            incluir :

                            El entorno cultural, social, político, jurídico, reglamentario, financiero, tecnológico,
                            económico, natural y competitivo, ya sea internacional, nacional, regional o local;
                            Influencias y tendencias clave que tienen impacto en los objetivos de la organización
                            los valores de actores externos y como es percibida la organización (sus relaciones con el
                            entorno externo)',
                'explicacion' => 'Para definir correctamente el contexto externo podríamos comenzar por un análisis del entorno
                            centrándonos en aquellos factores que podrían afectar a la organización o que están relacionados
                            con las actividades y objetivos de la organización.

                            El proceso de definición del contexto externo no es un proceso que se realiza una sola vez y ya
                            hemos terminado, sino que necesitamos controlar en todo momento los cambios en los entornos
                            externos, y tener en cuenta los puntos de vista de las partes interesadas.

                            También podemos investigar el entorno externo de forma sistemática. Un enfoque simple para
                            realizar esta tareas seria comenzar con una lista de puntos en torno a los siguientes factores,
                            que luego pueden desarrollarse:

                            Los factores políticos son la medida en que los gobiernos o las influencias políticas pueden
                            impactar o impulsar las tendencias o culturas globales, regionales, nacionales, locales y
                            comunitarias. Pueden incluir estabilidad política, política exterior, prácticas comerciales y
                            relaciones laborales.
                            Los factores económicos incluyen tendencias y factores globales, nacionales y locales, mercados
                            financieros, ciclos crediticios, crecimiento económico, tasas de interés, tasas de cambio, tasas
                            de inflación y costo de capital.
                            Los factores sociales incluyen cultura, conciencia de salud, demografía, educación, crecimiento
                            de la población, actitudes profesionales y énfasis en la seguridad.
                            Los factores tecnológicos incluyendo sistemas informáticos, avances o limitaciones tecnológicas,
                            inteligencia artificial, robótica, automatización, incentivos tecnológicos, la tasa de cambio
                            tecnológico, investigación y desarrollo, etc.
                            Jurídico – Cuestiones legislativas o reglamentarias y sensibilidades.
                            Los factores ambientales incluyen el clima global, regional y local, el clima adverso, los
                            peligros naturales, los desechos peligrosos y las tendencias relacionadas.',

            ],

            [
                'numero' => '3.23 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Gobernanza de la Seguridad de la Información',
                'definicion' => 'Sistema por el cual las actividades de seguridad de la información de una organización son
                            dirigidas y controladas.',
                'explicacion' => 'El gobierno de la seguridad de la información es la estrategia de una empresa para reducir el
                            riesgo de acceso no autorizado a los sistemas y datos de tecnología de la información.

                            Las actividades de gobierno de la seguridad implican el desarrollo, la planificación, la
                            evaluación y la mejora de la gestión de riesgos para la seguridad de la información y las
                            políticas de seguridad de una organización

                            El gobierno de la seguridad de la empresa incluye determinar cómo las distintas unidades de
                            negocio de la organización, los ejecutivos y el personal deben trabajar juntos para proteger los
                            activos digitales de una organización, garantizar la prevención de pérdida de datos y proteger
                            la reputación pública de la organización.

                            Las actividades de gobierno de la seguridad de la empresa deben ser coherentes con los
                            requisitos de cumplimiento, la cultura y las políticas de gestión de la organización.

                            El desarrollo y el mantenimiento de la gobernanza de la seguridad de la información pueden
                            requerís la realización de pruebas de análisis de amenazas, vulnerabilidades y riesgos que son
                            específicas para la industria de la empresa.

                            El gobierno de la seguridad de la información también se refiere a la estrategia de la empresa
                            para reducir la posibilidad de que los activos físicos que son propiedad de la empresa puedan
                            ser robados o dañados. En este contexto, el gobierno de la seguridad incluye barreras físicas,
                            cerraduras, sistemas de cercado y respuesta a incendios, así como sistemas de iluminación,
                            detección de intrusos, alarmas y cámaras.',

            ],

            [
                'numero' => '3.24 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Órgano Rector',
                'definicion' => 'Persona o grupo de personas que son responsables del desempeño de la organización. El órgano
                            rector puede ser una junta directiva o consejo de administración. ',
                'explicacion' => 'En el caso de la seguridad de la información el órgano rector será el responsable del desempeño
                            o el resultado del sistema de gestión de la seguridad de la información. EN definitiva, el
                            órgano rector tendrá la responsabilidad de rendir cuentas del rendimiento del sistema de gestión
                            de la seguridad de la información

                            Este factor es algo que aún no es asumido por muchas empresas donde vemos que ante los fallos de
                            seguridad producidos en grandes empresas en los últimos años revelan que menos de la mitad de
                            los directivos de estas empresas están al tanto verdaderamente de las políticas de seguridad de
                            la información dentro de sus propias organizaciones.

                            El problema al que nos enfrentamos es bastante más frecuente de lo que imaginamos. Basta pensar
                            que en la actualidad simplemente cuesta aun encontrar una reunión del consejo de administración
                            de una gran empresa, dedicado a los riesgos de tecnología de la información y las estrategias
                            para abordar los riesgos.

                            Es por ello que la norma insiste en dedicar todo un capítulo de LIDERAZGO a dejar claro que la
                            responsabilidad de impulsar y mantener el sistema de gestión para la seguridad de la información
                            reside en los órganos rectores de cada organización.',

            ],

            [
                'numero' => '3.25',
                'norma' => 'ISO 27001',
                'concepto' => 'Indicador',
                'definicion' => 'Medida que proporciona una estimación o evaluación.',
                'explicacion' => 'Los indicadores para la evaluación de la seguridad de la información a menudo sirven como
                            evidencia forense de posibles intrusiones en un sistema o red host.

                            Un sistema de información debe permitir a los especialistas de la seguridad de la información y
                            a los administradores del sistema detectar intentos de intrusión u otras actividades maliciosas.

                            Los indicadores permiten analizar y mejorar las técnicas y comportamientos ante un malware o
                            amenaza en particular. Estos indicadores también proporcionan datos para entender mejor las
                            amenazas, generando información valiosa para compartir dentro de la comunidad para mejorar aún
                            más la respuesta a incidentes y las estrategias de respuesta de una organización.

                            Normalmente los indicadores se pueden sacar en los dispositivos que se encuentran en los
                            registros de eventos y las entradas de un sistema, así como en sus aplicaciones y servicios.
                            Para ello los administradores de sistemas también emplean herramientas que monitorean los
                            dispositivos y redes para ayudar a mitigar, si no prevenir, violaciones o ataques.

                            Aquí hay algunos indicadores que se utilizar habitualmente en sistemas de seguridad de la
                            información:

                            Tráfico inusual que entra y sale de la red
                            Archivos desconocidos en aplicaciones y procesos en el sistema.
                            Actividad sospechosa en administrador o cuentas privilegiadas.
                            Actividades irregulares como el tráfico o actividad en sistemas que normalmente no se utilizan
                            Inicios de sesión, acceso y otras actividades de red que indiquen ataques de sondeo o de fuerza
                            bruta
                            Picos anómalos de solicitudes y volumen de lectura en archivos de la empresa
                            Tráfico de red que atraviesa puertos inusualmente utilizados
                            Configuraciones de archivos, servidores de nombres de dominio (DNS) y registro alterados, así
                            como cambios en la configuración del sistema, incluidos los de dispositivos móviles
                            Grandes cantidades de archivos comprimidos y datos inexplicablemente encontrados en lugares
                            donde no deberían estar de la empresa para reducir la posibilidad de que los activos físicos que
                            son propiedad de la empresa puedan ser robados o dañados. En este contexto, el gobierno de la
                            seguridad incluye barreras físicas, cerraduras, sistemas de cercado y respuesta a incendios, así
                            como sistemas de iluminación, detección de intrusos, alarmas y cámaras.',
            ],

            [
                'numero' => '3.26 ',
                'norma' => 'ISO 27001',
                'concepto' => 'Necesidad de Información',
                'definicion' => 'Conocimiento necesario para gestionar objetivos, riesgos y problemas.',
                'explicacion' => 'Este es un concepto relacionado con el desarrollo de procesos de medición que determinen qué
                            información de medición se requiere, cómo se deben aplicar las medidas y los resultados del
                            análisis, y cómo determinar si los resultados del análisis son válidos más que nada en
                            escenarios aplicables a las disciplinas de ingeniería y gestión de sistemas y software.

                            Para establecer los objetivos de seguridad de la información que tengan en cuenta los riesgos y
                            las amenazas deberemos establecer unos criterios de necesidad de información. Se trata en
                            definitiva de contar con un modelo que defina las actividades que se requieren para especificar
                            adecuadamente el proceso de medición para obtener dicha información.

                            Idealmente los procesos de medición deben ser flexibles, adaptables y adaptables a las
                            necesidades de los diferentes usuarios.',
            ],

            [
                'numero' => '3.27',
                'norma' => 'ISO 27001',
                'concepto' => 'Instalaciones de Procesamiento de Información',
                'definicion' => 'Cualquier sistema de procesamiento de información, servicio o infraestructura, o la ubicación
                            física que lo alberga.',
                'explicacion' => 'Las instalaciones de procesamiento de información en una empresa, deben ser consideradas como un
                            activo de información que es necesario alcanzar las metas y objetivos de la organización

                            Para comprender esto en el escenario de una certificación de una norma de seguridad de la
                            información debemos tener en cuenta que deberemos afrontar una auditoría de las instalaciones de
                            procesamiento de información demostrando que está controlada y puede garantizar un procesamiento
                            oportuno, preciso y eficiente de los sistemas de información y aplicaciones en condiciones
                            normales y generalmente disruptivas.

                            De acuerdo con la norma ISO 27001, una auditoría de instalaciones de procesamiento de
                            información es la evaluación de cualquier sistema, servicio, infraestructura o ubicación física
                            que contenga y procese información. Una instalación puede ser una actividad o un lugar que puede
                            ser tangible o intangible; así como, un hardware o un software.',
            ],

            [
                'numero' => '3.28',
                'norma' => 'ISO 27001',
                'concepto' => 'Seguridad de la Información',
                'definicion' => 'Preservación de la confidencialidad, integridad y disponibilidad de la información

                            Además hay que considerar otras propiedades, como la autenticidad, la responsabilidad, el no
                            repudio y la confiabilidad también pueden estar involucrados.',
                'explicacion' => 'La seguridad de la información como vemos tiene por objetivo la protección de la
                            confidencialidad, integridad y disponibilidad de los datos de los sistemas de información de
                            cualquier amenaza y de cualquiera que tenga intenciones maliciosas.

                            La confidencialidad, la integridad y la disponibilidad a veces se conocen como la tríada de
                            seguridad de la información que actualmente ha evolucionado incorporando nuevos conceptos tales
                            como la autenticidad, la responsabilidad, el no repudio y la confiabilidad.

                            La seguridad de la información debe ser considerada desde la base de un análisis y evaluación de
                            riesgos teniendo en cuenta cualquier factor que pueda actuar como un riesgo o una amenaza para
                            la confidencialidad, integridad y disponibilidad etc. de los datos

                            La información confidencial debe conservarse; no puede modificarse, modificarse ni transferirse
                            sin permiso. Por ejemplo, un mensaje podría ser modificado durante la transmisión por alguien
                            que lo intercepte antes de que llegue al destinatario deseado. Las buenas herramientas de
                            criptografía pueden ayudar a mitigar esta amenaza de seguridad.

                            Las firmas digitales pueden mejorar la seguridad de la información al mejorar los procesos de
                            autenticidad y hacer que las personas prueben su identidad antes de poder acceder a los datos de
                            un sistema de información.',
            ],

            [
                'numero' => '3.29',
                'norma' => 'ISO 27001',
                'concepto' => 'Continuidad de la Seguridad de la Información',
                'definicion' => 'Procesos y procedimientos para garantizar la continuidad de las operaciones de seguridad de la
                            información',
                'explicacion' => 'El termino continuidad de la seguridad de la información se utiliza dentro de la norma ISO 27001
                            para describir el proceso que garantice la confidencialidad, integridad y disponibilidad de la
                            información cuando un incidente ocurre o una amenaza se materializa.

                            Con cierta frecuencia se interpreta este punto como una necesidad de contar con planes de
                            continuidad del negocio asumiendo como requisito la implementación de un plan de continuidad del
                            negocio integral para cumplir con el punto de la norma que nos habla de la continuidad de la
                            seguridad de la información.

                            Un plan de continuidad del negocio sin duda puede ser una gran ayuda para garantizar que las
                            funciones de seguridad de la información se mantengan aunque no es un requisito de la norma ISO
                            27001 un plan de seguridad integran enfocado a la continuidad de los servicios en general

                            Entonces, ¿Qué significa realmente la continuidad de la seguridad de la información? La
                            continuidad de la seguridad de la información significa en principio garantizar que tengamos la
                            capacidad de mantener las medidas de protección de la información cuando ocurra un incidente.

                            En este sentido hemos de tener en cuenta que la continuidad de la seguridad de la información
                            debería ir un paso más adelante que la continuidad del negocio aunque la continuidad del negocio
                            no es objeto de la norma 27001

                            En un caso hipotético de imposibilidad de acceso instalaciones debido a un incidente cualquiera
                            deberíamos tener en cuenta en primer lugar poder garantizar que la empresa pueda continuar
                            operando, que los clientes puedan recibir servicios, que los pagos se procesen y que los
                            servicios sigan funcionando, es decir, la continuidad comercial tradicional. Pero desde una
                            perspectiva de seguridad de la información, también debe poder asegurarse de que los datos estén
                            protegidos mientras se implementan métodos de trabajo alternativos, por ejemplo, los usuarios
                            que acceda por teletrabajo y procesan datos confidenciales.',
            ],

            [
                'numero' => '3.30',
                'norma' => 'ISO 27001',
                'concepto' => 'Evento de Seguridad de la Información',
                'definicion' => 'Ocurrencia identificada de un sistema, servicio o estado de red que indica un posible
                            incumplimiento de la política de seguridad de la información o falla de los controles o una
                            situación desconocida que puede ser relevante para la seguridad.',
                'explicacion' => 'Podríamos considerar como un evento en la seguridad de la información a cualquier cambio
                            observado en el comportamiento normal de un sistema de información, entorno, proceso, flujo de
                            trabajo o persona y que pueda afectar a la seguridad de la información. Por ejemplo: si se
                            encuentran modificaciones en las listas de control de acceso para un router o modificaciones en
                            las reglas de configuración de un firewall.

                            Debemos distinguir además de la diferencia entre un evento de seguridad de la información y las
                            alertas. Una alerta es una notificación de que se ha producido un evento en particular (o una
                            serie de eventos), que y que se envía a los responsables para la seguridad de la información en
                            cada caso con el propósito de generar una acción.',
            ],

            [
                'numero' => '3.31',
                'norma' => 'ISO 27001',
                'concepto' => 'Incidente de Seguridad de la Información',
                'definicion' => 'Un evento o una serie de eventos de seguridad de la información no deseados o inesperados que
                            tienen una probabilidad significativa de comprometer las operaciones comerciales y amenazar la
                            seguridad de la información.',
                'explicacion' => 'Un incidente de seguridad de la información puede definirse también como cualquier evento que
                            tenga el potencial de afectar la preservación de la confidencialidad, integridad, disponibilidad
                            o valor de la información

                            Aquí les dejamos una lista con varios ejemplos típicos de incidentes en la seguridad de la
                            información:

                            Revelación no autorizada o accidental de información clasificada o sensible; p.ej. envió de un
                            correo electrónico que contiene información confidencial o clasificada enviada a destinatarios
                            incorrectos.
                            Robo o pérdida de información clasificada o sensible; p.ej. copia impresa de clasificados o
                            sensibles
                            Información robada de un maletín olvidado en un restaurante o perdido
                            Modificación no autorizada de información clasificada o sensible; p.ej. alterando copia maestra
                            de registro de estudiante o personal
                            Robo o pérdida de equipo que contiene información clasificada o sensible; p.ej. ordenador
                            portátil que contiene información confidencial o clasificada
                            Acceso no autorizado a los sistemas de información de la Organización; p.ej. Ejemplo de virus,
                            malware, ataque de denegación de servicio.
                            Acceso no autorizado a áreas que contienen equipo de TI que almacena información confidencial o
                            confidencial; p.ej. entrada no autorizada en un centro de datos o salas de control de la red
                            informática.',
            ],

            [
                'numero' => '3.32',
                'norma' => 'ISO 27001',
                'concepto' => 'Gestión de Incidentes de Seguridad de a Información',
                'definicion' => 'Conjunto de procesos para detectar, informar, evaluar, responder, tratar y aprender de los
                            incidentes de seguridad de la información.',
                'explicacion' => 'El conjunto de procesos para tratar los incidentes de la seguridad de la información debe

                            Identificar,
                            Administrar y registrar,
                            Analizar las amenazas en tiempo real
                            Buscar respuestas sólidas y completas a cualquier problema
                            Mantener una infraestructura que permita realizar estas funciones
                            Hemos de tener en cuenta que un incidente de seguridad puede ser cualquier cosa, desde una
                            amenaza activa hasta un intento de intrusión que ha generado un riesgo o ha conseguido
                            comprometer la seguridad generando una violación de datos. También debemos considerar las
                            violaciones a las políticas y el acceso no autorizado a datos como salud, finanzas, números de
                            seguridad social y registros de identificación personal etc.

                            EL PROCESO DE GESTIÓN DE INCIDENTES DE INFORMACION

                            La gestión de incidentes de la seguridad de la información debe en primer lugar responder a las
                            amenazas que día a día crecen tanto en volumen como en sofisticación. Pero no debemos quedarnos
                            solamente en adoptar medidas sino que se trata más bien de adoptar prácticas que además de
                            identificar, responder y mitigar lo más rápidamente posible cualquier tipo de incidentes, al
                            mismo tiempo nos hagan más resistentes y nos protejan contra futuros incidentes.

                            El proceso de gestión de incidentes de seguridad de la información generalmente comienza con una
                            alerta que nos provee de la información necesaria sobre el incidente para involucrar al equipo
                            de respuesta a incidentes A partir de ahí, el personal de respuesta a incidentes investigará y
                            analizará el incidente para determinar su alcance, evaluar los daños y desarrollar un plan de
                            mitigación.

                            A modo de ejemplo podemos tomar como modelo una estrategia sistemática para la gestión de
                            incidentes de seguridad basado en la norma ISO / IEC 27035 que nos describe un proceso de cinco
                            pasos para la gestión de incidentes de seguridad, que incluye:

                            1. Estar preparados para el manejo de incidencias.
                            3. Monitorear, identificar e informar de todos los incidentes.
                            4. Evalúe y clasifique los incidentes para determinar los próximos pasos apropiados para mitigar
                            el riesgo.
                            5. Responda al incidente conteniéndolo, investigándolo y resolviendo
                            6. Aprenda y documente los puntos clave de cada incidente
                            RESPUESTA A INCIDENTES DE LA SEGURIDAD DE LA INFORMACION

                            Está claro que las medidas de respuesta a incidentes pueden variar según la organización y sus
                            objetivos comerciales y operacionales, aunque podríamos definir una serie de pasos generales que
                            a menudo se toman para administrar las amenazas.

                            El proceso de respuesta a incidentes suele comenzar con una investigación completa de un sistema
                            anómalo o irregularidad en el sistema, los datos o el comportamiento del usuario.',
            ],

            ////////////ISO 9001/////////////////////////////
            [
                'numero' => '3.1.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Alta Dirección',
                'definicion' => 'Persona o grupo de personas que dirige y controla una organización (3.2.1) al más alto nivel
                        Nota 1 a la entrada: La alta dirección tiene el poder para delegar autoridad y proporcionar recursos dentro de la
                        organización.
                        Nota 2 a la entrada: Si el alcance del sistema de gestión (3.5.3) comprende sólo una parte de una organización
                        entonces la alta dirección se refiere a quienes dirigen y controlan esa parte de la organización.
                        Nota 3 a la entrada: Este término constituye uno de los términos comunes y definiciones esenciales para las
                        normas de sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1
                        de las Directivas ISO/IEC.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.1.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Consultor del Sistema de Gestión de la Calidad',
                'definicion' => 'Persona que ayuda a la organización (3.2.1) en la realización de un sistema de gestión de la calidad (3.4.3),
                        dando asesoramiento o información (3.8.2)
                        Nota 1 a la entrada: El consultor del sistema de gestión de la calidad puede también ayudar en la realización de
                        parte del sistema de gestión de la calidad (3.5.4).
                        Nota 2 a la entrada: La Norma ISO 10019:2005 proporciona orientación sobre cómo distinguir un consultor de
                        sistema de gestión de la calidad competente de uno que no lo es.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.1.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Participación Activa',
                'definicion' => 'Tomar parte en una actividad, evento o situación',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.1.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Compromiso',
                'definicion' => 'Participación activa (3.1.3) en, y contribución a, las actividades para lograr objetivos compartidos (3.7.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.1.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Autoridad Para Disponer',
                'definicion' => 'Gestión de la decisión
                        autoridad de decisión
                        persona o grupo de personas a quienes se ha asignado la responsabilidad y la autoridad para tomar
                        decisiones sobre la configuración (3.10.6)
                        Nota 1 a la entrada: Las partes interesadas (3.2.3) pertinentes dentro y fuera de la organización (3.2.1) deberían
                        estar representadas en la autoridad para disponer.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.1.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Responsable de la Resolución de Conflictos',
                'definicion' => '<Satisfacción del cliente> Persona individual designada por un proveedor de PRC (3.2.7) para ayudar a
                        las partes en la resolución de un conflicto (3.9.6)
                        EJEMPLO Empleado, voluntario, personal contratado (3.4.7).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Organización',
                'definicion' => 'Persona o grupo de personas que tiene sus propias funciones con responsabilidades, autoridades y
                        relaciones para lograr sus objetivos (3.7.1)
                        Nota 1 a la entrada: El concepto de organización incluye, entre otros, un trabajador independiente, compañía,
                        corporación, firma, empresa, autoridad, sociedad, asociación (3.2.8), organización benéfica o institución, o una
                        parte o combinación de éstas, ya estén constituidas o no, públicas o privadas.
                        Nota 2 a la entrada: Este término constituye uno de los términos comunes y definiciones esenciales para las
                        normas de sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1
                        de las Directivas ISO/IEC. La definición original se ha modificado añadiendo la nota 1 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Contexto de la Organización',
                'definicion' => 'Combinación de cuestiones internas y externas que pueden tener un efecto en el enfoque de la
                        organización (3.2.1) para el desarrollo y logro de sus objetivos (3.7.1)
                        Nota 1 a la entrada: Los objetivos de la organización pueden estar relacionados con sus productos (3.7.6) y
                        servicios (3.7.7), inversiones y comportamiento hacia sus partes interesadas (3.2.3).
                        Nota 2 a la entrada: El concepto de contexto de la organización se aplica por igual tanto a organizaciones sin fines
                        de lucro o de servicio público como a aquellas que buscan beneficios con frecuencia.
                        Nota 3 a la entrada: En inglés, este concepto con frecuencia se denomina mediante otros términos, tales como
                        “entorno empresarial”, “entorno de la organización” o “ecosistema de una organización”.
                        Nota 4 a la entrada: Entender la infraestructura (3.5.2) puede ayudar a definir el contexto de la organización.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Parte Interesada',
                'definicion' => 'Persona u organización (3.2.1) que puede afectar, verse afectada o percibirse como afectada por una
                        decisión o actividad
                        EJEMPLO Clientes (3.2.4), propietarios, personas de una organización, proveedores (3.2.5), banca,
                        legisladores, sindicatos, socios o sociedad en general que puede incluir competidores o grupos de presión con
                        intereses opuestos.
                        Nota 1 a la entrada: Este término constituye uno de los términos comunes y definiciones esenciales para las
                        normas de sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1
                        de las Directivas ISO/IEC. La definición original se ha modificado añadiendo el ejemplo.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Cliente',
                'definicion' => 'Persona u organización (3.2.1) que podría recibir o que recibe un producto (3.7.6) o un servicio (3.7.7)
                        destinado a esa persona u organización o requerido por ella
                        EJEMPLO Consumidor, cliente, usuario final, minorista, receptor de un producto o servicio de un proceso
                        (3.4.1) interno, beneficiario y comprador.
                        Nota 1 a la entrada: Un cliente puede ser interno o externo a la organización.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Proveedor',
                'definicion' => 'Organización (3.2.1) que proporciona un producto (3.7.6) o un servicio (3.7.7)
                        EJEMPLO Productor, distribuidor, minorista o vendedor de un producto, o un servicio.
                        Nota 1 a la entrada: Un proveedor puede ser interno o externo a la organización.
                        Nota 2 a la entrada: En una situación contractual, un proveedor puede denominarse a veces “contratista”.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Proveedor externo',
                'definicion' => 'Proveedor (3.2.5) que no es parte de la organización (3.2.1)
                        EJEMPLO Productor, distribuidor, minorista o vendedor de un producto (3.7.6), o un servicio (3.7.7)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Proveedor de PRC',
                'definicion' => 'Proveedor de un proceso de resolución de conf lictos
                        persona u organización (3.2.1) que provee y opera un proceso (3.4.1) de resolución de conf lictos
                        (3.9.6) externo
                        Nota 1 a la entrada: Generalmente, un proveedor de PRC es una entidad legal, distinta de la organización o de la
                        persona como individuo y del reclamante. De esta manera, se enfatizan los atributos de independencia y equidad.
                        En algunas situaciones, se establece dentro de la organización una unidad separada para tratar las quejas (3.9.3)
                        sin resolver.
                        Nota 2 a la entrada: El proveedor de PRC contrata (3.4.7) con las partes para proporcionar la resolución de
                        conf lictos, y es responsable del desempeño (3.7.8). El proveedor de PRC proporciona responsables de la resolución
                        de conflictos (3.1.6). El proveedor de PRC también utiliza personal de apoyo, personal de dirección y otro
                        personal directivo para suministrar recursos financieros, soporte administrativo, asistencia en la elaboración de
                        programaciones, formación, salas de reuniones, supervisión y funciones similares.
                        Nota 3 a la entrada: Los proveedores de PRC pueden adoptar muchas formas incluyendo entidades sin fines de
                        lucro, entidades con fines de lucro y entidades públicas. Además una asociación (3.2.8) también puede ser un
                        proveedor de PRC.
                        Nota 4 a la entrada: En la Norma ISO 10003:2007, se utiliza el término “proveedor” en lugar del término
                        proveedor de PRC.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Asociación',
                'definicion' => '<Satisfacción del cliente> Organización (3.2.1) Formada por organizaciones o personas miembro',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.2.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Función Metrológica',
                'definicion' => 'Unidad funcional con responsabilidad administrativa y técnica para definir e implementar el sistema de gestión de las mediciones',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Mejora',
                'definicion' => 'Actividad para mejorar el desempeño (3.7.8)
                        Nota 1 a la entrada: La actividad puede ser recurrente o puntual.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Mejora Continua',
                'definicion' => 'Actividad recurrente para mejorar el desempeño (3.7.8)
                        Nota 1 a la entrada: El proceso (3.4.1) de establecer objetivos (3.7.1) y de encontrar oportunidades para la mejora
                        (3.3.1) es un proceso continuo mediante el uso de hallazgos de la auditoría (3.13.9) y de conclusiones de la auditoría
                        (3.13.10), del análisis de los datos (3.8.1), de las revisiones (3.11.2) por la dirección (3.3.3) u otros medios, y
                        generalmente conduce a una acción correctiva (3.12.2) o una acción preventiva (3.12.1).
                        Nota 2 a la entrada: Este término constituye uno de los términos comunes y definiciones esenciales para las
                        normas de sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1
                        de las Directivas ISO/IEC. La definición original se ha modificado añadiendo la nota 1 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Gestión',
                'definicion' => 'Actividades coordinadas para dirigir y controlar una organización (3.2.1)
                        Nota 1 a la entrada: La gestión puede incluir el establecimiento de políticas (3.5.8) y objetivos (3.7.1) y procesos
                        (3.4.1) para lograr estos objetivos.
                        Nota 2 a la entrada: Esta nota no se aplica a la versión española de la Norma.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Gestión de la Calidad',
                'definicion' => 'Gestión (3.3.3) con respecto a la calidad (3.6.2)
                        Nota 1 a la entrada: La gestión de la calidad puede incluir el establecimiento de políticas de la calidad (3.5.9)
                        y los objetivos de la calidad (3.7.2) y los procesos (3.4.1) para lograr estos objetivos de la calidad a través de
                        la planificación de la calidad (3.3.5), el aseguramiento de la calidad (3.3.6), el control de la calidad (3.3.7) y la
                        mejora de la calidad (3.3.8).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Planificación de la Calidad',
                'definicion' => 'Parte de la gestión de la calidad (3.3.4) orientada a establecer los objetivos de la calidad (3.7.2) y a la
                        especificación de los procesos (3.4.1) operativos necesarios y de los recursos relacionados para lograr
                        los objetivos de la calidad
                        Nota 1 a la entrada: El establecimiento de planes de la calidad (3.8.9) puede ser parte de la planificación de la calidad.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Aseguramiento de la Calidad',
                'definicion' => 'Parte de la gestión de la calidad (3.3.4) orientada a proporcionar confianza en que se cumplirán los
                        requisitos de la calidad (3.6.5)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Control de la Calidad',
                'definicion' => 'Parte de la gestión de la calidad (3.3.4) orientada al cumplimiento de los requisitos de la calidad (3.6.5)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Mejora de la Calidad',
                'definicion' => 'Parte de la gestión de la calidad (3.3.4) orientada a aumentar la capacidad de cumplir con los requisitos
                        de la calidad (3.6.5)
                        Nota 1 a la entrada: Los requisitos de la calidad pueden estar relacionados con cualquier aspecto tal como la
                        eficacia (3.7.11), la eficiencia (3.7.10) o la trazabilidad (3.6.13).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Gestión de la Configuración',
                'definicion' => 'Actividades coordinadas para dirigir y controlar la configuración (3.10.6)
                        Nota 1 a la entrada: La gestión de la configuración generalmente se concentra en actividades técnicas y
                        organizativas que establecen y mantienen el control de un producto (3.7.6) o servicio (3.7.7) y su información
                        sobre configuración del producto (3.6.8) durante todo el ciclo de vida del producto.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.10',
                'norma' => 'ISO 9001',
                'concepto' => 'Control de Cambios',
                'definicion' => '<Gestión de la configuración> Actividades para controlar las salidas (3.7.5) después de la aprobación
                        formal de su información sobre configuración del producto (3.6.8)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.11',
                'norma' => 'ISO 9001',
                'concepto' => 'Actividad',
                'definicion' => '<Gestión de proyectos> El menor objeto de trabajo identificado en un proyecto (3.4.2)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.12',
                'norma' => 'ISO 9001',
                'concepto' => 'Gestión de Proyectos',
                'definicion' => 'Planificación, organización, seguimiento (3.11.3), control e informe de todos los aspectos de un
                        proyecto (3.4.2) y la motivación de todos aquellos que están involucrados en él para alcanzar los
                        objetivos del proyecto',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.3.13',
                'norma' => 'ISO 9001',
                'concepto' => 'Objeto de la Configuración',
                'definicion' => 'Objeto (3.6.1) dentro de una configuración (3.10.6) que satisface una función de uso final',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Proceso',
                'definicion' => 'Conjunto de actividades mutuamente relacionadas que utilizan las entradas para proporcionar un
                        resultado previsto
                        Nota 1 a la entrada: Que el “resultado previsto” de un proceso se denomine salida (3.7.5), producto (3.7.6) o
                        servicio (3.7.7) depende del contexto de la referencia.
                        Nota 2 a la entrada: Las entradas de un proceso son generalmente las salidas de otros procesos y las salidas de un
                        proceso son generalmente las entradas de otros procesos.
                        Nota 3 a la entrada: Dos o más procesos en serie que se interrelacionan e interactúan pueden también considerarse
                        como un proceso.
                        ISO 9000:2015 (traducción oficial)
                        16
                        Nota 4 a la entrada: Los procesos en una organización (3.2.1) generalmente se planifican y se realizan bajo
                        condiciones controladas para agregar valor.
                        Nota 5 a la entrada: Un proceso en el cual la conformidad (3.6.11) de la salida resultante no pueda validarse de
                        manera fácil o económica, con frecuencia se le denomina “proceso especial”.
                        Nota 6 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado para evitar circularidad entre proceso y salida, y las
                        notas 1 a 5 a la entrada se han añadido.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Proyecto',
                'definicion' => 'Proceso (3.4.1) único, consistente en un conjunto de actividades coordinadas y controladas con fechas
                        de inicio y de finalización, llevadas a cabo para lograr un objetivo (3.7.1) conforme con requisitos (3.6.4)
                        específicos, incluyendo las limitaciones de tiempo, costo y recursos
                        Nota 1 a la entrada: Un proyecto individual puede formar parte de la estructura de un proyecto mayor y
                        generalmente tiene una fecha de inicio y finalización definida.
                        Nota 2 a la entrada: En algunos proyectos, los objetivos y el alcance se actualizan y las características (3.10.1) del
                        producto (3.7.6) o servicio (3.7.7) se definen progresivamente según evoluciona el proyecto.
                        Nota 3 a la entrada: La salida (3.7.5) de un proyecto puede ser una o varias unidades de producto o servicio.
                        Nota 4 a la entrada: La organización (3.2.1) del proyecto normalmente es temporal y se establece para el tiempo
                        de duración del proyecto.
                        Nota 5 a la entrada: La complejidad de las interacciones existentes entre las actividades del proyecto no está
                        necesariamente relacionadas con la magnitud del proyecto.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Realización del sistema de gestión de la calidad',
                'definicion' => 'Proceso (3.4.1) de establecimiento, documentación, implementación, mantenimiento y mejora continua
                        de un sistema de gestión de la calidad (3.5.4)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Adquisición de competencia',
                'definicion' => 'Proceso (3.4.1) para alcanzar competencia (3.10.4).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Procedimiento',
                'definicion' => 'Forma especificada de llevar a cabo una actividad o un proceso (3.4.1)
                        Nota 1 a la entrada: Los procedimientos pueden estar documentados o no.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Contratar externamente',
                'definicion' => 'Establecer un acuerdo mediante el cual una organización (3.2.1) externa realiza parte de una función o
                        proceso (3.4.1) de una organización
                        Nota 1 a la entrada: Una organización externa está fuera del alcance del sistema de gestión (3.5.3), aunque la
                        función o proceso contratado externamente forme parte del alcance.
                        Nota 2 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Contrato',
                'definicion' => 'Acuerdo vinculante',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.4.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Diseño y desarrollo',
                'definicion' => 'Conjunto de procesos (3.4.1) que transforman los requisitos (3.6.4) para un objeto (3.6.1) en requisitos
                        más detallados para ese objeto
                        Nota 1 a la entrada: Los requisitos que forman la entrada para el diseño y desarrollo son con frecuencia el
                        resultado de la investigación y pueden expresarse de un modo más amplio, en un sentido más general que el
                        de los requisitos que forman la salida (3.7.5) del diseño y desarrollo. Los requisitos se definen generalmente en
                        términos de características (3.10.1). En un proyecto (3.4.2) puede haber varias etapas de diseño y desarrollo.
                        Nota 2 a la entrada: Los términos “diseño” ,“desarrollo” y “diseño y desarrollo” a veces se utilizan como sinónimos
                        y en ocasiones se utilizan para definir diferentes etapas del diseño y desarrollo global.
                        Nota 3 a la entrada: Puede aplicarse un calificativo para indicar la naturaleza de lo que se está diseñando y
                        desarrollando (por ejemplo, diseño y desarrollo de un producto (3.7.6), diseño y desarrollo de un servicio (3.7.7) o
                        diseño y desarrollo de un proceso (3.4.1).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Sistema',
                'definicion' => 'Conjunto de elementos interrelacionados o que interactúan',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Infraestructura',
                'definicion' => '<Organización> Sistema (3.5.1) de instalaciones, equipos y servicios (3.7.7) necesarios para el
                            funcionamiento de una organización (3.2.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Sistema de Gestión',
                'definicion' => 'Conjunto de elementos de una organización (3.2.1) interrelacionados o que interactúan para establecer
                        políticas (3.5.8), objetivos (3.7.1) y procesos (3.4.1) para lograr estos objetivos.
                        Nota 1 a la entrada: Un sistema de gestión puede tratar una sola disciplina o varias disciplinas, por ejemplo,
                        gestión de la calidad (3.3.4), gestión financiera o gestión ambiental.
                        Nota 2 a la entrada: Los elementos del sistema de gestión establecen la estructura de la organización, los roles
                        y las responsabilidades, la planificación, la operación, las políticas, las prácticas, las reglas, las creencias, los
                        objetivos y los procesos para lograr esos objetivos.
                        Nota 3 a la entrada: El alcance de un sistema de gestión puede incluir la totalidad de la organización, funciones
                        específicas e identificadas de la organización, secciones específicas e identificadas de la organización, o una o
                        más funciones dentro de un grupo de organizaciones.
                        Nota 4 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado mediante la modificación de las notas 1 a 3 la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Sistema de Gestión de la Calidad',
                'definicion' => 'Parte de un sistema de gestión (3.5.3) relacionada con la calidad (3.6.2)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Ambiente de Trabajo',
                'definicion' => 'Conjunto de condiciones bajo las cuales se realiza el trabajo
                        Nota 1 a la entrada: Las condiciones pueden incluir factores físicos, sociales, psicológicos y ambientales (tales como
                        temperatura, iluminación, esquemas de reconocimiento, estrés laboral, ergonomía y atmósfera en el trabajo).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Confirmación Metrológica',
                'definicion' => 'Conjunto de operaciones necesarias para asegurarse de que el equipo de medición (3.11.6) es conforme
                        con los requisitos (3.6.4) para su uso previsto
                        Nota 1 a la entrada: La confirmación metrológica generalmente incluye calibración o verificación (3.8.12),
                        cualquier ajuste necesario o reparación (3.12.9) y posterior recalibración, comparación con los requisitos
                        metrológicos para el uso previsto del equipo, así como cualquier sellado y etiquetado requeridos.
                        Nota 2 a la entrada: La confirmación metrológica no se logra hasta, y al menos que, se haya demostrado y
                        documentado la adecuación de los equipos de medición para la utilización prevista.
                        Nota 3 a la entrada: Los requisitos relativos a la utilización prevista pueden incluir consideraciones tales como el
                        rango, la resolución y los errores máximos permitidos.
                        Nota 4 a la entrada: Los requisitos metrológicos normalmente son distintos de los requisitos del producto (3.7.6)
                        y no se encuentran especificados en los mismos.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Sistema de Gestión de las Mediciones',
                'definicion' => 'Conjunto de elementos interrelacionados, o que interactúan, necesarios para lograr la confirmación
                        metrológica (3.5.6) y el control de los procesos de medición (3.11.5).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Política',
                'definicion' => '<Organización> Intenciones y dirección de una organización (3.2.1), como las expresa formalmente su
                        alta dirección (3.1.1)
                        Nota 1 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Política de la Calidad',
                'definicion' => 'Política (3.5.8) relativa a la calidad (3.6.2)
                        Nota 1 a la entrada: Generalmente la política de la calidad es coherente con la política global de la organización
                        (3.2.1), puede alinearse con la visión (3.5.10) y la misión (3.5.11) de la organización y proporciona un marco de
                        referencia para el establecimiento de los objetivos de la calidad (3.7.2).
                        Nota 2 a la entrada: Los principios de gestión de la calidad presentados en esta Norma Internacional pueden
                        constituir la base para el establecimiento de la política de la calidad.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.10',
                'norma' => 'ISO 9001',
                'concepto' => 'Visión',
                'definicion' => '<Organización> Aspiración de aquello que una organización (3.2.1) querría llegar a ser, tal como lo
                        expresa la alta dirección (3.1.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.11',
                'norma' => 'ISO 9001',
                'concepto' => 'Misión',
                'definicion' => '<Organización> Propósito de la existencia de la organización (3.2.1), tal como lo expresa la alta
                        dirección (3.1.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.5.12',
                'norma' => 'ISO 9001',
                'concepto' => 'Estrategia',
                'definicion' => 'Plan para lograr un objetivo (3.7.1) a largo plazo o global',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Objeto
                            Entidad
                            Item',
                'definicion' => 'Cualquier cosa que puede percibirse o concebirse
                        EJEMPLO Producto (3.7.6), servicio (3.7.7), proceso (3.4.1), persona, organización (3.2.1), sistema (3.5.1),
                        recurso.
                        Nota 1 a la entrada: Los objetos pueden ser materiales (por ejemplo, un motor, una hoja de papel, un diamante),
                        no materiales (por ejemplo, una tasa de conversión, un plan de proyecto) o imaginarios (por ejemplo, el estado
                        futuro de una organización ).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Calidad',
                'definicion' => 'Grado en el que un conjunto de características (3.10.1) inherentes de un objeto (3.6.1) cumple con los
                        requisitos (3.6.4).
                        Nota 1 a la entrada: El término “calidad” puede utilizarse acompañado de adjetivos tales como pobre, buena o
                        excelente.
                        Nota 2 a la entrada: “Inherente”, en contraposición a “asignado”, significa que existe en el objeto (3.6.1).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Clase',
                'definicion' => 'Categoría o rango dado a diferentes requisitos (3.6.4) para un objeto (3.6.1) que tienen el mismo uso
                        funcional
                        EJEMPLO Clases de billetes de una compañía aérea o categorías de hoteles en un folleto.
                        Nota 1 a la entrada: Cuando se establece un requisito de la calidad (3.6.5), generalmente se especifica la clase.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Requisito',
                'definicion' => 'Necesidad o expectativa establecida, generalmente implícita u obligatoria
                            Nota 1 a la entrada: “Generalmente implícita” significa que es habitual o práctica común para la organización
                        (3.2.1) y las partes interesadas (3.2.3) el que la necesidad o expectativa bajo consideración está implícita.
                        Nota 2 a la entrada: Un requisito especificado es aquel que está establecido, por ejemplo, en información
                        documentada (3.8.6).
                        Nota 3 a la entrada: Pueden utilizarse calificativos para identificar un tipo específico de requisito, por ejemplo,
                        requisito) de un producto (3.7.6), requisito de la gestión de la calidad (3.3.4), requisito del cliente (3.2.4), requisito
                        de la calidad (3.6.5).
                        Nota 4 a la entrada: Los requisitos pueden ser generados por las diferentes partes interesadas o por la propia
                        organización.
                        Nota 5 a la entrada: Para lograr una alta satisfacción del cliente (3.9.2) puede ser necesario cumplir una expectativa
                        de un cliente incluso si no está declarada ni generalmente implícita, ni es obligatoria.
                        Nota 6 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado añadiendo las notas 3 a 5 a la entrada.
                        3.6.5
                        requisito de la calidad
                        requisito (3.6.4) relativo a la calidad (3.6.2)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Requisito Legal',
                'definicion' => 'Requisito (3.6.4) obligatorio especificado por un organismo legislativo',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Requisito Reglamentario',
                'definicion' => 'Requisito (3.6.4) obligatorio especificado por una autoridad que recibe el mandato de un órgano legislativo',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Información Sobre Configuración del Producto',
                'definicion' => 'Requisito (3.6.4) u otra información para el diseño, la realización, la verificación (3.8.12), el
                        funcionamiento y el soporte de un producto (3.7.6)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.9',
                'norma' => 'ISO 9001',
                'concepto' => 'No Conformidad',
                'definicion' => 'Incumplimiento de un requisito (3.6.4)
                        Nota 1 a la entrada: Este es uno de los términos comunes y definiciones esenciales para las normas de sistemas de
                        gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las Directivas ISO/IEC.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.10',
                'norma' => 'ISO 9001',
                'concepto' => 'Defecto',
                'definicion' => 'No conformidad (3.6.9) relativa a un uso previsto o especificado
                        Nota 1 a la entrada: La distinción entre los conceptos defecto y no conformidad es importante por sus
                        connotaciones legales, particularmente aquellas asociadas a la responsabilidad legal de los productos (3.7.6) y
                        servicios (3.7.7).
                        Nota 2 a la entrada: El uso previsto tal y como lo prevé el cliente (3.2.4) podría estar afectado por la naturaleza de
                        la información (3.8.2), tal como las instrucciones de funcionamiento o de mantenimiento, proporcionadas por el
                        proveedor (3.2.5).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.11',
                'norma' => 'ISO 9001',
                'concepto' => 'Conformidad',
                'definicion' => 'Cumplimiento de un requisito (3.6.4)
                        Nota 1 a la entrada: Esta nota no se aplica a la versión española de la Norma.
                        Nota 2 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado añadiendo la nota 1 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.12',
                'norma' => 'ISO 9001',
                'concepto' => 'Capacidad',
                'definicion' => 'Aptitud de un objeto (3.6.1) para realizar una salida (3.7.5) que cumplirá los requisitos (3.6.4) para esa
                        salida
                        Nota 1 a la entrada: En la Norma ISO 3534-2 se definen términos relativos a la capacidad de los procesos (3.4.1)
                        en el campo de la estadística.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.13',
                'norma' => 'ISO 9001',
                'concepto' => 'Trazabilidad',
                'definicion' => 'Capacidad para seguir el histórico, la aplicación o la localización de un objeto (3.6.1)
                        Nota 1 a la entrada: Al considerar un producto (3.7.6) o un servicio (3.7.7), la trazabilidad puede estar
                        relacionada con:
                        — el origen de los materiales y las partes;
                        — el histórico del proceso; y
                        ISO 9000:2015 (traducción oficial)
                        21
                        — la distribución y localización del producto o servicio después de la entrega.
                        Nota 2 a la entrada: En el campo de la metrología, se acepta la definición dada en la Guía ISO/IEC 99:2007.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.14',
                'norma' => 'ISO 9001',
                'concepto' => 'Confiabilidad',
                'definicion' => 'Capacidad para desempeñar cómo y cuándo se requiera',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.6.15',
                'norma' => 'ISO 9001',
                'concepto' => 'Innovación',
                'definicion' => 'Objeto (3.6.1) nuevo o cambiado que crea o redistribuye valor.
                        Nota 1 a la entrada: Las actividades que resultan en innovación generalmente se gestionan.
                        Nota 2 a la entrada: La innovación es generalmente significativa en su efecto.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.1 objetivo',
                'norma' => 'ISO 9001',
                'concepto' => 'Resultado a lograr',
                'definicion' => 'Nota 1 a la entrada: Un objetivo puede ser estratégico, táctico u operativo.
                        Nota 2 a la entrada: Los objetivos pueden referirse a diferentes disciplinas (tales como objetivos financieros,
                        de salud y seguridad y ambientales) y se pueden aplicar en diferentes niveles [como estratégicos, para toda la
                        organización (3.2.1), para el proyecto (3.4.2), el producto (3.7.6) y el proceso (3.4.1)].
                        Nota 3 a la entrada: Un objetivo se puede expresar de otras maneras, por ejemplo, como un resultado previsto, un
                        propósito, un criterio operativo, un objetivo de la calidad (3.7.2), o mediante el uso de términos con un significado
                        similar (por ejemplo, fin o meta).
                        Not a 4 a la entrada: En el contex to de sistemas de gestión de la calidad (3.5.4), la organización (3.2.1)
                        est ablece los objetivos de la calidad (3.7.2), de forma coherente con la política de la calidad (3.5.9), para lograr
                        result ados específ icos.
                        Nota 5 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado mediante la modificación de la nota 2 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Objetivo de la calidad',
                'definicion' => 'Objetivo (3.7.1) relativo a la calidad (3.6.2)
                        Nota 1 a la entrada: Los objetivos de la calidad generalmente se basan en la política de la calidad (3.5.9) de la
                        organización (3.2.1).
                        Nota 2 a la entrada: Los objetivos de la calidad generalmente se especifican para las funciones, niveles y procesos
                        (3.4.1) pertinentes de la organización (3.2.1).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Éxito',
                'definicion' => '<Organización> logro de un objetivo (3.7.1).
                        Nota 1 a la entrada: El éxito de una organización (3.2.1) enfatiza la necesidad de un equilibrio entre sus intereses
                        económicos o financieros y las necesidades de sus partes interesadas (3.2.3), tales como clientes (3.2.4), usuarios,
                        inversionistas/accionistas (propietarios), las personas de la organización, proveedores (3.2.5), socios, grupos de
                        interés y comunidades.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Éxito Sostenido',
                'definicion' => '<Organización> éxito (3.7.3) Durante un periodo de tiempo
                        Nota 1 a la entrada: El éxito sostenido enfatiza la necesidad de un equilibrio entre los intereses económicofinancieros
                        de una organización (3.2.1) y aquellos del entorno social y ecológico.
                        Nota 2 a la entrada: El éxito sostenido se relaciona con las partes interesadas (3.2.3) de una organización tales
                        como clientes (3.2.4), propietarios, personas de una organización, proveedores (3.2.5), banqueros, sindicatos,
                        socios o la sociedad.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Salida',
                'definicion' => 'Resultado de un proceso (3.4.1)
                        Nota 1 a la entrada: Que una salida de una organización (3.2.1) sea un producto (3.7.6) o un servicio (3.7.7) depende
                        de la preponderancia de las características (3.10.1) involucradas, por ejemplo, una pintura que se vende en una
                        galería es un producto mientras que el suministro de una pintura encargada es un servicio, una hamburguesa
                        comprada en una tienda minorista es un producto mientras que una hamburguesa recibida, ordenada y servida
                        en un restaurantes es parte de un servicio.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Producto',
                'definicion' => 'Salida (3.7.5) de una organización (3.2.1) que puede producirse sin que se lleve a cabo ninguna
                        transacción entre la organización y el cliente (3.2.4)
                        Nota 1 a la entrada: La producción de un producto se logra sin que necesariamente se lleve a cabo ninguna
                        transacción, entre el proveedor (3.2.5) y el cliente pero frecuentemente el elemento servicio (3.7.7) está
                        involucrado en la entrega al cliente.
                        Nota 2 a la entrada: El elemento dominante de un producto es aquel que es generalmente tangible.
                        Nota 3 a la entrada: El hardware es tangible y su cantidad es una característica contable (3.10.1) (por ejemplo,
                        neumáticos). Los materiales procesados generalmente son tangibles y su cantidad es una característica continua
                        (por ejemplo, combustible o bebidas refrescantes). El hardware y los materiales procesados con frecuencia se
                        denominan bienes. El software consiste en información (3.8.2) independientemente del medio de entrega (por
                        ejemplo un programa informático, una aplicación de teléfono móvil, un manual de instrucciones, el contenido de
                        un diccionario, los derechos de autor de una composición musical, la licencia de conductor).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Servicio',
                'definicion' => 'Salida (3.7.5) de una organización (3.2.1) con al menos una actividad, necesariamente llevada a cabo
                        entre la organización y el cliente (3.2.4)
                        Nota 1 a la entrada: Los elementos dominantes de un servicio son generalmente intangibles.
                        Nota 2 a la entrada: Los servicios con frecuencia involucran actividades en la interfaz con el cliente para establecer
                        requisitos del cliente (3.6.4) así como durante la entrega del servicio, y puede involucrar una relación continua,
                        por ejemplo con bancos, entidades contables u organizaciones públicas, como escuelas u hospitales públicos.
                        Nota 3 a la entrada: La provisión de un servicio puede implicar, por ejemplo, lo siguiente:
                        — una actividad realizada sobre un producto (3.7.6) tangible suministrado por el cliente (por ejemplo, reparación
                        de un coche);
                        — una actividad realizada sobre un producto intangible suministrado por el cliente (por ejemplo, la declaración
                        de ingresos necesaria para preparar una declaración de impuestos);
                        — la entrega de un producto intangible (por ejemplo, la entrega de información (3.8.2) en el contexto de la
                        transmisión de conocimiento);
                        — la creación de un ambiente para el cliente (por ejemplo, en hoteles y restaurantes).
                        Nota 4 a la entrada: Un servicio generalmente se experimenta por el cliente.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.8 desempeño',
                'norma' => 'ISO 9001',
                'concepto' => 'Resultado Medible',
                'definicion' => 'Nota 1 a la entrada: El desempeño se puede relacionar con hallazgos cuantitativos o cualitativos.
                        Nota 2 a la entrada: El desempeño se puede relacionar con la gestión (3.3.3) de actividades (3.3.11), procesos
                        (3.4.1), productos (3.7.6), servicios (3.7.7), sistemas (3.5.1) u organizaciones (3.2.1).
                        Nota 3 a la entrada: Este es uno de los términos comunes y definiciones esenciales para las normas de sistemas
                        de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las Directivas
                        ISO/IEC. La definición original se ha modificado con la modificación de la nota 2 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Riesgo',
                'definicion' => 'Efecto de la incertidumbre
                        Nota 1 a la entrada: Un efecto es una desviación de lo esperado, ya sea positivo o negativo.
                        Nota 2 a la entrada: Incertidumbre es el estado, incluso parcial, de deficiencia de información (3.8.2) relacionada
                        con la comprensión o conocimiento de un evento, su consecuencia o su probabilidad.
                        Nota 3 a la entrada: Con frecuencia el riesgo se caracteriza por referencia a eventos potenciales (según se
                        define en la Guía ISO 73:2009, 3.5.1.3) y consecuencias (según se define en la Guía ISO 73:2009, 3.6.1.3), o a una
                        combinación de éstos.
                        Nota 4 a la entrada: Con frecuencia el riesgo se expresa en términos de una combinación de las consecuencias
                        de un evento (incluidos cambios en las circunstancias) y la probabilidad (según se define en la Guía ISO 73:2009,
                        3.6.1.1) asociada de que ocurra.
                        Nota 5 a la entrada: La palabra “riesgo” algunas veces se utiliza cuando sólo existe la posibilidad de
                        consecuencias negativas.
                        Nota 6 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado añadiendo la nota 5 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.10',
                'norma' => 'ISO 9001',
                'concepto' => 'Eficiencia',
                'definicion' => 'Relación entre el resultado alcanzado y los recursos utilizados',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.7.11',
                'norma' => 'ISO 9001',
                'concepto' => 'Eficacia',
                'definicion' => 'Grado en el que se realizan las actividades planificadas y se logran los resultados planificados
                        Nota 1 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Datos',
                'definicion' => 'Hechos sobre un objeto (3.6.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Información',
                'definicion' => 'Datos (3.8.1) que poseen significado',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Evidencia objetiva',
                'definicion' => 'Datos (3.8.1) que respaldan la existencia o veracidad de algo
                        Nota 1 a la entrada: La evidencia objetiva puede obtenerse por medio de la observación, medición (3.11.4), ensayo
                        (3.11.8) o por otros medios.
                        Nota 2 a la entrada: La evidencia objetiva con fines de auditoría (3.13.1) generalmente se compone de registros
                        (3.8.10), declaraciones de hechos u otra información (3.8.2) que son pertinentes para los criterios de auditoría
                        (3.13.7) y verificables.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Sistema de Información',
                'definicion' => '<Sistema de gestión de la calidad> Red de canales de comunicación utilizados dentro de una
                        organización (3.2.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Documento',
                'definicion' => 'Información (3.8.2) y el medio en el que está contenida
                        EJEMPLO Registro (3.8.10), especificación (3.8.7), documento de procedimiento, plano, informe, norma.
                        Nota 1 a la entrada: El medio de soporte puede ser papel, disco magnético, electrónico u óptico, fotografía o
                        muestra patrón o una combinación de éstos.
                        Nota 2 a la entrada: Con frecuencia, un conjunto de documentos, por ejemplo especificaciones y registros , se
                        denominan “documentación”.
                        Nota 3 a la entrada: Algunos requisitos (3.6.4) (por ejemplo, el requisito de ser legible) se refieren a todo tipo de
                        documento. Sin embargo puede requisitos diferentes para las especificaciones (por ejemplo, el requisito de estar
                        controlado por revisiones) y los registros (por ejemplo, el requisito de ser recuperable).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Información Documentada',
                'definicion' => 'Información (3.8.2) que una organización (3.2.1) tiene que controlar y mantener, y el medio que la contiene
                        Nota 1 a la entrada: La información documentada puede estar en cualquier formato y medio, y puede provenir de
                        cualquier fuente.
                        Nota 2 a la entrada: La información documentada puede hacer referencia a:
                        — el sistema de gestión (3.5.3), incluidos los procesos (3.4.1) relacionados;
                        — la información generada para que la organización opere (documentación);
                        — la evidencia de los resultados alcanzados (registros (3.8.10)).
                        Nota 3 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Especificación',
                'definicion' => 'Documento (3.8.5) que establece requisitos (3.6.4)
                        EJEMPLO Manual de la calidad (3.8.8), plan de la calidad (3.8.9), plano técnico, documento de procedimiento,
                        instrucción de trabajo.
                        Nota 1 a la entrada: Una especificación puede estar relacionada con actividades (por ejemplo, un documento de
                        procedimiento una especificación de proceso (3.4.1) y una especificación de ensayo (3.11.8)), o con productos
                        (3.7.6) (por ejemplo, una especificación de producto, una especificación de desempeño (3.7.8) y un plano).
                        Nota 2 a la entrada: Puede que, al establecer requisitos una especificación esté estableciendo adicionalmente
                        resultados logrados por el diseño y desarrollo (3.4.8) y de este modo en algunos casos puede utilizarse como un
                        registro (3.8.10).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Manual de la Calidad',
                'definicion' => 'Especificación (3.8.7) para el sistema de gestión de la calidad (3.5.4) de una organización (3.2.1)
                        Nota 1 a la entrada: Los manuales de la calidad pueden variar en cuanto a detalle y formato para adecuarse al
                        tamaño y complejidad de cada organización (3.2.1) en particular.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Plan de la Calidad',
                'definicion' => 'Especificación (3.8.7) de los procedimientos (3.4.5) y recursos asociados a aplicar, cuándo deben aplicarse
                        y quién debe aplicarlos a un objeto (3.6.1) específico
                        Nota 1 a la entrada: Estos procedimientos generalmente incluyen aquellos relativos a los procesos (3.4.1) de
                        gestión de la calidad (3.3.4) y a los procesos de realización del producto (3.7.6) y servicio (3.7.7)
                        Nota 2 a la entrada: Un plan de la calidad hace referencia con frecuencia a partes del manual de la calidad (3.8.8) o
                        a documentos (3.8.5) de procedimiento.
                        Nota 3 a la entrada: Un plan de la calidad es generalmente uno de los resultados de la planificación de la
                        calidad (3.3.5).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.10',
                'norma' => 'ISO 9001',
                'concepto' => 'Registro',
                'definicion' => 'Documento (3.8.5) que presenta resultados obtenidos o proporciona evidencia de actividades realizadas
                        Nota 1 a la entrada: Los registros pueden utilizarse, por ejemplo, para formalizar la trazabilidad (3.6.13) y para
                        proporcionar evidencia de verificaciones (3.8.12), acciones preventivas (3.12.1) y acciones correctivas (3.12.2).
                        Nota 2 a la entrada: En general los registros no necesitan estar sujetos al control del estado de revisión.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.11',
                'norma' => 'ISO 9001',
                'concepto' => 'Plan de Gestión de Proyecto',
                'definicion' => 'Documento (3.8.5) que especifica qué es necesario para cumplir los objetivos (3.7.1) del proyecto (3.4.2)
                        Nota 1 a la entrada: Un plan de gestión de proyecto debería incluir o hacer referencia al plan de la calidad (3.8.9)
                        del proyecto.
                        Nota 2 a la entrada: Cuando sea apropiado, el plan de gestión de proyecto también incluye o hace referencia a otros
                        planes como aquellos relativos a las estructuras de la organización, los recursos, el calendario, el presupuesto, la
                        gestión (3.3.3) del riesgo (3.7.9), la gestión ambiental, la gestión de la salud y seguridad y la gestión (3.3.3) de la
                        seguridad, según sea apropiado.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.12',
                'norma' => 'ISO 9001',
                'concepto' => 'Verificación',
                'definicion' => 'Confirmación, mediante la aportación de evidencia objetiva (3.8.3) de que se han cumplido los requisitos
                        (3.6.4) especificados
                        Nota 1 a la entrada: La evidencia objetiva necesaria para una verificación puede ser el resultado de una inspección
                        (3.11.7) o de otras formas de determinación (3.11.1), tales como realizar cálculos alternativos o revisar los
                        documentos (3.8.5).
                        Nota 2 a la entrada: Las actividades llevadas a cabo para la verificación a veces se denominan proceso (3.4.1) de
                        calificación.
                        Nota 3 a la entrada: La palabra “verificado” se utiliza para designar el estado correspondiente.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.13',
                'norma' => 'ISO 9001',
                'concepto' => 'Validación',
                'definicion' => 'Confirmación, mediante la aportación de evidencia objetiva (3.8.3), de que se han cumplido los
                        requisitos (3.6.4) para una utilización o aplicación específica prevista
                        Nota 1 a la entrada: La evidencia objetiva necesaria para una validación es el resultado de un ensayo (3.11.8) u
                        otra forma de determinación (3.11.1), tal como realizar cálculos alternativos o revisar los documentos (3.8.5).
                        Nota 2 a la entrada: La palabra “validado” se utiliza para designar el estado correspondiente.
                        Nota 3 a la entrada: Las condiciones de utilización para la validación pueden ser reales o simuladas.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.14',
                'norma' => 'ISO 9001',
                'concepto' => 'Justificación del Estado de la Configuración',
                'definicion' => 'Registro e informe formalizado de la información sobre configuración del producto (3.6.8) , el estado de
                        los cambios propuestos y el estado de la implementación de los cambios aprobados',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.8.15',
                'norma' => 'ISO 9001',
                'concepto' => 'Caso Específico',
                'definicion' => '<Plan de la calidad> Tema del plan de la calidad (3.8.9)
                        Nota 1 a la entrada: Este término se utiliza para evitar la repetición de “proceso (3.4.1), producto (3.7.6), proyecto
                        (3.4.2) o contrato (3.4.7)” dentro de la Norma ISO 10005.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.9.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Retroalimentación',
                'definicion' => '<Satisfacción del cliente> Opiniones, comentarios y muestras de interés por un producto (3.7.6), un
                        servicio (3.7.7) o un proceso de tratamiento de quejas (3.4.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.9.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Satisfacción del Cliente',
                'definicion' => 'Percepción del cliente (3.2.4) sobre el grado en que se han cumplido las expectativas de los clientes
                        Nota 1 a la entrada: Puede que la expectativa del cliente no sea conocida por la organización (3.2.1), o incluso por
                        el propio cliente, hasta que el producto (3.7.6) o servicio (3.7.7) se entregue. Para alcanzar una alta satisfacción
                        del cliente puede ser necesario cumplir una expectativa de un cliente incluso si no está declarada, ni está
                        generalmente implícita, ni es obligatoria.
                        Nota 2 a la entrada: Las quejas (3.9.3) son un indicador habitual de una baja satisfacción del cliente, pero la
                        ausencia de las mismas no implica necesariamente una elevada satisfacción del cliente.
                        Nota 3 a la entrada: Incluso cuando los requisitos del cliente (3.6.4) se han acordado con el cliente y éstos se han
                        cumplido, esto no asegura necesariamente una elevada satisfacción del cliente.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.9.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Queja',
                'definicion' => '<Satisfacción del cliente> Expresión de insatisfacción hecha a una organización (3.2.1), relativa a su
                        producto (3.7.6) o servicio (3.7.7), o al propio proceso (3.4.1) de tratamiento de quejas, donde explícita o
                        implícitamente se espera una respuesta o resolución',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.9.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Servicio al Cliente',
                'definicion' => 'Interacción de la organización (3.2.1) con el cliente (3.2.4) a lo largo del ciclo de vida de un producto
                        (3.7.6) o un servicio (3.7.7).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.9.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Código de Conducta de la Satisfacción del Cliente',
                'definicion' => 'Promesas hechas a los clientes (3.2.4) por una organización (3.2.1) relacionadas con su comportamiento,
                        orientadas a aumentar la satisfacción del cliente (3.9.2) y las disposiciones relacionadas
                        Nota 1 a la entrada: Las disposiciones relacionadas pueden incluir objetivos (3.7.1), condiciones, limitaciones,
                        información (3.8.2) del contrato y procedimientos (3.4.5) de tratamiento de quejas (3.9.3).
                        Nota 2 a la entrada: En la Norma ISO 10001:2007 el término “código” se utiliza en lugar de “código de conducta de
                        la satisfacción del cliente”.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.9.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Conflicto',
                'definicion' => '<Satisfacción del cliente> Desacuerdo, que surge de una queja (3.9.3) presentada a un proveedor de PRC
                        (3.2.7).
                        Nota 1 a la entrada: Algunas organizaciones (3.2.1) permiten a sus clientes (3.2.4) expresar su insatisfacción a
                        un proveedor de PRC en primer lugar. En esta situación, la expresión de insatisfacción se convierte en una queja
                        cuando se envía a la organización en busca de una respuesta, y se convierte en un conf licto si no lo resuelve la
                        organización sin la intervención del proveedor de PRC. Muchas organizaciones prefieren que sus clientes expresen
                        primero cualquier insatisfacción a la organización antes de utilizar una resolución de conf lictos externa a la
                        organización.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.10.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Característica',
                'definicion' => 'Rasgo diferenciador
                        Nota 1 a la entrada: Una característica puede ser inherente o asignada.
                        Nota 2 a la entrada: Una característica puede ser cualitativa o cuantitativa.
                        Nota 3 a la entrada: Existen varias clases de características, tales como las siguientes:
                        a) físicas (por ejemplo, características mecánicas, eléctricas, químicas o biológicas);
                        b) sensoriales (por ejemplo, relacionadas con el olfato, el tacto, el gusto, la vista y el oído);
                        c) de comportamiento (por ejemplo, cortesía, honestidad, veracidad);
                        d) de tiempo (por ejemplo, puntualidad, confiabilidad, disponibilidad, continuidad);
                        e) ergonómicas (por ejemplo, características fisiológicas, o relacionadas con la seguridad de las personas);
                        f ) funcionales (por ejemplo, velocidad máxima de un avión).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.10.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Característica de la Calidad',
                'definicion' => 'Característica (3.10.1) inherente a un objeto (3.6.1) relacionada con un requisito (3.6.4)
                        Nota 1 a la entrada: Inherente significa que existe en algo, especialmente como una característica permanente.
                        Nota 2 a la entrada: Una característica asignada a un objeto (por ejemplo, el precio de un objeto) no es una
                        característica de la calidad de ese objeto.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.10.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Factor Humano',
                'definicion' => 'Característica (3.10.1) de una persona que tiene un impacto sobre un objeto (3.6.1) bajo consideración
                        Nota 1 a la entrada: Las características pueden ser físicas, cognitivas o sociales.
                        Nota 2 a la entrada: Los factores humanos pueden tener un impacto significativo en un sistema de gestión (3.5.3).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.10.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Competencia',
                'definicion' => 'Capacidad para aplicar conocimientos y habilidades con el fin de lograr los resultados previstos
                        Nota 1 a la entrada: La competencia demostrada a veces se denomina cualificación.
                        Nota 2 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado añadiendo la nota 1 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.10.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Característica Metrológica',
                'definicion' => 'Característica (3.10.1) que puede inf luir sobre los resultados de la medición (3.11.4)
                        Nota 1 a la entrada: El equipo de medición (3.11.6) generalmente tiene varias características metrológicas.
                        Nota 2 a la entrada: Las características metrológicas pueden estar sujetas a calibración.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.10.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Configuración',
                'definicion' => 'Características (3.10.1) funcionales y físicas interrelacionadas de un producto (3.7.6) o servicio (3.7.7)
                        definidas en la información sobre configuración del producto (3.6.8)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.10.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Configuración de Referencia',
                'definicion' => 'Información sobre configuración del producto (3.6.8) aprobada, que establece las características (3.10.1)
                        de un producto (3.7.6) o servicio (3.7.7) en un punto determinado en el tiempo, que sirve como referencia
                        para actividades durante todo el ciclo de vida del producto o servicio.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Determinación',
                'definicion' => 'Actividad para encontrar una o más características (3.10.1) y sus valores característicos',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Revisión',
                'definicion' => 'Determinación (3.11.1) de la conveniencia, adecuación o eficacia (3.7.11) de un objeto (3.6.1) para lograr
                        unos objetivos (3.7.1) establecidos
                        EJEMPLO Revisión por la dirección, revisión del diseño y desarrollo (3.4.8), revisión de los requisitos (3.6.4)
                        del cliente (3.2.4), revisión de acciones correctivas (3.12.2) y evaluación entre pares.
                        Nota 1 a la entrada: La revisión puede incluir también la determinación de la eficiencia (3.7.10).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Seguimiento',
                'definicion' => 'Determinación (3.11.1) del estado de un sistema (3.5.1), un proceso (3.4.1), un producto (3.7.6), un
                        servicio (3.7.7) o una actividad
                        Nota 1 a la entrada: Para determinar el estado puede ser necesario verificar, supervisar u observar de forma crítica.
                        Nota 2 a la entrada: El seguimiento generalmente es una determinación del estado de un objeto (3.6.1) al que se
                        realiza el seguimiento, llevado a cabo en diferentes etapas o momentos diferentes.
                        Nota 3 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original y la nota 1 a la entrada se han modificado, y se ha añadido la nota 2.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Medición',
                'definicion' => 'Proceso (3.4.1) para determinar un valor
                        Nota 1 a la entrada: De acuerdo con la Norma ISO 3534-2, el valor determinado generalmente es el valor de
                        una magnitud.
                        Nota 2 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original a la entrada se ha modificado y se ha añadido la nota 1 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Proceso de Medición',
                'definicion' => 'Conjunto de operaciones que permiten determinar el valor de una magnitud',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Equipo de Medición',
                'definicion' => 'Instrumento de medición, software, patrón de medición, material de referencia o equipos auxiliares o
                        combinación de ellos necesarios para llevar a cabo un proceso de medición (3.11.5)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Inspección',
                'definicion' => 'Determinación (3.11.1) de la conformidad (3.6.11) con los requisitos (3.6.4) especificados
                        Nota 1 a la entrada: Si el resultado de una inspección muestra conformidad puede utilizarse con fines de
                        verificación (3.8.12).
                        Nota 2 a la entrada: El resultado de una inspección puede mostrar conformidad o no conformidad (3.6.9) o un
                        cierto grado de conformidad.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Ensayo',
                'definicion' => 'Determinación (3.11.1) de acuerdo con los requisitos (3.6.4) para un uso o aplicación previsto específico
                        Nota 1 a la entrada: Si el resultado de un ensayo muestra conformidad (3.6.11), puede utilizarse con fines de
                        validación (3.8.13).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.11.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Evaluación del Avance',
                'definicion' => '<Gestión de proyectos> Evaluación del progreso en el logro de los objetivos (3.4.2) del proyecto (3.7.1)
                        Nota 1 a la entrada: Esta evaluación debería llevarse a cabo en puntos adecuados del ciclo de vida del proyecto
                        a través de los procesos (3.4.1) del proyecto, basada en los criterios para los procesos del proyecto y el producto
                        (3.7.6) o servicio (3.7.7).
                        Nota 2 a la entrada: Los resultados de las evaluaciones de progreso pueden conducir a la revisión del plan de
                        gestión de proyecto (3.8.11).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Acción Preventiva',
                'definicion' => 'Acción tomada para eliminar la causa de una no conformidad (3.6.9) potencial u otra situación
                        potencial no deseable
                        Nota 1 a la entrada: Puede haber más de una causa para una no conformidad potencial.
                        Nota 2 a la entrada: La acción preventiva se toma para prevenir que algo ocurra, mientras que la acción correctiva
                        (3.12.2) se toma para prevenir que vuelva a ocurrir.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Acción Correctiva',
                'definicion' => 'Acción para eliminar la causa de una no conformidad (3.6.9) y evitar que vuelva a ocurrir
                        Nota 1 a la entrada: Puede haber más de una causa para una no conformidad.
                        Nota 2 a la entrada: La acción correctiva se toma para prevenir que algo vuelva a ocurrir, mientras que la acción
                        preventiva (3.12.1) se toma para prevenir que algo ocurra.
                        Nota 3 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas de
                        sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1 de las
                        Directivas ISO/IEC. La definición original se ha modificado añadiendo las notas 1 a 2 a la entrada.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Corrección',
                'definicion' => 'Acción para eliminar una no conformidad (3.6.9) detectada
                        Nota 1 a la entrada: Una corrección puede realizarse con anterioridad, simultáneamente, o después de una acción
                        correctiva (3.12.2).
                        Nota 2 a la entrada: Una corrección puede ser, por ejemplo, un reproceso (3.12.8) o una reclasificación (3.12.4).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Reclasificación',
                'definicion' => 'Variación de la clase (3.6.3) de un producto (3.6.9) o servicio (3.7.7) no conforme (3.6.9) para hacerlo
                        conforme a requisitos (3.6.4) diferentes de los requisitos iniciales',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Concesión',
                'definicion' => 'Autorización para utilizar o liberar (3.12.7) un producto (3.7.6) o servicio (3.7.7) que no es conforme con
                        los requisitos (3.6.4) especificados
                        Nota 1 a la entrada: Una concesión está generalmente limitada a la entrega de productos y servicios que tienen
                        características (3.10.1) no conformes (3.6.9), dentro de límites especificados y generalmente dados para una
                        cantidad limitada de productos y servicios para un periodo de tiempo, y para un uso específico.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Permiso de Desviación',
                'definicion' => 'Autorización para apartarse de los requisitos (3.6.4) originalmente especificados de un producto (3.7.6)
                        o servicio (3.7.7), antes de su realización
                        Nota 1 a la entrada: Un permiso de desviación se concede generalmente para una cantidad limitada de productos
                        y servicios o para un periodo de tiempo limitado, y para un uso específico.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Liberación',
                'definicion' => 'Autorización para proseguir con la siguiente etapa de un proceso (3.4.1) o el proceso siguiente
                        Nota 1 a la entrada: Esta nota no se aplica a la versión española de la Norma.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Reproceso',
                'definicion' => 'Acción tomada sobre un producto o servicio no conforme para hacerlo conforme con los requisitos (3.6.4)
                        Nota 1 a la entrada: El reproceso puede afectar o cambiar partes del producto (3.7.6) o servicio (3.7.7) no
                        conforme (3.6.9).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Reparación',
                'definicion' => 'Acción tomada sobre un producto (3.7.6) o servicio (3.7.7) no conforme (3.6.9) para convertirlo en
                        aceptable para su utilización prevista
                        Nota 1 a la entrada: Una reparación exitosa de un producto no conforme no necesariamente hace al producto o
                        servicio conforme con los requisitos (3.6.4). Puede que junto con una reparación se requiera una concesión (3.12.5).
                        Nota 2 a la entrada: La reparación incluye las acciones reparadoras adoptadas sobre un producto o servicio
                        previamente conforme para devolverle su aptitud al uso, por ejemplo, como parte del mantenimiento.
                        Nota 3 a la entrada: La reparación puede afectar o cambiar partes del producto o servicio no conforme.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.12.10',
                'norma' => 'ISO 9001',
                'concepto' => 'Desecho',
                'definicion' => 'Acción tomada sobre un producto (3.7.6) o servicio (3.7.7) no conforme (3.6.9) para impedir su uso
                        inicialmente previsto
                        EJEMPLO Reciclaje, destrucción.
                        Nota 1 a la entrada: En el caso de un servicio no conforme, el uso se impide no continuando el servicio.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.1',
                'norma' => 'ISO 9001',
                'concepto' => 'Auditoría',
                'definicion' => 'Proceso (3.4.1) sistemático, independiente y documentado para obtener evidencias objetivas (3.8.3)
                        y evaluarlas de manera objetiva con el fin de determinar el grado en que se cumplen los criterios de
                        auditoría (3.13.7)
                        Nota 1 a la entrada: Los elementos fundamentales de una auditoría incluyen la determinación (3.11.1) de la
                        conformidad (3.6.11) de un objeto (3.6.1) de acuerdo con un procedimiento (3.4.5) llevado a cabo por personal que
                        no es responsable del objeto auditado.
                        Nota 2 a la entrada: Una auditoría puede ser interna (de primera parte) o externa (de segunda parte o de tercera
                        parte), y puede ser combinada (3.13.2) o conjunta (3.13.3).
                        Nota 3 a la entrada: Las auditorías internas, denominadas en algunos casos auditorías de primera parte, se
                        realizan por, o en nombre de la propia organización (3.2.1) , para la revisión (3.11.2) por la dirección (3.3.3) y
                        otros fines internos, y pueden constituir la base para la declaración de conformidad de una organización. La
                        independencia puede demostrarse al estar libre el auditor de responsabilidades en la actividad que se audita.
                        Nota 4 a la entrada: Las auditorías externas incluyen lo que se denomina generalmente auditorías de segunda y
                        tercera parte. Las auditorías de segunda parte se llevan a cabo por partes que tienen un interés en la organización,
                        tal como los clientes (3.2.4) o por otras personas en su nombre. Las auditorías de tercera parte se llevan a cabo
                        por organizaciones auditoras independientes y externas, tales como las que otorgan la certificación/registro de
                        conformidad o agencias gubernamentales.
                        Nota 5 a la entrada: Este término es uno de los términos comunes y definiciones esenciales para las normas
                        de sistemas de gestión que se proporcionan en el Anexo SL del Suplemento ISO consolidado de la Parte 1
                        de las Directivas ISO/IEC. La definición original y las notas se han modificado para eliminar los efectos de
                        circularidad entre las entradas de términos de criterios de auditoría y los de evidencia de auditoría y se han
                        añadido las notas 3 y 4.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.2',
                'norma' => 'ISO 9001',
                'concepto' => 'Auditoría Combinada',
                'definicion' => 'Auditoría (3.13.1) Llevada a cabo conjuntamente a un único auditado (3.13.12) en dos o más sistemas de
                        gestión (3.5.3)
                        Nota 1 a la entrada: Las partes de un sistema de gestión que pueden estar involucradas en una auditoría
                        combinada pueden identificarse por las normas de sistemas de gestión pertinentes, normas de producto, normas
                        de servicio o normas de proceso que se aplican por la organización (3.2.1).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.3',
                'norma' => 'ISO 9001',
                'concepto' => 'Auditoría Conjunta',
                'definicion' => 'Auditoría (3.13.1) Llevada a cabo a un único auditado (3.13.12) por dos o más organizaciones (3.2.1)
                        auditoras',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.4',
                'norma' => 'ISO 9001',
                'concepto' => 'Programa de la Auditoría',
                'definicion' => 'Conjunto de una o más auditorías (3.13.1) planificadas para un periodo de tiempo determinado y
                        dirigidas hacia un propósito específico',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.5',
                'norma' => 'ISO 9001',
                'concepto' => 'Alcance de la Auditoría',
                'definicion' => 'Extensión y límites de una auditoría (3.13.1)
                        Nota 1 a la entrada: El alcance de la auditoría incluye generalmente una descripción de las ubicaciones, las
                        unidades de la organización, las actividades y los procesos (3.4.1).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.6',
                'norma' => 'ISO 9001',
                'concepto' => 'Plan de Auditoría',
                'definicion' => 'Descripción de las actividades y de los detalles acordados de una auditoría (3.13.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.7',
                'norma' => 'ISO 9001',
                'concepto' => 'Criterios de Auditoría',
                'definicion' => 'Conjunto de políticas (3.5.8), procedimientos (3.4.5) o requisitos (3.6.4) usados como referencia frente a
                        la cual se compara la evidencia objetiva (3.8.3)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.8',
                'norma' => 'ISO 9001',
                'concepto' => 'Evidencia de la Auditoría',
                'definicion' => 'Registros, declaraciones de hechos o cualquier otra información que es pertinente para los criterios de
                        auditoría (3.13.7) y que es verificable',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.9',
                'norma' => 'ISO 9001',
                'concepto' => 'Hallazgos de la Auditoría',
                'definicion' => 'Resultados de la evaluación de la evidencia de la auditoría (3.13.8) recopilada frente a los criterios de
                        auditoría (3.13.7)
                        Nota 1 a la entrada: Los hallazgos de la auditoría indican conformidad (3.6.11) o no conformidad (3.6.9).
                        Nota 2 a la entrada: Los hallazgos de la auditoría pueden conducir a la identificación de oportunidades para la
                        mejora (3.3.1) o el registro de buenas prácticas.
                        Nota 3 a la entrada: Si los criterios de auditoria (3.13.7) se seleccionan a partir de requisitos legales (3.6.6.) o
                        reglamentarios (3.6.7), los hallazgos de auditoría pueden denominarse cumplimiento o no cumplimiento.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.10',
                'norma' => 'ISO 9001',
                'concepto' => 'Conclusiones de la Auditoría',
                'definicion' => 'Resultado de una auditoría (3.13.1), tras considerar los objetivos de la auditoría y todos los hallazgos de
                        la auditoría (3.13.9)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.11',
                'norma' => 'ISO 9001',
                'concepto' => 'Cliente de la Auditoría',
                'definicion' => 'Organización (3.2.1) o persona que solicita una auditoría (3.13.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.12',
                'norma' => 'ISO 9001',
                'concepto' => 'Auditado',
                'definicion' => 'Organización (3.2.1) que es auditada',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.13',
                'norma' => 'ISO 9001',
                'concepto' => 'Guía',
                'definicion' => '<Auditoría> Persona designada por el auditado (3.13.12) para asistir al equipo auditor (3.13.14)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.14',
                'norma' => 'ISO 9001',
                'concepto' => 'Equipo Auditor',
                'definicion' => 'Una o más personas que llevan a cabo una auditoría (3.13.1) con el apoyo, si es necesario, de expertos
                        técnicos (3.13.16)
                        Nota 1 a la entrada: A un auditor (3.13.15) del equipo auditor se le designa como auditor líder del mismo.
                        Nota 2 a la entrada: El equipo auditor puede incluir auditores en formación.',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.15',
                'norma' => 'ISO 9001',
                'concepto' => 'Auditor',
                'definicion' => 'Persona que lleva a cabo una auditoría (3.13.1)',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.16',
                'norma' => 'ISO 9001',
                'concepto' => 'Experto Técnico',
                'definicion' => '<Auditoría> Persona que aporta conocimientos o experiencia específicos al equipo auditor (3.13.14)
                        Nota 1 a la entrada: El conocimiento o experiencia específicos son los relacionados con la organización (3.2.1), el
                        proceso (3.4.1) o la actividad a auditar, el idioma o la cultura.
                        Nota 2 a la entrada: Un experto técnico no actúa como auditor (3.13.15) en el equipo auditor (3.13.14).',
                'explicacion' => 'Sin información',
            ],
            [
                'numero' => '3.13.17',
                'norma' => 'ISO 9001',
                'concepto' => 'Observador',
                'definicion' => '<Auditoría> Persona que acompaña al equipo auditor (3.13.14) pero que no actúa como un auditor (3.13.15)
                        Nota 1 a la entrada: Un observador puede ser un miembro del auditado (3.13.12), un ente regulador u otra parte
                        interesada (3.2.3) que testifica la auditoría (3.13.1).',
                'explicacion' => 'Sin información',
            ],

        ];

        Glosario::insert($glosario);
    }
}
