@extends('layouts.admin')
@section('content')
    <style>
        .card.card-body {
            position: relative;
        }

        .i-btn-op-card-audit {
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .mod-options {
            position: absolute;
            top: 20px;
            left: 10px;
        }
    </style>

    {{-- {{ Breadcrumbs::render('admin.auditoria-internas.index') }} --}}

    <h5 class="titulo_general_funcion">Reporte de Auditoria </h5>

    <div class="d-flex" style="flex-wrap: wrap; gap: 25px;">
        <div class="card card-body" id="report-audit-2">
            <p>Contexto</p>
            <i class="fa-solid fa-ellipsis-vertical i-btn-op-card-audit"></i>
            <div class="mod-options d-none">

            </div>
            <hr>
            <p><strong>Informe auditoria 2023 V3</strong></p>
            <p><small>Marco Luna</small></p>
            <span>Aceptado</span>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $('.i-btn-op-card-audit').click(function() {
            $('.mod-options:not(.card.card-body:hover .mod-options)').addClass('d-none');
            $('.card.card-body:hover .mod-options').toggleClass('d-none');
        });
    </script>
@endsection
