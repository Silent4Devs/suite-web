@extends('layouts.admin')

@section('content')
    {{-- {{ Breadcrumbs::render('contratos_create') }} --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}"> --}}

    <style>
        hr.hr-custom-title {
            width: 100%;
            margin: 8px 0;
            border-top: 3px solid #1E94A8;
        }

        .asterisco {
            color: red;
            margin-left: 5px;
        }
    </style>
    @livewire('tabla-contratos', ['id_contrato' => $contratos->id])

    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.contratos-katbol.index') }}" class="btn btn-primary">Salir sin llenar</a>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
