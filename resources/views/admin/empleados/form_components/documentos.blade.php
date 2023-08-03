<style type="text/css">
    .img_empleado_expediente {
        clip-path: circle(70px at 50% 50%);
        width: 140px !important;
        height: 140px !important;
        min-width: 140px !important;
        max-width: 140px !important;

        max-height: 140px !important;
        min-height: 140px !important;
    }

    .lista_docs_archivo {
        padding: 0;
        margin: 0;
        width: 100%;
    }

    .lista_docs_archivo li {
        width: 100%;
        height: 50px;
        margin-top: 3px;
        /*border-bottom: 1px solid rgba(0, 0, 0, 0);*/
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.05);
        padding: 20px;
        border-radius: 4px;
    }

    .lista_docs_archivo li i {
        font-size: 15pt;
        cursor: pointer;
    }

    .modal-dialog {
        max-width: 650px !important;
    }

    #tabla_docs font {
        color: #fff;
        padding: 5px;
        border-radius: 4px;
    }

    #tabla_docs .opcional {
        background-color: #25B82B;
        text-transform: capitalize;
    }

    #tabla_docs .obligatorio {
        background-color: #DD3939;
        text-transform: capitalize;
    }

    #tabla_docs .aplica {
        background-color: #FA8E1C;
    }

    #tabla_docs .aplica::before {
        content: "Solo si ";
    }
</style>


<div class="">
    <div class="row">

        <div class="col-12 d-flex" style="justify-content:space-between;">
            <div class="d-flex align-items-center">
                <img class="img_empleado_expediente"
                    src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado ? $empleado->avatar : 'user.png' }}">

                <div class="ml-4">
                    <h5>{{ $empleado->name }}</h5>
                    <span>{{ $empleado->puesto }}</span><br>
                    <span>{{ $empleado->area ? $empleado->area->area : '' }}</span>
                </div>
            </div>

            @php
                use App\Models\Organizacion;
                use App\Models\EvidenciasDocumentosEmpleados;

                $organizacion = Organizacion::getLogo();
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'logotipo-tabantaj.png';
                }
            @endphp

            <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 130px;">
        </div>

        <div class="col-12 my-4">
            <hr>
        </div>

        <div class="datatable-fix col-12">
            <table class="table table-bordered w-100 datatable datatable-Perfiles" id="tabla_docs">
                <thead class="thead-dark">
                    <tr>
                        <th style="max-width:120px;">Tipo</th>
                        <th>Documento</th>
                        <th style="max-width:160px; text-align: center;">ID</th>
                        <th style="max-width:350px; text-align: center;">Archivo</th>
                    </tr>
                </thead>
                <tbody id="tablaDocsTbody">
                    {{-- @foreach ($lista_docs as $doc)
                        <tr>
                            <td>
                                <font class="{{ $doc->tipo }}">{{ $doc->tipo }}</font>
                            </td>
                            <td>{{ $doc->documento }}</td>
                            <td>
                                <input id="" data-id="{{ $doc->id }}" data-empleado="{{ $empleado->id }}"
                                    name="numero" class="form-control"
                                    value="{{ $doc->empleado ? $doc->empleado->numero : null }}">
                            </td>
                            <td style=" display: flex;justify-content: center; position: relative;">
                                @if ($doc->ruta_documento)
                                    <a target="_blank" href="{{ $doc->ruta_documento }}"
                                        style="text-align:center; display:inline-block;">
                                        <img src="{{ asset('img/pdf-file.png') }}" style="width:50px;"><br>
                                        {{ $doc->nombre_doc }}
                                    </a>
                                    <label for="documento{{ $doc->id }}" class="text-center"
                                        style="position:absolute; right: 20px; top:20px;">
                                        <i class="fa-solid fa-arrows-rotate btn" title="Actualizar Documento"></i>
                                    </label>
                                    <input type="file" class="form-control d-none" id="documento{{ $doc->id }}"
                                        data-id="{{ $doc->id }}" data-empleado="{{ $empleado->id }}"
                                        name="file" />

                                    <label class="text-center" style="position:absolute; right: 20px; top:50px;"
                                        data-toggle="modal" data-target="#modal_docs_{{ $doc->id }}">
                                        <i class="fa-solid fa-eye btn"></i>
                                    </label>
                                @else
                                    <div class="text-center">
                                        <label for="documento{{ $doc->id }}" class="text-center">
                                            <img src="{{ asset('img/upload-pdf.png') }}" style="width:40px" />
                                            <p class="m-0 text-muted" style="font-size:10px">Subir Documento</p>
                                        </label>
                                    </div>
                                    <input type="file" class="form-control d-none" id="documento{{ $doc->id }}"
                                        data-id="{{ $doc->id }}" data-empleado="{{ $empleado->id }}"
                                        name="file" />
                                    <p class="m-0">
                                        <span class="errors documento_error text-danger"></span>
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modales_versiones">
    @foreach ($lista_docs as $doc)
        <div class="modal fade" id="modal_docs_{{ $doc->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Versiones del documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="lista_docs_archivo">
                            <li><a target="_blank"
                                    href="{{ $doc->ruta_documento }}"><strong>{{ $doc->nombre_doc }}</strong> </a>
                                <label>Archivo Actual <i class="fa-solid fa-circle-check"
                                        style="color:#25B82B;"></i></label>
                            </li>
                            @if (is_array($doc->documento_versiones))
                                @foreach ($doc->documento_versiones as $doc_version)
                                    <li>
                                        <a target="_blank"
                                            href="{{ $doc_version->ruta_documento }}"><strong>{{ $doc_version->documento }}</strong>
                                            | {{ $doc_version->created_at->diffForHumans() }}</a>
                                        <i class="fa-solid fa-file-export restaurar_archivo"
                                            data-id="{{ $doc_version->id }}"
                                            data-expediente-id="{{ $doc->evidencia_viejo_id }}"
                                            title="Recuperar Archivo"></i>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('modales_versiones').addEventListener('click', function(e) {
            if (e.target.classList.contains('restaurar_archivo')) {
                const id = e.target.getAttribute('data-id');
                const expediente_id = e.target.getAttribute('data-expediente-id');

                Swal.fire({
                    title: '¿Desea recuperar el archivo como actual?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Recuperar'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('expediente_id', expediente_id);
                            const url =
                                '{{ route('admin.empleado.edit.expediente-restaurar') }}';
                            formData.forEach(item => console.log(item));
                            const response = await fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr('content'),
                                },
                            })

                            const data = await response.json()
                            console.log(data);
                            if (data.status == 200) {
                                window.location.reload();
                            }
                        } catch (error) {
                            toastr.error(error);
                        }
                    }
                });
            }
        });
    });
</script>
