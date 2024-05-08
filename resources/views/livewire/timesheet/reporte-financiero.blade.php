<div>
    <div class="card-body card">
        <x-loading-indicator />
        <div class="row">
            <div class="col-md-3 form-group">
                <label class="form-label">Proyecto</label>
                <select class="form-control">
                    <option selected value="0">
                        Selecciona un proyecto
                    </option>
                    @foreach ($proyectos as $proyect)
                        <option value="{{ $proyect->id }}">
                            {{ $proyect->identificador }} - {{ $proyect->proyecto }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="">&nbsp;</label>
                <div>
                    <button class="btn btn-secondary" wire:click="renderTable({{ $proyect->id }})">Buscar</button>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>


    <div class="card card-body">
        <div class="datatable-fix w-100">
            <table id="datatable_timesheet_proyectos_financiero" class="table w-100 tabla-animada">
                <thead class="w-100">
                    <tr>
                        <th>ID </th>
                        <th>Nombre del proyecto </th>
                        <th>Cliente</th>
                        <th style="max-width: 250px !important;">Área(s)</th>
                        <th style="max-width: 250px !important;">Empleados participantes</th>
                        <th>Horas del empleado</th>
                        <th>Costo total del empleado</th>
                        <th>Estatus</th>
                        <th>Horas totales del proyecto</th>
                        <th>Costo total del proyecto</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($proyectos as $proyecto)
                        <tr>
                            <td>
                                <strong> {{ $proyecto->identificador }} </strong>
                            </td>
                            <td>{{ $proyecto->proyecto }} </td>
                            <td>{{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }} </td>
                            <td>
                                <ul style="padding-left:10px; ">
                                    @foreach ($proyecto->areas as $area)
                                        <li>{{ $area->area }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul style="padding-left:10px; ">
                                    @foreach ($proyecto->empleados as $empleado)
                                        <li>
                                            {{ $empleado['name'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul style="padding-left:10px; ">
                                    @foreach ($proyecto->empleados as $empleado)
                                        <li>
                                            {{ $empleado['horas'] }} <small>h</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul style="padding-left:10px; ">
                                    @foreach ($proyecto->empleados as $empleado)
                                        <li>
                                            ${{ $empleado['costo_horas'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $proyecto->estatus }} </td>
                            <td>{{ $proyecto->horas_totales_llenas }} h</td>
                            <td>
                                @php
                                    $suma_costo = 0;
                                @endphp
                                @if (isset($proyectos->empleados))
                                    @foreach ($proyectos->empleados as $empleado)
                                        @php
                                            $suma_costo += $empleado['costo_horas'];
                                        @endphp
                                    @endforeach
                                @endif

                                ${{ $suma_costo }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
