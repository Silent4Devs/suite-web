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
                                (ISO27001 versión 2022)
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
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">
                                5. CONTROLES ORGANIZACIONALES</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px; margin: 0px;">OBJETIVO:
                                    Brindar orientación y soporte, por parte de la dirección, para la seguridad de la
                                    información de acuerdo con los requisitos del negocio y con las leyes y reglamentos
                                    pertinentes</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th scope="col">CLASIFICACIÓN</th>
                                        <th scope="col">ANEXO INDICE</th>
                                        <th scope="col">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO</th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapa5 as $g5s)
                                        <tr>
                                            <td>
                                                {{$g5s->gap_dos_catalogo->control_iso}}
                                            </td>
                                            <td>
                                                {{$g5s->gap_dos_catalogo->clasificacion->nombre}}
                                            </td>
                                            <td>
                                                {{$g5s->gap_dos_catalogo->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g5s->gap_dos_catalogo->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g5s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update",  $g5s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g5s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g5s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g5s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g5s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g5s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g5s->id)}}"
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
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">
                                6. CONTROLES PERSONALES</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px; margin: 0px;">OBJETIVO:
                                    Establecer un marco de referencia de gestión para iniciar y controlar la
                                    implementación y operación de la seguridad de la información dentro de la
                                    organización.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th scope="col">CLASIFICACIÓN</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapa6 as $g6s)
                                        <tr>
                                            <td>
                                                {{$g6s->gap_dos_catalogo->control_iso}}
                                            </td>
                                            <td>
                                                {{$g6s->gap_dos_catalogo->clasificacion->nombre}}
                                            </td>
                                            <td>
                                                {{$g6s->gap_dos_catalogo->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g6s->gap_dos_catalogo->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g6s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update",  $g6s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g6s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g6s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g6s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g6s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g6s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g6s->id)}}"
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
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">
                                7. CONTROLES FISICOS</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Garantizar la
                                    seguridad del teletrabajo y el uso de dispositivos móviles</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th scope="col">CLASIFICACIÓN</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapa7 as $g7s)
                                        <tr>
                                            <td>
                                                {{$g7s->gap_dos_catalogo->control_iso}}
                                            </td>
                                            <td>
                                                {{$g7s->gap_dos_catalogo->clasificacion->nombre}}
                                            </td>
                                            <td>
                                                {{$g7s->gap_dos_catalogo->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g7s->gap_dos_catalogo->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g7s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update",  $g7s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g7s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g7s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g7s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g7s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g7s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g7s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g7s->recomendacion}}"
                                                   class="recomendacion" data-name="recomendacion">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">8. CONTROLES TECNÓLOGICOS</p>
                                <p class="p-2 mb-2 text-white bg-info" style="font-size: 12px;">OBJETIVO: Identificar
                                    los activos organizacionales y definir las responsabilidades de protección
                                    adecuadas.</p>
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th scope="col">CLASIFICACIÓN</th>
                                        <th COLSPAN="2">CONTROL</th>
                                        <th scope="col">VALORACIÓN</th>
                                        <th scope="col">EVIDENCIA DE
                                            CUMPLIMIENTO
                                        </th>
                                        <th scope="col">RECOMENDACIÓN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gapa8 as $g8s)
                                        <tr>
                                            <td>
                                                {{$g8s->gap_dos_catalogo->control_iso}}
                                            </td>
                                            <td>
                                                {{$g8s->gap_dos_catalogo->clasificacion->nombre}}
                                            </td>
                                            <td>
                                                {{$g8s->gap_dos_catalogo->anexo_politica}}
                                            </td>
                                            <td>
                                                {{$g8s->gap_dos_catalogo->anexo_descripcion}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                   data-type="select"
                                                   data-pk="{{$g8s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g8s->id)}}"
                                                   data-title="Seleccionar valoracion"
                                                   data-value="{{$g8s->valoracion}}"
                                                   class="valoracionGap2"
                                                   data-name="valoracion">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g8s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g8s->id)}}"
                                                   data-title="Evidencia" data-value="{{$g8s->evidencia}}"
                                                   class="evidencia" data-name="evidencia">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" data-type="text" data-pk="{{$g8s->id}}"
                                                   data-url="{{route("admin.gap-dos-2022.update", $g8s->id)}}"
                                                   data-title="Recomendacion" data-value="{{$g8s->recomendacion}}"
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
