@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.recurso.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.recursos.update", [$recurso->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-12">
                <label for="cursoscapacitaciones"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.recurso.fields.cursoscapacitaciones') }}</label>
                <input class="form-control {{ $errors->has('cursoscapacitaciones') ? 'is-invalid' : '' }}" type="text" name="cursoscapacitaciones" id="cursoscapacitaciones" value="{{ old('cursoscapacitaciones', $recurso->cursoscapacitaciones) }}">
                @if($errors->has('cursoscapacitaciones'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cursoscapacitaciones') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="fecha_curso"><i class="fas fa-calendar iconos-crear"></i>{{ trans('cruds.recurso.fields.fecha_curso') }}</label>
                <input class="form-control date {{ $errors->has('fecha_curso') ? 'is-invalid' : '' }}" type="text" name="fecha_curso" id="fecha_curso" value="{{ old('fecha_curso', $recurso->fecha_curso) }}">
                @if($errors->has('fecha_curso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_curso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recurso.fields.fecha_curso_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="participantes"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.recurso.fields.participantes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('participantes') ? 'is-invalid' : '' }}" name="participantes[]" id="participantes" multiple>
                    @foreach($participantes as $id => $participantes)
                        <option value="{{ $id }}" {{ (in_array($id, old('participantes', [])) || $recurso->participantes->contains($id)) ? 'selected' : '' }}>{{ $participantes }}</option>
                    @endforeach
                </select>
                @if($errors->has('participantes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participantes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="instructor"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.recurso.fields.instructor') }}</label>
                <input class="form-control {{ $errors->has('instructor') ? 'is-invalid' : '' }}" type="text" name="instructor" id="instructor" value="{{ old('instructor', $recurso->instructor) }}">
                @if($errors->has('instructor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instructor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recurso.fields.instructor_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="certificado"><i class="fas fa-graduation-cap iconos-crear"></i>{{ trans('cruds.recurso.fields.certificado') }}</label>
                <div class="needsclick dropzone {{ $errors->has('certificado') ? 'is-invalid' : '' }}" id="certificado-dropzone">
                </div>
                @if($errors->has('certificado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('certificado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recurso.fields.certificado_helper') }}</span>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedCertificadoMap = {}
Dropzone.options.certificadoDropzone = {
    url: '{{ route('admin.recursos.storeMedia') }}',
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