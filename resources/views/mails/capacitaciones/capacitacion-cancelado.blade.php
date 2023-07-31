<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body
    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
        <tr>
            <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                    <tr>
                        <td class="header"
                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center;">
                            <a href="https://markdownmail.com"
                                style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 #ffffff; display: inline-block;">
                                @php
                                    use App\Models\Organizacion;
                                    $organizacion = Organizacion::getFirst();
                                    if (!is_null($organizacion)) {
                                        $logotipo = $organizacion->logotipo;
                                    } else {
                                        $logotipo = 'logotipo-tabantaj.png';
                                    }
                                @endphp
                                <img src="{{ asset($logotipo) }}" class="logo" alt="Laravel Logo"
                                    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; max-width: 500px; border: none;"></a>
                        </td>
                    </tr>
                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"
                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation"
                                style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell"
                                        style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                                        <h1
                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
                                            {!! $empleado->saludo_completo !!}</h1>
                                        <p
                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                            Por medio del presente correo, se le notifica que la capacitación
                                            {{ $recurso->cursoscapacitaciones }} ha sido cancelada</p>
                                        <p
                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                            Gracias,<br>
                                            {{ $organizacion->empresa }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
