@extends('layouts.admin')
@section('content')

<div class="card mt-4">

    <form action="{{ route('admin.timesheet-proyectos-update', $proyecto->id) }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Proyecto:
                {{ $proyecto->proyecto }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="form-group col-md-3">
                    <label><i class="fas fa-list iconos-crear"></i> ID</label>
                    <input name="identificador" class="form-control" required
                        value="{{ $proyecto->identificador }}">
                    @if ($errors->has('identificador'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identificador') }}
                        </div>
                    @endif
                    @error('identificador')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-9">
                    <label><i class="fas fa-list iconos-crear"></i> Nombre del proyecto</label>
                    <input name="proyecto" class="form-control" required
                        value="{{ $proyecto->proyecto }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i>
                        Fecha de inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control"
                        value="{{ $proyecto->fecha_inicio }}">
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
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i>
                        Fecha de fin</label>
                    <input type="date" name="fecha_fin" class="form-control"
                        value="{{ $proyecto->fecha_fin }}">
                    @if ($errors->has('fecha_fin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin') }}
                        </div>
                    @endif
                    @error('fecha_fin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label><i class="fa-solid fa-bag-shopping iconos-crear"></i> Cliente</label>
                    <select name="area_id" class="form-control">
                        <option selected
                            value="{{ $proyecto->cliente_id ? $proyecto->cliente->id : '' }}">
                            {{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }}</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6" wire:ignore id="caja_areas_select_edit">
                    <label><i class="fab fa-adn iconos-crear"></i> Área(s) participante(s)</label>
                    <select name="areas_seleccionadas[]" class="form-control select2" required
                        multiple>
                        @foreach ($proyecto->areas as $area)
                            <option selected value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i
                            class="fa-solid fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control" name="sede_id">
                        <option selected
                            value="{{ $proyecto->sede_id ? $proyecto->sede->id : '' }}">
                            {{ $proyecto->sede_id ? $proyecto->sede->sede : '' }}</option>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i
                            class="fa-solid fa-building iconos-crear"></i>Tipo</label>
                    <select class="form-control" name="tipo">
                        <option selected
                            value="{{ $proyecto->tipo ? $proyecto->tipo : '' }}">
                            {{ $proyecto->tipo ? $proyecto->tipo : '' }}</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo }}">{{ $tipo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12 text-right">
                    <div type="button" class="btn btn_cancelar" data-dismiss="modal">Cancelar</div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>
