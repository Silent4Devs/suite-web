@extends('layouts.app')
@section('content')
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj.png') }}">
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection


<div id="login" class="fondo">
    <div class="caja_marca">
        <div class="marca">
            <img src="{{ asset('img/logo_policromatico.png') }}"><br>
            <p class="by">By <strong>Silent</strong>for<strong>Business</strong></p>
            <p class="bienvenidos"><strong>Bienvenidos al</strong> Sistema Integral de Gestión Empresarial</p>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-info" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="caja_form">
        @php
            use App\Models\Organizacion;
            $organizacion = Organizacion::getLogo();
            if (!is_null($organizacion)) {
                $logotipo = $organizacion->logotipo;
            } else {
                $logotipo = 'silent4business.png';
            }
        @endphp

        <form method="POST" action="{{ route('password.request') }}" style="height: 513px">
            @csrf


            <img class="logo_silent rounded-circle" style="width: 100px" src="{{ $logotipo }}" />
            <h3 class="mt-2" style="color: #345183; font-weight: normal; font-size:24px;">Reestablecer Contraseña</h3>
            <p class="text-muted mt-4" style="text-align: left">Introduce tu nueva contraseña, una vez realizada esta
                acción oprime el botón
                "Reestablecer contraseña" y automáticamente quedarás logeado dentro de TABANTAJ</p>
            <input name="token" value="{{ $token }}" type="hidden">

            <div class="form-group">
                <input id="email" type="email" name="email"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email"
                    autofocus placeholder="{{ trans('global.login_email') }}" value="{{ $email ?? old('email') }}"
                    readonly>

                @if ($errors->has('email'))
                    <small class="text-danger">
                        {{ $errors->first('email') }}
                    </small>
                @endif
            </div>
            <div class="form-group" style="position: relative">
                <input id="password" type="password" name="password" class="form-control" required
                    placeholder="{{ trans('global.login_password') }}">
                <span style="position: absolute; top:21px;right: 8px;"><i id="tooglePassword"
                        class="fas fa-eye-slash"></i></span>
                @if ($errors->has('password'))
                    <small class="text-danger">
                        {{ $errors->first('password') }}
                    </small>
                @endif
            </div>
            <div class="form-group" style="position: relative">
                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required
                    placeholder="{{ trans('global.login_password_confirmation') }}">
                <span style="position: absolute; top:21px;right: 8px;"><i id="tooglePasswordConfirmation"
                        class="fas fa-eye-slash"></i></span>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn_enviar" style="background-color: #3c4b64;">
                        {{ trans('global.reset_password') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<style type="text/css">
    #modal_aviso {
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: 10;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.3);
        overflow: auto;
        display: none;
    }

    .contenido_modal {
        width: 90%;
        height: auto;
        padding: 34px;
        max-width: 1000px;
        background-color: #fff;
        border-radius: 6px;
        margin: auto;
        margin-top: 70px;
    }

    .modal_header {
        display: flex;
    }

    .modal_header img {
        height: 70px;
    }

    .modal_header h4 {
        width: 100%;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-body {
        height: auto;
    }

    .modal-body {
        text-align: justify;
    }

    #btn_closed_modal {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 18pt;
        color: #bbb;
        cursor: pointer;
    }

    #btn_closed_modal:hover {
        color: #aaa;
    }

    .modal_body p {
        text-align: justify;
    }
