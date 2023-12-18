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
                    <div class="mt-3 col-12">
                        <table>
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Puesto/Area</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participantesWithAsistencia as $participante)
                                    <tr>
                                        <td>{{ $participante->name }}</td>
                                        <td>{{ $participante->puestoRelacionado->puesto }}/{{ $participante->area->area }}
                                        </td>
                                        <td>{{ $participante->pivot->asistencia ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <p class="font-weight-bold col-12" style="font-size:11pt;">Participantes externos.</p>
                    <hr>
                    <div class="mt-3 col-12 w-100">
                        <table>
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre/Apellidos</th>
                                    <th>Puesto/Área</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($minutasaltadireccion->externos as $externo)
                                    <tr>
                                        <td>{{ $externo->nombreEXT }}</td>
                                        <td>{{ $externo->puestoEXT }}</td>
                                        <td>{{ $externo->asistenciaEXT ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <table>
                        <thead>
                            <p>Temas Tratados</p>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea disabled class="form-control date" type="text" name="tema_tratado" id="temas">{{ old('tema_tratado', $minutasaltadireccion->tema_tratado) }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}

    {{-- <style>
    .table tr th:nth-child(8) {
        min-width: 800px !important;
        text-align: justify !important;
    }
</style> --}}




    <div class="card">
        <div class="card-body">
            <div class="mt-5 w-100">
                <table class="w-100">
                    <thead class="thead-dark">
                        <tr>
                            <td colspan="5">Acuerdos y Compromisos</td>
                        </tr>
                        <tr>
                            <th scope="col">Actividad</th>
                            <th scope="col">Responsable(s)</th>
                            <th scope="col">Fecha Compromiso</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Comentarios</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($actividades))
                            @foreach ($actividades as $actividad)
                                @php
                                    $estatus = 'Completado';
                                    $color = 'rgb(0,200,117)';
                                    $textColor = 'white';
                                    switch ($actividad->status) {
                                        case 'STATUS_ACTIVE':
                                            $estatus = 'En Progreso';
                                            $color = 'rgb(253, 171, 61)';
                                            break;
                                        case 'STATUS_DONE':
                                            $color = 'rgb(0, 200, 117)';
                                            $estatus = 'Completado';
                                            break;
                                        case 'STATUS_FAILED':
                                            $estatus = 'Con Retraso';
                                            $color = 'rgb(226, 68, 92)';
                                            break;
                                        case 'STATUS_SUSPENDED':
                                            $estatus = 'Suspendido';
                                            $color = '#aaaaaa';
                                            break;
                                        case 'STATUS_WAITING':
                                            $estatus = 'En Espera';
                                            $color = '#F79136';

                                            break;
                                        case 'STATUS_UNDEFINED':
                                            $estatus = 'Indefinido';
                                            $color = '#00b1e1';
                                            break;
                                        default:
                                            $estatus = 'Indefinido';
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $actividad->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($actividad->assigs as $assig)
                                                @php
                                                    $empleado = App\Models\Empleado::getAll()->find(intval($assig->resourceId));
                                                @endphp
                                                {{-- <img src="{{ $empleado->avatar_ruta }}" id="res_{{ $empleado->id }}"
                                                alt="{{ $empleado->name }}" title="{{ $empleado->name }}"
                                                style="clip-path: circle(15px at 50% 50%);width: 45px;" />
                                                 --}}

                                                <li>{{ $empleado->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp(intval($actividad->end) / 1000)->toDateTimeString())->format('Y-m-d') }}
                                    </td>
                                    <td style="background: {{ $color }}; color:{{ $textColor }}">
                                        {{ $estatus }}
                                    </td>
                                    <td>{{ $actividad->description }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}

    @if ($accesoparticipante == true)
        <form method="POST" id="formularioRevision" enctype="multipart/form-data">
            @csrf
            {{-- <div class="card card-body">
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
        </div> --}}
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="comentario">Comentario</label>
                        <textarea name="comentario" id="comentario" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center form-group col-12">
                        <button class="btn btn-danger" id="aprobado" type="submit" style="width: 230px !important;">
                            Aprobar Solicitud
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center form-group col-12">
                        <button class="btn btn-danger" id="rechazado" type="submit">
                            Rechazar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @endif
    <div class="col-12">
        <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn_cancelar">Regresar</a>
    </div>
@endsection

@section('scripts')
    {{-- <script>
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
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('aprobado').addEventListener('click', function(e) {
                let aprobar =
                    "{{ route('admin.minutasaltadireccions.aprobado', $minutasaltadireccion->id) }}";
                document.getElementById('formularioRevision').setAttribute('action', aprobar);
            });

            document.getElementById('rechazado').addEventListener('click', function(e) {
                let rechazar =
                    "{{ route('admin.minutasaltadireccions.rechazado', $minutasaltadireccion->id) }}";
                document.getElementById('formularioRevision').setAttribute('action', rechazar);
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

    {{-- <script type="text/javascript">
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
    </script> --}}
@endsection
