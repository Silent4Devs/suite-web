<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div id="barraGap3" class="barraGap3">
                    <h6 align="center">GAP 03:  MONITOREO Y MEJORA CONTINUA ({{$porcentajeGap3['porcentaje']}}%)
                    </h6>
                    <div class="progress">
                        <div
                            class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" aria-valuenow="{{(number_format($porcentajeGap3['porcentaje'], 2, '.', '') * 100) / 30}}"
                            aria-valuemin="0" aria-valuemax="100"
                            style="width: {{(number_format($porcentajeGap3['porcentaje'], 2, '.', '') * 100) / 30}}%">{{$porcentajeGap3['porcentaje']}} %</div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p>Monitoreo y mejoramiento continuo. Tiene un peso del 30% del total del componente: 20% - Actividades de seguimiento, medicion, analisis y evaluacion. 10% - Revision e Implementacion de Acciones de Mejora.

                            </p>
                        </div>
                    </div>
                </div>
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

                    <h5 class="p-3 mx-auto mb-2 bg-white text-dark">
                        VERIFICAR</h5>
                    <div class="table-responsive">
                        <table class="table" style="font-size: 12px;">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">PREGUNTA</th>
                                <th scope="col">VALORACIÓN</th>
                                <th scope="col">EVIDENCIA DE
                                    CUMPLIMIENTO
                                </th>
                                <th scope="col">RECOMENDACIÓN</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gaptresVerif as $verificar)
                            <tr>
                                <th scope="row">
                                    {{$verificar->id}}
                                </th>
                                <td>
                                    {{$verificar->pregunta}}
                                </td>
                                <td>
                                    <a href="#"
                                       data-type="select"
                                       data-pk="{{$verificar->id}}"
                                       data-url="{{route("admin.gap-tres.update",  $verificar->id)}}"
                                       data-title="Seleccionar valoracion"
                                       data-value="{{$verificar->valoracion}}"
                                       class="valoracionGap3" data-name="valoracion">
                                    </a>
                                </td>
                                <td>
                                    <a href="#"
                                       data-type="text"
                                       data-pk="{{$verificar->id}}"
                                       data-url="{{route("admin.gap-tres.update", $verificar->id)}}"
                                       data-title="Evidencia"
                                       data-value="{{$verificar->evidencia}}"
                                       class="evidencia"
                                       data-name="evidencia">
                                    </a>
                                </td>
                                <td>
                                    <a href="#"
                                       data-type="text"
                                       data-pk="{{$verificar->id}}"
                                       data-url="{{route("admin.gap-tres.update", $verificar->id)}}"
                                       data-title="Recomendacion"
                                       data-value="{{$verificar->recomendacion}}"
                                       class="recomendacion"
                                       data-name="recomendacion">
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h5 class="p-3 mx-auto mb-2 bg-white text-dark">
                        ACTUAR</h5>
                    <div class="table-responsive">
                        <table class="table" style="font-size: 12px;">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">PREGUNTA</th>
                                <th scope="col">VALORACIÓN</th>
                                <th scope="col">EVIDENCIA DE
                                    CUMPLIMIENTO
                                </th>
                                <th scope="col">RECOMENDACIÓN</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gaptresAct as $actuar)
                                <tr>
                                    <th scope="row">
                                        {{$actuar->id}}
                                    </th>
                                    <td>
                                        {{$actuar->pregunta}}
                                    </td>
                                    <td>
                                        <a href="#"
                                           data-type="select"
                                           data-pk="{{$actuar->id}}"
                                           data-url="{{route("admin.gap-tres.update",  $actuar->id)}}"
                                           data-title="Seleccionar valoracion"
                                           data-value="{{$actuar->valoracion}}"
                                           class="valoracionGap3" data-name="valoracion">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#"
                                           data-type="text"
                                           data-pk="{{$actuar->id}}"
                                           data-url="{{route("admin.gap-tres.update", $actuar->id)}}"
                                           data-title="Evidencia"
                                           data-value="{{$actuar->evidencia}}"
                                           class="evidencia"
                                           data-name="evidencia">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#"
                                           data-type="text"
                                           data-pk="{{$actuar->id}}"
                                           data-url="{{route("admin.gap-tres.update", $actuar->id)}}"
                                           data-title="Recomendacion"
                                           data-value="{{$actuar->recomendacion}}"
                                           class="recomendacion"
                                           data-name="recomendacion">
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

<script>
    @section('x-editable')
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //categories table
        $(".evidencia").editable({
            dataType: 'json',
            success: function(response, newValue) {
                console.log('Actualizado, response')
            }
        });


    });


    @endsection
</script>
