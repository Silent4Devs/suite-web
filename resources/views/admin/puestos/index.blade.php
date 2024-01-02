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

    .boton-sin-borde {
        border: none;
        outline: none; /* Esto elimina el contorno al hacer clic */
    }
    .boton-transparente {
    background-color: transparent;
    border: none; /* Elimina el borde del botón si lo deseas */
    }

</style>

    {{ Breadcrumbs::render('perfil-puesto') }}
        <h5 class="col-12 titulo_general_funcion">Perfiles de Puestos</h5>

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

            <div class="text-right">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.puestos.create') }}" type="button" class="btn btn-primary">Registrar Perfil de Puesto</a>
                </div>
            </div>
            @include('partials.flashMessages')
                <div class="datatable-fix datatable-rds">
                    <div class="d-flex justify-content-end">
                        <a class="boton-transparente boton-sin-borde" href="{{ route('descarga-puesto') }}">
                            <img src="{{ asset('download_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                        </a> &nbsp;&nbsp;&nbsp;
                        <a class="boton-transparente boton-sin-borde" id="btnImport">
                            <img src="{{ asset('upload_file_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                        </a>
                        @include('csvImport.modalperfilpuesto', [
                            'model' => 'Vulnerabilidad',
                            'route' => 'admin.vulnerabilidads.parseCsvImport',
                        ])
                    </div>
                <h3 class="title-table-rds"> Puestos</h3>
                <table class="datatable datatable-Puesto" id="datatable-Puesto">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                {{ trans('cruds.puesto.fields.puesto') }}
                            </th>
                            <th>
                                Área
                            </th>
                            <th>
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
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $('#btnImport').on('click', function(e) {
        e.preventDefault();
        $('#xlsxImportModal').modal('show');
     });
    </script>
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
