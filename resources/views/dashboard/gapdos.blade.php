<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div id="barraGap2" class="barraGap2">
                    <h6 align="center">GAP 02: MARCO DE GESTIÓN DE SEGURIDAD DE LA INFORMACIÓN ({{number_format($porcentajeGap2['Avance'], 2, '.', '')}}%)
                    </h6>
                    <div class="progress">
                        <div
                            class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"
                            style="width: {{number_format($porcentajeGap2['porcentaje_gap'], 2, '.', '')}}%">{{number_format($porcentajeGap2['Avance'], 2, '.', '')}}%
                        </div>
                    </div>
                </div>
                
                   
                        <p><strong>INSTRUCCIONES: </strong>Por favor, conteste
                            el
                            siguiente cuestionario de acuerdo con los siguientes
                            parámetros:</p>
                        <div class="row">
                            <div class="w-100"></div>
                            <div class="p-3 mb-2 text-white col-3 " style="background-color:#6863FF">Inexistente
                            </div>
                            <div class="col-9">Total falta de un proceso reconocible.
                            </div>
                            <div class="p-3 mb-2 text-white col-3 " style="background-color:#f49c37">Repetible
                            </div>
                            <div class="col-9">Procesos desarrollados hasta el punto en que diferentes personas lo siguen.
                            </div>
                            <div class="p-3 mb-2 text-white col-3 " style="background-color:#aaaaaa">Administrada
                            </div>
                            <div class="col-9">Posible monitorear y medir el cumplimiento de los procedimientos.
                            </div>
                            <div class="p-3 mb-2 text-white col-3 " style="background-color:#4A98FF">Definida 
                            </div>
                            <div class="col-9">Procesos estandarizados y documentados, y comunicados a traves de capacitaciones
                            </div>
                            <div class="w-100"></div>
                            <div class="p-3 mb-2 text-white col-3 " style="background-color:#FFCB63">
                                Inicial
                            </div>
                            <div class="col-9">No hay procesos estandarizados, pero hay métodos ad hoc que tienden hacer aplicados.
                            </div>
                            <div class="w-100"></div>
                            <div class="p-3 mb-2 text-white col-3" style="background-color:#6DC866">
                                Optimizada
                            </div>
                            <div class="col-9">Procesos refinados hasta un nivel de la mejora práctica, basada en los resultados.
                            </div>
                          
                            <h5 class="p-3 mx-auto mb-2 bg-white text-dark">
                                HACER</h5>
                            <div class="table-responsive">
                                <table class="table" style="font-size: 12px;">
                                    <thead class="thead-dark" align="center">
                                    <tr>
                                        <th scope="col">INDICE</th>
                                        <th COLSPAN="col">CONTROL</th>
                                        <th COLSPAN="col">PREGUNTA</th>
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

                        </div>
                    
               
            </div>
        </div>
    </div>
</div>

