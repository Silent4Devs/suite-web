@extends('layouts.admin')
@section('content')
    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }
    </style>
    @include('admin.listadistribucion.estilos')
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

    <form method="POST" action="{{ route('admin.minutasaltadireccions.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card card-body">
            <div class="card-header">
                <h5>Minuta Revisión por Dirección</h5>
            </div>
            <div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group anima-focus">
                            <select required class="form-control" name="responsable_id" id="responsable_id">
                                <option value="">Seleccione una opción</option>
                                @foreach ($responsablereunions as $responsablereunion)
                                    <option value="{{ $responsablereunion->id }}"
                                        {{ old('responsable_id') == $responsablereunion->id ? 'selected' : '' }}>
                                        {{ $responsablereunion->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('responsable_id'))
                                <span class="text-danger">
                                    {{ $errors->first('responsable_id') }}
                                </span>
                            @endif
                            <label for="responsable_id">Elaboro:</label>
                            <span
                                class="help-block">{{ trans('cruds.minutasaltadireccion.fields.responsablereunion_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group anima-focus">
                            <input required class="form-control date" type="date" min="1945-01-01" name="fechareunion"
                                id="fechareunion" value="{{ old('fechareunion') }}">
                            @if ($errors->has('fechareunion'))
                                <span class="text-danger">
                                    {{ $errors->first('fechareunion') }}
                                </span>
                            @endif
                            <label for="fechareunion">{{ trans('cruds.minutasaltadireccion.fields.fechareunion') }}<span
                                    class="text-danger">*</span></label>
                            <span
                                class="help-block">{{ trans('cruds.minutasaltadireccion.fields.fechareunion_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group anima-focus">
                            <input required class="form-control date" type="time" name="hora_inicio" id="hora_inicio"
                                value="{{ old('hora_inicio') }}">
                            <label for="hora_inicio">Horario de inicio<span class="text-danger">*</span></label>
                            @if ($errors->has('hora_inicio'))
                                <span class="text-danger">
                                    {{ $errors->first('hora_inicio') }}
                                </span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.minutasaltadireccion.fields.fechareunion_helper') }}</span>
                        </div>
                    </div>

                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group anima-focus">
                            <input required class="form-control date" type="time" name="hora_termino" id="hora_termino"
                                value="{{ old('hora_termino') }}">
                            <label for="hora_termino">Horario de
                                término<span class="text-danger">*</span></label>
                            @if ($errors->has('hora_termino'))
                                <span class="text-danger">
                                    {{ $errors->first('hora_termino') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group anima-focus">
                            <select required class="form-control" name="tipo_reunion" id="tipo_reunion"
                                value="{{ old('tipo_reunion') }}">
                                <option value="presencial">Presencial</option>
                                <option value="remota">Remota</option>
                                <option value="hibrida">Hibrida</option>
                            </select>
                            <label class="required" for="tipo_reunion">Tipo de reunión<span
                                    class="text-danger">*</span></label>
                            @if ($errors->has('tipo_reunion'))
                                <span class="text-danger">
                                    {{ $errors->first('tipo_reunion') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group anima-focus">
                            <input required data-vincular-nombre='true' class="form-control date" type="text"
                                name="tema_reunion" id="tema_reunion" value="{{ old('tema_reunion') }}" placeholder=""
                                maxlength="255">
                            <label for="tema_reunion">Tema de la reunión<span class="text-danger">*</span></label>
                            @if ($errors->has('tema_reunion'))
                                <span class="text-danger">
                                    {{ $errors->first('tema_reunion') }}
                                </span>
                            @endif
                            <span id="alertaGenerica" style="color: red; display: none;"></span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group anima-focus">
                            <textarea required class="form-control" name="objetivoreunion" id="objetivoreunion" placeholder="" style="height: 150px !important">{{ old('objetivoreunion') }}</textarea>
                            <label
                                for="objetivoreunion">{{ trans('cruds.minutasaltadireccion.fields.objetivoreunion') }}<span
                                    class="text-danger">*</span></label>
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
        </div>

        <div class="card card-body">
            <div class="card-header">
                <h5>Participantes</h5>
            </div>
            <div>
                <div class="pl-3 row w-100" x-data="muestra()">
                    {{-- <div class="col-12"> --}}
                    <small> <strong>NOTA: </strong>Para agregar participantes
                        externos de click en el botón que tiene el siguiente icono</small>
                    <div class="row">
                        <div class="col-12" style="text-align: end">

                            <i class="fas fa-user-tag" x-bind:class="externo ? 'bg-primary p-2 rounded text-white' : ''"
                                style="color:black" @click.prevent="externo = !externo" title="Agregar externo"></i>
                        </div>
                    </div>
                    <div class="row" x-show="interno">
                        <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6 mt-3">
                            {{-- <div class="form-group anima-focus"> --}}
                            <input type="hidden" id="id_empleado">
                            <input class="form-control" type="text" id="participantes_search" placeholder=""
                                style="position: relative" autocomplete="off" />
                            <label for="participantes">Buscar
                                participante<span class="text-danger">*</span></label>
                            <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                                style="position: absolute; top: 15px; right: 25px;"></i>
                            <div id="participantes_sugeridos"></div>
                            @if ($errors->has('participantes'))
                                <span class="text-danger">
                                    {{ $errors->first('participantes') }}
                                </span>
                            @endif
                            <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
                            {{-- </div> --}}
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group anima-focus">
                                <input class="form-control" type="text" id="email"
                                    placeholder="Correo del participante" readonly style="cursor: not-allowed" />
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group anima-focus">
                                <input class="form-control" type="text" id="puesto"
                                    placeholder="Puesto del participante" readonly style="cursor: not-allowed" />
                                <label for="puesto">Puesto</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group anima-focus">
                                <input class="form-control" type="text" id="area"
                                    placeholder="Área del participante" readonly style="cursor: not-allowed" />
                                <label for="area">Área</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
                                <select class="form-control" id="asistencia" name="asistencia" placeholder="">
                                    <option value="Si" default>Sí</option>
                                    <option value="No">No</option>
                                    <option value="Ausencia Justificada">Ausencia Justificada</option>
                                </select>
                                <label for="asistencia">Asistencia</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <button id="btn-suscribir-participante" type="submit" class="mr-3 btn btn-link"
                                style="float: left; position: relative;">
                                Agregar Participante
                            </button>
                        </div>
                        <div class="mt-3 col-12 w-100 datatable-rds">
                            <table class=" w-100" id="tbl-participantes">
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
                                <tbody></tbody>
                            </table>
                        </div>
                        <input type="hidden" name="participantes" value="" id="participantes">
                    </div>
                    <div class="row" x-show="externo">
                        <p class="font-weight-bold col-12" style="font-size:11pt;">Participantes externos.</p>
                        <hr>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <label for="nombreEXT">Nombre</label>
                            <input class="form-control" type="text" id="nombreEXT"
                                placeholder="Nombre del participante" />
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <label for="emailEXT">Email</label>
                            <input class="form-control" type="text" id="emailEXT"
                                placeholder="Correo del participante" />
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <label for="puestoEXT">Puesto</label>
                            <input class="form-control" type="text" id="puestoEXT"
                                placeholder="Puesto del participante" />
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <label for="empresaEXT">Empresa u
                                Organización</label>
                            <input class="form-control" type="text" id="empresaEXT"
                                placeholder="Empresa u Organización del participante" />
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-6">
                            <label for="asistenciaEXT">Asistencia</label>
                            <select class="form-control" id="asistenciaEXT" name="asistenciaEXT" placeholder="">
                                <option value="Si" default>Sí</option>
                                <option value="No">No</option>
                                <option value="Ausencia Justificada">Ausencia Justificada</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <button id="btn-suscribir-participanteEXT" onclick="event.preventDefault();"
                                class="mr-3 btn btn-link" style="float: left; position: relative;">
                                Agregar Participante
                            </button>
                        </div>
                        <div class="mt-3 col-12 w-100 datatable-rds">
                            <table class=" w-100" id="tbl-participantesEXT">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Puesto</th>
                                        <th>Empresa u Organización</th>
                                        <th>Asistencia</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <input type="hidden" name="participantesExt" value="" id="participantesExt">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- </div> --}}

        <div class="card card-body">
            <div class="card-header">
                <h5>Temas Tratados<span class="text-danger">*</span></h5>
            </div>
            <div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12 mt-4">
                    <textarea required class="form-control date" type="text" name="tema_tratado" id="temas">
                                        {{ old('tema_tratado') }}
                                    </textarea>
                    @if ($errors->has('tema_tratado'))
                        <span class="text-danger">
                            {{ $errors->first('tema_tratado') }}
                        </span>
                    @endif
                </div>
                <div class="mb-4 col-sm-12 form-group">
                    <label for="evidencia">Documento</label>
                    <div class="custom-file">
                        <input type="file" name="files[]" multiple class="form-control" id="files"
                            accept="image/*,.pdf">
                    </div>
                </div>
            </div>
        </div>
        {{-- <form></form>


                <form action="{{ route('admin.minutasaltadireccions.store') }}" method="POST" class="dropzone"
                    id="my-awesome-dropzone">
                </form> --}}


        {{-- MODULO AGREGAR PLAN DE ACCIÓN --}}
        @include('admin.planesDeAccion.actividades.tabla', [
            'empleados' => $responsablereunions,
        ])
        {{-- FIN MODULO AGREGAR PLAN DE ACCIÓN --}}


        <div class="text-right form-group col-12">
            <a href="{{ route('admin.minutasaltadireccions.index') }}" class="btn_cancelar"
                style="text-decoration: none;">Cancelar</a>
            <button id="btnGuardar" class="btn btn-primary" type="submit" style="width: 13%;">
                {{ trans('global.save') }}
            </button>
        </div>
    </form>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="alertaVinculacion" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="alertaVinculacionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertaVinculacionLabel">Alerta de Vinculación</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>
                <div class="modal-body">
                    El usuario no esta vinculado a un empleado

                </div>
                <div class="modal-footer">
                    <a type="button" href="{{ route('admin.users.index') }}" class="btn btn-primary">Vincular</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
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
                ]
            });

        });
    </script>

<script>
    var alerta = document.getElementById('alertaGenerica');
    var inputs = document.querySelectorAll('input[type="text"]');
    alerta.textContent = '¡Estas a punto de llegar a los 255 caracteres!'
    // Agregar un event listener a cada elemento input
    inputs.forEach(function(input) {
        input.addEventListener('input', function() {
            // Acciones a realizar cuando se ingresa texto en un input
            if (input.value.length > 250) {
                alerta.style.display = 'block';
            } else {
                alerta.style.display = 'none';
            }
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
            if (!@json($esta_vinculado)) {
                $('#alertaVinculacion').modal('show')
            }
            window.tblParticipantes = $('#tbl-participantes').DataTable({
                buttons: []
            })
            window.tblParticipantesEXT = $('#tbl-participantesEXT').DataTable({
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
                        if ($("#participantes_search").val().trim() !== "") {
                            let lista = "<ul class='list-group id=empleados-lista' >";
                            $.each(data.usuarios, function(ind, usuario) {
                                var result = `{"id":"${usuario.id}",
                                "name":"${usuario.name}",
                                "email":"${usuario.email}",
                                "puesto":"${usuario.puesto}",
                                "area":"${usuario.area.area}"
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


        function muestra() {

            return {
                interno: true,
                externo: false,
            }
        }
    </script>
@endsection
