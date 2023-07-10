<div>
    <x-loading-indicator />
    <div class="row" wire:ignore>
        <div class="col-md-4 form-group" style="padding-left:0px !important;">
            <label class="form-label">Estatus</label>
            <select class="form-control" wire:model="estatus">
                <option selected value="0">Todos</option>
                <option value="proceso">En Proceso</option>
                <option value="terminado">Terminados</option>
                <option value="cancelado">Cancelados</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group" style="padding-left:0px !important;">
        <label class="form-label">Proyecto</label>
        <select class="form-control" wire:model="proy_id">
            <option value="0" selected>Seleccione un proyecto</option>
            @foreach ($lista_proyectos as $pro)
                <option value="{{ $pro->id }}">{{ $pro->proyecto }}</option>
            @endforeach
        </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group" style="padding-left:0px !important;">
        <label class="form-label">Areas</label>
        <select class="form-control" wire:model="area_id">
            <option value="0">Todas</option>
            @foreach ($lista_areas as $area)
                <option value="{{ $area->area->id }}">{{ $area->area->area }}</option>
            @endforeach
        </select>
        </div>
    </div>
</div>

{{-- <script>
    var array = @json($grafico);
    console.log(array);
</script> --}}

{{-- 
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
            $tabla = document.querySelector("#proyemp");

        $btnExportar.addEventListener("click", function() {
            let tableExport = new TableExport($tabla, {
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
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);

        });
        </script>
</div> --}}
