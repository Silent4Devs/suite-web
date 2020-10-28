@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.organizacion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizacions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.id') }}
                        </th>
                        <td>
                            {{ $organizacion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.empresa') }}
                        </th>
                        <td>
                            {{ $organizacion->empresa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.direccion') }}
                        </th>
                        <td>
                            {{ $organizacion->direccion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.telefono') }}
                        </th>
                        <td>
                            {{ $organizacion->telefono }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.correo') }}
                        </th>
                        <td>
                            {{ $organizacion->correo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.pagina_web') }}
                        </th>
                        <td>
                            {{ $organizacion->pagina_web }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.giro') }}
                        </th>
                        <td>
                            {{ $organizacion->giro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.servicios') }}
                        </th>
                        <td>
                            {{ $organizacion->servicios }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.mision') }}
                        </th>
                        <td>
                            {{ $organizacion->mision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.vision') }}
                        </th>
                        <td>
                            {{ $organizacion->vision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.valores') }}
                        </th>
                        <td>
                            {{ $organizacion->valores }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizacion.fields.logotipo') }}
                        </th>
                        <td>
                            @if($organizacion->logotipo)
                                <a href="{{ $organizacion->logotipo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $organizacion->logotipo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizacions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection