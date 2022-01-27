@extends('layouts.admin')
@section('content')
    <style>
        .dataTables_length label {
            color: white;

        }

        .dataTables_length:before {
            content: "Mostrar" !important;
            color: #111 !important;
            margin-right: -20px !important;
            position: absolute;
            z-index: 2;
            padding-right:18px !important;
            margin-top: 5px !important;
        }

        .dataTables_length:after {
            content: "empleados" !important;
            color: #111 !important;
            margin-left: -50px !important;
            position: relative;
            z-index: 2;
            /* padding: 0px; */
        }

        .btn_cargar {
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

        .btn_cargar:hover {
            color: #fff;
            background: #345183;
        }

        .btn_cargar i {
            font-size: 15pt;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .agregar {
            margin-right: 15px;
        }

    </style>

    <h5 class="col-12 titulo_general_funcion">Empleados</h5>
    <div class="mt-5 card">
        @can('configuracion_empleados_create')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalempleado', ['model' => 'Vulnerabilidad', 'route' =>
                    'admin.vulnerabilidads.parseCsvImport'])
                </div>
            </div>
        @endcan
        <div class="col-12" style="text-align: right;">
                    <a href="{{ url('admin/panel-inicio') }}" style="text-align: right;padding-right: 20px;" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"><i class="pl-2 pr-3 fas fa-plus"></i> Configurar vista datos</a>
        </div>

        {{-- <a href="{{ url('admin/panel-inicio') }}" style="text-align: right;padding-right: 20px;"><button
                class="btn-xs btn-primary rounded ml-2 pr-3"><i class="pl-2 pr-3 fas fa-plus"></i> Configurar mis
                datos</button></a> --}}
        @if (!$ceo_exists)
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Cree el listado de los empleados,
                            comenzando
                            por el de más alta jerarquía</p>
                    </div>
                </div>
            </div>
        @endif

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-Empleado">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            Foto
                        </th>
                        <th style="vertical-align: top">
                            N°&nbsp;de&nbsp;empleado
                        </th>
                        <th style="vertical-align: top; min-width:200px;">
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th style="vertical-align: top">
                            Correo&nbsp;electrónico
                        </th>
                        <th style="vertical-align: top">
                            Teléfono
                        </th>
                        <th style="vertical-align: top">
                            Área
                        </th>
                        <th style="vertical-align: top">
                            Puesto
                        </th>
                        <th style="vertical-align: top; min-width:200px;">
                            Jefe Inmediato
                        </th>
                        <th style="vertical-align: top">
                            Antiguedad
                        </th>
                        <th style="vertical-align: top">
                            Estatus
                        </th>
                        <th style="vertical-align: top">
                            Sede
                        </th>
                        <th style="vertical-align: top">
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
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        // doc.styles.tableHeader.fontSize = 6.5;
                        // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
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
            @can('configuracion_empleados_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar empleado',
                url: "{{ route('admin.empleados.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config) {
                let {
                url
                } = config;
                window.location.href = url;
                }
                };
                let btnExport = {
                text: '<i class="fas fa-download"></i>',
                titleAttr: 'Descargar plantilla',
                className: "btn btn_cargar" ,
                action: function(e, dt, node, config) {
                $('#').modal('show');
                }
                };
                let btnImport = {
                text: '<i class="fas fa-file-upload"></i>',
                titleAttr: 'Importar datos',
                className: "btn btn_cargar",
                action: function(e, dt, node, config) {
                $('#xlsxImportModal').modal('show');
                }
                };

                dtButtons.push(btnAgregar);
                dtButtons.push(btnExport);
                dtButtons.push(btnImport);

                // let btnConf = {
                // text: '<i class="pl-2 pr-3 fas fa-plus"></i> Configurar mis datos',
                // titleAttr: 'conf',
                // url: "{{ url('admin/panel-inicio') }}",
                // className: "btn-xs btn-primary rounded ml-2 pr-3",
                // action: function(e, dt, node, config) {
                // let {
                // url
                // } = config;
                // window.location.href = url;
                // }
                // };
                // dtButtons.push(btnConf);
            @endcan

            @can('configuracion_empleados_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
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
                // dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.empleados.index') }}",
                columns: [
                    {
                        data: 'avatar',
                        name: 'avatar',
                        render: function(data, type, row, meta) {
                            return `<div class="text-center"><img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ asset('storage/empleados/imagenes/') }}/${data !=""?data:"user.png"}"></div>`;

                        }
                    },
                    {
                        data: 'n_empleado',
                        name: 'n_empleado'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'area',
                        name: 'area'
                    },
                    {
                        data: 'puesto',
                        name: 'puesto'
                    },
                    {
                        data: 'jefe',
                        name: 'jefe'
                    },
                    {
                        data: 'antiguedad',
                        name: 'antiguedad'
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'sede',
                        name: 'sede'
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
            let table = $('.datatable-Empleado').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection
