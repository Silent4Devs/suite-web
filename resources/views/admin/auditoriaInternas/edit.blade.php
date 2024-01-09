@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .datatable-rds {
            border: none !important;
        }

        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
            padding: 0 5px 5px 5px !important;
        }

        .select2-container {
            margin-top: 10px !important;
        }

        .form-group label {
            color: #343a40;
            z-index: 2;
            background-color: #F8FAFC;
        }

        .form-control,
        .anima-focus {
            background-color: #F8FAFC !important;
        }
    </style>

    {{ Breadcrumbs::render('admin.auditoria-internas.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Informe de Auditoría</h5>
    <div class="card mt-4">
        <div class="card-body">

            <div class="row">
                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    Datos Generales <sup>*</sup>
                </div>
                <hr style="width: 98%; margin:auto;">
            </div>

            <form method="POST" class="row"
                action="{{ route('admin.auditoria-internas.update', [$auditoriaInterna->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <div class="anima-focus">
                        <input class="form-control {{ $errors->has('id_auditoria') ? 'is-invalid' : '' }}" type="text"
                            maxlength="255" name="id_auditoria" id="id_auditoria"
                            value="{{ old('id_auditoria', $auditoriaInterna->id_auditoria) }}" required placeholder="">
                        <label class="required">ID</label>
                    </div>
                    @if ($errors->has('id_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('id_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-8">
                    <div class="anima-focus">
                        <input class="form-control {{ $errors->has('nombre_auditoria') ? 'is-invalid' : '' }}"
                            type="text" name="nombre_auditoria" id="nombre_auditoria" maxlength="220"
                            value="{{ old('nombre_auditoria', $auditoriaInterna->nombre_auditoria) }}" required
                            placeholder="">
                        <label class="required">Nombre de la auditoría</label>
                    </div>
                    @if ($errors->has('nombre_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('nombre_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <div class="anima-focus">
                        <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" type="text" name="objetivo"
                            id="objetivo" required placeholder="">{{ old('objetivo', $auditoriaInterna->objetivo) }}</textarea>
                        <label class="required">Objetivo de la auditoría</label>
                    </div>
                    @if ($errors->has('objetivo'))
                        <div class="text-danger">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-12">
                    <div class="anima-focus">
                        <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" type="text" name="alcance"
                            id="alcance" required placeholder="">{{ old('alcance', $auditoriaInterna->alcance) }}
                        </textarea>
                        <label class="required" for="alcance">Alcance de la auditoría</label>
                    </div>
                    @if ($errors->has('alcance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alcance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <div class="anima-focus">
                        <textarea class="form-control {{ $errors->has('criterios_auditoria') ? 'is-invalid' : '' }}" type="text"
                            name="criterios_auditoria" id="criterios_auditoria" required>{{ old('criterios_auditoria', $auditoriaInterna->criterios_auditoria) }}</textarea>
                        <label class="required">Criterios de la auditoría</label>
                    </div>
                    @if ($errors->has('criterios_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('criterios_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <div class="anima-focus mt-5">
                        <input class="form-control mt-2" type="date" id="fecha_inicio" min="1945-01-01"
                            name="fecha_inicio" min="1945-01-01"
                            value="{{ old('fecha_inicio', \Carbon\Carbon::parse($auditoriaInterna->fecha_inicio)->format('Y-m-d')) }}">
                        <label for="fecha_inicio"> Fecha
                            inicio</label>
                    </div>
                    @if ($errors->has('fecha_inicio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-8 col-lg-8">
                    <div class="anima-focus">
                        <select multiple
                            class="form-control select2 {{ $errors->has('equipoauditoria') ? 'is-invalid' : '' }}"
                            name="equipo[]" id="equipoauditoria_id">
                            @foreach ($equipoauditorias as $equipoauditoria)
                                <option value="{{ $equipoauditoria->id }}"
                                    {{ in_array(old('equipo', $equipoauditoria->id), $auditoriaInterna->equipo->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $equipoauditoria->name }}</option>
                            @endforeach
                        </select>
                        <label for="equipoauditoria_id">Equipo auditoría</label>
                    </div>
                    @if ($errors->has('equipoauditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('equipoauditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.equipoauditoria_helper') }}</span>
                </div>

                <div class="form-group col-md-6 mb-5">
                    <div class="anima-focus">
                        <select class="form-control select2 {{ $errors->has('auditorlider') ? 'is-invalid' : '' }}"
                            name="lider_id" id="lider_id">
                            <option value="">Seleccione una opción</option>
                            @foreach ($auditorliders as $auditorlider)
                                <option value="{{ $auditorlider->id }}"
                                    {{ old('lider_id', $auditoriaInterna->lider_id) == $auditorlider->id ? 'selected' : '' }}>
                                    {{ $auditorlider->name }}</option>
                            @endforeach
                        </select>
                        <label for="lider_id">Auditor líder</label>
                    </div>
                    @if ($errors->has('auditorlider'))
                        <div class="invalid-feedback">
                            {{ $errors->first('auditorlider') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.auditorlider_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6 mb-5">
                    <div class="anima-focus">
                        <input class="form-control" id="auditor_externo" name="auditor_externo" maxlength="220"
                            value="{{ old('auditor_externo', $auditoriaInterna->auditor_externo) }}">
                        <label for="auditor_externo">Auditor externo</label>
                    </div>
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
            <a href="{{ route('admin.auditoria-internas.index') }}" class="btn btn_cancelar">Cancelar</a>
            <button class="btn btn-success" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>
    </form>

    @livewire('edit-reporte-individual', ['clasificaciones' => $clasificacionesauditorias, 'clausulas' => $clausulasauditorias, 'id_auditoria' => $auditoriaInterna->id])

    <div class="row">
        <div class="form-group col-12 text-center">
            <a href="{{ route('admin.auditoria-internas.index') }}" class="btn btn_cancelar">Cancelar</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function viewAudit(id) {
            $('.tr-second' + id).toggleClass('d-none');
            $('.btn:hover i').toggleClass('btn-arrow-menu-table-rotate');
        }
    </script>
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

            window.initSelect2 = () => {
                $('.select2').select2({
                    'theme': 'bootstrap4'
                });
            }

            initSelect2();

            Livewire.on('select2', () => {
                initSelect2();
            });


        })
    </script>

    {{-- <script>
        document.getElementById('rechazo-link').addEventListener('click', function() {

            var comentariosValue = document.getElementById('comentarios').value;
            this.href = this.href + '?comentarios=' + encodeURIComponent(comentariosValue);
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('rechazo-link').addEventListener('click', function() {

                var comentariosValue = document.getElementById('comentarios').value;
                var repId = this.getAttribute('data-reporte');

                fetch('{{ route('admin.auditoria-internas.rechazoReporteIndividual', ['reporteid' => ':reporteauditoria']) }}'
                        .replace(':reporteauditoria',
                            repId), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                comentarios: comentariosValue
                            }),
                        })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'El participante ha sido notificado',
                                'success'
                            ).then(() => {
                                window.location.href =
                                    '{{ route('admin.auditoria-internas.index') }}';
                            });
                        } else {
                            Swal.fire(
                                'El correo no ha sido posible enviarlo debido a problemas de intermitencia con la red, favor de volver a intentar más tarde, o si esto persiste ponerse en contacto con el administrador',
                                'success'
                            ).then(() => {
                                window.location.href =
                                    '{{ route('admin.auditoria-internas.index') }}';
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
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
                    alert('Por favor firme el area designada.');
                } else {
                    var dataURL = signaturePad.toDataURL();
                    var comentariosValue = document.getElementById('comentarios').value;
                    var repId = this.getAttribute('data-reporte');

                    fetch('{{ route('admin.auditoria-internas.storeFirmaReporteLider', ['reporteid' => ':reporteauditoria']) }}'
                            .replace(':reporteauditoria',
                                repId), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-Token': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    signature: dataURL,
                                    comentarios: comentariosValue
                                }),
                            })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'El participante ha sido notificado',
                                ).then(() => {
                                    window.location.href =
                                        '{{ route('admin.auditoria-internas.index') }}';
                                });
                            } else {
                                Swal.fire(
                                    'El correo no ha sido posible enviarlo debido a problemas de intermitencia con la red, favor de volver a intentar más tarde, o si esto persiste ponerse en contacto con el administrador',
                                ).then(() => {
                                    window.location.href =
                                        '{{ route('admin.auditoria-internas.index') }}';
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
@endsection
