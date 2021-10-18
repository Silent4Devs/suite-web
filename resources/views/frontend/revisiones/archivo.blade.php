@inject('Documento', 'App\Models\Documento')
@extends('layouts.admin')
@section('content')
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Lista de Archivos</strong></h3>
        </div>
        <div class="container datatable-fix w-100">
            <table id="tblArchivo" class="table w-100">
                <thead class="bg-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre&nbsp;del&nbsp;Documento</th>
                        <th>Versión</th>
                        <th>Tipo</th>
                        <th>Solicitante</th>
                        <th>Fecha&nbsp;de&nbsp;Solicitud</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($revisiones as $revision)
                        <tr class="text-center">
                            <td>
                                {{ Str::limit($revision->documento ? $revision->documento->codigo : 'Sin Código Asignado', 40, '...') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.documentos.renderViewDocument', $revision->documento->id) }}"
                                    class="text-dark">
                                    {{ Str::limit($revision->documento ? $revision->documento->nombre : 'Sin Documento Asignado', 40, '...') }}
                                </a>
                            </td>
                            <td>{{ $revision->version }}</td>
                            <td style="text-transform: capitalize;">
                                {{ $revision->documento ? $revision->documento->tipo : 'El tipo no ha sido asignado' }}
                            </td>
                            </td>
                            <td style="padding: 5px 0;">
                                @if ($revision->documento)
                                    @if ($revision->documento->elaborador)
                                        <img class="rounded-circle" style="clip-path: circle(40%);height:40px;"
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
                                <a href="{{ route('admin.documentos.renderViewDocument', $revision->documento) }}"
                                    class="btn btn-sm" style="border:none;" title="Visualizar Documento">
                                    <i class="fas fa-eye text-dark" style="font-size: 15px;"></i>
                                </a>
                                @if ($revision->before_level_all_answered)
                                    @if ($revision->estatus == $Documento::SOLICITUD_REVISION)
                                        <a href="{{ route('revisiones.revisar', $revision) }}" class="btn btn-sm"
                                            style="border:none;" title="Revisar">
                                            <i class="fas fa-file-signature text-dark" style="font-size: 15px;"></i>
                                        </a>
                                    @endif
                                    @if ($revision->estatus != $Documento::SOLICITUD_REVISION)
                                        <a class="btn btn-sm" style="border:none;" title="Remover del archivo"
                                            onClick="Desarchivar('{{ route('admin.revisiones.desarchivar') }}','{{ $revision->id }}')">
                                            <i class=" fas fa-archive text-success" style="font-size: 15px;"></i>
                                        </a>
                                    @endif
                                @else
                                    <span class="badge badge-info">El nivel anterior de revisores aún no termina de
                                        revisar</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#tblArchivo").DataTable({
                buttons: []
            });

            window.Desarchivar = function(url, revision_id) {
                Swal.fire({
                    title: '¿Quieres desarchivar esta revisión?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Desarchivar',
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
                                    title: 'Desarchivando...',
                                    html: 'Estamos desarchivando su revisión',
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
                                if (response.desarchivado) {
                                    Swal.fire(
                                        '¡Desarchivado!',
                                        'Su revisión ha sido desarchivada',
                                        'success'
                                    )
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                } else {
                                    Swal.fire(
                                        'Erro al desarchivar!',
                                        'Ocurrió un error',
                                        'error'
                                    )
                                }
                            },
                            error: function(err) {
                                console.log(err);
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
