@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.plan-auditoria.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.planAuditorium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.plan-auditoria.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.id') }}
                        </th>
                        <td>
                            {{ $planAuditorium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.fecha') }}
                        </th>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.objetivo') }}
                        </th>
                        <td>
                            {{ $planAuditorium->objetivo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.alcance') }}
                        </th>
                        <td>
                            {{ $planAuditorium->alcance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.criterios') }}
                        </th>
                        <td>
                            {{ $planAuditorium->criterios }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.documentoauditar') }}
                        </th>
                        <td>
                            {{ $planAuditorium->documentoauditar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.equipoauditor') }}
                        </th>
                        <td>
                            {{ $planAuditorium->equipoauditor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.auditados') }}
                        </th>
                        <td>
                            @foreach($planAuditorium->auditados as $key => $auditados)
                                <span class="label label-info">{{ $auditados->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.descripcion') }}
                        </th>
                        <td>
                            {{ $planAuditorium->descripcion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.plan-auditoria.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
