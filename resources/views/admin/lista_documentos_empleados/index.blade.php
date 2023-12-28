@extends('layouts.admin')
@section('content')

    <style type="text/css">
        #tipo_doc {
            color: #fff;
            padding: 5px;
            border-radius: 4px;
        }

        #tipo_doc.opcional {
            background-color: #25B82B;
            text-transform: capitalize;
        }

        #tipo_doc.obligatorio {
            background-color: #DD3939;
            text-transform: capitalize;
        }

        #tipo_doc.aplica {
            background-color: #FA8E1C;
        }

        #tipo_doc.aplica::before {
            content: "Solo si ";
        }

    </style>

    {{ Breadcrumbs::render('EV360-ListaDocumentosEmpleados') }}
    <h5 class="col-12 titulo_general_funcion">Lista de Documentos de Empleados</h5>

    <div class="text-right">
        <div class="d-flex justify-content-end">
            <div class="btn btn-success" data-toggle="modal" data-target="#modal_crear_doc_e">Agregar</div>
        </div>
    </div>
        @include('partials.flashMessages')
        <div class="datatable-fix datatable-rds">
            <h3 class="title-table-rds"> Lista de Documentos de Empleados</h3>
            <table class="datatable  datatable-Perfiles" id="tabla_list_docs">
                <thead class="thead-dark">
                    <tr>
                        <th>Documento</th>
                        <th style="max-width:100px;">Tipo</th>
                        <th style="max-width:100px;">ID</th>
                        <th style="max-width:100px;">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docs as $doc)
                        <tr>
                            <td>{{ $doc->documento }}</td>
                            <td style="text-transform:capitalize;">
                                <font id="tipo_doc" class="{{ $doc->tipo }}">{{ $doc->tipo }}</font>
                            </td>
                            <td>
                                @if ($doc->activar_numero == true)
                                    Requerido
                                @endif
                                @if ($doc->activar_numero == false)
                                    No requerido
                                @endif
                            </td>
                            <td>
                                @can('lista_de_documentos_empleados_eliminar')
                                    <a href="{{ asset('admin/lista-documentos/destroy') }}/{{ $doc->id }}"><i
                                            class="fas fa-trash-alt" style="font-size:15pt; color:#ED5A5A;"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    {{-- modal crar --}}
    <div class="modal fade" id="modal_crear_doc_e" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('admin.lista-documentos-empleados-store') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Documento a Lista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="far fa-file-alt iconos-crear"></i>Nombre del documento</label>
                        <input type="" name="documento" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><i class="far fa-file-alt iconos-crear"></i>Tipo</label>
                        <select class="form-control" name="tipo">
                            <option value="opcional" selected>Opcional</option>
                            <option value="obligatorio">Obligatorio</option>
                            <option value="aplica">Solo si aplica</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="far fa-file-alt iconos-crear"></i>ID Requerido</label>
                        <input type="checkbox" name="activar_numero" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <div type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</div>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 10;
                        doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
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
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar',
            //     url: "#",
            //     className: 'btn-xs btn-outline-success rounded ml-2 pr-3',
            //     action: function(e, dt, node, config) {
            //     let {
            //     url
            //     } = config;
            //     window.location.href = url;
            //     }
            // };

            // dtButtons.push(btnAgregar);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('#tabla_list_docs').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection
