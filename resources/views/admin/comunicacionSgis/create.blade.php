@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.comunicacion-sgis.create') }}

    <style type="text/css">
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
        }

    </style>

<h5 class="col-12 titulo_general_funcion">Comunicados Generales</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <br>
                <h4>¿Qué es Comunicados Generales?</h4>
                <p>
                    Anuncios o mensajes importantes que la organización comparte con todos sus colaboradores para comunicar aspectos importantes.
                </p>
                <p>
                    Son fundamentales ya que contribuye a la concientización y comprensión general.
                </p>
            </div>
        </div>
    </div>

    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" action="{{ route('admin.comunicacion-sgis.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-12">
                    <label class="required" for="TitulodComunicado"><i class="fas fa-align-left iconos-crear"></i>
                        Título del Comunicado</label>
                    <input class="form-control {{ $errors->has('TitulodComunicado') ? 'is-invalid' : '' }}" type="text"
                        name="titulo" id="titulo" required value="{{ old('titulo') }}">
                    @if ($errors->has('dTitulodComunicado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('TitulodComunicado') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.comunicacionSgi.fields.descripcion_helper') }}</span>
                </div>

                <div class="form-group col-12">
                    <label class="required" for="descripcion"><i class="fas fa-pencil-ruler iconos-crear"></i>
                        Contenido</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion" required>{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.comunicacionSgi.fields.descripcion_helper') }}</span>
                </div>

                <div class="form-group col-md-6 col-sm-12">
                    <label for="documento"><i class="fas fa-folder-open iconos-crear"></i>Cargar Documento</label>
                    <input type="file" name="files[]" multiple class="form-control" id="documento"
                        accept="application/pdf" value="{{ old('files[]') }}">
                </div>



                <div class="form-group col-md-6">
                    <label class="required" for="imagen"> <i class="fas fa-image iconos-crear"></i>Imagen</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*, .mp4, .mov, .webm, .wmv, .avi"
                    required value="{{ old('imagen') }}">
                    @if ($errors->has('imagen'))
                        <div class="invalid-feedback">
                            {{ $errors->first('imagen') }}
                        </div>
                    @endif
                </div>




                <div class="form-group col-12">
                    <label class="required" for="publicar_en"><i class="fab fa-elementor iconos-crear"></i>Publicar en
                    </label>
                    <select class="form-control {{ $errors->has('publicar_en') ? 'is-invalid' : '' }}" name="publicar_en"
                        id="publicar_en" required>
                        <option disabled value="{{ old('publicar_en') }}" selected>
                            {{ old('publicar_en') }}
                        </option>
                        @foreach (App\Models\ComunicacionSgi::TipoSelect as $key => $label)
                            <option value="{{ $key }}">
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('publicar_en') }}
                        </div>
                    @endif
                </div>

                {{-- <div class="col-sm-12 col-md-6 form-group">
                <label class="required" for="publico"><i class="fas fa-people-arrows iconos-crear"></i>Público Objetivo</label>
                <select name="empleados[]" class="select2" multiple required>
                    @foreach ($empleados as $empleado)
                        <option value="{{$empleado->id}}">{{$empleado->name}}</option>
                    @endforeach
                </select>
            </div> --}}
                {{-- Select dinamico por grupos --}}
                @livewire("grupos-comunicacion")



                <div class="col-sm-12 col-md-6 form-group">
                    <label class="" for="link"><i class="fas fa-link iconos-crear"></i>Link</label>
                    <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="link" name="link"
                        placeholder="http://" id="link" value="{{ old('link') }}">
                    @if ($errors->has('link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 form-group">
                    <label class="required"><i class="far fa-calendar-alt iconos-crear"></i> Programar fecha de inicio
                        de publicación</label>
                    <input class="form-control date {{ $errors->has('fecha_programable') ? 'is-invalid' : '' }}"
                        type="date" id="fecha_programable" name="fecha_programable"
                        value="{{ old('fecha_programable') }}" min="1945-01-01" required>
                    @if ($errors->has('fecha_programable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_programable') }}
                        </div>
                    @endif
                </div>


                <div class="col-sm-12 col-md-6 form-group">
                    <label><i class="far fa-calendar-alt iconos-crear"></i> Programar fecha de fin de publicación</label>
                    <input class="form-control date {{ $errors->has('fecha_programable_fin') ? 'is-invalid' : '' }}"
                        type="date" id="fecha_programable_fin" name="fecha_programable_fin"
                        value="{{ old('fecha_programable_fin') }}" min="1945-01-01">
                    @if ($errors->has('fecha_programable_fin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_programable_fin') }}
                        </div>
                    @endif
                </div>


                <div class="text-right form-group col-12"><br>
                    <a href="{{ route('admin.comunicacion-sgis.index') }}" class="btn_cancelar">Cancelar</a>
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
        Dropzone.options.archivoDropzone = {
            url: '{{ route('admin.comunicacion-sgis.storeMedia') }}',
            maxFilesize: 4, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                $('form').find('input[name="archivo"]').remove()
                $('form').append('<input type="hidden" name="archivo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="archivo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($comunicacionSgi) && $comunicacionSgi->archivo)
                    var file = {!! json_encode($comunicacionSgi->archivo) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="archivo" value="' + file.file_name + '">')
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

        });

        $(document).ready(function() {

            $(".select2").select2({
                theme: "bootstrap4",
            });

        });
    </script>
@endsection
