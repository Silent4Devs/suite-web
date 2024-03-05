@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@section('content')
    {{-- <div class="mt-3">
        {{ Breadcrumbs::render('Vista-Global-Vacaciones') }}
    </div> --}}

    <h5 class="col-12 titulo_general_funcion">Catalogo de Rangos en Objetivos</h5>

    <div class="row">
        <div class="col-9">
        </div>
        <div class="col-3 text-right">
            <a type="button" class="btn btn-outline-primary btn-block" href="{{ route('admin.rangos.create') }}">
                Crear Catalogo
            </a>
        </div>
    </div>

    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <h3 class="title-table-rds">Catalogo de Rangos en Objetivos</h3>
        <table class="datatable datatable-catalogo-rangos-objetivos tblCSV" id="catalogo-rangos-objetivos">
            <thead>
                <tr>
                    <th style="min-width: 100px;">
                        Catalogo
                    </th>
                    <th style="min-width: 175px;">
                        Descripción Catalogo
                    </th>
                    <th style="min-width: 100px;">
                        Parametro
                    </th>
                    <th style="min-width: 75px;">
                        Valor Parametro
                    </th>
                    <th style="min-width: 175px;">
                        Descripción Parametro
                    </th>
                    <th style="min-width: 70px;">
                        Opciones
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($catalogos as $ctlg)
                    <tr>
                        <td style="min-width: 75px;">
                            {{ $ctlg->nombre_catalogo }}
                        </td>
                        <td style="min-width: 200px;">
                            {{ $ctlg->descripcion }}
                        </td>
                        <td style="min-width: 110px;">
                            <ul>
                                @foreach ($ctlg->rangos as $rgs)
                                    <li>{{ $rgs->parametro }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td style="min-width: 100px;">
                            <ul>
                                @foreach ($ctlg->rangos as $rgs)
                                    <li>{{ $rgs->valor }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td style="min-width: 100px;">
                            <ul>
                                @foreach ($ctlg->rangos as $rgs)
                                    <li>{{ $rgs->descripcion }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td style="min-width: 70px;">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.rangos.edit', $ctlg->id) }}">
                                        <div class="d-flex align-items-start">
                                            <i class="material-icons-outlined"
                                                style="width: 24px;font-size:18px;">edit_outline</i>
                                            Editar
                                        </div>
                                    </a>

                                    {{-- <a href="#" class="dropdown-item" title="Eliminar Matríz de Requisito Legal"
                                        onclick="confirmDelete('{{ route('admin.rangos.destroy', $ctlg->id) }}')">
                                        <i class="fas fa-trash-alt text-danger"></i> Eliminar
                                    </a>

                                    <form id="delete-form-{{ $ctlg->id }}"
                                        action="{{ route('admin.rangos.destroy', $ctlg->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}

                                    <a href="#" class="dropdown-item" title="Eliminar Matríz de Requisito Legal"
                                        onclick="confirmDelete('{{ route('admin.rangos.destroy', $ctlg->id) }}')">
                                        <i class="fas fa-trash-alt text-danger"></i> Eliminar
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {

            let dtButtons = [];

            // let btnAgregar = {
            //     text: '<i class="fa-solid fa-box-archive"></i>  Archivo',
            //     titleAttr: 'Archivo',
            //     url: "{{ route('admin.solicitud-vacaciones.archivo') }}",
            //     className: "btn-xs btn-outline-primary rounded ml-2 pr-3 archivo",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
            // dtButtons.push(btnAgregar);


            // let btnExport = {
            //     text: '<i  class="fas fa-download"></i>',
            //     titleAttr: 'Descargar plantilla',
            //     className: "btn btn_cargar",
            //     url: "{{ route('descarga-amenaza') }}",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
            // let btnImport = {
            //     text: '<i  class="fas fa-file-upload"></i>',
            //     titleAttr: 'Importar datos',
            //     className: "btn btn_cargar",
            //     action: function(e, dt, node, config) {
            //         $('#csvImportModal').modal('show');
            //     }
            // };



            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);


            let dtOverrideGlobals = {
                pageLength: 5,
                buttons: dtButtons,
                processing: true,
                retrieve: true,
            };
            let table = $('.datatable-catalogo-rangos-objetivos').DataTable(dtOverrideGlobals);
            // $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
            //     let titulo_tabla = `
        //     <h5>
        //         <strong>
        //            Vista Global de Vacaciones
        //         </strong>
        //     </h5>
        // `;
            //     imprimirTabla('catalogo-rangos-objetivos', titulo_tabla);
            // });

        });
    </script>

    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: '¿Esta seguro de que desea eliminar este catalogo?',
                text: '¡No podra recuperar la información una vez borrada!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Cancelar',
                confirmButtonText: '¡Si, borrar catalogo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Use Ajax to submit the form
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle success response
                            Swal.fire({
                                title: 'Exito',
                                text: response.message,
                                icon: 'success',
                                timer: 2000, // Adjust as needed
                                showConfirmButton: false
                            }).then(() => {
                                // Reload or update the page as needed
                                location.reload();
                            });
                        },
                        error: function(error) {
                            // Handle error response
                            Swal.fire({
                                title: 'Error',
                                text: error.responseJSON.error,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
