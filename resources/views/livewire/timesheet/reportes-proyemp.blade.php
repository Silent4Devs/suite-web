<div>
    @php
        $unwanted_array = ['Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'];
    @endphp
    <x-loading-indicator />
    <div class="mt-5 card card-body">
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
            <div class="col-md-4 form-group">
                <label class="form-label">Fecha de inicio</label>
                <input class="form-control date_librery" type="date" name="fecha_inicio" wire:model="fecha_inicio">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Fecha de fin</label>
                <input class="form-control date_librery" type="date" name="fecha_fin" wire:model="fecha_fin">
            </div>
        </div>
        <div class="row" wire:ignore>
            <div class="col-md-4 form-group" style="padding-left:0px !important;">
                <label class="form-label">Proyecto</label>
                <select class="form-control" wire:model="proy_id">
                    <option selected value="0">Todos</option>
                    @foreach ($proy as $pro)
                        <option value="{{ $pro->id }}">{{ $pro->identificador }} - {{ $pro->proyecto }}</option>
                    @endforeach
                </select>
            </div>
            {{--
        <div class="col-md-4 form-group" style="padding-left:0px !important;">
            <label class="form-label">Área</label>
            <select class="form-control" wire:model="empleados_estatus">
                <option selected value="alta">Todas</option>
            </select>
        </div> --}}
        </div>
        <div class="row mt-5">
            @include('partials.flashMessages')
            <div class="col-12 d-flex justify-content-between"
                style="padding-left: 0 !important; padding-right: 0 !important;">
                <h5 id="titulo_estatus">Registros Proyectos</h5>
            </div>
            <div class="row w-100 mt-4" style="align-items: end">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="row" style="justify-content: center">
                                <div class="col-3 p-0" style="font-size: 11px;align-self: center">
                                    <p class="m-0">Mostrando</p>
                                </div>
                                <div class="col-4 p-0">
                                    <select name="" id="" class="form-control" wire:model="perPage">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="-1">Todos</option>
                                    </select>
                                </div>
                                <div class="col-5 p-0" style="font-size: 11px;align-self: center;text-align: end">
                                    <p class="m-0"> proyectos por página</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            {{-- <button onclick="exportTableToExcel('proyemp', 'Reporte Colaborador-Tareas')"
                        class="btn-sm rounded pr-2" style="background-color:#b9eeb9; border: #fff">
                        <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935" title="Exportar Excel"></i>
                        Exportar Excel</button> --}}
                            <button id="btnExportarproyemp" class="btn-sm rounded pr-2"
                                style="background-color:#b9eeb9; border: #fff">
                                <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"
                                    title="Exportar Excel"></i>
                                Exportar Excel
                            </button>
                            {{--  <button wire:click="exportExcel()" class="btn-sm rounded pr-2"
                                style="background-color:#b9eeb9; border: #fff">
                                <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"
                                    title="Exportar Excel"></i>
                                Exportar Excel
                            </button>  --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-6 p-0" style="text-align: end">
                <div class="row">
                    <div class="col-6 p-0"></div>
                    <div class="col-6 p-0">
                        <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
                    </div>
                </div>
            </div> --}}
            </div>
            <div class="datatable-fix w-100 mt-2">
                <table class="table w-100 datatable_timesheet_registros_reportes">
                    {{-- id="datatable_timesheet" --}}
                    <thead class="w-100">
                        <tr>
                            <th>Fecha Inicio </th>
                            <th>Fecha Fin </th>
                            <th>Empleado</th>
                            <th>Supervisor</th>
                            <th style="min-width:250px;">Proyecto</th>
                            <th>Tarea</th>
                            <th>Descripcion</th>
                            <th>Horas Totales de la Tarea</th>
                            {{-- <th>Opciones</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time)
                            <tr class="tr_{{ $time->estatus }}">
                                <td>
                                    {!! $time->timesheet->inicio !!}
                                </td>
                                <td>
                                    {!! $time->timesheet->fin !!}
                                </td>
                                <td>
                                    {{ strtr($time->timesheet->empleado->name, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->timesheet->aprobador->name, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->proyecto->proyecto, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->tarea->tarea, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->descripcion, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ $time->horas_lunes + $time->horas_martes + $time->horas_miercoles + $time->horas_jueves + $time->horas_viernes + $time->horas_sabado + $time->horas_domingo }}
                                </td>
                                {{-- <td>
                                <a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" title="Visualizar"
                                    class="btn"><i class="fa-solid fa-eye"></i></a>
                            </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table w-100 datatable_timesheet_registros_reportes" id="proyemp" hidden>
                    {{-- id="datatable_timesheet" --}}
                    <thead class="w-100">
                        <tr>
                            <th>Fecha Inicio </th>
                            <th>Fecha Fin </th>
                            <th>Empleado</th>
                            <th>Supervisor</th>
                            <th style="min-width:250px;">Proyecto</th>
                            <th>Tarea</th>
                            <th>Descripcion</th>
                            <th>Horas Totales de la Tarea</th>
                            {{-- <th>Opciones</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time)
                            <tr class="tr_{{ $time->estatus }}">
                                <td>
                                    {!! $time->timesheet->inicioLetras !!}
                                </td>
                                <td>
                                    {!! $time->timesheet->finLetras !!}
                                </td>
                                <td>
                                    {{ strtr($time->timesheet->empleado->name, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->timesheet->aprobador->name, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->proyecto->proyecto, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->tarea->tarea, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ strtr($time->descripcion, $unwanted_array) }}
                                </td>
                                <td>
                                    {{ $time->horas_lunes + $time->horas_martes + $time->horas_miercoles + $time->horas_jueves + $time->horas_viernes + $time->horas_sabado + $time->horas_domingo }}
                                </td>
                                {{-- <td>
                                <a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" title="Visualizar"
                                    class="btn"><i class="fa-solid fa-eye"></i></a>
                            </td> --}}
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
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                tablaLivewire('datatable_timesheet');
            });
        });
    </script>

    {{-- <script>
            function exportTableToExcel(tableID, filename){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }

    </script> --}}

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
            // console.log(datos.tblobjetivos.xlsx.data);

            // console.log(datos.tblobjetivos);
            // console.log(datos.tblobjetivos.xlsx);
            // console.log(datos.tblobjetivos.xlsx.data);
            let preferenciasDocumento = datos.proyemp.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType,
                preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento
                .merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);

        });
    </script>
</div>
