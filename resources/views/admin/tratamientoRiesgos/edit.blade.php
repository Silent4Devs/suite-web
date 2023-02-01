@extends('layouts.admin')
@section('content')
<style type="text/css">
    sup {
        color: red;
    }
</style>
    {{ Breadcrumbs::render('admin.tratamiento-riesgos.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Tratamiento de los Riesgos</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" class="row" action="{{ route('admin.tratamiento-riesgos.update', [$tratamientos->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group col-md-4 mb-4">
                    <label for="validationServer01"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                    <input readonly disabled type="number"
                        value="{{ old('identificador', $tratamientos->identificador) }}" class="form-control"
                        name="identificador" id="identificador" required>
                    <div id="identificadorDisponible">
                    </div>
                </div>

                <div class="form-group col-12">
                    <label class="required"><i class="far fa-file-alt iconos-crear"></i>Descripción del Riesgo</label>
                    <textarea required class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}"
                        name="descripcionriesgo" id="descripcionriesgo">{{ old('descripcionriesgo', $tratamientos->descripcionriesgo) }}</textarea>
                    @if ($errors->has('descripcionriesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcionriesgo') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 col-sm-4">
                    <label for="tipo_riesgo"><i class="fas fa-asterisk iconos-crear"></i>Tipo de riesgo</label>
                    <select required class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}" name="tipo_riesgo"
                        id="tipo_riesgo" disabled readonly>
                        <option value disabled {{ old('tipo_riesgo', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('tipo_riesgo', $tratamientos->tipo_riesgo) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipo_riesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_riesgo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                </div>

                <div class="form-group col-md-4 mb-4">
                    <label><i class="fas fa-exclamation-circle iconos-crear"></i>Riesgo Total</label>
                    <input readonly disabled type="number" name="riesgototal" id="riesgoTotalResultado"
                        value="{{ old('riesgototal', $tratamientos->riesgototal) }}" class="form-control" data-riesgo-total="{{$tratamientos->riesgototal}}">

                </div>

                <div class="form-group col-md-4 mb-4">
                    <label><i class="fas fa-exclamation-circle iconos-crear"></i>Riesgo Residual</label>
                    <input readonly disabled type="number" id="riesgoTotalResidual" name="riesgo_total_residual" data-riesgo-residual="{{ $tratamientos->riesgo_total_residual }}"
                        value="{{ old('riesgo_total_residual', $tratamientos->riesgo_total_residual) }}"
                        class="form-control">
                </div>

                <div class="form-group col-12">
                    <label for="acciones"><i class="fas fa-clipboard-list iconos-crear"></i>Acciones de Tratamiento<sup>*</sup></label>
                    <textarea class="form-control {{ $errors->has('acciones') ? 'is-invalid' : '' }}"
                        name="acciones" id="acciones" required>{{ old('acciones', $tratamientos->acciones) }}</textarea>
                    @if ($errors->has('acciones'))
                        <div class="invalid-feedback">
                            {{ $errors->first('acciones') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-6 col-sm-4 col-lg-4">
                    <label for="id_dueno"><i class="fas fa-user-tie iconos-crear"></i>Dueño del riesgo<sup>*</sup></label>
                    <select class="form-control {{ $errors->has('id_dueno') ? 'is-invalid' : '' }}"
                        name="id_dueno" id="dueno" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('id_dueno', $tratamientos->id_dueno) == $empleado->id ? 'selected' : '' }}>
                                {{ Str::limit($empleado->name, 30, '...') }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_dueno'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_dueno') }}
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

                <div class="form-group col-md-6 col-sm-4 col-lg-4">
                    <label><i class="fas fa-user-tie iconos-crear"></i>Registró riesgo<sup>*</sup></label>
                    <select class="form-control {{ $errors->has('id_registro') ? 'is-invalid' : '' }}"
                        name="id_registro" id="registro" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($registros as $id => $registro)
                            <option data-puesto="{{ $registro->puesto }}" value="{{ $registro->id }}"
                                data-area="{{ $registro->area->area }}"
                                {{ old('id_registro', $tratamientos->id_registro) == $registro->id ? 'selected' : '' }}>
                                {{ Str::limit($registro->name , 30, '...') }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_registro'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_registro') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="id_registro_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="id_registro_puesto" readonly></div>

                </div>
                <div class="form-group col-md-4">
                    <label for="id_registro_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="id_registro_area" readonly></div>
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label class="required" for="id_proceso"><i class="fas fa-project-diagram iconos-crear"></i>Proceso</label><br>
                    <select required class="procesoSelect form-control" name="id_proceso" id="id_proceso">
                        <option value="">Seleccione una opción</option>
                        @foreach ($procesos as $proceso)
                            <option value="{{ $proceso->id }}"
                                {{ $tratamientos->id_proceso == $proceso->id ? 'selected' : '' }}>
                                {{ $proceso->codigo }} / {{ $proceso->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_proceso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_proceso') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-md-4 col-sm-12 col-lg-4">
                    <label for="fechacompromiso"><i class="far fa-calendar-alt iconos-crear"></i>Fecha compromiso<sup>*</sup></label>
                    <input required class="form-control {{ $errors->has('fechavigor') ? 'is-invalid' : '' }}" type="date" min="1945-01-01"
                        name="fechacompromiso" id="fechacompromiso"
                        value="{{ old('fechacompromiso', $tratamientos->fechacompromiso ? \Carbon\Carbon::parse($tratamientos->fechacompromiso)->format('Y-m-d') : null) }}">
                    @if ($errors->has('fechacompromiso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechacompromiso') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 col-sm-4">
                    <label class="required" for="inversion_requerida"><i class="fas fa-chart-line iconos-crear"></i>Inversión
                        requerida</label>
                    <select required class="form-control {{ $errors->has('inversion_requerida') ? 'is-invalid' : '' }}"
                        name="inversion_requerida" id="inversion_requerida">
                        <option value disabled {{ old('inversion_requerida', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\TratamientoRiesgo::TIPO_INVERSION_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('inversion_requerida', $tratamientos->inversion_requerida) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('inversion_requerida'))
                        <div class="invalid-feedback">
                            {{ $errors->first('inversion_requerida') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                </div>

                <div class="mb-3 mt-3 ml-4 w-100" style="border-bottom: solid 2px #345183;">
                    <span class="ml-1" style="font-size: 17px; font-weight: bold;">
                        Participantes en la atención del riesgo</span>
                </div>
                <div class="pl-3 row w-100">
                    <div class="col-12" style="text-align: end">
                        <i class="fas fa-users bg-primary p-2 rounded text-white"></i>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
                                    participante</label>
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
                                <label for="email"><i class="fas fa-at iconos-crear"></i>Puesto</label>
                                <input class="form-control" type="text" id="puesto"
                                    placeholder="Puesto del participante" readonly style="cursor: not-allowed" />
                            </div>
                            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                <label for="email"><i class="fas fa-at iconos-crear"></i>Área</label>
                                <input class="form-control" type="text" id="area"
                                    placeholder="Área del participante" readonly style="cursor: not-allowed" />
                            </div>

                            <div class="col-12">
                                <button id="btn-suscribir-participante" type="submit"
                                    class="mr-3 btn btn-sm btn-outline-success" style="float: right; position: relative;">
                                    <i class="mr-1 fas fa-plus-circle"></i>
                                    Agregar Participante
                                </button>
                            </div>
                            <div class="mt-3 col-12 datatable-fix">
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
                                    <tbody>
                                        @foreach ($tratamientos->participantes as $participante)
                                            <tr>
                                                <td>{{ $participante->id }}</td>
                                                <td>{{ $participante->name }}</td>
                                                <td>{{ $participante->puesto }}</td>
                                                <td>{{ $participante->email }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" name="participantes" value="" id="participantes">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.tratamiento-riesgos.index') }}" class="btn_cancelar">Cancelar</a>
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
            let riesgoTotalResultado = document.getElementById('riesgoTotalResultado');
            let riesgoTotal = riesgoTotalResultado.getAttribute('data-riesgo-total');

            if (riesgoTotal <= 185) {
                riesgoTotalResultado.style.background = "#FF417B";
                riesgoTotalResultado.style.color = "white";
            }
            if (riesgoTotal <= 135) {
                riesgoTotalResultado.style.background = "#FFAC6A";
                riesgoTotalResultado.style.color = "white";
            }
            if (riesgoTotal <= 90) {
                riesgoTotalResultado.style.background = "#FFCB63";
                riesgoTotalResultado.style.color = "black";
            }
            if (riesgoTotal <= 45) {
                riesgoTotalResultado.style.background = "#6DC866";
                riesgoTotalResultado.style.color = "white";
            }
            if (riesgoTotal == null) {
                riesgoTotalResultado.style.background = "#000";
                riesgoTotalResultado.style.color = "white";
            }

            let riesgoTotalResidual = document.getElementById('riesgoTotalResidual');
            let riesgoResidual = riesgoTotalResidual.getAttribute('data-riesgo-residual');

            if (riesgoResidual <= 185) {
                riesgoTotalResidual.style.background = "#FF417B";
                riesgoTotalResidual.style.color = "white";
            }
            if (riesgoResidual <= 135) {
                riesgoTotalResidual.style.background = "#FFAC6A";
                riesgoTotalResidual.style.color = "white";
            }
            if (riesgoResidual <= 90) {
                riesgoTotalResidual.style.background = "#FFCB63";
                riesgoTotalResidual.style.color = "black";
            }
            if (riesgoResidual <= 45) {
                riesgoTotalResidual.style.background = "#6DC866";
                riesgoTotalResidual.style.color = "white";
            }
            if (riesgoResidual == null) {
                riesgoTotalResidual.style.background = "#000";
                riesgoTotalResidual.style.color = "white";
            }
        })
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let dueno = document.querySelector('#dueno');
            let area_init = dueno.options[dueno.selectedIndex].getAttribute('data-area');
            let puesto_init = dueno.options[dueno.selectedIndex].getAttribute('data-puesto');
            document.getElementById('id_puesto').innerHTML = puesto_init;
            document.getElementById('id_area').innerHTML = area_init;

            dueno.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('id_puesto').innerHTML = recortarTexto(puesto)
                document.getElementById('id_area').innerHTML = recortarTexto(area)
            })

            let registro = document.querySelector('#registro');
            let area = registro.options[registro.selectedIndex].getAttribute('data-area');
            let puesto = registro.options[registro.selectedIndex].getAttribute('data-puesto');
            document.getElementById('id_registro_puesto').innerHTML = recortarTexto(puesto)
            document.getElementById('id_registro_area').innerHTML = recortarTexto(area)

            registro.addEventListener('change', function(e) {
                e.preventDefault();

                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');

                document.getElementById('id_registro_puesto').innerHTML = recortarTexto(puesto)
                document.getElementById('id_registro_area').innerHTML = recortarTexto(area)
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



        });

        function seleccionarUsuario(user) {
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#email").val(user.email);
            $("#puesto").val(user.puesto);
            $("#area").val(user.area.area);
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
    </script>
        <script>
            $(document).ready(function() {
                CKEDITOR.replace('descripcionriesgo', {
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


                CKEDITOR.replace('acciones', {
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
@endsection
