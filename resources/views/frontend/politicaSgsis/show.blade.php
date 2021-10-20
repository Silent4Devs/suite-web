@extends('layouts.frontend')
@section('content')

    {{-- {{ Breadcrumbs::render('frontend.politica-sgsis.create') }} --}}

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.politicaSgsi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('politica-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.politicaSgsi.fields.id') }}
                        </th>
                        <td>
                            {{ $politicaSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.politicaSgsi.fields.politicasgsi') }}
                        </th>
                        <td>
                            {{ $politicaSgsi->politicasgsi }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('politica-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
