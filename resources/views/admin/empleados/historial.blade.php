@extends('layouts.admin')
@section('content')
    <style>
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Historial Empleados</h5>

    <form action="{{ route('admin.empleados.seleccionar') }}" method="POST">
        @csrf
        <label for="empleado">Seleccione un empleado:</label>
        <select name="empleado" id="empleado">
            @foreach($empleados as $empleado)
                <option value="{{ $empleado->id }}" {{ isset($visualizarEmpleados) && $visualizarEmpleados->id == $empleado->id ? 'selected' : '' }}>{{ $empleado->name }}</option>
            @endforeach
        </select>
        <hr>
        <button type="submit" class="btn btn-primary" >Buscar</button>
        @if (isset($visualizarEmpleados))
        @if ($visualizarEmpleados->registrosHistorico)
        <a href="{{ route('admin.empleados.historial_export', $visualizarEmpleados->id) }}" class="btn btn-secondary">
             Descargar
            <i class="fas fa-file-excel excel-logo"></i>
        </a>
       @endif
       @endif
    </form>

    <br>
    <br>

    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <h3 class="title-table-rds">Empleado</h3>
        <table id="dom" class="datatable datatable-perspectiva">
            <thead>
                <tr>
                    <th>Campo Modificado</th>
                    <th>Fecha</th>
                    <th>Descripción del Registro</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($visualizarEmpleados))
                    @foreach ($visualizarEmpleados->registrosHistorico as $registro)
                    @php
                        $fechaFormateada = \Carbon\Carbon::parse($registro['fecha_cambio'])->format('d-m-Y');
                    @endphp
                        <tr>
                            <td>{{ $registro['campo_modificado'] }}</td>
                            <td>{{ $fechaFormateada }}</td>
                            <td>
                                @if (isset($registro['relacion']))
                                    @foreach ($registro['relacion'] as $relacion)
                                        @if (isset($relacion['area']) && !empty($relacion['area']))
                                            @php
                                                $areaData = json_decode($relacion['area'], true);
                                            @endphp
                                            @if (is_array($areaData))

                                            @else
                                                {{ $relacion['area'] }}
                                            @endif
                                        @endif
                                        @if (isset($relacion['puesto']) && !empty($relacion['puesto']))
                                            @php
                                                $puestoData = json_decode($relacion['puesto'], true);
                                            @endphp
                                            @if (is_array($puestoData))

                                            @else
                                                {{ $relacion['puesto'] }}
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </td>

                            @php
                            $user = App\Models\User::where('id', intval($registro['user_id']))->first();
                            @endphp

                            <td>{{ $user->name ?? '' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>



    </div>
@endsection
