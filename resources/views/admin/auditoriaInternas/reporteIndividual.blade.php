@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
            padding: 0 5px 5px 5px !important;
        }

        .select2-container {
            margin-top: 10px !important;
        }
    </style>
    {{ Breadcrumbs::render('admin.auditoria-internas.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar:Informe de Auditoría</h5>
    <div class="row">
        <div class="card">
            No conformidad
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
        </div>
    </div>
@endsection

@section('scripts')
@endsection
