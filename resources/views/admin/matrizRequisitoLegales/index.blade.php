@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.matriz-requisito-legales.index') }}
    <div class="mt-5 card">
        @can('matriz_requisito_legale_create')
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Matriz de Requisitos Legales</strong></h3>
            </div>
        @endcan
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table datatable-MatrizRequisitoLegale">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th>

                        </th> --}}
                        <th>
                            {{ trans('cruds.matrizRequisitoLegale.fields.id') }}
                        </th>
                        <th>
                            Nombre&nbsp;del&nbsp;Requisito
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;Expedicion
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;entrada&nbsp;en&nbsp;vigor
                        </th>
                        <th>
                            Requisito&nbsp;a&nbsp;cumplir
                        </th>
                        <th>
                            ¿Se&nbsp;cumple&nbsp;con&nbsp;el&nbsp;requisito?
                        </th>
                        <th>
                            ¿De&nbsp;que&nbsp;forma&nbsp;cumple?
                        </th>
                        <th>
                            Periodicidad&nbsp;de&nbsp;cumplimiento
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;verificación
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script>
        $(function() {
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.styles.tableHeader.fontSize = 8.5;
                        doc.defaultStyle.fontSize = 8.5; //<-- set fontsize to 16 instead of 10 
                    }
                },
                {
                    extend: 'print',
                    title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
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
            @can('matriz_requisito_legale_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nueva matríz de requisitos legales',
                url: "{{ route('admin.matriz-requisito-legales.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
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
                ajax: "{{ route('admin.matriz-requisito-legales.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombrerequisito',
                        name: 'nombrerequisito'
                    },
                    {
                        data: 'fechaexpedicion',
                        name: 'fechaexpedicion'
                    },
                    {
                        data: 'fechavigor',
                        name: 'fechavigor'
                    },
                    {
                        data: 'requisitoacumplir',
                        name: 'requisitoacumplir'
                    },
                    {
                        data: 'cumplerequisito',
                        name: 'cumplerequisito'
                    },
                    {
                        data: 'formacumple',
                        name: 'formacumple'
                    },
                    {
                        data: 'periodicidad_cumplimiento',
                        name: 'periodicidad_cumplimiento'
                    },
                    {
                        data: 'fechaverificacion',
                        name: 'fechaverificacion'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlVerMatrizRequisitoLegal =
                                `/admin/matriz-requisito-legales/${data}`;
                            let urlEditarMatrizRequisitoLegal =
                                `/admin/matriz-requisito-legales/${data}/edit`;
                            let urlEliminarMatrizRequisitoLegal =
                                `/admin/matriz-requisito-legales/${data}`;
                            let urlCrearPlanAccion =
                                `/admin/matriz-requisito-legales/planes-de-accion/create/${data}`;
                            let urlVerPlanAccion =
                                `/admin/matriz-requisito-legales/planes-de-accion/create/${data}`;
                            let botones = `                           
                            <div class="btn-group">
                                <a class="btn btn-sm" href="${urlEditarMatrizRequisitoLegal}" title="Editar Matríz de Requisito Legal"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm" href="${urlVerMatrizRequisitoLegal}" title="Visualizar Matríz de Requisito Legal"><i class="fas fa-eye"></i></a>                                                        
                                ${row.planes ? `
                                    <div class="dropdown">
                                        <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-stream"></i>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            ${!row.planes? `
                                                <a class="dropdown-item" href="${urlCrearPlanAccion}" title="Crear Plan de Acción para: ${row.nombrerequisito}"><i class="mr-1 fas fa-columns"></i>Crear y vincular plan de acción</a>                                                       
                                                <div class="dropdown-divider"></div>    
                                            `:''}                                            
                                            <span class="ml-4 badge badge-primary">Planes de acción asociados</span>
                                           ${row.planes.map(plan => {
                                               return `
                                                <a class="dropdown-item" href="/admin/planes-de-accion/${plan.id}"><i class="mr-1 fas fa-search"></i>${plan.parent}<a>
                                               `;
                                           })}
                                        </div>
                                    </div>
                                    `:''}
                                 <button class="btn btn-sm" onclick="eliminar('${urlEliminarMatrizRequisitoLegal}','${row.nombrerequisito}')" title="Eliminar Matríz de Requisito Legal"><i class="fas fa-trash-alt text-danger"></i></button>    
                            </div>
                             `;
                            return botones;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
            };
            let table = $('.datatable-MatrizRequisitoLegale').DataTable(dtOverrideGlobals);

            window.eliminar = function(url, nombre) {
                Swal.fire({
                    title: `¿Estás seguro de eliminar la siguiente matríz de requisito legal?`,
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
                                    `La Matríz de requisito legal: ${nombre} está siendo eliminada`,
                                    'info'
                                )
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Eliminado!',
                                    `La Matríz de requisito legal: ${nombre} ha sido eliminada`,
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
@endsection
