<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div>
        <table>
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Control
                    </th>
                    <th>
                        Clasificación
                    </th>
                    <th>
                        Responsable
                    </th>
                    <th>
                        Aprobador
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($array_asignados as $keyAs => $as)
                <tr>
                    <td>
                        {{$as['gapdos']['control_iso']}}
                    </td>
                    <td>
                        {{$as['gapdos']['anexo_politica']}}
                    </td>
                    <td>
                        {{$as['gapdos']['nombre_clasificacion']}}
                    </td>
                    <td>
                        <select wire:model="array_asignados.{{ $keyAs }}.responsable.id">
                            <option value="">
                                Eliga un Colaborador
                            </option>
                            @foreach ($empleados as $keyEmp => $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:model="array_asignados.{{ $keyAs }}.aprobador.id">
                            <option value="">
                                Eliga un Colaborador
                            </option>
                            @foreach ($empleados as $keyEmp => $empleado)
                                <option value="{{ $empleado->id }}">
                                    {{ $empleado->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
