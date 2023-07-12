@extends('layouts.admin')
@section('content')

<div class="card mt-4">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Proyecto:
                {{ $proyecto->proyecto }}</h5>

            </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="form-group col-md-3">
                    <label><i class="fas fa-list iconos-crear"></i> ID:</label><br>
                        {{ $proyecto->identificador }}
                </div>
                <div class="form-group col-md-9">
                    <label><i class="fas fa-list iconos-crear"></i> Nombre del proyecto:</label><br>
                        {{ $proyecto->proyecto }}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i>
                        Fecha de inicio:</label><br>
                        {{ $proyecto->fecha_inicio ?? 'No se especifica'}}
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fa-solid fa-calendar-day iconos-crear"></i>
                        Fecha de fin:</label><br>
                        {{ $proyecto->fecha_fin ?? 'No se especifica'}}
                </div>
                <div class="form-group col-md-6">
                    <label><i class="fa-solid fa-bag-shopping iconos-crear"></i> Cliente:</label><br>
                    {{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }}
                @foreach ($clientes as $cliente)
                    {{ $cliente->nombre }}
                @endforeach
                </div>
                <div class="form-group col-md-6" wire:ignore id="caja_areas_select_edit">
                    <label><i class="fab fa-adn iconos-crear"></i> Área(s) participante(s):</label><br>
                            @foreach ($areas as $area)
                                {{ $area->area }} <br>
                            @endforeach
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i
                            class="fa-solid fa-building iconos-crear"></i>Sede:</label><br>
                        @foreach ($sedes as $sede)
                            {{ $sede->sede }}
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label"><i
                            class="fa-solid fa-building iconos-crear"></i>Tipo:</label><br>
                            {{ $proyecto->tipo ?? 'No se especifica' }}
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i
                            class="fa-solid fa-building iconos-crear"></i>Horas Asignadas al Proyecto:</label><br>
                            {{ $proyecto->horas_proyecto ?? 'No se especifica' }}
                </div>
            </div>
        </div>
</div>
@endsection
