@inject('Documento', 'App\Models\Documento')
<style>
    .mayusculatext {
        text-tranform: lowercase !important;
    }

</style>
<div class="card-body datatable-fix pb-0">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="px-1 py-2 mb-0 rounded " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección encontrará los
                            documentos que le han sido asignadas para su aprobación, o bien, documentos que usted ha
                            solicitado
                            se aprueben.

                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h5 class="p-0 m-0 text-muted" style="border-bottom: solid 2px #345183;">
                Requeridos: Documentos que debo aprobar </h5>
            @include('admin.inicioUsuario.aprobaciones.documentos-debo-aprobar.index')
        </div>
        <div class="col-12">
            <h5 class="p-0 m-0 text-muted" style="border-bottom: solid 2px #345183;">
                Solicitados: Documentos que me deben aprobar</h5>
            @include('admin.inicioUsuario.aprobaciones.documentos-me-deben-aprobar.index')
        </div>
    </div>
</div>

<div>
    @foreach ($mis_documentos as $documento)
        @if (!($documento->archivo == 'archivado'))

            <div class="modal fade" id="alert_aprob_arch{{ $documento->id }}" tabindex="-1" role="dialog"
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
                                        action="{{ route('admin.inicio-Usuario.aprobacion.archivar', $documento->id) }}"
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
    @include('admin.inicioUsuario.aprobaciones.documentos-debo-aprobar.cards-script')
    @include('admin.inicioUsuario.aprobaciones.documentos-me-deben-aprobar.cards-script')
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

            let btnArchivo = {
                text: '<i class="pl-2 pr-3 fas fa-archive"></i> Archivo',
                titleAttr: 'Archivo',
                url: "{{ route('admin.inicio-Usuario.aprobacion.archivo') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            dtButtons.push(btnArchivo);

            $("#tblMisDocumentos").DataTable({
                buttons: dtButtons,
            });

        });
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

            let btnArchivo = {
                text: '<i class="pl-2 pr-3 fas fa-archive"></i> Archivo',
                titleAttr: 'Archivo',
                url: "{{ route('admin.revisiones.archivo') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            dtButtons.push(btnArchivo);

            $("#tabla_usuario_aprobaciones").DataTable({
                buttons: dtButtons,
            });

            window.Archivar = function(url, revision_id) {
                console.log(revision_id);
                Swal.fire({
                    title: '¿Quieres archivar esta revisión?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Archivar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            data: {
                                revision_id
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                let timerInterval
                                Swal.fire({
                                    title: 'Archivando...',
                                    html: 'Estamos archivando su revisión',
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            const content = Swal
                                                .getHtmlContainer()
                                            if (content) {
                                                const b = content
                                                    .querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal
                                                        .getTimerLeft()
                                                }
                                            }
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                });
                            },
                            success: function(response) {
                                if (response.archivado) {
                                    Swal.fire(
                                        '¡Archivado!',
                                        'Su revisión ha sido archivada',
                                        'success'
                                    )
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                } else {
                                    Swal.fire(
                                        'Erro al archivar!',
                                        'Ocurrió un error',
                                        'error'
                                    )
                                }
                            },
                            error: function(err) {
                                Swal.fire(
                                    'Error!',
                                    `${err}`,
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
