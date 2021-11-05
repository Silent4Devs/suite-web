@inject('Documento', 'App\Models\Documento')
<div class="card-body datatable-fix">
    <h5 class="p-0 m-0 text-muted">Solicitados: Documentos que envíe a aprobación</h5>
    <hr>
    <table id="tblMisDocumentos" class="table">
        <thead>
            <tr>
                <th style="vertical-align: top">
                    Código&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </th>
                <th style="vertical-align: top">
                    Nombre
                </th>
                <th style="vertical-align: top">
                    Tipo
                </th>

                <th style="vertical-align: top">
                    Vinculado&nbsp;a
                </th>
                <th style="vertical-align: top">
                    Estatus
                </th>
                <th style="vertical-align: top">
                    Versión
                </th>
                <th style="vertical-align: top; min-width:200px;">
                    Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </th>
                <th style="vertical-align: top">
                    Elaboró
                </th>
                <th style="vertical-align: top">
                    Revisó
                </th>
                <th style="vertical-align: top">
                    Aprobó
                </th>
                <th style="vertical-align: top">
                    Responsable
                </th>
                <th style="vertical-align: top">
                    Visualizar
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mis_documentos as $documento)
                <tr>
                    <td>
                        {{ $documento->codigo ?? '' }}
                    </td>
                    <td>
                        {{ $documento->nombre ?? '' }}
                    </td>
                    <td style="text-transform: capitalize">
                        {{ $documento->tipo ?? '' }}
                    </td>
                    @if ($documento->proceso_id == null)
                        <th style="vertical-align: top">
                            {{ $documento->macroproceso ? $documento->macroproceso->nombre : 'Sin vincular' }}
                        </th>
                    @else
                        <th style="vertical-align: top">
                            {{ $documento->proceso ? $documento->proceso->nombre : 'Sin vincular' }}
                        </th>
                    @endif
                    <td>
                        @if ($documento->estatus)
                            @switch($documento->estatus)
                                @case(1)
                                    <span class="badge badge-info">EN ELABORACIÓN</span>
                                @break
                                @case(2)
                                    <span class="badge badge-primary">EN REVISIÓN</span>
                                @break
                                @case(3)
                                    <span class="badge badge-success">PUBLICADO</span>
                                @break
                                @case(4)
                                    <span class="badge badge-danger">RECHAZADO</span>
                                @break
                                @default
                                    <span class="badge badge-info">EN ELABORACIÓN</span>
                            @endswitch

                        @endif
                    </td>
                    <td>
                        {{ $documento->version == 0 ? 'Sin versión actualmente' : $documento->version }}
                    </td>
                    <td>
                        {{ $documento->fecha_dmy ?? '' }}
                    </td>
                    <td>
                        @if ($documento->elaborador)
                            <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->elaborador->avatar }}"
                                class="rounded-circle" alt="{{ $documento->elaborador->name }}"
                                title="{{ $documento->elaborador->name }}" width="40">
                        @else
                            <span class="badge badge-info">Sin Asignar</span>
                        @endif
                    </td>
                    <td>
                        @if ($documento->revisor)
                            <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->revisor->avatar }}"
                                class="rounded-circle" alt="{{ $documento->revisor->name }}"
                                title="{{ $documento->revisor->name }}" width="40">
                        @else
                            <span class="badge badge-info">Sin Asignar</span>
                        @endif
                    </td>
                    <td>
                        @if ($documento->aprobador)
                            <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->aprobador->avatar }}"
                                class="rounded-circle" alt="{{ $documento->aprobador->name }}"
                                title="{{ $documento->aprobador->name }}" width="40">
                        @else
                            <span class="badge badge-info">Sin Asignar</span>
                        @endif
                    </td>
                    <td>
                        @if ($documento->responsable)
                            <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->responsable->avatar }}"
                                class="rounded-circle" alt="{{ $documento->responsable->name }}"
                                title="{{ $documento->responsable->name }}" width="40">
                        @else
                            <span class="badge badge-info">Sin Asignar</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <a class="btn btn-sm" style="border:none;" title="Visualizar Documento"
                                href="{{ route('admin.documentos.renderViewDocument', $documento) }}">
                                <i class="fas fa-eye text-dark" style="font-size: 15px;"></i>
                            </a>

                            <a class="btn btn-sm " title="Visualizar revisiones" style="border:none;"
                                href="{{ route('admin.documentos.renderHistoryReview', $documento->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                    class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path
                                        d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                    <path
                                        d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                            </a>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-body datatable-fix">
    <h5 class="p-0 m-0 text-muted">Requeridos: Documentos que debo aprobar</h5>
    <hr>
    <table id="tabla_usuario_aprobaciones" class="table">
        <thead>
            <tr>
                <th>Código&nbsp;del&nbsp;Documento</th>
                <th>Nombre&nbsp;del&nbsp;Documento</th>
                <th>Versión</th>
                <th>Tipo</th>
                <th>Solicitante</th>
                <th style="min-width:200px;">Fecha&nbsp;de&nbsp;Solicitud</th>
                <th>Estatus</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revisiones as $revision)
                @if ($revision->before_level_all_answered)
                    @if ($revision->estatus != $Documento::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR)
                        <tr>
                            <td>
                                {{ Str::limit($revision->documento ? $revision->documento->codigo : 'Sin Código Asignado', 40, '...') }}
                            </td>
                            <td>
                                @if ($revision->documento)
                                <a href="{{ route('admin.documentos.renderViewDocument', $revision->documento->id) }}"
                                    class="text-dark">
                                    {{ Str::limit($revision->documento ? $revision->documento->nombre : 'Sin Documento Asignado', 40, '...') }}
                                </a>
                                @else
                                Sin revisión
                                @endif
                            </td>
                            <td>{{ $revision->version }}</td>
                            <td style="text-transform: capitalize;">
                                {{ $revision->documento ? $revision->documento->tipo : 'El tipo no ha sido asignado' }}
                            </td>
                            </td>
                            <td class="text-center" style="padding: 5px 0;">
                                @if ($revision->documento)
                                    @if ($revision->documento->elaborador)
                                        <img class="rounded-circle" style="clip-path: circle(40%);height: 35px"
                                            src="{{ Storage::url('empleados/imagenes/' . $revision->documento->elaborador->avatar) }}"
                                            alt="{{ $revision->documento->elaborador->name }}"
                                            title="{{ $revision->documento->elaborador->name }}" />
                                    @endif
                                @else
                                    Sin Asignar
                                @endif
                            </td>
                            <td>{{ $revision->fecha_solicitud }}</td>
                            <td style="background-color: {{ $revision->color_revisiones_estatus }}">
                                <span class="badge"
                                    style="color:white;background-color:{{ $revision->color_revisiones_estatus }}">{{ $revision->estatus_revisiones_formateado }}</span>
                            <td>
                                @if ($revision->documento)
                                <a href="{{ route('admin.documentos.renderViewDocument', $revision->documento) }}"
                                    class="btn btn-sm" style="border:none;" title="Visualizar Documento">
                                    <i class="fas fa-eye text-dark" style="font-size: 15px;"></i>
                                </a>
                                @endif
                                @if ($revision->before_level_all_answered)
                                    @if ($revision->estatus == $Documento::SOLICITUD_REVISION)
                                        <a href="{{ route('revisiones.revisar', $revision) }}" class="btn btn-sm"
                                            style="border:none;" title="Revisar">
                                            <i class="fas fa-file-signature text-dark" style="font-size: 15px;"></i>
                                        </a>
                                    @endif
                                    @if ($revision->estatus != $Documento::SOLICITUD_REVISION)
                                        <a class="btn btn-sm" style="border:none;" title="Archivar"
                                            onClick="Archivar('{{ route('admin.revisiones.archivar') }}','{{ $revision->id }}')">
                                            <i class=" fas fa-archive text-success" style="font-size: 15px;"></i>
                                        </a>
                                    @endif
                                @else
                                    <span class="badge badge-info">El nivel anterior de revisores aún no termina de
                                        revisar</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>
</div>


@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {

            let dtButtons = [];
            // let dtButtons = [{
            //         extend: 'csvHtml5',
            //         title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar CSV',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },
            //     {
            //         extend: 'excelHtml5',
            //         title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar Excel',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },
            //     {
            //         extend: 'pdfHtml5',
            //         title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar PDF',
            //         orientation: 'portrait',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         },
            //         customize: function(doc) {
            //             doc.pageMargins = [20, 60, 20, 30];
            //             // doc.styles.tableHeader.fontSize = 7.5;
            //             // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Imprimir',
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

            $("#tblMisDocumentos").DataTable({
                buttons: [],
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
