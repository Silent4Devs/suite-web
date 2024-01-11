@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.control-accesos.create') }}
    <h5 class="col-12 titulo_general_funcion">Control de Acceso</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4>¿Qué es Control de Accesos? </h4>
                <p>
                    Garantiza que las personas adecuadas tengan el acceso adecuado a la información en un sistema de gestión de seguridad.
                </p>
                <p>
                    Garantiza que las personas adecuadas tengan el acceso adecuado a la información en un sistema de gestión de seguridad.
                    Esencial para garantizar la seguridad y la integridad de la información, así como para proteger los activos críticos de una organización.
                </p>
            </div>
        </div>
    </div>
<div class="card mt-4">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.control-accesos.store") }}" enctype="multipart/form-data" class="row">
            @csrf

                <div class="form-group col-sm-12 ">
                    <label class="required" for="tipo">Tipo</label>
                    <div style="float: right;">
                        <button id="btnAgregarTipo" onclick="event.preventDefault();"
                            class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
                            data-toggle="modal" data-target="#tipoCompetenciaModal" data-whatever="@mdo"
                            data-whatever="@mdo" title="Agregar tipo de permiso"><i
                                class="fas fa-plus"></i></button>
                    </div>
                    @livewire('permiso-component')
                    @livewire('tipo-permiso-select-component')

                </div>

                <div class="form-group col-sm-4 mt-3 anima-focus">
                    <select
                        class="form-control {{ $errors->has('responsable_id') ? 'is-invalid' : '' }}"
                        name='responsable_id' id='responsable_id' required>
                        <option value="">Seleccione un responsable</option>
                        @foreach ($responsables as $responsable)
                            <option value="{{ $responsable->id }}"
                                data-area="{{ $responsable->area->area }}"
                                data-puesto="{{ $responsable->puesto }}"
                                {{ old('responsable_id') == $responsable->id ? 'selected' : '' }}>
                                {{ $responsable->name }}</option>
                        @endforeach
                    </select>
                    {!! Form::label('responsable_id', 'Responsable*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('responsable_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable_id') }}
                        </div>
                    @endif
            </div>

                <div class="form-group col-md-4 mt-3 anima-focus">
                    <div class="form-control" id="responsable_puesto" readonly></div>
                    {!! Form::label('responsable_puesto', 'Puesto*', ['class' => 'asterisco']) !!}
                </div>


                <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-3 anima-focus">
                    <div class="form-control" id="responsable_area" readonly></div>
                    {!! Form::label('responsable_area', 'Área*', ['class' => 'asterisco']) !!}
                </div>

            <div class=" mb-4 ml-3 w-100" style="border-bottom: solid 2px #345183;">
                <span style="font-size: 17px; font-weight: bold;">
                    Periodo</span>
            </div>

            <div class="form-group col-sm-12 col-md-12 col-lg-6 anima-focus">
                <input required placeholder="" class="form-control" type="date" min="1945-01-01"
                id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio')}}">
                {!! Form::label('fecha_inicio', 'Fecha Inicio*', ['class' => 'asterisco']) !!}
                <span class="fecha_inicio_error text-danger errores"></span>
                @if ($errors->has('fecha_inicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_inicio') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-sm-12 col-md-12 col-lg-6  anima-focus">
                <input required placeholder="" class="form-control" type="date" min="1945-01-01"
                id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}">
                {!! Form::label('fecha_fin', 'Fecha Fin*', ['class' => 'asterisco']) !!}
                <span class="fecha_fin_error text-danger errores"></span>
                @if ($errors->has('fecha_fin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_fin') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-12 anima-focus">
                <textarea required class="form-control {{ $errors->has('justificacion') ? 'is-invalid' : '' }}"
                    name="justificacion" id="justificacion">{{ old('justificacion') }}</textarea>
                    {!! Form::label('justificacion', 'Justificación*', ['class' => 'asterisco']) !!}
                @if($errors->has('justificacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('justificacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.controlAcceso.fields.descripcion_helper') }}</span>
            </div>

            <div class="form-group col-md-12 anima-focus">
                <textarea required class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                    name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                    {!! Form::label('descripcion', 'Descripción*', ['class' => 'asterisco']) !!}
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.controlAcceso.fields.descripcion_helper') }}</span>
            </div>


            <div class="form-group col-12">
                <label for="documento">Archivo</label>
                <input type="file" name="files[]" multiple class="form-control" id="documento" accept="application/pdf" value="{{ old('files[]') }}">
            </div>

            {{-- <div class="form-group col-md-12">
                <label for="archivo"><i class="far fa-file iconos-crear"></i>{{ trans('cruds.controlAcceso.fields.archivo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
                </div>
                @if($errors->has('archivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.controlAcceso.fields.archivo_helper') }}</span>
            </div> --}}


            <div class="form-group col-12 text-right">
                <a href="{{ route("admin.control-accesos.index") }}" class="btn_cancelar">Cancelar</a>
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
    url: '{{ route('admin.control-accesos.storeMedia') }}',
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
@if(isset($controlAcceso) && $controlAcceso->archivo)
      var file = {!! json_encode($controlAcceso->archivo) !!}
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

<script>
    if (document.querySelector('#responsable_id') != null) {

        let responsable = document.querySelector('#responsable_id');
        let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
        let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
        document.getElementById('responsable_puesto').innerHTML = recortarTexto(puesto_init);
        document.getElementById('responsable_area').innerHTML = recortarTexto(area_init);

        responsable.addEventListener('change', function(e) {
            e.preventDefault();
            let area = e.target.options[e.target.selectedIndex].getAttribute('data-area');
            let puesto = e.target.options[e.target.selectedIndex].getAttribute('data-puesto');
            console.log(e.target.options[e.target.selectedIndex]);
            document.getElementById('responsable_puesto').innerHTML = recortarTexto(puesto)
            document.getElementById('responsable_area').innerHTML = recortarTexto(area)
        })
    }

    function recortarTexto(texto, length = 30) {
        let trimmedString = texto?.length > length ?
            texto.substring(0, length - 3) + "..." :
            texto;
        return trimmedString;
    }
</script>
@endsection
