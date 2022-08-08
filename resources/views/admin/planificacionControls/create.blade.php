@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.planificacion-controls.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Planificación y Control</h5>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.planificacion-controls.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                {{-- <div class="form-group col-12">
                    <label class="required" for="activo"><i
                            class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.activo') }}</label>
                    <input class="form-control {{ $errors->has('activo') ? 'is-invalid' : '' }}" type="text"
                        name="activo" id="activo" value="{{ old('activo', '') }}" required>
                    @if ($errors->has('activo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('activo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planificacionControl.fields.activo_helper') }}</span>
                </div> --}}
                
                <div class="form-group col-4 col-md-4 mt-3">
                    <label for="id_reviso"><i class="fas fa-user-tie iconos-crear"></i>Revisó</label>
                    <select class="form-control {{ $errors->has('reviso') ? 'is-invalid' : '' }}" name="id_reviso"
                        id="id_reviso">
                        @foreach ($empleados as $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}">

                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('empleados'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_reviso') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 mt-3">
                    <label><i class="fas fa-briefcase iconos-crear"></i>Puesto<sup>*</sup></label>
                    <div class="form-control" id="reviso_puesto" readonly></div>
                </div>


                <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-3">
                    <label><i class="fas fa-street-view iconos-crear"></i>Área<sup>*</sup></label>
                    <div class="form-control" id="reviso_area" readonly></div>
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label for="id_amenaza" class="required"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
                    <select class="procesoSelect form-control" name="id_amenaza" id="id_amenaza">
                        <option value="">Seleccione una opción</option>
                        @foreach ($amenazas as $amenaza)
                            <option {{ old('id_amenaza') == $amenaza->id ? ' selected="selected"' : '' }}
                                value="{{ $amenaza->id }}">{{ $amenaza->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_amenaza'))
                        <span class="text-danger"> {{ $errors->first('id_amenaza') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label for="id_vulnerabilidad" class="required"><i
                            class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
                    <select class="procesoSelect form-control" name="id_vulnerabilidad" id="id_vulnerabilidad">
                        <option value="">Seleccione una opción</option>
                        @foreach ($vulnerabilidades as $vulnerabilidad)
                            <option {{ old('id_vulnerabilidad') == $vulnerabilidad->id ? ' selected="selected"' : '' }}
                                value="{{ $vulnerabilidad->id }}">{{ $vulnerabilidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_vulnerabilidad'))
                        <span class="text-danger"> {{ $errors->first('id_vulnerabilidad') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label for="activo_id"  class="required"><i class="fas fa-user-tie iconos-crear"></i>Activo (subcategoría)</label><br>
                    <select class="responsableSelect form-control" name="activo_id" id="activo_id">
                        <option value="">Seleccione una opción</option>
                        @foreach ($activos as $activo)
                            <option {{old('activo_id') == $activo->id ? ' selected="selected"' : ''}} value="{{ $activo->id }}">{{ $activo->subcategoria }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('activo_id'))
                    <span class="text-danger"> {{ $errors->first('activo_id') }}</span>
                    @endif
                </div>

                {{-- <div class="form-group col-md-4">
                <label for="confidencialidad"><i class="fas fa-key iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.confidencialidad') }}</label>
                <input class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}" type="text" name="confidencialidad" id="confidencialidad" value="{{ old('confidencialidad', '') }}">
                @if ($errors->has('confidencialidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('confidencialidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.confidencialidad_helper') }}</span>
            </div> --}}
                {{-- <div class="form-group col-md-4">
                <label for="integridad"><i class="fas fa-key iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.integridad') }}</label>
                <input class="form-control {{ $errors->has('integridad') ? 'is-invalid' : '' }}" type="text" name="integridad" id="integridad" value="{{ old('integridad', '') }}">
                @if ($errors->has('integridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('integridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.integridad_helper') }}</span>
            </div> --}}
                {{-- <div class="form-group col-md-4">
                <label for="disponibilidad"><i class="far fa-clock iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.disponibilidad') }}</label>
                <input class="form-control {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}" type="text" name="disponibilidad" id="disponibilidad" value="{{ old('disponibilidad', '') }}">
                @if ($errors->has('disponibilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disponibilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planificacionControl.fields.disponibilidad_helper') }}</span>
            </div> --}}
                <input type="hidden" id="resultadoponderacion" name="resultadoponderacion">
                    <div class="form-group col-sm-12 col-md-4 mt-3">
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

                    <div class="form-group col-sm-12 col-md-4 mt-3">
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

                    <div class="form-group col-sm-12 col-md-4 mt-3">
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

                <hr>

                    <div class="form-group col-sm-4 mt-3">
                        <label for="probabilidad_residual"><i
                                class="fas fa-wave-square iconos-crear"></i>Probabilidad</label>
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

                    <div class="form-group col-sm-4 mt-3">
                        <label for="impacto_residual"><i class="fas fa-compact-disc iconos-crear"></i>Impacto</label>
                        <select class="form-control {{ $errors->has('impacto_residual') ? 'is-invalid' : '' }}"
                            name="impacto_residual" id="impacto_residual">
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


                    <div class="form-group col-sm-4 mt-3">
                        <label for="nivelriesgo"><i class="fas fa-exclamation-circle iconos-crear"></i>Nivel Riesgo:
                        </label>
                        <div class="mb-3 input-group" style="pointer-events: none;">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-dark mayus" id="nivelriesgo_residual_pre"></span>
                            </div>
                            <input class="form-control {{ $errors->has('nivelriesgo_residual') ? 'is-invalid' : '' }}"
                                type="number" name="nivelriesgo_residual" id="nivelriesgo_residual"
                                value="{{ old('nivelriesgo_residual', '') }}">
                            @if ($errors->has('nivelriesgo_residual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nivelriesgo_residual') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label for="descripcion"><i
                                class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.planificacionControl.fields.descripcion') }}</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                            id="descripcion">{{ old('descripcion') }}</textarea>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.planificacionControl.fields.descripcion_helper') }}</span>
                    </div>

                <div class="form-group col-12 text-right">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        if (document.querySelector('#id_reviso') != null) {

            let responsable = document.querySelector('#id_reviso');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
            document.getElementById('reviso_puesto').innerHTML = recortarTexto(puesto_init);
            document.getElementById('reviso_area').innerHTML = recortarTexto(area_init);

            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = e.target.options[e.target.selectedIndex].getAttribute('data-area');
                let puesto = e.target.options[e.target.selectedIndex].getAttribute('data-puesto');
                console.log(e.target.options[e.target.selectedIndex]);
                document.getElementById('reviso_puesto').innerHTML = recortarTexto(puesto)
                document.getElementById('reviso_area').innerHTML = recortarTexto(area)
            })
        }

        function recortarTexto(texto, length = 30) {
            let trimmedString = texto?.length > length ?
                texto.substring(0, length - 3) + "..." :
                texto;
            return trimmedString;
        }

       

    </script>

    <script>
         document.getElementById('confidencialidad').addEventListener('change', (e) => {
                let integridad = document.getElementById('integridad').checked;
                let disponibilidad = document.getElementById('disponibilidad').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacion');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (disponibilidad) {
                    resultado += .33;
                }
                if (integridad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo');
                // let impacto = Number(document.getElementById('impacto').value);
                // let probabilidad =Number(document.getElementById('probabilidad').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));


            })

            document.getElementById('integridad').addEventListener('change', (e) => {
                let disponibilidad = document.getElementById('disponibilidad').checked;
                let confidencialidad = document.getElementById('confidencialidad').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacion');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (confidencialidad) {
                    resultado += .33;
                }
                if (disponibilidad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo');
                // let impacto = Number(document.getElementById('impacto').value);
                // let probabilidad =Number(document.getElementById('probabilidad').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));
            })

            document.getElementById('disponibilidad').addEventListener('change', (e) => {
                let integridad = document.getElementById('integridad').checked;
                let confidencialidad = document.getElementById('confidencialidad').checked;
                let resultadoponderacion = document.getElementById('resultadoponderacion');
                let resultado = 0.0;
                if (e.target.checked) {
                    resultado += .33;
                }
                if (confidencialidad) {
                    resultado += .33;
                }
                if (integridad) {
                    resultado += .33;
                }
                resultadoponderacion.value = Math.round(resultado * 10) / 10;
                // let nivelriesgo = document.getElementById('nivelriesgo');
                // let impacto = Number(document.getElementById('impacto').value);
                // let probabilidad =Number(document.getElementById('probabilidad').value);
                // nivelriesgo.value=Number(((Number(resultadoponderacion.value) + probabilidad)*impacto));
            })
    </script>

<script type=text/javascript>
    $('#probabilidad_residual').change(function() {
        var impactoID_residual = document.getElementById("impacto_residual").value;
        // var ponderacionRes = document.getElementById("resultadoponderacionRes").value;
        let probabilidadID_residual = $(this).val();
        //$("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));
        let result1 = Number(probabilidadID_residual) * Number(impactoID_residual);
        document.getElementById("nivelriesgo_residual").value = result1;
        switch (true) {
            case result1 == 0:
                $('#nivelriesgo_residual_pre').text('Bajo');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-orange");
                $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-success');
                break;
            case result1 >= 9 && result1 <= 18:
                $('#nivelriesgo_residual_pre').text('Bajo');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-orange");
                $('#nivelriesgo_residual_pre').removeClass("text-success");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-yellow');
                break;
            case result1 >= 27 && result1 <= 36:
                $('#nivelriesgo_residual_pre').text('Moderado');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-orange");
                $('#nivelriesgo_residual_pre').removeClass("text-success");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-orange');
                break;
            case result1 >= 54 && result1 <= 81:
                $('#nivelriesgo_residual_pre').text('Alto');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                $('#nivelriesgo_residual_pre').removeClass("text-success");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-danger');
                break;
            default:
                alert("Rango no encontrado, ¡Intentalo de nuevo!");
                break;
        }
    });

    $('#impacto_residual').change(function() {
        var probabilidadID_residual = document.getElementById("probabilidad_residual").value;
        let impactoID_residual = $(this).val();
        var ponderacionRes = document.getElementById("resultadoponderacionRes").value;
        let result1 = Number(probabilidadID_residual) * Number(impactoID_residual);
        //$("#nivelriesgo_residual").attr("value", Number(probabilidadID_residual) * Number(impactoID_residual));
        document.getElementById("nivelriesgo_residual").value = result1;
        switch (true) {
            case result1 == 0 :
                $('#nivelriesgo_residual_pre').text('Bajo');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-orange");
                $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-success');
                break;
            case result1 >= 9 && result1 <= 18:
                $('#nivelriesgo_residual_pre').text('Bajo');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-orange");
                $('#nivelriesgo_residual_pre').removeClass("text-success");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-yellow');
                break;
            case result1 >= 27 && result1 <= 36:
                $('#nivelriesgo_residual_pre').text('Moderado');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-orange");
                $('#nivelriesgo_residual_pre').removeClass("text-success");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-orange');
                break;
            case result1 >= 54 && result1 <= 81:
                $('#nivelriesgo_residual_pre').text('Alto');
                $('#nivelriesgo_residual_pre').removeClass("text-dark");
                $('#nivelriesgo_residual_pre').removeClass("text-yellow");
                $('#nivelriesgo_residual_pre').removeClass("text-success");
                $('#nivelriesgo_residual_pre').removeClass("text-danger");
                $('#nivelriesgo_residual_pre').addClass('text-danger');
                break;
            default:
                alert("Rango no encontrado, ¡Intentalo de nuevo!");
                break;
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
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
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
@endsection
