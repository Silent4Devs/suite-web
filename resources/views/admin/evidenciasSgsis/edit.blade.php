@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.evidencias-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Evidencias de Asignación de Recursos al SGSI</h5>
    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.evidencias-sgsis.update', [$evidenciasSgsi->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-md-12">
                    <label class="required" for="nombredocumento"><i class="fas fa-file iconos-crear"></i>Nombre del
                        documento</label>
                    <input class="form-control {{ $errors->has('nombredocumento') ? 'is-invalid' : '' }}" type="text"
                        name="nombredocumento" id="nombredocumento"
                        value="{{ old('nombredocumento', $evidenciasSgsi->nombredocumento) }}" required>
                    @if ($errors->has('nombredocumento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombredocumento') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label class="required" for="objetivodocumento"><i
                            class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento') }}</label>
                    <textarea class="form-control {{ $errors->has('objetivodocumento') ? 'is-invalid' : '' }}" type="text"
                        name="objetivodocumento"
                        id="objetivodocumento" required>{{ old('objetivodocumento', $evidenciasSgsi->objetivodocumento) }}</textarea>
                    @if ($errors->has('objetivodocumento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivodocumento') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.evidenciasSgsi.fields.objetivodocumento_helper') }}</span>
                </div>



                <div class="form-group col-md-4">
                    <label class="required" for="responsable_evidencia_id"><i class="fas fa-user-tie iconos-crear"></i>Revisó</label>
                    <select required class="form-control {{ $errors->has('id_reviso') ? 'is-invalid' : '' }}"
                        name="responsable_evidencia_id" id="responsable_evidencia_id">
                        <option value="">Seleccione una opción</option>
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('id_reviso', $evidenciasSgsi->responsable_evidencia_id) == $empleado->id ? 'selected' : '' }}>

                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('empleados'))
                        <div class="invalid-feedback">
                            {{ $errors->first('empleados') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
                </div>


                <div class="form-group col-md-4">
                    <label for="id_puesto_reviso"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="puesto_reviso" readonly></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="id_area_reviso"><i class="fas fa-street-viewa iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_reviso" readonly></div>
                </div>
                {{-- <div class="form-group col-md-6">
                <label for="arearesponsable"><i class="fas fa-street-view iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.arearesponsable') }}</label>
                <input class="form-control {{ $errors->has('arearesponsable') ? 'is-invalid' : '' }}" type="text" name="arearesponsable" id="arearesponsable" value="{{ old('arearesponsable', $evidenciasSgsi->arearesponsable) }}">
                @if ($errors->has('arearesponsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arearesponsable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evidenciasSgsi.fields.arearesponsable_helper') }}</span>
            </div> --}}


                {{-- <div class="form-group col-sm-6">
                <label class="required" for="arearesponsable"><i class="fas fa-street-view iconos-crear"></i>Área responsable</label>
                <select class="custom-select areas" id="inputGroupSelect01" name="arearesponsable">
                    <option selected disabled value="null">-- Seleccion un área --</option>
                    @forelse ($areas as $area)
                        <option value="{{ $area->id }}"
                            {{ old('arearesponsable', $area->id) == $area->id ? 'selected active' : '' }}>
                            {{ $area->area }}</option>
                    @empty
                        <option value="" disabled>Sin Datos</option>
                    @endforelse
                </select>
                @if ($errors->has('arearesponsable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arearesponsable') }}
                    </div>
                @endif
            </div> --}}


                <div class="form-group col-sm-6">
                    <label class="required" for="arearesponsable"><i
                            class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="mb-3 input-group">
                        <select class="custom-select areas" id="inputGroupSelect01" name="area_id" required>
                            <option selected disabled value="null">-- Seleccion un área --</option>
                            @forelse ($areas as $area)
                                <option value="{{ $area->id }}"
                                    {{ old('arearesponsable', $area->id) == $area->id ? 'selected active' : '' }}>
                                    {{ $area->area }}</option>
                            @empty
                                <option value="" disabled>Sin Datos</option>
                            @endforelse
                        </select>
                    </div>
                    @if ($errors->has('area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('area') }}
                        </div>
                    @endif
                </div>




                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label class="required" for="fechadocumento"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de emisión del
                        documento</label>
                    <input required class="form-control {{ $errors->has('fechadocumento') ? 'is-invalid' : '' }}" type="date"
                        name="fechadocumento" id="fechadocumento" min="1945-01-01"
                        value="{{ old('fechadocumento', \Carbon\Carbon::parse($evidenciasSgsi->fechadocumento))->format('Y-m-d') }}">
                    @if ($errors->has('fechadocumento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechadocumento') }}
                        </div>
                    @endif
                </div>


                <div class="col-sm-12 form-group">
                    <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Documento</label>
                    <div class="custom-file">
                        <input type="file" name="files[]" multiple class="form-control" id="evidencia">
                    </div>
                </div>

                <div class="mb-3 col-10 d-flex justify-content-right">
                    <span class="float-right" type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
                        data-target="#largeModal">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>

                {{-- <div class="form-group col-12">
                <label for="archivopdf"><i class="far fa-file-pdf iconos-crear"></i>{{ trans('cruds.evidenciasSgsi.fields.archivopdf') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivopdf') ? 'is-invalid' : '' }}" id="archivopdf-dropzone">
                </div>
                @if ($errors->has('archivopdf'))
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

                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($evidenciasSgsi->evidencia_sgsi))
                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($evidenciasSgsi->evidencia_sgsi as $idx => $evidencia)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to={{ $idx }}></li>

                                            @endforeach

                                        </ol>
                                        <div class='carousel-inner'>
                                            @foreach ($evidenciasSgsi->evidencia_sgsi as $idx => $evidencia)
                                                @if (pathinfo($evidencia->evidencia, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <embed style="width:100%;height:300px;" seamless class='img-size'
                                                            src="{{ asset('storage/evidencias_sgsi') }}/{{ $evidencia->evidencia }}"></embed>
                                                    </div>
                                                @else
                                                    <div class='text-center my-5 carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <a href="{{ asset('storage/evidencias_sgsi') }}/{{ $evidencia->evidencia }}"><i class="fas fa-file-download mr-2" style="font-size:18px"></i>{{ $evidencia->evidencia }}</a>
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
            success: function(file, response) {
                $('form').find('input[name="archivopdf"]').remove()
                $('form').append('<input type="hidden" name="archivopdf" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="archivopdf"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($evidenciasSgsi) && $evidenciasSgsi->archivopdf)
                    var file = {!! json_encode($evidenciasSgsi->archivopdf) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="archivopdf" value="' + file.file_name + '">')
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
