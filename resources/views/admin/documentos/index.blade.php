@extends('layouts.admin')
@section('content')
    @can('control_documentar_agregar')
        <h5 class="col-12 titulo_general_funcion">Control de Documentos</h5>
        <div class="mt-5 card">
        @endcan
        <div class="card-body datatable-fix">

            <div class="mb-2 row">
                <div class="col-4">
                    <label for=""><i class="fas fa-filter"></i> Filtrar por Tipo</label>
                    <select class="form-control {{ $errors->has('tipo') ? 'error-border' : '' }}" id="tipoSelect">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <option value="Proceso">Proceso</option>
                        <option value="Politica">Política</option>
                        <option value="Procedimiento">Procedimiento</option>
                        <option value="Manual">Manual</option>
                        <option value="Plan">Plan</option>
                        <option value="Instructivo">Instructivo</option>
                        <option value="Reglamento">Reglamento</option>
                        <option value="Externo">Documento Externo</option>
                        <option value="Formato">Formato</option>
                        <option value="">Todos</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for=""><i class="fas fa-filter"></i> Filtrar por Estatus</label>
                    <select class="form-control {{ $errors->has('tipo') ? 'error-border' : '' }}" id="estatusSelect">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <option value="Publicado">Publicado</option>
                        <option value="Rechazado">Rechazado</option>
                        <option value="En Revisión">En Revisión</option>
                        <option value="">Todos</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for=""><i class="fas fa-filter"></i> Filtrar por Vínculo</label>
                    <select class="form-control {{ $errors->has('tipo') ? 'error-border' : '' }}" id="vinculadoSelect">
                        <option value="" disabled selected>--Seleccionar--</option>
                        @foreach ($macroprocesosAndProcesos as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                        <option value="">Todos</option>
                    </select>
                </div>
            </div>

            @include('partials.flashMessages')
            <table id="tbl_documentos_control" class="table table-bordered w-100 datatable-ControlDocumento">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            Código&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th style="vertical-align: top">
                            Nombre
                        </th>
                        <th style="vertical-align: top">
                            Tipo
                        </th>

                        <th style="vertical-align: top">
                            Vinculado&nbsp;a
                        </th>
                        <th style="vertical-align: top">
                            Estatus
                        </th>
                        <th style="vertical-align: top">
                            Versión
                        </th>
                        <th style="vertical-align: top">
                            Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th style="vertical-align: top">
                            Elaboró
                        </th>
                        <th style="vertical-align: top">
                            Revisó
                        </th>
                        <th style="vertical-align: top">
                            Aprobó
                        </th>
                        <th style="vertical-align: top">
                            Responsable
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos as $documento)
                        <tr>
                            <td>
                                {{ $documento->codigo ?? '' }}
                            </td>
                            <td>
                                {{ $documento->nombre ?? '' }}
                            </td>
                            <td style="text-transform: capitalize">
                                {{ $documento->tipo ?? '' }}
                            </td>
                            @if ($documento->proceso_id == null)
                                <th style="vertical-align: top">
                                    {{ $documento->macroproceso ? $documento->macroproceso->nombre : 'Sin vincular' }}
                                </th>
                            @else
                                <th style="vertical-align: top">
                                    {{ $documento->proceso ? $documento->proceso->nombre : 'Sin vincular' }}
                                </th>
                            @endif
                            <td>
                                @if ($documento->estatus)
                                    @switch($documento->estatus)
                                        @case(1)
                                            <span class="badge badge-info">EN ELABORACIÓN</span>
                                        @break

                                        @case(2)
                                            <span class="badge badge-primary">EN REVISIÓN</span>
                                        @break

                                        @case(3)
                                            <span class="badge badge-success">PUBLICADO</span>
                                        @break

                                        @case(4)
                                            <span class="badge badge-danger">RECHAZADO</span>
                                        @break

                                        @default
                                            <span class="badge badge-info">EN ELABORACIÓN</span>
                                    @endswitch
                                @endif
                            </td>
                            <td>
                                {{ $documento->version == 0 ? 'Sin versión actualmente' : $documento->version }}
                            </td>
                            <td>
                                {{ $documento->fecha_dmy ?? '' }}
                            </td>
                            <td>
                                @if ($documento->elaborador)
                                    <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->elaborador->avatar }}"
                                        class="rounded-circle" alt="{{ $documento->elaborador->name }}"
                                        title="{{ $documento->elaborador->name }}" width="40">
                                @else
                                    <span class="badge badge-info">Sin Asignar</span>
                                @endif
                            </td>
                            <td>
                                @if ($documento->revisor)
                                    <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->revisor->avatar }}"
                                        class="rounded-circle" alt="{{ $documento->revisor->name }}"
                                        title="{{ $documento->revisor->name }}" width="40">
                                @else
                                    <span class="badge badge-info">Sin Asignar</span>
                                @endif
                            </td>
                            <td>
                                @if ($documento->aprobador)
                                    <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->aprobador->avatar }}"
                                        class="rounded-circle" alt="{{ $documento->aprobador->name }}"
                                        title="{{ $documento->aprobador->name }}" width="40">
                                @else
                                    <span class="badge badge-info">Sin Asignar</span>
                                @endif
                            </td>
                            <td>
                                @if ($documento->responsable)
                                    <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->responsable->avatar }}"
                                        class="rounded-circle" alt="{{ $documento->responsable->name }}"
                                        title="{{ $documento->responsable->name }}" width="40">
                                @else
                                    <span class="badge badge-info">Sin Asignar</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @can('control_documentar_editar')
                                        @if ($documento->estatus != '2')
                                            <a class="btn btn-sm " title="Editar"
                                                href="{{ route('admin.documentos.edit', $documento->id) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    @endcan
                                    @can('control_documentar_visualizar_documento')
                                        <a class="btn btn-sm" title="Visualizar Documento"
                                            href="{{ route('admin.documentos.renderViewDocument', $documento) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                <path
                                                    d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('control_documentar_visualizar_revisiones')
                                        <a class="btn btn-sm " title="Visualizar revisiones"
                                            href="{{ route('admin.documentos.renderHistoryReview', $documento->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                <path
                                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('control_documentar_visualizar_versionamiento')
                                        @if ($documento->version >= 1)
                                            <a class="btn btn-sm " title="Visualizar versionamiento"
                                                href="{{ route('admin.documentos.renderHistoryVersions', $documento->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z" />
                                                </svg>
                                            </a>
                                        @endif
                                    @endcan
                                    @can('control_documentar_eliminar')
                                        <button data-tipo="{{ $documento->tipo }}" title="Hacer obsoleto"
                                            onclick="hacerObsoleto(this,'{{ route('admin.documentos.destroy', $documento) }}','{{ $documento->id }}');return false;"
                                            class="btn btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    @endcan
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        // $(function() {


        //     let table = $('#tbl_documentos_control').DataTable({
        //         destroy: true,
        //         buttons: dtButtons,
        //     });
        // });

        async function obtenerDependencias(documento_id) {
            let api = await fetch("{{ route('admin.documentos.getDocumentDependencies') }}", {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    documento_id
                }) // body data type must match "Content-Type" header
            });
            let data = await api.json();
            return data;
        }

        const hacerObsoleto = async function(boton, url, documento_id) {
            let isTipoProceso = boton.getAttribute('data-tipo') == 'proceso';
            let dependencias = await obtenerDependencias(
                documento_id); // se obtienen las dependencias del proceso
            console.log(dependencias);
            Swal.fire({
                title: '¿Está seguro de marcar como obsoleto este documento?',
                html: `<div style="text-align: left;">El documento será <strong style="color:red">eliminado</strong> de los siguientes apartados:</div>
                    <ul style="text-align:left;">
                        ${isTipoProceso ? '<li>Procesos</li>':''}
                        <li>Gestor documental</li>
                        <li>Tabla documentos</li>
                    </ul>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hacer obsoleto',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (dependencias.dependencias == null || dependencias.dependencias.length == 0) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    "content"),
                            },
                            data: {
                                delete_documents: false
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                    Swal.fire('Documentos obsoleto',
                                        'El documento se ha hecho obsoleto',
                                        'info')
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1500);
                                }
                            },
                            error: function(err) {
                                console.log(err);
                                Swal.fire(
                                    'Error!',
                                    `${err.responseText}`,
                                    'error'
                                );
                            }
                        });
                    } else {
                        Swal.fire({
                            title: '¿Desea eliminar los documentos dependientes al proceso?',
                            html: `<div style="overflow: auto;max-height: 200px;">
                        <ul>
                        ${dependencias.dependencias.map(dependencia => {
                            return `<li><i class="fas fa-file-pdf"></i> ${dependencia.codigo}-${dependencia.nombre}-<span style="text-transform:capitalize">[${dependencia.tipo}]</span></li>`;
                        })}
                        </ul>
                    </div>`,
                            icon: 'question',
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: `Eliminar`,
                            denyButtonText: `Conservarlos`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            "content"),
                                    },
                                    data: {
                                        delete_documents: true
                                    },
                                    dataType: "JSON",
                                    success: function(response) {
                                        console.log(response);
                                        if (response.success) {
                                            Swal.fire('Obsoleto!',
                                                'El proceso y todas sus dependencias fueron eliminadas',
                                                'success')
                                            setTimeout(() => {
                                                window.location.reload();
                                            }, 1500);
                                        }
                                    },
                                    error: function(err) {
                                        console.log(err);
                                        Swal.fire(
                                            'Error!',
                                            `${err.responseText}`,
                                            'error'
                                        );
                                    }
                                });
                            } else if (result.isDenied) {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            "content"),
                                    },
                                    data: {
                                        delete_documents: false
                                    },
                                    dataType: "JSON",
                                    success: function(response) {
                                        console.log(response);
                                        if (response.success) {
                                            Swal.fire('Documentos conservados',
                                                'Las dependecias fueron conservadas, pero no están asignadas a ningun proceso',
                                                'info')
                                            setTimeout(() => {
                                                window.location.reload();
                                            }, 1500);
                                        }
                                    },
                                    error: function(err) {
                                        console.log(err);
                                        Swal.fire(
                                            'Error!',
                                            `${err.responseText}`,
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    }
                }
            })
        }
    </script>


    <script>
        $(document).ready(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
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

            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar Documento',
                titleAttr: 'Agregar documento',
                url: "{{ route('admin.documentos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };

            dtButtons.push(btnAgregar);
            let tblDocumentos = $("#tbl_documentos_control").DataTable({
                buttons: dtButtons,
            });

            $('#tipoSelect').on('change', function() {
                console.log(this.value);
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    tblDocumentos.columns(2).search(this.value, true, false).draw();
                } else {
                    this.style.border = "1px solid rgb(206 212 218)";
                    tblDocumentos.columns(2).search(this.value).draw();
                }
            });
            $('#estatusSelect').on('change', function() {
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    tblDocumentos.search(this.value.toUpperCase(), true, false)
                        .draw();
                } else {
                    this.style.border = "1px solid rgb(206 212 218)";
                    tblDocumentos.search(this.value)
                        .draw();
                }
            });
            $('#vinculadoSelect').on('change', function() {
                if (this.value != null && this.value != "") {
                    this.style.border = "2px solid #20a4a1";
                    tblDocumentos.search(this.value, true, false)
                        .draw();
                } else {
                    this.style.border = "1px solid rgb(206 212 218)";
                    tblDocumentos.search(this.value)
                        .draw();
                }
            });
        });
    </script>
@endsection
