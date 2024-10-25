@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')

    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">Proyecto</font>
    </h5>

    {{-- @include('admin.timesheet.complementos.cards') --}}
    @include('admin.timesheet.complementos.admin-aprob')
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    <div>
        <div class="text-right">
            @can('timesheet_administrador_configuracion_access')
                <a href="{{ route('admin.timesheet-proyectos') }}" class="btn btn-primary">Pagina Principal de Proyectos</a>
            @endcan
            @can('asignar_empleados')
                <a href="{{ route('admin.timesheet-proyecto-empleados', $proyecto->id) }}" class="btn btn-primary">Asignar
                    Empleados</a>
            @endcan
            @can('asignar_externos')
                @if ($proyecto->tipo === 'Externo')
                    <a href="{{ route('admin.timesheet-proyecto-externos', $proyecto->id) }}" class="btn btn-primary">Asignar
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
                </div>
            </div>

            <form method="POST" action="{{ route('admin.timesheet-proyectos-update', $proyecto->id) }}">
                @csrf
                <div class="row mt-4">
                    <div class="col-md-8" style="padding-left: 0 !important; padding-right: 0 !important">
                        @livewire('edit-identificador-proyectos-int-ext', ['id_proyecto' => $proyecto->id])
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <label for="name_proyect" class="asterisco">Nombre del proyecto*</label>
                        <input id="name_proyect" name="proyecto_name" class="form-control" required
                            value="{{ old('proyecto_name', $proyecto->proyecto, '') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 anima-focus">
                        <label for="cliente_id" class="asterisco">Cliente*</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option selected value="{{ old('cliente_id', $proyecto->cliente_id, '') }}">
                                {{ $proyecto->cliente_id ?? '' }} - {{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }}
                            </option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->identificador }} - {{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 anima-focus" style="position: relative; top: -1.5rem;" id="caja_areas_seleccionadas_create">
                        <label for="areas_seleccionadas" class="asterisco">Área(s) participante(s)*</label>
                        <select class="select2-multiple form-control" multiple="multiple" id="areas_seleccionadas" name="areas_seleccionadas[]" required>
                            @php
                                $areasSeleccionadas = $proyecto->areas->pluck('id')->toArray();
                            @endphp
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ in_array($area->id, $areasSeleccionadas) ? 'selected' : '' }}>
                                    {{ $area->area }}
                                </option>
                            @endforeach
                        </select>
                        <div class="mt-1">
                            <input id="chkall" name="chkall" type="checkbox" value="todos"> Seleccionar Todas
                        </div>
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <label for="sede_id" class="asterisco">Sede</label>
                        <select class="form-control" name="sede_id" id="sede_id">
                            <option selected value="{{ old('sede_id', $proyecto->sede_id, null) }}">
                                {{ $proyecto->sede->sede ?? '' }}
                            </option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 anima-focus">
                        <label for="fecha_inicio" class="asterisco">Fecha de inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ old('fecha_inicio', $proyecto->fecha_inicio, '') }}">
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
                        <label for="fecha_fin" class="asterisco">Fecha de fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                            value="{{ old('fecha_fin', $proyecto->fecha_fin, '') }}">
                        @if ($errors->has('fecha_fin'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_fin') }}
                            </div>
                        @endif
                        @error('fecha_fin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 anima-focus">
                        <label for="horas_proyecto" class="asterisco">Horas Asignadas al proyecto</label>
                        <input type="text" pattern="[0-9]+" title="Por favor, ingrese solo números enteros."
                            name="horas_proyecto" id="horas_asignadas" class="form-control"
                            value="{{ old('horas_proyecto', $proyecto->horas_proyecto, '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12 text-right">
                        <a href="{{ route('admin.timesheet-proyectos') }}" class="btn btn-outline-primary">Cancelar</a>
                        <button class="btn btn-primary" type="submit"> Guardar</button>
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
