@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('admin.objetivosseguridads.index') }} --}}
    <h5 class="col-12 titulo_general_funcion">Crear Tipo de Objetivo</h5>
    <div class="mt-5 card">

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <form action="{{ route('admin.tipos-objetivos.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('admin.tipos_objetivos_sistema._form')
                <div class="form-group text-right">
                    <a href="{{ route('admin.tipos-objetivos.index') }}" class="btn btn_cancelar">
                        {{ __('Cancelar') }}
                    </a>
                    <button class="btn btn-success" type="submit">
                        {{ __('Crear') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
