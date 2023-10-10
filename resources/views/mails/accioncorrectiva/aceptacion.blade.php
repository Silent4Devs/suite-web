<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }
    </style>

    <style>
        /* Remove space around the email design. */

        html,

        body {

            margin: 0 auto !important;

            padding: 0 !important;

            height: 100% !important;

            width: 100% !important;
        }

        /* Stop Outlook resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
        }


        /* Stop Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* Use a better rendering method when resizing images in Outlook IE. */

        img {
            -ms-interpolation-mode: bicubic;
        }


        /* Prevent Windows 10 Mail from underlining links. Styles for underlined links should be inline. */

        a {

            text-decoration: none;

        }
    </style>
</head>

<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border:.5px solid #153643;border-spacing:0;text-align:left;">
                    {{-- <tr>
                        <td align="center" style="padding:40px 0 30px 0;background:#358765;">
                            <img src="https://image.flaticon.com/icons/png/512/4786/4786029.png" alt="" width="100"
                                style="height:auto;display:block; margin-bottom: 10px;" />
                            <h3 class="p-0 m-0"
                                style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif; color:white">
                                Sistema de Gestión Normativa - Tabantaj</h3>
                        </td>
                    </tr> --}}

                    <tr>

                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <hr style="margin:0;width: 100%; height: 1.5px; background-color: #153643;">
                                    &nbsp;
                                    </hr>
                                    @php
                                        use App\Models\Organizacion;
                                        $organizacion = Organizacion::getFirst();
                                        $logotipo = $organizacion->logotipo;
                                        $empresa = $organizacion->empresa;
                                    @endphp
                                    <h2 style="padding-top:3px; color:#153643; text-align:center">
                                        {{ $empresa }}</h2>
                                    <hr style="margin:0;width: 100%; height:1.5px; background-color: #153643;">
                                    &nbsp;
                                    </hr>

                                    <td style="padding:0 0 36px 0;">

                                        <div class="caja_img_logo" style="margin-top:30px; text-align:center">
                                            <img width="160" src="{{ asset($logotipo) }}" class="mt-2 ml-4"
                                                style="width:160px;">
                                        </div>

                                        <div style="margin-top:50px;">
                                            <strong
                                                style="color:#153643; padding-top:40px; margin:0 0 14px 0;font-size:17px;line-height:24px;font-family:Arial,sans-serif;">
                                                Estimado(a) {{ $quejas->responsableSgi->name }},
                                            </strong>
                                        </div>

                                        <div style="width: 100%; margin-top: 10px;">
                                            <p style="font-size:11pt; color:#153643;">
                                                Le informamos que derivado de la queja recibida de un cliente (Ticket
                                                {{ $quejas->folio }} ), {{ $quejas->registro->name }} solicita que se
                                                genere una Acción Correctiva.


                                            </p>

                                            {{-- Si hay evidencia que la carga al correo diría Se adjunta evidencia en el correo --}}

                                            <br>
                                            <br>
                                            <strong
                                                style="color:#345183;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
                                                Datos generales</strong>
                                            <ul style="font-size:11pt; color:#153643;">
                                                <li style="font-size:11pt;">Ticket ID: <strong style="font-size:10pt;">
                                                        {{ $quejas->folio }} </strong></li>
                                                <li style="font-size:11pt;">Fecha y hora del registro del
                                                    reporte:<strong style="font-size:10pt;">
                                                        {{ \Carbon\Carbon::parse($quejas->created_at)->format('d-m-Y H:i:s') }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Prioridad:<strong style="font-size:10pt;">
                                                        {{ $quejas->prioridad ? $quejas->prioridad : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Categoría: <strong style="font-size:10pt;">
                                                        {{ $quejas->categoria_queja ? $quejas->categoria_queja : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Cliente: <strong
                                                        style="font-size:10pt;">{{ $quejas->cliente->nombre }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Proyecto: <strong
                                                        style="font-size:10pt;">{{ $quejas->proyectos->proyecto }}</strong>
                                                </li>

                                            </ul>

                                            <p>
                                                <strong
                                                    style="color:#345183;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
                                                    Responsable de la atención de la queja</strong>
                                            <ul style="font-size:11pt; color:#153643;">
                                                <li style="font-size:11pt;">Nombre: <strong style="font-size:10pt;">
                                                        {{ $quejas->responsableAtencion ? $quejas->responsableAtencion->name : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Puesto: <strong style="font-size:10pt;">
                                                        {{ $quejas->responsableAtencion ? $quejas->responsableAtencion->area->area : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Área: <strong style="font-size:10pt;">
                                                        {{ $quejas->responsableAtencion ? $quejas->responsableAtencion->puesto : 'Sin definir' }}</strong>
                                                </li>
                                            </ul>
                                            </p>
                                            <p>
                                                <strong
                                                    style="color:#345183;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
                                                    Reportó</strong>
                                            <ul style="font-size:11pt; color:#153643;">
                                                <li style="font-size:11pt;">Nombre del contacto:<strong
                                                        style="font-size:10pt;"> {{ $quejas->nombre }} </strong></li>
                                                <li style="font-size:11pt;">Puesto:<strong style="font-size:10pt;">
                                                        {{ $quejas->puesto }} </strong></li>
                                                <li style="font-size:11pt;">Teléfono:<strong style="font-size:10pt;">
                                                        {{ $quejas->telefono }} </strong></li>
                                                <li style="font-size:11pt;">Correo:<strong style="font-size:10pt;">
                                                        {{ $quejas->correo }} </strong></li>
                                            </ul>
                                            </p>

                                            <strong
                                                style="color:#345183;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
                                                Queja del cliente dirigida a</strong>
                                            <p>
                                            <ul style="font-size:11pt; color:#153643;">
                                                <li style="font-size:11pt;">Área(s):<strong style="font-size:10pt;">
                                                        {{ $quejas->area_quejado ? $quejas->area_quejado : 'Sin definir' }}
                                                    </strong></li>
                                                <li style="font-size:11pt;">Colaborador(es):<strong
                                                        style="font-size:10pt;">
                                                        {{ $quejas->colaborador_quejado ? $quejas->colaborador_quejado : 'Sin definir' }}
                                                    </strong></li>
                                                <li style="font-size:11pt;">Proceso(s): <strong style="font-size:10pt;">
                                                        {{ $quejas->proceso_quejado ? $quejas->proceso_quejado : 'Sin definir' }}
                                                    </strong></li>
                                                <li style="font-size:11pt;">Otro(s):<strong style="font-size:10pt;">
                                                        {{ $quejas->otro_categoria ? $quejas->otro_categoria : 'Sin definir' }}
                                                    </strong></li>
                                            </ul>
                                            </p>

                                            <strong
                                                style="color:#345183;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
                                                Descripción de la queja</strong>
                                            <p>
                                            <ul style="font-size:11pt; color:#153643;">
                                                <li style="font-size:11pt;">Título:<strong style="font-size:10pt;">
                                                        {{ $quejas->titulo }} </strong></li>
                                                <li style="font-size:11pt;">Fecha y hora de ocurrencia: <strong
                                                        style="font-size:10pt;">{{ \Carbon\Carbon::parse($quejas->fecha)->format('d-m-Y H:i:s') }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Ubicación: <strong style="font-size:10pt;">
                                                        {{ $quejas->ubicacion ? $quejas->ubicacion : 'Sin definir' }}
                                                    </strong></li>
                                                <li style="font-size:11pt;">Canal de recepción:<strong
                                                        style="font-size:10pt;"> {{ $quejas->canal }} </strong></li>
                                                <li style="font-size:11pt;">Descripción:<strong style="font-size:10pt;">
                                                        {{ $quejas->descripcion }} </strong></li>
                                                <li style="font-size:11pt;">Solución que requiere el cliente:<strong
                                                        style="font-size:10pt;">
                                                        {{ $quejas->solucion_requerida_cliente }} </strong></li>
                                            </ul>
                                            </p>

                                            <strong
                                                style="color:#345183;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
                                                Registró</strong>


                                            <ul style="font-size:11pt; color:#153643;">
                                                <li style="font-size:11pt;">Nombre: <strong style="font-size:10pt;">
                                                        {{ $quejas->registro ? $quejas->registro->name : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Puesto: <strong style="font-size:10pt;">
                                                        {{ $quejas->registro ? $quejas->registro->puesto : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Área: <strong style="font-size:10pt;">
                                                        {{ $quejas->registro ? $quejas->registro->area->area : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Correo electrónico:<strong
                                                        style="font-size:10pt;">
                                                        {{ $quejas->registro ? $quejas->registro->email : 'Sin definir' }}</strong>
                                                </li>
                                                <li style="font-size:11pt;">Comentarios: <strong
                                                        style="font-size:10pt;">
                                                        {{ $quejas->comentarios ? $quejas->comentarios : 'Sin definir' }}</strong>
                                                </li>
                                            </ul>


                                            <p style="font-size:11pt; color:#153643;">
                                                Para aprobar o rechazar la Acción Correctiva dé clic en el siguiente
                                                botón:
                                            </p>

                                            <div style="text-align:center; margin-top:20px">
                                                <a href="{{ route('admin.accion-correctivas.index', $quejas) }}"
                                                    style="text-decoration:none;padding-top:15px; border-radius:4px; display:inline-block; min-width:300px; height:35px ;color:#fff; font-size:11pt; background-color:#345183">
                                                    Revisar Acción Correctiva
                                                </a>
                                            </div>

                                            {{-- <strong
                                                style="color:#1536A43;;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
                                                Información de la queja
                                            </strong> --}}

                                            {{-- <ul style="font-size:11pt; color:#153643;">
                                                <li style="font-size:11pt;">Ticket ID:<strong> {{$quejas->folio}}</strong></li>
                                                <li style="font-size:11pt;">Fecha y hora de registro del
                                                    reporte:<strong>  {{ \Carbon\Carbon::parse($quejas->fecha)->format('d-m-Y H:i:s') }}</strong></li>
                                                <li style="font-size:11pt;">Título:<strong> {{$quejas->titulo}}</strong></li>
                                                <li style="font-size:11pt;">Descripción:<strong> {{$quejas->descripcion}}</strong></li>
                                            </ul> --}}
                                            </p>
                                            {{-- <p style="font-size:11pt; color:#153643;">Lo mantendremos informado
                                                sobre el estatus de su queja vía correo electrónico.
                                            </p> --}}




                                        </div>


                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px;background:#fff;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:30;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:30%;" align="left">
                                        <p style="text-align:center; font-size:10pt; color:#153643;">Por favor no
                                            responda a este correo</p>
                                        <hr style="margin:0; width: 100%; height: 1.5px; background-color: #153643;">
                                        &nbsp;
                                        </hr>

                                        <p style="text-align:center;font-size:10pt;font-weight: normal;color:#153643;">
                                            SISTEMA INTEGRAL DE GESTIÓN EMPRESARIAL TABANTAJ</p>
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
