@extends('layouts.admin')
@section('content')

@can('glosario_create')

<style type="text/css">
    table{
        width: 100%;
    }
    
    table td{
        text-align: justify;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        vertical-align: top;
    }
    div.alphabet {
        position: relative;
        display: table;
        width: 100%;
        margin-bottom: 1em;
    }

    div.alphabet span {
        display: table-cell;
        color: #3174c7;
        cursor: pointer;
        text-align: center;
        width: 3.5%
    }

    div.alphabet span:hover {
        text-decoration: underline;
    }

    div.alphabet span.active {
        color: black;
    }

    div.alphabet span.empty {
        color: red;
    }

    div.alphabetInfo {
        display: block;
        position: absolute;
        background-color: #111;
        border-radius: 3px;
        color: white;
        top: 2em;
        height: 1.8em;
        padding-top: 0.4em;
        text-align: center;
        z-index: 1;
    }
    .paginate_button{
        margin: 5px;
        padding: 5px 10px;
        background: #a3d6ed;
        cursor: pointer;
        border-radius: 4px;
        color: #fff;
    }
    body.c-dark-theme .paginate_button{
        background: #4488a7;
    }


    @media(max-width: 1050px){
        table tr{
            display: flex;
            flex-direction: column;
        }
    }
</style>


<!--  
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.glosarios.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.glosario.title_singular') }}
            </a>
        </div>
    </div>
-->

@endcan

