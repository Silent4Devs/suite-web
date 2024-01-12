@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.control-accesos.create') }}
    <h5 class="col-12 titulo_general_funcion">Control de Acceso</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4>¿Qué es Control de Accesos?</h4>
                <p>
                    Garantiza que las personas adecuadas tengan el acceso adecuado a la información en un sistema de gestión de seguridad.
                </p>
                <p>
                    Esencial para garantizar la seguridad y la integridad de la información, así como para proteger los activos críticos de una organización.
                </p>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" class="row" action="{{ route('admin.control-accesos.update', [$controlAcceso->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-sm-12 ">
                    <label class="required" for="tipo">Tipo</label>
                    <div style="float: right;">
                        <button id="btnAgregarTipo" onclick="event.preventDefault();"
                            class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
                            data-toggle="modal" data-target="#tipoCompetenciaModal" data-whatever="@mdo"
                            data-whatever="@mdo" title="Agregar tipo de permiso"><i
                                class="fas fa-plus"></i></button>
                    </div>
                    @livewire('permiso-component')
                    @livewire('tipo-permiso-select-component')

                </div>

                <div class="form-group col-sm-4 mt-3 anima-focus">
                    <select
                        class="form-control {{ $errors->has('responsable_id') ? 'is-invalid' : '' }}" onchange="printarea();"
                        name='responsable_id' id='responsable_id' required>
                        <option value="">Seleccione un responsable</option>
                        @foreach ($responsables as $responsable)
                            <option value="{{ $responsable->id }}"
                                data-area="{{ $responsable->area->area }}"
                                data-puesto="{{ $responsable->puesto }}"
                                {{ old('responsable_id',$controlAcceso->responsable_id) == $responsable->id ? 'selected' : '' }}>
                                {{ $responsable->name }}</option>
                        @endforeach
                    </select>
                    {!! Form::label('responsable_id', 'Responsable*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('responsable_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable_id') }}
                        </div>
                    @endif
            </div>



            <div class="form-group col-md-4 mt-3 anima-focus">
                <div class="form-control" id="responsable_puesto"></div>
                {!! Form::label('responsable_puesto', 'Puesto*', ['class' => 'asterisco']) !!}
            </div>


            <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-3 anima-focus">
                <div class="form-control" id="responsable_area" ></div>
                {!! Form::label('responsable_area', 'Área*', ['class' => 'asterisco']) !!}
            </div>

        <div class=" mb-4 ml-3 w-100" style="border-bottom: solid 2px #345183;">
            <span style="font-size: 17px; font-weight: bold;">
                Periodo</span>
        </div>

        <div class="form-group col-sm-12 col-md-12 col-lg-6 anima-focus">
            <input required placeholder="" class="form-control" type="date" min="1945-01-01"
            id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio',$controlAcceso->fecha_inicio )}}">
            {!! Form::label('fecha_inicio', 'Fecha Inicio*', ['class' => 'asterisco']) !!}
            <span class="fecha_inicio_error text-danger errores"></span>
            @if ($errors->has('fecha_inicio'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha_inicio') }}
                </div>
            @endif
        </div>

        <div class="form-group col-sm-12 col-md-12 col-lg-6  anima-focus">
            <input required placeholder="" class="form-control" type="date" min="1945-01-01"
            id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin',$controlAcceso->fecha_fin ) }}">
            {!! Form::label('fecha_fin', 'Fecha Fin*', ['class' => 'asterisco']) !!}
            <span class="fecha_fin_error text-danger errores"></span>
            @if ($errors->has('fecha_fin'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha_fin') }}
                </div>
            @endif
        </div>
        <div class="form-group col-md-12 anima-focus">
            <textarea required class="form-control {{ $errors->has('justificacion') ? 'is-invalid' : '' }}"
                name="justificacion" id="justificacion">{{ old('justificacion',$controlAcceso->justificacion ) }}</textarea>
                {!! Form::label('justificacion', 'Justificación*', ['class' => 'asterisco']) !!}
            @if($errors->has('justificacion'))
                <div class="invalid-feedback">
                    {{ $errors->first('justificacion') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.controlAcceso.fields.descripcion_helper') }}</span>
        </div>

                <div class="form-group col-md-12">
                    <label class="required" for="descripcion">{{ trans('cruds.controlAcceso.fields.descripcion') }}</label>
                    <textarea required class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion', $controlAcceso->descripcion) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.controlAcceso.fields.descripcion_helper') }}</span>
                </div>

                {{-- editar --}}
                <div class="mb-3 col-sm-12">
                    <label for="archivo">Material(Archivo PDF)</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" {{ $errors->has('archivo') ? 'is-invalid' : '' }}"
                            multiple id="archivo" name="files[]" {{ old('archivo', $controlAcceso->controlA_id) }}>
                        @if ($errors->has('archivo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('archivo') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3 col-10 d-flex justify-content-right">
                    <span class="float-right" type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
                        data-target="#largeModal">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>
                {{-- editar --}}

                <div class="form-group col-12 text-right">
                    <a href="{{ route("admin.control-accesos.index") }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <!-- carousel -->
                                <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                    <ol class='carousel-indicators'>
                                        @foreach ($controlAcceso->documentos_controlA as $idx => $controlA_id)
                                            <li data-target=#carouselExampleIndicators
                                                data-slide-to='{{ $idx == 0 ? 'active' : '' }}''>
                                            </li>
                                        @endforeach

                                    </ol>
                                    <div class='carousel-inner'>
                                        @foreach ($controlAcceso->documentos_controlA as $idx => $controlA_id)
                                            @if (pathinfo($controlA_id->documento, PATHINFO_EXTENSION) == 'pdf')
                                                <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                    <iframe style="width:100%;height:300px;" seamless class='img-size'
                                                        src="{{ asset('storage/documentos_control_accesos') }}/{{ $controlA_id->documento }}"></iframe>
                                                </div>
                                            @else
                                                <div
                                                    class='text-center my-5 carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                    <a
                                                        href="{{ asset('storage/documentos_control_accesos') }}/{{ $controlA_id->documento }}">
                                                        <i class="fas fa-file-download mr-2"
                                                            style="font-size:18px"></i>{{ $controlA_id->documento }}</a>
                                                </div>
                                            @endif
                                        @endforeach


                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <a style="height: 50px; top: 50px;" class='carousel-control-prev'
                                    href='#carouselExampleIndicators' role='button' data-slide='prev'>
                                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                    <span class='sr-only'>Previous</span>
                                </a>
                                <a style="height: 50px; top: 50px;" class='carousel-control-next'
                                    href='#carouselExampleIndicators' role='button' data-slide='next'>
                                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                    <span class='sr-only'>Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function printarea() {
        // Obtiene el elemento select y la opción seleccionada
        var select = document.getElementById('responsable_id');
        var selectedOption = select.options[select.selectedIndex];

        // Accede a los atributos personalizados data-area y data-puesto
        var area = selectedOption.getAttribute('data-area');
        var puesto = selectedOption.getAttribute('data-puesto');

        // Actualiza el contenido de los elementos div correspondientes
        document.getElementById('responsable_puesto').textContent = puesto;
        document.getElementById('responsable_area').textContent = area;
        
    }

    document.addEventListener('DOMContentLoaded', function() {
        printarea();
    });
</script>


@section(' scripts')
    <script>
        Dropzone.options.archivoDropzone = {
            url: '{{ route('admin.control-accesos.storeMedia') }}',
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
                @if (isset($controlAcceso) && $controlAcceso->archivo)
                    var file = {!! json_encode($controlAcceso->archivo) !!}
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

@endsection
