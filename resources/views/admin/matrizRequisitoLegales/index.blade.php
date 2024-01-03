@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.matriz-requisito-legales.index') }}
    <div class="row d-flex align-items-center">
        <h5 class="col-12 titulo_general_funcion">Matriz de Requisitos Legales y Regulatorios</h5>
        <a class="btn btn-primary ml-auto" style="font-size: 16px; position: relative; right: 1rem;"
            href="{{ route('admin.matriz-requisito-legales.create') }}">
            Nueva Matriz de Requisitos

        </a>
    </div>
    @can('matriz_requisitos_legales_agregar')
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
    <div class="datatable-fix datatable-rds">
        <h5>Requisitos legales</h5>
        <table class="datatable datatable-MatrizRequisitoLegale">
            <thead>
                <tr>
                    <th>Nombre del requisito legal</th>
                    <th>Clausula</th>
                    <th>Fecha&nbsp;de&nbsp;publicación</th>
                    <th>Opciones</th>
                </tr>
            </thead>
        </table>
    </div>

    @if ($listavacia == 'vacia')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    // title: 'No es posible acceder a esta vista.',
                    imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                    imageWidth: 100, // Set the width of the image as needed
                    imageHeight: 100,
                    html: `<h4 style="color:red;">No se ha agregado ningún colaborador a la lista</h4>
                    <br><p>No se ha agregado un responsable al flujo de aprobación de esta vista.</p><br>
                    <p>Es necesario acercarse con el administrador para solicitar que se agregue  un responsable, de lo contrario no podra registrar información en este módulo.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another view after user clicks OK
                        window.location.href =
                            '{{ route('admin.iso27001.index') }}';
                    }
                });
            });
        </script>
    @elseif ($listavacia == 'baja')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    // title: 'No es posible acceder a esta vista.',
                    imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                    imageWidth: 100, // Set the width of the image as needed
                    imageHeight: 100,
                    html: `<h4 style="color:red;">Colaborador dado de baja</h4>
                    <br><p>El colaborador responsable de este formulario ta no se encuentra dado de alta en el sistema.</p><br>
                    <p>Es necesario acercarse con el administrador para solicitar que se agregue un nuevo responsable, de lo contrario no podra registrar información en este módulo.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another view after user clicks OK
                        window.location.href =
                            '{{ route('admin.iso27001.index') }}';
                    }
                });
            });
        </script>
    @endif
@endsection
@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script>
        $(function() {
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [


            ];

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.matriz-requisito-legales.index') }}",
                columns: [{
                        data: 'nombrerequisito',
                        name: 'nombrerequisito'
                    },
                    {
                        data: 'formacumple',
                        name: 'formacumple'
                    },
                    {
                        data: 'fechaexpedicion',
                        name: 'fechaexpedicion'
                    },
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

                            </div>
                             `;

                            let html =
                                `
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                        @can('matriz_requisitos_legales_editar')
                                        <a class="dropdown-item" style="color:#212529;" href="${urlEditarMatrizRequisitoLegal}" title="Editar Matríz de Requisito Legal"><i class="fas fa-edit"></i> Editar</a>
                                        @endcan
                                        @can('matriz_requisitos_legales_eliminar')
                                        <button class="dropdown-item" onclick="eliminar('${urlEliminarMatrizRequisitoLegal}','${row.nombrerequisito}')" title="Eliminar Matríz de Requisito Legal"><i class="fas fa-trash-alt text-danger"></i> Eliminar</button>
                                        @endcan
                                    </div>
                                </div>`;

                            return html;
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
                    title: `¿
                                                Estás seguro de eliminar la siguiente matríz de requisito legal ? `,
                    html: ` < strong > < i class = "mr-2 fas fa-exclamation-triangle" > < /i>${nombre}</strong > `,
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
                                    `
                                                La Matríz de requisito legal: $ {
                                                    nombre
                                                }
                                                está siendo eliminada`,
                                    'info'
                                )
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Eliminado!',
                                    `
                                                La Matríz de requisito legal: $ {
                                                    nombre
                                                }
                                                ha sido eliminada`,
                                    'success'
                                )
                                table.ajax.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Ocurrió un error',
                                    `
                                                Error: $ {
                                                    error.responseJSON.message
                                                }
                                                `,
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
