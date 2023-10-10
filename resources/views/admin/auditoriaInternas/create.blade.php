@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
            padding: 0 5px 5px 5px !important;
        }

        .select2-container {
            margin-top: 10px !important;
        }
    </style>

    {{ Breadcrumbs::render('admin.auditoria-internas.create') }}

    <h5 class="col-12 titulo_general_funcion">Crear Informe de Auditoria</h5>
    <div class="card card-body" style="background-color: #7587D0; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <h4>¿Qué es Informe de auditoría?</h4>
                <p>
                    Es un documento que describe los resultados de una auditoría.
                </p>
                <p>
                    Los informes de auditoría son una herramienta importante para mejorar la eficacia y eficiencia de los
                    sistemas y procesos. Los informes de auditoría ayudan a las organizaciones a identificar y corregir las
                    deficiencias, lo que puede conducir a una mejora del rendimiento y la reducción de los riesgos.
                </p>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.auditoria-internas.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label class="required">ID</label>
                    <input class="form-control {{ $errors->has('id_auditoria') ? 'is-invalid' : '' }}" type="text"
                        name="id_auditoria" id="id_auditoria" maxlength="255" value="{{ old('id_auditoria', '') }}"
                        required>
                    @if ($errors->has('id_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('id_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-8">
                    <label class="required">Nombre de auditoría</label>
                    <input class="form-control {{ $errors->has('nombre_auditoria') ? 'is-invalid' : '' }}" type="text"
                        name="nombre_auditoria" id="nombre_auditoria" maxlength="220"
                        value="{{ old('nombre_auditoria', '') }}" required>
                    @if ($errors->has('nombre_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('nombre_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label class="required">Objetivo de la auditoría</label>
                    <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" type="text" name="objetivo"
                        id="objetivo" required>{{ old('objetivo', '') }}</textarea>
                    @if ($errors->has('objetivo'))
                        <div class="text-danger">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label class="required" for="alcance">Alcance</label>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" type="text" name="alcance"
                        id="alcance" required>{{ old('alcance', '') }}</textarea>
                    @if ($errors->has('alcance'))
                        <div class="text-danger">
                            {{ $errors->first('alcance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label class="required">Criteríos de auditoría</label>
                    <textarea class="form-control {{ $errors->has('criterios_auditoria') ? 'is-invalid' : '' }}" type="text"
                        name="criterios_auditoria" id="criterios_auditoria" required>{{ old('criterios_auditoria', '') }}</textarea>
                    @if ($errors->has('criterios_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('criterios_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="fecha_inicio"> Fecha
                        del reporte de auditoría</label>
                    <input class="form-control mt-2" type="date" id="fecha_inicio" name="fecha_inicio" min="1945-01-01"
                        value="{{ old('fecha_inicio') }}">
                    @if ($errors->has('fecha_inicio'))
                        <div class="text-danger">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="auditorlider_id">Auditor líder</label>
                    <select class="form-control select2 {{ $errors->has('auditorlider') ? 'is-invalid' : '' }}"
                        name="lider_id" id="auditorlider_id">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($auditorliders as $auditorlider)
                            <option {{ old('lider_id') == $auditorlider->id ? ' selected="selected"' : '' }}
                                data-puesto="{{ $auditorlider->puesto }}" value="{{ $auditorlider->id }}"
                                data-area="{{ $auditorlider->area->area }}">
                                {{ Str::limit($auditorlider->name, 30, '...') }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('auditorlider'))
                        <div class="text-danger">
                            {{ $errors->first('auditorlider') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.auditorlider_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="auditor_externo">Auditor externo</label>
                    <input class="form-control mt-2" id="auditor_externo" name="auditor_externo" maxlength="220"
                        value="{{ old('auditor_externo') }}">
                    @if ($errors->has('auditor_externo'))
                        <div class="text-danger">
                            {{ $errors->first('auditor_externo') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="equipoauditoria_id">Equipo auditoría</label>
                    <select multiple class="form-control select2 {{ $errors->has('equipoauditoria') ? 'is-invalid' : '' }}"
                        name="equipo[]" id="equipoauditoria_id">
                        @foreach ($equipoauditorias as $equipoauditoria)
                            <option {{ old('equipoauditoria_id') == $equipoauditoria->id ? ' selected="selected"' : '' }}
                                value="{{ $equipoauditoria->id }}">
                                {{ $equipoauditoria->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('equipoauditoria'))
                        <div class="text-danger">
                            {{ $errors->first('equipoauditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.equipoauditoria_helper') }}</span>
                </div>


                <div class="form-group col-12 text-right">
                    <a href="{{ route('admin.auditoria-internas.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#clausulas").select2({
                theme: "bootstrap4",
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#equipoauditoria_id").select2({
                theme: "bootstrap4",
            });
        });
    </script>


    <script>
        Dropzone.options.logotipoDropzone = {
            url: '{{ route('admin.auditoria-internas.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="logotipo"]').remove()
                $('form').append('<input type="hidden" name="logotipo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logotipo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($auditoriaInterna) && $auditoriaInterna->logotipo)
                    var file = {!! json_encode($auditoriaInterna->logotipo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logotipo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
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


            CKEDITOR.replace('alcance', {
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

            CKEDITOR.replace('criterios_auditoria', {
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
