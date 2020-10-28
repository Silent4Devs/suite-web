@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.planaccionCorrectiva.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.planaccion-correctivas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planaccionCorrectiva.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $planaccionCorrectiva->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva') }}
                                    </th>
                                    <td>
                                        {{ $planaccionCorrectiva->accioncorrectiva->tema ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planaccionCorrectiva.fields.actividad') }}
                                    </th>
                                    <td>
                                        {{ $planaccionCorrectiva->actividad }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planaccionCorrectiva.fields.responsable') }}
                                    </th>
                                    <td>
                                        {{ $planaccionCorrectiva->responsable->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}
                                    </th>
                                    <td>
                                        {{ $planaccionCorrectiva->fechacompromiso }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planaccionCorrectiva.fields.estatus') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PlanaccionCorrectiva::ESTATUS_SELECT[$planaccionCorrectiva->estatus] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.planaccion-correctivas.index') }}">
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