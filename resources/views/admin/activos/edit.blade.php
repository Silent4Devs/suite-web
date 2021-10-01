@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Alta de Activo </h3>
        </div>

        <div class="card-body">
            <form method="POST" class="row" action="{{ route('admin.activos.update', [$activo->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group col-md-12">
                    <label class="required" for="nombreactivo_id"><i class="fas fa-chart-line iconos-crear"></i>Nombre
                        del Activo</label>
                    <input class="form-control {{ $errors->has('nombreactivo') ? 'is-invalid' : '' }}" type="text"
                        name="nombreactivo" id="n_serie" value="{{ old('nombreactivo', $activo->nombreactivo) }}"
                        required>
                    @if ($errors->has('nombreactivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombreactivo') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>




                <div class="form-group col-md-6">
                    <label for="tipoactivo_id" class="required"><i
                            class="fas fa-layer-group iconos-crear"></i>Categoría</label>
                    <select class="form-control select2 {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}"
                        name="tipoactivo_id" id="tipoactivo_id">
                        @foreach ($tipoactivos as $id => $tipoactivo)
                            <option value="{{ $id }}"
                                {{ (old('tipoactivo_id') ? old('tipoactivo_id') : $activo->tipoactivo->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $tipoactivo }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipoactivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipoactivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.activo.fields.tipoactivo_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="subtipo_id" class="required"><i
                            class="fas fa-adjust iconos-crear"></i>Subcategoría</label>
                    <select class="form-control select2 {{ $errors->has('subtipo') ? 'is-invalid' : '' }}"
                        name="subtipo_id" id="subtipo_id">
                        @foreach ($subtipos as $id => $subtipo)
                            <option value="{{ $id }}"
                                {{ (old('subtipo_id') ? old('subtipo_id') : $activo->subtipo->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $subtipo }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('subtipo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subtipo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.activo.fields.subtipo_helper') }}</span>
                </div>


                <div class="form-group col-12">
                    <label for="descripcion"><i
                            class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.activo.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion" id="descripcion">{{ old('descripcion', $activo->descripcion) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.activo.fields.descripcion_helper') }}</span>
                </div>

                <div class="mb-3 col-sm-9 input-group">
                    <label for="documentos_relacionados"><i class="fas fa-file iconos-crear"></i>Documento
                        Relacionado</label>
                    <div class="ml-3 custom-file">
                        <input type="file" class="custom-file-input"
                            {{ $errors->has('documentos_relacionados') ? 'is-invalid' : '' }}" multiple
                            name="documentos_relacionados[]" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"
                            {{ old('documentos_relacionados', $activo->documentos_relacionados) }}>
                        @if ($errors->has('documentos_relacionados'))
                            <div class="invalid-feedback">
                                {{ $errors->first('documentos_relacionados') }}
                            </div>
                        @endif
                        <label class="custom-file-label" for="inputGroupFile01"></label>
                    </div>
                </div>

                <div class="pl-0 ml-0 col-sm-3">
                    <span type="button" class="pl-0 ml-0 btn text-primary" data-toggle="modal"
                        data-target="#documentos_activos">
                        <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar Documentos
                    </span>
                </div>



                <div class="form-group col-md-4">
                    <label for="dueno_id"><i class="fas fa-user-tie iconos-crear"></i>Dueño</label>
                    <select class="form-control select2 {{ $errors->has('dueno') ? 'is-invalid' : '' }}" name="dueno_id"
                        id="dueno_id">
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('dueno_id', $activo->dueno_id) == $empleado->id ? 'selected' : '' }}>

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
                    <label for="id_puesto_dueno"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="puesto_dueno"></div>
                </div>

                <div class="form-group col-md-4">
                    <label for="id_area_dueno"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_dueno"></div>

                </div>

                <div class="form-group col-md-4">
                    <label for="id_responsable"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                    <select class="form-control select2 {{ $errors->has('puesto') ? 'is-invalid' : '' }}"
                        name="id_responsable" id="id_responsable">
                        @foreach ($empleados as $id => $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('id_responsable', $activo->id_responsable) == $empleado->id ? 'selected' : '' }}>

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
                    <label for="id_responsable"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="puesto_responsable"></div>

                </div>



                <div class="form-group col-md-4">
                    <label for="id_area_responsable"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_responsable"></div>

                </div>



                <div class="form-group col-md-6">
                    <label for="ubicacion_id"><i class="fas fa-map-marker-alt iconos-crear"></i>Sede</label>
                    <select class="form-control select2 {{ $errors->has('ubicacion') ? 'is-invalid' : '' }}"
                        name="ubicacion_id" id="ubicacion_id">
                        @foreach ($ubicacions as $id => $ubicacion)
                            <option value="{{ $id }}"
                                {{ (old('ubicacion_id') ? old('ubicacion_id') : $activo->ubicacion->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $ubicacion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('ubicacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ubicacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.activo.fields.ubicacion_helper') }}</span>
                </div>




                <div class="form-group col-6">
                    <label for="sede"><i class="fas fa-map iconos-crear"></i>Ubicación</label>
                    <input class="form-control {{ $errors->has('sede') ? 'is-invalid' : '' }}" name="sede" id="sede"
                        value="{{ old('sede', $activo->sede) }}">
                    @if ($errors->has('sede'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sede') }}
                        </div>
                    @endif
                </div>


                <div class="col-md-6">
                    <div class="row align-items-center">
                        <div class="form-group col-md-11">
                            <label class="required" for="marca"><i class="fas fa-copyright iconos-crear"></i>
                                Marca</label>
                            <select class="selecmarca form-control {{ $errors->has('marca') ? 'is-invalid' : '' }}"
                                type="text" name="marca" id="marca" >
                                @if ($errors->has('marca'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('marca') }}
                                    </div>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-1 col-sm-1" class="btn btn-primary" data-toggle="modal" data-target="#marcaslec"
                            data-whatever="@mdo" style="padding: 0; margin-top: 15px;">
                            <i class="fas fa-plus-circle iconos-crear" style="font-size:25px;!important"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row align-items-center">
                        <div class="form-group col-md-11">
                            <label class="required" for="modelo">
                                Modelo</label>
                            <select class="selecmodelo form-control {{ $errors->has('modelo') ? 'is-invalid' : '' }}"
                                type="text" name="modelo" id="modelo" value="{{ old('modelo', $activo->modelo) }}"
                                >
                                @if ($errors->has('modelo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('modelo') }}
                                    </div>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-1 col-sm-1" class="btn btn-primary" data-toggle="modal" data-target="#modelolec"
                            data-whatever="@mdo" style="padding: 0; margin-top: 15px;">
                            <i class="fas fa-plus-circle iconos-crear" style="font-size:25px;!important"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label class="required" for="n_serie"><i class="fas fa-barcode iconos-crear"></i>No de
                        serie</label>
                    <input class="form-control {{ $errors->has('n_serie') ? 'is-invalid' : '' }}" type="text"
                        name="n_serie" id="n_serie" value="{{ old('n_serie', $activo->n_serie) }}" required>
                    @if ($errors->has('n_serie'))
                        <div class="invalid-feedback">
                            {{ $errors->first('n_serie') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-6">
                    <label class="required" for="n_producto"><i class="fas fa-barcode iconos-crear"></i>No de
                        producto</label>
                    <input class="form-control {{ $errors->has('n_serie') ? 'is-invalid' : '' }}" type="text"
                        name="n_producto" id="n_producto" value="{{ old('n_producto', $activo->n_producto) }}" required>
                    @if ($errors->has('n_producto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('n_producto') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-6">
                    <label for="fecha_alta"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha de alta</label>
                    <input class="form-control {{ $errors->has('fecha_alta') ? 'is-invalid' : '' }}" type="date"
                        name="fecha_alta" id="fecha_alta" value="{{ date('Y-m-d') }}">
                    @if ($errors->has('fecha_alta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_alta') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-6">
                    <label class="required" for="fecha_compra"><i class="fas fa-calendar-alt iconos-crear"></i>
                        Fecha de compra</label>
                    <input class="form-control {{ $errors->has('fecha_compra') ? 'is-invalid' : '' }}" type="date"
                        name="fecha_compra" id="fecha_compra" value="{{ old('fecha_compra', $activo->fecha_compra) }}"
                        required>
                    @if ($errors->has('fecha_compra'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_compra') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-6">
                    <label class="required" for="fecha_fin"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                        fin de garantía</label>
                    <input class="form-control {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}" type="date"
                        name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $activo->fecha_fin) }}" required>
                    @if ($errors->has('fecha_fin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-6">
                    <label class="required" for="fecha_baja"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                        de baja</label>
                    <input class="form-control {{ $errors->has('fecha_baja') ? 'is-invalid' : '' }}" type="date"
                        name="fecha_baja" id="fecha_baja" value="{{ old('fecha_baja', $activo->fecha_baja) }}" required>
                    @if ($errors->has('fecha_baja'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_baja') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-12">
                    <label for="observaciones"><i class="fas fa-align-left iconos-crear"></i>Observaciones</label>
                    <textarea class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}"
                        name="observaciones"
                        id="observaciones">{{ old('observaciones', $activo->observaciones) }}</textarea>
                    @if ($errors->has('observaciones'))
                        <div class="invalid-feedback">
                            {{ $errors->first('observaciones') }}
                        </div>
                    @endif
                </div>



                {{-- <div class="text-right form-group col-12">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div> --}}

                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>

                <div class="modal" tabindex="-1" id="documentos_activos">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Descargar Documentos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                {{-- @dump(json_decode($activo->documentos_relacionados)) --}}
                                @if (json_decode($activo->documentos_relacionados))
                                    <div class="list-group">
                                        @foreach (json_decode($activo->documentos_relacionados) as $documento)

                                            <a class="list-group-item list-group-item-action" target="_blank"
                                                href="{{ asset('storage/activos' . '/' . $documento) }}">
                                                <i class="mr-2 fas fa-file"></i><span>{{ $documento }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <p>Sin archivos cargados</p>
                                @endif


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modelolec" tabindex="-1" aria-labelledby="modelolecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Nueva Modelo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="modelo-name" class="col-form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="modelo-name">
                                        <span class="text-danger" id="nombre_error" class="nombre_error"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardar_modelo">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="marcaslec" tabindex="-1" aria-labelledby="marcaslecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="marcaslec" id="exampleModalLabel">Nueva Marca</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="recipient-name">
                                        <span class="text-danger" id="nombre_error" class="nombre_error"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardar_marca">Guardar</button>
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
        document.addEventListener('DOMContentLoaded', function(e) {

            let responsable = document.querySelector('#id_responsable');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_responsable').innerHTML = puesto_init
            document.getElementById('area_responsable').innerHTML = area_init

            let dueno = document.querySelector('#dueno_id');
            let area = dueno.options[dueno.selectedIndex].getAttribute('data-area');
            let puesto = dueno.options[dueno.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_dueno').innerHTML = puesto
            document.getElementById('area_dueno').innerHTML = area

            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_responsable').innerHTML = puesto
                document.getElementById('area_responsable').innerHTML = area
            })
            dueno.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_dueno').innerHTML = puesto
                document.getElementById('area_dueno').innerHTML = area
            })
            document.getElementById('guardar_marca').addEventListener('click', function(e) {
                e.preventDefault();
                let nombre = document.querySelector('#recipient-name').value;

                $.ajax({
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    url: "{{ route('admin.marcas.store') }}",
                    data: {
                        nombre
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            document.querySelector('#recipient-name').value = '';
                            $('.selecmarca').select2('destroy');
                            $('.selecmarca').select2({
                                ajax: {
                                    url: "{{ route('admin.marcas.getMarcas') }}",
                                    dataType: "json",
                                },
                                theme: "bootstrap4"
                            });
                            // $('#marcaslec').modal('hide')
                            Swal.fire(
                                'Guardada con exito!',
                                '',
                                'success'
                            )

                        }
                    },
                    error: function(request, status, error) {
                        console.log(error)
                        $.each(request.responseJSON.errors, function(indexInArray,

                            valueOfElement) {
                            console.log(valueOfElement, indexInArray);
                            $(`span#${indexInArray}_error`).text(valueOfElement[0]);

                        });
                    }
                });
                console.log('Guardando')
            });



            document.getElementById('guardar_modelo').addEventListener('click', function(e) {
                e.preventDefault();
                let nombre = document.querySelector('#modelo-name').value;

                $.ajax({
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    url: "{{ route('admin.modelos.store') }}",
                    data: {
                        nombre
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#marcaslec').modal('hide')
                        if (response.success) {
                            document.querySelector('#modelo-name').value = '';
                            $('.selecmodelo').select2('destroy');
                            $('.selecmodelo').select2({
                                ajax: {
                                    url: "{{ route('admin.modelos.getModelos', $activo->modelo) }}",
                                    dataType: "json",
                                },
                                theme: "bootstrap4"
                            });

                            Swal.fire(
                                'Guardada con exito!',
                                '',
                                'success'
                            )

                        }


                    },
                    error: function(request, status, error) {
                        console.log(error)
                        $.each(request.responseJSON.errors, function(indexInArray,

                            valueOfElement) {
                            console.log(valueOfElement, indexInArray);
                            $(`span#${indexInArray}_error`).text(valueOfElement[0]);

                        });
                    }
                });
                console.log('Guardando')
            });

        })

        $(document).ready(function() {
            $('#marca').select2({
                ajax: {
                    url: "{{ route('admin.marcas.getMarcas') }}",
                    dataType: "json",
                },

                theme: "bootstrap4"
            });
            $("#marca").val(@json($marca_seleccionada?$marca_seleccionada->id:0)).trigger("change")

            // $('.selecmarca').select2("data", {
            //     id: "1",
            //     text: "hello"
            // })



            $('#modelo').select2({
                ajax: {
                    url: "{{ route('admin.modelos.getModelos') }}",
                    dataType: "json",
                },

                theme: "bootstrap4"

            });
            $("#modelo").val(@json($modelo_seleccionado?$modelo_seleccionado->id:0)).trigger("change")



        });
    </script>
@endsection
