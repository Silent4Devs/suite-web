<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="supported-color-schemes" content="light dark">

    <title>Requisciones</title>
    <style>
        .content {
            border-top: 30px solid #2567AE;
            border-bottom: 30px solid #2567AE;
            background-color: #f4f4f4;
            width: 550px !important;
            max-width: 550px !important;
            text-align: center;
            font-family: arial;
            color: #707070;
        }

        .caja-info {
            text-align: center;
            font-family: arial;
            color: #707070;
        }

        img {
            height: auto !important;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td align="center">

                <table class="content">
                    <tr>
                        <td>

                            <table class="caja-info">
                                <tr>
                                    <td style="padding: 10px 30px 10px 30px;">
                                        <img class="img-firts" vspace="15" hspace="7" width="100"
                                            height="70" src="{{ $logo }}"
                                            style="margin: auto; margin-top: 30px;"><br><br>
                                        <img class="img-firts" width="150" height="150" src="{{ $img_requi }}"
                                            style="margin: auto; margin-top: 30px;">

                                        <h4 style="color: #0BD140; font-size: 26px;">Delegar Firma (Firma Duplicada)
                                        </h4><br>
                                        <p style="font-size: 16px;">
                                            Se detecto que ya ha firmado la requisición No. {{ $requisicion->id }} con
                                            un rol diferente. <br>

                                            <br><strong>
                                                ¿Desea
                                                delegar la siguiente
                                                firma del proceso?
                                            </strong><br>
                                            <a class="link"
                                                href="{{ route('contract_manager.requisiciones.indexAprobadores') }}"
                                                style="display: block; font-size: 13px;">
                                                “Ingrese aquí”
                                            </a><br>

                                            <br>De lo
                                            contrario dé clic en el siguiente link.
                                            <a class="link"
                                                href="{{ route('contract_manager.requisiciones.firmarAprobadores', ['id' => $requisicion->id]) }}"
                                                style="display: block; font-size: 13px;">
                                                {{ route('contract_manager.requisiciones.firmarAprobadores', ['id' => $requisicion->id]) }}
                                            </a>
                                        </p>
                                        <p style="font-size: 14px; margin-top: 30px;">
                                            <strong>¡Buen día!</strong>
                                        </p>

                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <div class="caja-blue" style="background-color: #2567AE; padding: 25px 0px;">
                                <a href="https://www.facebook.com/silent4business" style="margin: 10px;"><img
                                        src="{{ $img_facebook }}" width="25px"></a>&nbsp;&nbsp;&nbsp;
                                <a href="https://twitter.com/silent4business" style="margin: 10px;"><img
                                        src="{{ $img_twitter }}" width="25px"></a>&nbsp;&nbsp;&nbsp;
                                <a href="https://www.linkedin.com/company/silent4business/mycompany/"
                                    style="margin: 0px 10px;"><img src="{{ $img_linkedin }}" width="25px"></a>
                            </div>
                            <p>
                                SISTEMA DE REQUISICIONES Y ORDENES DE COMPRA
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

</body>

</html>