</style>
<div id="modal_aviso">
    <div class="contenido_modal card">
        <i class="fas fa-times" id="btn_closed_modal"></i>
        <div class="modal_header">
            <img src="{{ asset('img/silent4business.png') }}">
            <h4>SILENT4BUSINESS S.A. DE C.V.</h4>
            <img src="{{ asset('img/logo_policromatico.png') }}" style="height: 85px;">
        </div>
        <hr>
        <div class="modal_body">
            <p>AVISO DE PRIVACIDAD</p>

            <p>SILENT4BUSINESS S.A. DE C.V.</p>

            <p>La protección de sus datos personales es muy importante para SILENT4BUSINESS, S.A. DE C.V., (en adelante
                referido como “S4B”) con domicilio en Insurgentes Sur No. 2453, Cuarto Piso, Colonia San Ángel,
                Delegación Álvaro Obregón, C.P. 01109 en la Ciudad de México, y página web www.silent4business.com,
                quien pone a su disposición el presente AVISO DE PRIVACIDAD, el cual tiene como finalidad informarle el
                tipo de datos personales (los “Datos Personales”) que en su caso podríamos recabar de usted, cómo los
                usamos, manejamos y aprovechamos; en cumplimiento a lo establecido en la Ley Federal de Protección de
                Datos Personales en Posesión de Particulares y su reglamento (la “Ley”).</p>

            <p>Nuestros clientes proporcionan Datos Personales a “S4B”, de manera directa, indirecta, personal o a
                través de sus subsidiarias, filiales, afiliadas, controladoras y/o aliadas comerciales, a través de
                oficinas y en las ubicaciones de “S4B”; correo electrónico; teléfono o página web, los cuales podrán
                incluir:</p>

            <p>Datos Personales nombre completo; dirección de correo electrónico; números telefónicos (trabajo y/o
                móvil); identificación oficial, Registro Federal de Contribuyentes (RFC); referencias comerciales y/o
                personales.</p>

            <p>Datos Personales Sensibles Patrimoniales: datos de cuentas bancarias (institución bancaria, número de
                cuenta, CLABE interbancaria y sucursal).</p>

            <p>Para obtener mayor información de Usted, podemos utilizar cookies, web beacons y/o elementos tecnológicos
                similares, para obtener información, como: tipo de navegador y sistema operativo; páginas de internet
                que visita; vínculos que sigue; dirección de IP; sitios que visitó antes de entrar al nuestro;
                reconocimiento de usuarios; detectar información destacada; y medir algunos parámetros de tráfico.</p>

            <p>Estás tecnologías pueden ser deshabilitadas mediante los procedimientos siguiendo las ligas que se
                indican a continuación según el tipo de navegador que utilicen:</p>

            <p> Microsoft Edge: https://privacy.microsoft.com/es-ES/windows-10-microsoft-edge-and-privacy;</p>

            <p> Internet Explorer:
                https://support.microsoft.com/es-mx/help/17442/windows-internet-explorer-delete-manage-cookies;</p>

            <p> MozillaFirefox:http://support.mozilla.org/es/kb/Habilitar%20y%20deshabilitar%20cookies?s=deshabilitar+cookies&r=0&e=es&as=s;
            </p>

            <p> Opera: http://help.opera.com/Windows/11.50/es-ES/cookies.html;</p>

            <p>Safari para IPAD, IPHONE Y IPOD TOUCH: https://support.apple.com/es-es/HT201265;</p>

            <p> Safari para MAC: https://support.apple.com/kb/ph21411?locale=es_MX; y</p>

            <p> Chrome: http://support.google.com/chrome/bin/answer.py?hl=es&answer=95647</p>

            <p>Entendemos que, los datos personales de terceros (tales como referencias personales y/o comerciales) que
                usted nos proporcione, ya cuentan con la autorización de su titular para ser entregados y tratados por
                nosotros conforme al presente aviso de privacidad.</p>

            <p>Los fines primarios aplicables a los Datos Personales (los “Fines Primarios”) serán: identificarlo como
                cliente o proveedor; elaborar documentos, contratos, convenios, facturas, recibos y/o documentación
                vinculada con la relación; recibir y/o procesar pagos; almacenamiento; y dar cumplimiento a términos y
                condiciones que hayamos establecido con usted.</p>

            <p>Los fines secundarios aplicables a los Datos Personales (los “Fines Secundarios”) serán: estadística;
                mercadeo y prospección.</p>

            <p>Los Datos Personales y la confidencialidad de los mismos están protegidos por medidas de seguridad
                administrativas, técnicas y/o físicas, para evitar daño, pérdida, alteración, destrucción, uso, acceso o
                divulgación indebida, por ejemplo los Datos Personales se encuentran en una base de datos interna, cuya
                administración es a través de claves de acceso que cambian en forma periódica y cuyo acceso está
                restringido a personas autorizadas; convenios de confidencialidad con su personal, entre otras.</p>

            <p>Usted tiene derecho al acceso, rectificación y cancelación de sus Datos Personales, a oponerse al
                tratamiento de los mismos o a revocar su consentimiento (en su conjunto “Derecho(s) ARCO”). Para ello,
                es necesario que usted presente una solicitud por escrito del ejercicio del Derecho ARCO dirigida al
                Departamento de Seguridad de la Información “SILENT4BUSINESS”, responsable de la protección de Datos
                Personales, ubicado en el domicilio antes indicado, o bien, se comunique vía correo electrónico a
                privacidad@silent4business.com (“Solicitud”); debiendo recibir en ambos casos acuse de recibo para que
                “S4B” quede vinculado al respecto. Dicha Solicitud deberá contener la siguiente información: nombre
                completo; dirección de correo electrónico para recibir notificaciones; copia simple de la identificación
                oficial con fotografía, descripción clara y precisa de los Datos Personales respecto de los cuales
                busque ejercer algunos de los Derechos ARCO; descripción de cualquier elemento o documento que facilite
                la localización de sus Datos Personales; y firma de la Solicitud..</p>

            <p>En caso de solicitar el ejercicio del derecho de: Rectificación, deberá indicar las modificaciones a
                realizar y proporcionar la documentación que acredite y sustente la petición; y Acceso; “S4B”
                proporcionará los Datos Personales vía correo electrónico y/o mediante cita en oficinas corporativas, a
                elección de “S4B”.</p>

            <p>En un plazo máximo de 20 (veinte) días hábiles contados a partir del acuse de recepción de la Solicitud,
                se deberá atender la petición e informársele sobre la procedencia o improcedencia de la misma mediante
                un aviso enviado al correo electrónico proporcionado para recibir la notificación. En caso de resultar
                procedente su Solicitud, “S4B” deberá hacerla efectiva dentro de los 15 (quince) días hábiles
                siguientes, contados a partir de la recepción vía correo electrónico de la procedencia de su Solicitud.
            </p>

            <p>En adición, al procedimiento para el ejercicio del Derecho ARCO, usted tiene derecho, con relación a los
                Fines Secundarios a: revocar o manifestar su negativa para tratar sus Datos Personales; y/o ser incluido
                en el “Listado de Exclusión” habilitado y propio de “S4B” que nos permite limitar el uso y divulgación
                de Datos Personales. Para ambos efectos basta nos envíe, la solicitud para revocar o ser excluidos, la
                cual deberá contener: nombre (s) y apellidos; y cuenta de correo electrónico para responder su
                solicitud, está deberá ser dirigida al Departamento de Seguridad de “S4B”, responsable de la protección
                de Datos Personales, al siguiente correo electrónico privacidad@silent4business.com debiendo recibir
                acuse de recibo para que “SILENT4BUSINESS” quede vinculado al respecto. El acuse de recibo incluye
                constancia de revocación y/o de inscripción al “Listado de Exclusión”. “S4B” tiene un plazo máximo de 5
                (cinco) días hábiles para dar respuesta.</p>

            <p>Toda la documentación deberá ser enviada en formato de archivo PDF, legible y completa, para que “S4B”
                pueda atender la Solicitud.</p>

            <p>En caso de actuar por medio de representante en cualquiera de las solicitudes señaladas anteriormente,
                deberá acreditar la existencia de la representación, mediante instrumento público o carta poder firmada
                ante dos testigos en su caso, y enviar también copia simple de la identificación oficial de su
                representante.</p>

            <p>Si usted considera que su derecho de protección de Datos Personales ha sido lesionado por “S4B” o presume
                que en el tratamiento de sus Datos Personales existe alguna violación a las disposiciones previstas en
                la Ley, podrá interponer su queja o denuncia correspondiente ante el Instituto Nacional de
                Transparencia, Acceso a la Información y Protección de Datos Personales, INAI (www.inafai.orggob.mx),
                dentro de los 15 (quince) días siguientes a la fecha en que reciba la respuesta de “S4B” o a partir de
                que concluya el plazo de 20 (veinte) días contados a partir de la fecha del acuse de recepción de la
                Solicitud de ejercicio de derechos.</p>

            <p>“S4B” es una empresa dedicada a los servicios de información en el área de investigación técnica y
                científica, practicar toda clase de investigaciones y estudios sobre potencialidad y tendencias de
                mercado, así como prestar servicios de consultoría, en consecuencia, los Datos Personales podrán ser
                transferidos a sociedades subsidiarias, filiales, afiliadas, controladoras y/o aliadas comerciales,
                dentro de territorio nacional, para los mismos fines citados. Asimismo, podrá ser transmitida a las
                personas que a continuación se mencionan: asesores en materia legal, contable y/o fiscal, autoridades
                hacendarias y, cualquier otra que sea necesaria para cumplir los fines para los cuales nos contactó.</p>

            <p>Importante: Cualquier modificación a este AVISO DE PRIVACIDAD se hará de su conocimiento en este mismo
                sitio de Internet: www.silent4business.com ubicado en la parte inferior izquierda de la página principal
                en el apartado de AVISO DE PRIVACIDAD, sin que sea necesario comunicarle dicha modificación al respecto
                a usted en forma individual.</p>

            <p>Fecha de última actualización: 27/02/2018 | Protección de Datos Personales.</p>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    $("#login").click(function() {
        $("#login").removeClass("clase_animacion");
    });

    $('#btn_modal_aviso').click(function() {
        $('#modal_aviso').fadeIn(300);
    });
    $('#btn_closed_modal').click(function() {
        $('#modal_aviso').fadeOut(300);
    });
</script>
<script>
    document.getElementById('tooglePassword').addEventListener('click', function() {
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
        var input = document.getElementById('password');
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    });
    document.getElementById('tooglePasswordConfirmation').addEventListener('click', function() {
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
        var input = document.getElementById('password-confirm');
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    });
</script>
