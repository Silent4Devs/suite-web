@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.concientizacion-sgis.create') }}
    <h5 class="col-12 titulo_general_funcion">Concientización SGSI</h5>
        <div class="card card-body" style="background-color: #5397D5; color: #fff;">
            <div class="d-flex" style="gap: 25px;">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
                <div>
                    <br>
                    <br>
                    <h4> ¿Qué es Concientización SGI?   </h4>
                    <p>
                        Proporcionar el conocimiento y la comprensión necesarios para ser parte activa en la seguridad de la información.
                    </p>
                    <p>
                        Implica que todos los miembros de la organización, desde la alta dirección hasta los empleados de todos los niveles, estén conscientes de los riesgos asociados con la seguridad de la información.
                    </p>
                </div>
            </div>
        </div>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.concientizacion-sgis.update', [$concientizacionSgi->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-12">
                    <label class="required" for="objetivocomunicado"><i
                            class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.objetivocomunicado') }}</label>
                    <input class="form-control {{ $errors->has('objetivocomunicado') ? 'is-invalid' : '' }}"
                        type="text" name="objetivocomunicado" id="objetivocomunicado"
                        value="{{ old('objetivocomunicado', $concientizacionSgi->objetivocomunicado) }}" required>
                    @if ($errors->has('objetivocomunicado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivocomunicado') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.concientizacionSgi.fields.objetivocomunicado_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required"><i
                            class="fas fa-user iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.personalobjetivo') }}</label>
                    <select required class="form-control {{ $errors->has('personalobjetivo') ? 'is-invalid' : '' }}"
                        name="personalobjetivo" id="personalobjetivo">
                        <option value disabled {{ old('personalobjetivo', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\ConcientizacionSgi::PERSONALOBJETIVO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('personalobjetivo', $concientizacionSgi->personalobjetivo) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('personalobjetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('personalobjetivo') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.concientizacionSgi.fields.personalobjetivo_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="arearesponsable_id"><i
                            class="fas fa-chart-area iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.arearesponsable') }}</label>
                    <select required class="form-control select2 {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}"
                        name="arearesponsable_id" id="arearesponsable_id">
                        @foreach ($arearesponsables as $id => $arearesponsable)
                            <option value="{{ $id }}"
                                {{ (old('arearesponsable_id') ? old('arearesponsable_id') : $concientizacionSgi->arearesponsable->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $arearesponsable }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('arearesponsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('arearesponsable') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.arearesponsable_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required"><i
                            class="fas fa-pager iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.medio_envio') }}</label>
                    <select required class="form-control {{ $errors->has('medio_envio') ? 'is-invalid' : '' }}" name="medio_envio"
                        id="medio_envio">
                        <option value disabled {{ old('medio_envio', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\ConcientizacionSgi::MEDIO_ENVIO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('medio_envio', $concientizacionSgi->medio_envio) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('medio_envio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('medio_envio') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.medio_envio_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="fecha_publicacion"><i
                            class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.fecha_publicacion') }}</label>
                    <input required class="form-control date {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}"
                        type="text" name="fecha_publicacion" id="fecha_publicacion" min="1945-01-01"
                        value="{{ old('fecha_publicacion', $concientizacionSgi->fecha_publicacion) }}">
                    @if ($errors->has('fecha_publicacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_publicacion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.concientizacionSgi.fields.fecha_publicacion_helper') }}</span>
                </div>

                <div class="mb-3 col-sm-12">
                    <label for="archivo"><i class="fas fa-folder-open iconos-crear"></i>Material(Archivo PDF)</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" {{ $errors->has('archivo') ? 'is-invalid' : '' }}"
                            multiple id="archivo" name="files[]"
                            {{ old('archivo', $concientizacionSgi->concientSgsi_id) }}>
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

                <div class="text-right form-group col-12">
                    <a href="{{ route("admin.concientizacion-sgis.index") }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($concientizacionSgi->documentos_concientizacion))
                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($concientizacionSgi->documentos_concientizacion as $idx => $concientSgsi_id)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to={{ $idx }}></li>
                                            @endforeach

                                        </ol>
                                        <div class='carousel-inner'>
                                            @foreach ($concientizacionSgi->documentos_concientizacion as $idx => $concientSgsi_id)
                                                @if (pathinfo($concientSgsi_id->documento, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <iframe style="width:100%;height:300px;" seamless class='img-size'
                                                            src="{{ asset('storage/documentos_concientSgsi') }}/{{ $concientSgsi_id->documento }}"></iframe>
                                                    </div>
                                                @else
                                                    <div
                                                        class='text-center my-5 carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <a
                                                            href="{{ asset('storage/documentos_concientSgsi') }}/{{ $concientSgsi_id->documento }}">
                                                            <i class="fas fa-file-download mr-2"
                                                                style="font-size:18px"></i>{{ $concientSgsi_id->documento }}</a>
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            url: '{{ route('admin.concientizacion-sgis.storeMedia') }}',
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
                @if (isset($concientizacionSgi) && $concientizacionSgi->archivo)
                    var file = {!! json_encode($concientizacionSgi->archivo) !!}
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
