@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.entendimiento-organizacions.create') }}
    <h5 style="margin-bottom: 16px;">Registrar: FODA </h5>
    <div class="card" style="background:#5397D5; border-radius: 8px; opacity: 1;">
        <div class="card-body row" style="padding-bottom:11px; padding-top:18px;">
            <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
                <img src="{{ asset('img/foda/image_onboard.png') }}" style="width: 120px;">
            </div>
            <div class="col-xs-12 col-sm-8 col-md-10 col-lg-10 text-light mb-0">
                <h4>¿Qué es? Análisis FODA</h4>
                <h6>FODA significa fortalezas, oportunidades, debilidades y amenazas.</h6>
                <p>El análisis FODA es una herramienta simple y, a la vez, potente que te ayuda a identificar las oportunidades
                    competitivas de mejora. Te permite trabajar para mejorar el negocio y el equipo mientras te mantienes a la cabeza de
                    las tendencias del mercado.</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.entendimiento-organizacions.store') }}" >
        @csrf
        @include('admin.entendimientoOrganizacions._form', [
        'btnText' => 'Guardar',
        ])
    </form>
<script src="{{ asset('js/dark_mode.js') }}"></script>
@endsection

