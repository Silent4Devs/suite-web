@extends('layouts.admin')
@section('content')
    <style type="text/css">
        sup {
            color: red;
        }
    </style>
    {{ Breadcrumbs::render('admin.planificacion-controls.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Planificación y Control</h5>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.planificacion-controls.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf

                <div class="form-group col-md-6">
                    <label><i class="fas fa-ticket-alt iconos-crear"></i>ID del cambio<sup>*</sup></label>
                    <input required class="form-control {{ $errors->has('folio_cambio') ? 'is-invalid' : '' }}" type="number" min="0"
                        name="folio_cambio" id="folio_cambio" value="{{ old('folio_cambio', '') }}">
                    @if ($errors->has('folio_cambio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('folio_cambio') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planificacionControl.fields.vulnerabilidad_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de registro del cambio<sup>*</sup></label>
                    <input required class="form-control {{ $errors->has('fecha_registro') ? 'is-invalid' : '' }}" type="date" min="1945-01-01"
                        name="fecha_registro" id="fecha_registro" value="{{ old('fecha_registro', '') }}">
                    @if ($errors->has('fecha_registro'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_registro') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planificacionControl.fields.vulnerabilidad_helper') }}</span>
                </div>
                <div class="form-group col-4">
                    <label for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Reporto el cambio<sup>*</sup></label>
                    <select required class="form-control {{ $errors->has('reviso') ? 'is-invalid' : '' }}" name="id_reviso"
                        id="id_reporta">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($empleados as $empleado)
                            <option {{ old('id_reviso') == $empleado->id ? ' selected="selected"' : '' }}
                                data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}">
                                {{ Str::limit($empleado->name, 30, '...') }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_reviso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_reviso') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="id_puesto" readonly></div>

                </div>
                <div class="form-group col-md-4">
                    <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="id_area" readonly></div>
                </div>
                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Información general del cambio administrativo</span>
                </div>

                <div class="form-group col-md-4">
                    <label><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de inicio<sup>*</sup></label>
                    <input required class="form-control {{ $errors->has('fecha_registro') ? 'is-invalid' : '' }}" type="date" min="1945-01-01"
                        name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', '') }}">
                    @if ($errors->has('fecha_inicio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planificacionControl.fields.vulnerabilidad_helper') }}</span>
                </div>

                <div class="form-group col-md-4">
                    <label class="required"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de terminación</label>
                    <input required class="form-control {{ $errors->has('fecha_termino') ? 'is-invalid' : '' }}" type="date" min="1945-01-01"
                        name="fecha_termino" id="fecha_termino" value="{{ old('fecha_termino', '') }}">
                    @if ($errors->has('fecha_termino'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_termino') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planificacionControl.fields.vulnerabilidad_helper') }}</span>
                </div>

                <div class="form-group col-md-4">
                    <label><i class="fas fa-calendar-alt iconos-crear"></i>Origen del cambio<sup>*</sup></label>
                    <div style="float: right;">
                        <button id="btnAgregarTipo" onclick="event.preventDefault();" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;" data-toggle="modal" data-target="#origenCambioModal"
                            data-whatever="@mdo" data-whatever="@mdo" title="Agregar Origen del cambio"><i
                                class="fas fa-plus"></i></button>
                    </div>
                    @livewire('origen-cambio-component')

                    @livewire('origen-select-component', ['origen_seleccionado' => $origen_seleccionado])
                </div>

                <div class="form-group col-12">
                    <label for="objetivo"><i class="fas fa-align-left iconos-crear"></i>Objetivo del cambio<sup>*</sup></label>
                    <textarea required class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}"
                        name="objetivo" id="objetivo">{{ old('objetivo') }}</textarea>
                    @if ($errors->has('objetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planificacionControl.fields.descripcion_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label><i class="fas fa-user-tie iconos-crear"></i>Responsable de la implementación<sup>*</sup></label>
                    <select required class="form-control {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="id_responsable" id="id_responsable">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($responsables as $responsable)
                            <option {{ old('id_responsable') == $responsable->id ? ' selected="selected"' : '' }}
                                data-puesto="{{ $responsable->puesto }}" value="{{ $responsable->id }}"
                                data-area="{{ $responsable->area->area }}">
                                {{ Str::limit($responsable->name, 30, '...') }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_responsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_responsable') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="id_responsable_puesto" readonly></div>

                </div>
                <div class="form-group col-md-4">
                    <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="id_responsable_area" readonly></div>
                </div>

                <div class="form-group col-4">
                    <label><i class="fas fa-user-tie iconos-crear"></i>Responsable de aprobar<sup>*</sup></label>
                    <select required class="form-control {{ $errors->has('responsable_aprobar') ? 'is-invalid' : '' }}"
                        name="id_responsable_aprobar" id="id_responsable_aprobar">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($aprobadores as $aprobador)
                            <option {{ old('id_responsable_aprobar') == $aprobador->id ? ' selected="selected"' : '' }}
                                data-puesto="{{ $aprobador->puesto }}" value="{{ $aprobador->id }}"
                                data-area="{{ $aprobador->area->area }}">
                                {{ Str::limit($aprobador->name, 30, '...') }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_responsable_aprobar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_responsable_aprobar') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="id_responsable_aprobar_puesto" readonly></div>

                </div>
                <div class="form-group col-md-4">
                    <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="id_responsable_aprobar_area" readonly></div>
                </div>

                <div class="form-group col-12">
                    <label for="descripcion"><i class="fas fa-align-left iconos-crear"></i>Descripción detallada del
                        cambio</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planificacionControl.fields.descripcion_helper') }}</span>
                </div>

                <div class="form-group col-12">
                    <label><i class="fas fa-align-left iconos-crear"></i>Criterios de aceptación del cambio</label>
                    <textarea class="form-control {{ $errors->has('criterios_aceptacion') ? 'is-invalid' : '' }}"
                        name="criterios_aceptacion" id="criterios_aceptacion">{{ old('criterios_aceptacion') }}</textarea>
                    @if ($errors->has('criterios_aceptacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('criterios_aceptacion') }}
                        </div>
                    @endif
                </div>

                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Participantes de la implementación del cambio</span>
                </div>

                <div class="pl-3 row w-100" x-data="muestra()">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-12" style="text-align: end">
                                <i class="fas fa-users bg-primary p-2 rounded text-white"></i>
                            </div>
                        </div>
                        <div class="row" x-show="interno">
                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                                    participante<span class="text-danger">*</span></label>
                                <input type="hidden" id="id_empleado">
                                <input class="form-control" type="text" id="participantes_search"
                                    placeholder="Busca un empleado" style="position: relative" autocomplete="off" />
                                <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                                    style="position: absolute; top: 43px; right: 25px;"></i>
                                <div id="participantes_sugeridos"></div>
                                @if ($errors->has('participantes'))
                                    <span class="text-danger">
                                        {{ $errors->first('participantes') }}
                                    </span>
                                @endif
                                <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                <label for="email"><i class="fas fa-at iconos-crear"></i>Email</label>
                                <input class="form-control" type="text" id="email"
                                    placeholder="Correo del participante" readonly style="cursor: not-allowed" />
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                <label for="email"><i class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
                                <input class="form-control" type="text" id="puesto"
                                    placeholder="Puesto del participante" readonly style="cursor: not-allowed" />
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                <label for="area"><i class="fas fa-user-tag iconos-crear"></i></i>Área</label>
                                <input class="form-control" type="text" id="area"
                                    placeholder="Área del participante" readonly style="cursor: not-allowed" />
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <button id="btn-suscribir-participante" type="submit"
                                    class="mr-3 btn btn-sm btn-outline-success" style="float: right; position: relative;">
                                    <i class="mr-1 fas fa-plus-circle"></i>
                                    Agregar Participante
                                </button>
                            </div>
                            <div class="mt-3 col-12 w-100 datatable-fix">
                                <table class="table w-100" id="tbl-participantes">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Puesto</th>
                                            {{-- <th scope="col">Área</th> --}}
                                            <th>Correo</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <input type="hidden" name="participantes" value="" id="participantes">
                        </div>

                    </div>
                </div>

                <div class="form-group col-12 text-right">
                    <a href="{{ route('admin.planificacion-controls.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit" id="btnGuardar">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let reporta = document.querySelector('#id_reporta');
            let area_init = reporta.options[reporta.selectedIndex].getAttribute('data-area');
            let puesto_init = reporta.options[reporta.selectedIndex].getAttribute('data-puesto');
            document.getElementById('id_puesto').innerHTML = puesto_init;
            document.getElementById('id_area').innerHTML = area_init;

            reporta.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('id_puesto').innerHTML = recortarTexto(puesto)
                document.getElementById('id_area').innerHTML = recortarTexto(area)
            })



            let responsable = document.querySelector('#id_responsable');
            let area = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
            document.getElementById('id_responsable_puesto').innerHTML = recortarTexto(puesto)
            document.getElementById('id_responsable_area').innerHTML = recortarTexto(area)

            responsable.addEventListener('change', function(e) {
                e.preventDefault();

                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');

                document.getElementById('id_responsable_puesto').innerHTML = recortarTexto(puesto)
                document.getElementById('id_responsable_area').innerHTML = recortarTexto(area)
            })


            let aprobador = document.querySelector('#id_responsable_aprobar');
            let area_aprobador = responsable.options[aprobador.selectedIndex].getAttribute('data-area');
            let puesto_aprobador = aprobador.options[aprobador.selectedIndex].getAttribute('data-puesto');
            document.getElementById('id_responsable_aprobar_puesto').innerHTML = puesto_aprobador
            document.getElementById('id_responsable_aprobar_area').innerHTML = area_aprobador

            aprobador.addEventListener('change', function(e) {
                e.preventDefault();

                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');

                document.getElementById('id_responsable_aprobar_puesto').innerHTML = recortarTexto(puesto)
                document.getElementById('id_responsable_aprobar_area').innerHTML = recortarTexto(area)
            })


            function recortarTexto(texto, length = 34) {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }

        });
    </script>

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('descripcion', {
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

            CKEDITOR.replace('objetivo', {
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

            CKEDITOR.replace('criterios', {
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
        $(document).ready(function() {
            if (!@json($esta_vinculado)) {
                $('#alertaVinculacion').modal('show')
            }
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
                                result + ")' ><i class='mr-2 fas fa-user-circle'></i>" +
                                usuario.name + "</button>";
                        });
                        lista += "</ul>";

                        $("#cargando_participantes").hide();
                        $("#participantes_sugeridos").show();
                        let sugeridos = document.querySelector("#participantes_sugeridos");
                        sugeridos.innerHTML = lista;
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
            })

            document.getElementById('btnUpdateAndReview').addEventListener('click', function(e) {
                // e.preventDefault();
                enviarParticipantes();
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
            if (id_empleado == '') {
                Swal.fire('Debes de buscar un empleado', '', 'info')
            } else {
                if (!arrParticipantes.includes(id_empleado)) {
                    let nombre = $("#participantes_search").val();
                    let puesto = $("#puesto").val();
                    let email = $("#email").val();
                    let area = $("#area").val();
                    tblParticipantes.row.add([
                        id_empleado,
                        nombre,
                        puesto,
                        email,
                        area,
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
            // console.log(arrParticipantes);
        }


        function muestra() {

            return {
                interno: true,
                externo: false,
            }
        }
    </script>
@endsection
