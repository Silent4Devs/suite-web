<style type="text/css">
    #errores_generales_admin_quitar_recursos {
        display: none !important;
    }

    .menu-active {
        color: #3B82F6 !important;
    }

    .carousel-control-next {
        background: none;
        border: none;
    }

    .carousel-control-next-icon {
        filter: brightness(0.5);
    }

    .active-card {
        /* background: #3B82F6; */
        border-top: 3px solid #3B82F6 !important;
    }

    .border-blue {
        border: solid 3px #3B82F6 !important;
    }

    .arrow {
        background-color: #3B82F6;
        border-left: 1px solid #3B82F6;
        border-top: 1px solid #3B82F6;
        height: 0.75rem;
        left: 50%;
        position: absolute;
        top: 0;
        transform: translate(-50%, -50%) rotate(45deg);
        width: 0.75rem;
    }
</style>

<div class="card-body datatable-fix" id="contendor-principal-capacitaciones" x-data="{ show: false }">
    <div class="px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección encontrará las
                    capacitaciones que le han sido asignadas por la organización para el cumplimiento de sus objetivos
                    y/o como parte de su plan de carrera.
                </p>

            </div>
        </div>
    </div>
    <div class="row mb-4 align-items-center">
        <div class="pr-0" x-bind:class="show ? 'col-12' : 'col-10'" style="text-align:right;">

            <span class="mr-2" x-bind:class="!show ? 'menu-active' : ''" title="Visualizar Tarjetas"
                style="font-size: 1.1rem;cursor: pointer;" x-on:click="show=false"><i class="fas fa-th"></i></span>


            <span class="mr-2" style="font-size: 1.1rem;cursor: pointer;" x-bind:class="show ? 'menu-active' : ''"
                x-on:click="show=true" title="Visualizar Tabla"><i class="fas fa-th-list"></i></span>


            <span x-show="!show" x-data="{ archivado: false }">
                <span id="btnArchivo" class="mr-2" style="font-size: 1.1rem;cursor: pointer;" title="Archivo"
                    x-show="!archivado" x-on:click="archivado=true" x-transition><a
                        href="{{ asset('admin/inicioUsuario/capacitaciones/archivo') }}"
                        style="color: #7c7777;text-decoration: none;"><i class="fas fa-archive"></i></a></span>

                {{-- <span id="btnArchivo" data-url="{{ route('admin.recursos.obtenerCapacitacionesArchivadas') }}"
                    class="mr-2" style="font-size: 1.1rem;cursor: pointer;" title="Archivo"
                    x-show="!archivado" x-on:click="archivado=true" x-transition><i class="fas fa-archive"></i></span>

                <span id="btnPrincipales" data-url="{{ route('admin.recursos.obtenerCapacitacionesPrincipales') }}"
                    class="mr-2" style="font-size: 1.1rem;cursor: pointer;" title="Principales"
                    x-show="archivado" x-on:click="archivado=false" x-transition><i
                        class="fas fa-chalkboard-teacher"></i></span> --}}
            </span>


        </div>
        <div class="pl-0" x-bind:class="!show ? 'col-2' : ''">
            <select class="form-control" id="selectTipoCapacitacion" x-show="!show">
                <option value="todo" selected>Todas</option>
                <option value="aceptadas">Aceptadas</option>
                <option value="rechazadas">Rechazadas</option>
                <option value="sin_respuesta">Sin Respuesta</option>
            </select>
        </div>
    </div>
    <div class="row" style="height: calc(100vh + 230px);" x-show="!show" x-transition:enter.duration.500ms
        x-transition:leave.duration.400ms>
        <div class="col-12">
            <div class="cards-mis-capacitaciones row" id="cards-mis-capacitaciones"></div>
            <div class="row">
                <div class="col-12" id="contenedor-info-card-capacitaciones"></div>
            </div>
        </div>
    </div>
    <div class="row" x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
        <div class="col-12">
            <table id="tabla_usuario_capacitaciones" class="table">
                <thead>
                    <tr>
                        <th style="min-width:200px;">Nombre</th>
                        <th style="min-width:150px;">Categoría</th>
                        <th style="min-width:150px;">Tipo</th>
                        <th style="min-width:150px;">Modalidad</th>
                        <th style="min-width:150px;">Ubicación</th>
                        <th style="min-width:200px;">Instructor</th>
                        <th style="min-width:100px;">Fecha Inicio</th>
                        <th style="min-width:100px;">Fecha Fin</th>
                        <th style="min-width:50px;">Calificación</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recursos as $recurso)
                        @if (!($recurso->archivar == 'archivado'))
                            <tr>

                                <td>{{ $recurso->cursoscapacitaciones }}</td>
                                <td>{{ $recurso->categoria_capacitacion->nombre }}</td>
                                <td>{{ $recurso->tipo }}</td>
                                <td>{{ $recurso->modalidad }}</td>
                                <td>{{ $recurso->ubicacion }}</td>
                                <td>{{ $recurso->instructor }}</td>
                                <td>{{ $recurso->fecha_curso }}</td>
                                <td>{{ $recurso->fecha_fin }}</td>
                                <td>
                                    @foreach ($recurso->empleados as $empleado)
                                        @if ($empleado->id == auth()->user()->empleado->id)
                                            {{ $empleado->pivot->calificacion }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="opciones_iconos">
                                    @if (date('Y-m-d') >= $recurso->fecha_fin)
                                        <button class=" btn_archivar" title="Archivar" data-toggle="modal"
                                            data-target="#alert_capa{{ $recurso->id }}">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.inicioUsuario.capacitaciones.modal-encuesta')
<div>
    @foreach ($recursos as $recurso)
        @if (!($recurso->archivar == 'archivado'))
            <div class="modal fade" id="alert_capa{{ $recurso->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="delete">
                                <i class="fas fa-archive icono_delete"></i>
                                <h1 class="mb-4">Archivar</h1>
                                <p class="parrafo">¿Esta seguro que desea archivar este registro?</p>
                                <div class="mt-4">
                                    <form
                                        action="{{ route('admin.inicio-Usuario.capacitaciones.archivar', $recurso->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="mr-4 cancelar btn btn-outline-secondary" data-dismiss="modal">
                                            Cancelar</div>
                                        <button class="eliminar btn btn-info" type="submit">Archivar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>


@section('scripts')
    @parent
    @include('admin.inicioUsuario.capacitaciones.cards-script')
    <script type="text/javascript">
        $(document).ready(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
            // let btnArchivo = {
            //     text: '<i class="pl-2 pr-3 fas fa-archive"></i> Archivo',
            //     titleAttr: 'Archivo',
            //     url: "{{ asset('admin/inicioUsuario/capacitaciones/archivo') }}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };

            // dtButtons.push(btnArchivo);
            $("#tabla_usuario_capacitaciones").DataTable({
                buttons: dtButtons,
            });


            // window.archivarCapacitacion = function(id_empleado, recurso_id, url){
            //     Swal.fire({
            //       title: 'Are you sure?',
            //       text: "You won't be able to revert this!",
            //       icon: 'warning',
            //       showCancelButton: true,
            //       confirmButtonColor: '#3085d6',
            //       cancelButtonColor: '#d33',
            //       confirmButtonText: 'Yes, delete it!'
            //     }).then((result) => {
            //       if (result.isConfirmed) {
            //         $.ajax({
            //             type: "POST",
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             url: url,
            //             data: {
            //                 id_empleado, recurso_id
            //             },
            //             dataType: "JSON",
            //             beforeSend: function() {
            //                 let timerInterval
            //                 Swal.fire({
            //                     title: 'Archivando...',
            //                     html: 'Estamos archivando su capacitacion',
            //                     timer: 4000,
            //                     timerProgressBar: true,
            //                     didOpen: () => {
            //                         Swal.showLoading()
            //                         timerInterval = setInterval(() => {
            //                             const content = Swal
            //                                 .getHtmlContainer()
            //                             if (content) {
            //                                 const b = content
            //                                     .querySelector('b')
            //                                 if (b) {
            //                                     b.textContent = Swal
            //                                         .getTimerLeft()
            //                                 }
            //                             }
            //                         }, 100)
            //                     },
            //                     willClose: () => {
            //                         clearInterval(timerInterval)
            //                     }
            //                 });
            //             },
            //             success: function(response) {
            //                 if (response.success) {
            //                     Swal.fire(
            //                         '¡Archivado!',
            //                         'Su revisión ha sido archivada',
            //                         'success'
            //                     )
            //                     setTimeout(() => {
            //                         window.location.reload();
            //                     }, 1000);
            //                 } else {
            //                     Swal.fire(
            //                         'Erro al archivar!',
            //                         'Ocurrió un error',
            //                         'error'
            //                     )
            //                 }
            //             },
            //             error: function(err) {
            //                 Swal.fire(
            //                     'Error!',
            //                     `${err}`,
            //                     'error'
            //                 )
            //             }
            //         });
            //       }
            //     });
            // }
        });
    </script>
@endsection
