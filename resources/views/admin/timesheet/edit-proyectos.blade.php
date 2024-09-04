@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')

    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">Proyecto</font>
    </h5>

    {{-- @include('admin.timesheet.complementos.cards') --}}
    {{-- @include('admin.timesheet.complementos.admin-aprob') --}}
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    <div>
        <div class="text-right">
            @can('asignar_empleados')
                <a href="{{ route('admin.timesheet-proyecto-empleados', $proyecto->id) }}" class="btn btn-success">Asignar
                    Empleados</a>
            @endcan
            @can('asignar_externos')
                @if ($proyecto->tipo === 'Externo')
                    <a href="{{ route('admin.timesheet-proyecto-externos', $proyecto->id) }}" class="btn btn-success">Asignar
                        Proveedores/Consultores</a>
                @endif
            @endcan
        </div>
    </div>

    <div class="card card-body mt-4">
        @php
            use App\Models\TimesheetHoras;
        @endphp
        @can('timesheet_administrador_proyectos_create')
            <div class="row">
                <div class="col-12">
                    <h4 class="title-card-time">Editar Proyecto: {{ $proyecto->proyecto }}</h4>
                    <hr class="my-4">
                </div>
            </div>

            <form method="POST" action="{{ route('admin.timesheet-proyectos-update', $proyecto->id) }}">
                @csrf
                <div class="row mt-4">
                    <div class="form-group col-md-2 anima-focus">
                        <input id="identificador_proyect" placeholder="" name="identificador"
                            title="Por favor, no incluyas comas en el nombre de la tarea." pattern="[^\.,]*"
                            class="form-control" required value="{{ old('identificador', $proyecto->identificador, '') }}">
                        {!! Form::label('identificador', 'ID*', ['class' => 'asterisco']) !!}
                        @if ($errors->has('identificador'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identificador') }}
                            </div>
                        @endif
                        @error('identificador')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 anima-focus">
                        <input id="name_proyect" name="proyecto_name" placeholder="" class="form-control" required
                            value="{{ old('proyecto_name', $proyecto->proyecto, '') }}">
                        {!! Form::label('name_proyect', 'Nombre del proyecto*', ['class' => 'asterisco']) !!}
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option selected value="{{ old('cliente_id', $proyecto->cliente_id, '') }}">
                                {{ $proyecto->cliente_id ?? '' }}-{{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }}
                            </option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->identificador }} - {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        {!! Form::label('cliente_id', 'Cliente*', ['class' => 'asterisco']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 anima-focus" style="position: relative; top: -1.5rem;"
                        id="caja_areas_seleccionadas_create">
                        <select class="select2-multiple form-control" multiple="multiple" id="areas_seleccionadas"
                            name="areas_seleccionadas[]" required>
                            @php
                                // Crear un conjunto de IDs de áreas seleccionadas
                                $areasSeleccionadas = $proyecto->areas->pluck('id')->toArray();
                            @endphp

                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}"
                                    {{ in_array($area->id, $areasSeleccionadas) ? 'selected' : '' }}>
                                    {{ $area->area }}
                                </option>
                            @endforeach
                        </select>
                        {!! Form::label('areas_seleccionadas', ' Área(s) participante(s)*', ['class' => 'asterisco']) !!}
                        <div class="mt-1">
                            <input id="chkall" name="chkall" type="checkbox" value="todos"> Seleccionar Todas
                        </div>
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ old('fecha_inicio', $proyecto->fecha_inicio, '') }}">
                        {!! Form::label('fecha_inicio', 'Fecha de inicio', ['class' => 'asterisco']) !!}
                        @if ($errors->has('fecha_inicio'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_inicio') }}
                            </div>
                        @endif
                        @error('fecha_inicio')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                            value="{{ old('fecha_fin', $proyecto->fecha_fin, '') }}">
                        {!! Form::label('fecha_fin', 'Fecha de fin', ['class' => 'asterisco']) !!}
                        @if ($errors->has('fecha_fin'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_fin') }}
                            </div>
                        @endif
                        @error('fecha_fin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 anima-focus">
                        <select class="form-control" name="sede_id" id="sede_id">
                            <option selected value="{{ old('sede_id', $proyecto->sede_id, null) }}">
                                {{ $proyecto->sede->sede ?? '' }}</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                        {!! Form::label('sede_id', 'Sede', ['class' => 'asterisco']) !!}
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option selected value="{{ old('tipo', $proyecto->tipo, '') }}">{{ $proyecto->tipo ?? '' }}
                            </option>
                            @foreach ($tipos as $tipo_it)
                                <option value="{{ $tipo_it }}">{{ $tipo_it }}</option>
                            @endforeach
                        </select>
                        {!! Form::label('tipo', 'Tipo*', ['class' => 'asterisco']) !!}
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <input type="text" pattern="[0-9]+" title="Por favor, ingrese solo números enteros."
                            name="horas_proyecto" placeholder="" id="horas_asignadas" class="form-control"
                            value="{{ old('horas_proyecto', $proyecto->horas_proyecto, '') }}">
                        {!! Form::label('horas_proyecto', 'Horas Asignadas al proyecto', ['class' => 'asterisco']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 text-right">
                        <a href="{{ route('admin.timesheet-proyectos') }}" class="btn btn_cancelar">Cancelar</a>
                        <button class="btn btn-success" type="submit"> Guardar</button>
                    </div>
                </div>
            </form>
        @endcan
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                theme: 'bootstrap4',
                allowClear: true
            });

        });
    </script>
@endsection
