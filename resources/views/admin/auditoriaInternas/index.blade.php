@extends('layouts.admin')
@section('content')
    <style>
        .table .thead-dark th {
            background-color: #fff;
            color: #414141;
            font-weight: bolder;
        }
    </style>
    {{ Breadcrumbs::render('admin.auditoria-internas.index') }}

    @can('auditoria_interna_create')
    @endcan
    <h5 class="col-12 titulo_general_funcion">Informe de Auditoría </h5>
    <div class="card card-body" style="background-color: #7587D0; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <h4>¿Qué es Informe de auditoría?</h4>
                <p>
                    Es un documento que describe los resultados de una auditoría.
                </p>
                <p>
                    Los informes de auditoría son una herramienta importante para mejorar la eficacia y eficiencia de los
                    sistemas y procesos. Los informes de auditoría ayudan a las organizaciones a identificar y corregir las
                    deficiencias, lo que puede conducir a una mejora del rendimiento y la reducción de los riesgos.
                </p>
            </div>
        </div>
    </div>
    <div class="text-right">
        <a class="btn btn-info"
            style="background-color: #057BE2; padding-top: 15px !important; padding-bottom: 15px !important;"
            href="{{ route('admin.auditoria-internas.create') }}">
            Crear auditoría <strong>+</strong>
        </a>
    </div>
    <div class="mt-3 card card-body">
        <div class="text-right mb-2">
            <div class="d-flex" style="justify-content: space-between;">
                <h4 style="font-weight: lighter;">Informe de auditorias</h4>

            </div>
            <hr>
        </div>
        <div class="datatable-fix">
            <table class="table table-acordeon ">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width: 70px;">
                            ID
                        </th>
                        <th style="min-width: 150px;">
                            Nombre de auditoría
                        </th>
                        <th style="min-width: 100px;">
                            Fecha inicio
                        </th>
                        <th style="min-width: 300px;">
                            Objetivo
                        </th>
                        <th>
                            Reportes
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($query as $aud)
                        <tr>
                            <td>
                                {{ $aud->id_auditoria }}
                            </td>
                            <td>
                                {{ $aud->nombre_auditoria }}
                            </td>
                            <td>
                                {{ $aud->fecha_inicio }}
                            </td>
                            <td>
                                {!! $aud->objetivo !!}
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.auditoria-internas.reporteIndividual', $aud->id_auditoria) }}">
                                    <i class="fa-solid fa-user-check" style="color:#5A5A5A;"></i>
                                </a>
                            </td>
                            <td>
                                <div class="btn" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </div>
                                <div class="btn" onclick="viewAudit({{ $aud->id }})">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>

                                <form action="{{ asset('admin/auditoria-internas/' . $aud->id) }}" method="POST">
                                    <div class="dropdown-menu">
                                        <a href="{{ asset('admin/auditoria-internas/' . $aud->id) }}" class="dropdown-item">
                                            <i class="fa-solid fa-trash"></i>&nbsp;Ver
                                        </a>
                                        <a href="{{ route('admin.auditoria-internas.edit', $aud->id) }}"
                                            class="dropdown-item">
                                            <i class="fa-solid fa-pencil"></i>&nbsp;Editar
                                        </a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <button class="dropdown-item">
                                            <i class="fa-solid fa-trash"></i>&nbsp;Eliminar
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                        <tr class="d-none tr-sec-menu tr-second{{ $aud->id }}" style="background-color: #F5FEFF;">
                            <td colspan="6">
                                <div class="d-flex" style="gap: 20px;">
                                    <div style="max-width: 50%;">
                                        <strong>Alcance</strong> <br> <br>
                                        {!! $aud->alcance !!}
                                    </div>
                                    <div style="max-width: 50%;">
                                        <strong>Criterio de auditoría</strong> <br> <br>
                                        {!! $aud->criterios_auditoria !!}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="d-none tr-sec-menu tr-second{{ $aud->id }}" style="background-color: #F4F4F4;">
                            <td colspan="6">
                                <div class="d-flex" style="gap: 20px;">
                                    <div style="max-width: 50%;">
                                        <strong>Auditor Lider</strong> <br> <br>
                                        @if ($aud->lider)
                                            <img src="{{ $aud->lider->avatar_ruta }}" title="{{ $aud->lider->name }}"
                                                class="rounded-circle; ml-4"
                                                style="clip-path: circle(15px at 50% 50%);height: 30px; " />
                                        @endif
                                    </div>
                                    <div style="max-width: 50%;">
                                        <strong> Auditor externo </strong> <br> <br>
                                        @if ($aud->auditor_externo)
                                            {{ $aud->auditor_externo }}
                                        @endif
                                    </div>
                                    <div style="max-width: 50%;">
                                        <strong>Equipo auditoría</strong> <br> <br>
                                        @foreach ($aud->equipo as $emp)
                                            {{ $emp->name }}, <br>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <hr>


    <style>
        .card-audit-report {
            box-shadow: 0px 1px 4px #00000024;
            background-color: #fff;
            padding: 20px 0px;
            text-align: center;
            position: relative;
            width: 250px;
            border-radius: 8px;
        }

        .title-card-audit {
            color: #0489FE;
            font-size: 14px;
        }

        .card-audit-report .btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .card-audit-report .title-info {
            color: #606060;
            font-size: 16px;
        }

        .card-audit-report p {
            margin-bottom: 3px;
            width: 100px;
            margin: auto;
        }

        .estatus-audit {
            padding: 0px 8px;
            margin-top: 7px;
            border-radius: 100px;
        }


        .estatus-aceptado {
            color: #039C55;
            background-color: #E9FFE8;
        }

        .estatus-pendiente {
            color: #F19D0E;
            background-color: #FFF8E8;
        }

        .estatus-rechazado {
            color: #FF0000;
            background-color: #FFE8E8;
        }
    </style>

    <div class="d-flex mb-4" style="gap: 30px; flex-wrap: wrap;">
        <div class="card-audit-report">
            <span class="title-card-audit">Contexto</span>
            <button class="btn" data-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item">
                    <i class="fa-solid fa-trash"></i>&nbsp;Ver
                </a>
                <a class="dropdown-item">
                    <i class="fa-solid fa-pencil"></i>&nbsp;Editar
                </a>
                <a class="dropdown-item">
                    <i class="fa-solid fa-trash"></i>&nbsp;Eliminar
                </a>
            </div>
            <hr>
            <p class="title-info">
                <strong> Informe auditoria 2023 V3 </strong>
            </p>
            <p>
                <small>
                    Marco Luna
                </small>
            </p>
            <span class="estatus-audit estatus-aceptado">
                <small>Aceptado</small>
            </span>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        function viewAudit(id) {
            $('.tr-second' + id).toggleClass('d-none');
            $('.btn:hover i').toggleClass('btn-arrow-menu-table-rotate');
        }
    </script>
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
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
            @can('auditoria_interna_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar auditoría interna',
                    url: "{{ route('admin.auditoria-internas.create') }}",
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
            @can('auditoria_interna_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.auditoria-internas.massDestroy') }}",
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
                // dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                // processing: true,
                // serverSide: true,
                // retrieve: true,
                // aaSorting: [],
                // ajax: "{{ route('admin.auditoria-internas.index') }}",
                // columns: [{
                //         data: 'id_auditoria',
                //         name: 'id_auditoria'
                //     },
                //     {
                //         data: 'nombre_auditoria',
                //         name: 'nombre_auditoria'
                //     },
                //     {
                //         data: 'objetivo',
                //         name: 'objetivo'
                //     },
                //     {
                //         data: 'alcance',
                //         name: 'alcance'
                //     },
                //     {
                //         data: 'fecha_inicio',
                //         name: 'fecha_inicio'
                //     },
                //     // {
                //     //     data: 'clausulas',
                //     //     render: function(data, type, row, meta) {
                //     //         let html = '<ul>';
                //     //         data.forEach(clausula => {
                //     //             html += `<li>${clausula.nombre}</li> `;
                //     //         })
                //     //         html += '</ul>';
                //     //         return html
                //     //     }
                //     // },
                //     {
                //         data: 'criterios_auditoria',
                //         name: 'criterios_auditoria'
                //     },
                //     {
                //         data: 'lider',
                //         name: 'lider',
                //         render: function(data, type, row, meta) {
                //             let liderJson = JSON.parse(row.lider ? row.lider : '{}')
                //             if (type === "empleadoText") {
                //                 return liderJson.name;
                //             }
                //             let lider = "";
                //             if (liderJson) {
                //                 lider += `
            //             <img  src="{{ asset('storage/empleados/imagenes') }}/${liderJson.avatar}" title="${liderJson.name}" class="rounded-circle; ml-4" style="clip-path: circle(15px at 50% 50%);height: 30px; " />
            //             `;
                //             }
                //             return lider;
                //         }

                //     },
                //     {
                //         data: 'auditor_externo',
                //         name: 'auditor_externo',
                //         render: function(data, type, row, meta) {
                //             return `${row.auditor_externo?row.auditor_externo :'n/a'}`;
                //         }
                //     },
                //     {
                //         data: 'equipo',
                //         render: function(data, type, row, meta) {
                //             let equipos = JSON.parse(data);
                //             if (type === "empleadoText") {
                //                 let equiposTexto = "";
                //                 equipos.forEach(equipo => {
                //                     equiposTexto += `
            //             ${equipo.name},
            //             `;
                //                 });
                //                 return equiposTexto.trim();
                //             }
                //             let html = '<div class="d-flex" style="flex-wrap:wrap">';
                //             equipos.forEach(empleado => {
                //                 html += `
            //                     <img src="{{ asset('storage/empleados/imagenes') }}/${empleado.avatar}" title="${empleado.name}" class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />

            //             `;
                //             })
                //             html += '</div>';
                //             return html
                //         }
                //     },
                //     {
                //         data: 'id_audit',
                //         render: function(data, type, row, meta) {
                //             let html = '<div class="d-flex" style="flex-wrap:wrap">';
                //             html += `
            //                 <a href="{{ route('admin.auditoria-internas.reporteIndividual', ':id_audit') }}">
            //                 <i class="fa-solid fa-user-check" style="color:#5A5A5A;"></i>
            //                 </a>
            //                 `;
                //             html += '</div>';

                //             // Replace ':id_audit' with the actual value of id_audit
                //             html = html.replace(':id_audit', data);

                //             return html;
                //         }
                //     },
                //     {
                //         data: 'actions',
                //         name: '{{ trans('global.actions') }}'
                //     }
                // ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-AuditoriaInterna').DataTable(dtOverrideGlobals);
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
