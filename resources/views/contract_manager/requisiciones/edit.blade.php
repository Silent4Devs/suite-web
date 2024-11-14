@extends('layouts.admin')

@section('content')
@section('titulo', 'Actualizar Requisicion')
<link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}{{ config('app.cssVersion') }}">
<link rel="stylesheet" href="{{ asset('css/requisitions/jquery.signature.css') }}{{ config('app.cssVersion') }}">

<div class="card card-body">
    <h4>Tienes
        @if ($contadorEdit == 3 || $contadorEdit == 2)
            <span class="badge badge-pill badge-success">{{ $contadorEdit }}</span>
        @elseif ($contadorEdit == 1)
            <span class="badge badge-pill badge-warning">{{ $contadorEdit }}</span>
        @else
            <span class="badge badge-pill badge-danger">{{ $contadorEdit }}</span>
        @endif
        ediciones disponibles:
    </h4>


</div>

@if ($contadorEdit > 0)

    @livewire('requisiciones-edit-component', ['id_requisiciondata' => $id])

    <div class="card card-body">
        <h4 style="margin-bottom: 20px;">Historial de Cambios:</h4>

        @if (!empty($resultadoRequisiciones))
            @foreach ($resultadoRequisiciones as $cambios)
                <h5 style="margin-bottom: 10px;">Versión: {{ $cambios['version'] }}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor Anterior</th>
                            <th>Valor Modificado</th>
                            <th>Autor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($cambios['cambios']))
                            @foreach ($cambios['cambios'] as $cambio)
                                <tr>
                                    <td>{{ $cambio->campo }}</td>
                                    <td>{{ $cambio->valor_anterior }}</td>
                                    <td>{{ $cambio->valor_nuevo }}</td>
                                    <td>{{ $cambio->empleado->name }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No hay cambios registrados para esta versión.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br> <!-- Espacio entre tablas -->
            @endforeach
        @else
            <h6>No hay cambios registrados</h6>
        @endif

    </div>
@else
    <div class="card-error">
        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt="Apoyo">
        </div>

        <div>
            <h3 style="font-size: 22px; font-weight: bolder; color: #474c6c;">
                Acceso Restringido
            </h3>
            <p>
                Ha alcanzado el limite de ediciones para esta Requisición.
            </p>
            <a href="{{ route('contract_manager.requisiciones') }}" class="btn">Regresar</a>
        </div>
    </div>
@endif
@endsection
