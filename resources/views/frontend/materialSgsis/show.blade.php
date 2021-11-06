@extends('layouts.frontend')
@section('content')

    {{ Breadcrumbs::render('frontend.material-sgsis.create') }}


<div class="card">
    <div class="card-header">
    {{-- {{ trans('global.show') }} {{ trans('cruds.materialSgsi.title') }} --}}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('material-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.materialSgsi.fields.id') }}
                        </th>
                        <td>
                            {{ $materialSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialSgsi.fields.objetivo') }}
                        </th>
                        <td>
                            {{ $materialSgsi->objetivo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialSgsi.fields.personalobjetivo') }}
                        </th>
                        <td>
                            {{ App\Models\MaterialSgsi::PERSONALOBJETIVO_SELECT[$materialSgsi->personalobjetivo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialSgsi.fields.arearesponsable') }}
                        </th>
                        <td>
                            {{ $materialSgsi->arearesponsable->area ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialSgsi.fields.tipoimparticion') }}
                        </th>
                        <td>
                            {{ App\Models\MaterialSgsi::TIPOIMPARTICION_SELECT[$materialSgsi->tipoimparticion] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialSgsi.fields.fechacreacion_actualizacion') }}
                        </th>
                        <td>
                            {{ $materialSgsi->fechacreacion_actualizacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialSgsi.fields.archivo') }}
                        </th>
                        <td>
                            @if($materialSgsi->archivo)
                                <a href="{{ $materialSgsi->archivo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('material-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection