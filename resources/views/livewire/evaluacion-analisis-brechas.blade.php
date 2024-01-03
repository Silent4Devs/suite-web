<div>
    <style>
        .card {
            border-radius: 16px;
        }
        .card-dash-analisis{
            width: 290px;
            height: 68px;
            /* box-shadow: 0px 1px 4px #0000000F; */
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

        .parametros {
            width: 155px;
            height: 43px;
        }

        .parametros-title{
            font: normal normal 600 20px/27px Segoe UI;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        input,select {
            border:none;
            color: #057BE2
        }

        input:focus, select:focus {
            border: 1px solid #057BE2;
            outline: none !important;
        }
        .datatable-rds {
            box-shadow: none !important;
            padding: 0px !important;
            border: none !important;
            border-radius: 0px !important;
        }

        .datatable-rds th {
            padding: 15px 12px !important;
        }

        .boton-transparente {
            background-color: transparent;
            border: none;
        }
        .modal-dialog {
            max-width: var(--bs-modal-width);
            margin-right: 0px;
            margin-left: 180px;
            margin-top: 180px;
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            color: var(--bs-modal-color);
            pointer-events: auto;
            background-color: var(--bs-modal-bg);
            background-clip: padding-box;
            border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
            border-radius: 16px;
            outline: 0;
            margin-top: 0px;
            margin-bottom: 100px;
        }

        .modal {
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-606060);
            text-align: left;
            font: normal normal normal 14px/20px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }
        .boton-transparentev2 {
            top: 214px;
            width: 135px;
            height: 40px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            border: 1px solid var(--unnamed-color-057be2);
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #057BE2;
            opacity: 1;
        }
    </style>

        <div class="row mb-3 ">
            @if ($template_general->secciones->count() > 1)
                <div class="col-3 mt-4">
                    <div class="card shadow-sm card-analisis card-dash-analisis">
                        <div class="card-body" style="margin: 0px; padding:0px;">
                            <div class="row m-0 p-0" style="height: 68px;" >
                                <div class="col-3 d-flex justify-content-center align-items-center col-icon">
                                    <i class="material-icons-outlined" style="color: #FFFFFF; cursor: pointer;" wire:click="changeSeccion({{ 0 }})">
                                        visibility
                                    </i>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-center">
                                    <h5 class="seccion-text">Total</h5>
                                </div>
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="subtitle-valor">
                                                Valor
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="seccion-valor">
                                                {{round($totalAnalisis) }}%
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($template_general->secciones as $key => $seccion)
                <div class="col-3 mt-4">
                    <div class="card shadow-sm card-body card-analisis card-dash-analisis" style="margin: 0px; padding:0px; ">
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
                                            Valor
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
            <div class="card shadow-sm card-body">
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

            <div class="card shadow-sm">
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
                                <table class="table w-100 table-borderless" style="width:100%">
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
                        <style>
                        #contenedor-principal, #contenedor-principal canvas {
                            width: 100% !important;
                        }
                        </style>
                        <div class="col-6" style="display: flex; align-items:center;">
                            <div id="contenedor-principal">
                                <canvas id="graf-parametros"></canvas>
                            </div>

                            <!-- HTML structure to contain the bar chart -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm card-body" style="padding-top: 0px; padding-right: 0px; padding-bottom: 0px;">
                <div class="row m-0 p-0">
                    <div class="col-3">
                        <div class="row d-flex justify-content-start" style="margin-top: 34px; padding-left:37px;">
                            <div class="col-12 parametros" style="padding: 0px;">
                                <h6 class="parametros-title">Tus Parámetros</h6>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start" style="margin-bottom: 53px; padding-left:37px;">
                            @foreach ($template->parametros as $parametro)
                            <div class="col-12 parametros d-flex align-items-center" style="background-color: {{ $parametro->color }}; margin-top:23px;">
                                <p style="margin-bottom: 0px;">{{ $parametro->estatus }}</p>
                            </div>

                            @endforeach
                        </div>
                    </div>
                    <div class="col-9" style="background-color: #FFFCE9; margin:0px; border-radius: 16px;">
                        <div class="row d-flex justify-content-start" style="margin-top: 34px; padding-left:37px;">
                            <div class="col-12 parametros" style="padding: 0px;">
                                <h6 class="parametros-title">Descripción</h6>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start" style="margin-bottom: 53px; padding-left:37px;">
                            @foreach ($template->parametros as $parametro)
                            <div class="col-12 d-flex align-items-center" style="margin-top:23px; min-height: 43px">
                                <p style="margin-bottom: 0px;">{{ $parametro->descripcion }}</p>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm card-body">
                <div class="row">
                    <div class="datatable-fix datatable-rds">
                        <table class="table w-100 table-borderless" style="width:100%">
                            <thead>
                                <th>No.</th>
                                <th>Pregunta</th>
                                <th>Valoración</th>
                                <th>Evidencía de Cumplimiento</th>
                                <th>Recomendación</th>
                            </thead>
                            <tbody>
                                @foreach ($seccion->preguntas as $key => $pregunta)
                                    <tr style="background: #FFFFFF;">
                                        <td>{{ $pregunta->numero_pregunta }}</td>
                                        <td>{{ $pregunta->pregunta }}</td>
                                        <td>
                                            <select class="link-like-select" style="border: none;"
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
        <div class="card shadow-sm card-body">
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
                    <p class="porcentaje-progress m-0"> {{round($totalAnalisis) }}%</p>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row m-0 p-0">
                            <div class="col-11">
                                <h5 class="title-grafics">
                                    Porcentaje Total del Análisis
                                </h5>
                            </div>
                        <div class="col-1">
                            <button class="boton-transparente boton-sin-borde" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
                            </button>
                        </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-6">
                        <div class="datatable-fix datatable-rds">
                            <table class="table w-100 table-borderless">
                                <thead>
                                    <tr style="background:#EBEBEB;">
                                        <th>
                                            Sección
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
                                        <tr style="background: #FFFFFF;">
                                            <td>
                                                Sección{{ $seccion->numero_seccion }}
                                            </td>
                                            <td>
                                                {{ round($seccion->porcentaje_seccion) }}%
                                            </td>
                                            <td>
                                                {{ round(number_format((float) $sectionPercentages[$seccion->numero_seccion]['total_porcentaje'], 2, '.')) ?? 0 }}%
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr style="background: #EEFDFF;">
                                        <td colspan="1">Total</td>
                                        <td>100%</td>
                                        <td>{{ number_format((float) $sectionPercentages[0]['percentage'], 2, '.') ?? 0 }}%
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-6 align-items-center">
                        <!-- HTML structure to contain the bar chart -->
                        <div id="contenedor-principal">
                            <canvas id="graf-parametros" width="400" height="400"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"
                    style="margin:50px 0px 50px 1230px; background:none;"><i class="fa-solid fa-x fa-2xl"
                        style="color: #ffffff;"></i>
                </button>
                <div class="modal-dialog" style="margin-top: 0px;">
                    <div class="modal-content" >
                        <div class="modal-body" >
                            <div class="card col-sm-12 col-md-10"
                                style="border-radius: 16px; box-shadow: none; border-color:white; width: auto;">
                                <div class="card-body" style="">
                                    <div class="print-none" style="text-align:right;">
                                        <form wire:submit.prevent="pdf" id="generate-pdf-form">
                                            <button class="boton-transparentev2" type="submit" style="color: #306BA9;">
                                                IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card mt-5" style="width:900px;box-shadow:4px;">
                                        <div class="row col-12 ml-0"
                                            style="border-radius;
                                            padding-left: 0px;padding-right: 0px;">
                                            <div class="col-3" style="border-left: 25px solid #2395AA">
                                                <img src="{{ asset('silent.png') }}" class="mt-2 img-fluid"
                                                    style=" width:60%; position: relative; left: 1rem; top: 1.5rem;">
                                            </div>
                                            <div class="col-5 p-2 mt-3">
                                                <br>
                                                <span class=""
                                                    style="color:black; position: relative; top: -1.5rem; right: 3rem;">
                                                    {{ $empresa_actual }} <br>
                                                    RFC: {{ $rfc }} <br>
                                                    {{ $direccion }} <br>
                                                </span>

                                            </div>
                                            <div class="col-4 pt-6 pl-6" style="background:#FFFFFF;">
                                                <br>
                                                <br>
                                                <br>
                                                <span class="textopdf"> <strong> Reporte Análisis de Brechas</strong></span>
                                            </div>
                                            <br>
                                            <div class="col-12 " style="background: #FFFFFF; ">
                                                <div class="row" style="margin-top:40px;">
                                                    <div class="col-12">
                                                        <div class="row m-0 p-0">
                                                            <div class="col-11">
                                                                <h5 class="title-grafics">
                                                                    Porcentaje Total del Análisis
                                                                </h5>
                                                            </div>

                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="datatable-fix datatable-rds">
                                                            <table class="table w-100 table-borderless">
                                                                <thead>
                                                                    <tr style="background:#EBEBEB;">
                                                                        <th>
                                                                            Sección
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
                                                                        <tr style="background: #FFFFFF;">
                                                                            <td>
                                                                                Sección{{ $seccion->numero_seccion }}
                                                                            </td>
                                                                            <td>
                                                                                {{ round($seccion->porcentaje_seccion) }}%
                                                                            </td>
                                                                            <td>
                                                                                {{ round(number_format((float) $sectionPercentages[$seccion->numero_seccion]['total_porcentaje'], 2, '.')) ?? 0 }}%
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr style="background: #EEFDFF;">
                                                                        <td colspan="1">Total</td>
                                                                        <td>100%</td>
                                                                        <td>{{ number_format((float) $sectionPercentages[0]['percentage'], 2, '.') ?? 0 }}%
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 align-items-center">
                                                        <!-- HTML structure to contain the bar chart -->
                                                        <div id="contenedor-principal">
                                                            <canvas id="graf-parametros" width="400" height="400"></canvas>
                                                        </div>

                                                    </div>
                                                </div>

                                                @foreach ($template->secciones as $key => $seccion)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="title-grafics">
                                                                Sección {{ $seccion->numero_seccion }}: {{ $seccion->descripcion }}
                                                            </h5>
                                                            <hr>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="datatable-fix datatable-rds">
                                                                <table class="table w-100 table-borderless" style="width:100%">
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
                                                                                    {{-- {{ $cuentas[$parametro->id] ?? 0 }} --}}
                                                                                    {{$results[$key]['counts'][$parametro->id] ?? 0}}
                                                                                </td>
                                                                                <td>
                                                                                    {{ number_format((float) $results[$key]['porcentaje_parametros'][$parametro->id], 2, '.') ?? 0 }}%
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach

                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr style="background: #EEFDFF;">
                                                                            <td>Total</td>
                                                                            <td>{{ $results[$key]['totalCount'] ?? 0 }}</td>
                                                                            <td>{{ number_format((float) $results[$key]['total_porcentaje'], 2, '.') ?? 0 }}%</td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <style>
                                                        #contenedor-principal, #contenedor-principal canvas {
                                                            width: 100% !important;
                                                        }
                                                        </style>
                                                        <div class="col-6" style="display: flex; align-items:center;">
                                                            <div id="contenedor-principal">
                                                                <canvas id="graf-parametros"></canvas>
                                                            </div>

                                                            <!-- HTML structure to contain the bar chart -->

                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    @endif

    @section('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                console.log('hola');
                Livewire.on('renderAreas', (grafica_cuentas, grafica_colores) => {
                    // console.log(cuentas);
                    // console.log(colores);
                    document.getElementById('graf-parametros').remove();

                    let canvas = document.createElement("canvas");
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


        {{-- <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Tu script aquí
                console.log('La página se ha cargado');
                Livewire.on('renderAreas', (grafica_cuentas, grafica_colores) => {
                    // console.log(cuentas);
                    // console.log(colores);
                    document.getElementById('graf-parametros').remove();

                    let canvas = document.createElement("canvas");
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
        </script> --}}

    @endsection
</div>

