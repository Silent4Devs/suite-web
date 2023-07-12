@extends('layouts.admin')
@section('content')


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="card card-body mt-4">
    @php
        use App\Models\TimesheetHoras;
    @endphp
    @can('timesheet_administrador_proyectos_create')
        <div class="d-flex">
            <h5 id="titulo_estatus">Editar Proyecto: {{ $proyecto->proyecto }}</h5>
        </div>

        <div class="row">
            <div class="form-group col-12 text-right">
            <a href="{{ route('admin.timesheet-proyecto-empleados', $proyecto->id) }}" class="btn btn-success">Asignar Empleados</a>
            @if($proyecto->tipo === "Externo")
                <a href="{{ route('admin.timesheet-proyecto-externos', $proyecto->id) }}" class="btn btn-success">Asignar Proveedores/Consultores</a>
            @endif
            </div>
        </div>

        <form method="POST" action="{{ route('admin.timesheet-proyectos-update', $proyecto->id) }}">
            @csrf
            <div class="row mt-4">
                <div class="form-group col-md-2">
                    <label><i class="fas fa-list iconos-crear"></i> ID</label>
                    <input id="identificador_proyect" name="identificador" class="form-control" required
                    value="{{ old("identificador", $proyecto->identificador, '') }}">
                    @if ($errors->has('identificador'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identificador') }}
                        </div>
                    @endif
                    @error('identificador')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-10">
                    <label><i class="fas fa-list iconos-crear"></i> Nombre del proyecto</label>
                    <input id="name_proyect" name="proyecto_name" class="form-control" required
                    value="{{ old("proyecto_name", $proyecto->proyecto, '') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Fecha de inicio <small>(opcional)</small></label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                    value="{{ old( 'fecha_inicio', $proyecto->fecha_inicio, '') }}">
                    @if ($errors->has('fecha_inicio'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio') }}
                        </div>
                    @endif
                    @error('fecha_inicio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Fecha de fin <small>(opcional)</small></label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                    value="{{ old( 'fecha_fin', $proyecto->fecha_fin, '') }}">
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
                <div class="form-group col-md-5">
                    <label><i class="fa-solid fa-bag-shopping iconos-crear"></i> Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control">
                        <option selected value="{{old("cliente_id", $proyecto->cliente_id, '')}}">
                            {{$proyecto->cliente_id ?? ''}}-{{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }}</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->identificador }} - {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-7" wire:ignore id="caja_areas_seleccionadas_create">
                    <label><i class="fab fa-adn iconos-crear"></i> Área(s) participante(s)</label>
                    <select class="select2-multiple form-control" multiple="multiple"
                    id="areas_seleccionadas" name="areas_seleccionadas[]" required>
                        @foreach ($proyecto->areas as $area)
                            <option selected value="{{ $area->id }}">{{ $area->area ?? ''}}</option>
                        @endforeach
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">
                                {{ $area->area }}
                            </option>
                        @endforeach
                    </select>

                    <div class="mt-1">
                        <input id="chkall" name="chkall" type="checkbox" value="todos"> Seleccionar Todas
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fa-solid fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control" name="sede_id" id="sede_id">
                        <option selected value="{{old("sede_id", $proyecto->sede_id, '')}}">{{$proyecto->sede->sede ?? ''}}</option>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label"><i
                            class="fa-solid fa-info-circle iconos-crear"></i>Tipo</label>
                    <select class="form-control" name="tipo" id="tipo">
                        <option selected value="{{old("tipo", $proyecto->tipo, '')}}">{{$proyecto->tipo ?? ''}}</option>
                        @foreach ($tipos as $tipo_it)
                            <option value="{{ $tipo_it }}">{{ $tipo_it }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Horas Asignadas al proyecto</label>
                    <input type="number" min="0" name="horas_proyecto" id="horas_asignadas" class="form-control"
                    value="{{ old( 'horas_proyecto', $proyecto->horas_proyecto, '') }}">
                    @if ($errors->has('horas_proyecto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('horas_proyecto') }}
                        </div>
                    @endif
                </div>
            </div>
            {{-- <div class="row">
                  <div class="form-group col-md-4">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i>Proveedor (Opcional)</label>
                    <input type="text" name="proveedor" id="proveedor" class="form-control">
                    @if ($errors->has('proveedor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('proveedor') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i> Horas Asignadas del Tercero (Opcional)</label>
                    <input type="number" min="0" name="horas_tercero" id="horas_asignadas" class="form-control">
                    @if ($errors->has('horas_tercero'))
                        <div class="invalid-feedback">
                            {{ $errors->first('horas_tercero') }}
                        </div>
                    @endif
                </div>
            </div>  --}}
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
                theme : 'bootstrap4',
                placeholder: "select",
                allowClear: true
            });

        });
</script>

@endsection
