@extends('layouts.admin')
@section('content')
    <style>select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }</style>
    <h5 class="col-12 titulo_general_funcion">Historial Empleados</h5>

    <form action="{{ route('admin.empleados.seleccionar') }}" method="POST">
        @csrf
        <label for="empleado">Seleccione un empleado:</label>
        <select name="empleado" id="empleado">
            @foreach($empleados as $empleado)
                <option value="{{ $empleado->id }}" {{ $visualizarEmpleados->id == $empleado->id ? 'selected' : '' }}>{{ $empleado->name }}</option>
            @endforeach
        </select>
        <hr>
        <button type="submit" class="btn btn-primary" style="position: relative; left: 82rem;">Buscar</button>
    </form>

    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <h3 class="title-table-rds">Empleado</h3>
        <table id="dom" class="datatable datatable-perspectiva">
            <thead>
                <tr>
                    <th>Campo Modificado</th>
                    <th>Fecha</th>
                    <th>Descripción del Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visualizarEmpleados->registrosHistorico as $registro)
                    <tr>
                        <td>{{ $registro['campo_modificado'] }}</td> <!-- Campo Modificado -->
                        <td>{{ $registro['fecha_cambio'] }}</td> <!-- Campo Modificado -->
                        <td>
                            @if (isset($registro['relacion']))
                                @foreach ($registro['relacion'] as $relacion)
                                    @if (isset($relacion['area']))
                                        <!-- Mostrar información específica de área -->
                                        {{ $relacion['area'] }}
                                    @elseif (isset($relacion['puesto']))
                                        <!-- Mostrar información específica de puesto -->
                                        {{ $relacion['puesto'] }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>


@endsection
