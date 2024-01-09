@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('admin.auditoria-internas.index') }}
    </div>

    <h5 class="col-12 titulo_general_funcion">Informe de Auditoría </h5>
    <div class="card card-body" style="background-color: #7587D0; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <h4>¿Qué es Informe de auditoría?</h4>
                <p>
                    Es un documento que describe los resultados de una auditoría.
                </p>
                <p>
                    Los informes de auditoría son una herramienta importante para mejorar la eficacia y eficiencia de los
                    sistemas y procesos. Los informes de auditoría ayudan a las organizaciones a identificar y corregir las
                    deficiencias, lo que puede conducir a una mejora del rendimiento y la reducción de los riesgos.
                </p>
            </div>
        </div>
    </div>
    <div class="text-right">
        <a class="btn btn-info"
            style="background-color: #057BE2; padding-top: 15px !important; padding-bottom: 15px !important;"
            href="{{ route('admin.auditoria-internas.create') }}">
            Crear auditoría <strong>+</strong>
        </a>
    </div>

    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <h3 class="title-table-rds">Informe de auditorias</h3>
        <table class="datatable datatable-AuditoriaInternas tblCSV" id="vista-global-vacaciones">
            <thead>
                <tr>
                    <th style="min-width: 70px;">
                        ID
                    </th>
                    <th style="min-width: 150px;">
                        Nombre de auditoría
                    </th>
                    <th style="min-width: 100px;">
                        Fecha inicio
                    </th>
                    <th style="min-width: 300px;">
                        Objetivo
                    </th>
                    <th>
                        Reportes
                    </th>
                    <th>
                        Opciones
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($query as $aud)
                    <tr>
                        <td>
                            {{ $aud->id_auditoria }}
                        </td>
                        <td>
                            {{ $aud->nombre_auditoria }}
                        </td>
                        <td>
                            {{ $aud->fecha_inicio }}
                        </td>
                        <td>
                            {!! $aud->objetivo !!}
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.auditoria-internas.reporteIndividual', $aud->id) }}">
                                <i class="fa-solid fa-user-check" style="color:#5A5A5A;"></i>
                            </a>
                        </td>
                        <td>
                            <div class="btn" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="btn" onclick="viewAudit({{ $aud->id }})">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <form id="deleteForm{{ $aud->id }}"
                                action="{{ route('admin.auditoria-internas.destroy', $aud->id) }}" method="POST">
                                <div class="dropdown-menu">
                                    <a href="{{ asset('admin/auditoria-internas/' . $aud->id) }}" class="dropdown-item">
                                        <i class="fa-solid fa-eye"></i>&nbsp;Ver
                                    </a>
                                    <a href="{{ route('admin.auditoria-internas.edit', $aud->id) }}" class="dropdown-item">
                                        <i class="fa-solid fa-pencil"></i>&nbsp;Editar
                                    </a>
                                    @csrf
                                    @method('DELETE') <!-- Use the DELETE method -->
                                    <button type="button" class="dropdown-item delete-btn" data-id="{{ $aud->id }}">
                                        <i class="fa-solid fa-trash"></i>&nbsp;Eliminar
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    {{-- <tr class="d-none tr-sec-menu tr-second{{ $aud->id }}" style="background-color: #F5FEFF;">
                        <td colspan="6">
                            <div class="d-flex" style="gap: 20px;">
                                <div style="max-width: 50%;">
                                    <strong>Alcance</strong> <br> <br>
                                    {!! $aud->alcance !!}
                                </div>
                                <div style="max-width: 50%;">
                                    <strong>Criterio de auditoría</strong> <br> <br>
                                    {!! $aud->criterios_auditoria !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="d-none tr-sec-menu tr-second{{ $aud->id }}" style="background-color: #F4F4F4;">
                        <td colspan="6">
                            <div class="d-flex" style="gap: 20px;">
                                <div style="max-width: 50%;">
                                    <strong>Auditor Lider</strong> <br> <br>
                                    @if ($aud->lider)
                                        <img src="{{ $aud->lider->avatar_ruta }}" title="{{ $aud->lider->name }}"
                                            class="rounded-circle; ml-4"
                                            style="clip-path: circle(15px at 50% 50%);height: 30px; " />
                                    @endif
                                </div>
                                <div style="max-width: 50%;">
                                    <strong> Auditor externo </strong> <br> <br>
                                    @if ($aud->auditor_externo)
                                        {{ $aud->auditor_externo }}
                                    @endif
                                </div>
                                <div style="max-width: 50%;">
                                    <strong>Equipo auditoría</strong> <br> <br>
                                    @foreach ($aud->equipo as $emp)
                                        {{ $emp->name }}, <br>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                    </tr> --}}
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session('edit'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'No es posible acceder a vista.',
                    imageUrl: `{{ asset('assets/rechazo-edit-auditoria.png') }}`, // Replace with the path to your image
                    imageWidth: 260, // Set the width of the image as needed
                    imageHeight: 160,
                    html: `<p>Esta sección solo puede ser visible si se tienen los permisos requeridos.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                });

            });
        </script>
    @endif
    @if (session('reporte'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'No es posible acceder a esta vista.',
                    imageUrl: `{{ asset('assets/rechazo-reporte-auditoria.png') }}`, // Replace with the path to your image
                    imageWidth: 260, // Set the width of the image as needed
                    imageHeight: 160,
                    html: `<p>Esta sección solo puede ser visible si se tienen los permisos requeridos.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                });
            });
        </script>
    @endif
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            // let dtButtons = [{
            //         extend: 'csvHtml5',
            //         title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar CSV',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },
            //     {
            //         extend: 'excelHtml5',
            //         title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar Excel',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },

            //     {
            //         extend: 'colvis',
            //         text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Seleccionar Columnas',
            //     },
            //     {
            //         extend: 'colvisGroup',
            //         text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         show: ':hidden',
            //         titleAttr: 'Ver todo',
            //     },
            //     {
            //         extend: 'colvisRestore',
            //         text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Restaurar a estado anterior',
            //     }

            // ];

            let dtButtons = [];



            let dtOverrideGlobals = {
                pageLength: 5,
                buttons: dtButtons,
                processing: true,
                retrieve: true,
            };
            let table = $('.datatable-AuditoriaInternas').DataTable(dtOverrideGlobals);
            // $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
            //     let titulo_tabla = `
        //     <h5>
        //         <strong>
        //            Vista Global de Vacaciones
        //         </strong>
        //     </h5>
        // `;
            //     imprimirTabla('vista-global-vacaciones', titulo_tabla);
            // });

        });
    </script>
    <script>
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const audId = this.getAttribute('data-id');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción eliminará el registro permanentemente.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/auditoria-internas/${audId}`, {
                                method: 'DELETE', // Send a DELETE request
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        title: 'Éxito',
                                        text: 'Registro eliminado con éxito',
                                        icon: 'success'
                                    }).then(() => {
                                        window.location
                                            .reload(); // Reload the page after successful deletion
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'No se pudo eliminar el registro',
                                        icon: 'error'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Hubo un problema al eliminar el registro',
                                    icon: 'error'
                                });
                            });
                    }
                });
            });
        });
    </script>
@endsection
