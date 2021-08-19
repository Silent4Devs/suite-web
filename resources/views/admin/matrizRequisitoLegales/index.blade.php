@extends('layouts.admin')
@section('content')


<style>

.img-size{
/* 	padding: 0;
	margin: 0; */
	height: 450px;
	width: 700px;
	background-size: cover;
	overflow: hidden;
}
.modal-content {
   width: 700px;
  border:none;
}
.modal-body {
   padding: 0;
}

.carousel-control-prev-icon {
	background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
	width: 30px;
	height: 48px;
}
.carousel-control-next-icon {
	background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23009be1' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
	width: 30px;
	height: 48px;
}

.carousel-control-next {
    top: 100px;
    height: 10px;
}

.carousel-control-prev {
    height: 40px;
    top: 80px;
}

.table tr td:nth-child(6){

    max-width:415px !important;
    width:415px !important;

}

.table tr th:nth-child(6){

    width:415px !important;
    max-width:415px !important;
}

.table tr td:nth-child(10){

    text-align: center;

}

.tamaño{

    width:168px !important;

}






</style>

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
                            Tipo&nbsp;de&nbsp;requisito
                        </th>
                        <th>
                            Fundamento
                        </th>
                        <th>
                            Apartado&nbsp;@for ($i = 0; $i < 70; $i++)&nbsp;@endfor
                        </th>
                        <th>
                            Requisito(s)&nbsp;a&nbsp;cumplir&nbsp;@for ($i = 0; $i < 80; $i++)&nbsp;@endfor
                        </th>
                        <th>
                            Alcance&nbsp;y&nbsp;grado&nbsp;de&nbsp;aplicabilidad
                        </th>
                        <th>
                            Medio&nbsp;de&nbsp;publicación
                        </th>
                        <th>
                            Fecha&nbsp;de publicación
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;entrada en&nbsp;vigor
                        </th>
                        <th>
                            Periodicidad&nbsp;de cumplimiento
                        </th>
                        <th>
                            ¿En&nbsp;cumplimiento?
                        </th>
                        <th>
                            Descripción&nbsp;del&nbsp;cumplimiento/incumplimiento
                        </th>
                        <th>
                            Método&nbsp;utilizado&nbsp;de&nbsp;verificación
                        </th>
                        <th style="text-align:center;">
                            Evidencia
                        </th>
                        <th>
                            Revisó&nbsp;@for ($i = 0; $i < 25; $i++)&nbsp;@endfor
                        </th>
                        <th>
                           Puesto&nbsp;@for ($i = 0; $i < 25; $i++)&nbsp;@endfor
                        </th>
                        <th>
                           Área&nbsp;@for ($i = 0; $i < 25; $i++)&nbsp;@endfor
                        </th>
                        <th>
                            Comentarios&nbsp;@for ($i = 0; $i < 70; $i++)&nbsp;@endfor
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
                columnDefs:[{targets:[5,12,11,17],visible:false}],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo'
                    },
                    {
                        data: 'nombrerequisito',
                        name: 'nombrerequisito'
                    },
                    {
                        data: 'formacumple',
                        name: 'formacumple'
                    },
                    {
                        data: 'requisitoacumplir',
                        name: 'requisitoacumplir'
                    },
                    {
                        data: 'alcance',
                        name: 'alcance'
                    },
                    {
                        data: 'medio',
                        name: 'medio'
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
                        data: 'periodicidad_cumplimiento',
                        name: 'periodicidad_cumplimiento'
                    },
                    {
                        data: 'cumplerequisito',
                        name: 'cumplerequisito'
                    },
                    {
                        data: 'metodo',
                        name: 'metodo'
                    },
                    {
                        data: 'descripcion_cumplimiento',
                        name: 'descripcion_cumplimiento'
                    },
                    {
                        data: 'evidencia',
                        name: 'evidencia',
                        render:function(data,type,row,meta){
                             let archivo="";
                             let archivos=row.evidencias_matriz;
                               archivo=` <div class="container">

                                    <div class="mb-4 row">
                                    <div class="text-center col">
                                        <a href="#" class="btn btn-sm btn-primary tamaño" data-toggle="modal" data-target="#largeModal${row.id}"><i class="mr-2 text-white fas fa-file" style="font-size:13pt"></i>Visualizar&nbsp;evidencias</a>
                                    </div>
                                    </div>

                                    <!-- modal -->
                                    <div class="modal fade" id="largeModal${row.id}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <!-- carousel -->
                                            <div
                                                id='carouselExampleIndicators${row.id}'
                                                class='carousel slide'
                                                data-ride='carousel'
                                                >
                                            <ol class='carousel-indicators'>
                                                    ${archivos?.map((archivo,idx)=>{
                                                        return `
                                                    <li
                                                    data-target='#carouselExampleIndicators${row.id}'
                                                    data-slide-to='${idx}'
                                                    ></li>`
                                                    })}
                                            </ol>
                                            <div class='carousel-inner'>
                                                    ${archivos?.map((archivo,idx)=>{
                                                        return `
                                                    <div class='carousel-item ${idx==0?"active":""}'>
                                                        <iframe seamless class='img-size' src='{{asset("storage/matriz_evidencias")}}/${archivo.evidencia}'></iframe>
                                                    </div>`
                                                    })}

                                            </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <a
                                                class='carousel-control-prev'
                                                href='#carouselExampleIndicators${row.id}'
                                                role='button'
                                                data-slide='prev'
                                                >
                                                <span class='carousel-control-prev-icon'
                                                    aria-hidden='true'
                                                    ></span>
                                                <span class='sr-only'>Previous</span>
                                            </a>
                                            <a
                                                class='carousel-control-next'
                                                href='#carouselExampleIndicators${row.id}'
                                                role='button'
                                                data-slide='next'
                                                >
                                                <span
                                                    class='carousel-control-next-icon'
                                                    aria-hidden='true'
                                                    ></span>
                                                <span class='sr-only'>Next</span>
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>`
                            return archivo;
                        }
                    },
                    {
                        data: 'reviso',
                        name: 'reviso',
                        render: function(data, type, row, meta) {
                            return row.empleado.name;
                        }
                    },
                    {
                        data: 'puesto',
                        name: 'puesto',
                        render: function(data, type, row, meta) {
                            return row.empleado.puesto;
                        }
                    },
                    {
                        data: 'area',
                        name: 'area',
                        render: function(data, type, row, meta) {
                            return row.empleado.area.area;
                        }
                    },
                    {
                        data: 'comentarios',
                        name: 'comentarios'
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
