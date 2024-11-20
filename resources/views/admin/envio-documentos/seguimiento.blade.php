@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.envio-documentos.atencion') !!}">Atención Mensajería</a>
        </li>
        <li class="breadcrumb-item active">Dar seguimiento</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Actualizar: Solicitud de Mensajería</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form action="{{ route('admin.envio-documentos.seguimientoUpdate', $solicitud->id) }}" method="POST">
                @csrf
                @method('PUT')


            <div class="text-center form-group"
                style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
                DETALLES DEL DESTINO
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <i class="fa-solid fa-file-circle-check iconos-crear"></i>
                    <label for="destinatario" class="required">Nombre de quien recibe:</label>
                    <input type="text" name="destinatario" class="form-control" placeholder="Ingrese nombre del destinatario" value="{{ old('destinatario', $solicitud->destinatario) }}" disabled>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>
                    <label for="telefono" class="required">Teléfono de quien recibe:</label>
                    <input type="text" name="telefono" class="form-control" placeholder="Ingrese numero telefonico del destinatario" id="fecha_fin" value="{{ old('telefono', $solicitud->telefono) }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                    <i class="fa-solid fa-file-circle-check iconos-crear"></i>
                    <label for="lugar" class="required">Lugar:</label>
                    <input type="text" name="lugar" class="form-control" placeholder="Ingrese lugar de referencia" value="{{ old('lugar', $solicitud->lugar) }}" disabled>
                </div>
                <div class="form-group col-sm-6">
                    <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>
                    <label for="descripcion" class="required">Dirección:</label>
                    <input type="text" name="descripcion" class="form-control" placeholder="Ingrese direccion exacta" value="{{ old('descripcion', $solicitud->descripcion) }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                    <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>
                    <label for="fecha_limite" class="required">Fecha limite:</label>
                    <input type="date" name="fecha_limite" class="form-control" value="{{ old('fecha_limite', $solicitud->fecha_limite) }}" disabled>
                </div>
                <div class="form-group col-sm-3">
                    <label for="hora_recepcion_inicio"><i class="fa-solid fa-calendar-check iconos-crear"></i>Horario desde:</label>
                    <input type="time" class="form-control" name="hora_recepcion_inicio" value="{{ old('hora_recepcion_inicio', $solicitud->hora_recepcion_inicio) }}" disabled>
                </div>
                <div class="form-group col-sm-3">
                    <label for="hora_recepcion_fin"><i class="fa-solid fa-calendar-check iconos-crear"></i>Hasta:</label>
                    <input type="time" class="form-control" name="hora_recepcion_fin" value="{{ old('hora_recepcion_fin', $solicitud->hora_recepcion_fin) }}" disabled>
                </div>
            </div>


            <x-loading-indicator />


            <!-- Descripcion Field -->
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="notas">
                        <i class="fas fa-file-alt iconos-crear"></i>Notas:
                    </label>
                    <textarea class="form-control" name="notas" rows="2" disabled>{{ old('notas', $solicitud->notas) }}</textarea>
                </div>
                <input type="hidden" value="{{ auth()->user()->empleado ? explode(' ', auth()->user()->empleado->id)[0] : '' }}" name="id_solicita" disabled>
                <input type="hidden" value="{{ $operadores->coordinador->id }}" name="id_coordinador" disabled>
                <input type="hidden" value="{{ $operadores->mensajero->id }}" name="id_mensajero" disabled>
            </div>


            <div class="text-center form-group"
                style="background-color:var(--color-tbj); border-radius: 100px; color: white;">
                SEGUIMIENTO
            </div>
            <div class="row">
                <label for="status" class="col-sm-2">
                    <i class="fas fa-file-alt iconos-crear"></i>Estatus:
                </label>

                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\EnvioDocumentos::EstatusSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('status', $solicitud->status) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Submit Field -->
            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                <button class="btn btn-primary" id="enviar" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
            </form>
        </div>
    </div>
@endsection
