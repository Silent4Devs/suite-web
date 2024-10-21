<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AsistentService
{
    protected $client;

    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client;
        $this->baseUrl = 'http://192.168.9.77:8080'; // Definir URL base
    }


    // Función para normalizar el texto, removiendo acentos, espacios adicionales y caracteres especiales
    function normalizeText($text)
    {
        // Convertir a minúsculas
        $text = strtolower($text);

        // Remover acentos y caracteres especiales
        $text = strtr($text, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'ü' => 'u', 'ñ' => 'n', '¿' => '', '¡' => ''
        ]);

        // Remover espacios innecesarios
        return trim(preg_replace('/\s+/', ' ', $text));
    }



    /**
     * Enviar pregunta a la API de Python.
     */
    public function postQuestionToPythonAPI($question)
    {
        $url = $this->baseUrl.'/ask-question/';


        $faq = [
            'hola' => 'Hola, ¿en qué puedo ayudarte?',
            'buenos dias' => 'Buenos días, ¿cómo puedo ayudarte hoy?',
            'buenas tardes' => 'Buenas tardes, ¿en qué puedo asistirte?',
            'como estas' => 'Estoy aquí para ayudarte. ¿Tienes alguna pregunta?',
            'que es este sistema' => 'Este sistema es una herramienta diseñada para ayudarte a gestionar consultas y obtener respuestas rápidas.',
            'quien eres' => 'Soy un bot creado para asistirte con cualquier duda que tengas sobre esta herramienta.',
            'como funciona' => 'Este sistema funciona respondiendo preguntas relacionadas con nuestras herramientas. Simplemente escribe tu consulta y te proporcionaré una respuesta.',
            'adios' => 'Adiós, ¡espero haber sido de ayuda!',
            'gracias' => 'De nada, ¡siempre estoy aquí para ayudar!',
            'que servicios ofreces' => 'Ofrezco respuestas rápidas sobre el uso de esta herramienta y soporte técnico en caso de dudas.',
            'necesito ayuda' => 'Por supuesto, ¿en qué área necesitas ayuda específicamente?',
            'donde encuentro soporte' => 'Puedes encontrar soporte técnico directamente en nuestro centro de ayuda o contactando a nuestro equipo de soporte.',
            'como puedo registrarme' => 'Para registrarte, simplemente dirígete a la página de registro, llena el formulario y sigue las instrucciones.',
            'como recupero mi contraseña' => 'Puedes recuperar tu contraseña desde la página de inicio de sesión, haciendo clic en "¿Olvidaste tu contraseña?" y siguiendo los pasos.',
            'cuanto cuesta el servicio' => 'Los precios varían según el plan que elijas. Visita nuestra página de precios para más detalles.',
            'hay alguna prueba gratis' => 'Sí, ofrecemos una prueba gratuita para que puedas probar nuestro servicio antes de suscribirte.',
            'como contacto al soporte' => 'Puedes contactar al soporte técnico a través de nuestro chat en vivo o enviándonos un correo electrónico a soporte@example.com.',
            'que tipos de pago aceptan' => 'Aceptamos pagos con tarjeta de crédito, PayPal y transferencias bancarias.',
            'cuales son los terminos y condiciones' => 'Puedes consultar nuestros términos y condiciones en el pie de página de nuestro sitio web.',
            'como cancelo mi suscripcion' => 'Para cancelar tu suscripción, dirígete a tu perfil y selecciona la opción de cancelar bajo la sección de suscripciones.',
            'puedo cambiar mi plan' => 'Sí, puedes cambiar de plan en cualquier momento desde tu perfil, en la sección de suscripciones.',
            'mi cuenta ha sido bloqueada' => 'Si tu cuenta ha sido bloqueada, contacta a nuestro equipo de soporte para revisar el motivo y ayudarte a desbloquearla.',
            'como actualizo mi perfil' => 'Puedes actualizar tu perfil accediendo a tu cuenta y haciendo clic en la sección de "Perfil" para modificar tus datos.',
            'como cambio mi contraseña' => 'Puedes cambiar tu contraseña en la sección de configuración de tu perfil.',
            'como elimino mi cuenta' => 'Para eliminar tu cuenta, ve a la sección de configuración y selecciona la opción de eliminar cuenta.',
            'como recupero una cuenta bloqueada' => 'Contacta a nuestro equipo de soporte para recuperar tu cuenta bloqueada.',
            'hay alguna promocion vigente' => 'Consulta nuestra página principal para ver las promociones actuales.',
            'que diferencia hay entre los planes' => 'Los planes se diferencian en el número de usuarios, el espacio de almacenamiento y las características adicionales.',
            'como accedo a mi historial de compras' => 'Puedes acceder a tu historial de compras desde la sección de facturación en tu perfil.',
            'como puedo agregar usuarios a mi cuenta' => 'Para agregar usuarios, ve a la sección de administración y selecciona "Añadir usuarios".',
            'como cambio el correo de mi cuenta' => 'Puedes cambiar el correo asociado a tu cuenta desde la configuración de tu perfil.',
            'donde puedo ver las actualizaciones del sistema' => 'Las actualizaciones del sistema se publican en la sección de noticias de nuestro sitio web.',
            'el sistema es compatible con dispositivos moviles' => 'Sí, nuestro sistema es completamente compatible con dispositivos móviles.',
            'cuales son los requisitos del sistema' => 'Los requisitos del sistema varían según el plan y el uso previsto. Consulta nuestra página de especificaciones técnicas para más detalles.',
            'como obtengo soporte tecnico avanzado' => 'Para obtener soporte técnico avanzado, puedes contratar nuestro plan de soporte especializado.',
            'como puedo mejorar la seguridad de mi cuenta' => 'Te recomendamos habilitar la autenticación de dos factores y usar una contraseña segura.',
            'puedo integrar este sistema con otras herramientas' => 'Sí, ofrecemos integraciones con múltiples herramientas de terceros. Consulta nuestra página de integraciones para más detalles.',
            'puedo personalizar la apariencia del sistema' => 'Sí, ofrecemos opciones de personalización para la interfaz de usuario en ciertos planes.',
            'hay una aplicacion movil disponible' => 'Sí, puedes descargar nuestra aplicación móvil desde las tiendas de aplicaciones oficiales.',
            'que navegadores son compatibles' => 'Nuestro sistema es compatible con los navegadores más modernos como Chrome, Firefox, Safari y Edge.',
            'como puedo reportar un error en el sistema' => 'Puedes reportar errores directamente desde el sistema o contactando a nuestro equipo de soporte.',
            'que hago si el sistema esta caido' => 'Si experimentas una caída del sistema, contacta a nuestro equipo de soporte lo antes posible para obtener asistencia.',
            'puedo recuperar datos eliminados' => 'En algunos casos, es posible recuperar datos eliminados. Contacta a soporte para revisar tu caso.',
            'como realizo un respaldo de mis datos' => 'Puedes realizar respaldos desde la sección de configuración de tu cuenta.',
            'puedo restaurar un respaldo anterior' => 'Sí, los respaldos se pueden restaurar desde la sección de configuración de la cuenta.',
            'como puedo verificar el estado de mi servicio' => 'Puedes verificar el estado de tu servicio desde la página de estado del sistema o contactando al soporte técnico.',
            'cuales son los horarios de soporte' => 'Nuestro soporte está disponible 24/7 para atender tus consultas.',
            'como puedo actualizar mi plan' => 'Puedes actualizar tu plan desde la sección de suscripciones en tu cuenta.',
            'como contacto al administrador de mi cuenta' => 'Puedes contactar al administrador de tu cuenta enviando un mensaje desde la sección de administración.',
            'mi tarjeta de pago ha sido rechazada' => 'Si tu tarjeta ha sido rechazada, verifica los detalles ingresados o intenta con otro método de pago.',
            'como obtengo una factura' => 'Puedes obtener una factura accediendo a la sección de facturación en tu cuenta.',
            'el sistema tiene politicas de privacidad' => 'Sí, puedes revisar nuestras políticas de privacidad en el pie de página de nuestro sitio web.',
            'puedo solicitar una demo del sistema' => 'Sí, ofrecemos una demo gratuita para que puedas conocer el funcionamiento del sistema.',
            'como puedo configurar alertas' => 'Puedes configurar alertas desde la sección de configuración de tu cuenta.',
            'puedo recibir notificaciones por correo' => 'Sí, puedes habilitar las notificaciones por correo desde la sección de notificaciones en tu perfil.',
            'como puedo dar de baja a un usuario' => 'Puedes dar de baja a un usuario desde la sección de administración de usuarios en tu cuenta.',
            'como cambio mi metodo de pago' => 'Puedes cambiar tu método de pago desde la sección de facturación en tu cuenta.',
            'el sistema ofrece seguridad para mis datos' => 'Sí, implementamos medidas de seguridad avanzadas para proteger tus datos.',
            'puedo exportar mis datos' => 'Sí, puedes exportar tus datos en formato CSV desde la sección de configuraciones.',
            'el sistema permite agregar multiples administradores' => 'Sí, puedes agregar varios administradores desde la sección de administración de usuarios.',
            'que hago si olvide mi nombre de usuario' => 'Puedes recuperar tu nombre de usuario desde la página de inicio de sesión ingresando tu correo electrónico.',
            'como puedo desactivar las notificaciones' => 'Puedes desactivar las notificaciones desde la sección de configuraciones en tu cuenta.',
            'el sistema tiene alguna certificacion de seguridad' => 'Sí, nuestro sistema cuenta con certificaciones de seguridad como ISO 27001.',
            'puedo usar el sistema sin conexion a internet' => 'No, el sistema requiere una conexión a internet para funcionar correctamente.',
            'como configuro la autenticacion de dos factores' => 'Puedes habilitar la autenticación de dos factores desde la sección de seguridad en tu cuenta.',
            'puedo cancelar mi prueba gratuita' => 'Sí, puedes cancelar la prueba gratuita en cualquier momento desde la sección de suscripciones.',
            'como puedo cambiar el idioma del sistema' => 'Puedes cambiar el idioma desde la sección de configuración de tu cuenta.',
            'donde encuentro tutoriales' => 'Puedes encontrar tutoriales en la sección de ayuda en nuestro sitio web.',
            'como realizo un seguimiento de mis pedidos' => 'Puedes hacer seguimiento de tus pedidos desde la sección de pedidos en tu cuenta.',
            'que debo hacer si no recibo mis correos' => 'Si no recibes nuestros correos, revisa tu carpeta de spam o verifica tu dirección de correo en la configuración de tu cuenta.',
            'como puedo ver mis facturas anteriores' => 'Puedes ver tus facturas anteriores en la sección de facturación de tu cuenta.',
            'el sistema tiene garantia de servicio' => 'Sí, ofrecemos una garantía de satisfacción en todos nuestros servicios.',
            'que debo hacer si tengo una queja' => 'Puedes presentar una queja contactando a nuestro equipo de soporte.',
            'como puedo contactar al departamento de ventas' => 'Puedes contactar al departamento de ventas enviando un correo a ventas@example.com.',
            'el sistema tiene soporte multilenguaje' => 'Sí, el sistema está disponible en varios idiomas. Puedes seleccionar tu idioma preferido en la configuración.',
            'puedo personalizar mis informes' => 'Sí, puedes personalizar tus informes en la sección de reportes de tu cuenta.',
            'hay alguna aplicacion para escritorio' => 'Sí, ofrecemos una aplicación de escritorio que puedes descargar desde nuestra página de descargas.',
            'como puedo obtener una cotizacion' => 'Puedes obtener una cotización contactando a nuestro equipo de ventas.',
            'el sistema tiene un chat en vivo' => 'Sí, ofrecemos soporte a través de chat en vivo durante horas laborables.',
            'puedo acceder a mi cuenta desde varios dispositivos' => 'Sí, puedes acceder a tu cuenta desde cualquier dispositivo con conexión a internet.',
            'como configuro mi perfil de usuario' => 'Puedes configurar tu perfil de usuario desde la sección de configuración en tu cuenta.',
            'hay restricciones de edad para usar el servicio' => 'No, no hay restricciones de edad para usar nuestro servicio, pero se recomienda que los menores tengan supervisión.',
            'como aseguran la privacidad de mis datos' => 'Implementamos políticas de privacidad estrictas y encriptación para proteger tus datos.',
            'que debo hacer si el sistema se congela' => 'Si el sistema se congela, intenta refrescar la página o contacta al soporte si el problema persiste.',
            'como puedo mejorar mi experiencia de usuario' => 'Te recomendamos explorar nuestras configuraciones y personalizar el sistema según tus necesidades.',
            'como recupero mis datos en caso de perdida' => 'Puedes recuperar tus datos a través de los respaldos automáticos que el sistema realiza.',
            'como recibo notificaciones de actualizaciones' => 'Puedes habilitar las notificaciones de actualizaciones en la sección de configuración de tu cuenta.',
            'hay alguna comunidad de usuarios' => 'Sí, contamos con una comunidad activa de usuarios donde puedes intercambiar ideas y obtener ayuda.',
            'como puedo ayudar a otros usuarios' => 'Puedes ayudar a otros usuarios respondiendo preguntas en nuestra comunidad o compartiendo tus experiencias.',
            'puedo hacer sugerencias sobre el sistema' => 'Sí, valoramos tus sugerencias. Puedes enviarlas a nuestro equipo de soporte.',
            'como obtengo acceso a nuevas funcionalidades' => 'Las nuevas funcionalidades se habilitan automáticamente en tu cuenta, te notificaremos cuando estén disponibles.',
            'hay alguna forma de ser embajador del servicio' => 'Sí, ofrecemos un programa de embajadores. Contáctanos para más detalles.',
            'como puedo mejorar la colaboracion en mi equipo' => 'Utiliza nuestras herramientas de colaboración y asegúrate de que todos los miembros estén capacitados en su uso.',
            'el servicio ofrece soporte telefonico' => 'Sí, ofrecemos soporte telefónico durante horas laborales. Puedes encontrar los números de contacto en nuestro sitio web.',
            'como puedo gestionar mis tareas eficientemente' => 'Puedes utilizar nuestra herramienta de gestión de tareas para organizar y priorizar tus actividades.',
            'hay integraciones con herramientas de productividad' => 'Sí, ofrecemos integraciones con herramientas populares como Trello, Asana y Slack.',
            'puedo acceder a los datos desde cualquier lugar' => 'Sí, puedes acceder a tus datos desde cualquier lugar con conexión a internet.',
            'hay un limite de almacenamiento en la cuenta' => 'Sí, el límite de almacenamiento depende del plan que elijas. Consulta nuestra página de precios para más detalles.',
            'como se manejan las actualizaciones del sistema' => 'Las actualizaciones se realizan automáticamente. Te notificaremos cuando se implementen nuevas funcionalidades.',
            'puedo personalizar mis notificaciones' => 'Sí, puedes personalizar tus notificaciones desde la sección de configuración de tu cuenta.',
            'como se manejan los reportes de errores' => 'Los reportes de errores son revisados por nuestro equipo técnico. Puedes enviarlos desde la sección de soporte.',
            'como configuro mis preferencias de comunicacion' => 'Puedes configurar tus preferencias de comunicación en la sección de configuración de tu cuenta.',
            'hay limitaciones en la version gratuita' => 'Sí, la versión gratuita tiene limitaciones en el número de usuarios y funciones disponibles.',
            'como puedo aprender a usar todas las funcionalidades' => 'Te recomendamos revisar nuestros tutoriales y guías disponibles en la sección de ayuda de nuestro sitio web.',
            'como puedo solicitar una demostracion del servicio' => 'Puedes solicitar una demostración llenando el formulario en nuestra página web o contactando a nuestro equipo de ventas.',
            'que tipos de pago aceptan' => 'Aceptamos diversas formas de pago, incluyendo tarjetas de crédito, PayPal y transferencias bancarias.',
            'hay descuentos para estudiantes' => 'Sí, ofrecemos descuentos especiales para estudiantes. Consulta nuestra sección de precios para más información.',
            'como se gestionan las cancelaciones de cuenta' => 'Puedes cancelar tu cuenta en la sección de configuración. Asegúrate de seguir los pasos indicados para evitar cargos adicionales.',
            'ofrecen alguna garantia de satisfaccion' => 'Sí, ofrecemos una garantía de satisfacción de 30 días. Si no estás satisfecho, puedes solicitar un reembolso.',
            'como se pueden enviar comentarios sobre el servicio' => 'Puedes enviar tus comentarios a nuestro equipo de soporte a través del formulario de contacto en nuestro sitio web.',
            'que hago si tengo problemas de acceso a mi cuenta' => 'Si tienes problemas para acceder a tu cuenta, utiliza la opción de recuperación de contraseña o contacta a nuestro soporte.',
            'hay un limite de tiempo para usar el servicio' => 'No hay un límite de tiempo. Puedes usar el servicio mientras esté activo tu plan.',
            'como se gestionan las actualizaciones de seguridad' => 'Realizamos actualizaciones de seguridad regularmente para garantizar la protección de tus datos.',
            'hay soporte para la integración con otras plataformas' => 'Sí, ofrecemos soporte para integrar nuestro servicio con varias plataformas populares.',
            'puedo cambiar mi plan en cualquier momento' => 'Sí, puedes cambiar tu plan en cualquier momento desde la sección de configuración de tu cuenta.',
            'hay recursos de aprendizaje disponibles' => 'Sí, ofrecemos tutoriales, guías y webinars para ayudarte a aprender a utilizar nuestro servicio.',
            'como puedo optimizar el uso del sistema' => 'Te recomendamos leer nuestras guías de optimización y participar en nuestros webinars para obtener consejos útiles.',
            'hay alguna app para dispositivos moviles' => 'Sí, tenemos una aplicación móvil disponible para iOS y Android que puedes descargar desde la tienda de aplicaciones.',
            'que debo hacer si encuentro un error en el sistema' => 'Si encuentras un error, por favor repórtalo a nuestro soporte técnico para que podamos resolverlo lo antes posible.',
            'como se manejan las solicitudes de nuevas funcionalidades' => 'Puedes enviar tus solicitudes de nuevas funcionalidades a nuestro equipo de soporte. Valoramos tus sugerencias.',
            'ofrecen soporte para la migracion de datos' => 'Sí, ofrecemos asistencia para la migración de datos desde otros sistemas. Contáctanos para obtener más información.',
            'hay pruebas gratuitas disponibles' => 'Sí, ofrecemos una prueba gratuita de 14 días para que puedas probar el servicio antes de suscribirte.',
            'como configuro la autenticacion de dos factores' => 'Puedes configurar la autenticación de dos factores en la sección de seguridad de tu cuenta.',
            'que hago si no recibo notificaciones por correo' => 'Verifica la carpeta de spam y asegúrate de que tu dirección de correo esté correcta en la configuración de tu cuenta.',
            'hay limitaciones en las cuentas de prueba' => 'Sí, las cuentas de prueba tienen limitaciones en el acceso a ciertas funcionalidades y recursos.',
            'que hago si quiero eliminar mi cuenta permanentemente' => 'Si deseas eliminar tu cuenta, por favor contacta a nuestro soporte para que podamos asistirte en el proceso.',
            'hay alguna forma de mejorar el rendimiento del sistema' => 'Te recomendamos seguir las mejores prácticas que se encuentran en nuestras guías de optimización y ajustar tus configuraciones según sea necesario.',
            'ofrecen personalizacion de funciones para empresas' => 'Sí, ofrecemos soluciones personalizadas para empresas. Contáctanos para discutir tus necesidades específicas.',
            'hay alguna comunidad en linea para usuarios' => 'Sí, tenemos un foro comunitario donde los usuarios pueden intercambiar consejos y resolver dudas entre sí.',
            'que hago si olvido mi contraseña' => 'Puedes restablecer tu contraseña utilizando la opción de "Olvidé mi contraseña" en la página de inicio de sesión.',
            'como protegen mis datos personales' => 'Implementamos medidas de seguridad robustas y cumplimos con regulaciones de protección de datos para salvaguardar tu información personal.',
            'como se pueden gestionar los permisos de los usuarios' => 'Puedes gestionar los permisos de los usuarios desde la sección de administración de tu cuenta.',
            'como puedo contactarlos fuera del horario laboral' => 'Puedes enviar un correo electrónico a nuestro soporte, y te responderemos durante el siguiente día laborable.',
            'ofrecen asistencia para la configuracion inicial' => 'Sí, ofrecemos asistencia para la configuración inicial cuando te registras en nuestro servicio.',
        ];
        
        // Normalizar la pregunta
        $normalizedQuestion = $this->normalizeText(strtolower(trim($question)));

        // Verificar si la pregunta exacta existe en el diccionario
        if (array_key_exists($normalizedQuestion, $faq)) {
            return [
                'response' => $faq[$normalizedQuestion]
            ];
        }

        // Buscar la palabra más cercana en el diccionario usando Levenshtein
        $closestQuestion = null;
        $shortestDistance = -1;

        foreach (array_keys($faq) as $key) {
            $levDistance = levenshtein($normalizedQuestion, $key);

            // Si esta distancia es más corta que las anteriores, la guardamos
            if ($levDistance == 0) {
                // Coincidencia exacta
                $closestQuestion = $key;
                $shortestDistance = 0;
                break;
            } elseif ($levDistance < $shortestDistance || $shortestDistance == -1) {
                // Encontrar la coincidencia más cercana
                $closestQuestion = $key;
                $shortestDistance = $levDistance;
            }
        }

        // Si encontramos una pregunta cercana, la devolvemos
        if ($closestQuestion && $shortestDistance <= 3) {  // Ajusta el umbral según tu necesidad
            return [
                'response' => $faq[$closestQuestion]
            ];
        }

    
        try {
            $response = $this->client->post($url, [
                'json' => ['user_question' => $question],
                'headers' => ['Content-Type' => 'application/json','Accept-Language' => 'es'],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Request failed: '.$e->getMessage()];
        }

         // Si no se encuentra respuesta en el diccionario ni en la API
         return ['response' => 'Lo siento, no tengo una respuesta para esa pregunta.'];
    }

    /**
     * Enviar archivo PDF a la API de Python.
     */
    public function postDataTextPythonAPI($filePath, $fileName)
    {
        $url = $this->baseUrl.'/text_to_chromadb/';

        try {
            $response = $this->client->post($url, [
                'multipart' => [
                    [
                        'name' => 'pdf',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $fileName,
                    ],
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Request failed: '.$e->getMessage()];
        }
    }

    /**
     * Enviar nombre de archivo a la API de Python.
     */
    public function postDataToPythonAPI($filename)
    {
        $url = $this->baseUrl."/save_name_files/archivos.txt/{$filename}";

        try {
            $response = $this->client->post($url);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Request failed: '.$e->getMessage()];
        }
    }
}
