@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Regla de Vacaciones
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.vacaciones.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                Nombre
                            </th>
                            <td>
                                @if ($vacacion->nombre)
                                    {{ $vacacion->nombre }}
                                @else
                                    No se ha definido nombre
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tipo de conteo
                            </th>
                            <td>
                                @switch($vacacion->tipo_conteo)
                                    @case(1)
                                        Día Natural
                                    @break

                                    @case(2)
                                        Día hábil
                                    @break

                                    @default
                                        No se ha definido
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Inicio de vacaciones
                            </th>
                            <td>
                                @switch($vacacion->inicio_conteo)
                                    @case(1)
                                        Al ingreso
                                    @break

                                    @case(2)
                                        Después de 1 mes
                                    @break

                                    @case(3)
                                        Después de 6 meses
                                    @break

                                    @case(4)
                                        Después de 1 año
                                    @break

                                    @default
                                        No se ha definido
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Días iniciales a gozar:
                            </th>
                            <td>
                                @if ($vacacion->dias)
                                    {{ $vacacion->dias }} días
                                @else
                                    No se han definido días inicales
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Incremento:
                            </th>
                            <td>
                                @if ($vacacion->incremento_dias)
                                    {{ $vacacion->incremento_dias }} días
                                @else
                                    No se ha definido incremento de días
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Periodo de corte:
                            </th>
                            <td>
                                @switch($vacacion->periodo_corte)
                                    @case(1)
                                        Aniversario
                                    @break

                                    @case(2)
                                        Anual
                                    @break

                                    @default
                                        No se ha definido
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Descripción:
                            </th>
                            <td>
                                @if ($vacacion->descripcion)
                                    {{ $vacacion->descripcion }}
                                @else
                                    No se ha definido descripción
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Colaboradores a los que aplica:
                            </th>
                            <td>
                                @if ($vacacion->afectados == 1)
                                    Toda la Empresa
                                @elseif ($vacacion->afectados == 2)
                                    <nav>
                                        @foreach ($vacacion->areas as $area)
                                            <li>{{ $area->area }}</li>
                                        @endforeach
                                    </nav>
                                @else
                                No se ha definido a que colaboradores aplica
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.vacaciones.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
