<div>
    <div class="container-fluid mb-4">
        <div class="row">
            @if ($template_general->secciones->count() > 1)
                <div class="col-3 mt-4">
                    <div class="card card-body secciones justify-content-center">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <button wire:click="changeSeccion({{ 0 }})">Ojo</button>
                            </div>
                            <div class="col-9">
                                <h5>
                                    Total
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($template_general->secciones as $key => $seccion)
                <div class="col-3 mt-4">
                    <div class="card card-body secciones justify-content-center">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <button wire:click="changeSeccion({{ $seccion->numero_seccion }})">Ojo</button>
                            </div>
                            <div class="col-6">
                                <h5>
                                    Sección {{ $seccion->numero_seccion }}
                                </h5>
                            </div>
                            <div class="col-3">
                                <p>
                                    Valor {{ $seccion->porcentaje_seccion }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    @if ($seccion_vista != 0)
        @foreach ($template->secciones as $key => $seccion)
            <div class="card card-body">
                <div class="row align-items-center">
                    <div class="col-2">
                        <p>Avance del análisis</p>
                    </div>
                    <div class="col-9">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ (string) ($totalPorcentaje / $seccion->porcentaje_seccion) * 100 }}%;"
                                aria-valuenow="{{ $sectionPercentages[$seccion->numero_seccion]['percentage'] }}"
                                aria-valuemin="0"
                                aria-valuemax="{{ $sectionPercentages[$seccion->numero_seccion]['percentage'] }}">
                                {{ number_format($totalPorcentaje, 2) }}% de avance
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <p> {{ $seccion->porcentaje_seccion }}%</p>
                    </div>
                </div>

                <div class="row">
                    <sub>La evaluación tiene un peso total del 100%</sub><br>
                    <sub>En el caso del registro de dos o mas secciones en la plantilla. "La evaluación dividira su
                        valoración del porcentaje {{ $seccion->porcentaje_seccion }}% del 100% total"</sub>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Sección: {{ $seccion->numero_seccion }}: {{ $seccion->descripcion }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="table-responsive">
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
                                                    {{ $cuentas[$parametro->id] ?? 0 }}
                                                </td>
                                                <td>
                                                    {{ number_format((float) $peso_parametros[$parametro->id], 2, '.') ?? 0 }}%
                                                    <!-- Display the calculated percentage -->
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr class="table-primary">
                                            <td>Total</td>
                                            <td>{{ $totalCount ?? 0 }}</td>
                                            <td>{{ number_format((float) $totalPorcentaje, 2, '.') ?? 0 }}%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- HTML structure to contain the bar chart -->
                            <div id="contenedor-principal">
                                <canvas id="graf-parametros" width="400" height="400"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-body" style="padding-top: 0px; padding-right: 0px; padding-bottom: 0px;">
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
                                    <tr>
                                        <td>{{ $pregunta->numero_pregunta }}</td>
                                        <td>{{ $pregunta->pregunta }}</td>
                                        <td>
                                            <select class="link-like-select"
                                                wire:model="selectedValues.{{ $pregunta->id }}.option1"
                                                wire:change="saveDataParametros('{{ $pregunta->id }}', $event.target.value)"
                                                name="respuesta_pregunta_{{ $pregunta->id }}"
                                                id="respuesta_pregunta_{{ $pregunta->id }}">
                                                @foreach ($template->parametros as $parametro)
                                                    <option value="{{ $parametro->id }}">{{ $parametro->estatus }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" wire:model.lazy="evidenciaValues.{{ $pregunta->id }}"
                                                wire:change="saveEvidencia('{{ $pregunta->id }}')"
                                                value="{{ isset($oldEvidenciaValues[$pregunta->id]) ? $oldEvidenciaValues[$pregunta->id] : $pregunta->respuesta->evidencia ?? '' }}">
                                        </td>

                                        <td>
                                            <input type="text"
                                                wire:model.lazy="recomendacionValues.{{ $pregunta->id }}"
                                                wire:change="saveRecomendacion('{{ $pregunta->id }}')"
                                                value="{{ isset($oldRecomendacionValues[$pregunta->id]) ? $oldRecomendacionValues[$pregunta->id] : $pregunta->respuesta->recomendacion ?? '' }}">
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="card card-body">
            <div class="row align-items-center">
                <div class="col-2">
                    <p>Avance del análisis</p>
                </div>
                <div class="col-9">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar"
                            style="width: {{ (string) ($sectionPercentages[0]['percentage'] / 100) * 100 }}%;"
                            aria-valuenow="{{ $sectionPercentages[0]['percentage'] }}" aria-valuemin="0"
                            aria-valuemax="{{ $sectionPercentages[0]['percentage'] }}">
                            {{ number_format($sectionPercentages[0]['percentage'], 2) }}% de avance
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <p> 100%</p>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                Porcentaje Total del Análisis
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="table-secondary">
                                        <th>
                                            Sección
                                        </th>
                                        <th>
                                            Descripción
                                        </th>
                                        <th>
                                            Meta
                                        </th>
                                        <th>
                                            Alcanzado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($template->secciones as $key => $seccion)
                                        <tr class="table-light">
                                            <td>
                                                Sección{{ $seccion->numero_seccion }}
                                            </td>
                                            <td>
                                                {{ $seccion->descripcion }}
                                            </td>
                                            <td>
                                                {{ $seccion->porcentaje_seccion }}
                                            </td>
                                            <td>
                                                {{ number_format((float) $sectionPercentages[$seccion->numero_seccion]['total_porcentaje'], 2, '.') ?? 0 }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr class="table-primary">
                                        <td colspan="2">Total</td>
                                        <td>100%</td>
                                        <td>{{ number_format((float) $sectionPercentages[0]['percentage'], 2, '.') ?? 0 }}%
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- HTML structure to contain the bar chart -->
                        <div id="contenedor-principal">
                            <canvas id="graf-parametros" width="400" height="400"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@section('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            console.log('hola');
            Livewire.on('renderAreas', (grafica_cuentas, grafica_colores) => {
                // console.log(cuentas);
                // console.log(colores);

                document.getElementById('graf-parametros').remove();

                var canvas = document.createElement("canvas");
                canvas.id = "graf-parametros";
                document.getElementById("contenedor-principal").appendChild(canvas);

                let grafica_proyectos = new Chart(document.getElementById('graf-parametros'), {
                    type: 'bar',
                    data: {
                        datasets: [{
                            label: "Preguntas que cumplen esta valoración:",
                            data: grafica_cuentas,
                            backgroundColor: grafica_colores,
                            lineTension: 0,
                            fill: true,
                            options: {
                                indexAxis: 'y',
                            }
                        }, ]
                    },
                });

            });
        });
    </script>
@endsection
