@extends('layouts.admin')

@section('content')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.vulnerabilidads.index') !!}">Vulnerabilidad</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol> --}}


    {{-- <style>
        .select2-results__option {
            position: relative;
            padding-left: 30px !important;

        }

        .select2-results__option:nth-child(2)::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(61, 114, 77);
            margin-left: -20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="1"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(61, 114, 77);
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-results__option:nth-child(3)::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(50, 205, 63);
            margin-left: -20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="2"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(50, 205, 63);
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-results__option:nth-child(4)::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: yellow;
            margin-left: -20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="3"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: yellow;
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-results__option:nth-child(5)::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(255, 136, 0);
            margin-left: -20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="4"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(255, 136, 0);
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-results__option:nth-child(6)::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: red;
            margin-left: -20px;
            border-radius: 100px;
            margin-top: 6px;
        }

        .select2-selection__rendered[title="5"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: red;
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered {
            padding-left: 30px !important;


        }

        .select2-selection__rendered[title="Bajo"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(50, 205, 63);
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Medio"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: yellow;
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Alto"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(255, 136, 0);
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Crítico"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: red;
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

        .select2-selection__rendered[title="Muy Bajo"]::before {
            position: absolute;
            content: '';
            width: 10px;
            height: 10px;
            background-color: rgb(61, 114, 77);
            margin-left: -18px;
            border-radius: 100px;
            margin-top: 11px;
        }

    </style> --}}
    <h5 class="col-12 titulo_general_funcion"> Registrar: Carta de Aceptación de Riesgos</h5>
    <div class="mt-4 card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.carta-aceptacion.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="text-center form-group"
                            style="background-color:#345183; border-radius: 100px; color: white;">
                            Datos Generales
                        </div>
                    </div>


                    <div class="form-group col-md-4 col-lg-4 col-sm-12">
                        <label class="required" for="folio_riesgo"><i class="fas fa-ticket-alt iconos-crear"></i>ID del
                            Riesgo
                        </label>
                        <input class="form-control {{ $errors->has('folio_riesgo') ? 'is-invalid' : '' }}"
                            name="folio_riesgo" id="folio_riesgo" {{ old('folio_riesgo') }} required>
                        @if ($errors->has('folio_riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('folio_riesgo') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    </div>

                    <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    </div>


                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="responsable_id"><i
                                class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                        <select class="form-control {{ $errors->has('responsable_id') ? 'is-invalid' : '' }}"
                            name="responsable_id" id="responsable_id" required>
                            <option value="" selected disabled>
                                -- Selecciona el nombre del empleado --
                            </option>
                            @foreach ($responsables as $responsable)
                                <option data-puesto="{{ $responsable->puesto }}" value="{{ $responsable->id }}"
                                    data-email="{{ $responsable->email }}">
                                    {{ $responsable->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('responsable_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('responsable_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="puesto_responsable"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label><i class="fas fa-envelope iconos-crear"></i>Correo Electronico</label>
                        <div class="form-control" id="correo_responsable"></div>
                    </div>

                    @livewire('body-carta-aceptacion')

                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label class="required" for="descripcion_riesgo"><i
                                class="far fa-file-alt iconos-crear"></i>Descripción del
                            Riesgo Aceptado
                        </label>
                        <textarea class="form-control {{ $errors->has('descripcion_riesgo') ? 'is-invalid' : '' }}" name="descripcion_riesgo"
                            id="descripcion_riesgo" required>
                            {{ old('descripcion_riesgo') }}</textarea>
                        @if ($errors->has('descripcion_riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion_riesgo') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label class="required" for="descripcion_negocio"><i
                                class="far fa-file-alt iconos-crear"></i>Descripción del
                            Impacto al Negocio
                        </label>
                        <textarea class="form-control {{ $errors->has('descripcion_negocio') ? 'is-invalid' : '' }}"
                            name="descripcion_negocio" id="descripcion_negocio" required>
                            {{ old('descripcion_negocio') }}</textarea>
                        @if ($errors->has('descripcion_negocio'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion_negocio') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label class="required" for="descripcion_tecnologico"><i
                                class="far fa-file-alt iconos-crear"></i>Descripción del
                            Impacto Tecnológico
                        </label>
                        <textarea class="form-control {{ $errors->has('descripcion_tecnologico') ? 'is-invalid' : '' }}"
                            name="descripcion_tecnologico" id="descripcion_tecnologico" required>
                            {{ old('descripcion_tecnologico') }}</textarea>
                        @if ($errors->has('descripcion_tecnologico'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion_tecnologico') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label class="required" for="aceptacion_riesgo"><i
                                class="fas fa-exclamation-triangle iconos-crear"></i>Razón por
                            la que se debe aceptar el riesgo
                        </label>
                        <input class="form-control {{ $errors->has('aceptacion_riesgo') ? 'is-invalid' : '' }}"
                            name="aceptacion_riesgo" id="aceptacion_riesgo" {{ old('aceptacion_riesgo') }} required>
                        @if ($errors->has('aceptacion_riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('aceptacion_riesgo') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label class="required" for="controles_compensatorios"><i
                                class="fas fa-lock iconos-crear"></i>Controles
                            compensatorios
                        </label>
                        <textarea class="form-control {{ $errors->has('controles_compensatorios') ? 'is-invalid' : '' }}"
                            name="controles_compensatorios" id="controles_compensatorios" required>
                            {{ old('controles_compensatorios') }}</textarea>
                        @if ($errors->has('controles_compensatorios'))
                            <div class="invalid-feedback">
                                {{ $errors->first('controles_compensatorios') }}
                            </div>
                        @endif
                    </div>
                    {{-- 3. Políticas/Control asociados al Riesgo --}}
                    <div class="col-12">
                        <div class="text-center form-group"
                            style="background-color:#345183; border-radius: 100px; color: white;">
                            3. Políticas/Control asociados al Riesgo
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-lg-12 col-sm-12 mb-4">
                        {{-- <label for="controles_id" style="margin-left: 15px; margin-bottom:5px; margin-right: 0px;"><i
                                class="fas fa-lock iconos-crear"></i></label> --}}

                        <select
                            class="form-control js-example-basic-multiple controles-select {{ $errors->has('controles_id') ? 'is-invalid' : '' }}"
                            name="controles_id[]" id="controles" multiple="multiple">
                            <option>Selecciona una opción</option>
                            @foreach ($controles as $control)
                                <option value="{{ $control->id }}">
                                    {{ $control->anexo_indice }} {{ $control->anexo_politica }}
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
                    {{-- 4. Hallazgos asociados al Riesgo --}}
                    <div class="col-12">
                        <div class="text-center form-group"
                            style="background-color:#345183; border-radius: 100px; color: white;">
                            4. Hallazgos asociados al Riesgo
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label for="hallazgos_auditoria"><i class="fas fa-lock iconos-crear"></i>Hallazgos de auditoría
                            interna / externa
                        </label>
                        <textarea class="form-control {{ $errors->has('hallazgos_auditoria') ? 'is-invalid' : '' }}"
                            name="hallazgos_auditoria" id="hallazgos_auditoria">
                            {{ old('hallazgos_auditoria') }}</textarea>
                        @if ($errors->has('hallazgos_auditoria'))
                            <div class="invalid-feedback">
                                {{ $errors->first('hallazgos_auditoria') }}
                            </div>
                        @endif
                    </div>
                    {{-- 5. Autorización de Aceptación de Riesgos --}}
                    <div class="col-12">
                        <div class="text-center form-group"
                            style="background-color:#345183; border-radius: 100px; color: white;">
                            5. Autorización de Aceptación de Riesgos
                        </div>
                    </div>

                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label class="required" for="director_resp_id"><i
                                class="fas fa-user-tie iconos-crear"></i>Director Responsable
                            del Riesgo</label>
                        <select class="form-control {{ $errors->has('director_resp_id') ? 'is-invalid' : '' }}"
                            name="director_resp_id" id="director_resp_id" required>
                            <option value="" selected disabled>
                                -- Selecciona el nombre del empleado --
                            </option>
                            @foreach ($directoresRiesgo as $directorRiesgo)
                                <option value="{{ $directorRiesgo->id }}">
                                    {{ $directorRiesgo->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('reviso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('director_resp_id') }}
                            </div>
                        @endif
                    </div>



                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label class="required" for="vp_responsable_id"><i class="fas fa-user-tie iconos-crear"></i>VP
                            Responsable del
                            Riesgo</label>
                        <select class="form-control {{ $errors->has('vp_responsable_id') ? 'is-invalid' : '' }}"
                            name="vp_responsable_id" id="vp_responsable_id" required>
                            <option value="" selected disabled>
                                -- Selecciona el nombre del empleado --
                            </option>
                            @foreach ($vicepresidentes as $vicepresidente)
                                <option value="{{ $vicepresidente->id }}">
                                    {{ $vicepresidente->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('vp_responsable_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('vp_responsable_id') }}
                            </div>
                        @endif
                    </div>



                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label class="required"><i class="fas fa-user-tie iconos-crear"></i>Presidencia</label>
                        <select class="form-control {{ $errors->has('presidencia_id') ? 'is-invalid' : '' }}"
                            name="presidencia_id" id="presidencia_id" required>
                            <option value="" selected disabled>
                                -- Selecciona el nombre del empleado --
                            </option>
                            @foreach ($presidencias as $presidencia)
                                <option value="{{ $presidencia->id }}">
                                    {{ $presidencia->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('presidencia_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('presidencia_id') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label class="required" for="vice_operaciones_id"><i
                                class="fas fa-user-tie iconos-crear"></i>Vicepresidencia de
                            Operaciones</label>
                        <select class="form-control {{ $errors->has('vice_operaciones_id') ? 'is-invalid' : '' }}"
                            name="vice_operaciones_id" id="vice_operaciones_id" required>
                            <option value="" selected disabled>
                                -- Selecciona el nombre del empleado --
                            </option>
                            @foreach ($vicepresidentesOperaciones as $vicepresidenteOperacion)
                                <option value="{{ $vicepresidenteOperacion->id }}">
                                    {{ $vicepresidenteOperacion->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('vice_operaciones_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('vice_operaciones_id') }}
                            </div>
                        @endif
                    </div>


                    {{-- 6. Recomendaciones mandatorias de seguridad --}}
                    <div class="col-12">
                        <div class="text-center form-group"
                            style="background-color:#345183; border-radius: 100px; color: white;">
                            6. Recomendaciones mandatorias de seguridad
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                        <label for="recomendaciones"><i class="fas fa-lock iconos-crear"></i>Recomendaciones Mandatorias
                            de Seguridad
                        </label>
                        <textarea class="form-control {{ $errors->has('recomendaciones') ? 'is-invalid' : '' }}" name="recomendaciones"
                            id="recomendaciones">
                            {{ old('recomendaciones') }}</textarea>
                        @if ($errors->has('recomendaciones'))
                            <div class="invalid-feedback">
                                {{ $errors->first('recomendaciones') }}
                            </div>
                        @endif
                    </div>

                    <!-- Submit Field -->
                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let responsable = document.querySelector('#responsable_id');
            let email_init = responsable.options[responsable.selectedIndex].getAttribute('data-email');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_responsable').innerHTML = puesto_init;
            document.getElementById('correo_responsable').innerHTML = email_init;
            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let email = this.options[this.selectedIndex].getAttribute('data-email');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_responsable').innerHTML = puesto;
                document.getElementById('correo_responsable').innerHTML = email;
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('recomendaciones', {
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

            CKEDITOR.replace('hallazgos_auditoria', {
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


            CKEDITOR.replace('controles_compensatorios', {
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

        function initInpusToMoneyFormat() {
            document.querySelectorAll("input[data-type='currency']").forEach(element => {
                formatCurrency($(element));
            })
        }

        function inputsToMoneyFormat() {
            $("input[data-type='currency']").on({
                init: function() {
                    console.log(this);
                },
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), "blur");
                }
            });
        }
    </script>
    <script>
        CKEDITOR.replace('descripcion_riesgo', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });
        CKEDITOR.replace('descripcion_negocio', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });
        CKEDITOR.replace('descripcion_tecnologico', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".js-example-basic-multiple").select2(
                'theme': 'bootstrap4',
                allowClear: true,
                minimumResultsForSearch: -1,
            );
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
        document.addEventListener('DOMContentLoaded', () => {

            $('.controles-select').select2({
                'theme': 'bootstrap4'
            });
        })
    </script>

    <script>
        $(document).on('change', '#director_resp_id', function(event) {
            let empleadoSeleccionado = $("#director_resp_id option:selected").val();
            $('#vp_responsable_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#vp_responsable_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'director_resp_id');
            $('#vp_responsable_id option[data-o="director_resp_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#vp_responsable_id option[data-o="director_resp_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

            $('#vice_operaciones_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#vice_operaciones_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'director_resp_id');
            $('#vice_operaciones_id option[data-o="director_resp_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#vice_operaciones_id option[data-o="director_resp_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');


            $('#presidencia_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#presidencia_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'director_resp_id');
            $('#presidencia_id option[data-o="director_resp_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#presidencia_id option[data-o="director_resp_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');
        });

        $(document).on('change', '#vp_responsable_id', function(event) {
            let empleadoSeleccionado = $("#vp_responsable_id option:selected").val();
            $('#vice_operaciones_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#vice_operaciones_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'vp_responsable_id');
            $('#vice_operaciones_id option[data-o="vp_responsable_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#vice_operaciones_id option[data-o="vp_responsable_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

            $('#director_resp_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#director_resp_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'vp_responsable_id');
            $('#director_resp_id option[data-o="vp_responsable_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#director_resp_id option[data-o="vp_responsable_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

            $('#presidencia_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#presidencia_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'vp_responsable_id');
            $('#presidencia_id option[data-o="vp_responsable_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#presidencia_id option[data-o="vp_responsable_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');
        });

        $(document).on('change', '#presidencia_id', function(event) {
            let empleadoSeleccionado = $("#presidencia_id option:selected").val();
            $('#vice_operaciones_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#vice_operaciones_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'presidencia_id');
            $('#vice_operaciones_id option[data-o="presidencia_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#vice_operaciones_id option[data-o="presidencia_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

            $('#director_resp_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#director_resp_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'presidencia_id');
            $('#director_resp_id option[data-o="presidencia_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#director_resp_id option[data-o="presidencia_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

            $('#vp_responsable_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#vp_responsable_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'presidencia_id');
            $('#vp_responsable_id option[data-o="presidencia_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#vp_responsable_id option[data-o="presidencia_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

        });

        $(document).on('change', '#vice_operaciones_id', function(event) {
            let empleadoSeleccionado = $("#vice_operaciones_id option:selected").val();
            $('#presidencia_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#presidencia_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'vice_operaciones_id');
            $('#presidencia_id option[data-o="vice_operaciones_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#presidencia_id option[data-o="vice_operaciones_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

            $('#director_resp_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#director_resp_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'vice_operaciones_id');
            $('#director_resp_id option[data-o="vice_operaciones_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#director_resp_id option[data-o="vice_operaciones_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');

            $('#vp_responsable_id [value="' + empleadoSeleccionado + '"]').attr('disabled', true);
            $('#vp_responsable_id [value="' + empleadoSeleccionado + '"]').attr('data-o', 'vice_operaciones_id');
            $('#vp_responsable_id option[data-o="vice_operaciones_id"]:not([value="' + empleadoSeleccionado + '"])').attr('disabled', false);
            $('#vp_responsable_id option[data-o="vice_operaciones_id"]:not([value="' + empleadoSeleccionado + '"])').attr('data-o', '');
        });
    </script>
@endsection
