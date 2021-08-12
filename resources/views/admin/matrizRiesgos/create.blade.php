@extends('layouts.admin')
@section('content')

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Riesgo</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-riesgos.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group" style="margin-top:15px; width:1135px; height:25px; background-color:#1BB0B0">
                    <p class"text-center text-light" style="font-size:11pt; margin-left:500px; color:#ffffff;">DATOS
                        GENERALES</p>
                </div>

                <div class="form-group">
                    <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
                </div>

                <input type="hidden" value="{{ $id_analisis }}" name="id_analisis">

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_sede"><i class="fas fa-map-marker-alt iconos-crear"></i>Sede</label><br>
                        <select class="sedeSelect form-control" name="id_sede" id="id_sede">
                            <option value="">Seleccione una opción</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_sede'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_sede') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_proceso"><i class="fas fa-project-diagram iconos-crear"></i>Proceso</label><br>
                        <select class="procesoSelect form-control" name="id_proceso" id="id_proceso">
                            <option value="">Seleccione una opción</option>
                            @foreach ($procesos as $proceso)
                                <option value="{{ $proceso->id }}">{{ $proceso->codigo }} / {{ $proceso->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_proceso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_proceso') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="activo_id"><i class="fas fa-user-tie iconos-crear"></i>Activo</label><br>
                        <select class="responsableSelect form-control" name="activo_id" id="activo_id">
                            <option value="">Seleccione una opción</option>
                            @foreach ($activos as $activo)
                                <option value="{{ $activo->id }}">{{ $activo->nombreactivo }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('activo_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('activo_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_responsable"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label><br>
                        <select class="responsableSelect form-control" name="id_responsable" id="id_responsable">
                            <option value="">Seleccione una opción</option>
                            @foreach ($responsables as $responsable)
                                <option value="{{ $responsable->id }}">{{ $responsable->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_responsable'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_responsable') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_puesto"><i class="fas fa-user-tag iconos-crear"></i>Puesto </label>
                        <input class="form-control {{ $errors->has('id_puesto') ? 'is-invalid' : '' }}" type="text"
                            id="id_puesto" value="" disabled>
                        @if ($errors->has('id_puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_puesto') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área </label>
                        <input class="form-control {{ $errors->has('id_area') ? 'is-invalid' : '' }}" type="text"
                            id="id_area" value="" disabled>
                        @if ($errors->has('id_area'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_area') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_amenaza"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
                        <select class="procesoSelect form-control" name="id_amenaza" id="id_amenaza">
                            <option value="">Seleccione una opción</option>
                            @foreach ($amenazas as $amenaza)
                                <option value="{{ $amenaza->id }}">{{ $amenaza->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('amenaza'))
                            <div class="invalid-feedback">
                                {{ $errors->first('amenaza') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.proceso_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_vulnerabilidad"><i class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
                        <select class="procesoSelect form-control" name="id_vulnerabilidad" id="id_vulnerabilidad">
                            <option value="">Seleccione una opción</option>
                            @foreach ($vulnerabilidades as $vulnerabilidad)
                                <option value="{{ $vulnerabilidad->id }}">{{ $vulnerabilidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_vulnerabilidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_vulnerabilidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.proceso_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="tipo_riesgo"><i class="fas fa-asterisk iconos-crear"></i>Tipo de riesgo</label>
                        <select class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}"
                            name="tipo_riesgo" id="tipo_riesgo">
                            <option value disabled {{ old('tipo_riesgo', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('tipo_riesgo', '') === (string) $key ? 'selected' : '' }}>
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

                </div>

                <div class="form-group">
                    <label for="descripcionriesgo"><i class="far fa-file-alt iconos-crear"></i>Descripción Riesgo</label>
                    <textarea class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}" type="text"
                        name="descripcionriesgo" id="descripcionriesgo" value="{{ old('descripcionriesgo', '') }}" rows="3"></textarea>
                    @if ($errors->has('descripcionriesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcionriesgo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.responsableproceso_helper') }}</span>
                </div>
                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">Indique las caracteristicas del CID afectadas por este
                    riesgo</p>

                <div class="row py-2">
                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="confidencialidad"
                                name="confidencialidad">
                            <label class="custom-control-label" for="confidencialidad"><i
                                    class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                        </div>

                        @if ($errors->has('confidencialidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('confidencialidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="integridad" name="integridad">
                            <label class="custom-control-label" for="integridad"><i
                                    class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                        </div>
                        @if ($errors->has('integridad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('integridad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="disponibilidad" name="disponibilidad">
                            <label class="custom-control-label" for="disponibilidad"><i
                                    class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                        </div>
                        @if ($errors->has('disponibilidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('disponibilidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                </div>
                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">Evalue el riesgo inicial de acuerdo a la probabilidad vs
                    impacto</p>
                <div class="row">

                    <div class="form-group col-sm-4">
                        <label for="probabilidad"><i class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
                        <select class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}"
                            name="probabilidad" id="probabilidad">
                            <option value disabled {{ old('probabilidad', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('probabilidad', '') === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('probabilidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('probabilidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="impacto"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                        <select class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" name="impacto"
                            id="impacto">
                            <option value disabled {{ old('impacto', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('impacto', '') === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('impacto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('impacto') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="nivelriesgo"><i class="fas fa-exclamation-circle iconos-crear"></i>Nivel Riesgo</label>
                        <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="number"
                            name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', '') }}">
                        @if ($errors->has('nivelriesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nivelriesgo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="riesgoresidual"><i class="fas fa-radiation iconos-crear"></i>Riesgo Residual</label>
                        <input class="form-control {{ $errors->has('riesgoresidual') ? 'is-invalid' : '' }}" type="text"
                            name="riesgoresidual" id="riesgoresidual" value="{{ old('riesgoresidual', '') }}">
                        @if ($errors->has('riesgoresidual'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgoresidual') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="riesgototal"><i class="fas fa-radiation iconos-crear"></i>Riesgo Total</label>
                        <input class="form-control {{ $errors->has('riesgototal') ? 'is-invalid' : '' }}" type="text"
                            name="riesgototal" id="riesgototal" value="{{ old('riesgototal', '') }}">
                        @if ($errors->has('riesgototal'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgototal') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>


                    <div class="form-group col-sm-4">
                        <label for="resultadoponderacion"><i class="fas fa-chart-bar iconos-crear"></i>Resultado
                            Ponderacion</label>
                        <input class="form-control {{ $errors->has('resultadoponderacion') ? 'is-invalid' : '' }}"
                            type="text" name="resultadoponderacion" id="resultadoponderacion"
                            value="{{ old('resultadoponderacion', '') }}">
                        @if ($errors->has('resultadoponderacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('resultadoponderacion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>

                </div>

                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">Acciones</p>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="controles_id"><i class="fas fa-gamepad iconos-crear"></i>Control</label>
                        <select class="form-control {{ $errors->has('controles_id') ? 'is-invalid' : '' }}"
                            name="controles_id" id="controles_id">
                            <option value disabled {{ old('controles_id', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach ($controles as $control)
                                <option value="{{ $control->id }}">
                                    {{ $control->control }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('controles_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('controles_id') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="plan_de_accion"><i class="fas fa-lightbulb iconos-crear"></i>Plan de acción</label>
                        <select class="form-control {{ $errors->has('plan_de_accion') ? 'is-invalid' : '' }}"
                            name="plan_de_accion" id="plan_de_accion">
                            <option value disabled {{ old('plan_de_accion', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach ($controles as $control)
                                <option value="{{ $control->id }}">
                                    {{ $control->control }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('plan_de_accion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('plan_de_accion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                </div>
                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">CID Riesgo Residual</p>
                <div class="row py-2">
                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="confidencialidad_cid"
                                name="confidencialidad_cid">
                            <label class="custom-control-label" for="confidencialidad_cid"><i
                                    class="fas fa-lock iconos-crear"></i>Confidencialidad</label>
                        </div>

                        @if ($errors->has('confidencialidad_cid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('confidencialidad_cid') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="integridad_cid" name="integridad_cid">
                            <label class="custom-control-label" for="integridad_cid"><i
                                    class="fab fa-black-tie iconos-crear"></i>Integridad</label>
                        </div>
                        @if ($errors->has('integridad_cid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('integridad_cid') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="disponibilidad_cid"
                                name="disponibilidad_cid">
                            <label class="custom-control-label" for="disponibilidad_cid"><i
                                    class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label>
                        </div>
                        @if ($errors->has('disponibilidad_cid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('disponibilidad_cid') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                </div>
                <hr>
                <p class="font-weight-bold" style="font-size:11pt;">Riesgo Residual</p>
                <div class="row">

                    <div class="form-group col-sm-4">
                        <label for="probabilidad_residual"><i class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
                        <select class="form-control {{ $errors->has('probabilidad_residual') ? 'is-invalid' : '' }}"
                            name="probabilidad_residual" id="probabilidad_residual">
                            <option value disabled {{ old('probabilidad_residual', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('probabilidad_residual', '') === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('probabilidad_residual'))
                            <div class="invalid-feedback">
                                {{ $errors->first('probabilidad_residual') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="impacto_residual"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                        <select class="form-control {{ $errors->has('impacto_residual') ? 'is-invalid' : '' }}" name="impacto_residual"
                            id="impacto_residual">
                            <option value disabled {{ old('impacto_residual', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('impacto_residual', '') === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('impacto_residual'))
                            <div class="invalid-feedback">
                                {{ $errors->first('impacto_residual') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="nivelriesgo_residual"><i class="fas fa-exclamation-circle iconos-crear"></i>Nivel Riesgo</label>
                        <input class="form-control {{ $errors->has('nivelriesgo_residual') ? 'is-invalid' : '' }}" type="number"
                            name="nivelriesgo_residual" id="nivelriesgo_residual" value="{{ old('nivelriesgo_residual', '') }}">
                        @if ($errors->has('nivelriesgo_residual'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nivelriesgo_residual') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>

                </div>
                <hr>
                <div class="form-group">
                    <label for="justificacion"><i class="far fa-file-alt iconos-crear"></i>Justificación</label>
                    <textarea class="form-control {{ $errors->has('justificacion') ? 'is-invalid' : '' }}" type="text"
                        name="justificacion" id="justificacion" value="{{ old('justificacion', '') }}"rows="3"></textarea>
                    @if ($errors->has('justificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('justificacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.responsableproceso_helper') }}</span>
                </div>

                <div class="form-group col-12 text-right">
                    <a href="{{ route('admin.matriz-seguridad', ['id' => $id_analisis]) }}"
                        class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script type=text/javascript>
        $('#id_responsable').change(function() {
            var elaboroID = $(this).val();
            if (elaboroID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/getEmployeeData') }}?id=" + elaboroID,
                    success: function(res) {
                        if (res) {
                            $("#id_puesto").empty();
                            $("#id_puesto").attr("value", res.puesto);
                            $("#id_area").empty();
                            $("#id_area").attr("value", res.area);
                        } else {
                            $("#id_puesto").empty();
                            $("#id_area").empty();
                        }
                    }
                });
            } else {
                $("#id_puesto").empty();
                $("#id_area").empty();
            }
        });
    </script>
@endsection
