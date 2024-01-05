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
        <div style="margin-bottom: 10px; text-align:end;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.minutasaltadireccions.create') }}">
                    Agregar Revisión
                </a>
            </div>
        </div>
    @endcan

    <div class="card card-body">
        <div class="card-header">
            <h5 class="title-table-rds">Minutas Revisión por Dirección</h5>
        </div>
        @include('partials.flashMessages')
        <div>
            <table class="datatable-rds" id="datatable-Minutasaltadireccion" style="width: 100%">
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
                        <th style="width: 8rem; text-align: start;">
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
                                    title="{{ $q->responsable->name ?? '' }}" class="btn btn-round ml-2 rounded-circle"
                                    style="width: 50px; height:50px; background-color: #fff8dc;" />
                            </td>
                            <td>
                                @foreach ($q->participantes as $index => $participante)
                                    @if ($index < 3)
                                        <img src="{{ asset('storage/empleados/imagenes/') }}/{{ $participante->avatar }}"
                                            class="btn btn-round ml-2 rounded-circle" alt="{{ $participante->name }}"
                                            title="{{ $participante->name }}"
                                            style="width: 50px; height:50px; background-color: #fff8dc;">
                                    @endif
                                @endforeach
                                @if ($q->participantes->count() > 3)
                                    <button type="button" class="btn btn-round ml-2 rounded-circle"  style="width: 50px; height:50px; background-color: #fff8dc;" data-bs-toggle="modal"
                                        data-bs-target="#participantsModal{{ $q->id }}">
                                        +{{ $q->participantes->count() - 3 }}
                                    </button>
                                @endif

                            </td>

                            <td>
                            @php
                                $badgeColor = '';
                                switch ($q->estatus_formateado) {
                                    case 'En Elaboración':
                                        $badgeColor = 'red';
                                        break;
                                    case 'En Revisión':
                                        $badgeColor = 'green';
                                        break;
                                    case 'Publicado':
                                        $badgeColor = '#DD8E04';
                                        break;
                                    default:
                                        $badgeColor = 'red';
                                }
                             @endphp

                            <span class="badge" style="color:{{ $badgeColor }}; background: #E9FFE8 0% 0% no-repeat padding-box; border-radius: 7px; opacity: 1;">{{ $q->estatus_formateado }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical" style="color: #000000;"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        @can('revision_por_direccion_editar')
                                            <li><a href="/admin/minutasaltadireccions/{{ $q->id }}/edit"
                                                    class="btn btn-sm" title="Editar"><i class="fa fa-edit"></i>
                                                    </a>Editar</li>
                                        @endcan
                                        @can('revision_por_direccion_ver')
                                            <li><a href="/admin/minutasaltadireccions/{{ $q->id }}" class="btn btn-sm"
                                                    title="Visualizar"><i class="fa fa-eye"></i></a>Ver</li>
                                        @endcan
                                        @foreach ($q->planes as $plan)
                                            @can('revision_por_direccion_plan_accion')
                                                <li><a href="/admin/planes-de-accion/{{ $plan->id }}" class="btn btn-sm"
                                                        title="Plan de Acción"><i class="fa fa-stream"></i></a>Plan de
                                                        Accion
                                                </li>
                                            @endcan
                                        @endforeach

                                        @can('revision_por_direccion_visualizar_revisiones')
                                            <li><a class="btn btn-sm " title="Visualizar revisiones"
                                                    href="/admin/minutasaltadireccions/{{ $q->id }}/historial-revisiones">
                                                    <svg xmlns="http:www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                        <path
                                                            d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                                    </svg>
                                                </a>Versiones</li>
                                        @endcan
                                        @can('revision_por_direccion_eliminar')
                                            <li><button class="btn btn-sm text-danger" title="Eliminar"
                                                    onclick="Eliminar('/admin/minutasaltadireccions/{{ $q->id }}','{{ $q->tema_reunion }}')"><i
                                                        class="fa fa-trash-alt"></i></button>Eliminar</li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($query as $q)
        <div class="modal fade" id="participantsModal{{ $q->id }}" tabindex="-1"
            aria-labelledby="participantsModalLabel" aria-hidden="true">
            <button type="button"  style="position: relative; top: 7rem; right: 15rem;"  class="close" data-dismiss="modal" aria-label="Close" >
                <i class="fa-solid fa-x fa-2xl"
                style="color: #ffffff;"></i>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="text-align: center;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="participantsModalLabel"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Participantes</h5>
                    </div>
                    <div class="modal-body">
                        @foreach ($q->participantes as $index => $participante)
                            <img src="{{ asset('storage/empleados/imagenes/') }}/{{ $participante->avatar }}"
                                class="rounded-circle" alt="{{ $participante->name }}" title="{{ $participante->name }}"
                                style="object-fit: cover; clip-path: circle(50%); height: 30px; width: 30px; margin-right: 10px;">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [];
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
                    title: `¿Estás seguro de eliminar?`,
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
                                )
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Eliminado!',
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
