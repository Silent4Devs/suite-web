<div>

    <div class="mt-3 ml-3">
        <span wire:loading wire:target="perPage" class="text-muted"><i class="fas fa-spinner fa-pulse"></i> Obteniendo
            Información</span>
        <span wire:loading wire:target="search" class="text-muted"><i class="fas fa-spinner fa-pulse"></i> Buscando
            ...</span>
    </div>
    <div class="container">
        <div wire:ignore class="container pl-0 datatable-fix">
            <table class="table table-bordered w-100 datatable-Activo tabla-fija" id="tblResumen"
                style="font-size: 10px;">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" colspan="9">
                            Resultados de la evaluación
                        </th>
                        <th class="text-center" colspan="{{ count($competencias_evaluadas) }}">
                            Competencias
                        </th>
                        <th class="text-center" colspan="{{ $objetivos_evaluados }}">
                            Objetivos
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: top;" class="celdas-colaborador">Colaborador</th>
                        <th style="vertical-align: top;" class="celdas-puesto">Puesto / Área</th>
                        {{-- <th style="vertical-align: top;">Área</th> --}}
                        <th style="vertical-align: top;" class="celdas-evaluacion">Evaluador(es)</th>
                        <th style="vertical-align: top;">Peso Competencias(%)</th>
                        <th style="vertical-align: top;">Peso Objetivos(%)</th>
                        <th style="vertical-align: top;">Competencias</th>
                        <th style="vertical-align: top;">Objetivos</th>
                        <th style="vertical-align: top;">Calificación</th>
                        <th style="vertical-align: top;">Nivel</th>
                        @foreach ($competencias_evaluadas as $competencia)
                            <th style="vertical-align: top;">{{ $competencia->nombre }}</th>
                        @endforeach
                        @for ($i = 1; $i <= $objetivos_evaluados; $i++)
                            <th style="vertical-align: top;">Objetivo {{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lista as $evaluado)
                        <tr>
                            <td style="text-align: left !important" class="celdas-colaborador">
                                {{ $evaluado['evaluado'] }}</td>
                            <td class="celdas-puesto"><span
                                    class="badge badge-primary">{{ $evaluado['puesto'] }}</span><br><span
                                    class="badge badge-success">{{ $evaluado['area'] }}</span></td>
                            {{-- <td>{{ $evaluado['area'] }}</td> --}}
                            <td class="celdas-evaluacion">
                                <div class="flex-wrap d-flex">
                                    @foreach ($evaluado['informacion_evaluacion']['evaluadores'] as $evaluador)
                                        @if ($evaluado['evaluado'] != $evaluador->name)
                                            <span class="badge badge-secondary">{{ $evaluador->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            @php
                                $promedio_competencias = ($evaluado['informacion_evaluacion']['promedio_competencias'] * 100) / $evaluado['informacion_evaluacion']['peso_general_competencias'];
                                $promedio_objetivos = ($evaluado['informacion_evaluacion']['promedio_general_objetivos'] * 100) / $evaluado['informacion_evaluacion']['peso_general_objetivos'];
                            @endphp
                            <td>{{ $evaluado['informacion_evaluacion']['peso_general_competencias'] }}%</td>
                            <td>{{ $evaluado['informacion_evaluacion']['peso_general_objetivos'] }}%</td>
                            <td class="p-0" style="position: relative;">
                                <div
                                    style="width: {{ round($promedio_competencias) }}%;max-width: 100%;height: 100%;background: #5AFF94;">
                                </div>
                                <span
                                    style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ round($evaluado['informacion_evaluacion']['promedio_competencias']) }}%
                                </span>
                            </td>
                            <td class="p-0" style="position: relative;">
                                <div
                                    style="width: {{ $promedio_objetivos }}%;max-width: 100%;height: 100%;background: #5AFF94;">
                                </div>
                                <span
                                    style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ round($evaluado['informacion_evaluacion']['promedio_general_objetivos']) }}%</span>
                            </td>
                            <td class="p-0" style="position: relative;">
                                <div
                                    style="width: {{ round($evaluado['informacion_evaluacion']['calificacion_final']) }}%;max-width: 100%;height: 100%;background: #5AD7FF;">
                                </div>
                                <span
                                    style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ round($evaluado['informacion_evaluacion']['calificacion_final']) }}%</span>
                            </td>
                            @foreach ($rangos as $parametro => $valor)
                                @if ($evaluado['informacion_evaluacion']['calificacion_final'] <= $valor)
                                    <td
                                        style="background-color:{{ $colores[$parametro] }};color:white;text-align: center !important">
                                        <i class="mr-1 fas fa-exclamation-triangle"></i>{{ $parametro }}
                                    </td>
                                @elseif ($valor == $maxValue && $evaluado['informacion_evaluacion']['calificacion_final'] > $valor)
                                    <td
                                        style="background-color:{{ $colores[$parametro] }};color:white;text-align: center !important">
                                        <i class="mr-1 fas fa-exclamation-triangle"></i>{{ $parametro }}
                                    </td>
                                @endif
                            @endforeach

                            {{-- @if ($evaluado['informacion_evaluacion']['calificacion_final'] <= $rangos['inaceptable'])
                                    <td style="background-color:#ff4747;color:white;text-align: center !important"><i
                                            class="mr-1 fas fa-exclamation-triangle"></i>Inaceptable</td>
                                @elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= $rangos['minimo_aceptable'])
                                    <td style="background-color:#e89036;color:white;text-align: center !important"><i
                                            class="mr-1 fas fa-exclamation-triangle"></i>Mínimo Aceptable</td>
                                @elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= $rangos['aceptable'])
                                    <td style="background-color:#3e6cd2;color:white;text-align: center !important"><i
                                            class="mr-1 fas fa-check-circle"></i>Aceptable
                                    </td>
                                @elseif($evaluado['informacion_evaluacion']['calificacion_final'] > $rangos['sobresaliente'])
                                    <td style="background-color:#5AFF94;color:white;text-align: center !important">
                                        <i class="mr-1 fas fa-check-circle"></i>
                                        Sobresaliente
                                    </td>
                                @endif --}}
                            </td>
                            @foreach ($competencias_evaluadas as $competencia)
                                @php
                                    $collect_calificaciones = collect();
                                    $calificacion_auto_evaluaciones = $evaluado['informacion_evaluacion']['lista_autoevaluacion']->first()['evaluaciones']->first();
                                    if ($calificacion_auto_evaluaciones) {
                                        $calificacion_auto = $calificacion_auto_evaluaciones['competencias']
                                            ->filter(function ($competencia_it) use ($competencia) {
                                                return $competencia_it['id_competencia'] == $competencia->id;
                                            })
                                            ->first();
                                        if ($calificacion_auto) {
                                            $calificacion_auto_promedio = ($calificacion_auto['calificacion'] / $calificacion_auto['meta']) * 100;
                                            $collect_calificaciones->push($calificacion_auto_promedio * ($calificacion_auto['peso'] / 100));
                                        }
                                    }

                                    $calificacion_jefe_evaluaciones = $evaluado['informacion_evaluacion']['lista_jefe_inmediato']->first()['evaluaciones']->first();
                                    if ($calificacion_jefe_evaluaciones) {
                                        $calificacion_jefe = $calificacion_jefe_evaluaciones['competencias']
                                            ->filter(function ($competencia_it) use ($competencia) {
                                                return $competencia_it['id_competencia'] == $competencia->id;
                                            })
                                            ->first();
                                        if ($calificacion_jefe) {
                                            $calificacion_jefe_promedio = ($calificacion_jefe['calificacion'] / $calificacion_jefe['meta']) * 100;
                                            $collect_calificaciones->push($calificacion_jefe_promedio * ($calificacion_auto['peso'] / 100));
                                        }
                                    }

                                    $calificacion_equipo_evaluaciones = $evaluado['informacion_evaluacion']['lista_equipo_a_cargo']->first()['evaluaciones']->first();
                                    if ($calificacion_equipo_evaluaciones) {
                                        $calificacion_equipo = $calificacion_equipo_evaluaciones['competencias']
                                            ->filter(function ($competencia_it) use ($competencia) {
                                                return $competencia_it['id_competencia'] == $competencia->id;
                                            })
                                            ->first();
                                        if ($calificacion_equipo) {
                                            $calificacion_equipo_promedio = ($calificacion_equipo['calificacion'] / $calificacion_equipo['meta']) * 100;
                                            $collect_calificaciones->push($calificacion_equipo_promedio * ($calificacion_auto['peso'] / 100));
                                        }
                                    }

                                    $calificacion_area_evaluaciones = $evaluado['informacion_evaluacion']['lista_misma_area']->first()['evaluaciones']->first();
                                    if ($calificacion_area_evaluaciones) {
                                        $calificacion_area = $calificacion_area_evaluaciones['competencias']
                                            ->filter(function ($competencia_it) use ($competencia) {
                                                return $competencia_it['id_competencia'] == $competencia->id;
                                            })
                                            ->first();
                                        if ($calificacion_area) {
                                            $calificacion_area_promedio = ($calificacion_area['calificacion'] / $calificacion_area['meta']) * 100;
                                            $collect_calificaciones->push($calificacion_area_promedio * ($calificacion_auto['peso'] / 100));
                                        }
                                    }

                                    $promedio = 0;
                                    foreach ($collect_calificaciones as $calif) {
                                        $promedio += $calif;
                                    }

                                    if (count($collect_calificaciones)) {
                                        $promedio = number_format($promedio, 2);
                                    } else {
                                        $promedio = number_format($promedio / 1, 2);
                                    }
                                @endphp
                                <td class="p-0" style="position: relative;">
                                    @if (count($collect_calificaciones))
                                        <div
                                            style="width: {{ $promedio }}%;max-width: 100%;height: 100%;background: #5AFF94;">
                                        </div>
                                        <span
                                            style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ $promedio }}%</span>
                                    @else
                                        <span
                                            style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">N/A
                                        </span>
                                    @endif
                                </td>
                            @endforeach
                            @for ($i = 0; $i < $objetivos_evaluados; $i++)
                                <td class="p-0" style="position: relative; text-align: left">
                                    @if (isset($evaluado['informacion_evaluacion']['evaluadores_objetivos'][0]['objetivos'][$i]))
                                        @php
                                            $objetivo_info = $evaluado['informacion_evaluacion']['evaluadores_objetivos'][0]['objetivos'][$i];
                                            $avance_porcentaje = number_format(($objetivo_info['calificacion'] * 100) / ($objetivo_info['meta'] > 0 ? $objetivo_info['meta'] : 1), 2);
                                        @endphp
                                        <div
                                            style="width: {{ $avance_porcentaje }}%;max-width: 100%;height: 100%;background: #5AFF94;">
                                        </div>
                                        <span title="{{ $objetivo_info['nombre'] }}"
                                            style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;text-align: left;">{{ Str::limit($objetivo_info['nombre'], 20, '...') }}
                                            <strong>({{ $avance_porcentaje }}%)</strong>
                                        </span>
                                    @else
                                        <span
                                            style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">N/A
                                        </span>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @empty
                        No se encontraron registros
                    @endforelse
                </tbody>
            </table>
            {{-- {{ $lista->links() }} --}}
        </div>
    </div>
</div>
