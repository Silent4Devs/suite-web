<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div id="barraGap3" class="barraGap3">
                    <h6 align="center">GAP 03: MARCO DE GESTIÓN DE SEGURIDAD DE LA INFORMACIÓN ({{ $porcentajeGap3['porcentaje'] }}%)
                    </h6>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="30"
                            aria-valuemin="0" aria-valuemax="100"
                            style="width: {{ (number_format($porcentajeGap3['porcentaje'], 2, '.', ''))}}%">
                            {{ $porcentajeGap3['porcentaje'] }} %</div>
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
                    <div class="col-9">No hay procesos estandarizados, pero hay métodos ad hoc que tienden hacer
                        aplicados.
                    </div>
                    <div class="w-100"></div>
                    <div class="p-3 mb-2 text-white col-3" style="background-color:#6DC866">
                        Optimizada
                    </div>
                    <div class="col-9">Procesos refinados hasta un nivel de la mejora práctica, basada en los
                        resultados.
                    </div>


                    <h5 class="p-3 mx-auto mb-2 bg-white text-dark">
                        VERIFICAR</h5>
                    <div class="table-responsive">
                        <table class="table" style="font-size: 12px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ESTADO</th>
                                    <th scope="col">CONTROL</th>
                                    <th scope="col">PREGUNTA</th>
                                    <th scope="col">VALORACIÓN</th>
                                    <th scope="col">EVIDENCIA DE
                                        CUMPLIMIENTO
                                    </th>
                                    <th scope="col">RECOMENDACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gaptresVerif as $verificar)
                                    <tr>
                                        <th scope="row">
                                            {{ $verificar->estado }}
                                        </th>
                                        <td>
                                            {{ $verificar->contexto ? $verificar->contexto : 'Sin registro'  }}
                                        </td>
                                        <td>
                                            {{ $verificar->pregunta }}
                                        </td>
                                        <td>
                                            <a href="#" data-type="select" data-pk="{{ $verificar->id }}"
                                                data-url="{{ route('admin.gap-tres.update', $verificar->id) }}"
                                                data-title="Seleccionar valoracion"
                                                data-value="{{ $verificar->valoracion }}" class="valoracionGap3"
                                                data-name="valoracion">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" data-type="text" data-pk="{{ $verificar->id }}"
                                                data-url="{{ route('admin.gap-tres.update', $verificar->id) }}"
                                                data-title="Evidencia" data-value="{{ $verificar->evidencia }}"
                                                class="evidencia" data-name="evidencia">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" data-type="text" data-pk="{{ $verificar->id }}"
                                                data-url="{{ route('admin.gap-tres.update', $verificar->id) }}"
                                                data-title="Recomendacion" data-value="{{ $verificar->recomendacion }}"
                                                class="recomendacion" data-name="recomendacion">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
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
