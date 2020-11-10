@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.revisionDireccion.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.revision-direccions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.estadorevisionesprevias') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->estadorevisionesprevias }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.cambiosinternosexternos') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->cambiosinternosexternos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.retroalimentaciondesempeno') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->retroalimentaciondesempeno }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.retroalimentacionpartesinteresadas') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->retroalimentacionpartesinteresadas }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.resultadosriesgos') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->resultadosriesgos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.oportunidadesmejoracontinua') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->oportunidadesmejoracontinua }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.acuerdoscambios') }}
                                    </th>
                                    <td>
                                        {{ $revisionDireccion->acuerdoscambios }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.revision-direccions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection