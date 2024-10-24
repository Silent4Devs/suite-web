@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.solicitud-vacaciones.aprobacion') !!}">Solicitud de Vacaciones</a>
        </li>
        <li class="breadcrumb-item active">Aprobar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Aprobar: Solicitud de Vacaciones</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form action="{{ route('admin.solicitud-vacaciones.update', $vacacion->id) }}" method="POST">
                @csrf
                @method('PATCH')
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
                                    value="{{ $año }}" style="text-align: center">
                            </fieldset>
                        </div>
                        {{-- <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Días
                                    disponibles</label>
                                <input type="text" class="form-control"
                                    value="{{ $dias_disponibles }}" style="text-align: center">
                            </fieldset>
                        </div> --}}
                    </div>
                    <!-- Categoria Field -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <i class="fa-solid fa-file-circle-check iconos-crear"></i>
                            <label for="fecha_inicio">Día de inicio:</label>
                            <input type="date" name="fecha_inicio" class="form-control" placeholder="Ingrese la fecha en que inician sus vacaciones..." id="fecha_inicio" readonly>
                            @error('fecha_inicio')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-sm-6">
                            <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>
                            <label for="fecha_fin">Día de fin:</label>
                            <input type="date" name="fecha_fin" class="form-control" placeholder="Ingrese la fecha en que terminan sus vacaciones..." id="fecha_fin" readonly>
                            @error('fecha_fin')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <i class="fa-solid fa-calendar-day iconos-crear"></i>
                            <label for="dias_solicitados">Número de días solicitados:</label>
                            <input type="number" name="dias_solicitados" class="form-control" placeholder="0" readonly id="dias_solicitados" style="text-align:center">
                            @error('dias_solicitados')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="descripcion">
                                <i class="fas fa-file-alt iconos-crear"></i> Comentarios del solicitante:
                            </label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2" readonly>{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                        </div>
                    </div>

                    <input type="hidden" value="{{ $vacacion->empleado_id }}" name="empleado_id">
                    <input type="hidden" value="{{ $vacacion->año }}" name="año">
                    <input type="hidden" value="{{ $vacacion->autoriza }}" name="autoriza">


                    <div class="text-center form-group"
                        style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
                        RESPUESTA DEL APROBADOR
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="aprobacion" class="">Estatus:</label>
                            <select class="form-control" name="aprobacion">
                                <option selected disabled>Pendiente</option>
                                <option value="3">Aprobar</option>
                                <option value="2">Rechazar</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="comentarios_aprobador">
                                <i class="fas fa-file-alt iconos-crear"></i> Comentarios del aprobador:
                            </label>
                            <textarea class="form-control" name="comentarios_aprobador" id="comentarios_aprobador" rows="2">{{ old('comentarios_aprobador', $vacacion->comentarios_aprobador) }}</textarea>
                        </div>
                    </div>
                    <!-- Submit Field -->
                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}"
                            class="btn btn-outline-primary">Cancelar</a>
                        <button class="btn btn-primary" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
@endsection
