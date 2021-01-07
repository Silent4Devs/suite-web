@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.recurso.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.recursos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="cursoscapacitaciones">{{ trans('cruds.recurso.fields.cursoscapacitaciones') }}</label>
                            <textarea class="form-control" name="cursoscapacitaciones" id="cursoscapacitaciones">{{ old('cursoscapacitaciones') }}</textarea>
                            @if($errors->has('cursoscapacitaciones'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cursoscapacitaciones') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fecha_curso">{{ trans('cruds.recurso.fields.fecha_curso') }}</label>
                            <input class="form-control date" type="text" name="fecha_curso" id="fecha_curso" value="{{ old('fecha_curso') }}">
                            @if($errors->has('fecha_curso'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fecha_curso') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.recurso.fields.fecha_curso_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="participantes">{{ trans('cruds.recurso.fields.participantes') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="participantes[]" id="participantes" multiple>
                                @foreach($participantes as $id => $participantes)
                                    <option value="{{ $id }}" {{ in_array($id, old('participantes', [])) ? 'selected' : '' }}>{{ $participantes }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('participantes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('participantes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="instructor">{{ trans('cruds.recurso.fields.instructor') }}</label>
                            <input class="form-control" type="text" name="instructor" id="instructor" value="{{ old('instructor', '') }}">
                            @if($errors->has('instructor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('instructor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.recurso.fields.instructor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="certificado">{{ trans('cruds.recurso.fields.certificado') }}</label>
                            <div class="needsclick dropzone" id="certificado-dropzone">
                            </div>
                            @if($errors->has('certificado'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('certificado') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.recurso.fields.certificado_helper') }}</span>
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
    var uploadedCertificadoMap = {}
Dropzone.options.certificadoDropzone = {
    url: '{{ route('frontend.recursos.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="certificado[]" value="' + response.name + '">')
      uploadedCertificadoMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCertificadoMap[file.name]
      }
      $('form').find('input[name="certificado[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($recurso) && $recurso->certificado)
          var files =
            {!! json_encode($recurso->certificado) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="certificado[]" value="' + file.file_name + '">')
            }
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