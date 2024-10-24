@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.evidencias-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Evidencia de Asignación de Recursos al SGSI</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <br>
                <h4>¿Qué es Evidencia de Asignación de Recursos al SGSI?</h4>
                <p>
                    Registro de información y documentación que le permita a la organización mostrar que ha destinado los
                    recursos necesarios para implementar y mantener su Sistema de Gestión de la Seguridad de la Información
                    (SGI).
                </p>
                <p>
                    La evidencia de esta asignación es fundamental para demostrar el compromiso de la organización con la
                    seguridad de la información.
                </p>
            </div>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.evidencias-sgsis.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-md-12 anima-focus">
                    <input class="form-control {{ $errors->has('nombredocumento') ? 'is-invalid' : '' }}"
                           type="text"
                           name="nombredocumento"
                           id="nombredocumento"
                           placeholder=""
                           value="{{ old('nombredocumento', '') }}"
                           required>
                    <label for="nombredocumento" class="asterisco">Nombre del documento*</label>
                    @if ($errors->has('nombredocumento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombredocumento') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control {{ $errors->has('objetivodocumento') ? 'is-invalid' : '' }}"
                              name="objetivodocumento"
                              id="objetivodocumento"
                              placeholder=""
                              required>{{ old('objetivodocumento', '') }}</textarea>
                    <label for="objetivodocumento" class="asterisco">Objetivo del documento*</label>
                    @if ($errors->has('objetivodocumento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivodocumento') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <select class="form-control {{ $errors->has('empleados') ? 'is-invalid' : '' }}"
                            name="responsable_evidencia_id"
                            id="responsable_evidencia_id">
                        <option value="">Seleccione una opción</option>
                        @foreach ($empleados as $empleado)
                            <option data-puesto="{{ $empleado->puesto }}"
                                    value="{{ $empleado->id }}"
                                    data-area="{{ $empleado->area->area }}">
                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="responsable_evidencia_id" class="asterisco">Responsable del documento*</label>
                    @if ($errors->has('responsable_evidencia_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable_evidencia_id') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <div class="form-control" id="puesto_reviso" readonly></div>
                    <label for="puesto_reviso" class="asterisco">Puesto*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <div class="form-control" id="area_reviso" readonly></div>
                    <label for="id_area_reviso" class="asterisco">Área*</label>
                </div>

                {{-- <div class="form-group col-md-6">
                <label for="arearesponsable"><i class="fas fa-street-view iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.arearesponsable') }}</label>
                <input class="form-control {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}" type="text" name="arearesponsable" id="arearesponsable" value="{{ old('arearesponsable', '') }}">
                @if ($errors->has('arearesponsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arearesponsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.arearesponsable_helper') }}</span>
            </div> --}}


            <div class="form-group col-md-12 col-sm-12 col-lg-6 anima-focus">
                <select required class="form-control {{ $errors->has('area_id') ? 'is-invalid' : '' }}"
                        name="area_id"
                        id="area_id">
                    <option value="">Seleccione un área</option> <!-- Añadir opción de selección -->
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
                <label for="area_id" class="asterisco">Área responsable del documento*</label>
                @if ($errors->has('area_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_id') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-6 anima-focus">
                <input required class="form-control {{ $errors->has('fechadocumento') ? 'is-invalid' : '' }}"
                       type="date"
                       name="fechadocumento"
                       id="fechadocumento"
                       min="1945-01-01"
                       value="{{ old('fechadocumento') }}">
                <label for="fechadocumento" class="asterisco">Fecha de emisión del documento*</label>
                @if ($errors->has('fechadocumento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechadocumento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.fechadocumento_helper') }}</span>
            </div>

            <div class="col-sm-12 form-group anima-focus">
                <div class="custom-file">
                    <input type="file" name="files[]" multiple class="form-control {{ $errors->has('evidencia') ? 'is-invalid' : '' }}"
                           id="evidencia">
                    <label for="evidencia" class="asterisco">Documento*</label>
                </div>
                @if ($errors->has('evidencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('evidencia') }}
                    </div>
                @endif
            </div>

                {{-- <div class="form-group col-12">
                <label for="archivopdf"><i class="far fa-file-pdf iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.archivopdf') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivopdf') ? 'is-invalid' : '' }}" id="archivopdf-dropzone">
                </div>
                @if ($errors->has('archivopdf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivopdf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.archivopdf_helper') }}</span>
            </div> --}}
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.evidencias-sgsis.index') }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.archivopdfDropzone = {
            url: '{{ route('admin.evidencias-sgsis.storeMedia') }}',
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').find('input[name="archivopdf"]').remove()
                $('form').append('<input type="hidden" name="archivopdf" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="archivopdf"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($evidenciasSgsi) && $evidenciasSgsi->archivopdf)
                    var file = {!! json_encode($evidenciasSgsi->archivopdf) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="archivopdf" value="' + file.file_name + '">')
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
        document.addEventListener('DOMContentLoaded', function() {
            let cumple = document.getElementById('responsable_evidencia_id');
            cumple.addEventListener('change', function(e) {
                let respuesta = e.target.value;
                if (respuesta == 'No') {
                    $("#plan_accion_select").show(1000);
                } else {
                    $("#plan_accion_select").hide(1000);
                }
            })

            let responsable = document.querySelector('#responsable_evidencia_id');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto_init);
            document.getElementById('area_reviso').innerHTML = recortarTexto(area_init);
            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto);
                document.getElementById('area_reviso').innerHTML = recortarTexto(area);
            })
        });


        function recortarTexto(texto, length = 30) {
            let trimmedString = texto?.length > length ?
                texto.substring(0, length - 3) + "..." :
                texto;
            return trimmedString;
        }
    </script>
@endsection
