@extends('layouts.admin')
@section('content')
    <style>
        /* .img-size {
                                height: 450px;
                                width: 700px;
                                background-size: cover;
                                overflow: hidden;
                            }

                            .modal-content {
                                width: 700px;
                                border: none;
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
                            } */

        /* .btn_cargar {
                            border-radius: 100px !important;
                            border: 1px solid #345183;
                            color: #345183;
                            text-align: center;
                            padding: 0;
                            width: 45px;
                            height: 45px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            margin: 0 !important;
                            margin-right: 10px !important;
                        }

                        .btn_cargar:hover {
                            color: #fff;
                            background: #345183;
                        }

                        .btn_cargar i {
                            font-size: 15pt;
                            width: 100%;
                            height: 100%;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }

                        .agregar {
                            margin-right: 15px;
                        } */

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
            margin-left: 5px !important;
        }

        .radius {
            border-radius: 16px;
        }

        .titulo-card {
            text-align: left;
            font: 20px Roboto;
            color: #606060;
        }
    </style>

    {{ Breadcrumbs::render('admin.matriz-requisito-legales.index') }}
    <div class="row d-flex align-items-center">
        <h5 class="col-12 titulo_general_funcion">Matriz de Requisitos Legales y Regulatorios</h5>
        <button type="button" class="col-md-3 btn btn-primary btn-lg ml-auto" style="margin-right: 14px; font-size: 14px;"
        url="{{ route('admin.matriz-requisito-legales.create') }}">
            Nueva Matriz de Requisitos
            <i class="fa-regular fa-plus fa-lg" style="color: #ffffff;"></i>
        </button >
    </div>
    <div class="mt-5 card radius">
        @can('matriz_requisitos_legales_agregar')
            {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Matriz de Requisitos Legales</strong></h3>
            </div> --}}
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'Amenaza',
                        'route' => 'admin.amenazas.parseCsvImport',
                    ])
                </div>
            </div>
        @endcan
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table datatable-MatrizRequisitoLegale">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ trans('cruds.matrizRequisitoLegale.fields.id') }}</th>
                        <th style="min-width: 250px;">Nombre del requisito legal</th>
                        <th style="min-width: 250px;">Obligación del cumplimiento</th>
                        <th>Alcance&nbsp;y&nbsp;grado&nbsp;de&nbsp;aplicabilidad</th>
                        {{-- <th style="min-width: 200px;">Medio&nbsp;de&nbsp;publicación</th>
                        <th>Fecha&nbsp;de publicación</th>
                        <th>Fecha&nbsp;de&nbsp;entrada en&nbsp;vigor</th> --}}
                        <th style="min-width: 250px;">¿Cómo&nbsp;cumple?</th>
                        <th>Periodicidad&nbsp;de&nbsp;cumplimiento</th>
                        <th>¿En&nbsp;cumplimiento?</th>
                        {{-- <th>Descripción&nbsp;del&nbsp;cumplimiento/incumplimiento</th> --}}
                        <th>Método&nbsp;utilizado&nbsp;de&nbsp;verificación</th>
                        {{-- <th style="text-align:center;">Evidencia</th>
                        <th>Revisó&nbsp;@for ($i = 0; $i < 25; $i++)&nbsp;@endfor</th>
                        <th>Puesto&nbsp;@for ($i = 0; $i < 25; $i++)&nbsp;@endfor</th>
                        <th>Área&nbsp;@for ($i = 0; $i < 25; $i++)&nbsp;@endfor</th>
                        <th>Comentarios&nbsp;@for ($i = 0; $i < 70; $i++)&nbsp;@endfor</th> --}}
                        <th>Opciones</th>
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
            let dtButtons = [
                // {
                //     extend: 'csvHtml5',
                //     title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar CSV',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },
                // {
                //     extend: 'excelHtml5',
                //     title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar Excel',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },
                // {
                //     extend: 'pdfHtml5',
                //     title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar PDF',
                //     orientation: 'landscape',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     },
                //     customize: function(doc) {
                //         doc.pageMargins = [20, 60, 20, 30];
                //         doc.styles.tableHeader.fontSize = 8.5;
                //         doc.defaultStyle.fontSize = 8.5; //<-- set fontsize to 16 instead of 10
                //     }
                // },
                // {
                //     extend: 'print',
                //     title: `Matríz de Requisitos Legales ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Imprimir',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },
                // {
                //     extend: 'colvis',
                //     text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Seleccionar Columnas',
                // },
                // {
                //     extend: 'colvisGroup',
                //     text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     show: ':hidden',
                //     titleAttr: 'Ver todo',
                // },
                // {
                //     extend: 'colvisRestore',
                //     text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Restaurar a estado anterior',
                // }

            ];
            @can('matriz_requisitos_legales_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar nueva matríz de requisitos legales',
                    url: "{{ route('admin.matriz-requisito-legales.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                // let btnExport = {
                // text: '<i class="fas fa-download"></i>',
                // titleAttr: 'Descargar plantilla',
                // className: "btn btn_cargar" ,
                // url:"{{ route('descarga-matriz_requisitos_legales') }}",
                // action: function(e, dt, node, config) {
                // let {
                // url
                // } = config;
                // window.location.href = url;
                // }
                // };
                // let btnImport = {
                // text: '<i class="fas fa-file-upload"></i>',
                // titleAttr: 'Importar datos',
                // className: "btn btn_cargar",
                // action: function(e, dt, node, config) {
                // $('#csvImportModal').modal('show');
                // }
                // };
                dtButtons.push(btnAgregar);
                // dtButtons.push(btnExport);
                // dtButtons.push(btnImport);
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
                        data: 'formacumple',
                        name: 'formacumple'
                    },
                    {
                        data: 'alcance',
                        name: 'alcance'
                    },
                    // {
                    //     data: 'medio',
                    //     name: 'medio'
                    // },
                    // {
                    //     data: 'fechaexpedicion',
                    //     name: 'fechaexpedicion'
                    // },
                    // {
                    //     data: 'fechavigor',
                    //     name: 'fechavigor'
                    // },
                    {
                        data: 'cumplimiento_organizacion',
                        name: 'cumplimiento_organizacion'
                    },
                    {
                        data: 'periodicidad_cumplimiento',
                        name: 'periodicidad_cumplimiento'
                    },
                    {
                        data: 'cumplerequisito',
                        render: function(data, type, row, meta) {
                            if (row.evaluaciones[0]) {
                                return row.evaluaciones[0].cumplerequisito;
                            }
                            return 'No evaluado';
                        }
                    },
                    {
                        data: 'metodo',
                        render: function(data, type, row, meta) {
                            if (row.evaluaciones[0]) {
                                return row.evaluaciones[0].metodo;
                            }
                            return 'No evaluado';
                        }
                    },
                    // {
                    //     data: 'descripcion_cumplimiento',
                    //     name: 'descripcion_cumplimiento'
                    // },
                    // {
                    //     data: 'evidencia',
                    //     name: 'evidencia',
                    //     render: function(data, type, row, meta) {
                    //         let archivo = "";
                    //         let archivos = row.evidencias_matriz;
                    //         console.log(archivos)
                    //         archivo = ` <div class="container">

                //                 <div class="mb-4 row">
                //                 <div class="text-center col">
                //                     <a href="#" class="btn btn-sm btn-primary tamaño" data-toggle="modal" data-target="#largeModal${row.id}"><i class="mr-2 text-white fas fa-file" style="font-size:13pt"></i>Visualizar&nbsp;evidencias</a>
                //                 </div>
                //                 </div>

                //                 <!-- modal -->
                //                 <div class="modal fade" id="largeModal${row.id}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                //                 <div class="modal-dialog modal-lg">
                //                     <div class="modal-content">
                //                     <div class="modal-body">`;
                    //         if (archivos.length > 0) {
                    //             archivo += `
                //                             <!-- carousel -->
                //                         <div
                //                             id='carouselExampleIndicators${row.id}'
                //                             class='carousel slide'
                //                             data-ride='carousel'
                //                             >
                //                         <ol class='carousel-indicators'>
                //                                 ${archivos?.map((archivo,idx)=>{
                //                                     return `
                    //                                         <li
                    //                                         data-target='#carouselExampleIndicators${row.id}'
                    //                                         data-slide-to='${idx}'
                    //                                         ></li>`
                //                                 })}
                //                         </ol>
                //                         <div class='carousel-inner'>
                //                                 ${archivos?.map((archivo,idx)=>{
                //                                     return `
                    //                                         <div class='carousel-item ${idx==0?"active":""}'>
                    //                                             <iframe seamless class='img-size' src='{{ asset('storage/matriz_evidencias') }}/${archivo.evidencia}'></iframe>
                    //                                         </div>`
                //                                 })}

                //                         </div>

                //                         </div>`;
                    //         } else {
                    //             archivo += `
                //                             <div class="text-center">
                //                                 <h3 style="text-align:center" class="mt-3">Sin archivo agregado</h3>
                //                                 <img src="{{ asset('img/undrawn.png') }}" class="img-fluid " style="width:500px !important">
                //                                 </div>
                //                             `
                    //         }
                    //         archivo += `</div>
                //                     <div class="modal-footer">
                //                         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                //                        ${archivos.length==0?`
                    //                                 <a
                    //                                     class='carousel-control-prev'
                    //                                     href='#carouselExampleIndicators${row.id}'
                    //                                     role='button'
                    //                                     data-slide='prev'
                    //                                     >
                    //                                     <span class='carousel-control-prev-icon'
                    //                                         aria-hidden='true'
                    //                                         ></span>
                    //                                     <span class='sr-only'>Previous</span>
                    //                                 </a>
                    //                                 <a
                    //                                     class='carousel-control-next'
                    //                                     href='#carouselExampleIndicators${row.id}'
                    //                                     role='button'
                    //                                     data-slide='next'
                    //                                     >
                    //                                     <span
                    //                                         class='carousel-control-next-icon'
                    //                                         aria-hidden='true'
                    //                                         ></span>
                    //                                     <span class='sr-only'>Next</span>
                    //                                 </a>`:""}
                //                     </div>
                //                     </div>
                //                 </div>
                //                 </div>`
                    //         return archivo;
                    //     }
                    // },
                    // {
                    //     data: 'id',
                    //     render: function(data, type, row, meta) {
                    //         console.log(row)
                    //         let html =
                    //             `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.empleado?.avatar}" title="${row.empleado?.name}"></img>`;

                    //         return `${row.empleado ? html: ''}`;
                    //     }
                    // },
                    // {
                    //     data: 'puesto',
                    //     name: 'puesto',
                    //     render: function(data, type, row, meta) {
                    //         return row.empleado?.puesto;
                    //     }
                    // },
                    // {
                    //     data: 'area',
                    //     name: 'area',
                    //     render: function(data, type, row, meta) {
                    //         return row.empleado?.area?.area;
                    //     }
                    // },
                    // {
                    //     data: 'comentarios',
                    //     name: 'comentarios'
                    // },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlEvaluarMatriz =
                                `/admin/matriz-requisito-legales/${data}/evaluar`;
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
                                @can('matriz_requisitos_legales_ver')
                                <a class="btn btn-sm" href="${urlVerMatrizRequisitoLegal}" title="Visualizar Matríz de Requisito Legal"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('matriz_requisitos_legales_editar')
                                <a class="btn btn-sm" style="color:#212529;" href="${urlEditarMatrizRequisitoLegal}" title="Editar Matríz de Requisito Legal"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('matriz_requisitos_legales_evaluar')
                                <a class="btn btn-sm" style="color:#77C64F;" href="${urlEvaluarMatriz}" title="Evaluar Requisito Legal"><i class="fas fa-calendar-check"></i></a>
                                @endcan
                                @can('matriz_requisitos_legales_eliminar')
                                <button class="btn btn-sm" onclick="eliminar('${urlEliminarMatrizRequisitoLegal}','${row.nombrerequisito}')" title="Eliminar Matríz de Requisito Legal"><i class="fas fa-trash-alt text-danger"></i></button>
                                @endcan
                            </div>
                             `;
                            return botones;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
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
