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


    <h5 class="col-12 titulo_general_funcion">Quejas Clientes</h5>
    <div class="container">
        <div class="card card_formulario">

            <div class="card-body">

                <div class="titulo-formulario">
                    <i class="fas fa-thumbs-down mr-3"></i> Quejas Clientes
                </div>

                <hr style="">

                <div class="mt-4">
                    <strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"
                </div>

                <form class="row" method="POST" action="{{ route('admin.desk.quejasClientes-store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    {{-- <div id="datos_personales" class="col-12 row" style="display:none;"> --}}
                        <div class="mt-4 form-group col-12">
                            <b>Datos generales:</b>
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="bi bi-building mr-2 iconos-crear"></i>Cliente<sup>*</sup></label>
                            <select class="form-control" name="cliente_id" required>
                                <option disabled selected>Seleccionar al cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="fas fa-list iconos-crear"></i>Proyecto<sup>*</sup></label>
                            <select class="form-control" name="proyectos_id" required>
                                <option disabled selected>Seleccionar el proyecto</option>
                                @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">
                                    {{ $proyecto->proyecto }}
                                </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="mt-0 form-group col-8">
                            <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre<sup>*</sup></label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="mt-0 form-group col-4">
                            <label class="form-label"><i class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
                            <input type="text" name="puesto" class="form-control">
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" >
                        </div>

                        <div class="mt-0 form-group col-6">
                            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
                            <input type="text" name="correo" class="form-control" >
                        </div>
                    {{-- </div> --}}

                    <div class="mt-4 form-group col-12">
                        <b>Queja dirigida a:</b>
                    </div>

                    <div class="mt-4 form-group col-3 multiselect_areas">
                        <label class="form-label"><i class="bi bi-geo mr-2 iconos-crear"></i>Área(s)</label>
                        <select class="form-control">
                            <option disabled selected>Seleccionar áreas</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->area }}">
                                    {{ $area->area }}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="area_quejado" class="form-control"></textarea>
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
                        <textarea name="colaborador_quejado" class="form-control"></textarea>
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
                        <textarea name="proceso_quejado" class="form-control"></textarea>
                    </div>

                    <div class="mt-4 form-group col-3">
                        <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Otro(s)</label>
                        <input class="form-control" name="otro_quejado">
                    </div>

                    <div class="mt-4 form-group col-12">
                        <b>Descripción de la queja:</b>
                    </div>

                    <div class="mt-2 form-group col-md-8">
                        <label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Título corto de la
                            queja<sup>*</sup></label>
                        <input type="" name="titulo" class="form-control" required>
                    </div>

                    <div class="mt-2 form-group col-md-4">
                        <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha y hora de
                            ocurrencia<sup>*</sup></label>
                        <input type="datetime-local" name="fecha" class="form-control" required>
                    </div>


                    <div class="mt-2 form-group col-md-12">
                        <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación exacta</label>
                        <input type="" name="ubicacion" class="form-control">
                    </div>

                    <div class="mt-4 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Descripción detallada de la
                            queja<sup>*</sup></label><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
                            title="Detallar lo sucedido, es muy importante ser lo más objetivo posible y plasmar únicamente hechos evitando juicios de percepción o desvirtuar la información. Asegúrese de que su relato pueda responder a las siguientes preguntas: ¿Qué?. ¿Quién?, ¿Cómo?,¿Cuándo?, ¿Dónde?."></i>
                        <textarea type="text" name="descripcion" class="form-control" required></textarea>
                    </div>

                    <div class="mt-4 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Adjuntar evidencia</label>
                        <input type="file" name="evidencia[]" class="form-control" multiple="multiple">
                    </div>

                    <div class="mt-4 text-right form-group col-12">
                        <a href="{{ asset('admin/desk') }}#reportes" class="btn btn_cancelar">Cancelar</a>
                        <input type="submit" class="btn btn-success" value="Enviar">
                    </div>

                </form>
            </div>
        </div>
    </div>
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

@endsection
