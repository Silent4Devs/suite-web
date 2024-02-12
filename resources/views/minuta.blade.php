<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minuta</title>
</head>
<body>
    <div class="card col-sm-12 col-md-10" style="border-radius: 0px; box-shadow: none; border-color:white; width:750px;">
        <div class="card-body">
            <div class="card mt-6" style="width:750px; display: flex; align-items: center;">
                <div class="col-3" style="border-left: 25px solid #2395AA;">
                    @php
                    use App\Models\Organizacion;
                    $organizacion = Organizacion::getFirst();
                    $logotipo = $organizacion->logotipo;
                    $empresa = $organizacion->empresa;
                    @endphp
                    @if ($logotipo)
                     <img style="width: 100%; max-width: 100px; height: auto;" src="{{ asset($logotipo) }}">
                    @else
                        <img src="{{ asset('sinLogo.png') }}"  style="width:100%; max-width:150px;">
                    @endif
                </div>
                <div class="col-4"  style="position: relative; top: -4rem; left: 9rem;">
                    <span class="" style="color:black; font-size: 11px;">
                        {{ $empresa_actual }} <br>
                        RFC: {{ $rfc }} <br>
                        Av. Insurgentes Sur 2453 piso 4, <br> Colonia Tizapán San Ángel, <br> Álvaro Obregón, C.P. 01090, CDMX. <br>
                    </span>
                </div>
                <div class="col-4" style="background:#EEFCFF; width: 100%; height: 8%; position: relative; left: 23rem; top: -9rem;">
                    <br>
                    <br>
                    <span style="color:#057BE2;"> <strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Minuta Revisión por Dirección</strong></span>
                </div>
            </div>
            <div style="margin: 4%" style="position: relative; top: -7rem; right: 1rem;">
                <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd; font-size: 10px;">
                    <thead>
                        <tr>
                            <th style="background-color: #306BA9; padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;" colspan="6"><center>Minuta reunión</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #dddddd;">Fecha:</td>
                            <td style="border: 1px solid #dddddd;">{{$minutas->fechareunion}}</td>
                            <td style="border: 1px solid #dddddd;">Hora Inicio</td>
                            <td style="border: 1px solid #dddddd;">{{$minutas->hora_inicio}}</td>
                            <td style="border: 1px solid #dddddd;">Hora fin</td>
                            <td style="border: 1px solid #dddddd;">{{$minutas->hora_termino}}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #dddddd;">Tema:</td>
                            <td style="border: 1px solid #dddddd;">{{$minutas->tema_reunion}}</td>
                            <td style="border: 1px solid #dddddd;">Objetivo:</td>
                            <td style="border: 1px solid #dddddd;" colspan="3">{{$minutas->objetivoreunion}}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd; font-size: 10px;">
                    <thead>
                        <tr>
                            <th style="background-color: #306BA9; padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;" colspan="4"><center>Participantes</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #dddddd;">Nombre/Apellidos</td>
                            <td style="border: 1px solid #dddddd;">Puesto/Area</td>
                            <td style="border: 1px solid #dddddd;">Asistencia</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #dddddd;">{{$responsable->name}}</td>
                            <td style="border: 1px solid #dddddd;">{{$responsable->puesto}}</td>
                            <td style="border: 1px solid #dddddd;">si</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd; font-size: 10px;">
                    <thead>
                        <tr>
                            <th style="background-color: #306BA9; padding: 8px; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;" colspan="2"><center style="color: white;">Temas tratados</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #dddddd; padding: 26px;" colspan="2">
                                <textarea style="width: 100%; height: 26rem; border: none; outline: none; resize: none; background-color: transparent;"> {!! strip_tags($minutas->tema_tratado) !!}</textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd; font-size: 10px;">
                    <thead>
                        <tr>
                            <th style="background-color: #306BA9; color: #EEFCFF; border-top-left-radius: 10px; border-top-right-radius: 10px;" colspan="5"><center>Acuerdos y Compromisos</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #dddddd;">Actividades</td>
                            <td style="border: 1px solid #dddddd;">Responsable</td>
                            <td style="border: 1px solid #dddddd;">Fecha compromiso</td>
                            <td style="border: 1px solid #dddddd;">Estatus</td>
                            <td style="border: 1px solid #dddddd;">Comentarios</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #dddddd;">.</td>
                            <td style="border: 1px solid #dddddd;">{{$responsable->name}}</td>
                            <td style="border: 1px solid #dddddd;">{{$minutas->fechareunion}}</td>
                            <td style="border: 1px solid #dddddd;">{{$revision->estatus}}</td>
                            <td style="border: 1px solid #dddddd;">{{$revision->cometarios}}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd; font-size: 6px;">
                    <thead>
                        <tr>
                            <th style="background-color: white; padding: 8px; color: black;  border-top-right-radius: 10px;" colspan="6"><center>Anexo</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #dddddd;"  colspan="2">Se adjunta la respuesta que Habiza dio en la reunión que tuvo con los representantes y que motivó se convocara a la reunión de hoy 10/03/2021, ya que mencionaron que para el mes de abril de este año ya no serán ellos los que administren el clúster. 1.- BARDA COLINDANTE: La barda colindante que comprende el tren número 2 que corresponde de la casa 9 a la 24, no se va a hacer porque los cimientos que se hicieron para la misma no soportan más peso inclusive ni siquiera 20 centímetros de malla ya que los vientos la derribarían 2.- PLANOS DE CONSTRUCIÓN Los planos nos los entregarían la próxima semana, pero solo van a ser los planos de cada prototipo pues las casas están hechas en serie y todos tienen las mismas características en cuanto al tema eléctrico e hidráulico, se va a entregar por correo y físico solo uno. 3.- GASTOS DE ADMINISTRACIÓN El informe nos lo entregan a más tardar el día 29 de marzo de 2021, y ellos se comprometen a compartir proveedores de insumos, vigilancia y jardineros. Por este punto se sugiere ir planeando u organizando la administración, no hay prorroga. 4.- CISTERNA DE RIEGO Nos comentan que la cisterna ya está para su funcionamiento y que a nosotros nos corresponde hacer el contrato de toma de agua para áreas verdes y alberca, inclusive nos entregaron la solicitud y esta tendrá un costo de $7,041.11. 5.-CANAL PLUVIAL</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>






</body>
</html>
