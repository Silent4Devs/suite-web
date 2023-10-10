@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Analisis de Riesgo
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.analisis-riesgos.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th style="min-width: 200px;">
                                Nombre:
                            </th>
                            <td>
                                <p>{{ $analisis->nombre }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th style="min-width: 200px;">
                                Tipo:
                            </th>
                            <td>
                                <p>{{ $analisis->tipo }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th style="min-width: 200px;">
                                Fecha de creación:
                            </th>
                            <td>
                                <p>{{ \Carbon\Carbon::parse($analisis->fecha)->format('d-m-Y') }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th style="min-width: 200px;">
                                Porcentaje de implementación:
                            </th>
                            <td>
                                @if ($analisis->porcentaje_implementacion == 0)
                                <p>Sin evaluar</p>
                                @else
                                <p>{{ $analisis->porcentaje_implementacion }} %</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="min-width: 200px;">
                                Elaboró:
                            </th>
                            <td>
                                @if($analisis->empleado)
                                @if($analisis->empleado->name)
                                <p>{{$analisis->empleado->name}}</p>
                                @endif
                                @else
                                No se ha asociado colaborador
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="min-width: 200px;">
                                Estatus:
                            </th>
                            <td>
                                @if ($analisis->estatus == 1)
                                    <p>En proceso</p>
                                @endif
                                @if ($analisis->estatus == 2)
                                    <p>En revisión</p>
                                @endif
                                @if ($analisis->estatus == 3)
                                    <p>Aprobado</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.analisis-riesgos.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
