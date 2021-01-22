@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.organizacion.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.organizacions.update", [$organizacion->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="org_id" value="{{$organizacion->id}}">
                <div class="form-group">
                    <label class="required" for="empresa">Nombre de la Empresa</label>
                    <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                           name="empresa" id="empresa" value="{{ old('empresa', $organizacion->empresa) }}" required>
                    @if($errors->has('empresa'))
                        <div class="invalid-feedback">
                            {{ $errors->first('empresa') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="direccion">{{ trans('cruds.organizacion.fields.direccion') }}</label>
                    <textarea class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" name="direccion"
                              id="direccion" required>{{ old('direccion', $organizacion->direccion) }}</textarea>
                    @if($errors->has('direccion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('direccion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.direccion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="number"
                           name="telefono" id="telefono" value="{{ old('telefono', $organizacion->telefono) }}"
                           step="1">
                    @if($errors->has('telefono'))
                        <div class="invalid-feedback">
                            {{ $errors->first('telefono') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.telefono_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="correo">{{ trans('cruds.organizacion.fields.correo') }}</label>
                    <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="email"
                           name="correo" id="correo" value="{{ old('correo', $organizacion->correo) }}">
                    @if($errors->has('correo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('correo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.correo_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="pagina_web">Página Web</label>
                    <input class="form-control {{ $errors->has('pagina_web') ? 'is-invalid' : '' }}" type="text"
                           name="pagina_web" id="pagina_web" value="{{ old('pagina_web', $organizacion->pagina_web) }}">
                    @if($errors->has('pagina_web'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pagina_web') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="giro">{{ trans('cruds.organizacion.fields.giro') }}</label>
                    <input class="form-control {{ $errors->has('giro') ? 'is-invalid' : '' }}" type="text" name="giro"
                           id="giro" value="{{ old('giro', $organizacion->giro) }}">
                    @if($errors->has('giro'))
                        <div class="invalid-feedback">
                            {{ $errors->first('giro') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.giro_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="servicios">{{ trans('cruds.organizacion.fields.servicios') }}</label>
                    <input class="form-control {{ $errors->has('servicios') ? 'is-invalid' : '' }}" type="text"
                           name="servicios" id="servicios" value="{{ old('servicios', $organizacion->servicios) }}">
                    @if($errors->has('servicios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('servicios') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.servicios_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mision"><i class="fas fa-flag iconos-crear"></i> </label>
                    <textarea class="form-control {{ $errors->has('mision') ? 'is-invalid' : '' }}" name="mision"
                              id="mision">{{ old('mision', $organizacion->mision) }}</textarea>
                    @if($errors->has('mision'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mision') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.mision_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="vision">{{ trans('cruds.organizacion.fields.vision') }}</label>
                    <textarea class="form-control {{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision"
                              id="vision">{{ old('vision', $organizacion->vision) }}</textarea>
                    @if($errors->has('vision'))
                        <div class="invalid-feedback">
                            {{ $errors->first('vision') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.vision_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="valores">{{ trans('cruds.organizacion.fields.valores') }}</label>
                    <textarea class="form-control {{ $errors->has('valores') ? 'is-invalid' : '' }}" name="valores"
                              id="valores">{{ old('valores', $organizacion->valores) }}</textarea>
                    @if($errors->has('valores'))
                        <div class="invalid-feedback">
                            {{ $errors->first('valores') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="logotipo">{{ trans('cruds.organizacion.fields.logotipo') }}</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="logotipo" id="logotipo" accept="image/*">
                            <label class="custom-file-label" for="inputGroupFile02">Escoger imagen</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="antecedentes">Antecedentes</label>
                    <textarea class="form-control {{ $errors->has('antecedentes') ? 'is-invalid' : '' }}" name="antecedentes"
                              id="antecedentes">{{ old('antecedentes', $organizacion->antecedentes) }}</textarea>
                    @if($errors->has('antecedentes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('antecedentes') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger float-right" type="submit">
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
            url: '{{ route('admin.organizacions.storeMedia') }}',
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
                @if(isset($organizacion) && $organizacion->logotipo)
                var file = {!! json_encode($organizacion->logotipo) !!}
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
