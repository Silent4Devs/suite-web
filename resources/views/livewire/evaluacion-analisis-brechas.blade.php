<div>
    <style>

        .card-dash-analisis{
            width: 290px;
            height: 68px;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
        }

        .seccion-text {
            font: medium 16px Roboto;
            color: #464646;
            opacity: 1;
        }

        .subtitle-valor {
            font: normal normal normal 12px/20px Roboto;
            letter-spacing: 0px;
            color: #464646;
            opacity: 1;
            margin-bottom: 0px;
        }

        .seccion-valor{
            font: medium 22px Roboto;
            color: #34ABB9;
            opacity: 1;
        }

        .col-icon{
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            background: #34ABB9;
        }

        .custom-progress {
            background-color: #FFCB80;
            border-radius: 29px;
        }

        .p-analisis{
            text-align: left;
            font: italic normal normal 14px/17px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }
        .porcentaje-progress{
            color: #34ABB9;
            font-size: 22px;
            margin: 0px;

        }

        .title-grafics{
            font: normal normal normal 20px/20px Roboto;
            letter-spacing: 0px;
            color: #747474;
            opacity: 1;
        }

    </style>

        <div class="row mb-3 ">
            @if ($template_general->secciones->count() > 1)
                <div class="col-3 mt-4">
                    <div class="card card-analisis card-dash-analisis">
                        <div class="card-body" style="margin: 0px; padding:0px;">
                            <div class="row m-0 p-0" style="height: 68px;" >
                                <div class="col-3 d-flex justify-content-center align-items-center col-icon">
                                    <i class="material-icons-outlined" style="color: #FFFFFF; cursor: pointer;" wire:click="changeSeccion({{ 0 }})">
                                        visibility
                                    </i>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-center">
                                    <h5 class="seccion-text">Total</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($template_general->secciones as $key => $seccion)
                <div class="col-3 mt-4">
                    <div class="card card-body card-analisis card-dash-analisis" style="margin: 0px; padding:0px;">
                        <div class="row m-0 p-0" style="height: 68px;">
                            <div class="col-3 d-flex justify-content-center align-items-center col-icon">
                                <i class="material-icons-outlined" style="color: #FFFFFF; cursor: pointer;" wire:click="changeSeccion({{ $seccion->numero_seccion }})">
                                    visibility
                                </i>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <h5 class="seccion-text">
                                    Sección {{ $seccion->numero_seccion }}
                                </h5>
                            </div>
                            <div class="col-3 d-flex align-items-center justify-content-center">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="subtitle-valor">
                                            valor
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="seccion-valor">
                                            {{ round($seccion->porcentaje_seccion) }}%
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @if ($seccion_vista != 0)
        @foreach ($template->secciones as $key => $seccion)
            <div class="card card-body ">
                <div class="row m-0 p-0" >
                    <div class="col-2 d-flex justify-content-start align-items-center" style="padding-left: 0px;">
                        <p style="margin: 0px;">Avance del análisis</p>
                    </div>
                    <div class="col-9 d-flex align-items-center">
                            <div class="progress" style="border-radius: 29px; width:900px;">
                                <div class="progress-bar custom-progress" role="progressbar"
                                    style="width: {{ (string) ($totalPorcentaje / $seccion->porcentaje_seccion) * 100 }}%;"
                                    aria-valuenow="{{ $sectionPercentages[$seccion->numero_seccion]['percentage'] }}"
                                    aria-valuemin="0"
                                    aria-valuemax="{{ $sectionPercentages[$seccion->numero_seccion]['percentage'] }}">
                                    {{ number_format($totalPorcentaje, 2) }}% de avance
                                </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <p class="porcentaje-progress"> {{ round($seccion->porcentaje_seccion) }}%</p>
                    </div>
                </div>

                <div class="row">
                    <p class="p-analisis">
                        La evaluación tiene un peso total del 100%.<br>
                        En el caso del registro de dos o más secciones en la plantilla: “La evaluación dividirá su valoración del porcentaje (Número registrado) % del 100% total”.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="title-grafics">
                                Sección {{ $seccion->numero_seccion }}: {{ $seccion->descripcion }}
                            </h5>
                            <hr>
                        </div>
                        <div class="col-6">
                            <div class="datatable-fix datatable-rds">
                                {{-- <table class="table w-100">
                                    <thead>
                                        <tr>
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
                                            <tr >
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
                                </table> --}}
                                <table class="table w-100 table-borderless" id="contactos_table" style="width:100%">
                                    <thead >
                                        <tr style="background:#EBEBEB;">
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
                                            <tr style="background: #FFFFFF;">
                                                <td>
                                                    {{ $parametro->estatus }}
                                                </td>
                                                <td style="background-color: {{ $parametro->color }}">
                                                    {{ $cuentas[$parametro->id] ?? 0 }}
                                                </td>
                                                <td>
                                                    {{ number_format((float) $peso_parametros[$parametro->id], 2, '.') ?? 0 }}%
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr style="background: #EEFDFF;">
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
            <div class="row m-0 p-0">
                <div class="col-2 d-flex justify-content-start align-items-center" style="padding-left: 0px;">
                    <p class="m-0">Avance Total del análisis</p>
                </div>
                <div class="col-9 d-flex align-items-center">
                    <div class="progress" style="border-radius:29px; width:900px;">
                        <div class="progress-bar custom-progress" role="progressbar"
                            style="width: {{ (string) ($sectionPercentages[0]['percentage'] / 100) * 100 }}%;"
                            aria-valuenow="{{ $sectionPercentages[0]['percentage'] }}" aria-valuemin="0"
                            aria-valuemax="{{ $sectionPercentages[0]['percentage'] }}">
                            {{ number_format($sectionPercentages[0]['percentage'], 2) }}% de avance
                        </div>
                    </div>
                </div>
                <div class="col-1 d-flex justify-content-start align-items-center">
                    <p class="porcentaje-progress m-0"> 100%</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="title-grafics">
                    Porcentaje Total del Análisis
                </h5>
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
