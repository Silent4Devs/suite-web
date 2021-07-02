@extends('layouts.admin')
@section('content')
    
    {{ Breadcrumbs::render('admin.evidencias-sgsis.create') }}

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
          <h3 class="mb-1  text-center text-white"> <strong>Editar:</strong> Evidencias de Asignación de Recursos al SGSI</h3>
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.evidencias-sgsis.update", [$evidenciasSgsi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-md-6">
                <label class="required" for="objetivodocumento"><i class="far fa-file iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento') }}</label>
                <input class="form-control {{ $errors->has('objetivodocumento') ? 'is-invalid' : '' }}" type="text" name="objetivodocumento" id="objetivodocumento" value="{{ old('objetivodocumento', $evidenciasSgsi->objetivodocumento) }}" required>
                @if($errors->has('objetivodocumento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivodocumento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="responsable_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.responsable') }}</label>
                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}" name="responsable_id" id="responsable_id">
                    @foreach($responsables as $id => $responsable)
                        <option value="{{ $id }}" {{ (old('responsable_id') ? old('responsable_id') : $evidenciasSgsi->responsable->id ?? '') == $id ? 'selected' : '' }}>{{ $responsable }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.responsable_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="arearesponsable"><i class="fas fa-chart-area iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.arearesponsable') }}</label>
                <input class="form-control {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}" type="text" name="arearesponsable" id="arearesponsable" value="{{ old('arearesponsable', $evidenciasSgsi->arearesponsable) }}">
                @if($errors->has('arearesponsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arearesponsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.arearesponsable_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="fechadocumento"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.fechadocumento') }}</label>
                <input class="form-control date {{ $errors->has('fechadocumento') ? 'is-invalid' : '' }}" type="text" name="fechadocumento" id="fechadocumento" value="{{ old('fechadocumento', $evidenciasSgsi->fechadocumento) }}">
                @if($errors->has('fechadocumento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechadocumento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.fechadocumento_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="archivopdf"><i class="far fa-file-pdf iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.archivopdf') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivopdf') ? 'is-invalid' : '' }}" id="archivopdf-dropzone">
                </div>
                @if($errors->has('archivopdf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivopdf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.archivopdf_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right">
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