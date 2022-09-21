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
    {{-- {{ Breadcrumbs::render('admin.objetivosseguridads.index') }} --}}
    <h5 class="col-12 titulo_general_funcion">Tipos de Objetivos</h5>
    <div class="mt-5 card">

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered" id="tblTiposObjetivosSistema" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:450px !important;">
                            Nombre
                        </th>
                        <th style="min-width:150px !important;">
                            Descripción
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
                    title: `Objetivos de Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Objetivos de Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     title: `Objetivos de Seguridad ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar PDF',
                //     orientation: 'portrait',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     },
                //     customize: function(doc) {
                //         doc.pageMargins = [20, 60, 20, 30];
                //         // doc.styles.tableHeader.fontSize = 7.5;
                //         // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                //     }
                // },
                {
                    extend: 'print',
                    title: `Objetivos de Seguridad ${new Date().toLocaleDateString().trim()}`,
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
                                    <strong style="color:#345183">TIPOS DE OBJETIVOS</strong>
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

            @can('objetivos_del_sistema_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar objetivo de seguridad',
                    url: "{{ route('admin.tipos-objetivos.create') }}",
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


            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.tipos-objetivos.getDataForDataTable') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data, type, row) {
                            return $('<div/>').html(data).text();
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            let opciones = `
                                <a href="{{ route('admin.tipos-objetivos.edit', ':id') }}" class="btn btn-sm rounded mr-2" title="Editar"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.tipos-objetivos.show', ':id') }}" class="btn btn-sm rounded mr-2" title="Visualizar"><i class="fas fa-eye"></i></a>
                                <button class="btn btn-sm text-danger rounded" title="Eliminar" onclick="eliminar('${row.id}','{{ route('admin.tipos-objetivos.destroy', ':id') }}')"><i class="fas fa-trash-alt"></i></button>
                            `;
                            return opciones.replaceAll(':id', row.id);

                        },
                    }
                ],
                orderCellsTop: true,
            };
            let table = $('#tblTiposObjetivosSistema').DataTable(dtOverrideGlobals);

            window.eliminar = (id, url) => {
                console.log(url);
                Swal.fire({
                    title: '¿Estás seguro de eliminar este tipo?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (responseApi) => {
                        return fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': _token,
                                    'Content-Type': 'application/json',
                                    Accept: 'application/json'
                                },
                                body: JSON.stringify({
                                    id
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
                        Swal.fire('¡Buen Trabajo!',
                            'Tipo de Objetivo eliminado correctamente',
                            'success').then(() => {
                            table.ajax.reload();
                        })
                    }
                })
            }

        });
    </script>
@endsection
