@extends('layouts.admin')
@section('content')
    <style type="text/css">
        sup {
            color: red;
        }

        ol.breadcrumb {
            margin-bottom: 0px;
        }

    </style>

    @can('centro_atencion_quejas_clientes_agregar')
        <h5 class="col-12 titulo_general_funcion">Quejas Clientes</h5>

        <div class="container">
            <div class="card card_formulario">

                <div class="card-body">

                    <div class="titulo-formulario">
                        <i class="fas fa-thumbs-down mr-3"></i> Formulario Quejas Clientes
                    </div>

                    <hr style="">

                    <div class="mt-4">
                        <strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón
                        "Enviar". Sólo los campos marcados con un (<strong class="text-danger">*</strong>) son obligatorios.
                    </div>

                    <form class="row" method="POST" action="{{ route('admin.desk.quejasClientes-store') }}"
                        enctype="multipart/form-data">

                        @csrf

                        {{-- <div id="datos_personales" class="col-12 row" style="display:none;"> --}}
                        <div class="mt-4 form-group col-12">
                            <b>Datos generales:</b>
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i
                                    class="bi bi-building mr-2 iconos-crear"></i>Cliente<sup>*</sup></label>
                            <select class="form-control {{ $errors->has('cliente_id') ? 'is-invalid' : '' }}"
                                name="cliente_id" required>
                                <option disabled selected>Seleccionar al cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option {{ old('cliente_id') == $cliente->id ? ' selected="selected"' : '' }}
                                        value="{{ $cliente->id }}">
                                        {{ $cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('cliente_id'))
                                <span class="text-danger">
                                    {{ $errors->first('cliente_id') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-2 form-group col-6">
                            <label class="form-label"><i class="fas fa-list iconos-crear"></i>Proyecto<sup>*</sup></label>
                            <select class="form-control" name="proyectos_id" required>
                                <option disabled selected>Seleccionar el proyecto</option>
                                @foreach ($proyectos as $proyecto)
                                    <option {{ old('proyectos_id') == $proyecto->id ? ' selected="selected"' : '' }}
                                        value="{{ $proyecto->id }}">
                                        {{ $proyecto->proyecto }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('proyectos_id'))
                                <span class="text-danger">
                                    {{ $errors->first('proyectos_id') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 form-group col-12">
                            <b>Reportó</b>
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre del
                                contacto<sup>*</sup></label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
                            @if ($errors->has('nombre'))
                                <span class="text-danger">
                                    {{ $errors->first('nombre') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
                            <input type="text" name="puesto" value="{{ old('puesto') }}" class="form-control">
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control">
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                                electrónico<sup>*</sup></label>
                            <input type="text" name="correo" value="{{ old('correo') }}" class="form-control">
                        </div>
                        {{-- </div> --}}


                        <div class="mt-1 form-group col-12">
                            <b>Queja del cliente dirigida a:</b>
                        </div>


                        <div class="mt-3 form-group col-3 multiselect_areas">
                            <label class="form-label"><i class="bi bi-geo mr-2 iconos-crear"></i>Área(s)<sup>*</sup></label>
                            <select class="form-control">
                                <option disabled selected>Seleccionar áreas</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->area }}">
                                        {{ $area->area }}
                                    </option>
                                @endforeach
                            </select>
                            <textarea name="area_quejado" class="form-control" required>{{ old('area_quejado') }}</textarea>
                            @if ($errors->has('area_quejado'))
                                <span class="text-danger">
                                    {{ $errors->first('area_quejado') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 form-group col-3 multiselect_empleados">
                            <label class="form-label"><i class="fas fa-user iconos-crear"></i>Colaborador(es)</label>
                            <select class="form-control">
                                <option disabled selected>Seleccionar colaborador</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->name }}">
                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            <textarea name="colaborador_quejado" class="form-control">{{ old('colaborador_quejado') }}</textarea>
                            @if ($errors->has('colaborador_quejado'))
                                <span class="text-danger">
                                    {{ $errors->first('colaborador_quejado') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 form-group col-3 multiselect_procesos">
                            <label class="form-label"><i class="fas fa-code-branch iconos-crear"></i>Proceso(s)</label>
                            <select class="form-control">
                                <option disabled selected>Seleccionar proceso</option>
                                @foreach ($procesos as $proceso)
                                    <option value="{{ $proceso->codigo }}: {{ $proceso->nombre }}">
                                        {{ $proceso->codigo }}: {{ $proceso->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <textarea name="proceso_quejado" class="form-control">{{ old('proceso_quejado') }}</textarea>
                            @if ($errors->has('proceso_quejado'))
                                <span class="text-danger">
                                    {{ $errors->first('proceso_quejado') }}
                                </span>
                            @endif
                        </div>


                        <div class="mt-4 form-group col-3">
                            <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Otro(s)</label>
                            <textarea style="min-height:187px;" name="otro_quejado" class="form-control">{{ old('otro_quejado') }}</textarea>
                            @if ($errors->has('otro_quejado'))
                                <span class="text-danger">
                                    {{ $errors->first('otro_quejado') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 form-group col-12">
                            <b>Descripción de la queja:</b>
                        </div>

                        <div class="mt-2 form-group col-md-8">
                            <label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Título corto de la
                                queja<sup>*</sup></label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                                title="Describa de forma breve y con palabras clave el motivo de la queja."></i>
                            <input type="" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
                            @if ($errors->has('titulo'))
                                <span class="text-danger">
                                    {{ $errors->first('titulo') }}
                                </span>
                            @endif

                        </div>

                        <div class="mt-2 form-group col-md-4">
                            <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha y hora de
                                ocurrencia<sup>*</sup></label><i class="fas fa-info-circle"
                                style="font-size:12pt; float: right;"
                                title="Indique la fecha y hora aproximada en la que ocurrió el evento que motivó la queja."></i>
                            <input type="datetime-local" name="fecha" class="form-control" value="{{ old('fecha') }}"
                                required>
                            @if ($errors->has('fecha'))
                                <span class="text-danger">
                                    {{ $errors->first('fecha') }}
                                </span>
                            @endif
                        </div>


                        <div class="mt-2 form-group col-md-6">
                            <label class="form-label"><i class="fas fa-map iconos-crear"></i>Ubicación física donde se
                                originó la queja
                            </label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                                title="Indique el lugar en el que ocurrió el evento que motivó la queja."></i>
                            <input type="" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
                        </div>

                        <div class="mt-2 form-group col-6">
                            <label class="form-label"><i class="fas fa-satellite iconos-crear"></i>Canal de recepción de la
                                queja<sup>*</sup>
                            </label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                                title="Indique el medio a través del cual se recibe esta queja."></i>
                            <select name="canal" id="otros_campo" value="{{ old('otro_canal') }}"
                                class="form-control {{ $errors->has('canal') ? 'is-invalid' : '' }}" required>
                                <option value="" selected>Selecciona una opción</option>
                                <option {{ old('canal') == 'Correo electronico' ? 'selected' : '' }}
                                    value="Correo electronico">Correo electrónico</option>
                                <option {{ old('canal') == 'Via telefonica' ? 'selected' : '' }} value="Via telefonica">Vía
                                    telefónica</option>
                                <option {{ old('canal') == 'Presencial' ? 'selected' : '' }} value="Presencial">Presencial
                                </option>
                                <option {{ old('canal') == 'Remota' ? 'selected' : '' }} value="Remota">Remota</option>
                                <option {{ old('canal') == 'Oficio' ? 'selected' : '' }} value="Oficio">Oficio</option>
                                <option {{ old('canal') == 'Otro' ? 'selected' : '' }} value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="row col-12 d-none" id="campos_otro">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <input class="form-control {{ $errors->has('otro_canal') ? 'is-invalid' : '' }}" type="text"
                                    name="otro_canal" value="{{ old('otro_canal') }}">
                            </div>
                        </div>

                        <div class="mt-4 form-group col-12">
                            <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Descripción detallada de
                                la
                                queja<sup>*</sup></label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                                title="Detallar lo sucedido, es muy importante ser lo más objetivo posible y plasmar únicamente hechos evitando juicios de percepción o desvirtuar la información. Asegúrese de que su relato pueda responder a las siguientes preguntas: ¿Qué?. ¿Quién?, ¿Cómo?,¿Cuándo?, ¿Dónde?."></i>
                            <textarea type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}"
                                required>{{ old('descripcion') }}</textarea>
                            @if ($errors->has('descripcion'))
                                <span class="text-danger">
                                    {{ $errors->first('descripcion') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-2 form-group col-12">
                            <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Solución que requiere
                                el cliente
                                <sup>*</sup></label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                                title="Describa detalladamente cual es la solución que requiere el cliente para retirar la queja."></i>
                            <textarea name="solucion_requerida_cliente" class="form-control"
                                required>{{ old('solucion_requerida_cliente') }}</textarea>
                            @if ($errors->has('solucion_requerida_cliente'))
                                <span class="text-danger">
                                    {{ $errors->first('solucion_requerida_cliente') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-2 form-group col-12">
                            <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Adjuntar evidencia(s)
                                de la queja</label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                                title="Adjunte la información que soporte la queja que se esta presentando, pueden ser documentos, fotografías, capturas de pantalla, etc."></i>
                            <input type="file" name="evidencia[]" class="form-control" multiple="multiple">
                        </div>


                        <div class="mt-2 form-group col-12">
                            <label class="form-label"><i class="fas fa-comment-dots iconos-crear"></i>Comentarios
                                del receptor</label>
                            <textarea name="comentarios" class="form-control">{{ old('comentarios') }}</textarea>
                            @if ($errors->has('comentarios'))
                                <span class="text-danger">
                                    {{ $errors->first('comentarios') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 form-group col-md-12">
                            <label><i class="fas fa-question-circle iconos-crear"></i>¿Se requiere mandar el correo electrónico
                                al cliente?<sup>*</sup></label>
                        </div>

                        <div class="row col-12">
                            <div class="card-body" style="margin-top:-30px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="correo_cliente" id="correo_cliente"
                                        value="1" {{ old('correo_cliente') }} required>
                                    <label class="form-check-label" for="correo_cliente">
                                        Sí
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="correo_cliente" id="correo_cliente"
                                        value="2" {{ old('correo_cliente') }} required>
                                    <label class="form-check-label" for="correo_cliente">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div><br>

                        {{-- <div class="col-12">
                        <span>Importante: Al crear esta queja se estará generando automáticamente una acción correctiva
                            que podrá consultar en el submódulo de "Acciones Correctivas" del módulo "Sistema de Gestión".</span>
                    </div> --}}

                        <div class="mt-4 text-right form-group col-12">
                            <a href="{{ asset('admin/desk') }}#reportes" class="btn btn_cancelar">Cancelar</a>
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div>

                    </form>
                </div>
            </div>
        </div>
        @endcan

    @endsection



@section('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelector('.multiselect_areas select').addEventListener('change', function(e) {
                e.preventDefault();

                (document.querySelector('.multiselect_areas textarea')).value += `${this.value}, `;

            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            document.querySelector('.multiselect_empleados select').addEventListener('change', function(e) {
                e.preventDefault();

                (document.querySelector('.multiselect_empleados textarea')).value += `${this.value}, `;

            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            document.querySelector('.multiselect_procesos select').addEventListener('change', function(e) {
                e.preventDefault();

                (document.querySelector('.multiselect_procesos textarea')).value += `${this.value}, `;

            });
        });
    </script>

    <script type="text/javascript">
        $('.tipo_datos input[value="no"]').click(function() {
            $("#datos_personales").fadeIn(100);
        });

        $('.tipo_datos input[value="si"]').click(function() {
            $("#datos_personales").fadeOut(100);
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '#otros_campo', function(event) {
            if ($('#otros_campo option:selected').attr('value') == 'Otro') {
                $('#campos_otro').removeClass('d-none');
            } else {
                $('#campos_otro').addClass('d-none');
            }
        });
    </script>
@endsection
