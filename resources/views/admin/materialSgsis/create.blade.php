@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.material-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Material SGSI </h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <br>
                <h4>¿Qué es Material SGSI?</h4>
                <p>
                    Recursos educativos diseñados para enseñar a los colaboradores sobre las prácticas y requisitos de
                    seguridad de la información establecidos por la norma.
                </p>
                <p>
                    Útil para crear y mantener programas de formación y concientización en seguridad de la información.
                </p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.material-sgsis.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-12 anima-focus">
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                           type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre', '') }}"
                           required
                           placeholder="">
                    <label for="nombre" class="asterisco">Nombre del material de capacitación*</label>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.objetivo_helper') }}</span>
                </div>

                <div class="form-group col-12 anima-focus">
                    <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}"
                              name="objetivo"
                              id="objetivo"
                              required>{{ old('objetivo', '') }}</textarea>
                    <label for="objetivo" class="asterisco">Objetivo*</label>
                    @if ($errors->has('objetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.objetivo_helper') }}</span>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <select required class="form-control {{ $errors->has('personalobjetivo') ? 'is-invalid' : '' }}"
                            name="personalobjetivo"
                            id="personalobjetivo">
                        <option value="" disabled {{ old('personalobjetivo', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MaterialSgsi::PERSONALOBJETIVO_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('personalobjetivo', '') === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <label for="personalobjetivo" class="asterisco">Personal*</label>
                    @if ($errors->has('personalobjetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('personalobjetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.personalobjetivo_helper') }}</span>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <select required class="form-control select2 {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}"
                            name="arearesponsable_id"
                            id="arearesponsable_id">
                        @foreach ($arearesponsables as $id => $arearesponsable)
                            <option value="{{ $id }}" {{ old('arearesponsable_id') == $id ? 'selected' : '' }}>
                                {{ $arearesponsable }}</option>
                        @endforeach
                    </select>
                    <label for="arearesponsable_id" class="asterisco">Área*</label>
                    @if ($errors->has('arearesponsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('arearesponsable') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.arearesponsable_helper') }}</span>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <select required class="form-control {{ $errors->has('tipoimparticion') ? 'is-invalid' : '' }}"
                            name="tipoimparticion"
                            id="tipoimparticion">
                        <option value="" disabled {{ old('tipoimparticion', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MaterialSgsi::TIPOIMPARTICION_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('tipoimparticion', '') === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <label for="tipoimparticion" class="asterisco">Impartición*</label>
                    @if ($errors->has('tipoimparticion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipoimparticion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.tipoimparticion_helper') }}</span>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input placeholder=""
                           class="form-control {{ $errors->has('fechacreacion_actualizacion') ? 'is-invalid' : '' }}"
                           type="date"
                           min="1945-01-01"
                           name="fechacreacion_actualizacion"
                           id="fechacreacion_actualizacion"
                           value="{{ old('fechacreacion_actualizacion') }}"
                           required>
                    <label for="fechacreacion_actualizacion" class="asterisco">Fecha de creación*</label>
                    @if ($errors->has('fechacreacion_actualizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechacreacion_actualizacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.fechacreacion_actualizacion_helper') }}</span>
                </div>

                <div class="form-group col-12 anima-focus">
                    <input type="file"
                           name="files[]"
                           multiple
                           class="form-control {{ $errors->has('files') ? 'is-invalid' : '' }}"
                           id="documento"
                           accept="application/pdf"
                           value="{{ old('files[]') }}">
                    <label for="documento" class="asterisco">Material (Archivo PDF)*</label>
                    @if ($errors->has('files'))
                        <div class="invalid-feedback">
                            {{ $errors->first('files') }}
                        </div>
                    @endif
                </div>


                {{-- <div class="form-group col-12">
                <label for="archivo"><i class="far fa-file iconos-crear"></i>Material(Archivo PDF)</label>
                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
                </div>
                @if ($errors->has('archivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialSgsi.fields.archivo_helper') }}</span>
            </div> --}}

                {{-- <div class="form-group col-md-12 col-sm-12">
                <label for="archivo"><i class="fas fa-folder-open iconos-crear"></i>Material(Archivo PDF)</label>
                <input type="file" name="files[]" multiple class="form-control" id="documento" accept="application/pdf" value="{{ old('files[]') }}">
            </div> --}}





                <div class="form-group col-12 text-right">
                    <a href="{{ route('admin.material-sgsis.index') }}" class="btn btn-outline-primary">Cancelar</a>
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
        Dropzone.options.archivoDropzone = {
            url: '{{ route('admin.material-sgsis.storeMedia') }}',
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
                @if (isset($materialSgsi) && $materialSgsi->archivo)
                    var file = {!! json_encode($materialSgsi->archivo) !!}
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
