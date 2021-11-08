@extends('layouts.frontend')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.enlacesEjecutar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('enlaces-ejecutars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.enlacesEjecutar.fields.id') }}
                        </th>
                        <td>
                            {{ $enlacesEjecutar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enlacesEjecutar.fields.ejecutar') }}
                        </th>
                        <td>
                            {{ $enlacesEjecutar->ejecutar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enlacesEjecutar.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $enlacesEjecutar->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enlacesEjecutar.fields.enlace') }}
                        </th>
                        <td>
                            {{ $enlacesEjecutar->enlace }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('enlaces-ejecutars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection