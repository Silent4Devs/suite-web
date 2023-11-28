<div class="container-fluid mb-4">
    <div class="row">
        @foreach ($template_general->secciones as $key => $seccion)
            <div class="col-3 mt-4">
                <div class="card card-body secciones justify-content-center">
                    <div class="row align-items-center">
                        <h5>
                            Sección {{ $seccion->numero_seccion }}
                        </h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card card-body">
    <div class="row align-items-center">
        <div class="col-2">
            <p>Avance del análisis</p>
        </div>
        <div class="col-10">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <sub>La evaluación tiene un peso total del 100%</sub><br>
        <sub>En el caso del registro de dos o mas secciones en la plantilla. "La evaluación dividira su
            valoración del porcentaje (Numero registrado)% del 100% total"</sub>
    </div>
</div>

@foreach ($template->secciones as $key => $seccion)
    <div class="card">
        <div class="card-header">
            Sección: {{ $seccion->numero_seccion }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <div class="col-6">
                        <table class="table">
                            <thead>
                                <tr class="table-secondary">
                                    <th>
                                        Estatus
                                    </th>
                                    <th>
                                        Requisitos
                                    </th>
                                    <th>
                                        Peso
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($template->parametros as $parametro)
                                    <tr class="table-light">
                                        <td>
                                            {{ $parametro->estatus }}
                                        </td>
                                        <td style="background-color: {{ $parametro->color }}">
                                            0
                                        </td>
                                        <td>
                                            0
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="table-primary">
                                    <td>Total</td>
                                    <td>(Suma)</td>
                                    <td>(Porcentaje)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>

    <div class="card card-body" style="
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
">
        <div class="row" style="margin-top: 10px;">
            <div class="col-3">
                <div class="row" style="margin-left:20px; margin-bottom:10px;">
                    <h6>Tus Parámetros</h6>
                </div>
                @foreach ($template->parametros as $parametro)
                    <div class="row"
                        style="background-color: {{ $parametro->color }}; margin-bottom:15px; margin-left:20px;  margin-right:20px;">
                        <p>{{ $parametro->estatus }}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-9" style="background-color: rgb(253, 253, 188); margin:0px;">
                <div class="row" style="margin-left:20px; margin-bottom:10px;">
                    <h6>&nbsp;</h6>
                </div>
                @foreach ($template->parametros as $parametro)
                    <div class="row" style="margin-bottom:15px; margin-left:20px;">
                        <p>{{ $parametro->descripcion }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead style="background-color: #ffff !important; color:black !important;">
                        <th>No.</th>
                        <th>Pregunta</th>
                        <th>Valoración</th>
                        <th>Evidencía de Cumplimiento</th>
                        <th>Recomendación</th>
                    </thead>
                    <tbody>
                        @foreach ($seccion->preguntas as $key => $pregunta)
                            <td>{{ $pregunta->numero_pregunta }}</td>
                            <td>{{ $pregunta->pregunta }}</td>
                            <td>
                                <select class="link-like-select"
                                    name="respuesta_pregunta_{{ $pregunta->numero_pregunta }}" id="">
                                    <option value=""default>Vacio</option>
                                    @foreach ($template->parametros as $parametro)
                                        <option value="{{ $parametro->valor }}">{{ $parametro->estatus }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="link-like-select"
                                    name="respuesta_pregunta_{{ $pregunta->numero_pregunta }}" id="">
                                    <option value=""default>Vacio</option>
                                </select>
                            </td>
                            <td>
                                <select class="link-like-select"
                                    name="respuesta_pregunta_{{ $pregunta->numero_pregunta }}" id="">
                                    <option value=""default>Vacio</option>
                                </select>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach
<div>

</div>
