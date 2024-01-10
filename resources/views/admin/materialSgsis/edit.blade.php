@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.material-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Material SGSI</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4>¿Qué es Material SGSI?   </h4>
                <p>
                    Recursos educativos diseñados para enseñar a los colaboradores sobre las prácticas y requisitos  de seguridad de la información establecidos por la norma.
                </p>
                <p>
                    La interactividad y la relevancia son clave para asegurar una comprensión efectiva de los principios de seguridad de la información.
                </p>
            </div>
        </div>
    </div>


    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.material-sgsis.update', [$materialSgsi->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-12 anima-focus">
                    <input  placeholder="" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                        id="nombre" value="{{ old('nombre', $materialSgsi->nombre) }}" required>
                        {!! Form::label('nombre', 'Nombre del material de capacitación*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.objetivo_helper') }}</span>
                </div>
                <div class="form-group col-12 anima-focus">
                    <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" type="text"
                        name="objetivo" id="objetivo" required>{{ old('objetivo', $materialSgsi->objetivo) }}</textarea>
                        {!! Form::label('objetivo', 'Objetivo*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('objetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.objetivo_helper') }}</span>
                </div>
                <div class="form-group col-md-6 anima-focus">
                    <select required class="form-control {{ $errors->has('personalobjetivo') ? 'is-invalid' : '' }}"
                        name="personalobjetivo" id="personalobjetivo">
                        <option value disabled {{ old('personalobjetivo', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MaterialSgsi::PERSONALOBJETIVO_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('personalobjetivo', $materialSgsi->personalobjetivo) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    {!! Form::label('personalobjetivo', 'Personal*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('personalobjetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('personalobjetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.personalobjetivo_helper') }}</span>
                </div>
                <div class="form-group col-md-6 anima-focus">
                    <select required class="form-control select2 {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}"
                        name="arearesponsable_id" id="arearesponsable_id">
                        @foreach ($arearesponsables as $id => $arearesponsable)
                            <option value="{{ $id }}"
                                {{ (old('arearesponsable_id') ? old('arearesponsable_id') : $materialSgsi->arearesponsable->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $arearesponsable }}</option>
                        @endforeach
                    </select>
                    {!! Form::label('arearesponsable_id', 'Área*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('arearesponsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('arearesponsable') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.arearesponsable_helper') }}</span>
                </div>
                <div class="form-group col-md-6 anima-focus">
                    <select required class="form-control {{ $errors->has('tipoimparticion') ? 'is-invalid' : '' }}"
                        name="tipoimparticion" id="tipoimparticion">
                        <option value disabled {{ old('tipoimparticion', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\MaterialSgsi::TIPOIMPARTICION_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('tipoimparticion', $materialSgsi->tipoimparticion) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    {!! Form::label('tipoimparticion', 'Impartición*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('tipoimparticion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipoimparticion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.materialSgsi.fields.tipoimparticion_helper') }}</span>
                </div>
                {{-- <div class="form-group col-md-6">
                <label for="fechacreacion_actualizacion"> <i class="far fa-calendar-alt iconos-crear"></i>Fecha de creación</label>
                <input type="date" name="fechacreacion_actualizacion" value="{{ old('fechacreacion_actualizacion',\Carbon\Carbon::parse($materialSgsi->fechacreacion_actualizacion)->format('d/m/Y') )}}">
                @if ($errors->has('fechaexpedicion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechaexpedicion') }}
                    </div>
                @endif

            </div> --}}

                <div class="form-group col-sm-6 anima-focus">
                    <input required
                        class="form-control date  {{ $errors->has('fechacreacion_actualizacion') ? 'is-invalid' : '' }}"
                        type="date" min="1945-01-01" name="fechacreacion_actualizacion" id="fechacreacion_actualizacion"
                        value="{{ old('fechacreacion_actualizacion', \Carbon\Carbon::parse($materialSgsi->fechacreacion_actualizacion))->format('Y-m-d') }}">
                        {!! Form::label('fechacreacion_actualizacion', 'Fecha de creación*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('fechacreacion_actualizacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechacreacion_actualizacion') }}
                        </div>
                    @endif
                </div>


                {{-- <div class="form-group col-12">
                <label for="archivo"><i class="far fa-file iconos-crear"></i>Material(Archivo PDF)</label>
                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
                </div>
                @if ($errors->has('archivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.materialSgsi.fields.archivo_helper') }}</span>
            </div> --}}


                <div class="mb-3 col-sm-12 anima-focus">
                    <div class="custom-file">
                        <input placeholder="" type="file" class="form-control" {{ $errors->has('archivo') ? 'is-invalid' : '' }}"
                            multiple id="archivo" name="files[]" {{ old('archivo', $materialSgsi->material_id) }}>
                            {!! Form::label('archivo', 'Material(Archivo PDF)*', ['class' => 'asterisco']) !!}
                        @if ($errors->has('archivo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('archivo') }}
                            </div>
                        @endif
                    </div>
                </div>
<br>
<br>
                <div class="mb-3 col-10 d-flex justify-content-right">
                    <span class="float-right" type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
                        data-target="#largeModal">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>

                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.material-sgsis.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($materialSgsi->documentos_material))

                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($materialSgsi->documentos_material as $idx => $material_id)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to={{ $idx }}></li>

                                            @endforeach

                                        </ol>
                                        <div class='carousel-inner'>
                                            @foreach ($materialSgsi->documentos_material as $idx => $material_id)
                                                @if (pathinfo($material_id->documento, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <iframe style="width:100%;height:300px;" seamless class='img-size'
                                                            src="{{ asset('storage/documentos_material_sgsi') }}/{{ $material_id->documento }}"></iframe>
                                                    </div>
                                                @else
                                                    <div
                                                        class='text-center my-5 carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <a
                                                            href="{{ asset('storage/documentos_material_sgsi') }}/{{ $material_id->documento }}">
                                                            <i class="fas fa-file-download mr-2"
                                                                style="font-size:18px"></i>{{ $material_id->documento }}</a>
                                                    </div>
                                                @endif
                                            @endforeach


                                        </div>
                                        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button'
                                            data-slide='prev'>
                                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Previous</span>
                                        </a>
                                        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button'
                                            data-slide='next'>
                                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Next</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <h3 style="text-align:center" class="mt-3">Sin
                                            archivo agregado</h3>
                                        <img src="{{ asset('img/undrawn.png') }}" class="img-fluid "
                                            style="width:350px !important">
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        Dropzone.options.archivoDropzone = {
            url: '{{ route('admin.material-sgsis.storeMedia') }}',
            maxFilesize: 4, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                $('form').find('input[name="archivo"]').remove()
                $('form').append('<input type="hidden" name="archivo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="archivo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($materialSgsi) && $materialSgsi->archivo)
                    var file = {!! json_encode($materialSgsi->archivo) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="archivo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
