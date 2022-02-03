@inject('Empleado', 'App\Models\Empleado')

<style type="text/css">
    .td_div_recursos {
        width: 100px;
        display: flex;
        overflow-x: auto;
    }

    .td_nombre {
        min-width: 400px !important;
    }

    .td_recursos {
        position: relative;
    }

</style>
<div class="card-body datatable-fix w-100">
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
                    actividades
                    que le han sido asignadas en los Planes de Acción creados dentro del sistema.
                </p>

            </div>
        </div>
    </div>
    @include('admin.inicioUsuario.actividades.index')
</div>

{{-- <div>
    @foreach ($actividades as $task)
        @if (!($task->archivo == 'archivado'))

            <div class="modal fade" id="alert_activ{{ $task->id }}" tabindex="-1" role="dialog"
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
                                        action="{{ route('admin.inicio-Usuario.actividades.archivar', $task->id_implementacion) }}"
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
</div> --}}

@section('scripts')
    @parent
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const tblActividades = document.getElementById('tabla_usuario_actividades');
            const cardsActividades = document.getElementById('cards-actividades2');
            tblActividades.addEventListener('click', async (e) => {
                if (e.target.getAttribute('data-archivar') == 'true') {
                    const actividadID = e.target.getAttribute('data-actividad-id');
                    const planImplementacionID = e.target.getAttribute('data-plan-implementacion');
                    const url = "{{ route('admin.inicio-Usuario.actividades.archivar') }}"
                    const formData = new FormData();
                    formData.append('taskID', actividadID);
                    formData.append('planImplementacionID', planImplementacionID);
                    Swal.fire({
                        title: '¿Quieres Archivar esta Actividad?',
                        text: "",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Archivar',
                        cancelButtonText: 'No',
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            const response = await fetch(url, {
                                method: "POST",
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr(
                                            'content'),
                                },
                            })
                            const data = await response.json();
                            if (data.success) {
                                window.location.reload();
                            }
                        }
                    })
                }
            })
            cardsActividades.addEventListener('click', async (e) => {
                if (e.target.getAttribute('data-archivar') == 'true') {
                    const actividadID = e.target.getAttribute('data-actividad-id');
                    const planImplementacionID = e.target.getAttribute('data-plan-implementacion');
                    const url = "{{ route('admin.inicio-Usuario.actividades.archivar') }}"
                    const formData = new FormData();
                    formData.append('taskID', actividadID);
                    formData.append('planImplementacionID', planImplementacionID);
                    Swal.fire({
                        title: '¿Quieres Archivar esta Actividad?',
                        text: "",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Archivar',
                        cancelButtonText: 'No',
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            const response = await fetch(url, {
                                method: "POST",
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr(
                                            'content'),
                                },
                            })
                            const data = await response.json();
                            if (data.success) {
                                window.location.reload();
                            }
                        }
                    })
                }
            })
        })
    </script>
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
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "compartido"
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

            let btnArchivo = {
                text: '<i class="pl-2 pr-3 fas fa-archive"></i> Archivo',
                titleAttr: 'Archivo',
                url: "{{ asset('admin/inicioUsuario/actividades/archivo') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            dtButtons.push(btnArchivo);
            $("#tabla_usuario_actividades").DataTable({
                buttons: dtButtons,
                autoWidth: true
            });
        });
    </script>
@endsection
