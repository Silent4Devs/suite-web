<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div id="barraGap1" class="barraGap1">
                    <h6 align="center">GAP 01: MARCO DE GESTIÓN DE SEGURIDAD DE LA INFORMACIÓN
                        ({{ number_format($porcentajeGap1, 2, '.', '') }}%)</h6>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="{{ (number_format($porcentajeGap1, 2, '.', '') * 100) / 30 }}"
                            aria-valuemin="0" aria-valuemax="100"
                            style="width: {{ (number_format($porcentajeGap1, 2, '.', '') * 100) / 30 }}%">
                            {{ number_format($porcentajeGap1, 2, '.', '') }}
                            %
                        </div>
                      
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                      
                        {{-- <p>Definicion del Marco de Seguridad y
                            Privacidad de
                            la Organización. Tiene un peso del 30% del
                            total
                            del componente: 10% - Diagnostico de
                            Seguridad y
                            Privacidad , 20% - Proposito de Seguridad y
                            Privacidad de la Informacion.
                        </p> --}}
                    </div>
                </div>
                <p><strong>INSTRUCCIONES: </strong>Por favor, conteste
                    el
                    siguiente cuestionario de acuerdo con los siguientes
                    parámetros:</p>
                <div class="row">
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
                        PLANEAR</h5>
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
                                @foreach ($gapunos as $gapuno)
                                    <tr>
                                        <th scope="row">
                                            {{ $gapuno->id }}
                                        </th>
                                        <td>
                                            {{ $gapuno->pregunta }}
                                        </td>
                                        <td>
                                            <a href="#" data-type="select" data-pk="{{ $gapuno->id }}"
                                                data-url="{{ route('admin.gap-unos.update', $gapuno->id) }}"
                                                data-title="Seleccionar valoracion"
                                                data-value="{{ $gapuno->valoracion }}" class="valoracion"
                                                data-name="valoracion">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" data-type="text" data-pk="{{ $gapuno->id }}"
                                                data-url="{{ route('admin.gap-unos.update', $gapuno->id) }}"
                                                data-title="Evidencia" data-value="{{ $gapuno->evidencia }}"
                                                class="evidencia" data-name="evidencia">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" data-type="text" data-pk="{{ $gapuno->id }}"
                                                data-url="{{ route('admin.gap-unos.update', $gapuno->id) }}"
                                                data-title="Recomendacion" data-value="{{ $gapuno->recomendacion }}"
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


<script>
    $(document).ready(function() {

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.send = "always";

        $.fn.editable.defaults.params = function(params) {
            params._token = $("#_token").data("token");
            return params;
        };

        $('#investmentName').editable({

            type: 'text',
            url: '/',
            send: 'always'

        });
    });
</script>

<script>
    @section('x-editable')
        $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        //categories table
        $(".evidencia").editable({
        dataType: 'json',
        success: function (response, newValue) {
        console.log('Actualizado, response')
        }
        });
        $(".valoracion").editable({

            dataType: 'json',
                source: [{
                value: '1',
                text: 'Inexistente'
                },
                {
                value: '2',
                text: 'Repetible'
                },
                {
                value: '3',
                text: 'Administrada'
                },
                {
                value: '4',
                text: 'Inicial'
                },
                {
                value: '5',
                text: 'Definida'
                },
                {
                value: '6',
                text: 'Optimizada'
                }
            ],
            success: function (response, newValue) {
            // $("#barraGap1").empty();

                $(".barraGap1").load(location.href + " .barraGap1 > *");

                $(".barraGap1_table").load(location.href + " .barraGap1_table > *");

                console.log('Actualizado, response')
            }
        });
        $(".valoracionGap2").editable({
        dataType: 'json',
        source: [{
        value: '1',
        text: 'Cumple satisfactoriamente'
        },
        {
        value: '2',
        text: 'Cumple parcialmente'
        },
        {
        value: '3',
        text: 'No cumple'
        },
        {
        value: '4',
        text: 'No aplica'
        }
        ],
        success: function (response, newValue) {
        // $(".barraGap2").empty();
        $(".barraGap2").load(location.href + " .barraGap2 > *");

        $(".barraGap2_table").load(location.href + " .barraGap2_table > *");

        console.log('Actualizado, response')
        }
        });
        $(".recomendacion").editable({
        dataType: 'json',
        success: function (response, newValue) {
        console.log('Actualizado, response')
        }
        });


        $(".valoracionGap3").editable({
            dataType: 'json',
            source: [{
                value: '1',
                text: 'Cumple satisfactoriamente'
            },
                {
                    value: '2',
                    text: 'Cumple parcialmente'
                },
                {
                    value: '3',
                    text: 'No cumple'
                }
            ],
            success: function(response, newValue) {

                $(".barraGap3").load(location.href + " .barraGap3 > *");

                $(".barraGap3_table").load(location.href + " .barraGap3_table > *");


                    console.log('Actualizado, response')
                }
        });
        $(".recomendacion").editable({
            dataType: 'json',
            success: function(response, newValue) {
                console.log('Actualizado, response')
            }
        });

        });




    @endsection
</script>
