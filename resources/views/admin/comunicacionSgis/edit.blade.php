@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.comunicacion-sgis.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Comunicado General </h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.comunicacion-sgis.update', [$comunicacionSgi->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-12">
                    <label class="required" for="TitulodComunicado"><i class="fas fa-align-left iconos-crear"></i>
                        Título del Comunicado</label>
                    <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo"
                        id="titulo" value="{{ old('titulo', $comunicacionSgi->titulo) }}" required>
                    @if ($errors->has('titulo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('titulo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.comunicacionSgi.fields.descripcion_helper') }}</span>
                </div>

                <div class="form-group col-12">
                    <label class="required" for="descripcion"><i class="fas fa-pencil-ruler iconos-crear"></i></i>
                        Contenido</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
                        id="descripcion" required>{{ old('descripcion', $comunicacionSgi->descripcion) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.comunicacionSgi.fields.descripcion_helper') }}</span>
                </div>

                <div class="form-group col-md-6 col-sm-12">
                    <label for="documento"><i class="fas fa-folder-open iconos-crear"></i>Cargar Documento</label>
                    <div class="custom-file">
                        <input type="file" name="files[]" multiple class="form-control" id="documento"
                            accept="application/pdf">
                        @if (count($comunicacionSgi->documentos_comunicacion) > 0)
                            <small>Documento actual:{{ $comunicacionSgi->documentos_comunicacion[0]->documento }}
                            </small><br>
                        @endif

                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="required" for="imagen"> <i class="fas fa-image iconos-crear"></i>Imagen</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*, .mp4, .mov, .webm, .wmv, .avi"
                    value="{{ old('imagen') }}" required>
                    @if (count($comunicacionSgi->imagenes_comunicacion) > 0)
                        <small>Imagen actual:{{ $comunicacionSgi->imagenes_comunicacion[0]->imagen }} </small><br>
                        <small>Tamaño recomendado de la imagen 500px por 300px</small>
                    @endif
                    @if ($errors->has('imagen'))
                        <div class="invalid-feedback">
                            {{ $errors->first('imagen') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3 col-md-6">
                    <span type="button" data-toggle="modal" data-target="#largeModal">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>
                <div class="mb-3 col-md-6">
                    <span type="button" data-toggle="modal" data-target="#imagenes_Modal">
                        <i class="mr-2 fas fa-eye text-primary" style="font-size:14pt"></i>Visualizar Imagen
                    </span>
                </div>


                <div class="form-group col-md-6 col-sm-12">
                    <label class="required" for="publicar_en"><i class="fab fa-elementor iconos-crear"></i>Publicar en </label>
                    <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}"
                        name="publicar_en" id="publicar_en" required>
                        <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>
                            Selecciona una opción
                        </option>
                        @foreach (App\Models\ComunicacionSgi::TipoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('tipo', $comunicacionSgi->publicar_en) === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-6">
                    <label for="fechaverificacion"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de
                        creación</label>

                    <div class="form-control">{{ $comunicacionSgi->created_at }}</div>
                </div>

                {{-- <div class="col-sm-12 col-md-6">
                    <label for="publico"><i class="fas fa-people-arrows iconos-crear"></i>Público Objetivo</label>
                    <select name="empleados[]" class="select2" multiple>
                        @foreach ($empleados as $empleado)
                            @foreach ($comunicacionSgi->empleados as $em)
                                <option value="{{ $empleado->id }}" {{ $em->id == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div> --}}
                @livewire("grupos-comunicacion")

                <div class="col-sm-12 col-md-6">
                    <label class="" for="link"><i class="fas fa-link iconos-crear"></i>Link</label>
                    <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="link" name="link"
                        placeholder="http://" id="link" value="{{ old('link', $comunicacionSgi->link) }}">
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
                        value="{{ $comunicacionSgi->fecha_programable }}" min="1945-01-01" required>
                    @if ($errors->has('fecha_programable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_programable') }}
                        </div>
                    @endif
                </div>


                <div class="col-sm-12 col-md-6 form-group">
                    <label><i class="far fa-calendar-alt iconos-crear"></i>Programar fecha de fin de publicación</label>
                    <input class="form-control date {{ $errors->has('fecha_programable_fin') ? 'is-invalid' : '' }}"
                        type="date" id="fecha_programable_fin" name="fecha_programable_fin"
                        value="{{ $comunicacionSgi->fecha_programable_fin }}" min="1945-01-01">
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

                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($comunicacionSgi->documentos_comunicacion))
                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($comunicacionSgi->documentos_comunicacion as $idx => $documento)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to= '{{ $idx  == 0 ? 'active' : '' }}''>
                                                </li>
                                            @endforeach

                                        </ol>

                                        <div class='carousel-inner'>
                                            @foreach ($comunicacionSgi->documentos_comunicacion as $idx => $documento)
                                                @if (pathinfo($documento->documento, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <iframe style="width:100%;height:300px;" seamless class='img-size'
                                                            src="{{ asset('storage/documento_comunicado_SGI') }}/{{ $documento->documento }}"></iframe>
                                                    </div>
                                                @else
                                                    <div
                                                        class='text-center my-5 carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <a
                                                            href="{{ asset('storage/documento_comunicado_SGI') }}/{{ $documento->documento }}">
                                                            <i class="fas fa-file-download mr-2"
                                                                style="font-size:18px"></i>{{ $documento->documento }}</a>
                                                    </div>
                                                @endif
                                            @endforeach


                                        </div>
                                        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button'
                                            data-slide='prev'>
                                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Previous</span>
                                        </a>
                                        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button'
                                            data-slide='next'>
                                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Next</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <h3 style="text-align:center" class="mt-3">Sin
                                            archivo agregado</h3>
                                        <img src="{{ asset('img/undrawn.png') }}" class="img-fluid "
                                            style="width:350px !important">
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="imagenes_Modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($comunicacionSgi->imagenes_comunicacion))
                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($comunicacionSgi->imagenes_comunicacion as $idx => $imagen)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to={{ $idx }}></li>
                                            @endforeach

                                        </ol>
                                        <div class='carousel-inner'>
                                            @foreach ($comunicacionSgi->imagenes_comunicacion as $idx => $imagen)
                                                <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                    <img style="width:80%; margin-left: 10%;" class='img-size'
                                                        src="{{ asset('storage/imagen_comunicado_SGI') }}/{{ $imagen->imagen }}" />
                                                </div>
                                            @endforeach


                                        </div>
                                        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button'
                                            data-slide='prev'>
                                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Previous</span>
                                        </a>
                                        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button'
                                            data-slide='next'>
                                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Next</span>
                                        </a>

                                    </div>
                                @else
                                    <div class="text-center">
                                        <h3 style="text-align:center" class="mt-3">Sin
                                            archivo agregado</h3>
                                        <img src="{{ asset('img/undrawn.png') }}" class="img-fluid "
                                            style="width:350px !important">
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
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


                    // {
                    //     name: 'others',
                    //     items: ['-']
                    // }
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
