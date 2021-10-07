@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.accionCorrectiva.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.accion-correctivas.update", [$accionCorrectiva->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="fecharegistro">{{ trans('cruds.accionCorrectiva.fields.fecharegistro') }}</label>
                <input class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}" type="text" name="fecharegistro" id="fecharegistro" value="{{ old('fecharegistro', $accionCorrectiva->fecharegistro) }}">
                @if($errors->has('fecharegistro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecharegistro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.fecharegistro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nombrereporta_id">{{ trans('cruds.accionCorrectiva.fields.nombrereporta') }}</label>
                <select class="form-control select2 {{ $errors->has('nombrereporta') ? 'is-invalid' : '' }}" name="nombrereporta_id" id="nombrereporta_id">
                    @foreach($nombrereportas as $id => $nombrereporta)
                        <option value="{{ $id }}" {{ (old('nombrereporta_id') ? old('nombrereporta_id') : $accionCorrectiva->nombrereporta->id ?? '') == $id ? 'selected' : '' }}>{{ $nombrereporta }}</option>
                    @endforeach
                </select>
                @if($errors->has('nombrereporta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombrereporta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.nombrereporta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="puestoreporta_id">{{ trans('cruds.accionCorrectiva.fields.puestoreporta') }}</label>
                <select class="form-control select2 {{ $errors->has('puestoreporta') ? 'is-invalid' : '' }}" name="puestoreporta_id" id="puestoreporta_id">
                    @foreach($puestoreportas as $id => $puestoreporta)
                        <option value="{{ $id }}" {{ (old('puestoreporta_id') ? old('puestoreporta_id') : $accionCorrectiva->puestoreporta->id ?? '') == $id ? 'selected' : '' }}>{{ $puestoreporta }}</option>
                    @endforeach
                </select>
                @if($errors->has('puestoreporta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('puestoreporta') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.puestoreporta_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nombreregistra_id">{{ trans('cruds.accionCorrectiva.fields.nombreregistra') }}</label>
                <select class="form-control select2 {{ $errors->has('nombreregistra') ? 'is-invalid' : '' }}" name="nombreregistra_id" id="nombreregistra_id">
                    @foreach($nombreregistras as $id => $nombreregistra)
                        <option value="{{ $id }}" {{ (old('nombreregistra_id') ? old('nombreregistra_id') : $accionCorrectiva->nombreregistra->id ?? '') == $id ? 'selected' : '' }}>{{ $nombreregistra }}</option>
                    @endforeach
                </select>
                @if($errors->has('nombreregistra'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombreregistra') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.nombreregistra_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="puestoregistra_id">{{ trans('cruds.accionCorrectiva.fields.puestoregistra') }}</label>
                <select class="form-control select2 {{ $errors->has('puestoregistra') ? 'is-invalid' : '' }}" name="puestoregistra_id" id="puestoregistra_id">
                    @foreach($puestoregistras as $id => $puestoregistra)
                        <option value="{{ $id }}" {{ (old('puestoregistra_id') ? old('puestoregistra_id') : $accionCorrectiva->puestoregistra->id ?? '') == $id ? 'selected' : '' }}>{{ $puestoregistra }}</option>
                    @endforeach
                </select>
                @if($errors->has('puestoregistra'))
                    <div class="invalid-feedback">
                        {{ $errors->first('puestoregistra') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.puestoregistra_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tema">{{ trans('cruds.accionCorrectiva.fields.tema') }}</label>
                <textarea class="form-control {{ $errors->has('tema') ? 'is-invalid' : '' }}" name="tema" id="tema">{{ old('tema', $accionCorrectiva->tema) }}</textarea>
                @if($errors->has('tema'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tema') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.tema_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.accionCorrectiva.fields.causaorigen') }}</label>
                <select class="form-control {{ $errors->has('causaorigen') ? 'is-invalid' : '' }}" name="causaorigen" id="causaorigen">
                    <option value disabled {{ old('causaorigen', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('causaorigen', $accionCorrectiva->causaorigen) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('causaorigen'))
                    <div class="invalid-feedback">
                        {{ $errors->first('causaorigen') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.causaorigen_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.accionCorrectiva.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $accionCorrectiva->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.descripcion_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.accionCorrectiva.fields.metodo_causa') }}</label>
                <select class="form-control {{ $errors->has('metodo_causa') ? 'is-invalid' : '' }}" name="metodo_causa" id="metodo_causa">
                    <option value disabled {{ old('metodo_causa', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AccionCorrectiva::METODO_CAUSA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('metodo_causa', $accionCorrectiva->metodo_causa) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('metodo_causa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('metodo_causa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.metodo_causa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="solucion">{{ trans('cruds.accionCorrectiva.fields.solucion') }}</label>
                <textarea class="form-control {{ $errors->has('solucion') ? 'is-invalid' : '' }}" name="solucion" id="solucion">{{ old('solucion', $accionCorrectiva->solucion) }}</textarea>
                @if($errors->has('solucion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('solucion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.solucion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cierre_accion">{{ trans('cruds.accionCorrectiva.fields.cierre_accion') }}</label>
                <textarea class="form-control {{ $errors->has('cierre_accion') ? 'is-invalid' : '' }}" name="cierre_accion" id="cierre_accion">{{ old('cierre_accion', $accionCorrectiva->cierre_accion) }}</textarea>
                @if($errors->has('cierre_accion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cierre_accion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.cierre_accion_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.accionCorrectiva.fields.estatus') }}</label>
                <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus" id="estatus">
                    <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AccionCorrectiva::ESTATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estatus', $accionCorrectiva->estatus) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estatus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.estatus_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fecha_compromiso">{{ trans('cruds.accionCorrectiva.fields.fecha_compromiso') }}</label>
                <input class="form-control date {{ $errors->has('fecha_compromiso') ? 'is-invalid' : '' }}" type="text" name="fecha_compromiso" id="fecha_compromiso" value="{{ old('fecha_compromiso', $accionCorrectiva->fecha_compromiso) }}">
                @if($errors->has('fecha_compromiso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_compromiso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.fecha_compromiso_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fecha_verificacion">{{ trans('cruds.accionCorrectiva.fields.fecha_verificacion') }}</label>
                <input class="form-control date {{ $errors->has('fecha_verificacion') ? 'is-invalid' : '' }}" type="text" name="fecha_verificacion" id="fecha_verificacion" value="{{ old('fecha_verificacion', $accionCorrectiva->fecha_verificacion) }}">
                @if($errors->has('fecha_verificacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_verificacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.fecha_verificacion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="responsable_accion_id">{{ trans('cruds.accionCorrectiva.fields.responsable_accion') }}</label>
                <select class="form-control select2 {{ $errors->has('responsable_accion') ? 'is-invalid' : '' }}" name="responsable_accion_id" id="responsable_accion_id">
                    @foreach($responsable_accions as $id => $responsable_accion)
                        <option value="{{ $id }}" {{ (old('responsable_accion_id') ? old('responsable_accion_id') : $accionCorrectiva->responsable_accion->id ?? '') == $id ? 'selected' : '' }}>{{ $responsable_accion }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsable_accion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsable_accion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.responsable_accion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nombre_autoriza_id">{{ trans('cruds.accionCorrectiva.fields.nombre_autoriza') }}</label>
                <select class="form-control select2 {{ $errors->has('nombre_autoriza') ? 'is-invalid' : '' }}" name="nombre_autoriza_id" id="nombre_autoriza_id">
                    @foreach($nombre_autorizas as $id => $nombre_autoriza)
                        <option value="{{ $id }}" {{ (old('nombre_autoriza_id') ? old('nombre_autoriza_id') : $accionCorrectiva->nombre_autoriza->id ?? '') == $id ? 'selected' : '' }}>{{ $nombre_autoriza }}</option>
                    @endforeach
                </select>
                @if($errors->has('nombre_autoriza'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre_autoriza') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.nombre_autoriza_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="documentometodo">{{ trans('cruds.accionCorrectiva.fields.documentometodo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('documentometodo') ? 'is-invalid' : '' }}" id="documentometodo-dropzone">
                </div>
                @if($errors->has('documentometodo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documentometodo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.documentometodo_helper') }}</span>
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
    Dropzone.options.documentometodoDropzone = {
    url: '{{ route('admin.accion-correctivas.storeMedia') }}',
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
      $('form').find('input[name="documentometodo"]').remove()
      $('form').append('<input type="hidden" name="documentometodo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="documentometodo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($accionCorrectiva) && $accionCorrectiva->documentometodo)
      var file = {!! json_encode($accionCorrectiva->documentometodo) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="documentometodo" value="' + file.file_name + '">')
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
