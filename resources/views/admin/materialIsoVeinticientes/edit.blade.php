@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.materialIsoVeinticiente.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.material-iso-veinticientes.update", [$materialIsoVeinticiente->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="objetivo">{{ trans('cruds.materialIsoVeinticiente.fields.objetivo') }}</label>
                <input class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" type="text" name="objetivo" id="objetivo" value="{{ old('objetivo', $materialIsoVeinticiente->objetivo) }}" required>
                @if($errors->has('objetivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.objetivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="listaasistencia">{{ trans('cruds.materialIsoVeinticiente.fields.listaasistencia') }}</label>
                <div class="needsclick dropzone {{ $errors->has('listaasistencia') ? 'is-invalid' : '' }}" id="listaasistencia-dropzone">
                </div>
                @if($errors->has('listaasistencia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('listaasistencia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.listaasistencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="arearesponsable_id">{{ trans('cruds.materialIsoVeinticiente.fields.arearesponsable') }}</label>
                <select class="form-control select2 {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}" name="arearesponsable_id" id="arearesponsable_id">
                    @foreach($arearesponsables as $id => $arearesponsable)
                        <option value="{{ $id }}" {{ (old('arearesponsable_id') ? old('arearesponsable_id') : $materialIsoVeinticiente->arearesponsable->id ?? '') == $id ? 'selected' : '' }}>{{ $arearesponsable }}</option>
                    @endforeach
                </select>
                @if($errors->has('arearesponsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arearesponsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.arearesponsable_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.materialIsoVeinticiente.fields.tipoimparticion') }}</label>
                <select class="form-control {{ $errors->has('tipoimparticion') ? 'is-invalid' : '' }}" name="tipoimparticion" id="tipoimparticion">
                    <option value disabled {{ old('tipoimparticion', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MaterialIsoVeinticiente::TIPOIMPARTICION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tipoimparticion', $materialIsoVeinticiente->tipoimparticion) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipoimparticion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipoimparticion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.tipoimparticion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fechacreacion_actualizacion">{{ trans('cruds.materialIsoVeinticiente.fields.fechacreacion_actualizacion') }}</label>
                <input class="form-control date {{ $errors->has('fechacreacion_actualizacion') ? 'is-invalid' : '' }}" type="text" name="fechacreacion_actualizacion" id="fechacreacion_actualizacion" value="{{ old('fechacreacion_actualizacion', $materialIsoVeinticiente->fechacreacion_actualizacion) }}">
                @if($errors->has('fechacreacion_actualizacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechacreacion_actualizacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.fechacreacion_actualizacion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="materialarchivo">{{ trans('cruds.materialIsoVeinticiente.fields.materialarchivo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('materialarchivo') ? 'is-invalid' : '' }}" id="materialarchivo-dropzone">
                </div>
                @if($errors->has('materialarchivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('materialarchivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialIsoVeinticiente.fields.materialarchivo_helper') }}</span>
            </div>
            <div class="form-group">
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
    success: function (file, response) {
      $('form').find('input[name="listaasistencia"]').remove()
      $('form').append('<input type="hidden" name="listaasistencia" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="listaasistencia"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($materialIsoVeinticiente) && $materialIsoVeinticiente->listaasistencia)
      var file = {!! json_encode($materialIsoVeinticiente->listaasistencia) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="listaasistencia" value="' + file.file_name + '">')
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
    success: function (file, response) {
      $('form').find('input[name="materialarchivo"]').remove()
      $('form').append('<input type="hidden" name="materialarchivo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="materialarchivo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($materialIsoVeinticiente) && $materialIsoVeinticiente->materialarchivo)
      var file = {!! json_encode($materialIsoVeinticiente->materialarchivo) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="materialarchivo" value="' + file.file_name + '">')
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