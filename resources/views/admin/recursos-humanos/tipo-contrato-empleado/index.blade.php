@extends('layouts.admin')
@section('content')
        {{ Breadcrumbs::render('EV360-Tipo-Contrato-Empleados') }}
        <h5 class="col-12 titulo_general_funcion">Tipos de contrato para empleados</h5>


        <div class="text-right">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.tipos-contratos-empleados.create') }}" type="button" class="btn btn-primary">Registrar Contrato</a>
            </div>
    </div>
            @include('partials.flashMessages')
            <div class="datatable-fix datatable-rds">
                <h3 class="title-table-rds"> Contratos</h3>
                <table id="tblTiposContratoEmpleados" class="datatable datatable-ControlDocumento">
                    <thead class="thead-dark">
                        <tr>
                            <th style="vertical-align: top">
                                ID
                            </th>
                            <th style="vertical-align: top">
                                Nombre
                            </th>
                            <th style="vertical-align: top">
                                Descripción
                            </th>
                            <th style="vertical-align: top">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Tipos de contratos de empleados ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Tipos de contratos de empleados ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Tipos de contratos de empleados ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Tipos de contratos de empleados ${new Date().toLocaleDateString().trim()}`,
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
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.tipos-contratos-empleados.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function(data, type, row, meta) {
                            if (data) {
                                if (data.length > 50) {
                                    return `${data.substr(0, 50)}...`;
                                }
                                return `${data.substr(0, 50)}`;
                            }
                            return "Sin descripción"
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            const urlEdit =
                                `/admin/recursos-humanos/tipos-contratos-empleados/${data}/edit`;
                            const urlShowDelete =
                                `/admin/recursos-humanos/tipos-contratos-empleados/${data}`;
                            const html = `
                            @can('tipos_de_contrato_para_empleados_editar')
                                <a class="btn btn-sm " title="Editar" href="${urlEdit}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('tipos_de_contrato_para_empleados_eliminar')
                                <button title="Eliminar" onclick="Eliminar(this,'${urlShowDelete}','${data}','${row.name}');return false;"
                                    class="btn btn-sm text-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            @endcan`;
                            return html;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };

            let table = $('#tblTiposContratoEmpleados').DataTable(dtOverrideGlobals);

            window.Eliminar = function(boton, url, modelo_id, tipo) {

                Swal.fire({
                    title: '¿Estás seguro de eliminar?',
                    text: `Eliminarás el tipo de contrato: ${tipo}`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    Accept: "application/json",
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        "content"),
                                },
                            });
                            toastr.success('Registro eliminado')
                            table.ajax.reload();
                        } catch (error) {
                            toastr.error('Ocurrió un error: ' + error)
                        }
                    }
                })

            }
        });
    </script>
@endsection
