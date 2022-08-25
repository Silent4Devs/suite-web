@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.tratamiento-riesgos.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Tratamiento de los Riesgos</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" class="row" action="{{ route('admin.tratamiento-riesgos.update', [$tratamientos->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                {{-- <div class="form-group col-md-6">
                <label for="nivelriesgo"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="text" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', $tratamientos->nivelriesgo) }}">
                @if ($errors->has('nivelriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo_helper') }}</span>
            </div> --}}
                <div class="form-group col-md-4 mb-4">
                    <label for="validationServer01"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                    <input readonly disabled type="number" name="identificador"
                        value="{{ old('identificador', $tratamientos->identificador) }}" class="form-control"
                        name="identificador" id="identificador" required>
                    <div id="identificadorDisponible">
                    </div>
                </div>

                <div class="form-group col-12">
                    <label><i class="far fa-file-alt iconos-crear"></i>Descripción del Riesgo</label>
                    <textarea class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}" name="descripcionriesgo"
                        id="descripcionriesgo">{{ old('descripcionriesgo', $tratamientos->descripcionriesgo) }}</textarea>
                    @if ($errors->has('descripcionriesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcionriesgo') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 col-sm-4">
                    <label for="tipo_riesgo"><i class="fas fa-asterisk iconos-crear"></i>Tipo de riesgo</label>
                    <select class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}" name="tipo_riesgo"
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
                    <label for="acciones"><i class="fas fa-clipboard-list iconos-crear"></i>Acciones de Tratamiento</label>
                    <textarea class="form-control {{ $errors->has('acciones') ? 'is-invalid' : '' }}" name="acciones" id="acciones">{{ old('acciones', $tratamientos->acciones) }}</textarea>
                    @if ($errors->has('acciones'))
                        <div class="invalid-feedback">
                            {{ $errors->first('acciones') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-6 col-sm-4 col-lg-4">
                    <label for="id_dueno"><i class="fas fa-user-tie iconos-crear"></i>Dueño del riesgo</label>
                    <select class="form-control {{ $errors->has('id_dueno') ? 'is-invalid' : '' }}" name="id_dueno"
                        id="dueno">
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('id_dueno', $tratamientos->id_dueno) == $empleado->id ? 'selected' : '' }}>

                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('responsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable') }}
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

                <div class="form-group col-md-4 col-sm-12">
                    <label for="id_proceso"><i class="fas fa-project-diagram iconos-crear"></i>Proceso</label><br>
                    <select class="procesoSelect form-control" name="id_proceso" id="id_proceso">
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
                    <label for="fechacompromiso"><i class="far fa-calendar-alt iconos-crear"></i>Fecha compromiso</label>
                    <input class="form-control {{ $errors->has('fechavigor') ? 'is-invalid' : '' }}" type="date"
                        name="fechacompromiso" id="fechacompromiso"
                        value="{{ old('fechacompromiso', $tratamientos->fechacompromiso ? \Carbon\Carbon::parse($tratamientos->fechacompromiso)->format('Y-m-d') : null) }}">
                    @if ($errors->has('fechacompromiso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechacompromiso') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 col-sm-4">
                    <label for="inversion_requerida"><i class="fas fa-chart-line iconos-crear"></i>Inversión
                        requerida</label>
                    <select class="form-control {{ $errors->has('inversion_requerida') ? 'is-invalid' : '' }}"
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

                <div class="mb-4 ml-4 w-100" style="border-bottom: solid 2px #345183;">
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


                {{-- <div class="form-group col-md-6">
                <label for="control_id"><i class="fas fa-chart-area iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.control') }}</label>
                <select class="form-control select2 {{ $errors->has('control') ? 'is-invalid' : '' }}" name="control_id" id="control_id">
                    @foreach ($controls as $id => $control)
                        <option value="{{ $control->id }}"
                        {{ old('control_id', $tratamientos->control_id) == $control->id ? 'selected' : '' }}
                        >{{ $control->anexo_indice }} {{ $control->anexo_politica }}</option>
                    @endforeach
                </select>
                @if ($errors->has('control'))
                    <div class="invalid-feedback">
                        {{ $errors->first('control') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.control_helper') }}</span>
            </div>
           <div class="form-group col-12">
                <label for="acciones"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.acciones') }}</label>
                <textarea class="form-control {{ $errors->has('acciones') ? 'is-invalid' : '' }}" name="acciones" id="acciones">{{ old('acciones', $tratamientos->acciones) }}</textarea>
                @if ($errors->has('acciones'))
                    <div class="invalid-feedback">
                        {{ $errors->first('acciones') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.acciones_helper') }}</span>
            </div>
          
          
            <div class="form-group col-md-6">
                <label><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}</label>
                <select class="form-control {{ $errors->has('prioridad') ? 'is-invalid' : '' }}" name="prioridad" id="prioridad">
                    <option value disabled {{ old('prioridad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach (App\Models\TratamientoRiesgo::PRIORIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('prioridad', $tratamientos->prioridad) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if ($errors->has('prioridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prioridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.prioridad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="estatus"><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.estatus') }}</label>
                <input class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" type="text" name="estatus" id="estatus" value="{{ old('estatus', $tratamientos->estatus) }}">
                @if ($errors->has('estatus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="probabilidad"><i class="fas fa-percentage iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}</label>
                <input class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}" type="text" name="probabilidad" id="probabilidad" value="{{ old('probabilidad', $tratamientos->probabilidad) }}">
                @if ($errors->has('probabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('probabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.probabilidad_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="impacto"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.impacto') }}</label>
                <input class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" type="text" name="impacto" id="impacto" value="{{ old('impacto', $tratamientos->impacto) }}">
                @if ($errors->has('impacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('impacto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.impacto_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="nivelriesgoresidual"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgoresidual') ? 'is-invalid' : '' }}" type="text" name="nivelriesgoresidual" id="nivelriesgoresidual" value="{{ old('nivelriesgoresidual', $tratamientos->nivelriesgoresidual) }}">
                @if ($errors->has('nivelriesgoresidual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgoresidual') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual_helper') }}</span>
            </div> --}}
                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
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
