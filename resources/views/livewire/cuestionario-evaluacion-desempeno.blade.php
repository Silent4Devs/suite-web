<div>
    {{-- Stop trying to control. --}}
    <div class="w-100 row">
        <table class="datatable-rds">
            <thead>
                <th>Objetivo</th>
                {{-- <th>Habilitado</th> --}}
                <th>Métrica</th>
                @foreach ($escalas as $escala)
                    <th style="background-color: {{ $escala->color }}">
                        {{ $escala->parametro }}
                    </th>
                @endforeach
                <th>AutoEvaluación</th>
                <th>Cargar Evidencias</th>
                <th>Evaluación</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                @foreach ($objetivos_evaluado as $key => $obj_evld)
                    <tr>
                        <td>{{ $obj_evld->objetivo }}</td>
                        <td>
                            <select name="aplica" id="aplica">
                                <option value="true">Aplica</option>
                                <option value="false">No Aplica</option>
                            </select>
                        </td>
                        @foreach ($escalas as $escala)
                            <th style="background-color: {{ $escala->color }}">
                                {{ $escala->parametro }}
                            </th>
                        @endforeach
                        <td>Sin Evaluar</td>
                        <td>Evidencia</td>
                        <td>
                            <input id="evaluacion.{{ $key }}" type="number" required>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
