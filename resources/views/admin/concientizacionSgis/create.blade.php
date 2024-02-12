@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.concientizacion-sgis.create') }}
    <h5 class="col-12 titulo_general_funcion">Concientización SGSI</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <br>
                <h4>¿Qué es Concientización SGSI?</h4>
                <p>
                    Proporcionar el conocimiento y la comprensión necesarios para ser parte activa en la seguridad de la información.
                </p>
                <p>
                    Implica que todos los miembros de la organización, desde la alta dirección hasta los empleados de todos los niveles, estén conscientes de los riesgos asociados con la seguridad de la información.
                </p>
            </div>
        </div>
    </div>
<div class="card mt-4">


    <div class="card-body">
        <form method="POST" action="{{ route("admin.concientizacion-sgis.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-12">
                <label class="required" for="objetivocomunicado"><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.objetivocomunicado') }}</label>
                <input class="form-control {{ $errors->has('objetivocomunicado') ? 'is-invalid' : '' }}" type="text"
                name="objetivocomunicado" id="objetivocomunicado" value="{{ old('objetivocomunicado', '') }}" required>
                @if($errors->has('objetivocomunicado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivocomunicado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.objetivocomunicado_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required"><i class="fas fa-user iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.personalobjetivo') }}</label>
                <select required class="form-control {{ $errors->has('personalobjetivo') ? 'is-invalid' : '' }}"
                    name="personalobjetivo" id="personalobjetivo">
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
            <div class="form-group col-md-6">
                <label class="required" for="arearesponsable_id"><i class="fas fa-chart-area iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.arearesponsable') }}</label>
                <select class="form-control select2 {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}"
                    name="arearesponsable_id" id="arearesponsable_id" required>
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
            <div class="form-group col-md-6">
                <label class="required"><i class="fas fa-pager iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.medio_envio') }}</label>
                <select class="form-control {{ $errors->has('medio_envio') ? 'is-invalid' : '' }}"
                    name="medio_envio" id="medio_envio" required>
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
            <div class="form-group col-md-6">
                <label class="required" for="fecha_publicacion"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.concientizacionSgi.fields.fecha_publicacion') }}</label>
                <input class="form-control date {{ $errors->has('fecha_publicacion') ? 'is-invalid' : '' }}" type="date" min="1945-01-01"
                name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fecha_publicacion') }}" required>
                @if($errors->has('fecha_publicacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_publicacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.concientizacionSgi.fields.fecha_publicacion_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="documento"><i class="fas fa-folder-open iconos-crear"></i>Archivo</label>
                <input type="file" name="files[]" multiple class="form-control" id="documento" accept="application/pdf" value="{{ old('files[]') }}">
            </div>
            <div class="form-group col-12 text-right">
                <a href="{{ route("admin.concientizacion-sgis.index") }}" class="btn_cancelar">Cancelar</a>
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
