@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.planificacion-controls.index') }}

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
</style>
    <h5 class="col-12 titulo_general_funcion">Planificación y Control</h5>

    <div class="mt-5 card">

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="text-right mb-4 mr-4">
                <a class="btn btn-danger" class="btn btn-sm btn-success" data-toggle="modal"
                    data-target="#planAccionModal">Crear Plan de Acción</a>
            </div>
            @livewire('plan-implementacion-create', [
                'referencia' => null,
                'modulo_origen' => 'Planificacion
                        Control',
            ])
            <table class="table table-bordered w-100 datatable-PlanificacionControl">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th style="min-width: 110px;">
                            Fecha de registro
                        </th>
                        <th>
                            Reporta
                        </th>
                        <th style="min-width: 200px;">
                            Objetivo
                        </th>
                        <th style="min-width: 110px;">
                            Origen
                        </th>
                        <th style="min-width: 400px;">
                            Descripción
                        </th>
                        <th>
                            Responsable
                        </th>
                        <th style="min-width: 80px; text-align: center !important;">
                            Fecha inicio
                        </th>
                        <th style="min-width: 90px; text-align: center !important;">
                            Fecha termino
                        </th>
                        <th style="min-width: 140px;">
                            Criterios aceptación
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
                    title: `Planificación y Control ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Planificación y Control ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'print',
                    title: `Planificación y Control ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                            <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">PLANIFICACIÓN Y CONTROL</strong>
                                </div>
                                <div class="col-3 p-2">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
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

            @can('planificacion_y_control_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar planificación y control',
                    url: "{{ route('admin.planificacion-controls.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('planificacion_y_control_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.planificacion-controls.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).data(), function(entry) {
                            return entry.id
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
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
                ajax: "{{ route('admin.planificacion-controls.index') }}",
                columns: [{
                        data: 'folio_cambio',
                        name: 'folio_cambio'
                    },
                    {
                        data: 'fecha_registro',
                        name: 'fecha_registro'
                    },
                    {
                        data: 'reporta',
                        name: 'reporta',
                        render: function(data, type, row, meta) {
                            let reportaJson = JSON.parse(row.reporta ? row.reporta : '{}')
                            if (type === "empleadoText") {
                                return reportaJson.name;
                            }
                            let reporta = "";
                            if (reportaJson) {
                                reporta += `
                            <img src="{{ asset('storage/empleados/imagenes') }}/${reportaJson.avatar}" title="${reportaJson.name}" class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />
                            `;
                            }
                            return reporta;
                        }
                    },
                    {
                        data: 'objetivo',
                        name: 'objetivo'
                    },
                    {
                        data: 'origen',
                        name: 'origen'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'responsable',
                        name: 'responsable',
                        render: function(data, type, row, meta) {
                            let responsableJson = JSON.parse(row.responsable ? row.responsable : '{}')
                            if (type === "empleadoText") {
                                return responsableJson.name;
                            }
                            let responsable = "";
                            if (responsableJson) {
                                responsable += `
                            <img src="{{ asset('storage/empleados/imagenes') }}/${responsableJson.avatar}" title="${responsableJson.name}" class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />
                            `;
                            }
                            return responsable;
                        }
                    },
                    {
                        data: 'fecha_inicio',
                        name: 'fecha_inicio'
                    },
                    {
                        data: 'fecha_termino',
                        name: 'fecha_termino'
                    },
                    {
                        data: 'criterios',
                        name: 'criterios'
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
            let table = $('.datatable-PlanificacionControl').DataTable(dtOverrideGlobals);
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value
            //     table
            //         .column($(this).parent().index())
            //         .search(value, strict)
            //         .draw()
            // });
        });
    </script>

    <script type="text/javascript">
        Livewire.on('planStore', () => {

            $('#planAccionModal').modal('hide');

            $('.modal-backdrop').hide();

            toastr.success('Plan de Acción creado con éxito');

        });
    </script>
@endsection
