@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}

    <h5 class="col-12 titulo_general_funcion">Indicadores del Sistema de Gestión</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4>¿Qué es Indicadores del Sistema de Gestión?  </h4>
                <p>
                    Marcadores que proporcionan la información necesaria.
                </p>
                <p>
                    Para tomar decisiones y ajustar estrategias según sea necesario.
                </p>
            </div>
        </div>
    </div>

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
                            {{ $indicadoresSgsi->proceso->nombre }}
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
