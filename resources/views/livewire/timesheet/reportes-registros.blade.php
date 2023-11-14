<div>
    <div class="mt-5 card card-body">
        <x-loading-indicator />
        <div class="row">
            <div class="col-md-4 form-group" style="padding-left:0px !important;">
                <label class="form-label">Área</label>
                <select class="form-control" wire:model="area_id">
                    <option selected value="0">Todas</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Fecha de inicio</label>
                <input class="form-control date_librery" type="date" name="fecha_inicio" wire:model="fecha_inicio">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Fecha de fin</label>
                <input class="form-control date_librery" type="date" name="fecha_fin" wire:model="fecha_fin">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group" style="padding-left:0px !important;">
                <label class="form-label">Colaborador</label>
                <select class="form-control" wire:model="emp_id">
                    <option selected value="0">Todos</option>
                    @foreach ($emp as $em)
                        <option value="{{ $em->id }}">{{ $em->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-5">
            @include('partials.flashMessages')
            <div class="col-12 d-flex justify-content-between"
                style="padding-left: 0 !important; padding-right: 0 !important;">
                <h5 id="titulo_estatus">Registros Timesheet</h5>
                <div class="btn_estatus_caja">
                    <button class="btn btn-primary"
                        style="background-color: #5AC3E5; border:none !important; position: relative;" id="btn_todos"
                        wire:click="todos">
                        @if ($todos_contador > 0)
                            <span class="indicador_numero" style="filter: contrast(200%);">{{ $todos_contador }}</span>
                        @endif
                        Todos
                    </button>
                    <button class="btn btn-primary"
                        style="background-color: #aaa; border:none !important; position: relative;" id="btn_papelera"
                        wire:click="papelera">
                        @if ($borrador_contador > 0)
                            <span class="indicador_numero" style="filter: contrast(200%);">{{ $borrador_contador }}</span>
                        @endif
                        Borrador
                    </button>
                    <button class="btn btn-primary"
                        style="background-color: #F48C16; border:none !important; position: relative;" id="btn_pendiente"
                        wire:click="pendientes">
                        @if ($pendientes_contador > 0)
                            <span class="indicador_numero" style="filter: contrast(200%);">{{ $pendientes_contador }}</span>
                        @endif
                        Pendientes
                    </button>
                    <button class="btn btn-primary"
                        style="background-color: #61CB5C; border:none !important; position: relative;" id="btn_aprobado"
                        wire:click="aprobados">
                        @if ($aprobados_contador > 0)
                            <span class="indicador_numero" style="filter: contrast(200%);">{{ $aprobados_contador }}</span>
                        @endif
                        Aprobados
                    </button>
                    <button class="btn btn-primary"
                        style="background-color: #EA7777; border:none !important; position: relative;" id="btn_rechazado"
                        wire:click="rechazos">
                        @if ($rechazos_contador > 0)
                            <span class="indicador_numero" style="filter: contrast(200%);">{{ $rechazos_contador }}</span>
                        @endif
                        Rechazados
                    </button>
                </div>
            </div>
            <div class="row w-100 mt-4" style="align-items: end">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="row" style="justify-content: center">
                                <div class="col-4 p-0" style="font-size: 11px;align-self: center">
                                    <p class="m-0">Mostrando</p>
                                </div>
                                <div class="col-4 p-0">
                                    <select name="" id="" class="form-control" wire:model="perPage">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-4 p-0" style="font-size: 11px;align-self: center;text-align: end">
                                    <p class="m-0">por página</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <button id="" class="btn-sm rounded pr-2"
                                style="background-color:#b9eeb9; border: #fff" wire:click="exportExcel()">
                                <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"
                                    title="Exportar Excel"></i>
                                Exportar Excel
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-6 p-0" style="text-align: end">
                    <div class="row">
                        <div class="col-6 p-0"></div>
                        <div class="col-6 p-0">
                            <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="datatable-fix w-100 mt-2">
                <table class="table w-100 datatable_timesheet_registros_reportes">
                    {{-- id="datatable_timesheet" --}}
                    <thead class="w-100">
                        <tr>
                            <th>Fecha Inicio </th>
                            <th>Fecha Fin </th>
                            <th>Empleado</th>
                            <th>Aprobador</th>
                            <th style="min-width:250px;">Area</th>
                            <th>Estatus</th>
                            <th>Horas Totales</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time)
                            <tr class="tr_{{ $time->estatus }}">
                                {{-- <td>
                                    {!! $time->semana !!}
                                </td> --}}
                                <td>
                                    {!! $time->inicio !!}
                                </td>
                                <td>
                                    {!! $time->fin !!}
                                </td>
                                <td>
                                    @if ($time->empleado)
                                        {{ $time->empleado->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($time->aprobador)
                                        {{   $time->aprobador->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($time->empleado)
                                        {{ $time->empleado->area->area }}
                                    @endif
                                </td>
                                <td>
                                    @if ($time->estatus == 'aprobado')
                                        <span class="aprobado">Aprobada</span>
                                    @endif

                                    @if ($time->estatus == 'rechazado')
                                        <span class="rechazado">Rechazada</span>
                                    @endif

                                    @if ($time->estatus == 'pendiente')
                                        <span class="pendiente">Pendiente</span>
                                    @endif

                                    @if ($time->estatus == 'papelera')
                                        <span class="papelera">Borrador</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $time->total_horas }}
                                </td>
                                <td>
                                    <a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" title="Visualizar"
                                        class="btn"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="table w-100 datatable_timesheet_registros_reportes" id="reportes" hidden>
                    <thead class="w-100">
                        <tr>
                            <th>Fecha Inicio </th>
                            <th>Fecha Fin </th>
                            <th>Empleado</th>
                            <th>Aprobador</th>
                            <th style="min-width:250px;">Area</th>
                            <th>Estatus</th>
                            <th>Horas Totales</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (isset($timesExcel))
                            @foreach ($timesExcel as $timeEx)
                                <tr>
                                    <td>
                                        {!! $time->inicio !!}
                                    </td>
                                    <td>
                                        {!! $time->fin !!}
                                    </td>
                                    <td>
                                        @if ($timeEx->empleado)
                                            {{ $timeEx->empleado->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($timeEx->aprobador)
                                            {{   $timeEx->aprobador->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($timeEx->empleado)
                                            {{ $timeEx->empleado->area->area }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($timeEx->estatus == 'aprobado')
                                            <span class="aprobado">Aprobada</span>
                                        @endif

                                        @if ($timeEx->estatus == 'rechazado')
                                            <span class="rechazado">Rechazada</span>
                                        @endif

                                        @if ($timeEx->estatus == 'pendiente')
                                            <span class="pendiente">Pendiente</span>
                                        @endif

                                        @if ($timeEx->estatus == 'papelera')
                                            <span class="papelera">Borrador</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $timeEx->total_horas }}
                                    </td>
                                    <td>
                                        <a href="{{ asset('admin/timesheet/show') }}/{{ $timeEx->id }}" title="Visualizar"
                                            class="btn"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6 p-0">
                        <strong>
                            Mostrando {{ $perPage }} de {{ $totalRegistrosMostrando }} resultados @if ($estatus)
                                <span class="badge badge-primary">(filtrando por {{ $estatus }})</span>
                            @endif
                        </strong>
                    </div>
                    <div class="col-6 p-0" style="display: flex;justify-content: end">
                        {{ $times->links() }}

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                tablaLivewire('datatable_timesheet');
            });
        });
    </script>

    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>

    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>

    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <script>
        const $btnExportar = document.querySelector("#btnExportar"),
            $tabla = document.querySelector("#reportes");

        $btnExportar.addEventListener("click", function() {
            let tableExport = new TableExport($tabla, {
                exportButtons: false, // No queremos botones
                filename: "Reporte Timesheet", //Nombre del archivo de Excel
                sheetname: "Reporte", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            let preferenciasDocumento = datos.reportes.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);

        });
    </script>
</div>
