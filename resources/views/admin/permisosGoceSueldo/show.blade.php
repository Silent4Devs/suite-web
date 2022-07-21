@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Lineamiento Permiso con Goce de Sueldo
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.permisos-goce-sueldo.index') }}">
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
                                Días otorgados:
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
                      
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.permisos-goce-sueldo.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
