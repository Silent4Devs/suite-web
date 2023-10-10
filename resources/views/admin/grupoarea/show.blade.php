@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Grupo
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.grupoarea.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.area.fields.id') }}
                            </th>
                            <td>
                                {{ $grupoarea->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.area.fields.area') }}
                            </th>
                            <td>
                                {{ $grupoarea->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Descripción
                            </th>
                            <td>
                                {{ $grupoarea->descripcion }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Color
                            </th>
                            <td>
                                @if ($grupoarea->color)
                                    <div class="d-flex justify-content-left">
                                        <div style="width:20px; height:20px; background-color:{{ $grupoarea->color }}!important">
                                        </div>
                                    </div>
                                @else
                                No se ha definido color
                                @endif

                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.grupoarea.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
