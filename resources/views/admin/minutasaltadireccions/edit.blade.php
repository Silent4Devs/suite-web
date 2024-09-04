@extends('layouts.admin')
@section('content')
    @include('admin.listadistribucion.estilos')
    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }
    </style>

    {{ Breadcrumbs::render('admin.minutasaltadireccions.create') }}

    <h5 class="col-12 titulo_general_funcion">Minutas de Sesiones de Alta Dirección</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <br>
                <h4>¿Qué es Minutas de Sesiones de Alta Dirección?</h4>
                <p>
                    Proceso fundamental en el contexto de los sistemas de gestión.
                </p>
                <p>
                    Este proceso implica que la alta dirección de una organización revise y evalúe de manera periódica el
                    desempeño y la efectividad del sistema de gestión en su conjunto. Su propósito principal es asegurar
                    que
                    el
                    sistema de gestión esté funcionando de manera eficaz y que se estén cumpliendo los objetivos y metas
                    establecidos. Como evidencia de este punto se propone la generación de una minuta.
                </p>
            </div>
        </div>
    </div>
    <form method="POST" id="formularioEditMinutas" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card card-body">
            <div class="card-header">
                <h5>Minuta Revisión por Dirección</h5>
            </div>
            <div>
                <div class="form-row">
                    <div class="form-group anima-focus col-sm-12 col-md-6 col-lg-6">
                        <select required class="form-control" name="responsable_id" id="responsable_id">
                            @foreach ($responsablereunions as $responsablereunion)
                                <option value="{{ $responsablereunion->id }}"
                                    {{ old('responsable_id', $minutasaltadireccion->responsable_id) == $responsablereunion->id ? 'selected' : '' }}>
                                    {{ $responsablereunion->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('responsable_id'))
                            <span class="text-danger">
                                {{ $errors->first('responsable_id') }}
                            </span>
                        @endif
                        <label class="required" for="responsable_id">Elaboró</label>
                        <span
                            class="help-block">{{ trans('cruds.minutasaltadireccion.fields.responsablereunion_helper') }}</span>
                    </div>
                    <div class="form-group anima-focus col-sm-12 col-md-6 col-lg-6">
                        <input required class="form-control date" type="date" min="1945-01-01" name="fechareunion"
                            id="fechareunion" placeholder=""
                            value="{{ old('fechareunion', \Carbon\Carbon::parse($minutasaltadireccion->fechareunion)->format('Y-m-d')) }}">
                        <label class="required"
                            for="fechareunion">{{ trans('cruds.minutasaltadireccion.fields.fechareunion') }}</label>
                        @if ($errors->has('fechareunion'))
                            <span class="text-danger">
                                {{ $errors->first('fechareunion') }}
                            </span>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.minutasaltadireccion.fields.fechareunion_helper') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group anima-focus col-sm-12 col-md-3 col-lg-3">
                        <input placeholder=""required class="form-control date" type="time" name="hora_inicio"
                            id="hora_inicio" value="{{ old('hora_inicio', $minutasaltadireccion->hora_inicio) }}">
                        <label class="required" for="hora_inicio">Horario de
                            inicio</label>
                        @if ($errors->has('hora_inicio'))
                            <span class="text-danger">
                                {{ $errors->first('hora_inicio') }}
                            </span>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.minutasaltadireccion.fields.fechareunion_helper') }}</span>
                    </div>
                    <div class="form-group anima-focus col-sm-12 col-md-3 col-lg-3">
                        <input placeholder=""required class="form-control date" type="time" name="hora_termino"
                            id="hora_termino" value="{{ old('hora_termino', $minutasaltadireccion->hora_termino) }}">
                        <label class="required" for="hora_termino">Horario de
                            término</label>
                        @if ($errors->has('hora_termino'))
                            <span class="text-danger">
                                {{ $errors->first('hora_termino') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group anima-focus col-sm-12 col-md-6 col-lg-6">
                        <select required class="form-control" name="tipo_reunion" id="tipo_reunion"
                            value="{{ old('tipo_reunion') }}">
                            <option value="presencial"
                                {{ old('tipo_reunion', $minutasaltadireccion->tipo_reunion) == 'presencial' ? 'selected' : '' }}>
                                Presencial</option>
                            <option value="remota"
                                {{ old('tipo_reunion', $minutasaltadireccion->tipo_reunion) == 'remota' ? 'selected' : '' }}>
                                Remota</option>
                            <option value="hibrida"
                                {{ old('tipo_reunion', $minutasaltadireccion->tipo_reunion) == 'hibrida' ? 'selected' : '' }}>
                                Hibrida</option>
                        </select>
                        <label class="required" for="tipo_reunion">Tipo de reunión<span class="text-danger">*</span></label>
                        @if ($errors->has('tipo_reunion'))
                            <span class="text-danger">
                                {{ $errors->first('tipo_reunion') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-12">
                        <input placeholder=""required data-vincular-nombre='true' class="form-control date" type="text"
                            name="tema_reunion" id="tema_reunion"
                            value="{{ old('tema_reunion', $minutasaltadireccion->tema_reunion) }}">
                        <label class="required" for="tema_reunion">Tema de la
                            reunión</label>
                        @if ($errors->has('tema_reunion'))
                            <span class="text-danger">
                                {{ $errors->first('tema_reunion') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-12">
                        <textarea required class="form-control" name="objetivoreunion" id="objetivoreunion">{{ old('objetivoreunion', $minutasaltadireccion->objetivoreunion) }}</textarea>
                        <label class="required"
                            for="objetivoreunion">{{ trans('cruds.minutasaltadireccion.fields.objetivoreunion') }}</label>
                        @if ($errors->has('objetivoreunion'))
                            <span class="text-danger">
                                {{ $errors->first('objetivoreunion') }}
                            </span>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.minutasaltadireccion.fields.objetivoreunion_helper') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body">
            <div class="card-header">
                <h5>Participantes</h5>
            </div>
            <div class="">
                <small> <strong>NOTA: </strong>Para agregar participantes
                    externos de click en el botón que tiene el siguiente icono</small>
                <div class="pl-3 row w-100" x-data="{ externo: {{ $minutasaltadireccion->externos ? 'true' : 'false' }} }">
                    <div class="col-12" style="text-align: end">

                        <i class="fas fa-user-tag" x-bind:class="externo ? 'bg-primary p-2 rounded text-white' : ''"
                            style="color:black" @click.prevent="externo = !externo"></i>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input type="hidden" id="id_empleado">
                                <input placeholder=""class="form-control" type="text" id="participantes_search"
                                    placeholder="" style="position: relative" autocomplete="off" />
                                <label class="required" for="participantes">Buscar
                                    participante</label>
                                <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                                    style="position: absolute; top: 15px; right: 25px;"></i>
                                <div id="participantes_sugeridos"></div>
                                @if ($errors->has('participantes'))
                                    <span class="text-danger">
                                        {{ $errors->first('participantes') }}
                                    </span>
                                @endif
                                <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input class="form-control" type="text" id="email" placeholder="" readonly
                                    style="cursor: not-allowed" />
                                <label for="email">Email</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input class="form-control" type="text" id="puesto" placeholder="" readonly
                                    style="cursor: not-allowed" />
                                <label for="email">Puesto</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input class="form-control" type="text" id="area" placeholder="" readonly
                                    style="cursor: not-allowed" />
                                <label for="email">Área</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <select class="form-control" id="asistencia" name="asistencia" placeholder="">
                                    <option value="Si" default>Sí</option>
                                    <option value="No">No</option>
                                    <option value="Ausencia Justificada">Ausencia Justificada</option>
                                </select>
                                <label for="asistencia">Asistencia</label>
                            </div>
                            <div class="col-12">
                                <button id="btn-suscribir-participante" type="submit" class="mr-3 btn btn-link"
                                    style="float: left; position: relative;">
                                    Agregar Participante
                                </button>
                            </div>
                            <div class="mt-3 col-12 datatable-rds">
                                <table class="table w-100" id="tbl-participantes">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Puesto</th>
                                            {{-- <th scope="col">Área</th> --}}
                                            <th>Correo</th>
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
                                <input type="hidden" name="participantes" value="" id="participantes">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row" x-show="externo">
                            <p class="font-weight-bold col-12" style="font-size:11pt;">Participantes externos.</p>
                            <hr>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input class="form-control" type="text" id="nombreEXT" maxlength="255" placeholder="" />
                                <label for="nombreEXT">Nombre</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input class="form-control" type="text" id="emailEXT" maxlength="255" placeholder="" />
                                <label for="emailEXT">Email</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input class="form-control" type="text" id="puestoEXT" maxlength="255" placeholder="" />
                                <label for="puestoEXT">Puesto</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <input class="form-control" type="text" id="empresaEXT" maxlength="255" placeholder="" />
                                <label for="empresaEXT">Empresa u
                                    Organización</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <select class="form-control" id="asistenciaEXT" name="asistenciaEXT" placeholder="">
                                    <option value="Si" default>Sí</option>
                                    <option value="No">No</option>
                                    <option value="Ausencia Justificada">Ausencia Justificada</option>
                                </select>
                                <label for="asistenciaEXT">Asistencia</label>
                            </div>
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-12">
                                <button id="btn-suscribir-participanteEXT" onclick="event.preventDefault();"
                                    class="mr-3 btn btn-link" style="float: left; position: relative;">
                                    Agregar Participante
                                </button>
                            </div>
                            <div class="mt-3 col-12 w-100 datatable-rds">
                                <table class="table w-100" id="tbl-participantesEXT">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Puesto</th>
                                            <th>Empresa u Organización</th>
                                            <th></th>
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
                                <input type="hidden" name="participantesExt" value="" id="participantesExt">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="mt-3 col-sm-12 form-group anima-focus">
                    <label for="evidencia">Documento</label>
                    <div class="custom-file">
                        <input type="file" name="files[]" multiple class="form-control" id="evidencia">
                    </div>
                </div> --}}
        <div class="card card-body">
            <div class="card-header">
                <h5>Temas Tratados<span class="text-danger">*</span></h5>
            </div>
            <div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12 mt-4">
                    <textarea required class="form-control date" type="text" name="tema_tratado" id="temas">{{ old('tema_tratado', $minutasaltadireccion->tema_tratado) }}</textarea>
                    @if ($errors->has('tema_tratado'))
                        <span class="text-danger">
                            {{ $errors->first('tema_tratado') }}
                        </span>
                    @endif
                </div>

                @livewire('file-revision-direecion-component', ['minutas' => $minutasaltadireccion])
            </div>
        </div>

        {{-- MODULO AGREGAR PLAN DE Trabajo --}}


        @include('admin.workPlan.actividades.tabla', [
            'empleados' => $responsablereunions,
            'actividades' => $actividades,
        ])



        {{-- FIN MODULO AGREGAR PLAN DE Trabajo --}}

        <div class="text-right form-group col-12">
            <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn_cancelar"
                style="text-decoration: none;">Cancelar</a>
            <button class="btn btn-danger" id="btnGuardar" type="submit" style="width: 13%;">
                Actualizar
            </button>
            <button class="btn btn-danger" id="btnUpdateAndReview" type="submit" style="width: 25%;">
                Actualizar y enviar a revisión
            </button>
        </div>
    </form>
@endsection

@section('scripts')
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
            toastr.success('Plan de Trabajo creado con éxito');
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
            $("#cargando_participantes").hide();
            let currentSearchRequest = 0; // Add a variable to track the current search request

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let url = "{{ route('admin.empleados.get') }}";

            $("#participantes_search").keyup(function() {
                let searchValue = $(this).val().trim();
                let currentRequestNumber = ++currentSearchRequest; // Increment the request number

                if (searchValue === "") {
                    // Clear or hide suggestions when the search input is empty
                    $("#participantes_sugeridos").hide();
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: 'nombre=' + searchValue,
                    beforeSend: function() {
                        $("#cargando_participantes").show();
                    },
                    success: function(data) {
                        // Check if the response corresponds to the latest search query
                        if (currentRequestNumber === currentSearchRequest) {
                            let lista = "<ul class='list-group id=empleados-lista'>";
                            $.each(data.usuarios, function(ind, usuario) {
                                var result = `{"id":"${usuario.id}",
                        "name":"${usuario.name}",
                        "email":"${usuario.email}",
                        "puesto":"${usuario.puesto}",
                        "area":"${usuario.area}"
                    }`;
                                lista +=
                                    "<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action' onClick='seleccionarUsuario(" +
                                    result + ")' >" +
                                    usuario.name + "</button>";
                            });
                            lista += "</ul>";

                            $("#cargando_participantes").hide();
                            $("#participantes_sugeridos").show();
                            let sugeridos = document.querySelector("#participantes_sugeridos");
                            sugeridos.innerHTML = lista;
                            $("#participantes_search").css("background", "#FFF");
                        }
                    }
                });
            });

            document.getElementById('btn-suscribir-participante').addEventListener('click', function(e) {
                e.preventDefault();
                suscribirParticipante()
            })

            document.getElementById('btn-suscribir-participanteEXT').addEventListener('click', function(e) {
                e.preventDefault();
                suscribirParticipanteExterno()
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

        function seleccionarUsuario(user) {
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#email").val(user.email);
            $("#puesto").val(user.puesto);
            $("#area").val(user.area);
            $("#participantes_sugeridos").hide();
        }


        function suscribirParticipante() {
            //form-participantes

            let participantes = tblParticipantes.rows().data().toArray();
            // console.log(tblParticipantes.rows().data().toArray());
            let arrParticipantes = [];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])
            });
            let id_empleado = $("#id_empleado").val();
            let asistencia_if = $("#asistencia").val();
            if (id_empleado == '' || asistencia_if == null) {
                Swal.fire('Debes de buscar un empleado y registrar su asistencia', '', 'info')
            } else {
                if (!arrParticipantes.includes(id_empleado)) {
                    let nombre = $("#participantes_search").val();
                    let puesto = $("#puesto").val();
                    let email = $("#email").val();
                    let area = $("#area").val();
                    let asistencia = $("#asistencia").val();
                    tblParticipantes.row.add([
                        id_empleado,
                        nombre,
                        puesto,
                        email,
                        asistencia,
                        area,
                    ]).draw();

                } else {
                    Swal.fire('Este participante ya ha sido agregado', '', 'error')
                }

                $("#participantes_search").val('');
                $("#id_empleado").val('');
                $("#email").val('');
                $("#puesto").val('');
                $("#asistencia").val('');
                $("#area").val('');
            }
        }

        function enviarParticipantes() {
            let participantes = tblParticipantes.rows().data().toArray();
            let arrParticipantes = [];

            participantes.forEach(participante => {
                let datos = {
                    'empleado_id': participante[0],
                    'asistencia': participante[4],
                };
                arrParticipantes.push(datos);
            });

            document.getElementById('participantes').value = JSON.stringify(arrParticipantes);
        }

        function suscribirParticipanteExterno() {
            //form-participantes
            let email = $("#emailEXT").val();
            let nombre = $("#nombreEXT").val();
            let asistencia_if = $("#asistenciaEXT").val();
            if (email != '' && nombre != '' && asistencia_if != null) {

                let participantes = tblParticipantesEXT.rows().data().toArray();
                // console.log(tblParticipantes.rows().data().toArray());
                let arrParticipantes = [];
                participantes.forEach(participante => {
                    console.log(participante);
                    arrParticipantes.push(participante[1])
                });
                if (!arrParticipantes.includes(email)) {
                    let puesto = $("#puestoEXT").val();
                    let empresa = $("#empresaEXT").val();
                    let asistencia = $("#asistenciaEXT").val();

                    tblParticipantesEXT.row.add([
                        nombre,
                        email,
                        puesto,
                        empresa,
                        asistencia,
                    ]).draw();

                } else {
                    Swal.fire('Este participante ya ha sido agregado', '', 'error')
                }

                $("#participantes_search").val('');
                $("#nombreEXT").val('');
                $("#puestoEXT").val('');
                $("#emailEXT").val('');
                $("#empresaEXT").val('');
                $("#asistenciaEXT").val('');
            } else {
                Swal.fire('Debes de llenar los campos nombre, email y asistencia', '', 'info')
            }

        }

        function enviarParticipantesExternos() {
            let participantes = tblParticipantesEXT.rows().data().toArray();
            let arrParticipantes = [];
            participantes.forEach(participante => {
                let objParticipantes = {
                    nombre: participante[0],
                    email: participante[1],
                    puesto: participante[2],
                    empresa: participante[3],
                    asistencia: participante[4],
                }
                arrParticipantes.push(objParticipantes)
            });
            console.log(arrParticipantes);
            document.getElementById('participantesExt').value = JSON.stringify(arrParticipantes);
        }
    </script>

    {{-- <script type="text/javascript">
        Livewire.on('planStore', () => {
            $('#planAccionModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Plan de Trabajo creado con éxito');
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
            $("#cargando_participantes").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = "{{ route('admin.empleados.get') }}";
            $("#participantes_search").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: 'nombre=' + $(this).val(),
                    beforeSend: function() {
                        $("#cargando_participantes").show();
                    },
                    success: function(data) {
                        $("#cargando_participantes").hide();
                        $("#participantes_sugeridos").show();
                        let sugeridos = document.querySelector(
                            "#participantes_sugeridos");
                        sugeridos.innerHTML = data;

                        $("#participantes_search").css("background", "#FFF");
                    }
                });

            });

            document.getElementById('btn-suscribir-participante').addEventListener('click', function(e) {
                e.preventDefault();
                suscribirParticipante()
            })

            document.getElementById('btnGuardar').addEventListener('click', function(e) {
                // e.preventDefault();
                enviarParticipantes();
                enviarActividades();
            })

        });

        function seleccionarUsuario(user) {
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#email").val(user.email);
            $("#puesto").val(user.puesto);
            $("#area").val(user.area);
            $("#participantes_sugeridos").hide();
        }


        function suscribirParticipante() {
            //form-participantes

            let participantes = tblParticipantes.rows().data().toArray();
            let arrParticipantes = [];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])
            });
            let id_empleado = $("#id_empleado").val();
            if (id_empleado == '') {
                Swal.fire('Debes de buscar un empleado', '', 'info')
            } else {
                if (!arrParticipantes.includes(id_empleado)) {
                    let nombre = $("#participantes_search").val();
                    let puesto = $("#puesto").val();
                    let email = $("#email").val();
                    tblParticipantes.row.add([
                        id_empleado,
                        nombre,
                        puesto,
                        email,
                    ]).draw();

                } else {
                    Swal.fire('Este participante ya ha sido agregado', '', 'error')
                }

                $("#participantes_search").val('');
                $("#id_empleado").val('');
                $("#email").val('');
                $("#puesto").val('');
                $("#area").val('');
            }
        }

        function enviarParticipantes() {
            let participantes = tblParticipantes.rows().data().toArray();
            let arrParticipantes = [];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])

            });
            document.getElementById('participantes').value = arrParticipantes;
            console.log(arrParticipantes);
        }
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {
                window.tblActividades = $('#tblActividades').DataTable({
                    buttons: []
                });
            });
            $('.responsables_actividad').select2({
                theme: 'bootstrap4',
            });
            document.getElementById('btnAgregar').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                agregarActividad();
            })

            // document.getElementById('btnVincularNombre').addEventListener('click', function(e) {
            //     e.preventDefault();
            //     let elementNombre = document.querySelector('[data-vincular-nombre="true"]').value;
            //     if (elementNombre != "") {
            //         if (document.getElementById('actividad').value == "") {
            //             document.getElementById('actividad').value = elementNombre;
            //         } else {
            //             if (elementNombre == document.getElementById('actividad').value) {
            //                 Swal.fire('El nombre ya ha sido vinculado', '', 'info');
            //             } else {
            //                 Swal.fire({
            //                     title: 'Atención',
            //                     text: "El campo de actividad actualmente contiene texto, ¿Desea sobreescribirlo?",
            //                     icon: 'warning',
            //                     showCancelButton: true,
            //                     confirmButtonColor: '#3085d6',
            //                     cancelButtonColor: '#d33',
            //                     confirmButtonText: 'Si',
            //                     cancelButtonText: 'No',
            //                 }).then((result) => {
            //                     if (result.isConfirmed) {
            //                         document.getElementById('actividad').value = elementNombre;
            //                     }
            //                 })
            //             }
            //         }
            //     } else {
            //         Swal.fire('No se ha descrito el nombre, no se puede vincular', '', 'info');
            //     }
            // })
        });

        function limpiarErrores() {
            document.querySelectorAll('.errores').forEach(element => {
                element.innerHTML = "";
            });
        }

        function limpiarCampos() {
            document.getElementById('actividad').value = '';
            document.getElementById('inicio').value = '';
            document.getElementById('finalizacion').value = '';
            document.getElementById('comentarios').value = '';
            $('.responsables_actividad').val(null).trigger('change');
        }

        function limpiarCampoPorId(id) {
            document.getElementById(id).value = '';
        }

        function agregarActividad() {
            let actividad = document.getElementById('actividad').value;
            let inicio = document.getElementById('inicio').value;
            let finalizacion = document.getElementById('finalizacion').value;
            let selectedValues = $('.responsables_actividad').select2('data');
            let comentarios = document.getElementById('comentarios').value;
            // let progreso = document.getElementById('progreso').value;
            let esFechaAnterior = Math.round((new Date(finalizacion).getTime() - new Date(inicio).getTime()) / (1000 *
                60 * 60 * 24)) < 0;
            if (actividad == '') {
                document.querySelector('.error_actividad').innerHTML = "El nombre de la actividad es requerido";
                limpiarCampoPorId('actividad');
            }
            if (inicio == '') {
                document.querySelector('.error_inicio').innerHTML = "El inicio de la actividad es requerido";
                limpiarCampoPorId('inicio');
            }
            if (finalizacion == '') {
                document.querySelector('.error_finalizacion').innerHTML = "La finalización de la actividad es requerido";
                limpiarCampoPorId('finalizacion');
            } else if (esFechaAnterior) {
                document.querySelector('.error_finalizacion').innerHTML =
                    "La finalización de la actividad no puede ser días antes del día de inicio";
                limpiarCampoPorId('finalizacion');
            }
            if (selectedValues.length === 0) {
                document.querySelector('.error_participantes').innerHTML =
                    "La actividad debe de tener al menos un participante";
                limpiarCampoPorId('responsables_actividad');
            }

            if (comentarios == '') {
                document.querySelector('.error_comentarios').innerHTML =
                    "El los comentarios de la actividad son requeridos";
                limpiarCampoPorId('comentarios');
            }
            // if (progreso == '' || progreso < 0 || progreso > 100) {
            //     document.querySelector('.error_progreso').innerHTML =
            //         "El progreso de la actividad es requerido y debe estár en un rango de 0-100";
            //     limpiarCampoPorId('progreso');
            // }
            // && progreso != '' && progreso >= 0 && progreso <= 100 // Validaciones de progreso
            if (actividad != '' && inicio != '' && finalizacion != '' && !esFechaAnterior && comentarios != '' &&
                selectedValues.length > 0) {
                limpiarCampos();

                let actividades = tblActividades.rows().data().toArray();
                let arrActividades = [];
                actividades.forEach(actividad => {
                    arrActividades.push(actividad[1]);
                });
                let name = actividad;
                // let start = new Date(inicio).getTime();
                // let end = new Date(finalizacion).getTime();
                let start = inicio;
                let end = finalizacion;
                let id = `tmp_${new Date().getTime()}_1`;
                let resta = new Date(end).getTime() - new Date(start).getTime();
                let duration = Math.round(resta / (1000 * 60 * 60 * 24));
                let images = "";
                let participantes_id = [];
                selectedValues.forEach(selected => {
                    console.log(selected);
                    images += `
                        <img class="rounded-circle" title="${selected.text.trim()}" src="{{ asset('storage/empleados/imagenes') }}/${selected.element.attributes.avatar.nodeValue}" id="res_${selected.id}" style="clip-path: circle(15px at 50% 50%);width: 45px;"/>
                    `;
                    participantes_id.push(selected.id);
                });

                // let progress = progreso;

                if (!arrActividades.includes(actividad)) {
                    tblActividades.row.add([
                        // id,
                        // 'STATUS_ACTIVE',
                        name,
                        start,
                        end,
                        // duration,
                        images,
                        // participantes_id,
                        comentarios,
                        // `<button class="btn btn-sm text-danger" title="Eliminar actividad" onclick="event.preventDefault(); EliminarFila(this)"></button>`,
                    ]).draw();

                    let additionalData = {
                        id: id,
                        status: 'STATUS_ACTIVE',
                        duration: duration,
                        participantes_id: participantes_id,
                        // button: `<button class="btn btn-sm text-danger" title="Eliminar actividad" onclick="event.preventDefault(); EliminarFila(this)"></button>`,
                    };
                    tblActividades.rows().data()[tblActividades.rows().length - 1].push(additionalData);
                } else {
                    Swal.fire('Esta actividad ya ha sido agregada', '', 'info');
                    limpiarCampos();
                }
            }
        }
        window.EliminarFila = function(element) {
            tblActividades
                .row($(element).parents('tr'))
                .remove()
                .draw();
        }
        // window.enviarActividades = function() {
        //     let actividades = tblActividades.rows().data().toArray();
        //     document.getElementById('actividades').value = JSON.stringify(actividades);
        // }
        window.enviarActividades = function() {
            let actividades = tblActividades.rows().data().toArray();

            // Filter out null or empty string values from each row
            let filteredActividades = actividades.map(row =>
                row.filter(value => value !== null && value !== '')
            );

            document.getElementById('actividades').value = JSON.stringify(filteredActividades);
        }
    </script> --}}
@endsection
