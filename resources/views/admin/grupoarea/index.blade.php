@extends('layouts.admin')
@section('content')
    @can('grupoarea_create')
        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong> Grupos de Áreas</strong></h3>
            </div>
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">

                    @include('csvImport.modal', ['model' => 'Grupo', 'route' => 'admin.grupoarea.parseCsvImport'])
                </div>
            </div>
        @endcan
        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Paso 1</p>
                    <span class="m-0" style="font-size: 14px; color:#1E3A8A ">Agregue los grupos de las áreas, al finalizar
                        dé
                        clic en siguiente </span>
                    <a href="{{ route('admin.areas.index') }}" class="item-right col-2 btn text-light"
                        style="background-color:rgb(85, 217, 226); float:right">Siguiente</a>
                </div>
            </div>
        </div>

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-GrupoArea">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            Nombre del grupo
                        </th>
                        <th>
                            Descripción
                        </th>
                        <th>
                            Color
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `GrupoArea ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `GrupoArea ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `GrupoArea ${new Date().toLocaleDateString().trim()}`,
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
                    title: `GrupoArea ${new Date().toLocaleDateString().trim()}`,
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

            @can('grupoarea_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar Grupo Area',
                url: "{{ route('admin.grupoarea.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                let btnImport = {
                text: '<i class="pl-2 pr-3 fas fa-file-csv"></i> CSV Importar',
                titleAttr: 'Importar datos por CSV',
                className: "btn-xs btn-outline-primary rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                $('#csvImportModal').modal('show');
                }
                };
                dtButtons.push(btnAgregar);
                dtButtons.push(btnImport);
            @endcan
            @can('grupoarea_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.grupoarea.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
                });
            
                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
            
                return
                }
            
                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
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
                ajax: "{{ route('admin.grupoarea.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'color',
                        name: 'color',
                        render: function(color) {
                            return `<div class="d-flex justify-content-center"> <div class="text-center align-items-center d-flex justify-content-center" style="width:20px; height:20px; background-color:${color}!important"></div> </div>`;
                            element.style.border = `2px solid ${color!=null?color:"black"}`;

                        }
                    },
                    {
                        data: 'id',
                        name: 'Opciones',
                        render: function(data, type, row, meta) {
                            const opciones = `
                                <a href="/admin/grupoarea/${data}/edit" class="btn btn-sm"><i class="fas fa-edit" title="Editar"></i></a>
                                <a href="/admin/grupoarea/${data}/show" class="btn btn-sm"><i class="fas fa-eye" title="Visualizar"></i></a>
                                <button onclick="Eliminar('/admin/grupoarea/${data}','${data}')" class="btn btn-sm text-danger"><i class="fas fa-trash" title="Eliminar"></i></button>
                            `;
                            return opciones;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'asc']
                ]
            };
            let table = $('.datatable-GrupoArea').DataTable(dtOverrideGlobals);

            async function obtenerAreasRelacionadas(grupo_id) {
                let api = await fetch("{{ route('admin.grupoarea.getRelationatedAreas') }}", {
                    method: 'POST', // *GET, POST, PUT, DELETE, etc.
                    mode: 'cors', // no-cors, *cors, same-origin
                    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: 'same-origin', // include, *same-origin, omit
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        grupo_id
                    }) // body data type must match "Content-Type" header
                });
                let data = await api.json();
                return data;
            }

            window.Eliminar = async function(url, grupo_id) {
                const areasRelacionadas = await obtenerAreasRelacionadas(grupo_id);
                Swal.fire({
                    title: '¿Desea eliminar este grupo?',
                    html: `<div>
                            ${areasRelacionadas.length > 0 ? `<p>El grupo que desea eliminar está vinculado con las siguientes áreas</p>
                                                        <ul class="list-group list-group-horizontal justify-content-center">
                                                            ${areasRelacionadas.map(area=>{
                                                                return `<li class="list-group-item">${area.area}</li>`;
                                                            })}
                                                        </ul>`:`<p>No hay relación con ningún área</p>`}
                        </div>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend: function() {
                                let timerInterval
                                Swal.fire({
                                    title: 'Eliminando!',
                                    html: 'Estamos eliminando el registro, espere un momento.',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            const content = Swal
                                                .getHtmlContainer()
                                            if (content) {
                                                const b = content
                                                    .querySelector(
                                                        'b')
                                                if (b) {
                                                    b.textContent =
                                                        Swal
                                                        .getTimerLeft()
                                                }
                                            }
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                })

                            },
                            success: function(response) {
                                if (response.deleted) {
                                    Swal.fire(
                                        '¡Grupo Eliminado!',
                                        'Las áreas relacionadas quedarán sin grupo asignado',
                                        'success'
                                    )
                                    table.ajax.reload();
                                } else {
                                    Swal.fire(
                                        '¡No se eliminó el grupo!',
                                        'Ocurrió un error',
                                        'error'
                                    )
                                }

                            },
                            error: function(err) {
                                Swal.fire(
                                    'Ocurrió un error',
                                    `${err.message}`,
                                    'error'
                                )
                            }
                        });

                    }
                });
            }
        });
    </script>
@endsection

@endsection