<div class="card mt-5">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>Glosario</strong></h3>
    </div>

    <div class="card-body">
        <table id="dom" class="responsive-table" width="100%">
            <thead>
            <tr>
                <th>Concepto</th>
                <th>Definición</th>
                <th>Explicación</th>
                
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>3.1 Control de Acceso</td>
                    <td>“medios para garantizar que el acceso a los activos esté autorizado y restringido según los requisitos comerciales y de seguridad”</td>
                    <td>El control de acceso es una forma de limitar el acceso a un sistema o a recursos físicos o virtuales. En sistemas de la información, el control de acceso es un proceso mediante el cual los usuarios obtienen acceso y ciertos privilegios a los sistemas, recursos o información.
                    En los sistemas de control de acceso, los usuarios deben presentar las credenciales antes de que se les pueda otorgar el acceso. En los sistemas físicos, estas credenciales pueden tener muchas formas, pero las credenciales que no se pueden transferir brindan la mayor seguridad.</td>
                </tr>
                <tr>
                    <td>3.2 Ataque</td>
                    <td>"Intentar destruir, exponer, alterar, deshabilitar, robar u obtener acceso no autorizado o hacer un uso no autorizado de un activo"</td>
                    <td>Los ataques cibernéticos son los mas comunes hoy en día. Un ciber ataque es un ataque contra un sistema informático, una red o una aplicación o dispositivo habilitado para Internet. Los piratas informáticos utilizan una variedad de herramientas para lanzar ataques, incluidos malware, ransomware , kits de explotación y otros métodos.</td>
                </tr>
                <tr>
                    <td>3.3. Auditoría</td>
                    <td>Proceso sistemático, independiente y documentado para obtener evidencia de auditoría y evaluarla objetivamente para determinar hasta qué punto se cumplen los criterios de auditoría.

                    Las auditorias pueden ser internas o externas

                    En cuanto a las auditorías Internas pueden ser realizadas por la misma organización o por una parte externa en su nombre.

                    Los conceptos de "Evidencia de auditoría" y "criterios de auditoría" se definen en ISO 19011 dentro del proceso de recopilación de información para alcanzar las conclusiones de auditoria.</td>
                    <td>Una auditoría incluye una verificación que garantice que la seguridad de la información cumple con todas las expectativas y requisitos de la norma ISO 27001 dentro de una organización. Durante este proceso, se revisa la documentación del SGSI se entrevista a los empleados sobre los roles de seguridad y otros detalles relevantes.

                    Cada organización debe realizar auditorías de seguridad de forma periódica para garantizar que los datos y los activos estén protegidos.

                    En primer lugar se define el alcance de la auditoría detallando los activos de la empresa relacionados con la seguridad de la información, incluidos equipos informáticos, teléfonos, redes, correo electrónico, datos y cualquier elemento relacionado con el acceso, como tarjetas, tokens y contraseñas.
                    En segundo lugar, se deben revisar las amenazas de activos, tanto las que ya se han detectado como las posibles o futuras. Para ello deberemos debe mantenerse al tanto de las nuevas tendencias en el campo de la seguridad de la información, así como de las medidas de seguridad adoptadas por otras compañías.
                    En tercer lugar, el equipo de auditoría debe estimar impacto que podría causar la posible materialización de las amenazas para la seguridad de la informaciones este momento es cuando hay que evaluar el plan y los controles establecidos para mantener las operaciones comerciales después de que haya ocurrido una amenaza.
                    Finalmente deberemos evaluar la eficacia de las medidas de control establecidas y de la evaluación del riesgo potencial de las amenazas a los distintos activos de información para establecer informes de resultados de auditorías que nos permitan evaluar las necesidades de mejora tanto en los controles establecidos como en las necesidades de hacer cambios en la evaluación de los riesgos de los activos.</td>

                </tr>
                <tr>
                    <td>3.4 Alcance de Auditoría</td>
                    <td>Alcance y límites de una auditoría</td>
                    <td>El alcance de una auditoria generalmente incluye una descripción de las áreas físicas, unidades organizacionales, actividades y procesos, así como el periodo de tiempo cubierto</td>
             
                </tr>
                <tr>
                    <td>3.5 Autenticación</td>
                    <td>"Garantía de que una característica reivindicada de una entidad es correcta"</td>
                    <td>En el contexto de los sistemas informáticos, la autenticación es un proceso que garantiza y confirma la identidad de un usuario. La autenticación es uno de los aspectos básicos en la seguridad de la informacion, junto con los tres pilares, a saber: la integridad, disponibilidad, y confidencialidad.

                    La autenticación comienza cuando un usuario intenta acceder a la información. Primero, el usuario debe probar sus derechos de acceso y su identidad. Al iniciar sesión en una computadora, los usuarios comúnmente ingresan nombres de usuario y contraseñas con fines de autenticación. Esta combinación de inicio de sesión, que debe asignarse a cada usuario, autentica el acceso. Sin embargo, este tipo de autenticación puede ser evitado por los hackers.

                    Una mejor forma de autenticación, la biométrica, depende de la presencia del usuario y la composición biológica (es decir, la retina o las huellas dactilares). Esta tecnología hace que sea más difícil para los piratas informáticos ingresar en los sistemas informáticos.

                    El método de autenticación de la infraestructura de clave pública (PKI) utiliza certificados digitales para probar la identidad de un usuario. También hay otras herramientas de autenticación, como tarjetas de claves y tokens USB. Una de las mayores amenazas de autenticación ocurre con el correo electrónico, donde la autenticidad suele ser difícil de verificar.</td>
             
                </tr>
                <tr>
                    <td>3.6 Autenticidad</td>
                    <td>Propiedad que una entidad es lo que dice ser.</td>
                    <td>¿Qué es la autenticidad? ¿Qué entendemos por autenticidad en Seguridad de la Información? La autenticidad es la seguridad de que un mensaje, una transacción u otro intercambio de información proviene de la fuente de la que afirma ser. Autenticidad implica prueba de identidad.

                    Podemos verificar la autenticidad a través de la autenticación . El proceso de autenticación usualmente involucra más de una "prueba" de identidad (aunque una puede ser suficiente).

                    Asegurando la autenticidad. Para la interacción del usuario con los sistemas, programas y entre sí, la autenticación es fundamental. La entrada de ID de usuario y contraseña es el método de autenticación más frecuente. También parece presentar la mayoría de los problemas. Las contraseñas pueden ser robadas u olvidadas. Descifrar contraseñas puede ser simple para los hackers si las contraseñas no son lo suficientemente largas o no lo suficientemente complejas. Recordar docenas de contraseñas para docenas de aplicaciones puede ser frustrante para usuarios domésticos y usuarios empresariales</td>
             
                </tr>
                <tr>
                    <td>3.7 Disponibiidad</td>
                    <td>Propiedad de ser accesible y utilizable a solicitud de una entidad autorizada</td>
                    <td>Los sistemas de almacenamiento de datos son los que en definitiva nos garantizan la disponibilidad de la información. El almacenamiento de datos por lo general puede ser local o en una instalación externa o en la nube. También pueden establecerse planes para garantizar la disponibilidad de la información en instalaciones externas cuando fallan los elementos de almacenamiento internos.
                    El caso es que la información debe estar disponible para en todo momento pero solo para aquellos con autorización para acceder a ella.</td>
             
                </tr>
                <tr>
                    <td>3.8 Medida Base</td>
                    <td>Definida en términos de un atributo y el método para cuantificarlo.
                    Una medida base es funcionalmente independiente de otras medidas </td>
                    <td>Se ha realizado un trabajo considerable para desarrollar medidas e indicadores que puedan utilizarse para los resultados de los proyectos de desarrollo.

                    Los términos "medida", "métrica" e indicador "a menudo se usan indistintamente y sus definiciones varían según los diferentes documentos y organizaciones. Por lo tanto, siempre es útil verificar qué significan estos términos en contextos específicos.

                    Los términos que comúnmente se asocian con las mediciones incluyen:

                    Un objetivo es el valor de un indicador que se espera alcanzar en un punto específico en el tiempo. A menudo se utiliza un punto de referencia para significar lo mismo.
                    Un índice es un conjunto de indicadores relacionados que pretenden proporcionar un medio para realizar comparaciones significativas y sistemáticas de desempeño entre programas que son similares en contenido y / o tienen las mismas metas y objetivos.
                    Un estándar es un conjunto de indicadores, puntos de referencia o índices relacionados que proporcionan información socialmente significativa con respecto al desempeño.</td>
             
                </tr>
              
                <tr>
                    <td>3.9 Competencia</td>
                    <td>Capacidad de aplicar conocimientos y habilidades para lograr los resultados esperados. </td>
                    <td>Hoy más que nunca, en el mundo interconectado y moderno se revela como algo absolutamente necesario, establecer requisitos en las competencias para los profesionales de seguridad de la información. Las peculiaridades del enfoque europeo para el desarrollo de las competencias profesionales de la seguridad de la información se discuten utilizando el ejemplo del Marco Europeo de Competencia Electrónica e-CF 3.0. Sobre esta base, se proponen dos incluso dos marcos específicos, si bien breves de contenido, como son las nuevas normas internacionales ISO / IEC 27021 e ISO / IEC 19896.

                    Por otro lado, la cultura corporativa de una organización influye en el comportamiento de los empleados y, en última instancia, contribuye a la efectividad de una organización. La información es un activo vital para la mayoría de las organizaciones. Por lo tanto, idealmente, una cultura corporativa debe incorporar controles de seguridad de la información en las rutinas diarias y el comportamiento implícito de los empleados.

                    Sin duda el nivel de madurez de la “competencia “en seguridad de la información es un posible método para evaluar en qué medida la seguridad de la información está incorporada en la cultura corporativa actual de una organización.</td>
                         
                </tr>

                <tr>
                    <td>3.10 Confidencialidad</td>
                    <td>Propiedad por la que la información no se pone a disposición o se divulga a personas, entidades o procesos no autorizados </td>
                    <td>La confidencialidad, cuando nos referimos a sistemas de información, permite a los usuarios autorizados acceder a datos confidenciales y protegidos. Existen mecanismos específicos garantizan la confidencialidad y salvaguardan los datos de intrusos no deseados o que van a causar daño.

                    La confidencialidad es uno de los pilares de Seguridad de la información junto con la, disponibilidad e integridad.

                    La información o los datos confidenciales deben divulgarse únicamente a usuarios autorizados.Siempre que hablamos de confidencialidad en el ámbito de la seguridad de la información nos hemos de plantear un sistema de clasificación de la información.

                    Por ejemplo, en el ámbito de la seguridad de la información en una organización militar, está claro que se debe obtener un cierto nivel de autorización dependiendo de los requisitos de datos a los que se puede o desea acceder. Según el caso, los datos pueden estar clasificados como confidencial (secreta), o en un nivel superior como “Top Secret” “. Aquellos con autorizaciones para acceder a datos confidenciales sin más no deben poder en ningún caso acceder a información “Top Secret”.

                    Las mejores prácticas utilizadas para garantizar la confidencialidad son las siguientes:

                    * Un proceso de autenticación, que garantiza que a los usuarios autorizados se les asignen identificaciones de usuario y contraseñas confidenciales. Otro tipo de autenticación es la biométrica.
                    * Se pueden emplear métodos de seguridad basados en roles para garantizar la autorización del usuario o del espectador. Por ejemplo, los niveles de acceso a los datos pueden asignarse al personal del departamento específico.
                    * Los controles de acceso aseguran que las acciones del usuario permanezcan dentro de sus roles. Por ejemplo, si un usuario está autorizado para leer pero no escribir datos, los controles del sistema definidos pueden integrarse.</td>
             
                </tr>
                <tr>
                    <td>3.11 Conformidad</td>
                    <td>Cumplimiento de un requisito </td>
                    <td>La conformidad es el “cumplimiento de un requisito”. Cumplir significa cumplir o cumplir con los requisitos. Hay muchos tipos de requisitos. Existen requisitos de calidad, requisitos del cliente, requisitos del producto, requisitos de gestión, requisitos legales, requisitos de la seguridad de la información etc. Los requisitos pueden especificarse explícitamente (como los requisitos de la norma ISO 27001) o estar implícitos. Un requisito específico es uno que se ha establecido (en un documento, por ejemplo la política de seguridad o de uso del correo electrónico). Cuando su organización cumple con un requisito, puede decir que cumple con ese requisito.

                    La no conformidad es el "incumplimiento de un requisito". La no conformidad se refiere a la falta de cumplimiento de los requisitos. Una no conformidad es una desviación de una especificación, un estándar o una expectativa.

                    Un requisito es una necesidad, expectativa u obligación. Puede ser declarado o implícito por una organización, sus clientes u otras partes interesadas. Hay muchos tipos de requisitos. Algunos de estos incluyen requisitos de la Seguridad de la Informacion, Proteccion de datos personales, requisitos del cliente, requisitos de gestión, requisitos del producto y requisitos legales. Cuando su organización no cumple con uno de estos requisitos, se produce una no conformidad. ISO 27001 enumera los requisitos del sistema de gestión de la Seguridad de la informacion. Cuando su organización se desvía de estos requisitos, se produce una no conformidad. Las no conformidades se clasifican como críticas, mayores o menores.

                    No conformidad menor: cualquier no conformidad que no afecte de manera adversa la seguridad de la información, el rendimiento, la durabilidad, la capacidad de intercambio, la fiabilidad, la facilidad de mantenimiento, el uso u operación efectiva, el peso o la apariencia (cuando sea un factor), la salud o la seguridad de un producto. Múltiples no conformidades menores cuando se consideran colectivamente pueden elevar la categoría a una no conformidad mayor o crítica.

                    No conformidad Mayor: cualquier no conformidad que no sea crítica, que puede dar lugar a fallas o reducir sustancialmente la seguridad de la información, la capacidad de uso del producto para el propósito previsto y que no pueda ser completamente eliminada por medidas correctivas o reducido a una no conformidad menor por un un control establecido.

                    No conformidad crítica: cualquier no conformidad sobre la seguridad de la información que pueda causar daño a las personas, su imagen o su reputación, tanto las que usan, mantienen o dependen del producto, o aquellas que impiden el desempeño de procesos críticos para la organización.</td>
             
                </tr>

                <tr>
                    <td>3.12 Consecuencia</td>
                    <td>Resultado de un evento que afecta a los objetivos </td>
                    <td>Como vemos las consecuencias son algo relacionado con los eventos y los objetivos de la seguridad de la información.

                    EVENTOS  

                    Un evento en la seguridad de la información es un cambio en las operaciones diarias de una red o servicio de tecnología de la información que indica que una política de seguridad puede haber sido violada o que un control de seguridad puede haber fallado.

                    Cuando un evento afecta a los resultados de un proceso o tiene consecuencias no deseadas como la interrupción de servicios, pérdida de datos o afecta a la confidencialidad, disponibilidad o integridad de la información entonces decimos que es un evento con consecuencias.

                    En un contexto informático, los eventos incluyen cualquier ocurrencia identificable que tenga importancia para el hardware o software del sistema.

                    Los eventos de seguridad son aquellos que pueden tener importancia para la seguridad de los sistemas o datos. La primera indicación de un evento puede provenir de una alerta definida por software o de que los usuarios finales notifiquen al departamento de mantenimiento o al centro de soporte que, por ejemplo, los servicios de red se han desacelerado.

                    Como regla general, un evento es una ocurrencia o situación relativamente menor que se puede resolver con bastante facilidad y los eventos que requieren que un administrador de TI tome medidas y clasifique los eventos cuando sea necesario como como incidentes.

                    Un ticket del departamento de soporte de un solo usuario que informa que cree haber contraído un virus es un evento de seguridad, ya que podría indicar un problema de seguridad. Sin embargo, si se encuentra evidencia del virus en el ordenador del usuario, puede considerarse un incidente de seguridad.

                    Según los informes de los organismos nacionales de ciberseguridad se producen decenas de miles de eventos de seguridad por día en las grandes organizaciones. Los productos de seguridad, como el software antivirus, pueden reducir la cantidad de eventos de seguridad y muchos procesos de respuesta de incidencia pueden automatizarse para que la carga de trabajo sea más manejable.

                    SISTEMAS DE ADMINISTRACION DE EVENTOS (¿QUE SON?)

                    Los eventos que no requieren la acción de un administrador pueden ser manejados automáticamente por la información de seguridad y por sistemas denominados de administración de eventos (SIEM).

                    Los sistemas de administración de información y eventos nacieron en el entorno de la industria de métodos de pago por tarjeta para luego extenderse como solución para grandes y medianas empresas

                    Se trata de ver todos los datos relacionados con la seguridad desde un único punto de vista para facilitar que las organizaciones de todos los tamaños detecten patrones fuera de lo común aplicando

                    Tecnologías de la información (firewalls, antivirus, prevención de intrusiones
                    Bases de datos (Registros de información y patrones de comportamientos)
                    Inteligencia artificial
                    Análisis forense y de comportamientos
                    Informes de seguridad
                    OBJETIVOS DE SEGURIDAD

                    Los sistemas de información son vulnerables a la modificación, intrusión o mal funcionamiento.

                    Los sistemas de gestión para la seguridad de la información tienen como objetivo proteger a los sistemas de estas amenazas. Para ello se establecen criterios basados en una evaluación previa de los riesgos que estas amenazas suponen para poner los controles necesarios de forma que las pérdidas o perjuicios esperados por estas amenazas se encuentren en algún momento en niveles aceptables

                    Para definir los objetivos de seguridad podríamos tener en cuenta el siguiente principio fundamental:

                    "La protección de los intereses de quienes dependen de la información, y los sistemas de información y Comunicaciones que entregan la información, por daños resultantes de fallas de disponibilidad, confidencialidad e integridad”

                    El objetivo de seguridad utiliza tres términos.

                    Disponibilidad los sistemas de información en cuanto a que estén disponibles y se pueden utilizar cuando sea necesario;
                    Confidencialidad los datos y la información son revelados solamente a aquellos que tienen derecho a saber de ella
                    La Integridad los datos y la información están protegidos contra modificaciones no autorizadas (integridad).
                    La prioridad relativa y la importancia de la disponibilidad, la confidencialidad y la integridad varían de acuerdo con los datos y su clasificación dentro del sistema de información y el contexto empresarial en el que se utiliza.</td>
             
                </tr>

                <tr>
                    <td>3.13 Mejora Continua</td>
                    <td>Actividad recurrente para mejorar el rendimiento </td>
                    <td>Si la mejora se define como acciones que se traducen en una mejora de los resultados, entonces la mejora continua es simplemente identificar y realizar cambios enfocados a conseguir la mejora del rendimiento y resultados de una organización. La mejora continua es un concepto que es fundamental para las teorías y programas de gestión de la calidad y de la seguridad de la información. La mejora continua es clave para la gestión de la seguridad de la Información

                    La seguridad de la información es un problema complejo en muchos sentidos: redes complejas, requisitos complejos y tecnología compleja. Pero sería mucho más manejable si fuera estático. Sin embargo, está lejos de ser estático. Se agregan nuevos sistemas a la red. Los requisitos del negocio cambian con frecuencia. Y el panorama de amenazas es extremadamente dinámico. Gestionar la seguridad en este entorno es un reto importante.

                    Una clave para una administración de seguridad efectiva es comprender el estado actual de los riesgos y las tareas de la seguridad de la información

                    La complejidad introduce intrínsecamente errores, huecos y los oculta al mismo tiempo.

                    Con los cambios casi constantes que ocurren en la red y el panorama dinámico de amenazas, se requiere una evaluación continua de la seguridad.

                    La forma más efectiva de automatizar este análisis es establecer controles, definiciones de configuración o comportamiento correctos o incorrectos y evaluar continuamente la seguridad de la red con respecto a esos controles. Lo que hace con este análisis es lo que separa a las organizaciones de seguridad verdaderamente efectivas del resto.

                    Mejorar la seguridad requiere algo más que arreglar lo que está roto. Requiere medir la efectividad de las operaciones de seguridad; Tecnología, personas y procesos. La evaluación continua de los controles de seguridad definidos y la medición de los resultados a lo largo del tiempo crea un marco para medir las operaciones de seguridad.

                    Establecer la expectativa de que la mejora es el objetivo, dará como resultado una mejor seguridad.</td>
             
                </tr>
                 <tr>
                    <td>3.14 Control</td>
                    <td>Medida que modifica un riesgo.</td>
                    <td>Los controles de seguridad son medidas de seguridad técnicas o administrativas para evitar, contrarrestar o minimizar la pérdida o falta de disponibilidad debido a las amenazas que actúan por una vulnerabilidad asociada a la amenaza. En esto consiste un riesgo de seguridad.

                    Los controles están referenciados casi siempre a un aspecto de la seguridad, pero rara vez se definen.

                    Los controles también se pueden definir por su propia naturaleza, como controles de compensación técnicos, administrativos, de personal, preventivos, de detección y correctivos, así como controles generales.

                    Esto de los controles de seguridad podría parecer algo extremadamente técnico sin embargo la experiencia nos dice que el “ambiente de control” establece el tono de una organización, influyendo en la conciencia de control de su gente. Es la base de todos los otros componentes del control interno como son la disciplina y la estructura.

                    Los valores éticos en una organización se desarrollan también con la competencia de su personal y el estilo con el que se organizan y hacen cumplir los controles establecidos, también para la seguridad de la información

                    En primer lugar, encontramos los controles asociados a las acciones que las personas toman, llamamos a estos controles administrativos.

                    Los controles administrativos son el proceso de desarrollar y garantizar el cumplimiento de las políticas y los procedimientos. Tienden a ser cosas que los empleados pueden hacer, o deben hacer siempre, o no pueden hacer. Otra clase de controles en seguridad que se llevan a cabo o son administrados por sistemas informáticos, estos son controles técnicos.

                    Los controles de la fase de actividad pueden ser técnicos o administrativos y se clasifican de la siguiente manera:

                    Controles preventivos para evitar que la amenaza entre en contacto con la debilidad.
                    Controles de detección para identificar que la amenaza ha aterrizado en nuestros sistemas.
                    Controles correctivos para mitigar o disminuir los efectos de la amenaza que se manifiesta.</td>
             
                </tr>

                <tr>
                    <td>3.15 Objetivo de Control</td>
                    <td>Declaración que describe lo que se debe lograr como resultado de la implementación de controles (3.14)</td>
                    <td>Este concepto hace posible cumplir con la filosofía de la norma ISO 27001 donde la base de la misma se encuentra el ciclo PDCA donde se hace imprescindible conocer y averiguar hasta qué punto se alcanzan los objetivos

                    En concreto:

                    En la planificación del sistema se establecen los objetivos
                    En la implantación del sistema se debe establecen en qué medida se alcanzan sus objetivos
                    En la monitorización del sistema deberemos realizar una medición real del desempeño de los objetivos
                    En la Evaluación del desempeño deberemos evaluar el cumplimiento de los objetivos y establecer medidas de mejora si fueran necesarias
                    Los requisitos de la norma ISO 27001 nos llevan a establecer al menos dos tipos de objetivos medibles

                    Objetivos medibles para los procesos de Gestión de Seguridad de la Información y en general para todo el SGSI
                    Objetivos para los controles de seguridad
                    Esto no quita que podamos definir objetivos a otros niveles como departamentos, personales etc.</td>
             
                </tr>

                <tr>
                    <td>3.16 Corrección</td>
                    <td>Acción para eliminar una no conformidad detectada</td>
                    <td>Una no conformidad es cualquier incumplimiento de un requisito. VEASE 3.11

                    Un requisito puede ser el de un cliente, de un organismo legal o regulador, de la normas ISO 27001 o de un procedimiento interno de la propia organización o de la seguridad de la información.

                    A la hora de reaccionar ante una no conformidad podemos tomar acciones para

                    Corregir una no conformidad tratando las consecuencias inmediatas
                    Determinar las causas de la no conformidad para eliminarlas mediante una acción correctiva de forma que ya no se vuelva a producir
                    En este sentido una correccción se define como la acción tomada para evitar las consecuencias inmediatas de una no conformidad.</td>
             
                </tr>

                 <tr>
                    <td>3.17 Acción Correctiva</td>
                    <td>Acción para eliminar la causa de una no conformidad y para prevenir la recurrencia.</td>
                    <td>Una acción correctiva se define como la acción tomada para evitar la repetición de una no conformidad mediante la identificación y tratamiento de las causas que la provocaron.</td>
             
                </tr>

                <tr>
                    <td>3.18 Medida Derivada</td>
                    <td>Medida (3.42) que se define como una función de dos o más valores de medidas base (3.8)</td>
                    <td>Las medidas o indicadores derivados son aquellos que se establecen en base a otro indicador existente. Los indicadores derivados normalmente se refieren a:

                    Fórmulas de Cálculo como los subtotales o funciones de agregación dinámica de datos como son los datos pre-calculados como por ejemplo sumas continuas etc.
                    Datos o indicadores y de funciones sin agregación dinámica intrínseca o propia como pueden ser cálculos de promedios o conteo de ocurrencias de la variable o medida base.</td>
             
                </tr>

                <tr>
                    <td>3.19 Información Documentada</td>
                    <td>Se refiere a la información necesaria que una organización debe controlar y mantener actualizada tomando en cuenta y el soporte en que se encuentra. La información documentada puede estar en cualquier formato (audio, video, ficheros de texto etc.) así como en cualquier tipo de soporte o medio independientemente de la fuente de dicha información. En general la información documentada se refiere a:

                    * Al sistema de gestión y sus procesos
                    * Información necesaria para la actividad de la propia
                    * Evidencias o registros de los resultados obtenidos en cualquier proceso del sistema de gestión o de la organización</td>
                    <td>En un sistema de gestión no debemos pasar por alto el control y la organización de nuestra documentación de forma que cumplamos con los requisitos para almacenar, administrar y revisar la documentación.

                    En primer lugar deberemos garantizar que los contenidos de la documentación sean adecuados y describan de la forma más práctica y correcta posible los procesos ya que la documentación debe ser la herramienta para demostrar que se han implementado correctamente los procesos.

                    A veces una estructura demasiado compleja con distintos niveles de información y accesos diferenciados puede no ser necesaria y complicar las cosas innecesariamente

                    Nuestra experiencia nos enseña que la mayoría de las veces basta con una buena asesoría de implementación en Sistemas de Gestión para organizar la información de acuerdo a lo que la organización necesita y que diseñas un sistema propio de gestión documental puede resultar costoso y un gasto de tiempo y recursos que no siempre es necesario.</td>
             
                </tr>

                <tr>
                    <td>3.20 Efectividad</td>
                    <td>En qué medida se realizan las actividades planificadas y se logran los resultados planificados.</td>
                    <td>Un sistema de Gestión para la seguridad de la información es un conjunto de elementos interrelacionados entre sí mediante las múltiples actividades de la organización. Cada actividad definida por un proceso tendrá una o varias entradas así como salidas, necesarias por lo demás para su control. Todas las salidas de los procesos estarán enfocadas a la consecución de los objetivos de la seguridad de la información de la organización. La eficacia por tanto es la medida en que los procesos contribuyen a la consecución de los objetivos de la Seguridad de la Información. En el caso la eficacia de los procesos se medirá en el orden en que contribuyen a la consecución de los objetivos de seguridad de la información

                    La efectividad se refiere al grado en que se logra un efecto planificado para la seguridad de la información. Las actividades planeadas para la seguridad de la información serán efectivas si estas actividades se realizan de acuerdo a lo planificado en los objetivos para la seguridad de la información.

                    De manera similar, los resultados planificados son efectivos si estos resultados se logran realmente.

                    La efectividad consiste en hacer lo planificado, completar las actividades y alcanzar los objetivos.</td>
             
                </tr>

                <tr>
                    <td>3.21 Evento</td>
                    <td>Ocurrencia o cambio de un conjunto particular de circunstancias

                    Un evento puede ser repetitivo y puede tener varias causas.
                    Un evento puede consistir en algo que no sucede.
                    Un evento puede ser clasificado como un “incidente” o “accidente”.</td>
                    <td>Un evento de seguridad es cualquier ocurrencia observable que sea relevante para la seguridad de la información. Esto puede incluir intentos de ataques o fallos que descubren vulnerabilidades de seguridad existentes

                    Hemos de diferenciar los eventos en la seguridad de la información de los incidentes de seguridad. Un incidente es un evento de seguridad que provoca daños o riesgos para los activos y operaciones de seguridad de la información.

                    Un evento de seguridad es algo que sucede que podría tener implicaciones de seguridad de la información. Un correo electrónico no deseado es un evento de seguridad porque puede contener enlaces a malware. Las organizaciones pueden recibir miles o incluso millones de eventos de seguridad identificables cada día. Estos normalmente se manejan mediante herramientas automatizadas o simplemente se registran.

                    Un incidente de seguridad es un evento de seguridad que provoca daños como la pérdida de datos. Los incidentes también pueden incluir eventos que no implican daños, pero son riesgos viables. Por ejemplo, un empleado que hace clic en un enlace en un correo electrónico no deseado que lo hizo a través de los filtros puede ser visto como un incidente.

                    Los eventos de seguridad pasan en su mayoría inadvertidos para los usuarios. En el momento que los usuarios detectan actividad sospechosa, normalmente se recomienda que se reporte como un incidente.</td>
             
                </tr>

                <tr>
                    <td>3.22 Contexto Externo</td>
                    <td>Entorno externo en el que la organización busca alcanzar sus objetivos el contexto externo puede incluir :

                    El entorno cultural, social, político, jurídico, reglamentario, financiero, tecnológico, económico, natural y competitivo, ya sea internacional, nacional, regional o local;
                    Influencias y tendencias clave que tienen impacto en los objetivos de la organización
                    los valores de actores externos y como es percibida la organización (sus relaciones con el entorno externo)</td>
                    <td>Para definir correctamente el contexto externo podríamos comenzar por un análisis del entorno centrándonos en aquellos factores que podrían afectar a la organización o que están relacionados con las actividades y objetivos de la organización.

                    El proceso de definición del contexto externo no es un proceso que se realiza una sola vez y ya hemos terminado, sino que necesitamos controlar en todo momento los cambios en los entornos externos, y tener en cuenta los puntos de vista de las partes interesadas.

                    También podemos investigar el entorno externo de forma sistemática. Un enfoque simple para realizar esta tareas seria comenzar con una lista de puntos en torno a los siguientes factores, que luego pueden desarrollarse:

                    Los factores políticos son la medida en que los gobiernos o las influencias políticas pueden impactar o impulsar las tendencias o culturas globales, regionales, nacionales, locales y comunitarias. Pueden incluir estabilidad política, política exterior, prácticas comerciales y relaciones laborales.
                    Los factores económicos incluyen tendencias y factores globales, nacionales y locales, mercados financieros, ciclos crediticios, crecimiento económico, tasas de interés, tasas de cambio, tasas de inflación y costo de capital.
                    Los factores sociales incluyen cultura, conciencia de salud, demografía, educación, crecimiento de la población, actitudes profesionales y énfasis en la seguridad.
                    Los factores tecnológicos incluyendo sistemas informáticos, avances o limitaciones tecnológicas, inteligencia artificial, robótica, automatización, incentivos tecnológicos, la tasa de cambio tecnológico, investigación y desarrollo, etc.
                    Jurídico – Cuestiones legislativas o reglamentarias y sensibilidades.
                    Los factores ambientales incluyen el clima global, regional y local, el clima adverso, los peligros naturales, los desechos peligrosos y las tendencias relacionadas.</td>
                         
                </tr>

                <tr>
                    <td>3.22 Contexto Externo</td>
                    <td>Entorno externo en el que la organización busca alcanzar sus objetivos el contexto externo puede incluir :

                    El entorno cultural, social, político, jurídico, reglamentario, financiero, tecnológico, económico, natural y competitivo, ya sea internacional, nacional, regional o local;
                    Influencias y tendencias clave que tienen impacto en los objetivos de la organización
                    los valores de actores externos y como es percibida la organización (sus relaciones con el entorno externo)</td>
                    <td>Para definir correctamente el contexto externo podríamos comenzar por un análisis del entorno centrándonos en aquellos factores que podrían afectar a la organización o que están relacionados con las actividades y objetivos de la organización.

                    El proceso de definición del contexto externo no es un proceso que se realiza una sola vez y ya hemos terminado, sino que necesitamos controlar en todo momento los cambios en los entornos externos, y tener en cuenta los puntos de vista de las partes interesadas.

                    También podemos investigar el entorno externo de forma sistemática. Un enfoque simple para realizar esta tareas seria comenzar con una lista de puntos en torno a los siguientes factores, que luego pueden desarrollarse:

                    Los factores políticos son la medida en que los gobiernos o las influencias políticas pueden impactar o impulsar las tendencias o culturas globales, regionales, nacionales, locales y comunitarias. Pueden incluir estabilidad política, política exterior, prácticas comerciales y relaciones laborales.
                    Los factores económicos incluyen tendencias y factores globales, nacionales y locales, mercados financieros, ciclos crediticios, crecimiento económico, tasas de interés, tasas de cambio, tasas de inflación y costo de capital.
                    Los factores sociales incluyen cultura, conciencia de salud, demografía, educación, crecimiento de la población, actitudes profesionales y énfasis en la seguridad.
                    Los factores tecnológicos incluyendo sistemas informáticos, avances o limitaciones tecnológicas, inteligencia artificial, robótica, automatización, incentivos tecnológicos, la tasa de cambio tecnológico, investigación y desarrollo, etc.
                    Jurídico – Cuestiones legislativas o reglamentarias y sensibilidades.
                    Los factores ambientales incluyen el clima global, regional y local, el clima adverso, los peligros naturales, los desechos peligrosos y las tendencias relacionadas.</td>
                         
                </tr>

                <tr>
                    <td>3.23 Gobernanza de la Seguridad de la Información</td>
                    <td>Sistema por el cual las actividades de seguridad de la información de una organización son dirigidas y controladas.</td>
                    <td>El gobierno de la seguridad de la información es la estrategia de una empresa para reducir el riesgo de acceso no autorizado a los sistemas y datos de tecnología de la información.

                    Las actividades de gobierno de la seguridad implican el desarrollo, la planificación, la evaluación y la mejora de la gestión de riesgos para la seguridad de la información y las políticas de seguridad de una organización

                    El gobierno de la seguridad de la empresa incluye determinar cómo las distintas unidades de negocio de la organización, los ejecutivos y el personal deben trabajar juntos para proteger los activos digitales de una organización, garantizar la prevención de pérdida de datos y proteger la reputación pública de la organización.

                    Las actividades de gobierno de la seguridad de la empresa deben ser coherentes con los requisitos de cumplimiento, la cultura y las políticas de gestión de la organización.

                    El desarrollo y el mantenimiento de la gobernanza de la seguridad de la información pueden requerís la realización de pruebas de análisis de amenazas, vulnerabilidades y riesgos que son específicas para la industria de la empresa.

                    El gobierno de la seguridad de la información también se refiere a la estrategia de la empresa para reducir la posibilidad de que los activos físicos que son propiedad de la empresa puedan ser robados o dañados. En este contexto, el gobierno de la seguridad incluye barreras físicas, cerraduras, sistemas de cercado y respuesta a incendios, así como sistemas de iluminación, detección de intrusos, alarmas y cámaras.</td>
                         
                </tr>

                <tr>
                    <td>3.24 Órgano Rector</td>
                    <td>Persona o grupo de personas que son responsables del desempeño de la organización. El órgano rector puede ser una junta directiva o consejo de administración. </td>
                    <td>En el caso de la seguridad de la información el órgano rector será el responsable del desempeño o el resultado del sistema de gestión de la seguridad de la información. EN definitiva, el órgano rector tendrá la responsabilidad de rendir cuentas del rendimiento del sistema de gestión de la seguridad de la información

                    Este factor es algo que aún no es asumido por muchas empresas donde vemos que ante los fallos de seguridad producidos en grandes empresas en los últimos años revelan que menos de la mitad de los directivos de estas empresas están al tanto verdaderamente de las políticas de seguridad de la información dentro de sus propias organizaciones.

                    El problema al que nos enfrentamos es bastante más frecuente de lo que imaginamos. Basta pensar que en la actualidad simplemente cuesta aun encontrar una reunión del consejo de administración de una gran empresa, dedicado a los riesgos de tecnología de la información y las estrategias para abordar los riesgos.

                    Es por ello que la norma insiste en dedicar todo un capítulo de LIDERAZGO a dejar claro que la responsabilidad de impulsar y mantener el sistema de gestión para la seguridad de la información reside en los órganos rectores de cada organización.</td>
                         
                </tr>

                <tr>
                    <td>3.25 Indicador</td>
                    <td>Medida que proporciona una estimación o evaluación.</td>
                    <td>Los indicadores para la evaluación de la seguridad de la información a menudo sirven como evidencia forense de posibles intrusiones en un sistema o red host.

                    Un sistema de información debe permitir a los especialistas de la seguridad de la información y a los administradores del sistema detectar intentos de intrusión u otras actividades maliciosas.

                    Los indicadores permiten analizar y mejorar las técnicas y comportamientos ante un malware o amenaza en particular. Estos indicadores también proporcionan datos para entender mejor las amenazas, generando información valiosa para compartir dentro de la comunidad para mejorar aún más la respuesta a incidentes y las estrategias de respuesta de una organización.

                    Normalmente los indicadores se pueden sacar en los dispositivos que se encuentran en los registros de eventos y las entradas de un sistema, así como en sus aplicaciones y servicios. Para ello los administradores de sistemas también emplean herramientas que monitorean los dispositivos y redes para ayudar a mitigar, si no prevenir, violaciones o ataques.

                    Aquí hay algunos indicadores que se utilizar habitualmente en sistemas de seguridad de la información:

                    Tráfico inusual que entra y sale de la red
                    Archivos desconocidos en aplicaciones y procesos en el sistema.
                    Actividad sospechosa en administrador o cuentas privilegiadas.
                    Actividades irregulares como el tráfico o actividad en sistemas que normalmente no se utilizan
                    Inicios de sesión, acceso y otras actividades de red que indiquen ataques de sondeo o de fuerza bruta
                    Picos anómalos de solicitudes y volumen de lectura en archivos de la empresa
                    Tráfico de red que atraviesa puertos inusualmente utilizados
                    Configuraciones de archivos, servidores de nombres de dominio (DNS) y registro alterados, así como cambios en la configuración del sistema, incluidos los de dispositivos móviles
                    Grandes cantidades de archivos comprimidos y datos inexplicablemente encontrados en lugares donde no deberían estar de la empresa para reducir la posibilidad de que los activos físicos que son propiedad de la empresa puedan ser robados o dañados. En este contexto, el gobierno de la seguridad incluye barreras físicas, cerraduras, sistemas de cercado y respuesta a incendios, así como sistemas de iluminación, detección de intrusos, alarmas y cámaras.</td>
                </tr>

                <tr>
                    <td>3.26 Necesidad de Información</td>
                    <td>Conocimiento necesario para gestionar objetivos, riesgos y problemas.</td>
                    <td>Este es un concepto relacionado con el desarrollo de procesos de medición que determinen qué información de medición se requiere, cómo se deben aplicar las medidas y los resultados del análisis, y cómo determinar si los resultados del análisis son válidos más que nada en escenarios aplicables a las disciplinas de ingeniería y gestión de sistemas y software.

                    Para establecer los objetivos de seguridad de la información que tengan en cuenta los riesgos y las amenazas deberemos establecer unos criterios de necesidad de información. Se trata en definitiva de contar con un modelo que defina las actividades que se requieren para especificar adecuadamente el proceso de medición para obtener dicha información.

                    Idealmente los procesos de medición deben ser flexibles, adaptables y adaptables a las necesidades de los diferentes usuarios.</td>
                </tr>

                <tr>
                    <td>3.27 Instalaciones de Procesamiento de Información</td>
                    <td>Cualquier sistema de procesamiento de información, servicio o infraestructura, o la ubicación física que lo alberga.</td>
                    <td>Las instalaciones de procesamiento de información en una empresa, deben ser consideradas como un activo de información que es necesario alcanzar las metas y objetivos de la organización

                    Para comprender esto en el escenario de una certificación de una norma de seguridad de la información debemos tener en cuenta que deberemos afrontar una auditoría de las instalaciones de procesamiento de información demostrando que está controlada y puede garantizar un procesamiento oportuno, preciso y eficiente de los sistemas de información y aplicaciones en condiciones normales y generalmente disruptivas.

                    De acuerdo con la norma ISO 27001, una auditoría de instalaciones de procesamiento de información es la evaluación de cualquier sistema, servicio, infraestructura o ubicación física que contenga y procese información. Una instalación puede ser una actividad o un lugar que puede ser tangible o intangible; así como, un hardware o un software.</td>
                </tr>

                <tr>
                    <td>3.28 Seguridad de la Información</td>
                    <td>Preservación de la confidencialidad, integridad y disponibilidad de la información

                    Además hay que considerar otras propiedades, como la autenticidad, la responsabilidad, el no repudio y la confiabilidad también pueden estar involucrados.</td>
                    <td>La seguridad de la información como vemos tiene por objetivo la protección de la confidencialidad, integridad y disponibilidad de los datos de los sistemas de información de cualquier amenaza y de cualquiera que tenga intenciones maliciosas.

                    La confidencialidad, la integridad y la disponibilidad a veces se conocen como la tríada de seguridad de la información que actualmente ha evolucionado incorporando nuevos conceptos tales como la autenticidad, la responsabilidad, el no repudio y la confiabilidad.

                    La seguridad de la información debe ser considerada desde la base de un análisis y evaluación de riesgos teniendo en cuenta cualquier factor que pueda actuar como un riesgo o una amenaza para la confidencialidad, integridad y disponibilidad etc. de los datos

                    La información confidencial debe conservarse; no puede modificarse, modificarse ni transferirse sin permiso. Por ejemplo, un mensaje podría ser modificado durante la transmisión por alguien que lo intercepte antes de que llegue al destinatario deseado. Las buenas herramientas de criptografía pueden ayudar a mitigar esta amenaza de seguridad.

                    Las firmas digitales pueden mejorar la seguridad de la información al mejorar los procesos de autenticidad y hacer que las personas prueben su identidad antes de poder acceder a los datos de un sistema de información.</td>
                </tr>

                <tr>
                    <td>3.29 Continuidad de la Seguridad de la Información</td>
                    <td>Procesos y procedimientos para garantizar la continuidad de las operaciones de seguridad de la información</td>
                    <td>El termino continuidad de la seguridad de la información se utiliza dentro de la norma ISO 27001 para describir el proceso que garantice la confidencialidad, integridad y disponibilidad de la información cuando un incidente ocurre o una amenaza se materializa.

                    Con cierta frecuencia se interpreta este punto como una necesidad de contar con planes de continuidad del negocio asumiendo como requisito la implementación de un plan de continuidad del negocio integral para cumplir con el punto de la norma que nos habla de la continuidad de la seguridad de la información.

                    Un plan de continuidad del negocio sin duda puede ser una gran ayuda para garantizar que las funciones de seguridad de la información se mantengan aunque no es un requisito de la norma ISO 27001 un plan de seguridad integran enfocado a la continuidad de los servicios en general

                    Entonces, ¿Qué significa realmente la continuidad de la seguridad de la información? La continuidad de la seguridad de la información significa en principio garantizar que tengamos la capacidad de mantener las medidas de protección de la información cuando ocurra un incidente.

                    En este sentido hemos de tener en cuenta que la continuidad de la seguridad de la información debería ir un paso más adelante que la continuidad del negocio aunque la continuidad del negocio no es objeto de la norma 27001

                    En un caso hipotético de imposibilidad de acceso instalaciones debido a un incidente cualquiera deberíamos tener en cuenta en primer lugar poder garantizar que la empresa pueda continuar operando, que los clientes puedan recibir servicios, que los pagos se procesen y que los servicios sigan funcionando, es decir, la continuidad comercial tradicional. Pero desde una perspectiva de seguridad de la información, también debe poder asegurarse de que los datos estén protegidos mientras se implementan métodos de trabajo alternativos, por ejemplo, los usuarios que acceda por teletrabajo y procesan datos confidenciales.</td>
                </tr>

                <tr>
                    <td>3.30 Evento de Seguridad de la Información</td>
                    <td>Ocurrencia identificada de un sistema, servicio o estado de red que indica un posible incumplimiento de la política de seguridad de la información o falla de los controles o una situación desconocida que puede ser relevante para la seguridad.</td>
                    <td>Podríamos considerar como un evento en la seguridad de la información a cualquier cambio observado en el comportamiento normal de un sistema de información, entorno, proceso, flujo de trabajo o persona y que pueda afectar a la seguridad de la información. Por ejemplo: si se encuentran modificaciones en las listas de control de acceso para un router o modificaciones en las reglas de configuración de un firewall.

                    Debemos distinguir además de la diferencia entre un evento de seguridad de la información y las alertas. Una alerta es una notificación de que se ha producido un evento en particular (o una serie de eventos), que y que se envía a los responsables para la seguridad de la información en cada caso con el propósito de generar una acción.</td>
                </tr>

                <tr>
                    <td>3.31 Incidente de Seguridad de la Información</td>
                    <td>Un evento o una serie de eventos de seguridad de la información no deseados o inesperados que tienen una probabilidad significativa de comprometer las operaciones comerciales y amenazar la seguridad de la información.</td>
                    <td>Un incidente de seguridad de la información puede definirse también como cualquier evento que tenga el potencial de afectar la preservación de la confidencialidad, integridad, disponibilidad o valor de la información

                    Aquí les dejamos una lista con varios ejemplos típicos de incidentes en la seguridad de la información:

                    Revelación no autorizada o accidental de información clasificada o sensible; p.ej. envió de un correo electrónico que contiene información confidencial o clasificada enviada a destinatarios incorrectos.
                    Robo o pérdida de información clasificada o sensible; p.ej. copia impresa de clasificados o sensibles
                    Información robada de un maletín olvidado en un restaurante o perdido
                    Modificación no autorizada de información clasificada o sensible; p.ej. alterando copia maestra de registro de estudiante o personal
                    Robo o pérdida de equipo que contiene información clasificada o sensible; p.ej. ordenador portátil que contiene información confidencial o clasificada
                    Acceso no autorizado a los sistemas de información de la Organización; p.ej. Ejemplo de virus, malware, ataque de denegación de servicio.
                    Acceso no autorizado a áreas que contienen equipo de TI que almacena información confidencial o confidencial; p.ej. entrada no autorizada en un centro de datos o salas de control de la red informática.</td>
                </tr>

                <tr>
                    <td>3.31 Incidente de Seguridad de la Información</td>
                    <td>Un evento o una serie de eventos de seguridad de la información no deseados o inesperados que tienen una probabilidad significativa de comprometer las operaciones comerciales y amenazar la seguridad de la información.</td>
                    <td>Un incidente de seguridad de la información puede definirse también como cualquier evento que tenga el potencial de afectar la preservación de la confidencialidad, integridad, disponibilidad o valor de la información

                    Aquí les dejamos una lista con varios ejemplos típicos de incidentes en la seguridad de la información:

                    Revelación no autorizada o accidental de información clasificada o sensible; p.ej. envió de un correo electrónico que contiene información confidencial o clasificada enviada a destinatarios incorrectos.
                    Robo o pérdida de información clasificada o sensible; p.ej. copia impresa de clasificados o sensibles
                    Información robada de un maletín olvidado en un restaurante o perdido
                    Modificación no autorizada de información clasificada o sensible; p.ej. alterando copia maestra de registro de estudiante o personal
                    Robo o pérdida de equipo que contiene información clasificada o sensible; p.ej. ordenador portátil que contiene información confidencial o clasificada
                    Acceso no autorizado a los sistemas de información de la Organización; p.ej. Ejemplo de virus, malware, ataque de denegación de servicio.
                    Acceso no autorizado a áreas que contienen equipo de TI que almacena información confidencial o confidencial; p.ej. entrada no autorizada en un centro de datos o salas de control de la red informática.</td>
                </tr>


                <tr>
                    <td>3.32 Gestión de Incidentes de Seguridad de a Información</td>
                    <td>Conjunto de procesos para detectar, informar, evaluar, responder, tratar y aprender de los incidentes de seguridad de la información.</td>
                    <td>El conjunto de procesos para tratar los incidentes de la seguridad de la información debe

                    Identificar,
                    Administrar y registrar,
                    Analizar las amenazas en tiempo real
                    Buscar respuestas sólidas y completas a cualquier problema
                    Mantener una infraestructura que permita realizar estas funciones
                    Hemos de tener en cuenta que un incidente de seguridad puede ser cualquier cosa, desde una amenaza activa hasta un intento de intrusión que ha generado un riesgo o ha conseguido comprometer la seguridad generando una violación de datos. También debemos considerar las violaciones a las políticas y el acceso no autorizado a datos como salud, finanzas, números de seguridad social y registros de identificación personal etc.

                    EL PROCESO DE GESTIÓN DE INCIDENTES DE INFORMACION

                    La gestión de incidentes de la seguridad de la información debe en primer lugar responder a las amenazas que día a día crecen tanto en volumen como en sofisticación. Pero no debemos quedarnos solamente en adoptar medidas sino que se trata más bien de adoptar prácticas que además de identificar, responder y mitigar lo más rápidamente posible cualquier tipo de incidentes, al mismo tiempo nos hagan más resistentes y nos protejan contra futuros incidentes.

                    El proceso de gestión de incidentes de seguridad de la información generalmente comienza con una alerta que nos provee de la información necesaria sobre el incidente para involucrar al equipo de respuesta a incidentes A partir de ahí, el personal de respuesta a incidentes investigará y analizará el incidente para determinar su alcance, evaluar los daños y desarrollar un plan de mitigación.

                    A modo de ejemplo podemos tomar como modelo una estrategia sistemática para la gestión de incidentes de seguridad basado en la norma ISO / IEC 27035 que nos describe un proceso de cinco pasos para la gestión de incidentes de seguridad, que incluye:

                    1. Estar preparados para el manejo de incidencias.
                    3. Monitorear, identificar e informar de todos los incidentes.
                    4. Evalúe y clasifique los incidentes para determinar los próximos pasos apropiados para mitigar el riesgo.
                    5. Responda al incidente conteniéndolo, investigándolo y resolviendo
                    6. Aprenda y documente los puntos clave de cada incidente
                    RESPUESTA A INCIDENTES DE LA SEGURIDAD DE LA INFORMACION

                    Está claro que las medidas de respuesta a incidentes pueden variar según la organización y sus objetivos comerciales y operacionales, aunque podríamos definir una serie de pasos generales que a menudo se toman para administrar las amenazas.

                    El proceso de respuesta a incidentes suele comenzar con una investigación completa de un sistema anómalo o irregularidad en el sistema, los datos o el comportamiento del usuario.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection
@section('scripts')
@parent

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!--Abecedario-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
         (function(){

         // Search function
         $.fn.dataTable.Api.register( 'alphabetSearch()', function ( searchTerm ) {
             this.iterator( 'table', function ( context ) {
                 context.alphabetSearch = searchTerm;
             } );

             return this;
         } );

         // Recalculate the alphabet display for updated data
         $.fn.dataTable.Api.register( 'alphabetSearch.recalc()', function ( searchTerm ) {
             this.iterator( 'table', function ( context ) {
                 draw(
                     new $.fn.dataTable.Api( context ),
                     $('div.alphabet', this.table().container())
                 );
             } );

             return this;
         } );


         // Search plug-in
         $.fn.dataTable.ext.search.push( function ( context, searchData ) {
             // Ensure that there is a search applied to this table before running it
             if ( ! context.alphabetSearch ) {
                 return true;
             }

             if ( searchData[1].charAt(0) === context.alphabetSearch ) {
                 return true;
             }


             return false;
         } );


         // Private support methods
         function bin ( data ) {
             var letter, bins = {};

             for ( var i=0, ien=data.length ; i<ien ; i++ ) {
                 letter = data[i].charAt(0).toUpperCase();

                 if ( bins[letter] ) {
                     bins[letter]++;
                 }
                 else {
                     bins[letter] = 1;
                 }
             }

             return bins;
         }

         function draw ( table, alphabet )
         {
             alphabet.empty();

             var columnData = table.column(1).data();
             var bins = bin( columnData );

             $('<span class="clear active"/>')
                 .data( 'letter', '' )
                 .data( 'match-count', columnData.length )
                 .html( 'Todos' )
                 .appendTo( alphabet );

             for ( var i=0 ; i<26 ; i++ ) {
                 var letter = String.fromCharCode( 65 + i );

                 $('<span/>')
                     .data( 'letter', letter )
                     .data( 'match-count', bins[letter] || 0 )
                     .addClass( ! bins[letter] ? 'empty' : '' )
                     .html( letter )
                     .appendTo( alphabet );
             }

             $('<div class="alphabetInfo"></div>')
                 .appendTo( alphabet );
         }


         $.fn.dataTable.AlphabetSearch = function ( context ) {
             var table = new $.fn.dataTable.Api( context );
             var alphabet = $('<div class="alphabet"/>');

             draw( table, alphabet );

             // Trigger a search
             alphabet.on( 'click', 'span', function () {
                 alphabet.find( '.active' ).removeClass( 'active' );
                 $(this).addClass( 'active' );

                 table
                     .alphabetSearch( $(this).data('letter') )
                     .draw();
             } );

             // Mouse events to show helper information
             alphabet
                 .on( 'mouseenter', 'span', function () {
                     alphabet
                         .find('div.alphabetInfo')
                         .css( {
                             opacity: 1,
                             left: $(this).position().left,
                             width: $(this).width()
                         } )
                         .html( $(this).data('match-count') )
                 } )
                 .on( 'mouseleave', 'span', function () {
                     alphabet
                         .find('div.alphabetInfo')
                         .css('opacity', 0);
                 } );

             // API method to get the alphabet container node
             this.node = function () {
                 return alphabet;
             };
         };

         $.fn.DataTable.AlphabetSearch = $.fn.dataTable.AlphabetSearch;


         // Register a search plug-in
         $.fn.dataTable.ext.feature.push( {
             fnInit: function ( settings ) {
                 var search = new $.fn.dataTable.AlphabetSearch( settings );
                 return search.node();
             },
             cFeature: 'A'
         } );

         }());


         $(document).ready(function() {
             var table = $('#dom').DataTable( {
                 dom: 'Alfrtip'


             } );
         } );
    </script>
@endsection