@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center" style="margin-top: -40px">
         <h3 class="mb-1  text-center text-white">
        {{ trans('global.create') }} {{ trans('cruds.minutasaltadireccion.title_singular') }} </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.minutasaltadireccions.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-12">
                <label for="objetivoreunion">{{ trans('cruds.minutasaltadireccion.fields.objetivoreunion') }}</label>
                <textarea class="form-control {{ $errors->has('objetivoreunion') ? 'is-invalid' : '' }}" name="objetivoreunion" id="objetivoreunion">{{ old('objetivoreunion') }}</textarea>
                @if($errors->has('objetivoreunion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivoreunion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.minutasaltadireccion.fields.objetivoreunion_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="responsablereunion_id">{{ trans('cruds.minutasaltadireccion.fields.responsablereunion') }}</label>
                <select class="form-control select2 {{ $errors->has('responsablereunion') ? 'is-invalid' : '' }}" name="responsablereunion_id" id="responsablereunion_id">
                    @foreach($responsablereunions as $id => $responsablereunion)
                        <option value="{{ $id }}" {{ old('responsablereunion_id') == $id ? 'selected' : '' }}>{{ $responsablereunion }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsablereunion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsablereunion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.minutasaltadireccion.fields.responsablereunion_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="arearesponsable">{{ trans('cruds.minutasaltadireccion.fields.arearesponsable') }}</label>
                <input class="form-control {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}" type="text" name="arearesponsable" id="arearesponsable" value="{{ old('arearesponsable', '') }}">
                @if($errors->has('arearesponsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arearesponsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.minutasaltadireccion.fields.arearesponsable_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <label for="fechareunion">{{ trans('cruds.minutasaltadireccion.fields.fechareunion') }}</label>
                <input class="form-control date {{ $errors->has('fechareunion') ? 'is-invalid' : '' }}" type="text" name="fechareunion" id="fechareunion" value="{{ old('fechareunion') }}">
                @if($errors->has('fechareunion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechareunion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.minutasaltadireccion.fields.fechareunion_helper') }}</span>
            </div>
            <div class="form-group col-md-9">
                <label for="archivo">{{ trans('cruds.minutasaltadireccion.fields.archivo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
                </div>
                @if($errors->has('archivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.minutasaltadireccion.fields.archivo_helper') }}</span>
            </div>
            <div class="form-group col-12">
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
    Dropzone.options.archivoDropzone = {
    url: '{{ route('admin.minutasaltadireccions.storeMedia') }}',
    maxFilesize: 6, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 6
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
@if(isset($minutasaltadireccion) && $minutasaltadireccion->archivo)
      var file = {!! json_encode($minutasaltadireccion->archivo) !!}
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