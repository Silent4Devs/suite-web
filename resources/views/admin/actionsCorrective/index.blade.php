@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.accion-correctivas.index') }}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/centerAttention/cards.css') }}{{ config('app.cssVersion') }}">

    {{--
    <style>
        /* Estilos para los encabezados de la tabla */
        .table tr th:nth-child(1) {
            min-width: 80px !important;
            text-align: center !important;
            /* Alineación centrada */
        }

        .table tr th:nth-child(2) {
            min-width: 150px !important;
            text-align: center !important;
            /* Alineación centrada */
        }

        /* Alineación de texto a la izquierda para los demás encabezados */
        .table tr th:nth-child(n+3) {
            text-align: left !important;
        }

        /* Estilos para las celdas de la tabla */
        .table td {
            padding: 8px 15px !important;
            /* Ajusta el espaciado de las celdas */
            vertical-align: middle !important;
            /* Alineación vertical */
        }

        /* Alineación justificada en las celdas que tengan la clase .descripcion o .comentarios */
        .descripcion,
        .comentarios {
            text-align: justify !important;
        }

        /* Estilo para el texto en las tarjetas (si las tienes en alguna sección) */
        .textoCentroCard {
            font-size: 12pt !important;
        }

        /* Aseguramos que la tabla no se desborde */
        table.dataTable {
            width: 100% !important;
            /* Aseguramos que la tabla ocupe todo el ancho disponible */
            border-collapse: collapse !important;
            /* Evitamos bordes dobles en la tabla */
        }

        /* Estilo de las celdas para evitar desalineación en DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: inline-block;
            padding: 10px;
        }

        /* Estilo de los botones de paginación */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #f8f9fa;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #e9ecef;
        }

        /* Estilo del buscador (input) */
        .dataTables_wrapper .dataTables_filter input {
            padding: 5px 10px;
            margin-left: 10px;
            font-size: 14px;
        }

        /* Aseguramos que la tabla se vea bien en pantallas pequeñas */
        @media (max-width: 768px) {

            .table td,
            .table th {
                padding: 8px;
                /* Reducir el padding en pantallas pequeñas */
            }
        }

        /* Estilo para las filas de la tabla cuando pasamos el mouse sobre ellas */
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style> --}}
    <style>
    .caja_botones_menu a.btn_activo, .caja_botones_menu a.btn_activo:hover {
    background-color:#e9ecef !important;
    box-shadow: 0 -2px;
    color: #fff;
}
    </style>


    <h5 class="col-12 titulo_general_funcion">Acciones Correctivas</h5>

    <div class="caja_botones_menu mt-4">
        <a href="#" data-tabs="aprobaciones" class="btn_activo"><i class="mr-2 bi bi-check2"></i>Solicitudes</a>
        <a href="#" data-tabs="indexAc"><i class="mr-2 fas fa-clipboard-list"></i>Acciones
            Correctivas</a>
    </div>
    <div class="row mt-4 ">
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-celeste">
                <div class="numero"><i class="fas fa-exclamation-triangle mr-2"></i> {{ $total_AC }}</div>
                <div class="textoCentroCard">AC</div>
            </div>
        </div>
        <div class="col-6 col-md-2 ">
            <div class="tarjetas_seguridad_indicadores cdr-amarillo">
                <div class="numero"><i class="far fa-arrow-alt-circle-right mr-2"></i> {{ $nuevos_AC }}</div>
                <div class="textoCentroCard">Sin atender</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-morado">
                <div class="numero"><i class="fas fa-redo-alt mr-2"></i> {{ $en_curso_AC }}</div>
                <div class="textoCentroCard">En curso</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-azul">
                <div class="numero"><i class="fas fa-history mr-2"></i> {{ $en_espera_AC }}</div>
                <div class="textoCentroCard">En espera</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-verde">
                <div class="numero"><i class="far fa-check-circle mr-2"></i> {{ $cerrados_AC }} </div>
                <div class="textoCentroCard">Cerrados</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-rojo">
                <div class="numero"><i class="bi bi-dash-circle mr-2"></i></strong> {{ $cancelados_AC }}</div>
                <div class="textoCentroCard">No procedentes</div>
            </div>
        </div>
    </div>

    <div class="caja_caja_secciones">
        <div class="caja_secciones">
            <section id="indexAc">
                <div class="text-right">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.accion-correctivas.create') }}" type="button"
                            class="btn tb-btn-primary">Registrar Acción</a>
                    </div>
                </div>

                <div class="mt-1 card">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8 align-content-center">
                                @include('layouts.errors')

                            </div>
                            <div class="col-sm-2">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body datatable-fix">
                            <table class="table datatable-AccionCorrectiva">
                                <thead class="thead-dark">
                                    <tr>
                                        {{-- <th style="vertical-align: top">
                                            {{ trans('cruds.accionCorrectiva.fields.id') }}
                                        </th> --}}
                                        <th>
                                            Folio
                                        </th>
                                        <th>
                                            Título
                                        </th>
                                        <th>
                                            Fecha&nbsp;y&nbsp;hora&nbsp;de&nbsp;registro
                                        </th>
                                        {{-- <th>
                                            Fecha&nbsp;y&nbsp;hora&nbsp;de&nbsp;recepción
                                        </th> --}}
                                        <th>
                                            Estatus
                                        </th>
                                        {{-- <th>
                                            Fecha&nbsp;y&nbsp;hora&nbsp;de&nbsp;cierre&nbsp;de&nbsp;ticket
                                        </th> --}}
                                        <th>
                                            Reportó
                                        </th>
                                        {{-- <th>
                                            Puesto
                                        </th> --}}
                                        {{-- <th>
                                            Área
                                        </th> --}}
                                        <th>
                                            Registró
                                        </th>
                                        {{-- <th>
                                            Puesto
                                        </th> --}}
                                        {{-- <th style="vertical-align: top">
                                            Área
                                        </th> --}}
                                        <th>
                                            Causa&nbsp;de&nbsp;origen
                                        </th>
                                        {{-- <th>
                                            Descripción
                                        </th> --}}
                                        <th>
                                            Opciones
                                        </th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($query_ac as $accion_correctiva)
                                        <tr>
                                            <td>
                                                {{ $accion_correctiva->folio }}
                                            </td>
                                            <td>
                                                {{ $accion_correctiva->tema }}
                                            </td>
                                            <td>
                                                {{ $accion_correctiva->fecharegistro ? $accion_correctiva->fecharegistro : 'sin dato' }}
                                            </td>
                                            {{-- <th>
                                                {{$accion_correctiva->fecha_verificacion ? $accion_correctiva->fecha_verificacion : 'sin dato'}}
                                            </th> --}}
                                            <td>
                                                {{ $accion_correctiva->estatus }}
                                            </td>
                                            <td>
                                                {{-- {{ $accion_correctiva->rp_name ? $accion_correctiva->rp_name : 'Sin dato' }} --}}
                                                <br>
                                                @if ($accion_correctiva->rp_foto)
                                                    <div class="img-person">
                                                        <img src="{{ asset('storage/empleados/imagenes/' . $accion_correctiva->rp_foto) }}"
                                                            title="{{ $accion_correctiva->rp_name }}">
                                                    </div>
                                                @else
                                                    sin dato
                                                @endif
                                                {{-- {{ $accion_correctiva->rp_foto ? $accion_correctiva->rp_foto : 'sin foto' }} --}}
                                            </td>
                                            {{-- <th>
                                                {{ $accion_correctiva->reporto_puesto }}
                                            </th>
                                            <th>
                                                {{ $accion_correctiva->reporto_area}}
                                            </th> --}}
                                            <td>
                                                {{ $accion_correctiva->registro ? $accion_correctiva->registro : 'sin dato' }}
                                            </td>
                                            {{-- <th>
                                                {{ $accion_correctiva->registro_puesto}}
                                            </th> --}}
                                            {{-- <th>
                                                {{ $accion_correctiva->registro_area}}
                                            </th> --}}
                                            <td>
                                                {{ $accion_correctiva->causaorigen }}
                                            </td>
                                            {{-- <th>
                                                {{ $accion_correctiva->descripcion }}
                                            </th> --}}
                                            {{-- <th>
                                                {{ $accion_correctiva->comentarios}}
                                            </th> --}}
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button class="btn p-0 m-0" type="button" data-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- Opción para Editar --}}
                                                        <a href="{{ route('admin.accion-correctivas.edit', ['accion_correctiva' => $accion_correctiva->id]) }}"
                                                            class="dropdown-item">
                                                            <span class="material-symbols-outlined">
                                                                edit
                                                            </span>
                                                            Editar
                                                        </a>

                                                        {{-- Opción para Eliminar --}}
                                                        <form
                                                            action="{{ route('admin.accion-correctivas.destroy', $accion_correctiva->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="material-symbols-outlined"
                                                                        style="width: 24px; font-size:18px;">delete</i>
                                                                    Eliminar
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section id="aprobaciones" class="caja_tab_reveldada">
                <div class="text-right">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.accion-correctivas.create') }}" type="button"
                            class="btn tb-btn-primary">Registrar Solicitud</a>
                    </div>
                </div>
                <div class="mt-1 card">
                    <div class="card-body datatable-fix">
                        <table id="tabla_usuario_aprobaciones" class="table">
                            <thead>
                                <tr>
                                    <th style=" min-width:80px; text-align: left !important;">
                                        Folio
                                    </th>
                                    <th style=" min-width:120px !important; text-align: left !important;">
                                        Origen
                                    </th>
                                    <th style="vertical-align: top; text-align: left !important; min-width:70px;">
                                        Fecha
                                    </th>
                                    <th style="vertical-align: top; text-align: center !important; min-width:80px;">
                                        Solicitante
                                    </th>
                                    <th style="vertical-align: top; text-align: center !important; min-width:80px;">
                                        Aprobador
                                    </th>
                                    <th style="vertical-align: top; text-align: center !important; min-width:70px;">
                                        Revisar
                                    </th>
                                    <th style="vertical-align: top  min-width:80px;">
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accionesCorrectivas as $accionCorrectiva)
                                    <tr>
                                        <td>
                                            {{ $accionCorrectiva->folio ? $accionCorrectiva->folio : 'Sin dato' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->causaorigen ? $accionCorrectiva->causaorigen : 'Sin dato' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->fecharegistro ? $accionCorrectiva->fecharegistro : 'Sin dato' }}
                                        </td>
                                        <td>
                                            @if (isset($accionCorrectiva->deskQuejaCliente[0]->registro))
                                                <div class="img-person">
                                                    @if ($accionCorrectiva->deskQuejaCliente[0]->registro->foto)
                                                        {{-- Suponiendo que la columna es "foto" --}}
                                                        <img src="{{ asset('storage/empleados/imagenes/' . $accionCorrectiva->deskQuejaCliente[0]->registro->foto) }}"
                                                            title="{{ $accionCorrectiva->deskQuejaCliente[0]->registro->name }}">
                                                    @else
                                                        Sin foto
                                                    @endif
                                                </div>
                                                {{-- {{ $accionCorrectiva->deskQuejaCliente[0]->registro->name }} --}}
                                            @else
                                                Sin dato
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($accionCorrectiva->deskQuejaCliente[0]->responsableAtencion))
                                                <div class="img-person">
                                                    @if ($accionCorrectiva->deskQuejaCliente[0]->responsableAtencion->foto)
                                                        {{-- Suponiendo que la columna es "foto" --}}
                                                        <img src="{{ asset('storage/empleados/imagenes/' . $accionCorrectiva->deskQuejaCliente[0]->responsableAtencion->foto) }}"
                                                            title="{{ $accionCorrectiva->deskQuejaCliente[0]->responsableAtencion->name }}">
                                                    @else
                                                        Sin foto
                                                    @endif
                                                </div>
                                                {{-- {{ $accionCorrectiva->deskQuejaCliente[0]->responsableAtencion->name }} --}}
                                            @else
                                                Sin dato
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($accionCorrectiva->deskQuejaCliente[0]->responsableSgi))
                                                <div class="img-person">
                                                    @if ($accionCorrectiva->deskQuejaCliente[0]->responsableSgi->foto)
                                                        {{-- Suponiendo que la columna es "foto" --}}
                                                        <img src="{{ asset('storage/empleados/imagenes/' . $accionCorrectiva->deskQuejaCliente[0]->responsableSgi->foto) }}"
                                                            title="{{ $accionCorrectiva->deskQuejaCliente[0]->responsableSgi->name }}">
                                                    @else
                                                        Sin foto
                                                    @endif
                                                </div>
                                                {{-- {{ $accionCorrectiva->deskQuejaCliente[0]->responsableSgi->name }} --}}
                                            @else
                                                Sin dato
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button class="btn p-0 m-0" type="button" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form action="{{ route('admin.accion-correctivas.aprobarRechazar') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $accionCorrectiva->id }}">
                                                        <input type="hidden" name="id_queja_cliente"
                                                            value="{{ $accionCorrectiva->deskQuejaCliente[0]->id }}">
                                                        <input type="hidden" name="aprobada" value="true">
                                                        <button class="dropdown-item" type="submit">
                                                            <div class="d-flex align-items-center">
                                                                <span class="material-symbols-outlined">
                                                                    thumb_up
                                                                </span>
                                                                Aprobar
                                                            </div>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.accion-correctivas.aprobarRechazar') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $accionCorrectiva->id }}">
                                                        <input type="hidden" name="id_queja_cliente"
                                                            value="{{ $accionCorrectiva->deskQuejaCliente[0]->id }}">
                                                        <input type="hidden" name="aprobada" value="false">
                                                        <button class="dropdown-item" type="submit">
                                                            <div class="d-flex align-items-center">
                                                                <span class="material-symbols-outlined">
                                                                    thumb_down
                                                                </span>
                                                                Rechazar
                                                            </div>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('admin.accion-correctivas.edit', ['accion_correctiva' => $accionCorrectiva->id]) }}"
                                                        class="dropdown-item">
                                                        <span class="material-symbols-outlined">
                                                            edit

                                                        </span>
                                                        Editar
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

    </div>
