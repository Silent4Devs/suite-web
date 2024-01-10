@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.control-accesos.create') }}
    <h5 class="col-12 titulo_general_funcion">Control de Acceso</h5>
        <div class="card card-body" style="background-color: #5397D5; color: #fff;">
            <div class="d-flex" style="gap: 25px;">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
                <div>
                    <br>
                    <br>
                    <h4>¿Qué es Control de Accesos? </h4>
                    <p>
                        Garantiza que las personas adecuadas.
                    </p>
                    <p>
                        Tengan el acceso adecuado a la información en un sistema de gestión de seguridad.
                    </p>
                </div>
            </div>
        </div>

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.controlAcceso.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.control-accesos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.controlAcceso.fields.id') }}
                        </th>
                        <td>
                            {{ $controlAcceso->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlAcceso.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $controlAcceso->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.controlAcceso.fields.archivo') }}
                        </th>
                        <td>
                            @if($controlAcceso->archivo)
                                <a href="{{ $controlAcceso->archivo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.control-accesos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
