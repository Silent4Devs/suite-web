@extends('layouts.admin')
@section('content')

    {{-- {{ Breadcrumbs::render('admin.partes-interesadas.create') }} --}}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.partesInteresada.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.configurar-soporte.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.partesInteresada.fields.id') }}
                        </th>
                        <td>
                            {{ $ConfigurarSoporteModel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partesInteresada.fields.parteinteresada') }}
                        </th>
                        <td>
                            {{ $ConfigurarSoporteModel->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partesInteresada.fields.requisitos') }}
                        </th>
                        <td>
                            {{ $ConfigurarSoporteModel->telefono }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partesInteresada.fields.clausala') }}
                        </th>
                        <td>
                            {{ $ConfigurarSoporteModel->extension }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.configurar-soporte.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection