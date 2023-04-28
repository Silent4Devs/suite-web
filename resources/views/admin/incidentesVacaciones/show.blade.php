@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Execpción de Day OFF
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.incidentes-vacaciones.index') }}">
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
                               Dias Aplicados
                            </th>
                            <td>
                               {{$vacacion->dias_aplicados}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                               Aniversario
                            </th>
                            <td>
                                {{$vacacion->aniversario}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                              Efecto:
                            </th>
                            <td>
                                @switch($vacacion->efecto)
                                @case(1)
                                    Restar
                                @break

                                @case(2)
                                    Sumar
                                @break

                                @default
                                    No se ha definido
                            @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Descripcion
                            </th>
                            <td>
                                @if ($vacacion->descripcion)
                                    {{$vacacion->descripcion }}
                                @else
                                    No se ha definido descripcion
                                @endif
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.incidentes-vacaciones.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
