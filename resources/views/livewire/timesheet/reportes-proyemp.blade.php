<div>
    <x-loading-indicator />
    <div class=" card card-body">
        <div class="row">
            <div class="col-md-3 form-group" style="padding-left:0px !important;">
                <label class="form-label">Colaborador</label>
                <select class="form-control" wire:model="emp_id">
                    <option selected value="0">Todos</option>
                    @foreach ($emp as $em)
                        <option value="{{ $em->id }}">{{ $em->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group" style="padding-left:0px !important;" wire:ignore>
                <label class="form-label">Proyecto</label>
                <select class="form-control" wire:model="proy_id">
                    <option selected value="0">Todos</option>
                    @foreach ($proy as $pro)
                        <option value="{{ $pro->id }}">{{ $pro->identificador }} - {{ $pro->proyecto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label">Fecha de inicio</label>
                <input class="form-control date_librery" type="date" name="fecha_inicio"
                    wire:model="fecha_inicio">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label">Fecha de fin</label>
                <input class="form-control date_librery" type="date" name="fecha_fin" wire:model="fecha_fin">
            </div>
        </div>
    </div>
    <div class="card card-body">
        <div class="row">
            @include('partials.flashMessages')
            <div class="col-12">
                <h5 id="titulo_estatus" class="title-card-time">Registros Proyectos</h5>
                <hr class="my-4">
            </div>
            <div class="d-flex align-items-center" style="gap: 20px;">
                <label for="">Mostrar registros</label>
                <select name="" id="" class="form-control" wire:model.blur="perPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <button id="" class="btn-sm rounded pr-2" style="background-color:#b9eeb9; border: #fff"
                    wire:click="exportExcel()">
                    <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935" title="Exportar Excel"></i>
                    Exportar&nbsp;Excel
                </button>
                <button id="" class="btn-sm rounded pr-2" style="background-color:#b9eeb9; border: #fff"
                    wire:click="refreshComponent">
                    <i class="fas fa-search" style="font-size: 1.1rem;"></i>
                    &nbsp;&nbsp; Buscar
                </button>
            </div>
            <div class="datatable-fix w-100 mt-2">
                <table class="table w-100">
                    <thead class="w-100">
                        <tr>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Empleado</th>
                            <th>Supervisor</th>
                            <th style="min-width:250px;">Proyecto</th>
                            <th>Tarea</th>
                            <th>Descripcion</th>
                            <th>Horas Totales de la Tarea</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($times as $time)
                            <tr class="tr_{{ $time->estatus }}">
                                <td>{!! $time->timesheet->inicio !!}</td>
                                <td>{!! $time->timesheet->fin !!}</td>
                                <td>{{ $time->timesheet->empleado->name }}</td>
                                <td>{{ $time->timesheet->aprobador->name }}</td>
                                <td>{{ $time->proyecto }}</td>
                                <td>{{ $time->tarea }}</td>
                                <td>{{ $time->descripcion }}</td>
                                <td>
                                    {{ $time->horas_totales_tarea }} h
                                </td>
                            </tr>
                        @endforeach
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
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>

    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>

    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script>
        const $btnExportarproyemp = document.querySelector("#btnExportarproyemp"),
            $tablaproyemp = document.querySelector("#proyemp");

        $btnExportarproyemp.addEventListener("click", function() {
            let tableExport = new TableExport($tablaproyemp, {
                exportButtons: false, // No queremos botones
                filename: "Reporte Colaborador-Tareas", //Nombre del archivo de Excel
                sheetname: "Horas trabajadas por Tarea", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            let preferenciasDocumento = datos.proyemp.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType,
                preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento
                .merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);

        });
    </script>
</div>