@endsection
@section('scripts')
    @parent
    {{-- <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 6.5;
                        doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
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
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.accion-correctivas.massDestroy') }}",
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
            //dtBu@endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                // serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.accion-correctivas.index') }}",
                columnDefs: [{
                    visible: false
                }],
                // columns: [{
                //         data: 'folio',
                //         name: 'folio',
                //         render: function(data, type, row) {
                //             return `<div style="text-align:left">${data}</div>`;
                //         }
                //     },
                //     {
                //         data: 'tema',
                //         name: 'tema',
                //         render: function(data, type, row) {
                //             return `<div style="text-align:left">${data}</div>`;
                //         }
                //     },
                //     {
                //         data: 'fecharegistro',
                //         name: 'fecharegistro',
                //         render: function(data, type, row) {
                //             return `<div style="text-align:left">${data}</div>`;
                //         }
                //     },
                //     // {
                //     //     data: 'fecha_verificacion',
                //     //     name: 'fecha_verificacion',
                //     //     render: function(data, type, row) {
                //     //         return `<div style="text-align:left">${data}</div>`;
                //     //     }
                //     // },
                //     {
                //         data: 'estatus',
                //         name: 'estatus',
                //         render: function(data, type, row) {
                //             return `<div style="text-align:left">${data}</div>`;
                //         }
                //     },
                //     // {
                //     //     data: 'fecha_cierre',
                //     //     name: 'fecha_cierre',
                //     //     render: function(data, type, row) {
                //     //         return `<div style="text-align:left">${data}</div>`;
                //     //     }
                //     // },
                //     {
                //         data: 'reporto',
                //         name: 'reporto',
                //         render: function(data, type, row) {
                //             return `<div style="text-align:left">${data}</div>`;
                //         }
                //     },
                //     // {
                //     //     data: 'reporto_puesto',
                //     //     name: 'reporto_puesto',
                //     //     render: function(data, type, row) {
                //     //         return `<div style="text-align:left">${data}</div>`;
                //     //     }
                //     // },
                //     // {
                //     //     data: 'reporto_area',
                //     //     name: 'reporto_area',
                //     //     render: function(data, type, row) {
                //     //         return `<div style="text-align:left">${data}</div>`;
                //     //     }
                //     // },
                //     {
                //         data: 'registro',
                //         name: 'registro',
                //         render: function(data, type, row) {
                //             return `<div style="text-align:left">${data}</div>`;
                //         }
                //     },
                //     // {
                //     //     data: 'registro_puesto',
                //     //     name: 'registro_puesto',
                //     //     render: function(data, type, row) {
                //     //         return `<div style="text-align:left">${data}</div>`;
                //     //     }
                //     // },
                //     // {
                //     //     data: 'registro_area',
                //     //     name: 'registro_area',
                //     //     render: function(data, type, row) {
                //     //         return `<div style="text-align:left">${data}</div>`;
                //     //     }
                //     // },
                //     {
                //         data: 'causaorigen',
                //         name: 'causaorigen',
                //         render: function(data, type, row) {
                //             return `<div style="text-align:left">${data}</div>`;
                //         }
                //     },
                //     // {
                //     //     data: 'descripcion',
                //     //     name: 'descripcion',
                //     //     render: function(data, type, row) {
                //     //         return `<div style="text-align:left">${data}</div>`;
                //     //     }
                //     // },
                //     {
                //         data: 'actions',
                //         name: '{{ trans('global.actions') }}'
                //     }
                // ],
                createdRow: (row, data, dataIndex, cells) => {
                    let fondo = "green";
                    let letras = "white";
                    if (data.estatus == 'Sin atender') {
                        fondo = "#FFCB63";
                        letras = "white";
                    }
                    if (data.estatus == 'En curso') {
                        fondo = "#AC84FF";
                        letras = "white";
                    }
                    if (data.estatus == 'En espera') {
                        fondo = "#6863FF";
                        letras = "white";
                    }
                    if (data.estatus == 'Cerrado') {
                        fondo = "#6DC866";
                        letras = "white";
                    }
                    if (data.estatus == 'No procedente') {
                        fondo = "#FF417B";
                        letras = "white";
                    }
                    if (data.estatus != null) {
                        $(cells[4]).css('background-color', fondo)
                        $(cells[4]).css('color', letras)
                    }

                },
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-AccionCorrectiva').DataTable(dtOverrideGlobals);


            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            let dtButtonsAprobacion = [{
                    extend: 'csvHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 6.5;
                        doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
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

            // let btnAgregarAprobacion = {
            //     // text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     // titleAttr: 'Agregar acciones correctivas',
            //     // url: "{{ route('admin.accion-correctivas.create') }}",
            //     // className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //     // action: function(e, dt, node, config) {
            //     //     let {
            //     //         url
            //     //     } = config;
            //     //     window.location.href = url;
            //     // }
            // };
            // // dtButtonsAprobacion.push(btnAgregarAprobacion);

            let deleteButtonTransAprobacion = '{{ trans('global.datatables.delete') }}';
            let deleteButtonAprobacion = {
                text: deleteButtonTransAprobacion,
                url: "{{ route('admin.accion-correctivas.massDestroy') }}",
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
            dtButtons.push(deleteButton)


            let dtOverrideGlobalsAprobacion = {
                buttons: dtButtonsAprobacion,
                processing: false,
                serverSide: false,
                retrieve: true,
                aaSorting: [],
                columnDefs: [{
                    visible: false
                }],
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            console.log(row);
                            if (row.desk_queja_cliente.length > 0) {
                                let item = row.desk_queja_cliente[0];
                                return item.folio
                            } else {

                                return `Sin folio`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            console.log(row,'aqui');
                            if (row.desk_queja_cliente.length > 0) {

                                return `Quejas Clientes`
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {

                            if (row.desk_queja_cliente.length > 0) {
                                let stringDate = row.desk_queja_cliente[0].pivot.created_at;
                                let splitDate = stringDate.split('T');
                                let newDate = splitDate[0];
                                let splitNewDate = newDate.split('-');
                                let formatted_date =
                                    `${splitNewDate[2]}-${splitNewDate[1]}-${splitNewDate[0]}`;
                                return formatted_date;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                return `<div><img class="ml-4 img_empleado" src="${row.desk_queja_cliente[0].registro.avatar_ruta}" title="${row.desk_queja_cliente[0].registro.name}"></div>`;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                return `<div><img class="ml-4 img_empleado" src="${row.desk_queja_cliente[0].responsable_sgi.avatar_ruta}" title="${row.desk_queja_cliente[0].responsable_sgi.name}"></div>`;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                let link = `<a href="{{ route('admin.desk.quejasClientes-edit', ':id') }}">
                                <div class=""><i class="ml-4 text-center fas fa-eye"></i></div>
                                </a>`;
                                link = link.replaceAll(':id', row.desk_queja_cliente[0].id);
                                console.log(link);
                                return link;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                let opciones = `
                        <div><button class="btn text-success" onclick="aprobarAc('${data}',true,'${row.desk_queja_cliente[0].id}')"><i class="text-success iconos-crear far fa-thumbs-up"></i></button>
                            <button class="btn text-danger" onclick="aprobarAc('${data}',false, '${row.desk_queja_cliente[0].id}')"><i class="text-danger iconos-crear far fa-thumbs-down"></i></button></div>
                        `
                                return opciones;
                            } else {

                                return `Sin definir`
                            }
                        }

                    },

                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let tableAprobacion = $('#tabla_usuario_aprobaciones').DataTable(dtOverrideGlobalsAprobacion);
             window.aprobarAc = (id_accion_corectiva, aprobada, id_queja_cliente) => {
                let url = "{{ route('admin.accion-correctivas.aprobarRechazar') }}";
                Swal.fire({
                    title: `¿Está seguro(a) de ${aprobada?'aprobar':'rechazar'} este ticket?`,
                    text: 'Comentarios',
                    icon: 'warning',
                    input: 'textarea',
                    inputAttributes: {
                        input: 'textarea',
                        required: !aprobada
                    },
                    inputValidator: (value) => {
                        if (!aprobada) {
                            if (value.trim().length < 3) {
                                return 'El campo comentarios debe tener al menos 3 caracteres'
                            }
                        }

                    },
                    showCancelButton: true,
                    confirmButtonText: `Si, ${aprobada?'aprobar':'rechazar'}`,
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        console.log(login);

                        return fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': _token,
                                    'Content-Type': 'application/json',
                                    Accept: 'application/json'
                                },
                                body: JSON.stringify({
                                    id: id_accion_corectiva,
                                    aprobada,
                                    id_queja_cliente,
                                    comentarios: login
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value.success) {
                            Swal.fire(
                                `${result.value.message}`,
                                `La respuesta ha sido enviada con éxito`,
                                'success'
                            ).then(() => {
                                // window.location.reload();
                                table.ajax.reload();
                                tableAprobacion.ajax.reload()

                            });

                        }

                    }
                })


            }


        });
    </script> --}}
    <script>
        $(function() {
            // Función para inicializar una DataTable con configuración personalizada
            function initDataTable(selector, exportTitle) {
                let dtButtons = [{
                        extend: 'csvHtml5',
                        title: `${exportTitle} ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar CSV',
                        exportOptions: {
                            columns: ':not(:last-child):visible' // Excluir última columna
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: `${exportTitle} ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            columns: ':not(:last-child):visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: `${exportTitle} ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar PDF',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: ':not(:last-child):visible'
                        },
                        customize: function(doc) {
                            doc.pageMargins = [5, 20, 5, 20];
                            doc.styles.tableHeader.fontSize = 6.5;
                            doc.defaultStyle.fontSize = 6.5;
                        }
                    },
                    {
                        extend: 'print',
                        title: `${exportTitle} ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Imprimir',
                        exportOptions: {
                            columns: ':not(:last-child):visible'
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

                // Configuración general para DataTable
                let dtOverrideGlobals = {
                    buttons: dtButtons,
                    processing: true,
                    retrieve: true,
                    autoWidth: false,
                    orderCellsTop: true,
                    order: [
                        [0, 'desc']
                    ], // Ordenar por la primera columna (descendente)
                    // columnDefs: [
                    //     { orderable: false, targets: -1 }, // Última columna no ordenable
                    //     { className: 'text-center', targets: '_all' }, // Centrar todo el contenido
                    //     {
                    //         targets: -1, // Última columna: Opciones
                    //         render: function(data, type, row, meta) {
                    //             console.log(row.desk_queja_cliente);
                    //             if (row.desk_queja_cliente && row.desk_queja_cliente.length > 0) {
                    //                 let id = row.desk_queja_cliente[0].id;
                    //                 return `
                //                     <div>
                //                         <button class="btn text-success" onclick="aprobarAc('${row.id}', true, '${id}')">
                //                             <i class="text-success iconos-crear far fa-thumbs-up"></i>
                //                         </button>
                //                         <button class="btn text-danger" onclick="aprobarAc('${row.id}', false, '${id}')">
                //                             <i class="text-danger iconos-crear far fa-thumbs-down"></i>
                //                         </button>
                //                     </div>
                //                 `;
                    //             } else {
                    //                 return `<span>Sin opciones</span>`;
                    //             }
                    //         }
                    //     }
                    // ],
                    createdRow: (row, data, dataIndex, cells) => {
                        if (data.estatus) {
                            let fondo = "white",
                                letras = "black";
                            if (data.estatus === 'Sin atender') fondo = "#FFCB63";
                            else if (data.estatus === 'En curso') fondo = "#AC84FF";
                            else if (data.estatus === 'En espera') fondo = "#6863FF";
                            else if (data.estatus === 'Cerrado') fondo = "#6DC866";
                            else if (data.estatus === 'No procedente') fondo = "#FF417B";

                            $(cells[4]).css('background-color', fondo);
                            $(cells[4]).css('color', letras);
                        }
                    }
                };

                // Inicializar DataTable para el selector proporcionado
                let table = $(selector).DataTable(dtOverrideGlobals);
                table.columns.adjust().draw();
            }

            // Inicializar DataTable para la tabla de acciones correctivas
            initDataTable('.datatable-AccionCorrectiva', 'Acciones Correctivas');

            // Inicializar DataTable para la tabla de usuario aprobaciones
            initDataTable('#tabla_usuario_aprobaciones', 'Usuario Aprobaciones');

        });
    </script>
@endsection
