<div>


    <div class="px-1 py-2 mx-3 mb-4 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                    Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Revise y complemente la información registrada, al final de
                    cada formulario dé clic en el botón guardar para que la información sea registrada.
                </p>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="mt-2 form-group col-md-6 col-sm-12">
            <label class="form-label"><i class="fas fa-ticket-alt iconos-crear"></i>Folio</label>
            <div class="mt-2 form-control" readonly>{{ $quejasClientes->folio }}</div>
        </div>

        <div class="mt-2 form-group col-md-6 col-sm-12">
            <label class="form-label"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
            <select name="estatus" class="form-control select2" id="opciones" onchange='cambioOpciones();'>
                <option {{ old('estatus', $quejasClientes->estatus) == 'Sin atender' ? 'selected' : '' }}
                    value="Sin atender">Sin atender</option>
                <option {{ old('estatus', $quejasClientes->estatus) == 'En curso' ? 'selected' : '' }}
                    value="En curso">En curso</option>
                <option {{ old('estatus', $quejasClientes->estatus) == 'En espera' ? 'selected' : '' }}
                    value="En espera">En espera</option>
                <option {{ old('estatus', $quejasClientes->estatus) == 'Cerrado' ? 'selected' : '' }} value="Cerrado">
                    Cerrado</option>
                <option {{ old('estatus', $quejasClientes->estatus) == 'No procedente' ? 'selected' : '' }}
                    value="No procedente">No procedente</option>
            </select>
        </div>
    </div>

    <div class="row">

        <div class="mt-2 form-group col-md-6">
            <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                y hora de registro del reporte</label>
            <div class="form-control mt-2" readonly>
                {{ \Carbon\Carbon::parse($quejasClientes->created_at)->format('d-m-Y H:i:s') }}
            </div>
        </div>

        <div class="mt-2 form-group col-md-6">
            <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                y hora de cierre del ticket</label>


                <input class="form-control mt-2" name="fecha_cierre" readonly value="{{ $quejasClientes->fecha_cierre }}"
                id="solucion" type="datetime">

        </div>
    </div>

    <div class="row">
        <div class="mt-1 form-group col-12">
            <b>Datos generales:</b>
        </div>
    </div>

    <div class="row">
        <div class="mt-0 form-group col-6">
            <label class="form-label"><i class="bi bi-building mr-2 iconos-crear"></i>Cliente<sup>*</sup></label>
            <select class="form-control" name="cliente_id">
                <option disabled selected>Seleccionar al cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ old('cliente_id', $quejasClientes->cliente_id) == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
            <span class="cliente_id_error text-danger errores"></span>
        </div>

        <div class="mt-0 form-group col-6">
            <label class="form-label"><i class="fas fa-list iconos-crear"></i>Proyecto<sup>*</sup></label>
            <select class="form-control mt-2" name="proyectos_id">
                <option disabled selected>Seleccionar el proyecto</option>
                @foreach ($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}"
                        {{ old('proyectos_id', $quejasClientes->proyectos_id) == $proyecto->id ? 'selected' : '' }}>
                        {{ $proyecto->proyecto }}
                    </option>
                @endforeach
            </select>
            <span class="proyectos_id_error text-danger errores"></span>
        </div>
    </div>

    <div class="row">
        <div class="mt-1 form-group col-12">
            <b>Reportó:</b>
        </div>
    </div>

    <div class="row">
        <div class="mt-0 form-group col-6">
            <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre del
                contacto<sup>*</sup></label>
            <input type="text" name="nombre" value="{{ old('nombre', $quejasClientes->nombre) }}"
                class="form-control" required>
            @if ($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
            @endif
            <span class="nombre_error text-danger errores"></span>
        </div>

        <div class="mt-0 form-group col-6">
            <label class="form-label"><i class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
            <input type="text" name="puesto" value="{{ old('puesto', $quejasClientes->puesto) }}"
                class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="mt-0 form-group col-6">
            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $quejasClientes->telefono) }}"
                class="form-control">
        </div>

        <div class="mt-0 form-group col-6">
            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                electrónico</label><sup>*</sup>
            <input type="text" name="correo" class="form-control"
                value="{{ old('correo', $quejasClientes->correo) }}">
            <span class="correo_error text-danger errores"></span>
        </div>

    </div>

    <div class="row">
        <div class="mt-1 form-group col-12">
            <b>Queja del cliente dirigida a:</b>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-3 multiselect_areas">
            <label class="form-label"><i class="bi bi-geo mr-2 iconos-crear"></i>Área(s)<sup>*</sup></label>
            <select class="form-control">
                <option disabled selected>Seleccionar áreas</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->area }}">
                        {{ $area->area }}
                    </option>
                @endforeach
            </select>
            <textarea name="area_quejado" class="form-control" required>{{ $quejasClientes->area_quejado }}</textarea>
            @if ($errors->has('area_quejado'))
                <div class="invalid-feedback">
                    {{ $errors->first('area_quejado') }}
                </div>
            @endif
            <span class="area_quejado_error text-danger errores"></span>
        </div>

        <div class="mt-2 form-group col-3 multiselect_empleados">
            <label class="form-label"><i class="fas fa-user iconos-crear"></i>Colaborador(es)</label>
            <select class="form-control">
                <option disabled selected>Seleccionar colaborador</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->name }}">
                        {{ $empleado->name }}
                    </option>
                @endforeach
            </select>
            <textarea name="colaborador_quejado" class="form-control">{{ $quejasClientes->colaborador_quejado }}</textarea>
        </div>

        <div class="mt-2 form-group col-3 multiselect_procesos">
            <label class="form-label"><i class="fas fa-code-branch iconos-crear"></i>Proceso(s)</label>
            <select class="form-control">
                <option disabled selected>Seleccionar proceso</option>
                @foreach ($procesos as $proceso)
                    <option value="{{ $proceso->codigo }}: {{ $proceso->nombre }}">
                        {{ $proceso->codigo }}: {{ $proceso->nombre }}
                    </option>
                @endforeach
            </select>
            <textarea name="proceso_quejado" class="form-control">{{ $quejasClientes->proceso_quejado }}</textarea>
        </div>

        <div class="mt-2 form-group col-3">
            <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Otro(s)</label>
            <textarea style="min-height:187px;" name="otro_quejado" class="form-control">{{ old('otro_quejado', $quejasClientes->otro_quejado) }}
            </textarea>
        </div>
    </div>

    <div class="row">
        <div class="mt-1 form-group col-12">
            <b>Descripción de la queja:</b>
        </div>
    </div>

    <div class="row">
        <div class="mt-2 form-group col-8">
            <label class="form-label"><i class="fas fa-text-width iconos-crear"></i>Título
                corto
                de
                la queja<sup>*</sup></label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                title="Descripción breve del motivo de la queja."></i>
            <input class="form-control" name="titulo" value="{{ $quejasClientes->titulo }}" required>
            @if ($errors->has('titulo'))
                <div class="invalid-feedback">
                    {{ $errors->first('titulo') }}
                </div>
            @endif
            <span class="titulo_error text-danger errores"></span>
        </div>

        <div class="mt-2 form-group col-4">
            <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                y hora de ocurrencia</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                title="Fecha y hora aproximada en la que ocurrió el evento que motivó la queja."></i>
            <input type="datetime-local" name="fecha" class="form-control"
                value="{{ old('fecha', \Carbon\Carbon::parse($quejasClientes->fecha)->format('Y-m-d\TH:i')) }}"
                required>
            @if ($errors->has('fecha'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha') }}
                </div>
            @endif
            <span class="fecha_error text-danger errores"></span>
        </div>
    </div>

    <div class="row">
        <div class="mt-2 form-group col-6">
            <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación
                física donde se originó la queja
            </label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                title="Lugar en el que ocurrió el evento que motivó la queja."></i>
            <input type="" name="ubicacion" class="form-control" value="{{ $quejasClientes->ubicacion }}">
        </div>

        <div class="mt-2 form-group col-6">
            <label class="form-label"><i class="fas fa-satellite iconos-crear"></i> Canal
                de
                recepción de la queja<sup>*</sup>
            </label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                title="Medio a través del cual se recibió esta queja."></i>
            <select name="canal"  class="form-control {{ $errors->has('canal') ? 'is-invalid' : '' }}"
                id="otros_campo" required>
                <option value="" disabled selected>Selecciona una opción</option>
                <option {{ old('canal', $quejasClientes->canal) == 'Correo electronico' ? 'selected' : '' }}
                    value="Correo electronico">Correo electrónico</option>
                <option {{ old('canal', $quejasClientes->canal) == 'Via telefonica' ? 'selected' : '' }}
                    value="Via telefonica">Vía telefónica</option>
                <option {{ old('canal', $quejasClientes->canal) == 'Presencial' ? 'selected' : '' }}
                    value="Presencial">Presencial</option>
                <option {{ old('canal', $quejasClientes->canal) == 'Remota' ? 'selected' : '' }}
                    value="Remota">Remota</option>
                <option {{ old('canal', $quejasClientes->canal) == 'Oficio' ? 'selected' : '' }} value="Oficio">
                    Oficio</option>
                <option {{ old('canal', $quejasClientes->canal) == 'Otro' ? 'selected' : '' }} value="Otro">Otro
                </option>
            </select>
            <span class="canal_error text-danger errores"></span>
        </div>
    </div>

    <div class="row d-none" id="campos_otro">
        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <input class="form-control {{ $errors->has('otro_canal') ? 'is-invalid' : '' }}" type="text"
                name="otro_canal" value="{{ old('otros', $quejasClientes->otro_canal) }}">
        </div>
    </div>


    <div class="row ">
        <div class="mt-2 form-group col-12">
            <label class="form-label required"><i class="fas fa-file-alt iconos-crear"></i>Descripción
                detallada de la
                queja</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                title="Detalles y hechos de la queja."></i>
            <textarea name="descripcion" class="form-control" required>{{ $quejasClientes->descripcion }}</textarea>
            <span class="descripcion_error text-danger errores"></span>
        </div>
    </div>

    <div class="row">
        @if ($evidenciaCreate->count() == 0)
            <div class="mt-2 form-group col-12">
                <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Adjuntar
                    evidencia(s) de la
                    queja</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                    title="Información que soporta la queja que se esta presentando."></i>
                <input type="file" name="evidencia[]" class="form-control" multiple="multiple">
            </div>
        @else
            <div class="form-group col-md-8">
                <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Adjuntar
                    evidencia(s) de la
                    queja</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                    title="Información que soporta la queja que se esta presentando."></i>
                <input type="file" name="evidencia[]" class="form-control" multiple="multiple">
            </div>
            <div class="form-group col-md-4">
                <span type="button" class="mt-5 mr-5" data-toggle="modal" data-target="#largeModal">
                    <i class="mr-2 fas fa-file-download text-primary" style="font-size:14pt"></i>Ver
                    evidencia(s) de la queja
                </span>
            </div>
        @endif

    </div>

    <div class="row">
        <div class="mt-2 form-group col-12">
            <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Solución
                que requiere el cliente
                <sup>*</sup></label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                title="Descripción de la solución que requiere el cliente para retirar la queja."></i>
            <textarea name="solucion_requerida_cliente" class="form-control"
                required>{{ $quejasClientes->solucion_requerida_cliente }}</textarea>
            @if ($errors->has('solucion_requerida_cliente'))
                <div class="invalid-feedback">
                    {{ $errors->first('solucion_requerida_cliente') }}
                </div>
            @endif
            <span class="solucion_requerida_cliente_error text-danger errores"></span>
        </div>
    </div>

    <div class="mt-4 text-center form-group col-12">
        <div class="container">
            {{-- <div class="mb-4 row">
                    <div class="col text-start">
                        <a href="#" class="btn btn-danger" data-toggle="modal"
                            data-target="#largeModal">Evidencia</a>
                    </div>
                </div> --}}
            <!-- modal -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            @if (count($quejasClientes->evidencias_quejas))
                                <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                    <ol class='carousel-indicators'>
                                        @foreach ($quejasClientes->evidencias_quejas as $idx => $evidencia)
                                            <li data-target='#carouselExampleIndicators'
                                                data-slide-to='{{ $idx }}'
                                                class='{{ $idx == 0 ? 'active' : '' }}'></li>
                                        @endforeach
                                    </ol>
                                    <div class='carousel-inner'>
                                        @foreach ($quejasClientes->evidencias_quejas as $idx => $evidencia)
                                            <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                <iframe class='img-size'
                                                    src='{{ asset('storage/evidencias_quejas_clientes' . '/' . $evidencia->evidencia) }}'></iframe>
                                            </div>
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

            <!-- modal Evidencia Cierre -->
            <div class="modal fade" id="cierreEvidencia" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            @if (count($quejasClientes->cierre_evidencias))
                                <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                    <ol class='carousel-indicators'>
                                        @foreach ($quejasClientes->cierre_evidencias as $idx => $cierre)
                                            <li data-target='#carouselExampleIndicators'
                                                data-slide-to='{{ $idx }}'
                                                class='{{ $idx == 0 ? 'active' : '' }}'></li>
                                        @endforeach
                                    </ol>
                                    <div class='carousel-inner'>
                                        @foreach ($quejasClientes->cierre_evidencias as $idx => $cierre)
                                            <div class='carousel-item {{ $idx == 0 ? 'active' : '' }}'>
                                                <iframe class='img-size'
                                                    src='{{ asset('storage/evidencias_quejas_clientes_cerrado' . '/' . $cierre->cierre) }}'></iframe>
                                            </div>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div style="margin-top:-28px;" class="form-group col-12">
            <b>Registró:</b>
        </div>
    </div>

    <div class="row">
        <div class="mt-2 form-group col-6">
            <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
            <div class="form-control" readonly>
                {{ Str::limit($quejasClientes->registro->name, 30, '...') }}</div>
        </div>

        <div class="mt-2 form-group col-6">
            <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
            <div class="form-control" readonly>{{ $quejasClientes->registro->puesto }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-6">
            <label class="form-label"><i class="bi bi-geo mr-2 iconos-crear"></i>Área</label>
            <div class="form-control" readonly>{{ $quejasClientes->registro->area->area }}
            </div>
        </div>

        <div class="mt-2 form-group col-6">
            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                electrónico</label>
            <div class="form-control" readonly>{{ $quejasClientes->registro->email }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12">
            <label class="form-label"><i class="fas fa-comment-dots iconos-crear"></i>Comentarios
                del receptor</label>
            <textarea name="comentarios" class="form-control">{{ $quejasClientes->comentarios }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="float-left mt-4 text-right form-group col-12">
            <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
            <button class="btn btn-success" id="btn-guardar-registro">Guardar</button>
            <button class="btn btn-success" id="btn-siguiente-registro">Siguiente</button>
        </div>
    </div>
</div>
