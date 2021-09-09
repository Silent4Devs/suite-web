@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.comunicacion-sgis.create') }}

    <style type="text/css">
        .select2-selection--multiple{
        overflow: hidden !important;
        height: auto !important;
}
    </style>

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Comunicación SGSI </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comunicacion-sgis.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-12">
                <label class="required" for="TitulodComunicado"><i class="fas fa-align-left iconos-crear"></i>
                Título del Comunicado</label>
                <input class="form-control {{ $errors->has('TitulodComunicado') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('TitulodComunicado', '') }}" required>
                @if($errors->has('dTitulodComunicado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('TitulodComunicado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comunicacionSgi.fields.descripcion_helper') }}</span>
            </div>

            <div class="form-group col-12">
                <label class="required" for="descripcion"><i class="fas fa-pencil-ruler iconos-crear"></i></i>
                Contenido</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion" id="descripcion">{{ old('descripcion', '') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comunicacionSgi.fields.descripcion_helper') }}</span>
            </div>

                <div class="form-group col-md-6 col-sm-12">
                    <label for="documento"><i class="fas fa-folder-open iconos-crear"></i>Cargar Documento</label>
                        <div class="custom-file">
                            <input type="file" name="files[]" multiple class="form-control" id="documento" accept="application/pdf">
                        </div>
                </div>



                <div class="col-md-6">
                    <label for="imagen"> <i class="fas fa-image iconos-crear"></i>Imagen</label>
                    <div class="mb-3 input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagen" id="imagen" class="form-control"  accept="imagen/*" value="{{ old('imagen', '') }}" >
                                <label class="custom-file-label" for="inputGroupFile02"></label>
                        </div>
                    </div>
                    @if($errors->has('imagen'))
                        <div class="invalid-feedback">
                             {{ $errors->first('imagen') }}
                        </div>
                    @endif
                </div>



                <div class="form-group col-md-6 col-sm-12">
                    <label for="tipo"><i class="fab fa-elementor iconos-crear"></i>Publicar en </label>
                        <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="publicar_en" id="publicar_en">
                            <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>
                                Selecciona una opción
                            </option>
                                @foreach (App\Models\ComunicacionSgi::TipoSelect as $key => $label)
                            <option value="{{ $key }}"
                                    {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                            </option>
                                @endforeach
                        </select>
                            @if ($errors->has('tipo'))
                                <div class="invalid-feedback">
                                {{ $errors->first('tipo') }}
                                </div>
                            @endif
                </div>


                <div class="form-group col-sm-6">
                    <label for="fechaverificacion"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de publicación</label>
                        <input class="form-control date {{ $errors->has('fechaverificacion') ? 'is-invalid' : '' }}" type="date" name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fechaverificacion') }}">
                             @if($errors->has('fechaverificacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechaverificacion') }}
                    </div>
                            @endif
                </div>


                <div class="col-sm-12 col-md-6">
                    <label for="publico"><i class="fas fa-people-arrows iconos-crear"></i>Público Objetivo</label>
                        <select name="empleados[]" class="select2" multiple>
                            @foreach($empleados as $empleado)
                            <option value="{{$empleado->id}}">{{$empleado->name}}</option>
                            @endforeach
                        </select>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label class="required" for="link"><i class="fas fa-link iconos-crear"></i>Link</label>
                        <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}" required>
                        @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                        @endif
                </div>

                <div class="col-sm-12 col-md-6">
                    <label class="vigencia"><i class="fas fa-upload iconos-crear"></i>Habilitar contenido</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="habilitar" name="habilitar">
                        <label class="custom-control-label" for="habilitar"></label>
                    </div>
                </div>


            <div class="form-group col-12 text-right"><br>
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
<script>
    Dropzone.options.archivoDropzone = {
    url: '{{ route('admin.comunicacion-sgis.storeMedia') }}',
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
@if(isset($comunicacionSgi) && $comunicacionSgi->archivo)
      var file = {!! json_encode($comunicacionSgi->archivo) !!}
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
    $(document).ready(function() {
        CKEDITOR.replace('descripcion', {
            toolbar: [{
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    }, {
                        name: 'clipboard',
                        groups: ['undo'],
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                    },
                    '/',


                    // {
                    //     name: 'others',
                    //     items: ['-']
                    // }
                ]
        });

    });

    $(document).ready(function(){

  $(".select2").select2({
    theme:"bootstrap4",
  });

});

</script>
@endsection
