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

    @if(asset('admin/inicioUsuario') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('quejas-create-perfil') }}
    @endif
    @if(asset('admin/portal-comunicacion/reportes') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('quejas-create-portal') }}
    @endif
    @if(asset('admin/desk') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('quejas-create') }}
    @endif

    <h5 class="col-12 titulo_general_funcion">Quejas</h5>
    <div class="container">
        <div class="card card_formulario">

            <div class="card-body">

                <div class="titulo-formulario">
                    <i class="bi bi-emoji-frown mr-3"></i> Quejas
                </div>

                <hr style="">

                <div class="mt-4">
                    <strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"
                </div>

                <form class="row" method="POST" action="{{ route('admin.reportes-quejas-store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4 form-group col-12 tipo_datos">
                        <label class="form-label"><strong>Su queja será:</strong></label><br>
                        <input type="radio" name="anonimo" value="si" required checked> Anónima<br>
                        <input type="radio" name="anonimo" value="no" required> Proporcionaré mis datos
                    </div>

                    <div id="datos_personales" class="col-12 row" style="display:none;">

                        <div class="mt-4 form-group col-12">
                            <b>Datos generales:</b>
                            <p>Al enviar este formulario, el receptor podrá ver sus datos de contacto</p>
                        </div>
                        @if (auth()->user()->empleado)

                            <div class="mt-0 form-group col-4">
                                <label class="form-label"><i class="fas fa-user iconos-crear"></i>Nombre</label>
                                <div class="form-control">{{ Str::limit(auth()->user()->empleado->name, 30, '...') }}</div>
                            </div>

                            <div class="mt-0 form-group col-4">
                                <label class="form-label"><i class="fas fa-user-tag iconos-crear"></i>Puesto</label>
                                <div class="form-control">{{ auth()->user()->empleado->puesto }}</div>
                            </div>

                            <div class="mt-0 form-group col-4">
                                <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i></i>Área</label>
                                <div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
                            </div>

                            <div class="mt-4 form-group col-6">
                                <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
                                <div class="form-control">{{ auth()->user()->empleado->email }}</div>
                            </div>

                            <div class="mt-4 form-group col-6">
                                <label class="form-label"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
                                <div class="form-control">{{ auth()->user()->empleado->telefono }}</div>
                            </div>
                        @else
                            <p><strong>no hay un empleado vinculado a este usuario</strong></p>
                        @endif
                    </div>

                    <div class="mt-4 form-group col-12">
                        <b>Queja dirigida a:</b>
                    </div>

                    <div class="mt-4 form-group col-3 multiselect_areas">
                        <label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i>Área(s)</label>
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
                        <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Externo(s)</label>
                        <input class="form-control" name="externo_quejado">
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

                    <div class="mt-2 form-group col-md-4">
                        <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Sede</label>
                        <select class="form-control" name="sede">
                            <option disabled>seleccione sede</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->sede }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2 form-group col-md-8">
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
                        <a href="{{ asset('admin/inicioUsuario') }}#reportes" class="btn btn_cancelar">Cancelar</a>
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
