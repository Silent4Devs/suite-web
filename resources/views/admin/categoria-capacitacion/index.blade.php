@extends('layouts.admin')
@section('content')

        <style>
        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border: none;
        }

        .btn-outline-success:focus {
            border-color: #345183 !important;
            box-shadow: none;
        }

        .btn-outline-success:active {
            box-shadow: none !important;
        }

        .btn-outline-success:hover {
            background: #788bac;
            color: white;

        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

            .agregar {
                margin-right: 15px;
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

        {{ Breadcrumbs::render('admin.CategoriaCapacitacion.index') }}
        <h5 class="col-12 titulo_general_funcion">Categorías de capacitaciones</h5>

            <div class="text-right">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.categoria-capacitacion.create') }}" type="button" class="btn btn-primary">Registrar Categoría de capacitacion</a>
                </div>
            </div>
            @include('partials.flashMessages')
            <div class="datatable-fix datatable-rds">
                <div class="d-flex justify-content-end">
                    <a class="boton-transparente boton-sin-borde" href="{{ route('descarga-categoriacapacitacion') }}">
                        <img src="{{ asset('download_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                    </a> &nbsp;&nbsp;&nbsp;
                    <a class="boton-transparente boton-sin-borde" id="btnImport">
                        <img src="{{ asset('upload_file_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon">
                    </a>
                    @include('csvImport.modalcategoriacapacitacion', [
                        'model' => 'Vulnerabilidad',
                        'route' => 'admin.vulnerabilidads.parseCsvImport',
                    ])
                </div>
                <h3 class="title-table-rds"> Categorías de capacitaciones</h3>
                <table class="datatable tbl-categorias" id="tbl-categorias">
                    <thead class="thead-dark">
                        <tr>
                            <th style="min-width:200px;">No.</th>
                            <th style="min-width:200px;">
                                ID
                            </th>
                            <th style="min-width:200px;">
                                Nombre
                            </th>
                            <th style="min-width:200px;">
                                Opciones
                            </th>
                        </tr>

                    </thead>
                </table>
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
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
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
                ajax: "{{ route('admin.categoria-capacitacion.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
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
            let table = $('.tbl-categorias').DataTable(dtOverrideGlobals);

        });
    </script>
@endsection
