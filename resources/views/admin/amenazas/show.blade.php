@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Mostrar Amenaza
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenazas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped" >
                <tbody>
                    <tr>
                        <th>
                           Nombre
                        </th>
                        <td>
                          {{ $amenaza->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Categoria
                        </th>
                        <td>
                            @if($amenaza->categoria)
                            <p>{{$amenaza->categoria}}</p>
                            @else
                            No se ha definido categoria
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Descripción
                        </th>
                        <td>
                            @if($amenaza->descripcion )
                            <p>{{$amenaza->descripcion }}</p>
                            @else
                            No se ha definido descripción
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenazas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection