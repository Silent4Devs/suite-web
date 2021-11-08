@extends('layouts.frontend')
@section('content')

<style type="text/css">
    
    .select2-selection--multiple {
        overflow: hidden !important;
        height: auto !important;
        padding: 0 5px 5px 5px !important;
    }

    .select2-container {
        margin-top: 10px !important;
    }

</style>

    <!-- {{ Breadcrumbs::render('frontend.auditoria-internas.create') }} -->

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Auditoría Interna </h3>
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("auditoria-internas.update", [$auditoriaInterna->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-12">
                <label class="required" for="alcance"><i class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.alcance') }}</label>
                <input class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" type="text" name="alcance" id="alcance" value="{{ old('alcance', $auditoriaInterna->alcance) }}" required>
                @if($errors->has('alcance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alcance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
            </div>
            <div class="form-group col-sm-12">
                <label for="clausulas"><i class="far fa-file iconos-crear"></i> Cláusula(s)</label>
                <select class="form-control {{ $errors->has('clausulas') ? 'is-invalid' : '' }}" name="clausulas[]"
                    id="clausulas" multiple>
                    <!-- <option value disabled >Selecciona una opción</option> -->
                    @foreach ($clausulas as $clausula)
                        <option value="{{ $clausula->id }}" {{ in_array(old('clausulas',$clausula->id),$auditoriaInterna->clausulas->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $clausula->nombre }} 
                        </option>
                    @endforeach
                </select>
                <span class="errors tipo_error"></span>
            </div>
            
            <div class="form-group col-md-6">
                <label for="fecha_inicio"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha
                    Inicio</label>
                <input class="form-control" type="datetime-local" id="fecha_inicio"
                    name="fecha_inicio" value="{{ old('fecha_inicio',\Carbon\Carbon::parse($auditoriaInterna->fecha_inicio)->format('Y-m-d\TH:i')) }}">
                @if ($errors->has('fecha_inicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_inicio') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-12 col-md-12 col-lg-6">
                <label for="fecha_fin"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha
                    Fin</label>
                <input class="form-control" type="datetime-local" id="fecha_fin" name="fecha_fin"
                    value="{{ old('fecha_fin', \Carbon\Carbon::parse($auditoriaInterna->fecha_fin)->format('Y-m-d\TH:i')) }}">
                @if ($errors->has('fecha_fin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_fin') }}
                    </div>
                @endif
            </div>
  


            <div class="form-group col-md-6">
                <label for="auditorlider_id"><i class="fas fa-user-tie iconos-crear"></i>{{ trans('cruds.auditoriaInterna.fields.auditorlider') }}</label>
                <select class="form-control select2 {{ $errors->has('auditorlider') ? 'is-invalid' : '' }}" name="lider_id" id="auditorlider_id">
                    @foreach($auditorliders as $auditorlider)
                        <option value="{{ $auditorlider->id }}" {{ old('lider_id', $auditoriaInterna->lider_id) == $auditorlider->id ? 'selected' : '' }}>{{ $auditorlider->name }}</option>
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
                <select multiple class="form-control select2 {{ $errors->has('equipoauditoria') ? 'is-invalid' : '' }}" name="equipo[]" id="equipoauditoria_id">
                    @foreach($equipoauditorias as $equipoauditoria)
                        <option value="{{ $equipoauditoria->id }}" {{ in_array(old('equipo',$equipoauditoria->id),$auditoriaInterna->equipo->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $equipoauditoria->name }}</option>
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
                <textarea class="form-control {{ $errors->has('hallazgos') ? 'is-invalid' : '' }}" name="hallazgos" id="hallazgos">{{ old('hallazgos', $auditoriaInterna->hallazgos) }}</textarea>
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
                    <input class="form-check-input" type="checkbox" name="cheknoconformidadmenor" id="cheknoconformidadmenor" value="1" {{ old('cheknoconformidadmenor', $auditoriaInterna->cheknoconformidadmenor) == 1 ? 'checked' : '' }}>
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
                <input class="form-control {{ $errors->has('totalnoconformidadmenor') ? 'is-invalid' : '' }}" type="number" name="totalnoconformidadmenor" id="totalnoconformidadmenor" value="{{ old('totalnoconformidadmenor', $auditoriaInterna->totalnoconformidadmenor) }}">
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
                    <input class="form-check-input" type="checkbox" name="checknoconformidadmayor" id="checknoconformidadmayor" value="1" {{ old('checknoconformidadmayor', $auditoriaInterna->checknoconformidadmayor) == 1 ? 'checked' : '' }}>
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
                <input class="form-control {{ $errors->has('totalnoconformidadmayor') ? 'is-invalid' : '' }}" type="number" name="totalnoconformidadmayor" id="totalnoconformidadmayor" value="{{ old('totalnoconformidadmayor', $auditoriaInterna->totalnoconformidadmayor) }}" step="0.01" max="99">
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
                    <input class="form-check-input" type="checkbox" name="checkobservacion" id="checkobservacion" value="1" {{ old('checkobservacion', $auditoriaInterna->checkobservacion) == 1 ? 'checked' : '' }}>
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
                <input class="form-control {{ $errors->has('totalobservacion') ? 'is-invalid' : '' }}" type="number" name="totalobservacion" id="totalobservacion" value="{{ old('totalobservacion', $auditoriaInterna->totalobservacion) }}" step="0.01" max="99">
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
                    <input class="form-check-input" type="checkbox" name="checkmejora" id="checkmejora" value="1" {{ old('checkmejora', $auditoriaInterna->checkmejora) == 1 ? 'checked' : '' }}>
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
                <input class="form-control {{ $errors->has('totalmejora') ? 'is-invalid' : '' }}" type="number" name="totalmejora" id="totalmejora" value="{{ old('totalmejora', $auditoriaInterna->totalmejora) }}" step="0.01" max="99">
                @if($errors->has('totalmejora'))
                    <div class="invalid-feedback">
                        {{ $errors->first('totalmejora') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.totalmejora_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')

<script type="text/javascript">
    
    
    $(document).ready(function() {
        $("#clausulas").select2({
            theme: "bootstrap4",
        });
    });


</script>

<script type="text/javascript">
    
    $(document).ready(function() {
        $("#equipoauditoria_id").select2({
            theme: "bootstrap4",
        });
    });

</script>

<script>
    Dropzone.options.logotipoDropzone = {
    url: '{{ route('auditoria-internas.storeMedia') }}',
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