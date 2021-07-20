@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.indicadoresSgsi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.indicadores-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.indicadoresSgsi.fields.id') }}
                        </th>
                        <td>
                            {{ $indicadoresSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nombre
                        </th>
                        <td>
                            {{ $indicadoresSgsi->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Descripción
                        </th>
                        <td>
                            {{ $indicadoresSgsi->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Formula
                        </th>
                        <td>
                            {{ $indicadoresSgsi->formula }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Frecuencia
                        </th>
                        <td>
                            {{ $indicadoresSgsi->frecuencia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Unidad de medida
                        </th>
                        <td>
                            {{ $indicadoresSgsi->unidadmedida }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Meta
                        </th>
                        <td>
                            {{ $indicadoresSgsi->meta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Número de revisiones
                        </th>
                        <td>
                            {{ $indicadoresSgsi->no_revisiones }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Proceso
                        </th>
                        <td>
                            {{ $indicadoresSgsi->proceso }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.indicadores-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
