@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registro de Visitantes</h5>
    <div class="mt-5 card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre(s)</th>
                        <th>Apellido(s)</th>
                        <th>Foto</th>
                        <th>Dispositivo</th>
                        <th>Serie</th>
                        <th>Motivo</th>
                        <th>Visita</th>
                        <th>Fecha Ingreso</th>
                        <th>Fecha Salida</th>
                        <th>Firma</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visitantes as $visitante)
                        <tr>
                            <td>{{ $visitante->nombre }}</td>
                            <td>{{ $visitante->apellidos }}</td>
                            <td>
                                <img src="{{ $visitante->foto ? $visitante->foto : asset('assets/user.png') }}"
                                    style="max-width: 80px;clip-path: circle();" alt="{{ $visitante->nombre }}">
                            </td>
                            <td>{{ $visitante->dispositivo ? $visitante->dispositivo : 'N/A' }}</td>
                            <td>{{ $visitante->serie ? $visitante->serie : 'N/A' }}</td>
                            <td>{{ $visitante->motivo }}</td>
                            <td>
                                @if ($visitante->tipo_visita == 'persona')
                                    <p>{{ $visitante->empleado ? $visitante->empleado->name : 'N/A' }}</p>
                                @else
                                    <p>{{ $visitante->area ? $visitante->area->area : 'N/A' }}</p>
                                @endif
                            </td>
                            <td>{{ $visitante->created_at->format('d-m-Y h:i A') }}</td>
                            <td>{{ $visitante->fecha_salida ? \Carbon\Carbon::parse($visitante->fecha_salida)->format('d-m-Y h:i A') : 'N/A' }}
                            </td>
                            <td>
                                @if ($visitante->firma)
                                    <img style="max-width: 80px" src="{{ $visitante->firma }}" alt="firma">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <i class="fas fa-eye"></i>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
