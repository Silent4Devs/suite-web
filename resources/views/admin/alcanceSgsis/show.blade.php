@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.alcanceSgsi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.alcance-sgsis.index') }}">
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
                            {{ $alcanceSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Nombre de Alcance
                        </th>
                        <td>
                            {{ $alcanceSgsi->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Descripción de Alcance
                        </th>
                        <td>
                            {{ $alcanceSgsi->alcancesgsi}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Apróbo
                        </th>
                        <td>
                            {{ $alcanceSgsi->empleado->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Fecha de publicación
                        </th>
                        <td>
                            {{ $alcanceSgsi->fecha_publicacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Fecha de entrada en vigor
                        </th>
                        <td>
                            {{ $alcanceSgsi->fecha_entrada}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Fecha de revisión
                        </th>
                        <td>
                            {{ $alcanceSgsi->fecha_revision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Normas
                        </th>
                        <td>
                            {{ $alcanceSgsi->normas }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.alcance-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection