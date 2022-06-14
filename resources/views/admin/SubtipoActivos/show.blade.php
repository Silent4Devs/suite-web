@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Subategoría de los Activos
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subtipoactivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $subcategoria->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Categoría
                        </th>
                        <td>
                            @if($subcategoria->tipoactivo)
                            <p>{{ $subcategoria->tipoactivo->tipo}}</p>
                            @else
                            No se ha definido categoria
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Subcategoría
                        </th>
                        <td>
                            {{ $subcategoria->subcategoria }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subtipoactivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
