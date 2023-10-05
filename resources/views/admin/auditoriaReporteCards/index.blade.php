@extends('layouts.admin')
@section('content')
    <style>

    </style>

    {{-- {{ Breadcrumbs::render('admin.auditoria-internas.index') }} --}}

    <h5 class="titulo_general_funcion">Reporte de Auditoria </h5>

    <div class="d-flex" style="flex-wrap: wrap; gap: 25px;">
        <div class="card card-body">
            <p>Contexto</p>
            <i class="fa-solid fa-ellipsis-vertical"></i>
            <hr>
            <p><strong>Informe auditoria 2023 V3</strong></p>
            <p><small>Marco Luna</small></p>
            <span>Aceptado</span>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script></script>
@endsection
