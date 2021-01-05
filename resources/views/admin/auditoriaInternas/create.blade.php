@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Auditoría Interna </h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.auditoria-internas.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-12">
                <label class="required" for="alcance"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.alcance') }}</label>
                <input class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" type="text" name="alcance" id="alcance" value="{{ old('alcance', '') }}" required>
                @if($errors->has('alcance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alcance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="clausulas_id"><i class="fas fa-grip-horizontal iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.clausulas') }}</label>
                <select class="form-control select2 {{ $errors->has('clausulas') ? 'is-invalid' : '' }}" name="clausulas_id" id="clausulas_id">
                    @foreach($clausulas as $id => $clausulas)
                        <option value="{{ $id }}" {{ old('clausulas_id') == $id ? 'selected' : '' }}>{{ $clausulas }}</option>
                    @endforeach
                </select>
                @if($errors->has('clausulas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clausulas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.clausulas_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="fechaauditoria"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.fechaauditoria') }}</label>
                <input class="form-control date {{ $errors->has('fechaauditoria') ? 'is-invalid' : '' }}" type="text" name="fechaauditoria" id="fechaauditoria" value="{{ old('fechaauditoria') }}">
                @if($errors->has('fechaauditoria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechaauditoria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.fechaauditoria_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="auditorlider_id"><i class="fas fa-user-tie iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.auditorlider') }}</label>
                <select class="form-control select2 {{ $errors->has('auditorlider') ? 'is-invalid' : '' }}" name="auditorlider_id" id="auditorlider_id">
                    @foreach($auditorliders as $id => $auditorlider)
                        <option value="{{ $id }}" {{ old('auditorlider_id') == $id ? 'selected' : '' }}>{{ $auditorlider }}</option>
                    @endforeach
                </select>
                @if($errors->has('auditorlider'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auditorlider') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.auditorlider_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="equipoauditoria_id"><i class="fas fa-users iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.equipoauditoria') }}</label>
                <select class="form-control select2 {{ $errors->has('equipoauditoria') ? 'is-invalid' : '' }}" name="equipoauditoria_id" id="equipoauditoria_id">
                    @foreach($equipoauditorias as $id => $equipoauditoria)
                        <option value="{{ $id }}" {{ old('equipoauditoria_id') == $id ? 'selected' : '' }}>{{ $equipoauditoria }}</option>
                    @endforeach
                </select>
                @if($errors->has('equipoauditoria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('equipoauditoria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.equipoauditoria_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="hallazgos"><i class="fas fa-microscope iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.hallazgos') }}</label>
                <textarea class="form-control {{ $errors->has('hallazgos') ? 'is-invalid' : '' }}" name="hallazgos" id="hallazgos">{{ old('hallazgos') }}</textarea>
                @if($errors->has('hallazgos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hallazgos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.hallazgos_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <div class="form-check {{ $errors->has('cheknoconformidadmenor') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="cheknoconformidadmenor" value="0">
                    <input class="form-check-input" type="checkbox" name="cheknoconformidadmenor" id="cheknoconformidadmenor" value="1" {{ old('cheknoconformidadmenor', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="cheknoconformidadmenor">{{ trans('cruds.auditoriaInterna.fields.cheknoconformidadmenor') }}</label>
                </div>
                @if($errors->has('cheknoconformidadmenor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cheknoconformidadmenor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.cheknoconformidadmenor_helper') }}</span>
            </div>
            <div class="form-group col-md-9">
                <label for="totalnoconformidadmenor">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmenor') }}</label>
                <input class="form-control {{ $errors->has('totalnoconformidadmenor') ? 'is-invalid' : '' }}" type="number" name="totalnoconformidadmenor" id="totalnoconformidadmenor" value="{{ old('totalnoconformidadmenor', '') }}" step="0.01" max="99">
                @if($errors->has('totalnoconformidadmenor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('totalnoconformidadmenor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmenor_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <div class="form-check {{ $errors->has('checknoconformidadmayor') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="checknoconformidadmayor" value="0">
                    <input class="form-check-input" type="checkbox" name="checknoconformidadmayor" id="checknoconformidadmayor" value="1" {{ old('checknoconformidadmayor', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="checknoconformidadmayor">{{ trans('cruds.auditoriaInterna.fields.checknoconformidadmayor') }}</label>
                </div>
                @if($errors->has('checknoconformidadmayor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('checknoconformidadmayor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.checknoconformidadmayor_helper') }}</span>
            </div>
            <div class="form-group col-md-9">
                <label for="totalnoconformidadmayor">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmayor') }}</label>
                <input class="form-control {{ $errors->has('totalnoconformidadmayor') ? 'is-invalid' : '' }}" type="number" name="totalnoconformidadmayor" id="totalnoconformidadmayor" value="{{ old('totalnoconformidadmayor', '') }}" step="0.01" max="99">
                @if($errors->has('totalnoconformidadmayor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('totalnoconformidadmayor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmayor_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <div class="form-check {{ $errors->has('checkobservacion') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="checkobservacion" value="0">
                    <input class="form-check-input" type="checkbox" name="checkobservacion" id="checkobservacion" value="1" {{ old('checkobservacion', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="checkobservacion">{{ trans('cruds.auditoriaInterna.fields.checkobservacion') }}</label>
                </div>
                @if($errors->has('checkobservacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('checkobservacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.checkobservacion_helper') }}</span>
            </div>
            <div class="form-group col-md-9">
                <label for="totalobservacion">{{ trans('cruds.auditoriaInterna.fields.totalobservacion') }}</label>
                <input class="form-control {{ $errors->has('totalobservacion') ? 'is-invalid' : '' }}" type="number" name="totalobservacion" id="totalobservacion" value="{{ old('totalobservacion', '') }}" step="0.01" max="99">
                @if($errors->has('totalobservacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('totalobservacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalobservacion_helper') }}</span>
            </div>
            <div class="form-group col-md-3">
                <div class="form-check {{ $errors->has('checkmejora') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="checkmejora" value="0">
                    <input class="form-check-input" type="checkbox" name="checkmejora" id="checkmejora" value="1" {{ old('checkmejora', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="checkmejora">{{ trans('cruds.auditoriaInterna.fields.checkmejora') }}</label>
                </div>
                @if($errors->has('checkmejora'))
                    <div class="invalid-feedback">
                        {{ $errors->first('checkmejora') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.checkmejora_helper') }}</span>
            </div>
            <div class="form-group col-md-9">
                <label for="totalmejora">{{ trans('cruds.auditoriaInterna.fields.totalmejora') }}</label>
                <input class="form-control {{ $errors->has('totalmejora') ? 'is-invalid' : '' }}" type="number" name="totalmejora" id="totalmejora" value="{{ old('totalmejora', '') }}" step="0.01" max="99">
                @if($errors->has('totalmejora'))
                    <div class="invalid-feedback">
                        {{ $errors->first('totalmejora') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalmejora_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="logotipo"><i class="fas fa-image iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.logotipo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logotipo') ? 'is-invalid' : '' }}" id="logotipo-dropzone">
                </div>
                @if($errors->has('logotipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logotipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.logotipo_helper') }}</span>
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
    Dropzone.options.logotipoDropzone = {
    url: '{{ route('admin.auditoria-internas.storeMedia') }}',
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
@if(isset($auditoriaInterna) && $auditoriaInterna->logotipo)
      var file = {!! json_encode($auditoriaInterna->logotipo) !!}
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
