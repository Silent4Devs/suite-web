@extends('layouts.frontend')
@section('content')

    {{ Breadcrumbs::render('frontend.partes-interesadas.create') }}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.partesInteresada.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('frontend.partes-interesadas.index') }}">
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
                            {{ $partesInteresada->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partesInteresada.fields.parteinteresada') }}
                        </th>
                        <td>
                            {{ $partesInteresada->parteinteresada }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partesInteresada.fields.requisitos') }}
                        </th>
                        <td>
                            {{ $partesInteresada->requisitos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partesInteresada.fields.clausala') }}
                        </th>
                        <td>
                            {{ $partesInteresada->clausala }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('frontend.partes-interesadas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
