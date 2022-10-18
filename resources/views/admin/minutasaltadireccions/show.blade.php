@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.minutasaltadireccions.create') }}

    <div class="card">

        <div class="card-body">
            Previsualizacion dla minuta: <strong>{{ $minutasaltadireccion->documento }}</strong>
            <iframe src="{{ asset('storage/minutas/' . 'en aprobacion/' . $minutasaltadireccion->documento) }}" class="w-100"
                style="height: 500px" frameborder="0"></iframe>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minutasaltadireccions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
@endsection
