@extends('layouts.admin')
@section('content')

<style>

    .btn_cargar{
        border-radius: 100px !important;
        border: 1px solid #345183;
        color: #345183;
        text-align: center;
        padding: 0;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 !important;
        margin-right: 10px !important;
    }
    .btn_cargar:hover{
        color: #fff;
        background:#345183 ;
    }
    .btn_cargar i{
        font-size: 15pt;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .agregar{
        margin-right:15px;
    }

</style>

    {{ Breadcrumbs::render('perfil-puesto') }}
    @can('puestos_agregar')
        <h5 class="col-12 titulo_general_funcion">Perfiles de Puestos</h5>
        <div class="mt-5 card">
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalperfilpuesto', ['model' => 'Vulnerabilidad', 'route' => 'admin.vulnerabilidads.parseCsvImport'])
                </div>
            </div>
            {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12"> --}}
                    {{-- <a class="btn btn-success" href="{{ route('admin.puestos.create') }}">
                  Agregar <strong>+</strong>
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button> --}}
                    {{-- @include('csvImport.modal', ['model' => 'Puesto', 'route' => 'admin.puestos.parseCsvImport'])
                </div>
            </div> --}}
        @endcan

        <div class="card-body datatable-fix">
            <div class="mb-2 row">
                <div class="col-4">
                    <label for=""><i class="fas fa-filter"></i> Filtrar por área</label>
                    <select class="form-control" id="lista_areas">
                        <option value="" disabled selected>-- Selecciona un área --</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->area }}">{{ $area->area }}</option>
                        @endforeach
                        <option value="">Todas</option>
                    </select>
                </div>
            </div>
            <table class="table table-bordered w-100 datatable-Puesto">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            {{ trans('cruds.puesto.fields.puesto') }}
                        </th>
                        <th>
                            Área
                        </th>
                        <th style="min-width: 500px;">
                            {{ trans('cruds.puesto.fields.descripcion') }}
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Puestos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
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

            @can('puestos_agregar')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar area',
                url: "{{ route('admin.puestos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                let btnExport = {
                text: '<i  class="fas fa-download"></i>',
                titleAttr: 'Descargar plantilla',
                className: "btn btn_cargar" ,
                url:"{{ route('descarga-puesto') }}",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            let btnImport = {
                text: '<i  class="fas fa-file-upload"></i>',
                titleAttr: 'Importar datos',
                className: "btn btn_cargar",
                action: function(e, dt, node, config) {
                    $('#xlsxImportModal').modal('show');
                }
            };

            dtButtons.push(btnAgregar);
            dtButtons.push(btnExport);
            dtButtons.push(btnImport);
            @endcan
            @can('puestos_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.puestos.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
                });

                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                //dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.puestos.index') }}",
                columns: [{
                        data: 'puesto',
                        name: 'puesto'

                    },
                    {
                        data: 'area',
                        name: 'area'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-Puesto').DataTable(dtOverrideGlobals);
            $('#lista_areas').on('change', function() {
                console.log(this.value);
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    table.columns(1).search("(^" + this.value + "$)", true, false).draw();
                } else {
                    this.style.border = "none";
                    table.columns(1).search(this.value).draw();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {})
    </script>
@endsection
