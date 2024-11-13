@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Alerta</h5>
    <div class="card">
        {{-- <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userAlert.title_singular') }}
    </div> --}}

        <div class="card-body">
            <form method="POST" action="{{ route('admin.user-alerts.update', [$userAlert->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
