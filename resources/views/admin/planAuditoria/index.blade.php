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
    </style>

    {{ Breadcrumbs::render('admin.plan-auditoria.index') }}

    @can('plan_auditorium_create')
    @endcan
    <h5 class="col-12 titulo_general_funcion">Plan de Auditoría</h5>
    <div class="mt-5 card">
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-PlanAuditorium">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.id') }}
                        </th>
                        <th>
                            Nombre&nbsp;auditoría
                        </th>
                        <th>
                            Fecha&nbsp;auditoría
                        </th>

                        <th style="min-width: 600px;">
                            Objetivo&nbsp;de&nbsp;la&nbsp;auditoría
                        </th>
                        <th style="min-width: 600px;">
                            {{ trans('cruds.planAuditorium.fields.alcance') }}
                        </th>
                        <th style="min-width: 600px;">
                            Criterios&nbsp;de&nbsp;auditoría&nbsp;a&nbsp;utilizar
                        </th>
                        <th style="min-width: 600px;">
                            Procesos&nbsp;y&nbsp;documentos&nbsp;a&nbsp;auditar
                        </th>
                        <th>
                            Equipo&nbsp;auditor
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
                    title: `Plan de Auditoría ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Plan de Auditoría ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Plan de Auditoría ${new Date().toLocaleDateString().trim()}`,
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
                                    <strong style="color:#345183">PLAN DE AUDITORÍA</strong>
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

            @can('plan_de_auditoria_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar plan de auditoría',
                    url: "{{ route('admin.plan-auditoria.create') }}",
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
            @can('plan_auditorium_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.plan-auditoria.massDestroy') }}",
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
                ajax: "{{ route('admin.plan-auditoria.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombre_auditoria',
                        name: 'nombre_auditoria'
                    },
                    {
                        data: 'fecha_inicio_auditoria',
                        name: 'fecha_inicio_auditoria'
                    },
                    {
                        data: 'objetivo',
                        name: 'objetivo',
                        render: function(data, type, row, meta) {
                            return row.objetivo_html;
                        }

                    },
                    {
                        data: 'alcance',
                        name: 'alcance',
                        render: function(data, type, row, meta) {
                            return row.alcance_html;
                        }
                    },
                    {
                        data: 'criterios',
                        name: 'criterios',
                        render: function(data, type, row, meta) {
                            return row.criterios_html;
                        }
                    },
                    {
                        data: 'documentoauditar',
                        name: 'documentoauditar',
                        render: function(data, type, row, meta) {
                            return row.documento_auditar_html;
                        }
                    },
                    {
                        data: 'equipo_auditor',
                        render: function(data, type, row, meta) {
                            let equipos = JSON.parse(data);
                            if (type === "empleadoText") {
                                let equiposTexto = "";
                                equipos.forEach(equipo => {
                                    equiposTexto += `
                            ${equipo.name},
                            `;
                                });
                                return equiposTexto.trim();
                            }
                            let html = '<div class="d-flex" style="flex-wrap:wrap">';
                            equipos.forEach(empleado => {
                                html += `
                                   <img src="{{ asset('storage/empleados/imagenes') }}/${empleado.avatar}" title="${empleado.name}" class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />

                                `;
                            })
                            html += '</div>'
                            return html
                        },
                        width: '20%'
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
            let table = $('.datatable-PlanAuditorium').DataTable(dtOverrideGlobals);
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
@endsection
