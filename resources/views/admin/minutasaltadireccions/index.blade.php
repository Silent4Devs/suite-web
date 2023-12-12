@extends('layouts.admin')
{{-- <link rel="stylesheet" href="{{ asset('css/listadistribucion.css') }}"> --}}
@section('content')
    @include('admin.listadistribucion.estilos')
    {{-- <style>
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

        .table tr td:nth-child(4) {

            text-align: center !important;
        }


        .agregar {
            margin-right: 15px;
        }
    </style> --}}

    {{ Breadcrumbs::render('admin.minutasaltadireccions.index') }}

    @can('revision_por_direccion_agregar')
        <h5 class="col-12 titulo_general_funcion">
            Revisión por dirección</h5>
        {{-- <div style="margin-bottom: 10px;margin-left:10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.minutasaltadireccions.create') }}">
                  Agregar <strong>+</strong>
            </a>
        </div>
    </div> --}}
    @endcan

    <div class="card">
        <div class="card-header">
            <h5>Minutas Revisión por Dirección</h5>
        </div>
        @include('partials.flashMessages')
        <div class="card-body">
            <table class="datatable-fix datatable-rds" id="datatable-Minutasaltadireccion" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th>
                            {{ trans('cruds.minutasaltadireccion.fields.id') }}
                        </th> --}}
                        <th>
                            Tema de la reunión
                        </th>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Elaboró
                        </th>
                        <th>
                            Participantes
                        </th>
                        <th>
                            Estatus
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($query as $q)
                        <tr>
                            {{-- <td>{{ $q->id }}</td> --}}
                            <td>{{ $q->tema_reunion }}</td>
                            <td>{{ $q->fechareunion }}</td>
                            <td>
                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $q->responsable->avatar ?? '' }}"
                                    title="{{ $q->responsable->name ?? '' }}" class="rounded-circle"
                                    style="clip-path: circle(15px at 50% 50%);height: 30px;" />
                            </td>
                            <td>
                                @foreach ($q->participantes as $index => $participante)
                                    @if ($index < 2)
                                        {{-- Se pone 2 porque el index empieza en 0 --}}
                                        <img src="{{ asset('storage/empleados/imagenes/') }}/{{ $participante->avatar }}"
                                            class="rounded-circle" alt="${participante->name}"
                                            title="{{ $participante->name }}"
                                            style="clip-path: circle(15px at 50% 50%); height: 30px;">
                                    @endif
                                @endforeach
                                @if ($q->participantes->count() > 3)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#participantsModal">
                                        +{{ $q->participantes->count() - 3 }} more
                                    </button>
                                @endif

                            </td>

                            <td>
                                <span class="badge"
                                    style="color:{{ $q->color_estatus }}">{{ $q->estatus_formateado }}</span>
                            </td>
                            <td>
                                @can('revision_por_direccion_editar')
                                    <a href="/admin/minutasaltadireccions/{{ $q->id }}/edit" class="btn btn-sm"
                                        title="Editar"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('revision_por_direccion_ver')
                                    <a href="/admin/minutasaltadireccions/{{ $q->id }}" class="btn btn-sm"
                                        title="Visualizar"><i class="fa fa-eye"></i></a>
                                @endcan
                                @foreach ($q->planes as $plan)
                                    @can('revision_por_direccion_plan_accion')
                                        <a href="/admin/planes-de-accion/{{ $plan->id }}" class="btn btn-sm"
                                            title="Plan de Acción"><i class="fa fa-stream"></i></a>
                                    @endcan
                                @endforeach

                                @can('revision_por_direccion_visualizar_revisiones')
                                    <a class="btn btn-sm " title="Visualizar revisiones"
                                        href="/admin/minutasaltadireccions/{{ $q->id }}/historial-revisiones">
                                        <svg xmlns="http:www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-clock-history" viewBox="0 0 16 16">
                                            <path
                                                d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                            <path
                                                d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                        </svg>
                                    </a>
                                @endcan
                                @can('revision_por_direccion_eliminar')
                                    <button class="btn btn-sm text-danger" title="Eliminar"
                                        onclick="Eliminar('/admin/minutasaltadireccions/{{ $q->id }}','{{ $q->tema_reunion }}')"><i
                                            class="fa fa-trash-alt"></i></button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="participantsModal" tabindex="-1" aria-labelledby="participantsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="participantsModalLabel">Participantes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Display the full list of participants here -->
                    @foreach ($q->participantes as $index => $participante)
                        <img src="{{ asset('storage/empleados/imagenes/') }}/{{ $participante->avatar }}"
                            class="rounded-circle" alt="${participante->name}" title="{{ $participante->name }}"
                            style="clip-path: circle(15px at 50% 50%); height: 30px;">
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Minutas de Sesiones con Alta Dirección ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Minutas de Sesiones con Alta Dirección ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Minutas de Sesiones con Alta Dirección ${new Date().toLocaleDateString().trim()}`,
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
                                    <strong style="color:#345183">DETERMINACIÓN DE ALCANCE</strong>
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
            @can('revision_por_direccion_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.minutasaltadireccions.massDestroy') }}",
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
            @can('revision_por_direccion_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar nueva minuta de Sesión con alta Dirección',
                    url: "{{ route('admin.minutasaltadireccions.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                let btnExport = {
                    text: '<i  class="fas fa-download"></i>',
                    titleAttr: 'Descargar plantilla',
                    className: "btn btn_cargar",
                    url: "{{ route('descarga-alta_direccion') }}",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
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
            @endcan
            let dtOverrideGlobals = {
                pageLength: 5,
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                // ajax: "{{ route('admin.minutasaltadireccions.index') }}",
                // columns: [{
                //         data: 'id',
                //         name: 'id'
                //     },
                //     {
                //         data: 'tema_reunion',
                //         name: 'tema_reunion'
                //     },
                //     {
                //         data: 'fechareunion',
                //         name: 'fechareunion'
                //     },
                //     {
                //         data: 'responsable',
                //         name: 'responsable',
                //         render: function(data, type, row, meta) {
                //             if (type === "empleadoText") {
                //                 return data.name;
                //             }
                //             let responsablereunion = "";
                //             if (data) {
                //                 responsablereunion += `
            //             <img src="{{ asset('storage/empleados/imagenes') }}/${data.avatar}" title="${data.name}" class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />
            //             `;
                //             }
                //             return responsablereunion;
                //         }
                //     },
                //     {
                //         data: 'participantes',
                //         name: 'participantes',
                //         render: function(data, type, row, meta) {
                //             let participantes = data;
                //             if (type === "empleadoText") {
                //                 let participantesTexto = "";
                //                 participantes.forEach(participante => {
                //                     participantesTexto += `
            //             ${participante.name},
            //             `;
                //                 });
                //                 return participantesTexto.trim();
                //             }
                //             let html = '';
                //             participantes.forEach(participante => {
                //                 html += `
            //             <img src="{{ asset('storage/empleados/imagenes/') }}/${participante.avatar}"
            //                         class="rounded-circle" alt="${participante.name}"
            //                         title="${participante.name}" style="clip-path: circle(15px at 50% 50%);height: 30px;">
            //             `
                //             });
                //             return html;
                //         }

                //     },
                //     {
                //         data: 'estatus_formateado',
                //         name: 'estatus_formateado',
                //         render: function(data, type, row, meta) {
                //             let estatus = `
            //                 <span class="badge" style="color:${row.color_estatus}">${data}</span>
            //             `;
                //             return estatus;
                //         }
                //     },
                //     {
                //         data: 'id',
                //         render: function(data, type, row, meta) {
                //             let urlBotonEditar = `/admin/minutasaltadireccions/${data}/edit`;
                //             let urlBotonMostrar = `/admin/minutasaltadireccions/${data}`;
                //             let urlBotonEliminar = `/admin/minutasaltadireccions/${data}`;

                //             let htmlButtons = `
            //             @can('revision_por_direccion_editar')
            //                 <a href="${urlBotonEditar}" class="btn btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
            //             @endcan
            //             @can('revision_por_direccion_ver')
            //                 <a href="${urlBotonMostrar}" class="btn btn-sm" title="Visualizar"><i class="fa fa-eye"></i></a>
            //             @endcan
            //             @can('revision_por_direccion_plan_accion')
            //                 ${row.planes.map(plan=>{
            //                     return `<a href="/admin/planes-de-accion/${plan.id}" class="btn btn-sm" title="Plan de Acción"><i class="fa fa-stream"></i></a>`;
            //                 })}
            //             @endcan
            //             @can('revision_por_direccion_visualizar_revisiones')
            //                 <a class="btn btn-sm " title="Visualizar revisiones"
            //                     href="/admin/minutasaltadireccions/${data}/historial-revisiones">
            //                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            //                         class="bi bi-clock-history" viewBox="0 0 16 16">
            //                         <path
            //                             d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
            //                         <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
            //                         <path
            //                             d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
            //                     </svg>
            //                 </a>
            //             @endcan
            //             @can('revision_por_direccion_eliminar')
            //                 <button class="btn btn-sm text-danger" title="Eliminar" onclick="Eliminar('${urlBotonEliminar}','${row.tema_reunion}')"><i class="fa fa-trash-alt"></i></button>
            //             @endcan
            //             `;
                //             return htmlButtons;
                //         }
                //     }
                // ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-Minutasaltadireccion').DataTable(dtOverrideGlobals);

            window.Eliminar = function(url, nombre) {
                Swal.fire({
                    title: `¿Estás seguro de eliminar la siguiente minuta?`,
                    html: `<strong><i class="mr-2 fas fa-exclamation-triangle"></i>${nombre}</strong>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            headers: {
                                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            beforeSend: function() {
                                Swal.fire(
                                    '¡Estamos Eliminando!',
                                    `La minuta: ${nombre} está siendo eliminada`,
                                    'info'
                                )
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Eliminado!',
                                    `La minuta: ${nombre} ha sido eliminada`,
                                    'success'
                                )
                                table.ajax.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Ocurrió un error',
                                    `Error: ${error.responseJSON.message}`,
                                    'error'
                                )
                            }
                        });
                    }
                })
            }
        });
    </script>
@endsection --}}
