@if ($tipo == 'show')


    <div class="row col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
        <div class="col-4 pl-0" style="border-right: 2px solid #ccc">
            <div class="">
                <strong style="font-size:12px; color:#345183">Puesto del responsable del
                    riesgo</strong>

                <p style="font-size:12px; color:#345183" title="{{ $cartaAceptacion->responsables->puesto }}">
                    {{ Str::limit($cartaAceptacion->responsables->puesto, 25, '...') }}</p>
            </div>
            <div class="">
                <strong style="font-size:12px; color:#345183">Nombre del responsable del
                    riesgo</strong>
                <p style="font-size:12px; color:#345183" title="{{ $cartaAceptacion->responsables->name }}">
                    {{ Str::limit($cartaAceptacion->responsables->name, 25, '...') }}</p>
            </div>
            <div class="">

                <strong style="font-size:12px; color:#345183">Correo electrónico del
                    responsable del riesgo</strong>
                <p style="font-size:12px; color:#345183">
                    {{ Str::limit($cartaAceptacion->responsables->email, 35, '...') }}</p>
            </div>


        </div>
        <div class="col-4" style="border-right: 2px solid #ccc">
            <div class="">
                <strong style="font-size:12px; color:#345183">ID del riesgo</strong>
                <p style="font-size:12px; color:#345183">{{ $cartaAceptacion->folio_riesgo }}</p>

            </div>
            <div class="">
                <strong style="font-size:12px; color:#345183">Probabilidad del riesgo
                    evaluado</strong>
                <p style="font-size:12px;" class="m-0 p-0" id="valor_probabilidad">

                </p>
            </div>
            <div class="mt-3">
                <strong style="font-size:12px; color:#345183;">Impacto del riesgo
                    evaluado</strong>
                <p class="m-0 p-0" style="font-size:12px;">
                    <i style="font-size:10px;" id="circuloImpacto" class="mr-1 fas fa-circle"></i>{{ $impacto }}
                </p>
            </div>
        </div>

        <div class="col-4 px-2">
            <strong style="font-size:12px; color:#345183">Fecha de riesgo levantado</strong>
            <p style="font-size:12px; color:#345183">{{ $cartaAceptacion->fecharegistro }}</p>
            <strong style="font-size:12px; color:#345183">
                @if ($cartaAceptacion->fechaaprobacion != null)
                    @if ($cartaAceptacion->aceptado)
                        Fecha de aprobación del riesgo
                    @else
                        Fecha de rechazo del riesgo
                    @endif
                @else
                    Fecha de aprobación del riesgo
                @endif
            </strong>
            <br>
            <span style="font-size:12px; color:#345183">{{ $cartaAceptacion->fechaaprobacion }}</span>
            <br>
            @if ($cartaAceptacion->fechaaprobacion != null)
                @if ($cartaAceptacion->aceptado)
                    <span style="font-size:12px; color:#32ba4d">Aceptado</span>
                @else
                    <span style="font-size:12px; color:#d83232">Rechazado</span>
                @endif
            @endif
        </div>
    </div>
    <table class="table mt-4 w-100 p-0 m-0" id="contactos_table">
        <thead>
            <tr class="negras">

                <th class="text-center" style="font-size:12px; color:#345183; background-color:#cccccc;" colspan="6">
                    <div>
                        Tablero de Riesgos Impacto
                    </div>
                </th>
            </tr>
            <tr style="color:#345183; background-color:#fff;" colspan="6">
                <th style="font-size:12px;">PROBABILIDAD</th>
                <th style="font-size:12px;">1.Muy Bajo</th>
                <th style="font-size:12px;">2.Bajo</th>
                <th style="font-size:12px;">3.Medio</th>
                <th style="font-size:12px;">4.Alto</th>
                <th style="font-size:12px;">5.Crítico</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:12px;">
                    5. Muy probable
                </td>
                <td style="font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-1-5">
                    Medio (5)
                </td>
                <td style="font-size:12px; background-color:rgb(255, 194, 124);text-align:center !important;"
                    class="coordenada-2-5">
                    Alto (10)
                </td>
                <td style="font-size:12px; background-color:rgb(255, 194, 124);text-align:center !important;"
                    class="coordenada-3-5">
                    Alto (15)
                </td>
                <td style="font-size:12px; background-color:rgb(228, 130, 130);text-align:center !important;"
                    class="coordenada-4-5">
                    Crítico (20)
                </td>
                <td style="font-size:12px; background-color:rgb(228, 130, 130);text-align:center !important;"
                    class="coordenada-5-5">
                    Crítico (25)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td style="font-size:12px;">
                    4. Probable
                </td>
                <td style="font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-1-4">
                    Medio (4)
                </td>
                <td style=" font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-2-4">
                    Medio (8)
                </td>
                <td style="font-size:12px; background-color:rgb(255, 194, 124); text-align:center !important;"
                    class="coordenada-3-4">
                    Alto (12)
                </td>
                <td style="font-size:12px; background-color:rgb(255, 194, 124); text-align:center !important;"
                    class="coordenada-4-4">
                    Alto (16)
                </td>
                <td style="font-size:12px; background-color:rgb(228, 130, 130); text-align:center !important;"
                    class="coordenada-5-4">
                    Crítico (20)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td style="font-size:12px;">
                    3. Posible
                </td>
                <td style="font-size:12px; background-color:rgb(133, 236, 142); text-align:center !important;"
                    class="coordenada-1-3">
                    Bajo (3)
                </td>
                <td style="font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-2-3">
                    Medio (6)
                </td>
                <td style="font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-3-3">
                    Medio (9)
                </td>
                <td style="font-size:12px; background-color:rgb(255, 194, 124); text-align:center !important;"
                    class="coordenada-4-3">
                    Alto (12)
                </td>
                <td style="font-size:12px; background-color:rgb(255, 194, 124); text-align:center !important;"
                    class="coordenada-5-3">
                    Alto (15)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td style="font-size:12px;">
                    2. Poco Probable
                </td>
                <td style="font-size:12px; background-color:rgb(133, 236, 142); text-align:center !important;"
                    class="coordenada-1-2">
                    Bajo (2)
                </td>
                <td style="font-size:12px; background-color:rgb(133, 236, 142); text-align:center !important;"
                    class="coordenada-2-2">
                    Bajo (4)
                </td>
                <td style="font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-3-2">
                    Medio (6)
                </td>
                <td style="font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-4-2">
                    Medio (8)
                </td>
                <td style="font-size:12px;background-color:rgb(255, 194, 124); text-align:center !important;"
                    class="coordenada-5-2">
                    Alto (10)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td style="font-size:12px;">
                    1. Improbable
                </td>
                <td style="font-size:12px; font-size:12px; background-color:rgb(103, 207, 111); text-align:center !important;"
                    class="coordenada-1-1">
                    Muy Bajo (1)
                </td>
                <td style="font-size:12px; font-size:12px; background-color:rgb(133, 236, 142); text-align:center !important;"
                    class="coordenada-2-1">
                    Bajo (2)
                </td>
                <td style="font-size:12px; font-size:12px; background-color:rgb(133, 236, 142); text-align:center !important;"
                    class="coordenada-3-1">
                    Bajo (3)
                </td>
                <td style="font-size:12px; font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-4-1">
                    Medio (4)
                </td>
                <td style="font-size:12px; font-size:12px; background-color:rgb(240, 240, 150); text-align:center !important;"
                    class="coordenada-5-1">
                    Medio (5)
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table w-100 mt-4 mb-4" id="contactos_externos_table" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" style="font-size:12px; color:#345183; background-color:#cccccc;"
                    colspan="2" class="text-center">Descripción</th>

            </tr>
        </thead>
        <tbody id="contenedor_contactos_externos">
            <tr>
                <th style="font-size:12px; color:#345183;">Muy alto</th>
                <th style="font-size:12px; color:#345183; background-color:rgb(240, 240, 150);">Riesgo catastrófico que
                    puede afectar la permanencia del n_registro
                    y que genera impactos graves.
                </th>
            </tr>
            <tr>
                <th style="font-size:12px; color:#345183;">Alto</th>
                <th style="font-size:12px; color:#345183; background-color:rgb(240, 240, 150);">Riesgo intolerable para
                    la organización que genera impactos relevantes.
                </th>
            </tr>
            <tr>
                <th style="font-size:12px; color:#345183;">Medio</th>
                <th style="font-size:12px;color:#345183; background-color:rgb(240, 240, 150);">Riesgo moderado para la
                    organización que genera impactos significativos.
                </th>
            </tr>
            <tr>
                <th style="font-size:12px; color:#345183;">Bajo</th>
                <th style="font-size:12px; color:#345183; background-color:rgb(240, 240, 150);">Riesgo tolerable para
                    la
                    organización que no genera impactos significativos.
                </th>
            </tr>
            <tr>
                <th style="font-size:12px; color:#345183;">Muy bajo</th>
                <th style="font-size:12px;color:#345183; background-color:rgb(240, 240, 150);">Sin riesgo para la
                    organización y no genera algún impacto significativo.
                </th>
            </tr>
        </tbody>
    </table>

    <form id="activosAprobaciones">
        <table class="table">
            <thead>
                <tr style="background-color:#cccccc;">
                    <th style="color:#345183; font-size:12px; min-width: 100px;">ID Activo</th>
                    <th style="color:#345183; font-size:12px; min-width: 300px;">Nombre</th>
                    <th style="color:#345183; font-size:12px; min-width: 150px;">Criticidad</th>
                    <th style="color:#345183; font-size:12px; min-width: 150px;">Confidencialidad</th>
                    <th style="color:#345183; font-size:12px; min-width: 100px;">Revisión</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rechazado = false;
                    $contestado = false;
                @endphp

                @if (is_array($activos) || is_object($activos))
                    @foreach ($activos as $activo)
                        @foreach ($aprobadores as $aprobador)
                            @foreach ($aprobador->aprobacionesActivo as $aprobacion)
                                @php
                                    if ($activo->id == $aprobacion->activoInformacion_id) {
                                        if (!$aprobacion->aceptado) {
                                            $rechazado = true;
                                            break;
                                        } else {
                                            $rechazado = false;
                                        }
                                    }
                                @endphp
                            @endforeach
                            @php
                                if ($aprobador->aprobador_id == auth()->user()->empleado->id) {
                                    if ($aprobador->estado > 0) {
                                        $contestado = true;
                                    }
                                }

                            @endphp
                        @endforeach

                        <tr>
                            {{-- @if (is_null($activo->aceptado))
                            <th  scope="row"><i class="fas fa-info-circle" style="font-size:12pt; float: right;" title=""></i>{{ $activo->identificador }}
                            </th>
                            @else
                            <th  scope="row">{{ $activo->identificador }}</th>
                            @endif --}}

                            <th scope="row">

                                {{ $activo->identificador }}

                            </th>
                            <td>{{ $activo->activo_informacion }}</td>
                            <td>{{ $activo->valor_criticidad }}</td>
                            <td>{{ $activo->confidencialidad_id }} - {{ $activo->confidencialidad->confidencialidad }}
                            </td>

                            <td>
                                @if (!$rechazado)
                                    <div class="form-check">
                                        <input {{ $contestado ? 'disabled' : '' }} class="form-check-input "
                                            type="radio" name="aceptado{{ $activo->id }}"
                                            id="aceptado1-{{ $activo->id }}" value="true-{{ $activo->id }}"
                                            checked>
                                        <label class="form-check-label text-success"
                                            for="aceptado1-{{ $activo->id }}">
                                            <i style="font-size:10px;" class="fas fa-check mr-1"></i>Aceptar
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input {{ $contestado ? 'disabled' : '' }} class="form-check-input "
                                            type="radio" name="aceptado{{ $activo->id }}"
                                            id="aceptado2-{{ $activo->id }}" value="false-{{ $activo->id }}">
                                        <label class="form-check-label text-danger"
                                            for="aceptado2-{{ $activo->id }}">
                                            <i style="font-size:10px;" class="fas fa-times mr-1"></i>Rechazar
                                        </label>
                                    </div>
                                @else
                                    <i class="text-danger fas fa-times-circle mr-1" style="font-size:12pt;"
                                        title=""></i>Rechazado
                                @endif

                                {{-- <div>
                                    <button>Show</button>
                                    <h1>Result</h1>
                                </div> --}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </form>

    <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
        <thead>
            <tr class="negras">

                <th class="text-center" style="font-size:12px; color:#345183; background-color:#cccccc;"
                    colspan="2">
                    2.Evaluación del Riesgo a Aceptar</th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td style="color:#345183;">

                    <div class="row">
                        <div class="col-4">
                            <strong style="font-size:12px; color:#345183">Descripción del Riesgo Aceptado</strong>
                        </div>
                        <div class="col-8">
                            <span style="font-size:12px; color:#345183">{!! $cartaAceptacion->descripcion_riesgo !!}</span>
                        </div>
                    </div>
                </td>

            </tr>
        </tbody>
        <tbody>
            <tr>
                <td style="color:#345183;">

                    <div class="row">
                        <div class="col-4">
                            <strong style="font-size:12px;color:#345183">Descripción del Impacto del al
                                Negocio</strong>
                        </div>
                        <div class="col-8">
                            <span style="font-size:12px;color:#345183">{!! $cartaAceptacion->descripcion_negocio !!}</span>
                        </div>
                    </div>
                </td>
        </tbody>

        <tbody>
            <tr>
                <td style="color:#345183;">

                    <div class="row">
                        <div class="col-4">
                            <strong style="font-size:12px; color:#345183">Descripción del Impacto Tecnológico</strong>
                        </div>
                        <div class="col-8">
                            <span style="font-size:12px; color:#345183">{!! $cartaAceptacion->descripcion_tecnologico !!}</span>
                        </div>
                    </div>
                </td>
        </tbody>
    </table>

    <table class="table">

        <thead>
            <tr class="negras">

                <th class="text-center" style="font-size:12px; color:#345183; background-color:#cccccc;"
                    colspan="6">
                    <div>
                        Tipo de Impacto del Riesgo
                    </div>
                </th>
            </tr>
            <tr>
                <th scope="col" style="font-size:12px; background-color:#fff; color:#345183; min-width: 200px;">
                    Criterio
                </th>
                <th scope="col" style="font-size:12px; background-color:#fff; color:#345183; min-width: 100x;">
                    Valor
                </th>
                <th scope="col" style="font-size:12px; background-color:#fff; color:#345183; min-width: 400px;">
                    Detalle
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="font-size:12px;">Impacto Legal</th>
                <td style="color:{{ $tecnologicoTxtColor }};background-color:{{ $legalColor }}; font-size:12px;">
                    {{ $legal }}</td>
                <td style="font-size:12px;">{{ $legalTxt }}</td>
            </tr>
            <tr>
                <th scope="row" style="font-size:12px;">Impacto Cumplimiento</th>
                <td
                    style="color:{{ $cumplimientoTxtColor }}; background-color:{{ $cumplimientoColor }}; font-size:12px;">
                    {{ $cumplimiento }}</td>
                <td style="font-size:12px;">{{ $cumplimientoTxt }}</td>
            </tr>
            <tr>
                <th scope="row" style="font-size:12px;">Impacto Operacional</th>
                <td
                    style="color:{{ $operacionalTxtColor }}; background-color:{{ $operacionalColor }}; font-size:12px;">
                    {{ $operacional }}</td>
                <td style="font-size:12px;">{{ $operacionalTxt }}</td>
            </tr>
            <tr>
                <th scope="row" style="font-size:12px;">Impacto Reputacional</th>
                <td
                    style="color:{{ $reputacionalTxtColor }}; background-color:{{ $reputacionalColor }}; font-size:12px;">
                    {{ $reputacional }}</td>
                <td style="font-size:12px;">{{ $reputacionalTxt }}</td>
            </tr>
            <tr>
                <th scope="row" style="font-size:12px;">Impacto Tecnológico</th>
                <td
                    style="color:{{ $tecnologicoTxtColor }}; background-color:{{ $tecnologicoColor }}; font-size:12px;">
                    {{ $tecnologico }}</td>
                <td style="font-size:12px;">{{ $tecnologicoTxt }}</td>
            </tr>
        </tbody>
    </table>


    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="min-width: 100px;">Escenario</th>
                <th scope="col" style="min-width: 500x; ">Descripción</th>
                <th scope="col" style="min-width: 70px; ">Confidencialidad</th>
                <th scope="col" style="min-width: 70px; ">Disponibilidad</th>
                <th scope="col" style="min-width: 70px; ">Integridad</th>
            </tr>
        </thead>
        <tbody>
            @if (is_array($escenarios) || is_object($escenarios))
                @foreach ($escenarios as $escenario)
                    @foreach ($escenario as $e)
                        @php
                            if (isset($e->confidencialidad)) {
                                array_push($promedioConfidencialidad, $e->confidencialidad);
                                array_push($promedioDisponibilidad, $e->disponibilidad);
                                array_push($promedioIntegridad, $e->integridad);
                            }
                            $colorConfidencialidad = $this->obtenerColores($e->confidencialidad);
                            $colorIntegridad = $this->obtenerColores($e->integridad);
                            $colorDisponibilidad = $this->obtenerColores($e->disponibilidad);

                        @endphp
                        <tr>
                            <th scope="row" style="font-size: 8pt;">{{ $e->nom_escenario }}</th>
                            <td style="font-size: 8pt;">{{ $e->descripcion }}</td>
                            <td
                                style="font-size: 8pt; background-color:{{ $colorConfidencialidad['color'] }};color:{{ $colorConfidencialidad['colorTxt'] }}">
                                <div style="text-align: center">{{ $e->confidencialidad }}</div>
                            </td>
                            <td
                                style="font-size: 8pt; background-color:{{ $colorDisponibilidad['color'] }};color:{{ $colorDisponibilidad['colorTxt'] }}">
                                <div style="text-align: center">{{ $e->disponibilidad }}</div>
                            </td>
                            <td
                                style="font-size: 8pt; background-color:{{ $colorIntegridad['color'] }}; color:{{ $colorIntegridad['colorTxt'] }}">
                                <div style="text-align: center">{{ $e->integridad }}</div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>
    @php
        $promedioConfidencialidad1 = round(array_sum($promedioConfidencialidad) / (count($promedioConfidencialidad) > 0 ? count($promedioConfidencialidad) : 1));
        $promedioDisponibilidad1 = round(array_sum($promedioDisponibilidad) / (count($promedioDisponibilidad) > 0 ? count($promedioDisponibilidad) : 1));
        $promedioIntegridad1 = round(array_sum($promedioIntegridad) / (count($promedioIntegridad) > 0 ? count($promedioIntegridad) : 1));
        $probabilidad = round(($promedioConfidencialidad1 + $promedioIntegridad1 + $promedioIntegridad1) / 3);
    @endphp
    <input id="copia_probabilidad" type="hidden" value='{{ $probabilidad }}' />
@else
    <div class="form-group col-12">
        <div class="row">
            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="proceso_id" class="required"> <i
                        class="far fa-calendar-alt iconos-crear"></i>Proceso</label>
                <select class="form-control" id="proceso_id" name="proceso_id" wire:model.blur="procesoId" required>
                    <option value="">-- Seleccionar Proceso --</option>
                    @foreach ($procesos as $proceso)
                        <option value="{{ $proceso->id }}">{{ $proceso->proceso->codigo }}-
                            {{ $proceso->proceso->nombre }}
                        </option>
                    @endforeach

                </select>

            </div>
            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="fecharegistro"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha y hora de
                    levantamiento</label>
                <input class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}"
                    type="datetime-local" name="fecharegistro" id="fecharegistro"
                    value="{{ old('fecharegistro') }}">
                @if ($errors->has('fecharegistro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecharegistro') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="valor_criticidad"><i class="fas fa-exclamation-triangle iconos-crear"></i>Impacto del
                    riesgo
                    evaluado</label>
                <div class="form-control" id="valorCriticidadTxt" style="text-align: center;"> {{ $impacto }}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="valor_probabilidad"><i class="fas fa-exclamation-triangle iconos-crear"></i>Probabilidad
                    del
                    riesgo evaluado</label>
                <div class="form-control" id="valor_probabilidad"></div>
            </div>
        </div>

        <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
            <thead>

                <tr>
                    <th>Probabilidad</th>
                    <th>1.Muy Bajo</th>
                    <th>2.Bajo</th>
                    <th>3.Medio</th>
                    <th>4.Alto</th>
                    <th>5.Crítico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        5. Muy probable
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-1-5">
                        Medio (5)
                    </td>
                    <td style="background-color:rgb(255, 194, 124);text-align:center !important;"
                        class="coordenada-2-5">
                        Alto (10)
                    </td>
                    <td style="background-color:rgb(255, 194, 124);text-align:center !important;"
                        class="coordenada-3-5">
                        Alto (15)
                    </td>
                    <td style="background-color:rgb(228, 130, 130);text-align:center !important;"
                        class="coordenada-4-5">
                        Crítico (20)
                    </td>
                    <td style="background-color:rgb(228, 130, 130);text-align:center !important;"
                        class="coordenada-5-5">
                        Crítico (25)
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        4. Probable
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-1-4">
                        Medio (4)
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-2-4">
                        Medio (8)
                    </td>
                    <td style="background-color:rgb(255, 194, 124); text-align:center !important;"
                        class="coordenada-3-4">
                        Alto (12)
                    </td>
                    <td style="background-color:rgb(255, 194, 124); text-align:center !important;"
                        class="coordenada-4-4">
                        Alto (16)
                    </td>
                    <td style="background-color:rgb(228, 130, 130); text-align:center !important;"
                        class="coordenada-5-4">
                        Crítico (20)
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        3. Posible
                    </td>
                    <td style="background-color:rgb(133, 236, 142); text-align:center !important;"
                        class="coordenada-1-3">
                        Bajo (3)
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-2-3">
                        Medio (6)
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-3-3">
                        Medio (9)
                    </td>
                    <td style="background-color:rgb(255, 194, 124); text-align:center !important;"
                        class="coordenada-4-3">
                        Alto (12)
                    </td>
                    <td style="background-color:rgb(255, 194, 124); text-align:center !important;"
                        class="coordenada-5-3">
                        Alto (15)
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        2. Poco Probable
                    </td>
                    <td style="background-color:rgb(133, 236, 142); text-align:center !important;"
                        class="coordenada-1-2">
                        Bajo (2)
                    </td>
                    <td style="background-color:rgb(133, 236, 142); text-align:center !important;"
                        class="coordenada-2-2">
                        Bajo (4)
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-3-2">
                        Medio (6)
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-4-2">
                        Medio (8)
                    </td>
                    <td style="background-color:rgb(255, 194, 124); text-align:center !important;"
                        class="coordenada-5-2">
                        Alto (10)
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        1. Improbable
                    </td>
                    <td style="background-color:rgb(103, 207, 111); text-align:center !important;"
                        class="coordenada-1-1">
                        Muy Bajo (1)
                    </td>
                    <td style="background-color:rgb(133, 236, 142); text-align:center !important;"
                        class="coordenada-2-1">
                        Bajo (2)
                    </td>
                    <td style="background-color:rgb(133, 236, 142); text-align:center !important;"
                        class="coordenada-3-1">
                        Bajo (3)
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-4-1">
                        Medio (4)
                    </td>
                    <td style="background-color:rgb(240, 240, 150); text-align:center !important;"
                        class="coordenada-5-1">
                        Medio (5)
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table w-100 mt-4 mb-4" id="contactos_externos_table" style="width:100%">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">Descripción</th>

                </tr>
            </thead>
            <tbody id="contenedor_contactos_externos">
                <tr>
                    <th>Muy alto</th>
                    <th style="background-color:rgb(240, 240, 150);">Riesgo catastrófico que puede afectar la
                        permanencia
                        del n_registro
                        y que genera impactos graves.
                    </th>
                </tr>
                <tr>
                    <th>Alto</th>
                    <th style="background-color:rgb(240, 240, 150);">Riesgo intolerable para la organización que genera
                        impactos relevantes.
                    </th>
                </tr>
                <tr>
                    <th>Medio</th>
                    <th style="background-color:rgb(240, 240, 150);">Riesgo moderado para la organización que genera
                        impactos significativos.
                    </th>
                </tr>
                <tr>
                    <th>Bajo</th>
                    <th style="background-color:rgb(240, 240, 150);">Riesgo tolerable para la organización que no
                        genera
                        impactos significativos.
                    </th>
                </tr>
                <tr>
                    <th>Muy bajo</th>
                    <th style="background-color:rgb(240, 240, 150);">Sin riesgo para la organización y no genera algún
                        impacto significativo.
                    </th>
                </tr>
            </tbody>
        </table>

        <div class="col-12">
            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                1. Clasificación del Activo relacionado
            </div>
        </div>
        {{-- Tabla Clasificación del Activo --}}
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 100px;">ID Activo</th>
                        <th scope="col" style="min-width: 400px;">Nombre</th>
                        <th scope="col" style="min-width: 150px;">Criticidad</th>
                        <th scope="col" style="min-width: 150px;">Confidencialidad</th>
                    </tr>
                </thead>
                <tbody>

                    @if (is_array($activos) || is_object($activos))
                        @foreach ($activos as $activo)
                            @php

                                $txtConfidencialidad = $this->obtenerTextoActivo($activo->confidencialidad_id);

                            @endphp
                            <tr>
                                <th scope="row">{{ $activo->identificador }}</th>
                                <td>{{ $activo->activo_informacion }}</td>
                                <td>{{ $activo->valor_criticidad }}</td>
                                <td>{{ $activo->confidencialidad_id }} - {{ $txtConfidencialidad['txtvalor'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="col-12">
            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                2. Evaluación del riesgo a Aceptar
            </div>
        </div>

        <div class="col-12">
            <div class="text-center form-group"
                style="background-color:#c8cfdb; border-radius: 100px; color: rgb(8, 8, 8);">
                Impacto del Riesgo
            </div>
        </div>
        {{-- Tabla Impacto del Riesgo --}}
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 200px;">Criterio</th>
                        <th scope="col" style="min-width: 100x;">Valor</th>
                        <th scope="col" style="min-width: 400px;">Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Impacto Legal</th>
                        <td style="color:{{ $legalTxtColor }}; background-color:{{ $legalColor }}">
                            {{ $legal }}</td>
                        <td>{{ $legalTxt }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Impacto Cumplimiento</th>
                        <td style="color:{{ $cumplimientoTxtColor }}; background-color:{{ $cumplimientoColor }}">
                            {{ $cumplimiento }}</td>
                        <td>{{ $cumplimientoTxt }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Impacto Operacional</th>
                        <td style="color:{{ $operacionalTxtColor }}; background-color:{{ $operacionalColor }}">
                            {{ $operacional }}</td>
                        <td>{{ $operacionalTxt }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Impacto Reputacional</th>
                        <td style="color:{{ $reputacionalTxtColor }}; background-color:{{ $reputacionalColor }}">
                            {{ $reputacional }}</td>
                        <td>{{ $reputacionalTxt }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Impacto Tecnológico</th>
                        <td style="color:{{ $tecnologicoTxtColor }}; background-color:{{ $tecnologicoColor }}">
                            {{ $tecnologico }}</td>
                        <td>{{ $tecnologicoTxt }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12">
            <div class="text-center form-group"
                style="background-color:#c8cfdb; border-radius: 100px; color: rgb(8, 8, 8);">
                Escenarios de Riesgo
            </div>
        </div>
        {{-- Tabla Escenarios de Riesgo --}}
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 100px;">Escenario</th>
                        <th scope="col" style="min-width: 500x; ">Descripción</th>
                        <th scope="col" style="min-width: 70px; ">Confidencialidad</th>
                        <th scope="col" style="min-width: 70px; ">Disponibilidad</th>
                        <th scope="col" style="min-width: 70px; ">Integridad</th>
                    </tr>
                </thead>
                <tbody>
                    @if (is_array($escenarios) || is_object($escenarios))
                        @foreach ($escenarios as $escenario)
                            @foreach ($escenario as $e)
                                @php
                                    if (isset($e->confidencialidad)) {
                                        array_push($promedioConfidencialidad, $e->confidencialidad);
                                        array_push($promedioDisponibilidad, $e->disponibilidad);
                                        array_push($promedioIntegridad, $e->integridad);
                                    }
                                    $colorConfidencialidad = $this->obtenerColores($e->confidencialidad);
                                    $colorIntegridad = $this->obtenerColores($e->integridad);
                                    $colorDisponibilidad = $this->obtenerColores($e->disponibilidad);

                                @endphp
                                <tr>
                                    <th scope="row" style="font-size: 8pt;">{{ $e->nom_escenario }}</th>
                                    <td style="font-size: 8pt;">{{ $e->descripcion }}</td>
                                    <td
                                        style="font-size: 8pt; background-color:{{ $colorConfidencialidad['color'] }};color:{{ $colorConfidencialidad['colorTxt'] }}">
                                        <div style="text-align: center">{{ $e->confidencialidad }}</div>
                                    </td>
                                    <td
                                        style="font-size: 8pt; background-color:{{ $colorDisponibilidad['color'] }};color:{{ $colorDisponibilidad['colorTxt'] }}">
                                        <div style="text-align: center">{{ $e->disponibilidad }}</div>
                                    </td>
                                    <td
                                        style="font-size: 8pt; background-color:{{ $colorIntegridad['color'] }}; color:{{ $colorIntegridad['colorTxt'] }}">
                                        <div style="text-align: center">{{ $e->integridad }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
            @php
                $promedioConfidencialidad1 = round(array_sum($promedioConfidencialidad) / (count($promedioConfidencialidad) > 0 ? count($promedioConfidencialidad) : 1));
                $promedioDisponibilidad1 = round(array_sum($promedioDisponibilidad) / (count($promedioDisponibilidad) > 0 ? count($promedioDisponibilidad) : 1));
                $promedioIntegridad1 = round(array_sum($promedioIntegridad) / (count($promedioIntegridad) > 0 ? count($promedioIntegridad) : 1));
                $probabilidad = round(($promedioConfidencialidad1 + $promedioIntegridad1 + $promedioIntegridad1) / 3);
            @endphp
            <input id="copia_probabilidad" type="hidden" value='{{ $probabilidad }}' />

        </div>

    </div>

@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            renderizarResultados();
        }, 1000);
        document.getElementById('proceso_id').addEventListener('change', function(e) {
            console.log('index');
            e.preventDefault();
            setTimeout(() => {
                renderizarResultados();
            }, 1000);

        })

        function renderizarResultados() {
            let probabilidad = document.getElementById('copia_probabilidad').value;
            let impacto = @this.get('impacto');
            let coordenada = `.coordenada-${impacto}-${probabilidad}`;
            console.log(coordenada);
            if (document.querySelector(coordenada) != null) {
                let pin = document.createElement('i');
                pin.style.position = 'absolute';
                pin.style.top = '5px';
                pin.style.right = '10px';
                pin.style.color = '#345183';
                pin.classList.add('fas');
                pin.classList.add('fa-thumbtack');
                document.querySelector(coordenada).appendChild(pin);
                document.querySelector(coordenada).style.border = '2px solid #345183';
                document.querySelector(coordenada).style.position = 'relative';

            }
            let tipo = @this.get('tipo');
            let color = obtenerColores(probabilidad);
            let valorProbabilidad = probabilidad;
            if (tipo == 'show') {
                valorProbabilidad =
                    `<i style="font-size:10px; color:${color}" class="mr-1 fas fa-circle"></i>${probabilidad}`;
            }
            document.getElementById('valor_probabilidad').innerHTML = valorProbabilidad;
            let colorImpacto = obtenerColores(impacto);
            document.getElementById('circuloImpacto').style.color = colorImpacto;
        }

        function obtenerColores(sumatoria) {
            let color = "";
            if (sumatoria <= 1) {
                color = "green";
            }
            if (sumatoria == 2) {
                color = "rgb(50, 205, 63)"
            }
            if (sumatoria == 3) {
                color = "yellow"
            }
            if (sumatoria == 4) {
                color = "orange"
            }
            if (sumatoria == 5) {
                color = "red"
            }
            return color;
        }

        // let btnShow = document.querySelector('button');
        // let result = document.querySelector('h1');
        // btnShow.addEventListener('click', () =>{
        //     let selected = document.querySelector('input[type="radio"]:checked');
        //     result.innerText = selected.value;
        // });

    })
</script>
