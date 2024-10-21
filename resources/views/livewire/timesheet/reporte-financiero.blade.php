<div>
    <div class="card-body card">
        <x-loading-indicator />
        <div class="row">
            <div class="col-md-3 form-group">
                <label class="form-label">Proyecto</label>
                <select class="form-control" wire:model.live="selectedProjectId">
                    <option selected value="0">
                        Selecciona un proyecto
                    </option>
                    @foreach ($proyectos_select as $proyect)
                        <option value="{{ $proyect->id }}">
                            {{ $proyect->identificador }} - {{ $proyect->proyecto }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
        </div>
    </div>


    <div class="card card-body">
        <div class="datatable-fix w-100">
            <table id="reportesfinancieros" class="table w-100 tabla-animada">
                <thead class="w-100">
                    <tr>
                        <th>ID </th>
                        <th>Nombre del proyecto </th>
                        <th>Cliente</th>
                        <th>Área(s)</th>
                        <th>Empleados participantes</th>
                        <th>Horas del empleado</th>
                        <th>Costo total del empleado</th>
                        <th>Estatus</th>
                        <th>Horas totales del proyecto</th>
                        <th>Costo total del proyecto</th>
                    </tr>
                </thead>

                <tbody>
                    @if (empty($proyectos))
                        <tr>
                            <td >Seleccione el proyecto</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($proyectos as $proyecto)
                            <tr>
                                <td><strong> {{ $proyecto['identificador'] }} </strong></td>
                                <td>{{ $proyecto['proyecto'] }} </td>
                                <td>{{ $proyecto['cliente'] }} </td>
                                <td>{{ $proyecto['area'] }} </td>
                                <td>{{ $proyecto['name'] }} </td>
                                <td>{{ $proyecto['horasEmpleado'] }} <small>h</small></td>
                                <td> $ {{ $proyecto['costoHoraEmpleado'] }} </td>
                                <td>{{ $proyecto['estatus'] }} </td>
                                <td>{{ $proyecto['horaTotal'] }} h</td>
                                <td> $ {{ $proyecto['costoTotal'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                setTimeout(() => {
                    console.log('liwe');
                    tablaLivewire('reportesfinancieros');
                }, 100);
            });
        });
    </script>

</div>
