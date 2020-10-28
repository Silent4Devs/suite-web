@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.accionCorrectiva.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accion-correctivas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.id') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.fecharegistro') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->fecharegistro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.nombrereporta') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->nombrereporta->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.puestoreporta') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->puestoreporta->puesto ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.nombreregistra') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->nombreregistra->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.puestoregistra') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->puestoregistra->puesto ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.tema') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->tema }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.causaorigen') }}
                        </th>
                        <td>
                            {{ App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT[$accionCorrectiva->causaorigen] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.metodo_causa') }}
                        </th>
                        <td>
                            {{ App\Models\AccionCorrectiva::METODO_CAUSA_SELECT[$accionCorrectiva->metodo_causa] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.solucion') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->solucion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.cierre_accion') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->cierre_accion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.estatus') }}
                        </th>
                        <td>
                            {{ App\Models\AccionCorrectiva::ESTATUS_SELECT[$accionCorrectiva->estatus] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.fecha_compromiso') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->fecha_compromiso }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.fecha_verificacion') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->fecha_verificacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.responsable_accion') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->responsable_accion->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.nombre_autoriza') }}
                        </th>
                        <td>
                            {{ $accionCorrectiva->nombre_autoriza->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.documentometodo') }}
                        </th>
                        <td>
                            @if($accionCorrectiva->documentometodo)
                                <a href="{{ $accionCorrectiva->documentometodo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accion-correctivas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#accioncorrectiva_planaccion_correctivas" role="tab" data-toggle="tab">
                {{ trans('cruds.planaccionCorrectiva.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="accioncorrectiva_planaccion_correctivas">
            @includeIf('admin.accionCorrectivas.relationships.accioncorrectivaPlanaccionCorrectivas', ['planaccionCorrectivas' => $accionCorrectiva->accioncorrectivaPlanaccionCorrectivas])
        </div>
    </div>
</div>

@endsection