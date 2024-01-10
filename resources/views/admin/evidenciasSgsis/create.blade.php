@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.evidencias-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Evidencia de Asignación de Recursos al SGSI</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4> ¿Qué es Evidencia de asignación de recurso al SGI? </h4>
                <p>
                    Registro de información y documentación que le permita a la organización mostrar que ha   destinado los recursos necesarios.
                </p>
                <p>
                    Para implementar y mantener su Sistema de Gestión de la Seguridad de la Información (SGI).
                </p>
            </div>
        </div>
    </div>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.evidencias-sgsis.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-md-12 anima-focus">
                <input class="form-control {{ $errors->has('nombredocumento') ? 'is-invalid' : '' }}" type="text"
                name="nombredocumento" placeholder="" id="nombredocumento" value="{{ old('nombredocumento', '') }}" required>
                {!! Form::label('nombredocumento', 'Nombre del documento*', ['class' => 'asterisco']) !!}
                @if($errors->has('nombredocumento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombredocumento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
            </div>
            <div class="form-group col-md-12 anima-focus">
                <textarea class="form-control {{ $errors->has('objetivodocumento') ? 'is-invalid' : '' }}" type="text"
                    name="objetivodocumento" id="objetivodocumento" placeholder=""  value="{{ old('objetivodocumento', '') }}" required></textarea>
                    {!! Form::label('objetivodocumento', 'Objetivo del documento*', ['class' => 'asterisco']) !!}
                @if($errors->has('objetivodocumento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivodocumento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
            </div>
            <div class="form-group col-md-4 anima-focus">
                <select class="form-control {{ $errors->has('empleados') ? 'is-invalid' : '' }}" name="responsable_evidencia_id" id="responsable_evidencia_id">
                    <option value="">Seleccione una opción</option>
                    @foreach ($empleados as $empleado)
                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}" data-area="{{ $empleado->area->area }}">
                        {{ $empleado->name }}
                    </option>

                    @endforeach
                </select>
                {!! Form::label('responsable_evidencia_id', 'Responsable del documento*', ['class' => 'asterisco']) !!}
                @if ($errors->has('responsable_evidencia_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('responsable_evidencia_id') }}
                </div>
                @endif
            </div>
            <div class="form-group col-md-4 anima-focus">
                <div class="form-control"  id="puesto_reviso" readonly></div>
                {!! Form::label('puesto_reviso', 'Puesto*', ['class' => 'asterisco']) !!}

            </div>
            <div class="form-group col-md-4  anima-focus">
                <div class="form-control" id="area_reviso" readonly></div>
                {!! Form::label('id_area_reviso', 'Área*', ['class' => 'asterisco']) !!}

            </div>
            {{-- <div class="form-group col-md-6">
                <label for="arearesponsable"><i class="fas fa-street-view iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.arearesponsable') }}</label>
                <input class="form-control {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}" type="text" name="arearesponsable" id="arearesponsable" value="{{ old('arearesponsable', '') }}">
                @if($errors->has('arearesponsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arearesponsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.arearesponsable_helper') }}</span>
            </div> --}}


            <div class="form-group col-md-12 col-sm-12 col-lg-6 anima-focus">
                <select required class="form-control {{ $errors->has('area_id') ? 'is-invalid' : '' }}"
                    name="area_id" id="area_id">
                    @foreach ($areas as $area)
                    <option value="{{ $area->id }}">
                        {{ $area->area}}
                    </option>

                    @endforeach
                </select>
                {!! Form::label('area_id', 'Área reponsable del documento*', ['class' => 'asterisco']) !!}

                @if ($errors->has('area'))
                <div class="invalid-feedback">
                    {{ $errors->first('area') }}
                </div>
                @endif
            </div>

            <div class="form-group col-md-6 anima-focus">
                <input required class="form-control {{ $errors->has('fechadocumento') ? 'is-invalid' : '' }}" placeholder="" type="date"
                name="fechadocumento" id="fechadocumento" min="1945-01-01"
                value="{{ old('fechadocumento') }}">
                {!! Form::label('fechadocumento', 'Fecha de emisión del documento*', ['class' => 'asterisco']) !!}
                @if($errors->has('fechadocumento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechadocumento') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.fechadocumento_helper') }}</span>
            </div>
            <div class="col-sm-12 form-group anima-focus">
                <div class="custom-file">
                    <input type="file" name="files[]" multiple class="form-control" id="evidencia">

                </div>
                {!! Form::label('evidencia', 'Documento*', ['class' => 'asterisco']) !!}
            </div>
            {{-- <div class="form-group col-12">
                <label for="archivopdf"><i class="far fa-file-pdf iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.archivopdf') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivopdf') ? 'is-invalid' : '' }}" id="archivopdf-dropzone">
                </div>
                @if($errors->has('archivopdf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivopdf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.archivopdf_helper') }}</span>
            </div> --}}
            <div class="text-right form-group col-12">
                <a href="{{ route("admin.evidencias-sgsis.index") }}" class="btn_cancelar">Cancelar</a>
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
<script>

document.addEventListener('DOMContentLoaded', function() {
        let cumple = document.getElementById('responsable_evidencia_id');
        cumple.addEventListener('change', function(e) {
            let respuesta = e.target.value;
            if (respuesta == 'No') {
                $("#plan_accion_select").show(1000);
            } else {
                $("#plan_accion_select").hide(1000);
            }
        })

        let responsable = document.querySelector('#responsable_evidencia_id');
        let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
        let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

        document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto_init);
        document.getElementById('area_reviso').innerHTML = recortarTexto(area_init);
        responsable.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_reviso').innerHTML = recortarTexto(puesto);
            document.getElementById('area_reviso').innerHTML = recortarTexto(area);
        })
    });


    function recortarTexto(texto, length = 30) {
        let trimmedString = texto?.length > length ?
            texto.substring(0, length - 3) + "..." :
            texto;
        return trimmedString;
    }

</script>

@endsection
