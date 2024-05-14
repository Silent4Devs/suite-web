@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.material-sgsis.create') }}

    <h5 class="col-12 titulo_general_funcion">Material SGSI</h5>
        <div class="card card-body" style="background-color: #5397D5; color: #fff;">
            <div class="d-flex" style="gap: 25px;">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
                <div>
                    <br>
                    <br>
                    <h4>¿Qué es Material SGSI?   </h4>
                    <p>
                        Recursos educativos diseñados para enseñar.
                    </p>
                    <p>
                        A los colaboradores sobre las prácticas y requisitos de seguridad de la información establecidos por la norma.
                    </p>
                </div>
            </div>
        </div>

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.materialSgsi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.material-sgsis.index') }}">
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
                <a class="btn btn-default" href="{{ route('admin.material-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
