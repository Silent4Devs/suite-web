@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.evidenciasSgsi.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.evidencias-sgsis.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="objetivodocumento">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento') }}</label>
                            <input class="form-control" type="text" name="objetivodocumento" id="objetivodocumento" value="{{ old('objetivodocumento', '') }}" required>
                            @if($errors->has('objetivodocumento'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('objetivodocumento') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="responsable_id">{{ trans('cruds.evidenciasSgsi.fields.responsable') }}</label>
                            <select class="form-control select2" name="responsable_id" id="responsable_id">
                                @foreach($responsables as $id => $responsable)
                                    <option value="{{ $id }}" {{ old('responsable_id') == $id ? 'selected' : '' }}>{{ $responsable }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('responsable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('responsable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.responsable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="arearesponsable">{{ trans('cruds.evidenciasSgsi.fields.arearesponsable') }}</label>
                            <input class="form-control" type="text" name="arearesponsable" id="arearesponsable" value="{{ old('arearesponsable', '') }}">
                            @if($errors->has('arearesponsable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('arearesponsable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.arearesponsable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fechadocumento">{{ trans('cruds.evidenciasSgsi.fields.fechadocumento') }}</label>
                            <input class="form-control date" type="text" name="fechadocumento" id="fechadocumento" value="{{ old('fechadocumento') }}">
                            @if($errors->has('fechadocumento'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechadocumento') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.fechadocumento_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="archivopdf">{{ trans('cruds.evidenciasSgsi.fields.archivopdf') }}</label>
                            <div class="needsclick dropzone" id="archivopdf-dropzone">
                            </div>
                            @if($errors->has('archivopdf'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('archivopdf') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.archivopdf_helper') }}</span>
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
    success: function (file, response) {
      $('form').find('input[name="archivopdf"]').remove()
      $('form').append('<input type="hidden" name="archivopdf" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="archivopdf"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($evidenciasSgsi) && $evidenciasSgsi->archivopdf)
      var file = {!! json_encode($evidenciasSgsi->archivopdf) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="archivopdf" value="' + file.file_name + '">')
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