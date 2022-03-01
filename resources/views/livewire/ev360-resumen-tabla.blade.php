<div>
    <style>
        #tblResumen th:first-child {
            position: sticky;
            left: 0px;
            background-color: #343a40;
            z-index: 2;
        }

        #tblResumen td:first-child {
            position: sticky;
            left: 0px;
            background-color: #343a40;
            color: #fff;
            z-index: 2;
        }

        #tblResumen th:nth-child(2) {
            position: sticky;
            left: 60px;
            background-color: #343a40;
            z-index: 2;
        }

        #tblResumen td:nth-child(2) {
            position: sticky;
            left: 60px;
            background-color: #343a40;
            color: #fff;
            z-index: 2;
        }

        #tblResumen th:nth-child(3) {
            position: sticky;
            left: 140px;
            background-color: #343a40;
            z-index: 2;
        }

        #tblResumen td:nth-child(3) {
            position: sticky;
            left: 140px;
            background-color: #343a40;
            color: #fff;
            z-index: 2;
        }

    </style>
    <div class="mt-3 ml-2 row align-items-center">
        <div class="pl-2 col-6">
            <input type="text" class="form-control" placeholder="Buscar..." wire:model.debounce.800ms="search">
        </div>
        <div class="text-center col-3 d-flex align-items-center">
            <span class="mr-2" style="display: inline-block;">Mostrar</span>
            <select class="form-control" wire:model.debounce.800ms="perPage" style="display: inline-block; width:30%">
                <option value="1">1</option>
                <option value="5">5</option>
                <option value="10" selected="">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span class="ml-2">Página</span>
        </div>
    </div>
    <div class="mt-3 ml-3">
        <span wire:loading wire:target="perPage" class="text-muted"><i class="fas fa-spinner fa-pulse"></i> Obteniendo
            Información</span>
        <span wire:loading wire:target="search" class="text-muted"><i class="fas fa-spinner fa-pulse"></i> Buscando
            ...</span>
    </div>
    <div class="container">
        <div class="container pl-0 datatable-fix" style="overflow: auto">
            <table class="table table-bordered w-100 datatable-Activo" id="tblResumen" style="font-size: 10px;">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" colspan="10">
                            Resultados de la evaluación
                        </th>
                        <th class="text-center" colspan="{{ $competencias_evaluadas }}">
                            Competencias
                        </th>
                        <th class="text-center" colspan="{{ $objetivos_evaluados }}">
                            Objetivos
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: top;">Nombre</th>
                        <th style="vertical-align: top;">Puesto</th>
                        <th style="vertical-align: top;">Área</th>
                        <th style="vertical-align: top;">Evaluador(es)</th>
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
                            <td style="text-align: left !important">{{ $evaluado['evaluado'] }}</td>
                            <td>{{ $evaluado['puesto'] }}</td>
                            <td>{{ $evaluado['area'] }}</td>
                            <td>
                                <div class="flex-wrap d-flex">
                                    @foreach ($evaluado['informacion_evaluacion']['evaluadores'] as $evaluador)
                                        <img src="{{ asset('storage/empleados/imagenes/' . $evaluador->avatar) }}"
                                            class="rounded-circle" title="{{ $evaluador->name }}">
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $evaluado['informacion_evaluacion']['peso_general_competencias'] }} %</td>
                            <td>{{ $evaluado['informacion_evaluacion']['peso_general_objetivos'] }} %</td>
                            <td class="p-0" style="position: relative;">
                                <div
                                    style="width: {{ $evaluado['informacion_evaluacion']['promedio_general_competencias'] }}%;max-width: 100%;height: 100%;background: #3ebed2;">
                                </div>
                                <span
                                    style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ $evaluado['informacion_evaluacion']['promedio_general_competencias'] }}
                                    %</span>
                            </td>
                            <td class="p-0" style="position: relative;">
                                <div
                                    style="width: {{ $evaluado['informacion_evaluacion']['promedio_general_objetivos'] }}%;max-width: 100%;height: 100%;background: #3ebed2;">
                                </div>
                                <span
                                    style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ $evaluado['informacion_evaluacion']['promedio_general_objetivos'] }}
                                    %</span>
                            </td>
                            <td class="p-0" style="position: relative;">
                                <div
                                    style="width: {{ $evaluado['informacion_evaluacion']['calificacion_final'] }}%;max-width: 100%;height: 100%;background: #3ebed2;">
                                </div>
                                <span
                                    style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ $evaluado['informacion_evaluacion']['calificacion_final'] }}
                                    %</span>
                            </td>
                            @if ($evaluado['informacion_evaluacion']['calificacion_final'] <= 60)
                                <td style="background-color:#ff4747;color:white;text-align: center !important"><i
                                        class="mr-1 fas fa-exclamation-triangle"></i>Inaceptable</td>
                            @elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= 80)
                                <td style="background-color:#e89036;color:white;text-align: center !important"><i
                                        class="mr-1 fas fa-exclamation-triangle"></i>Mínimo
                                    Aceptable</td>
                            @elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= 100)
                                <td style="background-color:#3e6cd2;color:white;text-align: center !important"><i
                                        class="mr-1 fas fa-check-circle"></i>Aceptable
                                </td>
                            @elseif($evaluado['informacion_evaluacion']['calificacion_final'] > 100)
                                <td style="background-color:#3ed257;color:white;text-align: center !important">
                                    <i class="mr-1 fas fa-check-circle"></i>
                                    Sobresaliente
                                </td>
                            @endif
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
                                            $calificacion_auto_promedio = ($calificacion_auto['calificacion'] * 100) / $calificacion_auto['meta'];
                                            $collect_calificaciones->push($calificacion_auto_promedio);
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
                                            $calificacion_jefe_promedio = ($calificacion_jefe['calificacion'] * 100) / $calificacion_jefe['meta'];
                                            $collect_calificaciones->push($calificacion_jefe_promedio);
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
                                            $calificacion_equipo_promedio = ($calificacion_equipo['calificacion'] * 100) / $calificacion_equipo['meta'];
                                            $collect_calificaciones->push($calificacion_equipo_promedio);
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
                                            $calificacion_area_promedio = ($calificacion_area['calificacion'] * 100) / $calificacion_area['meta'];
                                            $collect_calificaciones->push($calificacion_area_promedio);
                                        }
                                    }
                                    $promedio = 0;
                                    foreach ($collect_calificaciones as $calif) {
                                        $promedio += $calif;
                                    }
                                    if (count($collect_calificaciones)) {
                                        $promedio = number_format($promedio / count($collect_calificaciones), 2);
                                    } else {
                                        $promedio = number_format($promedio / 1, 2);
                                    }
                                @endphp
                                <td class="p-0" style="position: relative;">
                                    @if (count($collect_calificaciones))
                                        <div
                                            style="width: {{ $promedio }}%;max-width: 100%;height: 100%;background: #56de4d;">
                                        </div>
                                        <span
                                            style="position: absolute;margin-left: auto;margin-right: auto;top: 13px;left: 6px;">{{ $promedio }}
                                            %</span>
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
                                            style="width: {{ $avance_porcentaje }}%;max-width: 100%;height: 100%;background: #56de4d;">
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
            {{ $lista->links() }}
        </div>
    </div>
</div>
