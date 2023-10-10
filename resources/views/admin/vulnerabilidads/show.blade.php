@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Vulnerabilidad
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.vulnerabilidads.index') }}">
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
                                <p>{{ $vulnerabilidad->nombre }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Amenaza
                            </th>
                            <td>
                                @if($vulnerabilidad->idAmenaza)
                                @if($vulnerabilidad->idAmenaza->nombre)
                                <p>{{ $vulnerabilidad->idAmenaza->nombre }}</p>
                                @endif
                                @else
                                No se ha asociado amenaza
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <th>
                                Descripción
                            </th>
                            <td>
                                @if($vulnerabilidad->descripcion)
                                <p>{{$vulnerabilidad->descripcion }}</p>
                                @else
                                No se ha incluido descripción
                                @endif
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.vulnerabilidads.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
