@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.control-accesos.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Control de Acceso</h5>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" class="row" action="{{ route('admin.control-accesos.update', [$controlAcceso->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-sm-12">
                    <label class="required" for="tipo"><i class="fas fa-user-lock iconos-crear"></i>
                        Tipo de acceso</label>
                    <div style="float: right;">
                        <button id="btnAgregarTipo" onclick="event.preventDefault();" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;" data-toggle="modal" data-target="#tipoCompetenciaModal"
                            data-whatever="@mdo" data-whatever="@mdo" title="Agregar tipo de permiso"><i
                                class="fas fa-plus"></i></button>
                        <a href="{{ route('admin.tipo-acceso.index') }}" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;"><i class="fas fa-edit"></i></a>
                    </div>
                    @livewire('permiso-component')
                    @livewire('tipo-permiso-select-component', ['tipo_permiso_seleccionado' => $controlAcceso->tipo_control_acceso_id])

                </div>

                <div class="form-group col-sm-4 mt-3">
                    <div class="form-group">
                        <label for='responsable_id'><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                        <select class="form-control select2 {{ $errors->has('responsable_id') ? 'is-invalid' : '' }}"
                            name='responsable_id' id='responsable_id'>
                            <option value="">Seleccione un responsable</option>
                            @foreach ($responsables as $responsable)
                                <option value="{{ $responsable->id }}" data-area="{{ $responsable->area->area }}"
                                    data-puesto="{{ $responsable->puesto }}"
                                    {{ old('responsable_id', $controlAcceso->responsable_id) == $responsable->id ? 'selected' : '' }}>
                                    {{ $responsable->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('responsable_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('responsable_id') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-4 mt-3">
                    <label><i class="fas fa-briefcase iconos-crear"></i>Puesto<sup>*</sup></label>
                    <div class="form-control" id="responsable_puesto" readonly></div>
                </div>


                <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-3">
                    <label><i class="fas fa-street-view iconos-crear"></i>Área<sup>*</sup></label>
                    <div class="form-control" id="responsable_area" readonly></div>
                </div>

                <div class=" mb-4 ml-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Periodo</span>
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                    <label for="fecha_inicio">
                        <i class="fas fa-calendar-alt iconos-crear"></i>
                        Fecha Fin
                    </label>
                    <input class="form-control" type="date" id="fecha_inicio" name="fecha_inicio"
                        value="{{ old('fecha_inicio', $controlAcceso->fecha_inicio) }}">
                    <span class="fecha_inicio_error text-danger errores"></span>
                    @if ($errors->has('fecha_inicio', $controlAcceso->fecha_inicio))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                    <label for="fecha_fin">
                        <i class="fas fa-calendar-alt iconos-crear"></i>
                        Fecha Fin
                    </label>
                    <input class="form-control" type="date" id="fecha_fin" name="fecha_fin"
                        value="{{ old('fecha_fin', $controlAcceso->fecha_fin) }}">
                    <span class="fecha_fin_error text-danger errores"></span>
                    @if ($errors->has('fecha_fin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    <label><i class="fas fa-align-left iconos-crear"></i>Justificación</label>
                    <textarea class="form-control {{ $errors->has('justificacion') ? 'is-invalid' : '' }}" name="justificacion"
                        id="justificacion">{{ old('justificacion', $controlAcceso->justificacion) }}</textarea>
                    @if ($errors->has('justificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('justificacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.controlAcceso.fields.descripcion_helper') }}</span>
                </div>

                <div class="form-group col-md-12">
                    <label for="descripcion"><i
                            class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.controlAcceso.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion', $controlAcceso->descripcion) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.controlAcceso.fields.descripcion_helper') }}</span>
                </div>


                {{-- <div class="form-group col-md-12">
                <label for="archivo"><i class="far fa-file iconos-crear"></i>{{ trans('cruds.controlAcceso.fields.archivo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
                </div>
                @if ($errors->has('archivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.controlAcceso.fields.archivo_helper') }}</span>
            </div> --}}

                {{-- editar --}}
                <div class="mb-3 col-sm-12">
                    <label for="archivo"><i class="fas fa-folder-open iconos-crear"></i>Material(Archivo PDF)</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" {{ $errors->has('archivo') ? 'is-invalid' : '' }}"
                            multiple id="archivo" name="files[]" {{ old('archivo', $controlAcceso->controlA_id) }}>
                        @if ($errors->has('archivo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('archivo') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3 col-10 d-flex justify-content-right">
                    <span class="float-right" type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
                        data-target="#largeModal">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>
                {{-- editar --}}

                <div class="form-group col-12 text-right">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                @if (count($controlAcceso->documentos_controlA))
                                    <!-- carousel -->
                                    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                        <ol class='carousel-indicators'>
                                            @foreach ($controlAcceso->documentos_controlA as $idx => $controlA_id)
                                                <li data-target=#carouselExampleIndicators
                                                    data-slide-to='{{ $idx == 0 ? 'active' : '' }}''>
                                                </li>
                                            @endforeach

                                        </ol>
                                        <div class='carousel-inner'>
                                            @foreach ($controlAcceso->documentos_controlA as $idx => $controlA_id)
                                                @if (pathinfo($controlA_id->documento, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <iframe style="width:100%;height:300px;" seamless class='img-size'
                                                            src="{{ asset('storage/documentos_control_accesos') }}/{{ $controlA_id->documento }}"></iframe>
                                                    </div>
                                                @else
                                                    <div
                                                        class='text-center my-5 carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                        <a
                                                            href="{{ asset('storage/documentos_control_accesos') }}/{{ $controlA_id->documento }}">
                                                            <i class="fas fa-file-download mr-2"
                                                                style="font-size:18px"></i>{{ $controlA_id->documento }}</a>
                                                    </div>
                                                @endif
                                            @endforeach


                                        </div>
                                        <a style="height: 50px; top: 50px;" class='carousel-control-prev'
                                            href='#carouselExampleIndicators' role='button' data-slide='prev'>
                                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                            <span class='sr-only'>Previous</span>
                                        </a>
                                        <a style="height: 50px; top: 50px;" class='carousel-control-next'
                                            href='#carouselExampleIndicators' role='button' data-slide='next'>
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('hola')
        });
        if (document.querySelector('#responsable_id') != null) {

            let responsable = document.querySelector('#responsable_id');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
            document.getElementById('responsable_puesto').innerHTML = recortarTexto(puesto_init);
            document.getElementById('responsable_area').innerHTML = recortarTexto(area_init);
            console.log(responsable);
            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                console.log('hola');
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
