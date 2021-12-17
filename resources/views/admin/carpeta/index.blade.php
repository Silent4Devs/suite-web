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


    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Documentos</strong></h3>
        </div>


        {{-- <file-manager v-bind:settings="settings"></file-manager> --}}


        <div id="fm"></div>

    </div>



@endsection
@section('scripts')

@endsection
