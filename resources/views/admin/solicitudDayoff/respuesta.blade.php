@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.solicitud-dayoff.aprobacion') !!}">Solicitud de Day Off</a>
        </li>
        <li class="breadcrumb-item active">Aprobar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Aprobar: Day Off</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($vacacion, ['route' => ['admin.solicitud-dayoff.update', $vacacion->id], 'method' => 'patch']) !!}

            <div class="row">
                <!-- Categoria Enabled-->
                <div class="col-12 col-sm-12">
                    <div class="text-center form-group"
                        style="background-color:#345183; border-radius: 100px; color: white;">
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
                   
                    <!-- Categoria Field -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <i class="fa-solid fa-file-circle-check iconos-crear"></i>{!! Form::label('fecha_inicio', 'Día de inicio:') !!}
                            {!! Form::date('fecha_inicio', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el la fecha en que inican su vacaciones...', 'id' => 'fecha_inicio', 'readonly']) !!}
                            @error('fecha_inicio')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Categoria Field -->
                        <div class="form-group col-sm-6">
                            <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>{!! Form::label('fecha_fin', 'Día de fin:') !!}
                            {!! Form::date('fecha_fin', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el la fecha en que terminan su vacaciones...', 'id' => 'fecha_fin', 'readonly']) !!}
                            @error('fecha_fin')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Categoria Field -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <i class="fa-solid fa-calendar-day iconos-crear"></i>{!! Form::label('dias_solicitados', 'Número de días solicitados:') !!}
                            {!! Form::number('dias_solicitados', null, ['class' => 'form-control', 'placeholder' => '0', 'readonly', 'id' => 'dias_solicitados', 'style' => 'text-align:center']) !!}
                            @error('dias_solicitados')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Descripcion Field -->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="exampleFormControlTextarea1"> <i
                                    class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Comentarios del solicitante:') !!}</label>
                            <textarea class="form-control" id="edescripcion" name="descripcion" rows="2" readonly>{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                        </div>
                    </div>

                    <input type="hidden" value="{{ $vacacion->empleado_id }}" name="empleado_id">
                    <input type="hidden" value="{{ $vacacion->año }}" name="año">
                    <input type="hidden" value="{{ $vacacion->autoriza }}" name="autoriza">


                    <div class="text-center form-group"
                        style="background-color:#345183; border-radius: 100px; color: white;">
                        RESPUESTA DEL APROBADOR
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="aprobacion" class="">Estatus:</label>
                            <select class="form-control" name="aprobacion">
                                <option selected disabled>Seleccione...</option>
                                <option value="3">Aprobado</option>
                                <option value="2">Rechazado</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="exampleFormControlTextarea1"> <i
                                    class="fas fa-file-alt iconos-crear"></i>{!! Form::label('comentarios_aprobador', 'Comentarios del aprobador:') !!}</label>
                            <textarea class="form-control" name="comentarios_aprobador" rows="2">{{ old('descripcion', $vacacion->comentarios_aprobador) }}</textarea>
                        </div>
                    </div>
                    <!-- Submit Field -->
                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>



            {!! Form::close() !!}
        </div>
    </div>
@endsection
