@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.material-iso-veinticientes.create') }}

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Material ISO 27001:2013</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.material-iso-veinticientes.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-12">
                    <label class="required" for="objetivo"><i
                            class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.materialIsoVeinticiente.fields.objetivo') }}</label>
                    <input class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" type="text"
                        name="objetivo" id="objetivo" value="{{ old('objetivo', '') }}" required>
                    @if ($errors->has('objetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.objetivo_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="listaasistencia"><i
                            class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.materialIsoVeinticiente.fields.listaasistencia') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('listaasistencia') ? 'is-invalid' : '' }}"
                        id="listaasistencia-dropzone">
                    </div>
                    @if ($errors->has('listaasistencia'))
                        <div class="invalid-feedback">
                            {{ $errors->first('listaasistencia') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.listaasistencia_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="arearesponsable_id"><i
                            class="fas fa-chart-area iconos-crear"></i>{{ trans('cruds.materialIsoVeinticiente.fields.arearesponsable') }}</label>
                    <select class="form-control select2 {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}"
                        name="arearesponsable_id" id="arearesponsable_id">
                        @foreach ($arearesponsables as $id => $arearesponsable)
                            <option value="{{ $id }}" {{ old('arearesponsable_id') == $id ? 'selected' : '' }}>
                                {{ $arearesponsable }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('arearesponsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('arearesponsable') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.arearesponsable_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label><i
                            class="fas fa-briefcase iconos-crear"></i>{{ trans('cruds.materialIsoVeinticiente.fields.tipoimparticion') }}</label>
                    <select class="form-control {{ $errors->has('tipoimparticion') ? 'is-invalid' : '' }}"
                        name="tipoimparticion" id="tipoimparticion">
                        <option value disabled {{ old('tipoimparticion', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MaterialIsoVeinticiente::TIPOIMPARTICION_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('tipoimparticion', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipoimparticion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipoimparticion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.tipoimparticion_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="fechacreacion_actualizacion iconos-crear"><i
                            class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.materialIsoVeinticiente.fields.fechacreacion_actualizacion') }}</label>
                    <input class="form-control date {{ $errors->has('fechacreacion_actualizacion') ? 'is-invalid' : '' }}"
                        type="text" name="fechacreacion_actualizacion" id="fechacreacion_actualizacion"
                        value="{{ old('fechacreacion_actualizacion') }}">
                    @if ($errors->has('fechacreacion_actualizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechacreacion_actualizacion') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.fechacreacion_actualizacion_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label for="materialarchivo"><i
                            class="fas fa-file-image iconos-crear"></i></i>{{ trans('cruds.materialIsoVeinticiente.fields.materialarchivo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('materialarchivo') ? 'is-invalid' : '' }}"
                        id="materialarchivo-dropzone">
                    </div>
                    @if ($errors->has('materialarchivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('materialarchivo') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.materialarchivo_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
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
        Dropzone.options.listaasistenciaDropzone = {
            url: '{{ route('admin.material-iso-veinticientes.storeMedia') }}',
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
                $('form').find('input[name="listaasistencia"]').remove()
                $('form').append('<input type="hidden" name="listaasistencia" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="listaasistencia"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($materialIsoVeinticiente) && $materialIsoVeinticiente->listaasistencia)
                    var file = {!! json_encode($materialIsoVeinticiente->listaasistencia) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="listaasistencia" value="' + file.file_name + '">')
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
        Dropzone.options.materialarchivoDropzone = {
            url: '{{ route('admin.material-iso-veinticientes.storeMedia') }}',
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
                $('form').find('input[name="materialarchivo"]').remove()
                $('form').append('<input type="hidden" name="materialarchivo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="materialarchivo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($materialIsoVeinticiente) && $materialIsoVeinticiente->materialarchivo)
                    var file = {!! json_encode($materialIsoVeinticiente->materialarchivo) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="materialarchivo" value="' + file.file_name + '">')
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
