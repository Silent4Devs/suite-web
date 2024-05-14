@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Alta de Activo</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.activos.update', [$activo->id]) }}" enctype="multipart/form-data"
                class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-3">
                    <label class="required " for="identificador"><i class="fa-solid fa-list-ol iconos-crear"></i>ID</label>
                    <input class="form-control select2 {{ $errors->has('identificador') ? 'is-invalid' : '' }}"
                        name="identificador" id="identificador" value="{{ old('identificador', $activo->identificador) }}"
                        required>
                    @if ($errors->has('identificador'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identificador') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-9">
                    <label class="required " for="nombreactivo_id"><i class="fas fa-chart-line iconos-crear"></i>Nombre del
                        Activo</label>
                    <input class="form-control select2 {{ $errors->has('nombre_activo') ? 'is-invalid' : '' }}"
                        name="nombreactivo" id="nombre_activo"
                        value="{{ old('nombreactivo', $activo->nombreactivo) }}"required>
                    @if ($errors->has('nombreactivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombreactivo') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>

                @livewire('categoria-subcategoria', ['categoriasSeleccionado' => $categoriasSeleccionado, 'subcategoriaSeleccionado' => $subcategoriaSeleccionado])

                <div class="form-group col-12">
                    <label for="descripcion"><i
                            class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.activo.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion', $activo->descripcion) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.activo.fields.descripcion_helper') }}</span>
                </div>


                <div class="col-sm-12 form-group">
                    <label for="evidencia"><i class="fas fa-folder-open iconos-crear"></i>Documentos Relacionados</label>
                    <div class="custom-file">
                        <input type="file" name="documentos_relacionados[]" multiple id="inputGroupFile01"
                            class="form-control {{ $errors->has('documentos_relacionados') ? 'is-invalid' : '' }}"
                            value="{{ old('documentos_relacionados', '') }}">
                        @if ($errors->has('documentos_relacionados'))
                            <div class="invalid-feedback">
                                {{ $errors->first('documentos_relacionados') }}
                            </div>
                        @endif
                    </div>
                    @if ($activo->documento)
                        Documento actual: {{ $activo->documento }}<br>
                        <span type="button" data-toggle="modal" data-target="#largeModal">
                            <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Descargar
                            Documentos
                        </span>
                    @endif

                </div>

                <div class="form-group col-md-4">
                    <label for="dueno_id"><i class="fas fa-user-tie iconos-crear"></i>Dueño</label>
                    <select class="form-control select2 {{ $errors->has('dueno_id') ? 'is-invalid' : '' }}" name="dueno_id"
                        id="dueno_id">
                        @foreach ($empleados as $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('dueno_id', $activo->dueno_id) == $empleado->id ? 'selected' : '' }}>
                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('dueno_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('dueno_id') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="id_puesto_dueno"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="puesto_dueno"></div>
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="id_area_dueno"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_dueno"></div>
                </div>

                <div class="form-group col-md-4">
                    <label for="id_responsable"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="id_responsable" id="id_responsable">
                        @foreach ($empleados as $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}"
                                {{ old('id_responsable', $activo->id_responsable) == $empleado->id ? 'selected' : '' }}>
                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('empleados'))
                        <div class="invalid-feedback">
                            {{ $errors->first('area') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="id_puesto_responsable"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control" id="puesto_responsable"></div>
                </div>

                <div class="form-group col-md-4">
                    <label for="id_area_responsable"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control" id="area_responsable"></div>
                </div>

                <div class="form-group col-md-4">
                    <label for="proceso_id"><i class="bi bi-file-earmark-post iconos-crear"></i>Proceso</label>
                    <select class="form-control select2 {{ $errors->has('proceso_id') ? 'is-invalid' : '' }}"
                        name="proceso_id" id="proceso_id">
                        @foreach ($procesos as $proceso)
                            <option data-codigo="{{ $proceso->codigo }}" value="{{ $proceso->id }}"
                                data-macroproceso="{{ $proceso->macroproceso->nombre }}"
                                {{ old('proceso_id', $activo->proceso_id) == $proceso->id ? 'selected' : '' }}>
                                {{ $proceso->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('empleados'))
                        <div class="invalid-feedback">
                            {{ $errors->first('area') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="codigo_proceso"><i class="fas fa-barcode iconos-crear"
                            style="margin-top: 8px"></i>Codigo</label>
                    <div class="form-control" id="codigo_proceso"></div>
                </div>

                <div class="form-group col-md-4">
                    <label for="macroproceso"><i
                            class="bi bi-file-earmark-post-fill iconos-crear"></i>Macroproceso</label>
                    <div class="form-control" id="macroproceso"></div>
                </div>


                <div class="form-group col-md-6 sm-12">
                    <label for="ubicacion_id" class="required"><i
                            class="fas fa-map-marker-alt iconos-crear"></i>Sede</label>
                    <select class="form-control select2 {{ $errors->has('ubicacion') ? 'is-invalid' : '' }}"
                        name="ubicacion_id" id="ubicacion_id">
                        @foreach ($ubicacions as $id => $ubicacion)
                            <option value="{{ $id }}" {{ old('ubicacion_id') == $id ? 'selected' : '' }}>
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

                <div class="form-group col-sm-6">
                    <label for="sede"><i class="fas fa-map iconos-crear"></i>Ubicación</label>
                    <input class="form-control {{ $errors->has('sede') ? 'is-invalid' : '' }}" type="text"
                        name="sede" id="sede" value="{{ old('sede', $activo->sede) }}">
                    @if ($errors->has('sede'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sede') }}
                        </div>
                    @endif
                </div>


                {{-- <div class="form-group col-md-5 sm-9">
                <label for="marca">Marca</label>
                <input class="form-control {{ $errors->has('marca') ? 'is-invalid' : '' }}" name="marca" id="marca" required>
                @if ($errors->has('marca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marca') }}
                    </div>
                @endif
                  <span class="help-block"></span>
            </div> --}}
                <div class="col-md-6">
                    <div class="row align-items-center">
                        <div class="form-group col-md-11">
                            <label for="marca"><i class="fas fa-copyright iconos-crear"></i>Marca</label>
                            <select class="selecmarca" name="marca">
                                {{-- @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" >{{ $marca->nombre }}</option>
                        @endforeach --}}
                            </select>
                            @if ($errors->has('marca'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('marca') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>

                        <div style="margin-top:17px;height: 28px !important;margin-left: -10px !important;">
                            <button id="btnAgregarTipo" class="text-white btn btn-sm"
                                style="background:#3eb2ad;height: 32px;" data-toggle="modal" data-target="#marcaslec"
                                data-whatever="@mdo" data-whatever="@mdo" title="Agregar Tipo"><i
                                    class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row align-items-center">
                        <div class="form-group col-md-11">
                            <label for="modelo">Modelo</label>
                            <select class="selecmodelo" name="modelo">
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('modelo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('modelo') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>

                        <div style="margin-top:17px;height: 28px !important;margin-left: -10px !important;">
                            <button id="btnAgregarTipo" class="text-white btn btn-sm"
                                style="background:#3eb2ad;height: 32px;" data-toggle="modal" data-target="#modelolec"
                                data-whatever="@mdo" title="Agregar Tipo"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <label for="n_serie"><i class="fas fa-barcode iconos-crear"></i>No de serie</label>
                    <input class="form-control {{ $errors->has('n_serie') ? 'is-invalid' : '' }}" name="n_serie"
                        id="n_serie" value="{{ old('sede', $activo->n_producto) }}">
                    @if ($errors->has('n_serie'))
                        <div class="invalid-feedback">
                            {{ $errors->first('n_serie') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="n_producto"><i class="fas fa-barcode iconos-crear"></i>No de producto</label>
                    <input class="form-control {{ $errors->has('n_producto') ? 'is-invalid' : '' }}" name="n_producto"
                        id="n_producto" value="{{ old('sede', $activo->n_serie) }}">
                    @if ($errors->has('n_producto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('n_producto') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>


                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="fecha_alta"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha de alta </label>
                    <input class="form-control" type="date" id="fecha_alta"
                        value="{{ old('descripcion', $activo->fecha_alta) }}" name="fecha_alta">
                    @if ($errors->has('fecha_alta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_alta') }}
                        </div>
                    @endif
                </div>



                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="fecha_compra"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha de compra </label>
                    <input class="form-control" type="date" id="fecha_compra" name="fecha_compra"
                        value="{{ old('descripcion', $activo->fecha_compra) }}">
                    @if ($errors->has('fecha_compra'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_compra') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="fecha_fin"> <i class="fas fa-calendar-alt iconos-crear"></i>Fecha fin de garantía</label>
                    <input class="form-control" type="date" id="fecha_fin" name="fecha_fin"
                        value="{{ old('descripcion', $activo->fecha_fin) }}">
                    @if ($errors->has('fecha_fin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="fecha_baja"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha de baja</label>
                    <input class="form-control" type="date" id="fecha_baja" name="fecha_baja">
                    @if ($errors->has('fecha_baja'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_baja') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-12">
                    <label for="observaciones"><i class="fas fa-align-left iconos-crear"></i>Observaciones</label>
                    <textarea class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}" name="observaciones"
                        id="observaciones">{{ old('descripcion', $activo->observaciones) }}</textarea>
                    @if ($errors->has('observaciones'))
                        <div class="invalid-feedback">
                            {{ $errors->first('observaciones') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <li><a href="{{ url('admin/activos/descargar') }}">Descargar formato sugerido de responsiva </a></li>
                </div>

                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="documento"><i class="fas fa-folder-open iconos-crear"></i>Cargar Responsiva</label>
                    <form method="POST" action="{{ route('admin.activos.store') }}" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        <input type="file" name="documento" multiple class="form-control" id="documento"
                            accept="application/pdf" value="{{ old('files[]') }}">
                        @if ($activo->documento)
                            Documento actual: {{ $activo->documento }}<br>
                        @endif
                </div>

                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>


                {{-- Modales  --}}

                <div class="modal fade" id="modelolec" tabindex="-1" aria-labelledby="modelolecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Nuevo Modelo</h5>
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


                <div class="modal fade" id="categorialec" tabindex="-1" aria-labelledby="categorialecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Nueva Categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="modelo-name" class="col-form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="tipo-name">
                                        <span class="text-danger" id="nombre_error" class="nombre_error"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardar_categoria"
                                    data-dismiss="modal">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="subcategorialec" tabindex="-1" aria-labelledby="subcategorialecLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="marcaslec" id="exampleModalLabel">Nueva Subcategoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>

                                    {{-- <div class="form-group">
                            <label for="id_asignada">Categoría</label>
                            <select class="form-control  {{ $errors->has('tipo') ? 'is-invalid' : '' }}"
                                name="categoria_id" id="categoria_id">
                                <option value="">Seleccione una opción</option>
                                @foreach ($tipos as $tipo)
                                    <option data-puesto="{{ $tipo->tipo }}" value="{{ $tipo->id }}">
                                        {{ $tipo->tipo }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tipo') }}
                                </div>
                            @endif
                        </div> --}}

                                    {{-- <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Subcategoria:</label>
                          <input type="text" class="form-control" id="subtipo-name">
                          <span class="text-danger" id="nombre_error" class="nombre_error"></span>
                        </div> --}}
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardar_subcategoria">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
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
                        let proceso = document.getElementById('proceso_id');

                        document.getElementById('codigo_proceso').innerHTML = proceso.options[proceso.selectedIndex]
                            .getAttribute('data-codigo')
                        document.getElementById('macroproceso').innerHTML = proceso.options[proceso.selectedIndex].getAttribute(
                            'data-macroproceso')

                        let dueno = document.querySelector('#dueno_id');
                        let area = dueno.options[dueno.selectedIndex].getAttribute('data-area');
                        let puesto = dueno.options[dueno.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('puesto_dueno').innerHTML = puesto
                        document.getElementById('area_dueno').innerHTML = area

                        proceso.addEventListener('change', function(e) {
                            e.preventDefault();
                            console.log()
                            document.getElementById('codigo_proceso').innerHTML = e.target.options[e.target
                                .selectedIndex].getAttribute('data-codigo')
                            document.getElementById('macroproceso').innerHTML = e.target.options[e.target.selectedIndex]
                                .getAttribute('data-macroproceso')
                        })


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

                            <<
                            << << < HEAD
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

                        // Script Marca activos
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
                                                $('#marcaslec').modal('hide')
                                                $('.modal-backdrop').hide();
                                                Swal.fire(
                                                    'Guardada con exito!',
                                                    '',
                                                    'success'
                                                )
                                                const marca = response.marca
                                                console.log(marca);
                                                var option = new Option(marca.nombre, marca.id, true, true);
                                                $('.selecmarca').append(option).trigger('change');

                                            }
                                        },
                                        error: function(request, status, error) {
                                            console.log(error)
                                            $.each(request.responseJSON.errors, function(indexInArray,

                                                    <<
                                                    << << < HEAD
                                                    // Script categoria activos
                                                    document.getElementById('guardar_categoria')
                                                    .addEventListener('click', function(e) {
                                                        e.preventDefault();
                                                        let tipo = document.querySelector('#tipo-name')
                                                            .value;

                                                        $.ajax({
                                                            type: "POST",
                                                            headers: {
                                                                "X-CSRF-TOKEN": $(
                                                                        "meta[name='csrf-token']")
                                                                    .attr("content")
                                                            },
                                                            url: "{{ route('admin.tipoactivos.store') }}",
                                                            data: {
                                                                tipo,
                                                                ajax: true
                                                            },
                                                            dataType: "json",
                                                            success: function(response) {
                                                                // console.log("aqui");
                                                                if (response.success) {
                                                                    document.querySelector(
                                                                            '#recipient-name')
                                                                        .value = '';
                                                                    $('.selecCategoria')
                                                                        .select2('destroy');
                                                                    $('.selecCategoria')
                                                                        .select2({
                                                                            ajax: {
                                                                                url: "{{ route('admin.tipoactivos.getTipos') }}",
                                                                                dataType: "json",
                                                                            },
                                                                            theme: "bootstrap4"
                                                                        });
                                                                    $('#categorialec').modal(
                                                                        'hide')
                                                                    $('.modal-backdrop').hide();
                                                                    Swal.fire(
                                                                        'Guardada con exito!',
                                                                        '',
                                                                        'success'
                                                                    )
                                                                    const activo = response
                                                                        .activo
                                                                    // console.log(activo);
                                                                    var option = new Option(
                                                                        activo.tipo, activo
                                                                        .id, true, true);
                                                                    $('.selecCategoria').append(
                                                                        option).trigger(
                                                                        'change');

                                                                }
                                                            },
                                                            error: function(request, status,
                                                            error) {
                                                                // console.log(error)
                                                                $.each(request.responseJSON
                                                                    .errors,
                                                                    function(indexInArray,

                                                                        valueOfElement) {
                                                                        // console.log(valueOfElement, indexInArray);
                                                                        $(`span#${indexInArray}_error`)
                                                                            .text(
                                                                                valueOfElement[
                                                                                    0]);

                                                                    });
                                                            }
                                                        });
                                                        // console.log('Guardando')
                                                        ===
                                                        === =
                                                        valueOfElement) {
                                                        console.log(valueOfElement, indexInArray);
                                                        $(`span#${indexInArray}_error`).text(valueOfElement[
                                                            0]);

                                                    });
                                                } >>>
                                                >>> > e219dc436d16a740249702415aa1c70a129aac4c
                                            });
                                        console.log('Guardando')
                                    });

                                    <<
                                    << << < HEAD
                                    // Script subcategoria activos

                                    document.getElementById('guardar_subcategoria').addEventListener('click', function(e) {
                                                e.preventDefault();
                                                let subcategoria = document.querySelector('#subtipo-name').value;
                                                let categoria_id = document.querySelector('#categoria_id').value;

                                                $.ajax({
                                                        type: "POST",
                                                        headers: {
                                                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                                        },
                                                        url: "{{ route('admin.subtipoactivos.store') }}",
                                                        data: {
                                                            categoria_id,
                                                            subcategoria,
                                                            ajax: true
                                                        },
                                                        dataType: "json",
                                                        success: function(response) {
                                                            if (response.success) {
                                                                document.querySelector('#recipient-name').value = '';
                                                                $('.selecSubcategoria').select2('destroy');
                                                                $('.selecSubcategoria').select2({
                                                                    ajax: {
                                                                        url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                                                                        data: {
                                                                            categoria: 1
                                                                        },
                                                                        dataType: "json",
                                                                    },
                                                                    theme: "bootstrap4"
                                                                });
                                                                $('#subcategorialec').modal('hide')
                                                                $('.modal-backdrop').hide();
                                                                Swal.fire(
                                                                    'Guardada con exito!',
                                                                    '',
                                                                    'success'
                                                                )
                                                                const subtipo = response.subtipo
                                                                // const tipo=response.tipo
                                                                // console.log(subtipo);
                                                                var option = new Option(subtipo.subcategoria, subtipo
                                                                    .id, true, true);
                                                                $('.selecSubcategoria').append(option).trigger(
                                                                'change');
                                                                // var option = new Option(subtipo.categoria_id,subtipo.id, true, true);
                                                                // $('.selecCategoria').append(option).trigger('change');

                                                            }
                                                        },
                                                        error: function(request, status, error) {
                                                            // console.log(error)
                                                            $.each(request.responseJSON.errors, function(indexInArray,

                                                                valueOfElement) {
                                                                // console.log(valueOfElement, indexInArray);
                                                                $(`span#${indexInArray}_error`).text(
                                                                    valueOfElement[0]); ===
                                                                === =
                                                                // Script categoria activos
                                                                document.getElementById('guardar_categoria')
                                                                    .addEventListener('click', function(e) {
                                                                        e.preventDefault();
                                                                        let tipo = document.querySelector(
                                                                            '#tipo-name').value; >>>
                                                                        >>> >
                                                                        e219dc436d16a740249702415aa1c70a129aac4c

                                                                        $.ajax({
                                                                                    type: "POST",
                                                                                    headers: {
                                                                                        "X-CSRF-TOKEN": $(
                                                                                            "meta[name='csrf-token']"
                                                                                            ).attr(
                                                                                            "content")
                                                                                    },
                                                                                    url: "{{ route('admin.tipoactivos.store') }}",
                                                                                    data: {
                                                                                        tipo,
                                                                                        ajax: true
                                                                                    },
                                                                                    dataType: "json",
                                                                                    success: function(
                                                                                        response) {
                                                                                        if (response
                                                                                            .success) {
                                                                                            document
                                                                                                .querySelector(
                                                                                                    '#recipient-name'
                                                                                                    )
                                                                                                .value =
                                                                                                '';
                                                                                            $('.selecCategoria')
                                                                                                .select2(
                                                                                                    'destroy'
                                                                                                    );
                                                                                            $('.selecCategoria')
                                                                                                .select2({
                                                                                                    ajax: {
                                                                                                        url: "{{ route('admin.tipoactivos.getTipos') }}",
                                                                                                        dataType: "json",
                                                                                                    },
                                                                                                    theme: "bootstrap4"
                                                                                                });
                                                                                            $('#categorialec')
                                                                                                .modal(
                                                                                                    'hide'
                                                                                                    )
                                                                                            $('.modal-backdrop')
                                                                                                .hide();
                                                                                            Swal.fire(
                                                                                                'Guardada con exito!',
                                                                                                '',
                                                                                                'success'
                                                                                            )
                                                                                            const
                                                                                                activo =
                                                                                                response
                                                                                                .activo
                                                                                            console.log(
                                                                                                activo
                                                                                                );
                                                                                            var option =
                                                                                                new Option(
                                                                                                    activo
                                                                                                    .tipo,
                                                                                                    activo
                                                                                                    .id,
                                                                                                    true,
                                                                                                    true
                                                                                                    );
                                                                                            $('.selecCategoria')
                                                                                                .append(
                                                                                                    option
                                                                                                    )
                                                                                                .trigger(
                                                                                                    'change'
                                                                                                    );

                                                                                        } <<
                                                                                        << << < HEAD
                                                                                    });
                                                                                // console.log('Guardando')
                                                                                ===
                                                                                === =
                                                                            },
                                                                            error: function(request, status,
                                                                                error) {
                                                                                console.log(error)
                                                                                $.each(request.responseJSON
                                                                                    .errors,
                                                                                    function(
                                                                                        indexInArray,

                                                                                        valueOfElement
                                                                                        ) {
                                                                                        console.log(
                                                                                            valueOfElement,
                                                                                            indexInArray
                                                                                            );
                                                                                        $(`span#${indexInArray}_error`)
                                                                                            .text(
                                                                                                valueOfElement[
                                                                                                    0]);

                                                                                    });
                                                                            } >>>
                                                                            >>> >
                                                                            e219dc436d16a740249702415aa1c70a129aac4c
                                                                    });
                                                                console.log('Guardando')
                                                            });

                                                            // Script subcategoria activos

                                                            document.getElementById('guardar_subcategoria')
                                                                .addEventListener('click', function(e) {
                                                                    e.preventDefault();
                                                                    let subcategoria = document.querySelector(
                                                                        '#subtipo-name').value;
                                                                    let categoria_id = document.querySelector(
                                                                        '#categoria_id').value;

                                                                    $.ajax({
                                                                        type: "POST",
                                                                        headers: {
                                                                            "X-CSRF-TOKEN": $(
                                                                                "meta[name='csrf-token']"
                                                                                ).attr("content")
                                                                        },
                                                                        url: "{{ route('admin.subtipoactivos.store') }}",
                                                                        data: {
                                                                            categoria_id,
                                                                            subcategoria,
                                                                            ajax: true
                                                                        },
                                                                        dataType: "json",
                                                                        success: function(response) {
                                                                            if (response.success) {
                                                                                document.querySelector(
                                                                                    '#recipient-name'
                                                                                    ).value = '';
                                                                                $('.selecSubcategoria')
                                                                                    .select2('destroy');
                                                                                $('.selecSubcategoria')
                                                                                    .select2({
                                                                                        ajax: {
                                                                                            url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                                                                                            data: {
                                                                                                categoria: 1
                                                                                            },
                                                                                            dataType: "json",
                                                                                        },
                                                                                        theme: "bootstrap4"
                                                                                    });
                                                                                $('#subcategorialec')
                                                                                    .modal('hide')
                                                                                $('.modal-backdrop')
                                                                                    .hide();
                                                                                Swal.fire(
                                                                                    'Guardada con exito!',
                                                                                    '',
                                                                                    'success'
                                                                                )
                                                                                const subtipo = response
                                                                                    .subtipo
                                                                                // const tipo=response.tipo
                                                                                console.log(subtipo);
                                                                                var option = new Option(
                                                                                    subtipo
                                                                                    .subcategoria,
                                                                                    subtipo.id,
                                                                                    true, true);
                                                                                $('.selecSubcategoria')
                                                                                    .append(option)
                                                                                    .trigger('change');
                                                                                // var option = new Option(subtipo.categoria_id,subtipo.id, true, true);
                                                                                // $('.selecCategoria').append(option).trigger('change');

                                                                                <<
                                                                                << << < HEAD
                                                                                Swal.fire(
                                                                                    'Guardada con exito!',
                                                                                    '',
                                                                                    'success'
                                                                                )
                                                                                const modelo = response
                                                                                    .modelo
                                                                                // console.log(modelo);
                                                                                var option = new Option(
                                                                                    modelo.nombre,
                                                                                    modelo.id, true,
                                                                                    true);
                                                                                $('.selecmodelo')
                                                                                    .append(option)
                                                                                    .trigger(
                                                                                    'change'); ===
                                                                                === =
                                                                            }
                                                                        },
                                                                        error: function(request, status,
                                                                            error) {
                                                                            console.log(error)
                                                                            $.each(request.responseJSON
                                                                                .errors,
                                                                                function(
                                                                                    indexInArray, >>>
                                                                                    >>> >
                                                                                    e219dc436d16a740249702415aa1c70a129aac4c

                                                                                    valueOfElement
                                                                                    ) {
                                                                                    console.log(
                                                                                        valueOfElement,
                                                                                        indexInArray
                                                                                        );
                                                                                    $(`span#${indexInArray}_error`)
                                                                                        .text(
                                                                                            valueOfElement[
                                                                                                0]);

                                                                                });
                                                                        }
                                                                    });
                                                                    console.log('Guardando')
                                                                });

                                                            <<
                                                            << << < HEAD
                                                        },
                                                        error: function(request, status, error) {
                                                            // console.log(error)
                                                            $.each(request.responseJSON.errors, function(indexInArray,

                                                                valueOfElement) {
                                                                // console.log(valueOfElement, indexInArray);
                                                                $(`span#${indexInArray}_error`).text(
                                                                    valueOfElement[0]); ===
                                                                === =

                                                                // Script Modelo activos
                                                                document.getElementById('guardar_modelo')
                                                                    .addEventListener('click', function(e) {
                                                                            e.preventDefault();
                                                                            let nombre = document.querySelector(
                                                                                '#modelo-name').value; >>>
                                                                            >>> >
                                                                            e219dc436d16a740249702415aa1c70a129aac4c

                                                                            $.ajax({
                                                                                    type: "POST",
                                                                                    headers: {
                                                                                        "X-CSRF-TOKEN": $(
                                                                                            "meta[name='csrf-token']"
                                                                                            ).attr(
                                                                                            "content")
                                                                                    },
                                                                                    url: "{{ route('admin.modelos.store') }}",
                                                                                    data: {
                                                                                        nombre
                                                                                    },
                                                                                    dataType: "json",
                                                                                    success: function(
                                                                                        response) {
                                                                                        $('#modelolec')
                                                                                            .modal(
                                                                                                'hide')
                                                                                        $('.modal-backdrop')
                                                                                            .hide();
                                                                                        if (response
                                                                                            .success) {
                                                                                            document
                                                                                                .querySelector(
                                                                                                    '#modelo-name'
                                                                                                    )
                                                                                                .value =
                                                                                                '';
                                                                                            $('.selecmodelo')
                                                                                                .select2(
                                                                                                    'destroy'
                                                                                                    );
                                                                                            $('.selecmodelo')
                                                                                                .select2({
                                                                                                    ajax: {
                                                                                                        url: "{{ route('admin.modelos.getModelos') }}",
                                                                                                        dataType: "json",
                                                                                                    },
                                                                                                    theme: "bootstrap4"
                                                                                                });

                                                                                            Swal.fire(
                                                                                                'Guardada con exito!',
                                                                                                '',
                                                                                                'success'
                                                                                            )
                                                                                            const
                                                                                                modelo =
                                                                                                response
                                                                                                .modelo
                                                                                            console.log(
                                                                                                modelo
                                                                                                );
                                                                                            var option =
                                                                                                new Option(
                                                                                                    modelo
                                                                                                    .nombre,
                                                                                                    modelo
                                                                                                    .id,
                                                                                                    true,
                                                                                                    true
                                                                                                    );
                                                                                            $('.selecmodelo')
                                                                                                .append(
                                                                                                    option
                                                                                                    )
                                                                                                .trigger(
                                                                                                    'change'
                                                                                                    );

                                                                                        } <<
                                                                                        << << < HEAD
                                                                                    });
                                                                                // console.log('Guardando')
                                                                            }); ===
                                                                        === = >>>
                                                                        >>> >
                                                                        e219dc436d16a740249702415aa1c70a129aac4c


                                                                    },
                                                                    error: function(request, status, error) {
                                                                        console.log(error)
                                                                        $.each(request.responseJSON.errors,
                                                                            function(indexInArray,

                                                                                valueOfElement) {
                                                                                console.log(valueOfElement,
                                                                                    indexInArray);
                                                                                $(`span#${indexInArray}_error`)
                                                                                    .text(valueOfElement[
                                                                                    0]);

                                                                            });
                                                                    }
                                                            });
                                                            console.log('Guardando')
                                                        });

                                                })

                                            <<
                                            << << < HEAD $('.selecCategoria').select2({
                                                ajax: {
                                                    url: "{{ route('admin.tipoactivos.getTipos') }}",
                                                    dataType: "json",
                                                },
                                                theme: "bootstrap4"
                                            }); $('.selecSubcategoria').select2({
                                                ajax: {
                                                    url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                                                    data: {
                                                        categoria: 1
                                                    },
                                                    dataType: "json",
                                                },
                                                theme: "bootstrap4"
                                            }); $('.selecCategoria').on('select2:select', function(e) {
                                                var data = e.params.data;
                                                // console.log(data);
                                                $('.selecSubcategoria').select2({
                                                    ajax: {
                                                        url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                                                        data: {
                                                            categoria: data.id
                                                        },
                                                        dataType: "json",
                                                    },
                                                    theme: "bootstrap4"
                                                });
                                            }); ===
                                            === =
                                            $(document).ready(function() {
                                                $('.selecmarca').select2({
                                                    ajax: {
                                                        url: "{{ route('admin.marcas.getMarcas') }}",
                                                        dataType: "json",
                                                    },
                                                    theme: "bootstrap4"
                                                }); >>>
                                                >>> > e219dc436d16a740249702415aa1c70a129aac4c


                                                $('.selecmodelo').select2({
                                                    ajax: {
                                                        url: "{{ route('admin.modelos.getModelos') }}",
                                                        dataType: "json",
                                                    },
                                                    theme: "bootstrap4"
                                                });


                                                $('.selecCategoria').select2({
                                                    ajax: {
                                                        url: "{{ route('admin.tipoactivos.getTipos') }}",
                                                        dataType: "json",
                                                    },
                                                    theme: "bootstrap4"
                                                });
                                                $('.selecSubcategoria').select2({
                                                    ajax: {
                                                        url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                                                        data: {
                                                            categoria: 1
                                                        },
                                                        dataType: "json",
                                                    },
                                                    theme: "bootstrap4"
                                                });
                                                $('.selecCategoria').on('select2:select', function(e) {
                                                    var data = e.params.data;
                                                    console.log(data);
                                                    $('.selecSubcategoria').select2({
                                                        ajax: {
                                                            url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                                                            data: {
                                                                categoria: data.id
                                                            },
                                                            dataType: "json",
                                                        },
                                                        theme: "bootstrap4"
                                                    });
                                                });

                                            });

                                            // $('.selecCategoria').val('1');
                                            // $('.selecCategoria').trigger('changue');
        </script>
    @endsection
