<div>
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
    <div class="container datatable-fix">
        <table class="table table-bordered w-100 datatable-Activo" id="tblResumen">
            <thead class="thead-dark">
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Área</th>
                <th>Evaluador(es)</th>
                <th>Competencias</th>
                <th>Objetivos</th>
                <th>Calificación</th>
                <th>Nivel</th>
            </thead>
            <tbody>
                @forelse ($lista as $evaluado)
                    <tr>
                        <td>{{ $evaluado['evaluado'] }}</td>
                        <td>{{ $evaluado['puesto'] }}</td>
                        <td>{{ $evaluado['area'] }}</td>
                        <td>
                            <div>
                                @foreach ($evaluado['informacion_evaluacion']['evaluadores'] as $evaluador)
                                    <img src="{{ asset('storage/empleados/imagenes/' . $evaluador->avatar) }}"
                                        class="rounded-circle" title="{{ $evaluador->name }}">
                                @endforeach
                            </div>
                        </td>
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
                            <td style="background-color:#ff4747">Inaceptable</td>
                        @elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <=80) <td
                                style="background-color:#e89036">Mínimo
                                Aceptable</td>
                            @elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <=100) <td
                                    style="background-color:#3e6cd2">Aceptable
                                    </td>
                                @elseif($evaluado['informacion_evaluacion']['calificacion_final']>100)
                                    <td style="background-color:#3ed257">Sobresaliente</td>
                        @endif
                        </td>
                    </tr>
                @empty
                    No se encontraron registros
                @endforelse
            </tbody>
        </table>
        {{ $lista->links() }}
    </div>
</div>
