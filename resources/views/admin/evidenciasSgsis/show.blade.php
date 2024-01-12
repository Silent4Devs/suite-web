@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.evidencias-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Evidencia de Asignación de Recursos al SGSI</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4> ¿Qué es Evidencia de asignación de recurso al SGI? </h4>
                <p>
                    Registro de información y documentación que le permita a la organización mostrar que ha   destinado los recursos necesarios para implementar y mantener su Sistema de Gestión de la Seguridad de la Información (SGI).
                </p>
                <p>
                    La evidencia de esta asignación es fundamental para demostrar el compromiso de la organización con la seguridad de la información.
                </p>
            </div>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.evidenciasSgsi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evidencias-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.id') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.objetivodocumento') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->objetivodocumento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.responsable') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->responsable->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.arearesponsable') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->arearesponsable }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.fechadocumento') }}
                        </th>
                        <td>
                            {{ $evidenciasSgsi->fechadocumento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evidenciasSgsi.fields.archivopdf') }}
                        </th>
                        <td>
                            @if($evidenciasSgsi->archivopdf)
                                <a href="{{ $evidenciasSgsi->archivopdf->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evidencias-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
