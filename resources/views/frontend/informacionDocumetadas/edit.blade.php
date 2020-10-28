@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.informacionDocumetada.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.informacion-documetadas.update", [$informacionDocumetada->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="titulodocumento">{{ trans('cruds.informacionDocumetada.fields.titulodocumento') }}</label>
                            <input class="form-control" type="text" name="titulodocumento" id="titulodocumento" value="{{ old('titulodocumento', $informacionDocumetada->titulodocumento) }}" required>
                            @if($errors->has('titulodocumento'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('titulodocumento') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.titulodocumento_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.informacionDocumetada.fields.tipodocumento') }}</label>
                            <select class="form-control" name="tipodocumento" id="tipodocumento">
                                <option value disabled {{ old('tipodocumento', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\InformacionDocumetada::TIPODOCUMENTO_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('tipodocumento', $informacionDocumetada->tipodocumento) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tipodocumento'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tipodocumento') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.tipodocumento_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="identificador">{{ trans('cruds.informacionDocumetada.fields.identificador') }}</label>
                            <input class="form-control" type="text" name="identificador" id="identificador" value="{{ old('identificador', $informacionDocumetada->identificador) }}">
                            @if($errors->has('identificador'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('identificador') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.identificador_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="version">{{ trans('cruds.informacionDocumetada.fields.version') }}</label>
                            <input class="form-control" type="number" name="version" id="version" value="{{ old('version', $informacionDocumetada->version) }}" step="0.01" min="1" max="99">
                            @if($errors->has('version'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('version') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.version_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="politicas">{{ trans('cruds.informacionDocumetada.fields.politicas') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="politicas[]" id="politicas" multiple>
                                @foreach($politicas as $id => $politicas)
                                    <option value="{{ $id }}" {{ (in_array($id, old('politicas', [])) || $informacionDocumetada->politicas->contains($id)) ? 'selected' : '' }}>{{ $politicas }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('politicas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('politicas') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.politicas_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contenido">{{ trans('cruds.informacionDocumetada.fields.contenido') }}</label>
                            <textarea class="form-control" name="contenido" id="contenido">{{ old('contenido', $informacionDocumetada->contenido) }}</textarea>
                            @if($errors->has('contenido'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contenido') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.contenido_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="elaboro_id">{{ trans('cruds.informacionDocumetada.fields.elaboro') }}</label>
                            <select class="form-control select2" name="elaboro_id" id="elaboro_id">
                                @foreach($elaboros as $id => $elaboro)
                                    <option value="{{ $id }}" {{ (old('elaboro_id') ? old('elaboro_id') : $informacionDocumetada->elaboro->id ?? '') == $id ? 'selected' : '' }}>{{ $elaboro }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('elaboro'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('elaboro') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.elaboro_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="reviso_id">{{ trans('cruds.informacionDocumetada.fields.reviso') }}</label>
                            <select class="form-control select2" name="reviso_id" id="reviso_id">
                                @foreach($revisos as $id => $reviso)
                                    <option value="{{ $id }}" {{ (old('reviso_id') ? old('reviso_id') : $informacionDocumetada->reviso->id ?? '') == $id ? 'selected' : '' }}>{{ $reviso }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('reviso'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reviso') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.reviso_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="aprobacion_id">{{ trans('cruds.informacionDocumetada.fields.aprobacion') }}</label>
                            <select class="form-control select2" name="aprobacion_id" id="aprobacion_id">
                                @foreach($aprobacions as $id => $aprobacion)
                                    <option value="{{ $id }}" {{ (old('aprobacion_id') ? old('aprobacion_id') : $informacionDocumetada->aprobacion->id ?? '') == $id ? 'selected' : '' }}>{{ $aprobacion }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('aprobacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('aprobacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.aprobacion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="logotipo">{{ trans('cruds.informacionDocumetada.fields.logotipo') }}</label>
                            <div class="needsclick dropzone" id="logotipo-dropzone">
                            </div>
                            @if($errors->has('logotipo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('logotipo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.informacionDocumetada.fields.logotipo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.logotipoDropzone = {
    url: '{{ route('admin.informacion-documetadas.storeMedia') }}',
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
    success: function (file, response) {
      $('form').find('input[name="logotipo"]').remove()
      $('form').append('<input type="hidden" name="logotipo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logotipo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($informacionDocumetada) && $informacionDocumetada->logotipo)
      var file = {!! json_encode($informacionDocumetada->logotipo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logotipo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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