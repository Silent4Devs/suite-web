@extends('layouts.admin')
@section('content')

    @can('carpetum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <!--<a class="btn btn-success" href="{{ route('admin.carpeta.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.carpetum.title_singular') }}
            </a>-->
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.carpetum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div style="height: 600px;">
            <div id="fm"></div>
        </div>
    </div>
</div>



@endsection
@section('scripts')

@endsection
