<div>
    <div class="card-body card">
        <x-loading-indicator />
        <div class="row">
            <div class="col-md-3 form-group">
                <label class="form-label">Proyecto</label>
                <select class="form-control" wire:model="selectedProjectId">
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
            <table id="datatabletimesheetproyectosfinancieros" class="table w-100 tabla-animada">
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
                            <td colspan="your_column_span">Seleccione el proyecto</td>
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
        document.addEventListener('livewire:load', () => {
            Livewire.on('afterLivewireUpdate', () => {
                setTimeout(() => {
                    tablaLivewire('datatabletimesheetproyectosfinancieros');
                    console.log("chale");
                }, 1000); // Esperar 1 segundo (ajusta este valor según sea necesario)
            });
        });

        function tablaLivewire(id_tabla) {
            $(function() {
                let dtButtons = [{
                        extend: 'csvHtml5',
                        title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar CSV',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Imprimir',
                        customize: function(doc) {

                            $(doc.document.body).find('table')
                                .css('font-size', '12px')
                                .css('margin-top', '15px')
                            $(doc.document.body).find('th').each(function(index) {
                                $(this).css('font-size', '18px');
                                $(this).css('color', '#fff');
                                $(this).css('background-color', 'blue');
                            });
                        },
                        title: '',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Seleccionar Columnas',
                    },
                    {
                        extend: 'colvisGroup',
                        text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        show: ':hidden',
                        titleAttr: 'Ver todo',
                    },
                    {
                        extend: 'colvisRestore',
                        text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Restaurar a estado anterior',
                    }
                ];
                let dtOverrideGlobals = {
                    buttons: dtButtons,
                    destroy: true,
                    render: true,
                    paging: true, // Enable pagination
                    pageLength: 10, // Set the number of records per page
                    lengthMenu: [5, 10, 25, 50, 100], // Define available page lengths
                };
                let table = $('#' + id_tabla).DataTable(dtOverrideGlobals);
            });
        }
    </script>

</div>
