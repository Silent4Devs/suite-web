{{-- @extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.solicitud-goce-sueldo.index') !!}">Solicitud Permiso con Goce de Sueldo</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Crear Solicitud de Permiso con Goce de Sueldo</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($vacacion, [
                'route' => ['admin.solicitud-permiso-goce-sueldo.update', $vacacion->id],
                'method' => 'patch',
            ]) !!}

            <!-- Categoria Field -->
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="inputState">Permiso</label>
                    <select id="inputState" class="form-control">
                        <option selected>Seleccione...</option>
                        @foreach ($permisos as $permiso)
                            <option value="{{ $permiso->id }}">{{ $permiso->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fa-solid fa-file-circle-check iconos-crear"></i>{!! Form::label('fecha_inicio', 'Día de inicio:', ['class' => 'required']) !!}
                    {!! Form::date('fecha_inicio', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el la fecha en que inican su vacaciones...',
                        'id' => 'fecha_inicio',
                    ]) !!}
                    @error('fecha_inicio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                    <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>{!! Form::label('fecha_fin', 'Día de fin:', ['class' => 'required']) !!}
                    {!! Form::date('fecha_fin', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el la fecha en que terminan su vacaciones...',
                        'id' => 'fecha_fin',
                        'readonly',
                    ]) !!}
                    @error('fecha_fin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    <i class="bi bi-calendar-week-fill iconos-crear"></i>{!! Form::label('dias_solicitados', 'Días solicitados:', ['class' => 'required']) !!}
                    {!! Form::number('dias_solicitados', null, [
                        'class' => 'form-control',
                        'placeholder' => '0',
                        'readonly',
                        'id' => 'dias_solicitados',
                        'style' => 'text-align:center',
                    ]) !!}
                    @error('dias_solicitados')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Descripcion Field -->
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="exampleFormControlTextarea1"> <i
                            class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}</label>
                    <textarea class="form-control" id="edescripcion" name="descripcion" rows="2">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                </div>
            </div>

            <input type="hidden"
                value="{{ auth()->user()->empleado ? explode(' ', auth()->user()->empleado->id)[0] : '' }}"
                name="empleado_id">
            <input type="hidden" value="{{ $autoriza }}" name="autoriza">
            <!-- Submit Field -->
            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection --}}
