@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.concientizacionSgi.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.concientizacion-sgis.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="objetivocomunicado">{{ trans('cruds.concientizacionSgi.fields.objetivocomunicado') }}</label>
                            <input class="form-control" type="text" name="objetivocomunicado" id="objetivocomunicado" value="{{ old('objetivocomunicado', '') }}" required>
                            @if($errors->has('objetivocomunicado'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('objetivocomunicado') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.objetivocomunicado_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.concientizacionSgi.fields.personalobjetivo') }}</label>
                            <select class="form-control" name="personalobjetivo" id="personalobjetivo">
                                <option value disabled {{ old('personalobjetivo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ConcientizacionSgi::PERSONALOBJETIVO_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('personalobjetivo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('personalobjetivo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('personalobjetivo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.personalobjetivo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="arearesponsable_id">{{ trans('cruds.concientizacionSgi.fields.arearesponsable') }}</label>
                            <select class="form-control select2" name="arearesponsable_id" id="arearesponsable_id">
                                @foreach($arearesponsables as $id => $arearesponsable)
                                    <option value="{{ $id }}" {{ old('arearesponsable_id') == $id ? 'selected' : '' }}>{{ $arearesponsable }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('arearesponsable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('arearesponsable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.arearesponsable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.concientizacionSgi.fields.medio_envio') }}</label>
                            <select class="form-control" name="medio_envio" id="medio_envio">
                                <option value disabled {{ old('medio_envio', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ConcientizacionSgi::MEDIO_ENVIO_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('medio_envio', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('medio_envio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('medio_envio') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.medio_envio_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fecha_publicacion">{{ trans('cruds.concientizacionSgi.fields.fecha_publicacion') }}</label>
                            <input class="form-control date" type="text" name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fecha_publicacion') }}">
                            @if($errors->has('fecha_publicacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_publicacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.fecha_publicacion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="archivo">{{ trans('cruds.concientizacionSgi.fields.archivo') }}</label>
                            <div class="needsclick dropzone" id="archivo-dropzone">
                            </div>
                            @if($errors->has('archivo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('archivo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.archivo_helper') }}</span>
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
    success: function (file, response) {
      $('form').find('input[name="archivo"]').remove()
      $('form').append('<input type="hidden" name="archivo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="archivo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($concientizacionSgi) && $concientizacionSgi->archivo)
      var file = {!! json_encode($concientizacionSgi->archivo) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="archivo" value="' + file.file_name + '">')
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