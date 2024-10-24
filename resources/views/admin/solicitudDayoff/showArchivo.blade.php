@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.solicitud-dayoff.archivo') !!}">Archivo Day Off</a>
        </li>
        <li class="breadcrumb-item active">Ver</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Ver: Solicitud de Day Off</h5>
    <div class="mt-4 card">
        <div class="card-body">


            <div class="row">
                <!-- Categoria Enabled-->
                <div class="col-12 col-sm-12">
                    <div class="text-center form-group"
                        style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
                        DETALLES DE LA SOLICITUD
                    </div>
                    <!-- Categoria Field -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i
                                        class="fa-solid fa-calendar-check iconos-crear"></i>Colaborador</label>
                                <input type="text" class="form-control" value="{{ $vacacion->empleado->name }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i
                                        class="fa-solid fa-calendar-check iconos-crear"></i>Puesto</label>
                                <input type="text" class="form-control" value="{{ $vacacion->empleado->puesto }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i
                                        class="fa-solid fa-calendar-check iconos-crear"></i>Área</label>
                                <input type="text" class="form-control" value="{{ $vacacion->empleado->area->area }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i
                                        class="fa-solid fa-calendar-check iconos-crear"></i>Antiguedad (Años)</label>
                                <input type="text" id="disabledTextInput" class="form-control"
                                    value="{{ $vacacion->año }}" style="text-align: center">
                            </fieldset>
                        </div>

                    </div>
                    <!-- Categoria Field -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i
                                        class="fa-solid fa-file-circle-check iconos-crear"></i>Fecha de inicio:</label>
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($vacacion->fecha_inicio)->format('d/m/Y') }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"> <i
                                        class="fa-solid fa-file-circle-xmark iconos-crear"></i>Fecha de fin:</label>
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($vacacion->fecha_fin)->format('d/m/Y') }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                    </div>
                    <!-- Categoria Field -->

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <fieldset disabled>
                                <label for="disabledTextInput"> <i class="fa-solid fa-calendar-day iconos-crear"></i>Número
                                    de
                                    días solicitados:</label>
                                <input type="text" class="form-control" value="{{ $vacacion->dias_solicitados }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                    </div>

                    <!-- Descripcion Field -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="descripcion">
                                <i class="fas fa-file-alt iconos-crear"></i> Comentarios del solicitante:
                            </label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2" readonly>{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                        </div>
                    </div>


                    {{-- Respuesta --}}
                    <div class="text-center form-group"
                        style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
                        RESPUESTA DEL APROBADOR
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="aprobacion" class="">Estatus:</label>
                            <select class="form-control" name="aprobacion" disabled>
                                <option value="2" {{ 2 == $vacacion->aprobacion ? ' selected="selected"' : '' }}>
                                    Rechazado
                                </option>
                                <option value="3" {{ 3 == $vacacion->aprobacion ? ' selected="selected"' : '' }}>
                                    Aprobado
                                </option>
                                <option {{ 1 == $vacacion->aprobacion ? ' selected="selected"' : '' }}>Pendiente
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="comentarios_aprobador">
                                <i class="fas fa-file-alt iconos-crear"></i> Comentarios del aprobador:
                            </label>
                            <textarea class="form-control" id="comentarios_aprobador" name="comentarios_aprobador" rows="2" disabled>{{ old('comentarios_aprobador', $vacacion->comentarios_aprobador) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit Field -->
                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}"
                            class="btn btn-outline-primary">Regresar</a>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
