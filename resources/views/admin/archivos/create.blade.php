@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.archivo.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.archivos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="carpeta_id">{{ trans('cruds.archivo.fields.carpeta') }}</label>
                    <select class="form-control select2 {{ $errors->has('carpeta') ? 'is-invalid' : '' }}" name="carpeta_id"
                        id="carpeta_id" required>
                        @foreach ($carpetas as $id => $carpeta)
                            <option value="{{ $id }}" {{ old('carpeta_id') == $id ? 'selected' : '' }}>
                                {{ $carpeta }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('carpeta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('carpeta') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.archivo.fields.carpeta_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="nombre">{{ trans('cruds.archivo.fields.nombre') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="nombre-dropzone">
                    </div>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.archivo.fields.nombre_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="estado_id">{{ trans('cruds.archivo.fields.estado') }}</label>
                    <select class="form-control select2 {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado_id"
                        id="estado_id">
                        @foreach ($estados as $id => $estado)
                            <option value="{{ $id }}" {{ old('estado_id') == $id ? 'selected' : '' }}>
                                {{ $estado }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('estado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estado') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.archivo.fields.estado_helper') }}</span>
                </div>
                <div class="form-group">
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
        Dropzone.options.nombreDropzone = {
            url: '{{ route('admin.archivos.storeMedia') }}',
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
                $('form').find('input[name="nombre"]').remove()
                $('form').append('<input type="hidden" name="nombre" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="nombre"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($archivo) && $archivo->nombre)
                    var file = {!! json_encode($archivo->nombre) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="nombre" value="' + file.file_name + '">')
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
