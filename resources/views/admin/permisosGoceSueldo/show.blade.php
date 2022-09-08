@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Lineamiento de Permiso
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
                                Nombre del permiso
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
                                Tipo de permiso
                            </th>
                            <td>
                                @if ($vacacion->tipo_permiso == 1)
                                Permisos conforme a la ley
                                @elseif($vacacion->tipo_permiso == 2)
                                2-	Permisos otorgados por la empresa
                                @else
                                No definido
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
