<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div id="barraGap2" class="barraGap2">
                    <h6 align="center">GAP 02: IMPLEMENTACIÓN DEL PLAN DE SEGURIDAD Y PRIVACIDAD DE LA INFORMACIÓN ({{number_format($porcentajeGap2['Avance'], 2, '.', '')}}%)
                    </h6>
                    <div class="progress">
                        <div
                            class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"
                            style="width: {{number_format($porcentajeGap2['Porcentaje'], 2, '.', '')}}%">{{number_format($porcentajeGap2['Avance'], 2, '.', '')}}%
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p>Implementacion del Plan de Seguridad y Privacidad. Tiene un peso del 40% del total del
                            componente: 20% - Identificacion y analisis de riesgos, 20% - Plan de tratamiento de
                            riesgos, clasificacion y gestion de controles.
                        </p>
                        <p><strong>INSTRUCCIONES: </strong>Por favor, conteste
                            el
                            siguiente cuestionario de acuerdo con los siguientes
                            parámetros:</p>
                        <div class="row">
                            <div class="p-3 mb-2 text-white col-3 bg-success">
                                Cumple
                                satisfactoriamente
                            </div>
                            <div class="col-9">Existe, es gestionado, se está
                                cumpliendo con lo
                                que la norma ISO 27001 solicita, está
                                documentado, es conocido y
                                aplicado por todos los involucrados en el SGSI.
                                cumple 100%.
                            </div>
                            <div class="w-100"></div>
                            <div class="p-3 mb-2 text-white col-3 bg-warning">
                                Cumple
                                parcialmente
                            </div>
                            <div class="col-9">Lo que la norma requiere
                                (ISO27001 versión 2013)
                                se está haciendo de manera parcial, se está
                                haciendo diferente,
                                no está documentado, se definió y aprobó pero no
                                se gestiona
                            </div>
                            <div class="w-100"></div>
                            <div class="p-3 mb-2 text-white col-3 bg-danger">No
                                cumple
                            </div>
                            <div class="col-9">No existe y/o no se está
                                haciendo.
                            </div>
                            <div class="p-3 mb-2 text-white col-3 bg-dark">
                                No aplica
                            </div>
                            <div class="col-9">
                                El control no es aplicable para la entidad. En el campo evidencia por favor indicar la
                                justificación respectiva de su no aplicabilidad.
                            </div>
                            <h5 class="p-3 mx-auto mb-2 bg-white text-dark">
                                HACER</h5>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">POLÍTICAS DE LA
                                    SEGURIDAD DE LA INFORMACION</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Orientación de la
                                    dirección para la gestión de la seguridad de la información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px; margin: 0px;">OBJETIVO:
                                    Brindar orientación y soporte, por parte de la dirección, para la seguridad de la
                                    información de acuerdo con los requisitos del negocio y con las leyes y reglamentos
                                    pertinentes</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO</th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda5s as $g5s)
                                        <tr>
                                            <th scope="row">
                                                {{$g5s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g5s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g5s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g5s->id}}"
                                                   data-url="{{route("admin.gap-dos.update",  $g5s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g5s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g5s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g5s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g5s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g5s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g5s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g5s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">ORGANIZACIÓN DE LA
                                    SEGURIDAD DE LA INFORMACION</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Organización Interna</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px; margin: 0px;">OBJETIVO:
                                    Establecer un marco de referencia de gestión para iniciar y controlar la
                                    implementación y operación de la seguridad de la información dentro de la
                                    organización.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda6s as $g6s)
                                        <tr>
                                            <th scope="row">
                                                {{$g6s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g6s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g6s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g6s->id}}"
                                                   data-url="{{route("admin.gap-dos.update",  $g6s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g6s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g6s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g6s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g6s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g6s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g6s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g6s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Dispositivos móviles y
                                    teletrabajo</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Garantizar la
                                    seguridad del teletrabajo y el uso de dispositivos móviles</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda62s as $g62s)
                                        <tr>
                                            <th scope="row">
                                                {{$g62s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g62s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g62s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g62s->id}}"
                                                   data-url="{{route("admin.gap-dos.update",  $g62s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g62s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g62s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g62s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g62s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g62s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g62s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g62s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Dispositivos móviles y
                                    teletrabajo</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Garantizar la
                                    seguridad del teletrabajo y el uso de dispositivos móviles</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda71s as $g71s)
                                        <tr>
                                            <th scope="row">
                                                {{$g71s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g71s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g71s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g71s->id}}"
                                                   data-url="{{route("admin.gap-dos.update",  $g71s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g71s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g71s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g71s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g71s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g71s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g71s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g71s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Dispositivos móviles y
                                    teletrabajo</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Garantizar la
                                    seguridad del teletrabajo y el uso de dispositivos móviles</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda71s as $g71s)
                                        <tr>
                                            <th scope="row">
                                                {{$g71s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g71s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g71s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g71s->id}}"
                                                   data-url="{{route("admin.gap-dos.update",  $g71s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g71s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g71s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g71s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g71s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g71s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g71s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g71s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Durante la ejecución del
                                    empleo</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurarse de
                                    que los empleados y contratistas tomen conciencia de sus responsabilidades de
                                    seguridad de la información y las cumplan.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda72s as $g72s)
                                        <tr>
                                            <th scope="row">
                                                {{$g72s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g72s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g72s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g72s->id}}"
                                                   data-url="{{route("admin.gap-dos.update",  $g72s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g72s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g72s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g72s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g72s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g72s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g72s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g72s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Terminación y cambio de
                                    empleo</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Proteger los
                                    intereses de la organización como parte del proceso de cambio o terminación de
                                    empleo</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda73s as $g73s)
                                        <tr>
                                            <th scope="row">
                                                {{$g73s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g73s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g73s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g73s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g73s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g73s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g73s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g73s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g73s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g73s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g73s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g73s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">GESTION DE ACTIVOS</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Responsabilidad por los
                                    activos</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Identificar
                                    los activos organizacionales y definir las responsabilidades de protección
                                    adecuadas.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda81s as $g81s)
                                        <tr>
                                            <th scope="row">
                                                {{$g81s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g81s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g81s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g81s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g81s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g81s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g81s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g81s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g81s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g81s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g81s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g81s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Clasificación de la
                                    información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar que
                                    la información recibe un nivel apropiado de protección, de acuerdo con su
                                    importancia para la organización.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda82s as $g82s)
                                        <tr>
                                            <th scope="row">
                                                {{$g82s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g82s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g82s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g82s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g82s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g82s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g82s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g82s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g82s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g82s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g82s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g82s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Manejo de medios</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Evitar la
                                    divulgación, la modificación, el retiro o la destrucción no autorizados de
                                    información almacenada en los medios</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda83s as $g83s)
                                        <tr>
                                            <th scope="row">
                                                {{$g83s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g83s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g83s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g83s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g83s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g83s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g83s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g83s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g83s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g83s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g83s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g83s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">CONTROL DE ACCESO</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Requisitos del negocio
                                    para el control de acceso</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Limitar el
                                    acceso a información y a instalaciones de procesamiento de información.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda91s as $g91s)
                                        <tr>
                                            <th scope="row">
                                                {{$g91s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g91s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g91s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g91s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g91s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g91s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g91s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g91s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g91s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g91s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g91s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g91s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Gestión de acceso de
                                    usuarios</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar el
                                    acceso de los usuarios autorizados y evitar el acceso no autorizado a sistemas y
                                    servicios.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda92s as $g92s)
                                        <tr>
                                            <th scope="row">
                                                {{$g92s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g92s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g92s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g92s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g92s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g92s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g92s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g92s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g92s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g92s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g92s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g92s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Responsabilidades de los
                                    usuarios</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Hacer que los
                                    usuarios rindan cuentas por la salvaguarda de su información de autenticación.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda93s as $g93s)
                                        <tr>
                                            <th scope="row">
                                                {{$g93s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g93s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g93s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g93s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g93s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g93s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g93s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g93s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g93s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g93s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g93s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g93s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Responsabilidades de los
                                    usuarios</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Hacer que los
                                    usuarios rindan cuentas por la salvaguarda de su información de autenticación.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda93s as $g93s)
                                        <tr>
                                            <th scope="row">
                                                {{$g93s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g93s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g93s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g93s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g93s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g93s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g93s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g93s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g93s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g93s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g93s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g93s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Control de acceso a
                                    sistemas y aplicaciones</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Evitar el
                                    acceso no autorizado a sistemas y aplicaciones.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda94s as $g94s)
                                        <tr>
                                            <th scope="row">
                                                {{$g94s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g94s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g94s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g94s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g94s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g94s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g94s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g94s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g94s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g94s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g94s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g94s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">CRIPTOGRAFIA</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Controles
                                    criptográficos</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar el
                                    uso apropiado y eficaz de la criptografía para proteger la confidencialidad,
                                    autenticidad y/o la integridad de la información.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda101s as $g101s)
                                        <tr>
                                            <th scope="row">
                                                {{$g101s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g101s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g101s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g101s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g101s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g101s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g101s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g101s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g101s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g101s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g101s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g101s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">SEGURIDAD FISICA Y DEL
                                    ENTORNO</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Áreas seguras</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Prevenir el
                                    acceso físico no autorizado, el daño e la interferencia a la información y a las
                                    instalaciones de procesamiento de información de la organización.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda111s as $g111s)
                                        <tr>
                                            <th scope="row">
                                                {{$g111s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g111s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g111s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g111s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g111s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g111s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g111s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g111s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g111s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g111s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g111s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g111s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Equipos</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Prevenir la
                                    perdida, daño, robo o compromiso de activos, y la interrupción de las operaciones de
                                    la organización.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda112s as $g112s)
                                        <tr>
                                            <th scope="row">
                                                {{$g112s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g112s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g112s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g112s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g112s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g112s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g112s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g112s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g112s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g112s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g112s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g112s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">SEGURIDAD DE LAS
                                    OPERACIONES</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Procedimientos
                                    operacionales y responsabilidades</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar las
                                    operaciones correctas y seguras de las instalaciones de procesamiento de
                                    información.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda121s as $g121s)
                                        <tr>
                                            <th scope="row">
                                                {{$g121s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g121s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g121s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g121s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g121s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g121s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g121s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g121s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g121s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g121s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g121s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g121s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Protección contra
                                    códigos maliciosos</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurarse de
                                    que la información y las instalaciones de procesamiento de información estén
                                    protegidas contra códigos maliciosos.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda122s as $g122s)
                                        <tr>
                                            <th scope="row">
                                                {{$g122s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g122s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g122s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g122s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g122s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g122s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g122s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g122s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g122s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g122s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g122s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g122s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Copias de respaldo</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurarse de
                                    que la información y las instalaciones de procesamiento de información estén
                                    protegidas contra códigos maliciosos.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda123s as $g123s)
                                        <tr>
                                            <th scope="row">
                                                {{$g123s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g123s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g123s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g123s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g123s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g123s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g123s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g123s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g123s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g123s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g123s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g123s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Registro y
                                    seguimiento</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Registrar
                                    eventos y generar evidencia</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda124s as $g124s)
                                        <tr>
                                            <th scope="row">
                                                {{$g124s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g124s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g124s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g124s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g124s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g124s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g124s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g124s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g124s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g124s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g124s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g124s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Control de software
                                    operacional</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurarse de
                                    la integridad de los sistemas operacionales</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda125s as $g125s)
                                        <tr>
                                            <th scope="row">
                                                {{$g125s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g125s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g125s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g125s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g125s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g125s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g125s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g125s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g125s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g125s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g125s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g125s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Gestión de la
                                    vulnerabilidad técnica</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Prevenir el
                                    aprovechamiento de las vulnerabilidades técnicas</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda126s as $g126s)
                                        <tr>
                                            <th scope="row">
                                                {{$g126s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g126s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g126s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g126s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g126s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g126s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g126s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g126s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g126s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g126s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g126s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g126s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Consideraciones sobre
                                    auditorias de sistemas de información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Minimizar el
                                    impacto de las actividades de auditoria sobre los sistemas operativos</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda127s as $g127s)
                                        <tr>
                                            <th scope="row">
                                                {{$g127s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g127s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g127s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g127s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g127s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g127s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g127s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g127s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g127s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g127s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g127s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g127s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">SEGURIDAD DE LAS
                                    COMUNICACIONES</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Gestión de la seguridad
                                    de las redes</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar la
                                    protección de la información en las redes, y sus instalaciones de procesamiento de
                                    información de soporte.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda131s as $g131s)
                                        <tr>
                                            <th scope="row">
                                                {{$g131s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g131s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g131s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g131s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g131s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g131s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g131s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g131s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g131s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g131s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g131s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g131s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Transferencia de
                                    información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Mantener la
                                    seguridad de la información transferida dentro de una organización y con cualquier
                                    entidad externa.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda132s as $g132s)
                                        <tr>
                                            <th scope="row">
                                                {{$g132s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g132s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g132s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g132s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g132s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g132s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g132s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g132s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g132s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g132s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g132s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g132s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">ADQUISICIÓN, DESARROLLO
                                    Y MANTENIMIENTO DE SISTEMAS</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Requisitos de seguridad
                                    de los sistemas de información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar que
                                    la seguridad de la información sea una parte integral de los sistemas de información
                                    durante todo el ciclo de vida. Esto incluye también los requisitos para sistemas de
                                    información que prestan servicios sobre redes .</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda141s as $g141s)
                                        <tr>
                                            <th scope="row">
                                                {{$g141s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g141s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g141s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g141s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g141s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g141s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g141s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g141s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g141s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g141s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g141s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g141s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Seguridad en los
                                    procesos de Desarrollo y de Soporte</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar que
                                    la seguridad de la información este diseñada e implementada dentro del ciclo de vida
                                    de desarrollo de los sistemas de información.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda142s as $g142s)
                                        <tr>
                                            <th scope="row">
                                                {{$g142s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g142s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g142s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g142s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g142s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g142s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g142s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g142s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g142s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g142s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g142s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g142s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Datos de prueba</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar la
                                    protección de los datos usados para pruebas. </p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda143s as $g143s)
                                        <tr>
                                            <th scope="row">
                                                {{$g143s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g143s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g143s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g143s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g143s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g143s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g143s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g143s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g143s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g143s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g143s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g143s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">RELACIONES CON LOS
                                    PROVEEDORES</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Seguridad de la
                                    información en las relaciones con los proveedores.</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar la
                                    protección de los activos de la organización que sean accesibles a los
                                    proveedores.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda151s as $g151s)
                                        <tr>
                                            <th scope="row">
                                                {{$g151s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g151s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g151s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g151s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g151s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g151s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g151s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g151s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g151s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g151s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g151s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g151s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Gestión de la prestación
                                    de servicios de proveedores</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Mantener el
                                    nivel acordado de seguridad de la información y de prestación del servicio en línea
                                    con los acuerdos con los proveedores</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda152s as $g152s)
                                        <tr>
                                            <th scope="row">
                                                {{$g152s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g152s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g152s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g152s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g152s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g152s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g152s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g152s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g152s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g152s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g152s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g152s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">GESTION DE INCIDENTES DE
                                    SEGURIDAD DE LA INFORMACION</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Gestión de incidentes y
                                    mejoras en la seguridad de la información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar un
                                    enfoque coherente y eficaz para la gestión de incidentes de seguridad de la
                                    información, incluida la comunicación sobre eventos de seguridad y debilidades.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda161s as $g161s)
                                        <tr>
                                            <th scope="row">
                                                {{$g161s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g161s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g161s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g161s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g161s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g161s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g161s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g161s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g161s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g161s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g161s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g161s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">ASPECTOS DE SEGURIDAD DE
                                    LA INFORMACIÓN DE LA GESTION DE CONTINUIDAD DE NEGOCIO</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Continuidad de Seguridad
                                    de la información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: La continuidad
                                    de seguridad de la información se debe incluir en los sistemas de gestión de la
                                    continuidad de negocio de la organización.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda171s as $g171s)
                                        <tr>
                                            <th scope="row">
                                                {{$g171s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g171s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g171s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g171s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g171s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g171s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g171s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g171s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g171s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g171s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g171s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g171s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Redundancias</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar la
                                    disponibilidad de instalaciones de procesamiento de información.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda172s as $g172s)
                                        <tr>
                                            <th scope="row">
                                                {{$g172s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g172s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g172s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g172s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g172s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g172s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g172s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g172s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g172s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g172s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g172s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g172s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">CUMPLIMIENTO</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Cumplimiento de
                                    requisitos legales y contractuales</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Evitar el
                                    incumplimiento de las obligaciones legales, estatutarias, de reglamentación o
                                    contractuales relacionadas con seguridad de la información y de cualquier requisito
                                    de seguridad.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda181s as $g181s)
                                        <tr>
                                            <th scope="row">
                                                {{$g181s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g181s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g181s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g181s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g181s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g181s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g181s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g181s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g181s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g181s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g181s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g181s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">Revisiones de seguridad
                                    de la información</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Asegurar que
                                    la seguridad de la información se implemente y opere de acuerdo con las políticas y
                                    procedimientos organizacionales.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapda182s as $g182s)
                                        <tr>
                                            <th scope="row">
                                                {{$g182s->anexo_indice}}
                                            </th>
                                            <td>
                                                {{$g182s->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g182s->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g182s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g182s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g182s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g182s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g182s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g182s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g182s->id}}"
                                                   data-url="{{route("admin.gap-dos.update", $g182s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g182s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
