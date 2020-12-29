<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h6 align="center">GAP 01: DEFINICIÓN DE MARCO DE
                    SEGURIDAD
                    Y PRIVACIDAD DE LA ORGANIZACIÓN (75%)</h6>
                <div class="progress">
                    <div
                        class="progress-bar progress-bar-striped progress-bar-animated"
                        role="progressbar" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"
                        style="width: 75%">75%
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p>Definicion del Marco de Seguridad y
                            Privacidad de
                            la Organización. Tiene un peso del 30% del
                            total
                            del componente: 10% - Diagnostico de
                            Seguridad y
                            Privacidad , 20% - Proposito de Seguridad y
                            Privacidad de la Informacion.
                        </p>
                    </div>
                </div>
                <p><strong>INSTRUCCIONES: </strong>Por favor, conteste
                    el
                    siguiente cuestionario de acuerdo con los siguientes
                    parámetros:</p>
                <div class="row">
                    <div class="col-3 p-3 mb-2 bg-success text-white">
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
                    <div class="col-3 p-3 mb-2 bg-warning text-white">
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
                    <div class="col-3 p-3 mb-2 bg-danger text-white">No
                        cumple
                    </div>
                    <div class="col-9">No existe y/o no se está
                        haciendo.
                    </div>

                    <h5 class="p-3 mb-2 bg-white text-dark mx-auto">
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
                            @foreach($gapunos as $gapuno)
                                <tr>
                                    <th scope="row">
                                        {{$gapuno->id}}
                                    </th>
                                    <td>
                                        {{$gapuno->pregunta}}
                                    </td>
                                    <td>
                                        @if($gapuno->valoracion == 1)
                                            <div class="p-2 mb-2 bg-success text-white">
                                                Cumple satisfactoriamente
                                            </div>
                                        @elseif($gapuno->valoracion == 2)
                                            <div class="p-2 mb-2 bg-warning text-white">
                                                Cumple parcialmente
                                            </div>
                                        @elseif($gapuno->valoracion == 3)
                                            <div class="p-2 mb-2 bg-danger text-white">
                                                No cumple
                                            </div>
                                        @else
                                            Sin información cargada
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="update" data-pk="{{ $gapuno->id }}" data-type="text" data-name="evidencia" data-title="Actualizar evidencia">{{ $gapuno->evidencia }}</a>
                                    </td>
                                    <td>
                                    <input name="recomendacion" id="recomendacion{{ $gapuno->id }}" value="{{ $gapuno->recomendacion }}">
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
    /*$(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('.xedit').editable({
           url: '{{url('analisis-brechas/update')}}',
            title: 'GapUno Update',
            success: function (response, newValue) {
               console.log('Actualizado', response)
        }
        });
    })*/

    $(document).ready(function() {

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.send = "always";

        $.fn.editable.defaults.params = function (params)
        {
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
