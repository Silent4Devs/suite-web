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
    <h5 class="col-12 titulo_general_funcion">Editar: Informe de Auditoría</h5>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.auditoria-internas.update', [$auditoriaInterna->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label class="required">Id</label>
                    <input class="form-control {{ $errors->has('id_auditoria') ? 'is-invalid' : '' }}" type="text"
                        maxlength="255" name="id_auditoria" id="id_auditoria"
                        value="{{ old('id_auditoria', $auditoriaInterna->id_auditoria) }}" required>
                    @if ($errors->has('id_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('id_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-8">
                    <label class="required">Nombre de la auditoría</label>
                    <input class="form-control {{ $errors->has('nombre_auditoria') ? 'is-invalid' : '' }}" type="text"
                        name="nombre_auditoria" id="nombre_auditoria" maxlength="255"
                        value="{{ old('nombre_auditoria', $auditoriaInterna->nombre_auditoria) }}" required>
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
                        id="objetivo" required>{{ old('objetivo', $auditoriaInterna->objetivo) }}</textarea>
                    @if ($errors->has('objetivo'))
                        <div class="text-danger">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-12">
                    <label class="required" for="alcance">Alcance de la auditoría</label>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" type="text" name="alcance"
                        id="alcance" required>
                    {{ old('alcance', $auditoriaInterna->alcance) }}
                </textarea>
                    @if ($errors->has('alcance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alcance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label class="required">Criterios de auditoría</label>
                    <textarea class="form-control {{ $errors->has('criterios_auditoria') ? 'is-invalid' : '' }}" type="text"
                        name="criterios_auditoria" id="criterios_auditoria" required>{{ old('criterios_auditoria', $auditoriaInterna->criterios_auditoria) }}</textarea>
                    @if ($errors->has('criterios_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('criterios_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="fecha_inicio"> Fecha
                        inicio</label>
                    <input class="form-control mt-2" type="date" id="fecha_inicio" min="1945-01-01" name="fecha_inicio"
                        min="1945-01-01"
                        value="{{ old('fecha_inicio', \Carbon\Carbon::parse($auditoriaInterna->fecha_inicio)->format('Y-m-d')) }}">
                    @if ($errors->has('fecha_inicio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="equipoauditoria_id">Equipo auditoría</label>
                    <select multiple class="form-control select2 {{ $errors->has('equipoauditoria') ? 'is-invalid' : '' }}"
                        name="equipo[]" id="equipoauditoria_id">
                        @foreach ($equipoauditorias as $equipoauditoria)
                            <option value="{{ $equipoauditoria->id }}"
                                {{ in_array(old('equipo', $equipoauditoria->id), $auditoriaInterna->equipo->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $equipoauditoria->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('equipoauditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('equipoauditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.equipoauditoria_helper') }}</span>
                </div>

                {{-- <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="clausulas"> Criterios de auditoría</label>
                <select class="form-control {{ $errors->has('clausulas') ? 'is-invalid' : '' }}" name="clausulas[]"
                    id="clausulas" multiple>
                    <!-- <option value disabled >Selecciona una opción</option> -->
                    @foreach ($clausulas as $clausula)
                        <option value="{{ $clausula->id }}" {{ in_array(old('clausulas',$clausula->id),$auditoriaInterna->clausulas->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $clausula->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="errors tipo_error"></span>
            </div> --}}
                <div class="form-group col-md-6 mb-5">
                    <label for="auditorlider_id">Auditor líder</label>
                    <select class="form-control select2 {{ $errors->has('auditorlider') ? 'is-invalid' : '' }}"
                        name="lider_id" id="auditorlider_id">
                        <option value="">Seleccione una opción</option>
                        @foreach ($auditorliders as $auditorlider)
                            <option value="{{ $auditorlider->id }}"
                                {{ old('lider_id', $auditoriaInterna->lider_id) == $auditorlider->id ? 'selected' : '' }}>
                                {{ $auditorlider->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('auditorlider'))
                        <div class="invalid-feedback">
                            {{ $errors->first('auditorlider') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.auditorlider_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6 mb-5">
                    <label for="auditor_externo">Auditor externo</label>
                    <input class="form-control" id="auditor_externo" name="auditor_externo"
                        value="{{ old('auditor_externo', $auditoriaInterna->auditor_externo) }}">
                    @if ($errors->has('auditor_externo'))
                        <div class="text-danger">
                            {{ $errors->first('auditor_externo') }}
                        </div>
                    @endif
                </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12 text-right">
            <a href="{{ route('admin.auditoria-internas.index') }}" class="btn_cancelar">Cancelar</a>
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>

    @livewire('reporte-individual', ['clasificaciones' => $clasificacionesauditorias, 'clausulas' => $clausulasauditorias, 'id_auditoria' => $auditoriaInterna->id_auditoria])
    {{-- <div class="card card-body">
        <div class="form-group col-md-3 ">
            <div class="form-check {{ $errors->has('cheknoconformidadmenor') ? 'is-invalid' : '' }}">
                <input type="hidden" name="cheknoconformidadmenor" value="0">
                <input class="form-check-input" type="checkbox" name="cheknoconformidadmenor" id="cheknoconformidadmenor"
                    value="1"
                    {{ old('cheknoconformidadmenor', $auditoriaInterna->cheknoconformidadmenor) == 1 ? 'checked' : '' }}>
                <label class="form-check-label"
                    for="cheknoconformidadmenor">{{ trans('cruds.auditoriaInterna.fields.cheknoconformidadmenor') }}</label>
            </div>
            @if ($errors->has('cheknoconformidadmenor'))
                <div class="invalid-feedback">
                    {{ $errors->first('cheknoconformidadmenor') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.cheknoconformidadmenor_helper') }}</span>
        </div>
        <div class="form-group col-md-9">
            <label
                for="totalnoconformidadmenor">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmenor') }}</label>
            <input class="form-control {{ $errors->has('totalnoconformidadmenor') ? 'is-invalid' : '' }}" type="number"
                name="totalnoconformidadmenor" id="totalnoconformidadmenor"
                value="{{ old('totalnoconformidadmenor', $auditoriaInterna->totalnoconformidadmenor) }}" min="0">
            @if ($errors->has('totalnoconformidadmenor'))
                <div class="invalid-feedback">
                    {{ $errors->first('totalnoconformidadmenor') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmenor_helper') }}</span>
        </div>
        <div class="form-group col-md-3">
            <div class="form-check {{ $errors->has('checknoconformidadmayor') ? 'is-invalid' : '' }}">
                <input type="hidden" name="checknoconformidadmayor" value="0">
                <input class="form-check-input" type="checkbox" name="checknoconformidadmayor"
                    id="checknoconformidadmayor" value="1"
                    {{ old('checknoconformidadmayor', $auditoriaInterna->checknoconformidadmayor) == 1 ? 'checked' : '' }}>
                <label class="form-check-label"
                    for="checknoconformidadmayor">{{ trans('cruds.auditoriaInterna.fields.checknoconformidadmayor') }}</label>
            </div>
            @if ($errors->has('checknoconformidadmayor'))
                <div class="invalid-feedback">
                    {{ $errors->first('checknoconformidadmayor') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.checknoconformidadmayor_helper') }}</span>
        </div>
        <div class="form-group col-md-9">
            <label
                for="totalnoconformidadmayor">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmayor') }}</label>
            <input class="form-control {{ $errors->has('totalnoconformidadmayor') ? 'is-invalid' : '' }}" type="number"
                name="totalnoconformidadmayor" id="totalnoconformidadmayor"
                value="{{ old('totalnoconformidadmayor', $auditoriaInterna->totalnoconformidadmayor) }}" step="0.01"
                min="0" max="99">
            @if ($errors->has('totalnoconformidadmayor'))
                <div class="invalid-feedback">
                    {{ $errors->first('totalnoconformidadmayor') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmayor_helper') }}</span>
        </div>
        <div class="form-group col-md-3">
            <div class="form-check {{ $errors->has('checkobservacion') ? 'is-invalid' : '' }}">
                <input type="hidden" name="checkobservacion" value="0">
                <input class="form-check-input" type="checkbox" name="checkobservacion" id="checkobservacion"
                    value="1"
                    {{ old('checkobservacion', $auditoriaInterna->checkobservacion) == 1 ? 'checked' : '' }}>
                <label class="form-check-label"
                    for="checkobservacion">{{ trans('cruds.auditoriaInterna.fields.checkobservacion') }}</label>
            </div>
            @if ($errors->has('checkobservacion'))
                <div class="invalid-feedback">
                    {{ $errors->first('checkobservacion') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.checkobservacion_helper') }}</span>
        </div>
        <div class="form-group col-md-9">
            <label for="totalobservacion">{{ trans('cruds.auditoriaInterna.fields.totalobservacion') }}</label>
            <input class="form-control {{ $errors->has('totalobservacion') ? 'is-invalid' : '' }}" type="number"
                name="totalobservacion" id="totalobservacion"
                value="{{ old('totalobservacion', $auditoriaInterna->totalobservacion) }}" step="0.01" min="0"
                max="99">
            @if ($errors->has('totalobservacion'))
                <div class="invalid-feedback">
                    {{ $errors->first('totalobservacion') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalobservacion_helper') }}</span>
        </div>
        <div class="form-group col-md-3">
            <div class="form-check {{ $errors->has('checkmejora') ? 'is-invalid' : '' }}">
                <input type="hidden" name="checkmejora" value="0">
                <input class="form-check-input" type="checkbox" name="checkmejora" id="checkmejora" value="1"
                    {{ old('checkmejora', $auditoriaInterna->checkmejora) == 1 ? 'checked' : '' }}>
                <label class="form-check-label"
                    for="checkmejora">{{ trans('cruds.auditoriaInterna.fields.checkmejora') }}</label>
            </div>
            @if ($errors->has('checkmejora'))
                <div class="invalid-feedback">
                    {{ $errors->first('checkmejora') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.checkmejora_helper') }}</span>
        </div>
        <div class="form-group col-md-9">
            <label for="totalmejora">{{ trans('cruds.auditoriaInterna.fields.totalmejora') }}</label>
            <input class="form-control {{ $errors->has('totalmejora') ? 'is-invalid' : '' }}" type="number"
                name="totalmejora" id="totalmejora" value="{{ old('totalmejora', $auditoriaInterna->totalmejora) }}"
                step="0.01" min="0" max="99">
            @if ($errors->has('totalmejora'))
                <div class="invalid-feedback">
                    {{ $errors->first('totalmejora') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalmejora_helper') }}</span>
        </div>

        <div class="row col-12 ml-2">
            <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                <span style="font-size: 17px; font-weight: bold;">
                    Hallazgos</span>
            </div>
        </div>
        @livewire('table-auditoria-interna-hallazgos', ['auditoria_internas_id' => $auditoriaInterna->id]) --}}
    </form>
    {{-- </div> --}}
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('cerrar-modal', (event) => {
                $('#exampleModal').modal('hide');
                $('.modal-backdrop').hide();


            })
            Livewire.on('abrir-modal', () => {
                $('#exampleModal').modal('show');
                $('.select2').select2({
                    theme: 'bootstrap4'
                });

            })
            Livewire.on('editarParteInteresada', () => {
                console.log('hola');


            });
            Livewire.on('abrirModalPartesInteresadas', () => {
                $('#NormasModal').modal('show');
                setTimeout(() => {
                    CKEDITOR.replace('responsabilidades', {
                        toolbar: [{
                            name: 'paragraph',
                            groups: ['list', 'indent', 'blocks', 'align'],
                            items: ['NumberedList', 'BulletedList', '-', 'Outdent',
                                'Indent', '-',
                                'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                                'JustifyBlock', '-',
                                'Bold', 'Italic'
                            ]
                        }, {
                            name: 'clipboard',
                            items: ['Link', 'Unlink']
                        }, ]
                    });
                }, 1500);
            })
            Livewire.on('cerrarModalPartesInteresadas', () => {
                $('#NormasModal').modal('hide');
                $('.modal-backdrop').hide();

            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('id_auditado').addEventListener('change', (e) => {
                let seleccionado = e.target.options[e.target.selectedIndex];
                let puesto = seleccionado.getAttribute('data-puesto')
                let area = seleccionado.getAttribute('data-area')
                console.log(seleccionado);
                document.getElementById('puesto_asignada').innerHTML = puesto;
                document.getElementById('area_asignada').innerHTML = area;
            })
            Livewire.on('cargar-puesto', (empleado) => {
                console.log(empleado);
                let select = document.getElementById('id_auditado');
                let seleccionado = select.options[select.selectedIndex];
                let puesto = seleccionado.getAttribute('data-puesto')
                let area = seleccionado.getAttribute('data-area')
                console.log(seleccionado);
                document.getElementById('puesto_asignada').innerHTML = puesto;
                document.getElementById('area_asignada').innerHTML = area;
            })

            Livewire.on('abrir-modal', () => {
                document.getElementById('puesto_asignada').innerHTML = '';
                document.getElementById('area_asignada').innerHTML = '';
            })


            let editor = CKEDITOR.replace('responsabilidades', {
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
            Livewire.on('cerrar-modal', () => {
                CKEDITOR.instances.responsabilidades.setData('');
            })
            Livewire.on('editar-modal', (data) => {
                CKEDITOR.instances.responsabilidades.setData(data);
            })

            initSelect2();

            Livewire.on('select2', () => {
                initSelect2();
            });


        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('save').addEventListener('click', function() {
                if (signaturePad.isEmpty()) {
                    alert('Please provide a signature first.');
                } else {
                    var dataURL = signaturePad.toDataURL();
                    var audId = this.getAttribute('data-auditoria');

                    fetch('{{ route('admin.auditoria-internas.storeReporteIndividual', ['auditoriaInterna' => ':auditoriaInterna']) }}'
                            .replace(':auditoriaInterna',
                                audId), {
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
                            alert('Signature saved successfully.');
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
@endsection
