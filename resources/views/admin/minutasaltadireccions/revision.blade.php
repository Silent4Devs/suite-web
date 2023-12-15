@extends('layouts.admin')
@section('content')
    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }
    </style>

    {{ Breadcrumbs::render('admin.minutasaltadireccions.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Minutas de Sesiones de Alta Dirección</h5>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>Minuta Reunión</tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Fecha</strong>
                        </td>
                        <td>
                            <strong>{{ $minutasaltadireccion->responsable->name }}</strong>
                        </td>
                        <td>
                            <strong>Hora inicio:</strong>
                        </td>
                        <td>
                            <strong>{{ $minutasaltadireccion->hora_inicio }}</strong>
                        </td>
                        <td>
                            <strong>Hora Fin:</strong>
                        </td>
                        <td>
                            <strong>{{ $minutasaltadireccion->hora_termino }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Tema:</strong>
                        </td>
                        <td>
                            <strong>{{ $minutasaltadireccion->tema_reunion }}</strong>
                        </td>
                        <td>
                            <strong>Objetivo:</strong>
                        </td>
                        <td>
                            <strong>{{ $minutasaltadireccion->objetivoreunion }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">



            <div class="mb-4 ml-4 w-100" style="border-bottom: solid 2px #345183;">
                <span class="ml-1" style="font-size: 17px; font-weight: bold;">
                    Participantes</span>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="mt-3 col-12 datatable-fix">
                        <table class="table w-100" id="tbl-participantes">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Puesto/Area</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participantesWithAsistencia as $participante)
                                    <tr>
                                        <td>{{ $participante->id }}</td>
                                        <td>{{ $participante->name }}</td>
                                        <td>{{ $participante->puesto }}</td>
                                        <td>{{ $participante->email }}</td>
                                        <td>{{ $participante->pivot->asistencia ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row" x-show="externo">
                    <p class="font-weight-bold col-12" style="font-size:11pt;">Participantes externos.</p>
                    <hr>
                    <div class="mt-3 col-12 w-100 datatable-fix">
                        <table class="table w-100" id="tbl-participantesEXT">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Puesto</th>
                                    <th>Empresa u Organización</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($minutasaltadireccion->externos as $externo)
                                    <tr>
                                        <td>{{ $externo->nombreEXT }}</td>
                                        <td>{{ $externo->emailEXT }}</td>
                                        <td>{{ $externo->puestoEXT }}</td>
                                        <td>{{ $externo->empresaEXT }}</td>
                                        <td>{{ $externo->asistenciaEXT ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input disabled type="hidden" name="participantesExt" value="" id="participantesExt">
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="mt-3 col-sm-12 form-group">
                    <label for="evidencia">Documento</label>
                    <div class="custom-file">
                        <input disabled type="file" name="files[]" multiple class="form-control" id="evidencia">
                    </div>
                </div> --}}
    <div class="card">
        <div class="card-body">
            <div class="form-group col-sm-12 col-md-12 col-lg-12 mt-4">
                <label class="" for="tema_tratado">Temas
                    tratados</label>
                <textarea disabled class="form-control date" type="text" name="tema_tratado" id="temas">{{ old('tema_tratado', $minutasaltadireccion->tema_tratado) }}</textarea>
                @if ($errors->has('tema_tratado'))
                    <span class="text-danger">
                        {{ $errors->first('tema_tratado') }}
                    </span>
                @endif
            </div>

            @livewire('file-revision-direecion-component', ['minutas' => $minutasaltadireccion])
        </div>
    </div>

    {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}

    @include('admin.planesDeAccion.actividades.tabla', [
        'empleados' => $responsablereunions,
        'actividades' => $actividades,
    ])



    {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}

    <div class="card card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row" style="justify-content: center; display: flex;">
                    <h3>Firma de Aprobación</h3>
                </div>
                <div class="row" style="justify-content: center; display: flex;">
                    <button id="clear" class="btn btn-link">Limpiar Firma</button>
                </div>
                <div class="row" style="justify-content: center; display: flex;">
                    <canvas id="signature-pad" class="signature-pad" width="450" height="250"
                        style="border: 1px solid black;"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="comentario">Comentario</label>
                <textarea name="comentario" id="comentario" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="text-right form-group col-12">
                <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" id="btnGuardar" type="submit">
                    Rechazar
                </button>
                <button class="btn btn-danger" id="btnUpdateAndReview" type="submit" style="width: 230px !important;">
                    Aprobar
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('save').addEventListener('click', function() {
                if (signaturePad.isEmpty()) {
                    alert('Por favor firme el area designada.');
                } else {
                    var dataURL = signaturePad.toDataURL();
                    var repId = this.getAttribute('data-reporte');

                    fetch('{{ route('admin.auditoria-internas.storeReporteIndividual', ['reporteid' => ':reporteauditoria']) }}'
                            .replace(':reporteauditoria',
                                repId), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-Token': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    signature: dataURL
                                }),
                            })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'El lider ha sido notificado',
                                ).then(() => {
                                    window.location.href =
                                        '{{ route('admin.auditoria-internas.index') }}';
                                });
                            } else {
                                Swal.fire(
                                    'El correo no ha sido posible enviarlo debido a problemas de intermitencia con la red, favor de volver a intentar más tarde, o si esto persiste ponerse en contacto con el administrador',
                                ).then(() => {
                                    window.location.href =
                                        '{{ route('admin.auditoria-internas.index') }}';
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btnGuardar').addEventListener('click', function(e) {
                let urlUpdate =
                    "{{ route('admin.minutasaltadireccions.update', $minutasaltadireccion) }}";
                document.getElementById('formularioEditMinutas').setAttribute('action', urlUpdate);
            });

            document.getElementById('btnUpdateAndReview').addEventListener('click', function(e) {
                let urlUpdateAndReview =
                    "{{ route('admin.minutasaltadireccions.updateAndReview', $minutasaltadireccion) }}";
                document.getElementById('formularioEditMinutas').setAttribute('action', urlUpdateAndReview);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('temas', {
                toolbar: [{
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    }, {
                        name: 'clipboard',
                        groups: ['undo'],
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                    },
                    '/',


                    // {
                    //     name: 'others',
                    //     items: ['-']
                    // }
                ]
            });

        });
    </script>

    <script type="text/javascript">
        Livewire.on('planStore', () => {
            $('#planAccionModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Plan de Acción creado con éxito');
        });
        window.initSelect2 = () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
        }

        initSelect2();

        Livewire.on('select2', () => {
            initSelect2();
        });
    </script>

    <script>
        $(document).ready(function() {
            window.tblParticipantes = $('#tbl-participantes').DataTable({
                buttons: []
            })
            window.tblParticipantesEXT = $('#tbl-participantesEXT').DataTable({
                buttons: []
            })

            document.getElementById('btnGuardar').addEventListener('click', function(e) {
                // e.preventDefault();
                enviarParticipantes();
                enviarParticipantesExternos();
                enviarActividades();
            })

            document.getElementById('btnUpdateAndReview').addEventListener('click', function(e) {
                // e.preventDefault();
                enviarParticipantes();
                enviarParticipantesExternos();
                enviarActividades();
            })

        });
    </script>
@endsection
